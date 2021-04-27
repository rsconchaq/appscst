<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Auxiliar{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar regiustro
public function insertar($tipo_identificacion,$identificacion,$nombre,$fecha_nacimiento,$sexo,$sctr_pension,$sctr_salud,$carnet_sanidad,$direccion,$telefono,$correo_electronico,$estado,$id_usuario_modifica,$fecha_modifica){
	$sql="INSERT INTO auxiliar (tipo_identificacion,identificacion,nombre,fecha_nacimiento,sexo,sctr_pension,sctr_salud,carnet_sanidad,direccion,telefono,correo_electronico,estado,id_usuario_modifica,fecha_modifica)
	 VALUES ('$tipo_identificacion','$identificacion','$nombre','$fecha_nacimiento','$sexo','$sctr_pension','$sctr_salud','$carnet_sanidad','$direccion','$telefono','$correo_electronico','$estado','$id_usuario_modifica','$fecha_modifica')";
	return ejecutarConsulta($sql);
}

public function editar($id,$tipo_identificacion,$identificacion,$nombre,$fecha_nacimiento,$sexo,$sctr_pension,$sctr_salud,$carnet_sanidad,$direccion,$telefono,$correo_electronico,$estado,$id_usuario_modifica,$fecha_modifica){
	$sql="UPDATE auxiliar 
	SET tipo_identificacion='$tipo_identificacion', 
	identificacion='$identificacion',nombre='$nombre',fecha_nacimiento='$fecha_nacimiento',sexo='$sexo',sctr_pension='$sctr_pension',sctr_salud='$sctr_salud',
	carnet_sanidad='$carnet_sanidad',direccion='$direccion',telefono='$telefono',correo_electronico='$correo_electronico',
	estado='$estado',id_usuario_modifica='$id_usuario_modifica',fecha_modifica='$fecha_modifica'
	WHERE id='$id'";
	return ejecutarConsulta($sql);
}
public function desactivar($id){
	$sql="UPDATE auxiliar SET estado='INA' WHERE id='$id'";
	return ejecutarConsulta($sql);
}
public function activar($id){
	$sql="UPDATE auxiliar SET estado='ACT' WHERE id='$id'";
	return ejecutarConsulta($sql);
}

//metodo para mostrar registros
public function mostrar($id){
	$sql="SELECT * FROM auxiliar WHERE id='$id'";
	return ejecutarConsultaSimpleFila($sql);
}

//listar registros 
public function listar(){
	$sql="SELECT a.id, CASE a.tipo_identificacion  WHEN 'DNI' THEN 'DNI' WHEN 'RUC' THEN 'RUC' WHEN 'CEX' THEN 'CARNET EXTRANJERIA' WHEN 'PAS' THEN 'PASAPORTE' WHEN 'OTR' THEN 'OTRO' END  AS tipo_identificacion,
	a.identificacion,a.nombre,a.estado FROM auxiliar a ";
	return ejecutarConsulta($sql);
}

//listar y mostrar en selct
public function select(){
	$sql="SELECT * FROM auxiliar WHERE estado='ACT'";
	return ejecutarConsulta($sql);
}

}

 ?>
