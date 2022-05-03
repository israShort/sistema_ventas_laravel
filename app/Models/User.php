<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class User
{
    private $table = "sistema_usuarios";

    protected $fillable = [
        'id_usuario',
        'usuario',
        'mail',
        'nombre',
        'apellido',
        'clave',
        'created_at',
        'last_logged_in'
    ];

    public function insertar()
    {
        $sql = "INSERT INTO {$this->table} ( usuario, mail, nombre, apellido, clave, created_at )
                VALUES
                    (
                        ?,
                        ?,
                        ?,
                        ?,
                        ?,
                        ?
                    )";

        DB::insert($sql, [
            $this->usuario,
            $this->mail,
            $this->nombre,
            $this->apellido,
            password_hash($this->clave, PASSWORD_DEFAULT),
            date('Y-m-d H:i:s')
        ]);

        return $this->idUsuario = DB::getPdo()->lastInsertId();
    }

    public function obtenerPorId($idUsuario)
    {
        $sql = "SELECT
                    id_usuario,
                    usuario,
                    mail,
                    nombre,
                    apellido,
                    clave,
                    created_at,
                    last_logged_in
                FROM
                    {$this->table}
                WHERE
                    id_usuario = ?";

        $result = DB::select($sql, [$idUsuario]);
        if (count($result) > 0) {
            $this->idUsuario = $result[0]->id_usuario;
            $this->usuario = $result[0]->usuario;
            $this->mail = $result[0]->mail;
            $this->nombre = $result[0]->nombre;
            $this->apellido = $result[0]->apellido;
            $this->clave = $result[0]->clave;
            $this->createdAt = $result[0]->created_at;
            $this->lastLoggedIn = $result[0]->last_logged_in;
            return $this;
        }
        return null;
    }

    public function obtenerPorUsuario($user)
    {
        $sql = "SELECT
                    id_usuario,
                    usuario,
                    mail,
                    nombre,
                    apellido,
                    clave,
                    created_at,
                    last_logged_in
                FROM
                    {$this->table}
                WHERE
                    usuario = ?";

        $result = DB::select($sql, [$user]);
        if (count($result) > 0) {
            $this->idUsuario = $result[0]->id_usuario;
            $this->usuario = $result[0]->usuario;
            $this->mail = $result[0]->mail;
            $this->nombre = $result[0]->nombre;
            $this->apellido = $result[0]->apellido;
            $this->clave = $result[0]->clave;
            $this->createdAt = $result[0]->created_at;
            $this->lastLoggedIn = $result[0]->last_logged_in;
            return $this;
        }
        return null;
    }

    public function updateLastLogged()
    {
        $sql = "UPDATE sistema_usuarios 
                SET last_logged_in = ? 
                WHERE
                    id_usuario = ?";

        DB::update($sql, [
            $this->lastLoggedIn,
            $this->idUsuario
        ]);
    }

    public function verificarClaveAlmacenada($clave, $claveAlmacenada)
    {
        return password_verify($clave, $claveAlmacenada);
    }

    public function updateClave($idUsuario, $clave)
    {
        $sql = "UPDATE {$this->table}
                SET
                    clave = ?
                WHERE
                    id_usuario = ?";

        DB::update($sql, [
            password_hash($clave, PASSWORD_DEFAULT),
            $idUsuario
        ]);
    }
}
