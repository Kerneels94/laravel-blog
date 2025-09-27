<?php

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.base', ["location" => "home"]);
});

Route::get("/register", function (Request $request) {
    return view("register", ["location" => "register"]);
})->name("register");

Route::get("/login", function (Request $request) {
    return view("login", ["location" => "login"]);
})->name("login");

Route::get("/reset-password", function (Request $request) {
    return view("forget-password", ["location" => "reset-password"]);
})->name("reset-password");


Route::post("/register-user", function (Request $request) {
    $email = $request->input("email") ?? "";
    $password = $request->input("password") ?? "";
    $name = $request->input("name") ?? "";
    return Controller::registerUser($email, $password, $name);
});

Route::post("/login-user", function (Request $request) {
    $email = $request->input("email") ?? "";
    $password = $request->input("password") ?? "";
    return Controller::loginUser($email, $password);
});

Route::post("/forgot-password", function (Request $request) {
    $email = $request->input("email") ?? "";
    $password = $request->input("password") ?? "";

    return Controller::forgetPassword($email, $password);
});
