<?php

namespace App\Models\Sistema;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UsuarioFamilia extends Model
{
    use HasFactory;

    protected $table = "sistema_familia_usuarios";

    public function obtenerPermisos($idUsuario)
    {
        $sql = "SELECT DISTINCT
                    SP.* 
                FROM
                    sistema_usuarios AS SU
                    INNER JOIN sistema_familia_usuarios AS SFU ON SFU.fk_idusuario = SU.id_usuario
                    INNER JOIN sistema_familia_patentes AS SFP ON SFP.fk_idfamilia = SFU.fk_idfamilia
                    INNER JOIN sistema_patentes AS SP ON SP.id_patente = SFP.fk_idpatente 
                WHERE
                    id_usuario = {$idUsuario}";

        return DB::select($sql);
    }
}
