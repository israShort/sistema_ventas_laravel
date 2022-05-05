<?php

namespace App\Models\Legajo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cliente extends Model
{

    protected $table = "clientes";

    public function cargarDesdeRequest($request)
    {
        $this->id = $request->input("id") > 0 ? $request->input("id") : $this->id;
        $this->nombre = trim($request->input("nombre"));
        $this->apellido = trim($request->input("apellido"));
        $this->email = trim($request->input("email"));
        $this->documento = trim($request->input("documento"));
        $this->fechaNacimiento = trim($request->input("fecha_nacimiento"));
    }

    public function insertar()
    {
        $sql = "INSERT INTO {$this->table} ( nombre, apellido, email, documento, fecha_nacimiento )
                VALUES ( ?, ?, ?, ?, ? )";

        DB::insert($sql, [
            $this->nombre,
            $this->apellido,
            $this->email,
            $this->documento,
            $this->fechaNacimiento
        ]);

        return $this->id = DB::getPdo()->lastInsertId();
    }

    public function guardar()
    {
        $sql = "UPDATE {$this->table}
                SET
                    nombre = ?,
                    apellido = ?,
                    email = ?,
                    documento = ?,
                    fecha_nacimiento = ?
                WHERE
                    id = ?";

        DB::update($sql, [
            $this->nombre,
            $this->apellido,
            $this->email,
            $this->documento,
            date("Y-m-d"),
            $this->id
        ]);
    }

    public function obtenerPorId($id)
    {
        $sql = "SELECT
                    id,
                    nombre,
                    apellido,
                    email,
                    documento,
                    fecha_nacimiento
                FROM
                    {$this->table}
                WHERE
                    id = ?";

        $result = DB::select($sql, [$id]);

        if (count($result) > 0) {
            $this->id = $result[0]->id;
            $this->nombre = $result[0]->nombre;
            $this->apellido = $result[0]->apellido;
            $this->email = $result[0]->email;
            $this->documento = $result[0]->documento;
            $this->fechaNacimiento = $result[0]->fecha_nacimiento;
            return $this;
        }

        return null;
    }

    public function obtenerPorDni($dni)
    {
        $sql = "SELECT
                    id,
                    nombre,
                    apellido,
                    email,
                    documento,
                    fecha_nacimiento
                FROM
                    {$this->table}
                WHERE
                    documento = ?";

        $result = DB::select($sql, [$dni]);

        if (count($result) > 0) {
            $this->id = $result[0]->id;
            $this->nombre = $result[0]->nombre;
            $this->apellido = $result[0]->apellido;
            $this->email = $result[0]->email;
            $this->documento = $result[0]->documento;
            $this->fechaNacimiento = $result[0]->fecha_nacimiento;
            return $this;
        }

        return null;
    }

    public function obtenerPorEmail($email)
    {
        $sql = "SELECT
                    id,
                    nombre,
                    apellido,
                    email,
                    documento,
                    fecha_nacimiento
                FROM
                    {$this->table}
                WHERE
                    email = ?";

        $result = DB::select($sql, [$email]);

        if (count($result) > 0) {
            $this->id = $result[0]->id;
            $this->nombre = $result[0]->nombre;
            $this->apellido = $result[0]->apellido;
            $this->email = $result[0]->email;
            $this->documento = $result[0]->documento;
            $this->fechaNacimiento = $result[0]->fecha_nacimiento;
            return $this;
        }

        return null;
    }

    public function obtenerTodos()
    {
        $sql = "SELECT
                    id,
                    CONCAT_WS( ' ', nombre, apellido ) AS `name`,
                    documento AS `doc`,
                    email AS mail
                FROM
                    {$this->table}
                ORDER BY
                    id ASC";

        return DB::select($sql);
    }
}
