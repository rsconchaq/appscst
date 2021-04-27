<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Conductor{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar regiustro
public function insertar($tipo_identificacion,$identificacion,$nombre,$licencia,$clase_licencia,$fecha_vencimiento_licencia,$fecha_nacimiento,$sctr_pension,$sctr_salud,$carnet_sanidad,$sexo,$direccion,$telefono,$correo_electronico,$id_usuario_asociado,$estado,$id_usuario_modifica,$fecha_modifica){
	$sql="INSERT INTO conductor (tipo_identificacion,identificacion,nombre,licencia,clase_licencia,fecha_vencimiento_licencia,fecha_nacimiento,sctr_pension,sctr_salud,carnet_sanidad,sexo,direccion,telefono,correo_electronico,id_usuario_asociado,estado,id_usuario_modifica,fecha_modifica)
	 VALUES ('$tipo_identificacion','$identificacion','$nombre','$licencia','$clase_licencia','$fecha_vencimiento_licencia','$fecha_nacimiento','$sctr_pension','$sctr_salud','$carnet_sanidad','$sexo','$direccion','$telefono','$correo_electronico','$id_usuario_asociado','$estado','$id_usuario_modifica','$fecha_modifica')";
	return ejecutarConsulta($sql);
}

public function editar($id,$tipo_identificacion,$identificacion,$nombre,$licencia,$clase_licencia,$fecha_vencimiento_licencia,$fecha_nacimiento,$sctr_pension,$sctr_salud,$carnet_sanidad,$sexo,$direccion,$telefono,$correo_electronico,$id_usuario_asociado,$estado,$id_usuario_modifica,$fecha_modifica){
	$sql="UPDATE conductor 
	SET tipo_identificacion='$tipo_identificacion', 
	identificacion='$identificacion',nombre='$nombre',licencia='$licencia',clase_licencia='$clase_licencia',fecha_vencimiento_licencia='$fecha_vencimiento_licencia',fecha_nacimiento='$fecha_nacimiento',sctr_pension='$sctr_pension',sctr_salud='$sctr_salud',
	carnet_sanidad='$carnet_sanidad',sexo='$sexo',direccion='$direccion',telefono='$telefono',correo_electronico='$correo_electronico',
	id_usuario_asociado='$id_usuario_asociado',estado='$estado',id_usuario_modifica='$id_usuario_modifica',fecha_modifica='$fecha_modifica'
	WHERE id='$id'";
	return ejecutarConsulta($sql);
}
public function desactivar($id){
	$sql="UPDATE conductor SET estado='INA' WHERE id='$id'";
	return ejecutarConsulta($sql);
}
public function activar($id){
	$sql="UPDATE conductor SET estado='ACT' WHERE id='$id'";
	return ejecutarConsulta($sql);
}

//metodo para mostrar registros
public function mostrar($id){
	$sql="SELECT * FROM conductor WHERE id='$id'";
	return ejecutarConsultaSimpleFila($sql);
}

//listar registros 
public function listar(){
	$sql="SELECT c.id,
	CASE c.tipo_identificacion WHEN 'DNI' THEN 'DNI' WHEN 'RUC' THEN 'RUC' WHEN 'CEX' THEN 'CARNET EXTRANJERIA' WHEN 'PAS' THEN 'PASAPORTE' WHEN 'OTR' THEN 'OTRO' END  AS tipo_identificacion,
	c.identificacion,c.nombre,c.licencia,c.clase_licencia,c.fecha_vencimiento_licencia,c.id_usuario_asociado,c.estado FROM conductor c ";
	return ejecutarConsulta($sql);
}

//listar y mostrar en selct
public function select(){
	$sql="SELECT * FROM conductor WHERE estado='ACT'";
	return ejecutarConsulta($sql);
}

//Listar conductor por tipo vehiculo
public function selectConductorTipoVehiculo($tipo_vehiculo_id){
	$sql="SELECT cv.conductor_id,c.nombre FROM conductor_tipo_vehiculo cv 
	inner join conductor c on cv.conductor_id=c.id where tipo_vehiculo_id=$tipo_vehiculo_id";
	return ejecutarConsulta($sql);
}


}

 ?>
