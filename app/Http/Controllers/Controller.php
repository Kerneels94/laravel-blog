<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


abstract class Controller
{
    public static function loginUser(string $email, string $password)
    {
        try {
            if (empty($email) || empty($password)) {
                return response()->json(["message" => "Email or password empty"], 400);
            }

            $data = DB::table('users')->where("email", $email)->first();

            if ($data && password_verify($password, $data->password)) {
                // Successful login
                return redirect("/dashboard");
            }

            return response()->json(["message" => "Invalid email or password"], 401);
        } catch (Exception $e) {
            return response()->json(["error" => $e->getMessage()], 500);
        }
    }

    public static function registerUser(string $email, string $password, string $name)
    {
        try {
            if (empty($email) || empty($password)) {
                return response()->json(["message" => "Email or password empty"], 404);
            }

            $data = DB::table('users')->insert([
                "email" => $email ?? "",
                "password" => hash::make($password) ?? "",
                "name" => $name ?? "",
                "created_at" => Date("Y-m-d"),
            ]);

            if ($data) {
                return response()->json(["User created"], 200);
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public static function forgetPassword(string $email, string $password)
    {
        try {
            if (empty($email)) {
                return response()->json(["message" => "Email empty"], 404);
            }

            $userEmail = DB::table("users")->select("email")->where('email', $email)->first();

            if ($email === $userEmail->email) {
                DB::table("users")->where("email", $email)->update(["password" => hash::make($password)]);
                return response()->json(["message" => "Password updated"], 200);
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
