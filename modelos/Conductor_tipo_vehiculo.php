<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Conductor_tipo_vehiculo{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar regiustro
public function insertar($conductor_id,$tipo_vehiculo_id,$estado,$id_usuario_modifica,$fecha_modifica){
	$sql="INSERT INTO conductor_tipo_vehiculo (conductor_id,tipo_vehiculo_id,estado,id_usuario_modifica,fecha_modifica)
	 VALUES ('$conductor_id','$tipo_vehiculo_id','$estado','$id_usuario_modifica','$fecha_modifica')";
	return ejecutarConsulta($sql);
}

public function editar($id,$conductor_id,$tipo_vehiculo_id,$estado,$id_usuario_modifica,$fecha_modifica){
	$sql="UPDATE conductor_tipo_vehiculo 
	SET conductor_id='$conductor_id',tipo_vehiculo_id='$tipo_vehiculo_id', 
	estado='$estado',id_usuario_modifica='$id_usuario_modifica',fecha_modifica='$fecha_modifica'
	WHERE id='$id'";
	return ejecutarConsulta($sql);
}
public function desactivar($id){
	$sql="UPDATE conductor_tipo_vehiculo SET estado='INA' WHERE id='$id'";
	return ejecutarConsulta($sql);
}
public function activar($id){
	$sql="UPDATE conductor_tipo_vehiculo SET estado='ACT' WHERE id='$id'";
	return ejecutarConsulta($sql);
}

//metodo para mostrar registros
public function mostrar($id){
	$sql="SELECT * FROM conductor_tipo_vehiculo WHERE id='$id'";
	return ejecutarConsultaSimpleFila($sql);
}

//listar registros 
public function listar(){
	$sql="SELECT ctv.id,c.nombre as conductor,tv.descripcion as tipo_vehiculo,ctv.estado 
	FROM conductor_tipo_vehiculo ctv 
	INNER JOIN conductor c ON ctv.conductor_id=c.id
	INNER JOIN tipo_vehiculo tv ON ctv.tipo_vehiculo_id=tv.id ";
	return ejecutarConsulta($sql);
}

//listar registros activos
public function listarActivos(){
	$sql="SELECT ctv.id,c.nombre as conductor,tv.descripcion as tipo_vehiculo,ctv.estado 
	FROM conductor_tipo_vehiculo ctv 
	INNER JOIN conductor c ON ctv.conductor_id=c.id
	INNER JOIN tipo_vehiculo tv ON ctv.tipo_vehiculo_id=tv.id   WHERE ctv.estado='ACT'";
	return ejecutarConsulta($sql);
}

}
 ?>
