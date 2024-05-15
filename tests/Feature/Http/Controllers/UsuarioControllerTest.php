<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Tests\Traits\SaveDataTest;
use Tests\Traits\ValidationsTest;

class UsuarioControllerTest extends TestCase
{
    use DatabaseMigrations, ValidationsTest, SaveDataTest;

    private Usuario $usuario;
    private string $token;

    protected function setUp(): void
    {
        parent::setUp();
        $this->usuario = Usuario::factory()->create();
        $this->token = auth()->login($this->usuario);

    }

    public function testIndexNotAuthenticated()
    {
        $response = $this->get(route('usuarios.index'));
        $response
            ->assertStatus(401);
    }

    public function testIndex()
    {

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $this->token])
            ->get(route('usuarios.index'));
        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'nome', 'email', 'nivel']
                ],
                'meta' => [
                    'pagination' => [
                        'total',
                        'count',
                        'per_page',
                        'current_page',
                        'total_pages',
                        'links',
                    ]
                ]
            ]);
    }

    public function testInvalidationRequired()
    {
        $dados = [
            'nome' => '',
            'cpf' => '',
            'email' => '',
            'password' => '',
            'password_confirmation' => '',
        ];

        $this->assertInvalidationDataInStoreAction($dados, 'required');
    }


    protected function routeStore()
    {
        return route('usuarios.store');
    }

}
