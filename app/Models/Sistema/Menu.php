<?php

namespace App\Models\Sistema;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Menu extends Model
{
    protected $table = "sistema_menues";

    public function obtenerPrincipales()
    {
        $sql = "SELECT
                    id_menu,
                    descr,
                    activo,
                    ruta,
                    icono,
                    fk_idpadre,
                    fk_idarea
                FROM
                    {$this->table}
                WHERE
                    activo = 1
                    AND fk_idpadre IS NULL";

        return DB::select($sql);
    }

    public function obtenerHijos()
    {
        $sql = "SELECT
                    id_menu,
                    descr,
                    activo,
                    ruta,
                    icono,
                    fk_idpadre,
                    fk_idarea
                FROM
                    {$this->table}
                WHERE
                    activo = 1
                    AND fk_idpadre IS NOT NULL";

        return DB::select($sql);
    }
}
