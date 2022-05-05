<?php

namespace App\Http\Controllers;

use App\Models\Legajo\Cliente;
use Exception;
use Illuminate\Http\Request;

class ControladorCliente extends Controller
{
    public function editar(Request $request)
    {
        header('Access-Control-Allow-Origin: http://localhost:3000');

        $aData = array();

        if ($request->filled("id")) {
            try {
                $cliente = new Cliente();
                $cliente->obtenerPorId($request->input("id"));

                if (!empty($cliente->id)) {
                    $aData = array(
                        "code" => 200,
                        "body" => $cliente,
                        "msg" => "Cliente obtenido con éxito.",
                        "status" => "danger"
                    );
                } else {
                    $aData = array(
                        "code" => 400,
                        "msg" => "Cliente inexistente.",
                        "status" => "danger"
                    );
                }
            } catch (Exception $e) {
                $aData = array(
                    "code" => 500,
                    "msg" => $e->getMessage(),
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

        return json_encode($aData);
    }

    public function guardar(Request $request)
    {
        header('Access-Control-Allow-Origin: http://localhost:3000');

        $aData = array();

        if ($request->filled("nombre") && $request->filled("email") && $request->filled("documento")) {
            $cliente = new Cliente();
            $cliente->cargarDesdeRequest($request);

            try {
                if ($request->filled("id") && $request->input("id") > 0) {

                    $cliente->guardar();

                    $aData = array(
                        "code" => 200,
                        "msg" => "El cliente ha sido guardado correctamente.",
                        "status" => "success"
                    );
                } else {
                    $_cliente = new Cliente();
                    $_cliente->obtenerPorDni($cliente->documento);

                    $__cliente = new Cliente();
                    $__cliente->obtenerPorEmail($cliente->email);

                    if (isset($_cliente->id) || isset($__cliente->id)) {
                        $aData = array(
                            "code" => 400,
                            "msg" => "El documento o email que intenta ingresar ya se encuentran asociado a otro cliente.",
                            "status" => "warning"
                        );
                    } else {
                        $cliente->insertar();

                        $aData = array(
                            "code" => 200,
                            "msg" => "Cliente insertado con éxito.",
                            "status" => "success"
                        );
                    }
                }
            } catch (Exception $e) {
                $aData = array(
                    "code" => 500,
                    "msg" => "Error interno del servidor [" . $e->getMessage() . "]",
                    "status" => "danger"
                );
            }
        } else {
            $aData = array(
                "code" => 500,
                "msg" => "Complete los campos obligatorios antes de continuar.",
                "status" => "danger"
            );
        }

        return json_encode($aData);
    }

    public function cargarGrilla(Request $request)
    {
        header('Access-Control-Allow-Origin: http://localhost:3000');

        $aData = array();

        try {
            $cliente = new Cliente();
            $aClientes = $cliente->obtenerTodos();

            $aData = array(
                "code" => 200,
                "body" => $aClientes,
                "msg" => "Clientes obtenidos con éxito.",
                "status" => "danger"
            );
        } catch (Exception $e) {
            $aData = array(
                "code" => 500,
                "msg" => $e->getMessage(),
                "status" => "danger"
            );
        }

        return json_encode($aData);
    }
}
