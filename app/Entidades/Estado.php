<?php
namespace App\Entidades;

use DB;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{ 
    protected $table = 'estados';
    public $timestamps = false;

    protected $fillable = [
     'idestado' , 'nombre'
    ];

    protected $hidden = [

    ];

    public function obtenerTodos()
    {
        $sql = "SELECT
                    idestado,
                    nombre
                FROM estados ORDER BY nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }
    public function obtenerPorId($idestado)
    {
        $sql = "SELECT
                nombre,
                idestado
                FROM estados WHERE idestado = $idestado";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idestado = $lstRetorno[0]->idestado;
            $this->nombre = $lstRetorno[0]->nombre;
            return $this;
        }
        return null;
    }

    public function guardar() {
        $sql = "UPDATE estados SET
            idestado='$this->idestado',
            nombre='$this->nombre'
            WHERE idestado=?";
        $affected = DB::update($sql, [$this->idestado]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM estados WHERE
            idestado=?";
        $affected = DB::delete($sql, [$this->idestado]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO estados (
                idestado,
                nombre
            ) VALUES (?, ?);";
        $result = DB::insert($sql, [
            $this->idestado,
            $this->nombre
        ]);
        return $this->idestado = DB::getPdo()->lastInsertId();
    }
}