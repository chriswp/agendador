<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Prettus\Validator\Exceptions\ValidatorException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];


    public function render($request, Throwable $e)
    {
        if ($e instanceof ValidatorException) {
            return response()->json([
                'message' => 'verifique os dados e tente novamente',
                'errors' => $e->getMessageBag()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if ($e instanceof UnauthorizedHttpException || $e instanceof AuthenticationException) {
            return response()->json([
                'message' => 'não autorizado',
                'errors' => [$e->getMessage()]
            ], Response::HTTP_UNAUTHORIZED);
        }

        if ($e instanceof ModelNotFoundException || $e instanceof NotFoundHttpException) {
            return response()->json([
                'message' => 'não encontrado',
                'errors' => ['não foi possível encontrar o dado solicitado']
            ], Response::HTTP_NOT_FOUND);
        }

        if ($e instanceof UnprocessableEntityHttpException) {
            return response()->json([
                'message' => 'ação não executada',
                'errors' => ['aviso' => [$e->getMessage()]]
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if ($e instanceof \TypeError) {
            return response()->json([
                'message' => 'não processado',
                'errors' => 'ocorreu um problema interno e sua requisicao foi rejeitada',
                'type' => [$e->getMessage()]
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return parent::render($request, $e);
    }

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
