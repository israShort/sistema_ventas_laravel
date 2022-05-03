<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class ControladorUsuario extends Controller
{
    public function cambiarClave(Request $request)
    {
        header('Access-Control-Allow-Origin: http://localhost:3000');

        $aData = array();

        if ($request->filled("idUsuario") && $request->filled("claveActual") && $request->filled("claveNueva") && $request->filled("claveNuevaR")) {
            $idUsuario = $request->input("idUsuario");
            $user = new User();
            $user->obtenerPorId($idUsuario);

            if (isset($user->idUsuario) && isset($user->clave)) {
                if ($user->verificarClaveAlmacenada($request->input("claveActual"), $user->clave)) {
                    $claveNueva = $request->input("claveNueva");
                    $claveNuevaR = $request->input("claveNuevaR");

                    if (strcmp($claveNueva, $claveNuevaR) === 0) {
                        try {
                            $user->updateClave($idUsuario, $claveNueva);

                            $aData = array(
                                "code" => 200,
                                "msg" => "Contraseña actualizada correctamente.",
                                "status" => "success"
                            );
                        } catch (Exception $e) {
                            $aData = array(
                                "code" => 500,
                                "msg" => "No se ha podido completar la operación.",
                                "status" => "danger",
                                "extraData" => $e->getMessage()
                            );
                        }
                    } else {
                        $aData = array(
                            "code" => 500,
                            "msg" => "Las contraseñas no coinciden.",
                            "status" => "danger"
                        );
                    }
                } else {
                    $aData = array(
                        "code" => 500,
                        "msg" => "La contraseña actual no coincide con la contraseña ingresada.",
                        "status" => "danger"
                    );
                }
            } else {
                $aData = array(
                    "code" => 400,
                    "msg" => "Missing data.",
                    "status" => "info"
                );
            }
        } else {
            $aData = array(
                "code" => 400,
                "msg" => "Missing data.",
                "status" => "info"
            );
        }

        return json_encode($aData);
    }
}
