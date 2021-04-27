<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Activida_economica{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar regiustro
public function insertar($descripcion,$estado){
	$sql="INSERT INTO actividad_economica (descripcion,estado) VALUES ('$descripcion','$estado')";
	return ejecutarConsulta($sql);
}

public function editar($id,$descripcion,$estado,$id_usuario_modifica,$fecha_modifica){
	$sql="UPDATE actividad_economica SET descripcion='$descripcion',estado='$estado',id_usuario_modifica='$id_usuario_modifica',fecha_modifica='$fecha_modifica' 
	WHERE id='$id'";
	return ejecutarConsulta($sql);
}
public function desactivar($id){
	$sql="UPDATE actividad_economica SET estado='ina' WHERE id='$id'";
	return ejecutarConsulta($sql);
}
public function activar($id){
	$sql="UPDATE actividad_economica SET estado='act' WHERE id='$id'";
	return ejecutarConsulta($sql);
}

//metodo para mostrar registros
public function mostrar($id){
	$sql="SELECT * FROM actividad_economica WHERE id='$id'";
	return ejecutarConsultaSimpleFila($sql);
}

//listar registros
public function listar(){
	$sql="SELECT * FROM actividad_economica";
	return ejecutarConsulta($sql);
}
//listar y mostrar en selct
public function select(){
	$sql="SELECT * FROM actividad_economica WHERE estado='ACT'";
	return ejecutarConsulta($sql);
}
}

 ?>
