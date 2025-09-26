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
                // Look for proper status to return
                return response()->json(["message" => "Email or password empty"], 404);
            }

            $data = DB::table('users')->get()->where("email", $email)->first();

            if (!empty($users) && $email === $data["email"] && password_verify($password, $data["password"])) {
                return redirect("/dashboard");
            }

            return response()->json(["User logged in"], 200);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public static function registerUser(string $email, string $password, string $name)
    {
        try {
            if (empty($email) || empty($password)) {
                // Look for proper status to return
                return response()->json(["message" => "Email or password empty"], 404);
            }

            DB::table('users')->insert([
                "email" => $email ?? "",
                "password" => hash::make($password) ?? "",
                "name" => $name ?? "",
                "created_at" => Date("Y-m-d"),
            ]);

            return response()->json(["User logged in"], 200);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
