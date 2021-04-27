<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Cliente{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar regiustro
public function insertar($activida_economica_id,$tipo_identificacion,$identificacion,$razon_social,$tipo_negocio,$direccion,$correo_electronico,$telefono,$id_usuario_asociado,$estado,$id_usuario_modifica,$fecha_modifica){
	$sql="INSERT INTO cliente (activida_economica_id,tipo_identificacion,identificacion,razon_social,tipo_negocio,direccion,correo_electronico,telefono,id_usuario_asociado,estado,id_usuario_modifica,fecha_modifica)
	 VALUES ('$activida_economica_id','$tipo_identificacion','$identificacion','$razon_social','$tipo_negocio','$direccion','$correo_electronico','$telefono','$id_usuario_asociado','$estado','$id_usuario_modifica','$fecha_modifica')";
	return ejecutarConsulta($sql);
}

public function editar($id,$activida_economica_id,$tipo_identificacion,$identificacion,$razon_social,$tipo_negocio,$direccion,$correo_electronico,$telefono,$id_usuario_asociado,$estado,$id_usuario_modifica,$fecha_modifica){
	$sql="UPDATE cliente 
	SET activida_economica_id='$activida_economica_id',tipo_identificacion='$tipo_identificacion', 
	identificacion='$identificacion',razon_social='$razon_social',tipo_negocio='$tipo_negocio',
	direccion='$direccion',correo_electronico='$correo_electronico',telefono='$telefono',id_usuario_asociado='$id_usuario_asociado',
	estado='$estado',id_usuario_modifica='$id_usuario_modifica',fecha_modifica='$fecha_modifica'
	WHERE id='$id'";
	return ejecutarConsulta($sql);
}
public function desactivar($id){
	$sql="UPDATE cliente SET estado='DES' WHERE id='$id'";
	return ejecutarConsulta($sql);
}
public function activar($id){
	$sql="UPDATE cliente SET estado='ACT' WHERE id='$id'";
	return ejecutarConsulta($sql);
}

//metodo para mostrar registros
public function mostrar($id){
	$sql="SELECT * FROM cliente WHERE id='$id'";
	return ejecutarConsultaSimpleFila($sql);
}

//listar registros 
public function listar(){
	$sql="SELECT c.id,c.tipo_identificacion,c.identificacion,c.razon_social,ae.descripcion as actividad_economica,
	CASE c.tipo_negocio WHEN 'NAC' THEN 'NACIONAL' WHEN 'EXP' THEN 'EXPORTACION' WHEN 'IMP' THEN 'IMPORTACION' WHEN 'OTR' THEN 'OTRO' END tipo_negocio, c.direccion,c.correo_electronico,c.telefono,c.id_usuario_asociado,c.estado 
	FROM cliente c INNER JOIN actividad_economica ae ON c.actividad_economica_id=ae.id ";
	return ejecutarConsulta($sql);
}

//listar y mostrar en selct
public function select(){
	$sql="SELECT * FROM cliente WHERE estado='ACT'";
	return ejecutarConsulta($sql);
}


}
 ?>
