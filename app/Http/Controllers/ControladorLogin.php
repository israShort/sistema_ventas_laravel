<?php

namespace App\Http\Controllers;

use App\Models\Sistema\UsuarioFamilia;
use App\Models\User;
use Illuminate\Http\Request;

class ControladorLogin extends Controller
{
    public function login(Request $request)
    {
        header('Access-Control-Allow-Origin: http://localhost:3000');

        $aData = array();

        if ($request->filled("txtUsuario") && $request->filled("txtClave")) {
            $usuario = str_replace(" ", "", trim($request->input("txtUsuario")));
            $clave = str_replace(" ", "", trim($request->input("txtClave")));

            $user = new User();
            $user->obtenerPorUsuario($usuario);

            if (isset($user->idUsuario)) {
                if (password_verify($clave, $user->clave)) {
                    $userFamilia = new UsuarioFamilia();
                    $aPermisos = $userFamilia->obtenerPermisos($user->idUsuario);

                    $user->lastLoggedIn = date("Y-m-d H:i:s");
                    $user->updateLastLogged();

                    $aData = array(
                        "code" => 200,
                        "usuario_id" => $user->idUsuario,
                        "usuario" => $usuario,
                        "user" => $user,
                        "array_permisos" => $aPermisos,
                        "msg" => "Inicio de sesión correcto.",
                        "status" => "success"
                    );
                } else {
                    $aData = array(
                        "code" => 500,
                        "msg" => "Credenciales incorrectas.",
                        "status" => "danger"
                    );
                }
            } else {
                $aData = array(
                    "code" => 500,
                    "msg" => "Credenciales incorrectas.",
                    "status" => "danger"
                );
            }
        } else {
            $aData = array(
                "code" => 500,
                "msg" => "Debe completar los campos obligatorios antes de continuar.",
                "status" => "danger"
            );
        }

        return json_encode($aData);
    }
}
