<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class ControladorRegistro extends Controller
{
    public function signup(Request $request)
    {
        header('Access-Control-Allow-Origin: http://localhost:3000');

        $aData = array();

        if ($request->filled("txtNombre") && $request->filled("txtMail") && $request->filled("txtClave") && $request->filled("txtClaveR")) {
            $nombre = trim($request->input("txtNombre"));
            $apellido = trim($request->input("txtApellido"));
            $mail = str_replace(" ", "", trim($request->input("txtMail")));
            $clave = str_replace(" ", "", trim($request->input("txtClave")));
            $claveR = str_replace(" ", "", trim($request->input("txtClaveR")));

            if (strcmp($clave, $claveR) === 0) {
                if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                    $_user = new User();
                    $_user->obtenerPorUsuario($mail);

                    if (isset($_user->idUsuario)) {
                        $aData = array(
                            "code" => 400,
                            "msg" => "El mail que intenta registrar ya se encuentra asociado a otro usuario.",
                            "status" => "danger"
                        );
                    } else {

                        $user = new User();
                        $user->nombre = $nombre;
                        $user->apellido = $apellido;
                        $user->mail = $mail;
                        $user->usuario = $mail;
                        $user->clave = $clave;
                        $user->insertar();

                        $aData = array(
                            "code" => 200,
                            "msg" => "Usuario registrado con éxito.",
                            "status" => "success"
                        );
                    }
                } else {
                    $aData = array(
                        "code" => 400,
                        "msg" => "Ingrese una dirección de correo válida.",
                        "status" => "warning"
                    );
                }
            } else {
                $aData = array(
                    "code" => 500,
                    "msg" => "Las contraseñas ingresadas no coinciden.",
                    "status" => "danger"
                );
            }
        } else {
            $aData = array(
                "code" => 500,
                "msg" => "Debe ingresar los campos obligatorios antes de continuar.",
                "status" => "danger"
            );
        }

        return json_encode($aData);
    }
}
