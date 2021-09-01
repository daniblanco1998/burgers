<?php

namespace App\Entidades;
use DB;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model{
    protected $table = 'clientes';
    public $timestamps = false;

    protected $fillable = [
        'idcliente', 'nombre', 'apellido', 'telefono', 'correo', 'fk_idusuario', 

    ];

    protected $hidden = [

    ];

    //search
    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'A.idcliente',
            1 => 'A.nombre', 
            2 => 'A.apellido',
            3 => 'A.telefono',
            4 => 'A.correo',
            5 => 'A.fk_idusuario',
            6 => 'B.usuario' 

        );
        $sql = "SELECT DISTINCT
                    A.idcliente, 
                    A.nombre,
                    A.apellido,
                    A.telefono,
                    A.correo,
                    A.fk_idusuario,
                    B.usuario 
                    FROM clientes A
                    LEFT JOIN sistema_usuarios B ON A.fk_idusuario = B.idusuario
                WHERE 1=1
                "; 

        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND ( A.nombre LIKE '%" . $request['search']['value'] . "%' " ;
            $sql .= " OR A.apellido LIKE '%" . $request['search']['value'] . "%' " ;
            $sql .= " OR A.telefono LIKE '%" . $request['search']['value'] . "%' " ;
            $sql .= " OR A.correo LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR B.usuario LIKE '%" . $request['search']['value'] . "%') ";
            $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];
        }

     

        $lstRetorno = DB::select($sql);

        return $lstRetorno;

   }// end obtener por filtrado


    public function obtenerTodos()
    {
        $sql = "SELECT
                    A.idcliente, 
                    A.nombre,
                    A.apellido,
                    A.telefono,
                    A.correo,
                    A.fk_idusuario,
                    B.usuario
                  FROM clientes A
                  LEFT JOIN sistema_usuarios B ON A.fk_idusuario = B.idusuario
                
                
                ";

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }

    public function obtenerPorId($idcliente)
    {
          $sql = "SELECT
                    A.idcliente, 
                    A.nombre,
                    A.apellido,
                    A.telefono,
                    A.correo,
                    A.fk_idusuario,
                    B.usuario
                FROM clientes A
                  LEFT JOIN sistema_usuarios B ON A.fk_idusuario = B.idusuario

                ";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idcliente = $lstRetorno[0]->idcliente;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->apellido = $lstRetorno[0]->apellido;
            $this->telefono = $lstRetorno[0]->telefono;
            $this->correo = $lstRetorno[0]->correo;
            $this->fk_idusuario = $lstRetorno[0]->fk_idusuario;
            $this->usuario= $lstRetorno[0]->usuario;
            return $this;
        }
        return null;
    }

    public function nuevo()
    {
        $sql = "INSERT INTO clientes (
                nombre,
                apellido,
                telefono,
                correo,
                fk_idusuario 
            ) VALUES (?, ?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->nombre,
            $this->apellido,
            $this->telefono,
            $this->correo,
            $this->fk_idusuario
        ]);
        return $this->idcliente = DB::getPdo()->lastInsertId();
    }

    public function eliminar()
    {
        $sql = "DELETE FROM clientes WHERE
            idcliente=?";
        $affected = DB::delete($sql, [$this->idcliente]);
    }

      public function insertar()
    {

        

        $sql = "INSERT INTO clientes (
                    
                    nombre,
                    apellido,
                    telefono,
                    correo,
                    fk_idusuario

             ) 

                VALUES (?, ?, ?, ?, ?); "; 
        $result = DB::insert($sql, [
           
            $this->nombre,
            $this->apellido,
            $this->telefono,
            $this->correo,
            $this->fk_idusuario

        ]);
        return $this->idcliente = DB::getPdo()->lastInsertId();
    }

    public function guardar() {
        $sql = "UPDATE clientes SET
           
            nombre='$this->nombre',
            apellido='$this->apellido',
            telefono='$this->telefono',
            correo='$this->correo',
            fk_idusuario=$this->fk_idusuario
            WHERE idcliente=?";

        $affected = DB::update($sql, [$this->idcliente]);
    }


    

    public function cargarDesdeRequest($request) {
    $this->idcliente = $request->input('id') != "0" ? $request->input('id') : $this->idcliente;
    $this->nombre = $request->input('txtNombre');
    $this->apellido = $request->input('txtApellido');
    $this->telefono = $request->input('txtTelefono');
    $this->correo = $request->input('txtCorreo');
    $this->fk_idusuario = $request->input('listUsuario');  

    } 
    
    public function encriptarClave($clave){
        $claveEncriptada = password_hash($clave, PASSWORD_DEFAULT);
        return $claveEncriptada;
    }
 
    public function verificarClave($claveIngresada, $claveEnBBDD){
        return password_verify($claveIngresada, $claveEnBBDD);
    }
 

} 
?>

