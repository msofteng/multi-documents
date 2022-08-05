<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;

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
    return Redirect::to("/");
    // return view("index", ["id" => $id, "message" => "O usuário está sendo exibido na tela"]);
});


Route::get("/home", function () {
    return view("index");
});
