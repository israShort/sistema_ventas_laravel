<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControladorSession extends Controller
{
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect("/");
    }
}
