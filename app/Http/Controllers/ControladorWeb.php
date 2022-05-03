<?php

namespace App\Http\Controllers;

use App\Models\Sistema\Menu;
use Exception;
use Illuminate\Http\Request;

class ControladorWeb extends Controller
{
    public function obtenerMenu(Request $request)
    {
        header('Access-Control-Allow-Origin: http://localhost:3000');

        $aData = array();

        try {
            $menu = new Menu();
            $aMenu = $menu->obtenerPrincipales();
            $aSubMenu = $menu->obtenerHijos();

            $aData = array(
                "code" => 200,
                "menu" => $aMenu,
                "submenu" => $aSubMenu
            );
        } catch (Exception $e) {
            $aData = array(
                "code" => 500,
                "body" => array(),
                "msg" => $e->getMessage()
            );
        }

        return json_encode($aData);
    }
}
