<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Tipo_vehiculo{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar regiustro
public function insertar($descripcion,$capacidad,$volumen,$estado,$id_usuario_modifica,$fecha_modifica){
	$sql="INSERT INTO tipo_vehiculo (descripcion,capacidad,volumen,estado,id_usuario_modifica,fecha_modifica)
	 VALUES ('$descripcion','$capacidad','$volumen','$estado','$id_usuario_modifica','$fecha_modifica')";
	return ejecutarConsulta($sql);
}

public function editar($id,$descripcion,$capacidad,$volumen,$estado,$id_usuario_modifica,$fecha_modifica){
	$sql="UPDATE tipo_vehiculo 
	SET descripcion='$descripcion',capacidad='$capacidad',volumen='$volumen', 
	estado='$estado',id_usuario_modifica='$id_usuario_modifica',fecha_modifica='$fecha_modifica'
	WHERE id='$id'";
	return ejecutarConsulta($sql);
}

public function desactivar($id){
	$sql="UPDATE tipo_vehiculo SET estado='INA' WHERE id='$id'";
	return ejecutarConsulta($sql);
}

public function activar($id){
	$sql="UPDATE tipo_vehiculo SET estado='ACT' WHERE id='$id'";
	return ejecutarConsulta($sql);
}

//metodo para mostrar registros
public function mostrar($id){
	$sql="SELECT id,descripcion,capacidad,volumen,estado,id_usuario_modifica,fecha_modifica FROM tipo_vehiculo WHERE id='$id'";
	return ejecutarConsultaSimpleFila($sql);
}

public function mostrarCapacidaVol($id){
	$sql="SELECT id,descripcion,capacidad,volumen FROM tipo_vehiculo WHERE id='$id'";
	return ejecutarConsultaSimpleFila($sql);
}

//listar registros 
public function listar(){
	$sql="SELECT tv.id,tv.descripcion,tv.capacidad,tv.volumen,tv.estado FROM tipo_vehiculo tv ";
	return ejecutarConsulta($sql);
}

//listar y mostrar en selct
public function select(){
	$sql="SELECT * FROM tipo_vehiculo WHERE estado='ACT'";
	return ejecutarConsulta($sql);
}
}
 ?>
