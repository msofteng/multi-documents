<?php

use App\Database\MySQL\UsuarioDAOImpl;
use App\Models\Local;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
    --------------------------------------------------------------------------
                                ROTAS DA WEB
    --------------------------------------------------------------------------
    Aqui é onde você pode registrar rotas da web para seu aplicativo. Essas
    rotas são carregadas pelo RouteServiceProvider dentro de um grupo que
    contém o grupo de middleware "web". Agora crie algo grande!
*/

Route::get("/", function () {
    return view("welcome");
});

Route::get("/user/{id}", function ($id) {
    // return Redirect::to("/");
    return view("index", ["id" => UsuarioDAOImpl::count(), "usuario" => new Usuario(1, "Mateus Silva", "mateus22", "abc", new Local("Santos - SP", 445.34565, 55443.6656), "34uj34jd")]);
});


Route::get("/home", function () {
    return view("index");
});
