<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Tipo_adicional_servicio{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar regiustro
public function insertar($descripcion,$estado,$id_usuario_modifica,$fecha_modifica){
	$sql="INSERT INTO tipo_adicional_servicio (descripcion,estado,id_usuario_modifica,fecha_modifica) VALUES ('$descripcion','$estado','$id_usuario_modifica','$fecha_modifica')";
	return ejecutarConsulta($sql);
}

public function editar($id,$descripcion,$estado,$id_usuario_modifica,$fecha_modifica){
	$sql="UPDATE tipo_adicional_servicio SET descripcion='$descripcion',estado='$estado',id_usuario_modifica='$id_usuario_modifica',fecha_modifica='$fecha_modifica' 
	WHERE id='$id'";
	return ejecutarConsulta($sql);
}
public function desactivar($id){
	$sql="UPDATE tipo_adicional_servicio SET estado='INA' WHERE id='$id'";
	return ejecutarConsulta($sql);
}
public function activar($id){
	$sql="UPDATE tipo_adicional_servicio SET estado='ACT' WHERE id='$id'";
	return ejecutarConsulta($sql);
}

//metodo para mostrar registros
public function mostrar($id){
	$sql="SELECT * FROM tipo_adicional_servicio WHERE id='$id'";
	return ejecutarConsultaSimpleFila($sql);
}

//listar registros
public function listar(){
	$sql="SELECT * FROM tipo_adicional_servicio";
	return ejecutarConsulta($sql);
}

public function select(){
	$sql="SELECT * FROM tipo_adicional_servicio WHERE estado='ACT'";
	return ejecutarConsulta($sql);
}

}

 ?>
