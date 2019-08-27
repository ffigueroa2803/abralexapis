<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Hash;
use App\User;

class JWTController extends Controller
{

    public function login(Request $request)
    {
        $this->validate(request(), [
            "email" => "required|max:100",
            "password" => "required|max:255",
        ]);

        try {
            $user = User::where("email", $request->email)->first();
            $isValidate = Hash::check($request->password, $user->password);
            $token = $user->auth_token;

            if (!$isValidate) {
                return [
                    "status" => 401,
                    "message" => "La contraseña es incorrecta!",
                    "body" => [
                        "email" => $user->email,
                        "perfil" => "not found."
                    ]
                ];
            }

            if (!$token) {
                $randon = $user->email . rand(1, 1000000);
                $token = \bcrypt($randon);
            }

            return [
                "status" => 201,
                "message" => "Listo, usuario autenticado correctamente!",
                "body" => [
                    "email" => $user->email,
                    "auth_token" => $token
                ]
            ];
        } catch (\Throwable $th) {
            return [
                "status" => 404,
                "message" => "Las credenciales son incorrectas"
            ];
        }
    }


    public function register(Request $request)
    {
        $this->validate(request(), [
            "email" => "required|max:100|unique:users,email",
            "password" => "required|max:255",
        ]);

        #$user = 
    }
}
