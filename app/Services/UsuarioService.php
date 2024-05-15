<?php

namespace App\Services;

use App\Builders\Usuario\UsuarioCreateRequestBuilder;
use App\Builders\Usuario\UsuarioCreateResponseBuilder;
use App\Criteria\FilterListUsuarioCriteria;
use App\Mail\ConfirmarEmail;
use App\Presenters\UsuarioPresenter;
use App\Repositories\UsuarioRepository;
use App\Validators\UpdateEmailUsuarioRepresentanteValidator;
use App\Validators\UpdatePasswordUsuarioRepresentanteValidator;
use App\Validators\UsuarioValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Presenter\FractalPresenter;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\LaravelValidator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UsuarioService extends ApiService
{
    private PessoaFisicaService $pessoaFisicaService;

    public function __construct(
        PessoaFisicaService $pessoaFisicaService
    ) {
        $this->pessoaFisicaService = $pessoaFisicaService;
    }

    /**
     * @throws ValidatorException
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $this->validate($request, ValidatorInterface::RULE_CREATE);
            $usuarioRequest = (new UsuarioCreateRequestBuilder($data))->build();
            $pessoaFisica = $this->pessoaFisicaService->create($usuarioRequest);
            $usuarioCreated = $pessoaFisica->usuario()->create($usuarioRequest['usuario']);
            $usuarioResponse = new UsuarioCreateResponseBuilder($usuarioCreated);
            DB::commit();

            return response()->json($usuarioResponse->build(), Response::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function resendConfirmationMail($email): void
    {
        $usuario = $this->repository()->with('pessoaFisica')->findByField('email', $email)->first();

        if ($usuario) {
            $pessoaFisica = $usuario->pessoaFisica;
            $usuario->linkAtivacao()->delete();
            $linkAtivacao = $usuario->linkAtivacao()->create();
        }
    }

    protected function repository(): RepositoryInterface
    {
        return app(UsuarioRepository::class);
    }
    protected function relations(): array
    {
        return ['pessoaFisica.pessoa'];
    }

    protected function presenter(): FractalPresenter
    {
        return app(UsuarioPresenter::class);
    }

    public function updatePassword(int $id, string $password)
    {
        return $this->repository()->update(['password' => $password], $id);
    }

    public function changePasswordByToken(string $email, string $password, string $token)
    {
        $response = Password::broker()->reset(
            ['email' => $email, 'password' => $password, 'token' => $token],
            function ($user, $password) {
                $user->password = $password;
                $user->save();
            }
        );
        if ($response != Password::INVALID_TOKEN) {
            return response()->json(['message' => 'Senha alterada com sucesso.'], 200);
        }
        return response()->json(['message' => 'token expirado'], 200);
    }

    protected function validator(): LaravelValidator
    {
        return app(UsuarioValidator::class);
    }
}
