<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(\App\Repositories\PessoaFisicaRepository::class, \App\Repositories\PessoaFisicaRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PessoaRepository::class, \App\Repositories\PessoaRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\UsuarioRepository::class, \App\Repositories\UsuarioRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TarefaStatusRepository::class, \App\Repositories\TarefaStatusRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TarefaRepository::class, \App\Repositories\TarefaRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TelefoneRepository::class, \App\Repositories\TelefoneRepositoryEloquent::class);
        //:end-bindings:
    }
}
