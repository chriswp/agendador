<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\TarefaStatusCreateRequest;
use App\Http\Requests\TarefaStatusUpdateRequest;
use App\Repositories\TarefaStatusRepository;
use App\Validators\TarefaStatusValidator;

/**
 * Class TarefaStatusesController.
 *
 * @package namespace App\Http\Controllers;
 */
class TarefaStatusesController extends Controller
{
    /**
     * @var TarefaStatusRepository
     */
    protected $repository;

    /**
     * @var TarefaStatusValidator
     */
    protected $validator;

    /**
     * TarefaStatusesController constructor.
     *
     * @param TarefaStatusRepository $repository
     * @param TarefaStatusValidator $validator
     */
    public function __construct(TarefaStatusRepository $repository, TarefaStatusValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $tarefaStatuses = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $tarefaStatuses,
            ]);
        }

        return view('tarefaStatuses.index', compact('tarefaStatuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TarefaStatusCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(TarefaStatusCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $tarefaStatus = $this->repository->create($request->all());

            $response = [
                'message' => 'TarefaStatus created.',
                'data'    => $tarefaStatus->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tarefaStatus = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $tarefaStatus,
            ]);
        }

        return view('tarefaStatuses.show', compact('tarefaStatus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tarefaStatus = $this->repository->find($id);

        return view('tarefaStatuses.edit', compact('tarefaStatus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TarefaStatusUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(TarefaStatusUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $tarefaStatus = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'TarefaStatus updated.',
                'data'    => $tarefaStatus->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'TarefaStatus deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'TarefaStatus deleted.');
    }
}
