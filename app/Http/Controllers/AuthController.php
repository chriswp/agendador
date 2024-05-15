<?php

namespace App\Http\Controllers;

use App\Services\UsuarioService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;


class AuthController extends Controller
{
    private UsuarioService $usuarioService;

    public function __construct(UsuarioService $usuarioService)
    {
        $this->usuarioService = $usuarioService;
        $this->middleware('auth:api', ['except' => ['login', 'register', 'sendResetLink', 'resetPassword']]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $credentials = $validator->validated();

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['message' => 'acesso não autorizado'], Response::HTTP_UNAUTHORIZED);
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60 //mention the guard name inside the auth fn
        ]);
    }

    public function getaccount()
    {
        $usuario = $this->usuarioService->findById(auth()->user()->id);
        return response()->json($usuario);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    public function sendResetLink(Request $request)
    {
        $token = $this->usuarioService->createResetLink($request->email);
        return response()->json(['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        return $this->usuarioService->changePasswordByToken($request->email, $request->password, $request->token);
    }
}

