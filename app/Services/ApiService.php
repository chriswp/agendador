<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Presenter\FractalPresenter;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

abstract class ApiService
{
    public function findAll()
    {
        $limit = request()->get('limit') ?? config('repository.pagination.limit');
        $withTrashed = request()->get('withTrashed', null) == 1 ?? false;

        return $this->repository()->scopeQuery(function ($query) use ($withTrashed) {
            if ($withTrashed) {
                return $query->withTrashed();
            }
            return $query;
        })->with($this->relations())->setPresenter($this->presenter())->paginate($limit);
    }

    protected abstract function repository(): RepositoryInterface;

    protected function relations(): array
    {
        return [];
    }

    protected abstract function presenter(): FractalPresenter;

    public function store(Request $request)
    {
        $data = $this->validate($request, ValidatorInterface::RULE_CREATE);
        return $this->create($data);
    }

    protected function validate(Request $request, string $method, LaravelValidator $validator = null): array
    {
        $data = $this->getRulesValidated($request, $method, $validator);
        $this->validator()->with($data)->passesOrFail($method);
        return $data;
    }

    protected function getRulesValidated(Request $request, string $method, LaravelValidator $validator = null): array
    {
        $rules = array_keys($this->validator()->getRules($method));

        if ($validator !== null) {
            $rules = array_keys($validator->getRules($method));
        }

        return $request->only($rules);
    }

    protected abstract function validator(): LaravelValidator;

    public function create(array $data)
    {
        $result = $this->repository()->create($data);
        return $result->refresh();
    }

    public function createMany(array $data): Collection
    {
        $result = collect([]);
        foreach ($data as $key => $value) {
            $result->push($this->create($value));
        }

        return $result;
    }

    public function findBy($field, $value)
    {
        return $this->repository()->findByField($field, $value)->first();
    }

    public function findById($id)
    {
        return $this->repository()->with($this->relations())->setPresenter($this->presenter())->find($id);
    }

    public function edit(array $data, $id)
    {
        return $this->repository()->update($data, $id)->refresh();
    }

    public function update(Request $request, $id)
    {
        $data = $this->getRulesValidated($request, ValidatorInterface::RULE_UPDATE);
        $this->validator()->setId($id)->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
        return $this->repository()->update($data, $id)->refresh();
    }

    public function remove($id): int
    {
        return $this->repository()->delete($id);
    }

    public function delete($id): Response
    {
        $this->repository()->delete($id);
        return response()->noContent();
    }
}
