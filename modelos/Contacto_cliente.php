<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Contacto_cliente{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar regiustro
public function insertar($cliente_id,$tipo_identificacion,$identificacion,$nombre,$direccion,$correo_electronico,$telefono,$estado,$id_usuario_modifica,$fecha_modifica){
	$sql="INSERT INTO contacto_cliente (cliente_id,tipo_identificacion,identificacion,nombre,direccion,correo_electronico,telefono,estado,id_usuario_modifica,fecha_modifica)
	 VALUES ('$cliente_id','$tipo_identificacion','$identificacion','$nombre','$direccion','$correo_electronico','$telefono','$estado','$id_usuario_modifica','$fecha_modifica')";
	return ejecutarConsulta($sql);
}

public function editar($id,$cliente_id,$tipo_identificacion,$identificacion,$nombre,$direccion,$correo_electronico,$telefono,$estado,$id_usuario_modifica,$fecha_modifica){
	$sql="UPDATE contacto_cliente 
	SET cliente_id='$cliente_id',tipo_identificacion='$tipo_identificacion', 
	identificacion='$identificacion',nombre='$nombre',
	direccion='$direccion',correo_electronico='$correo_electronico',telefono='$telefono',
	estado='$estado',id_usuario_modifica='$id_usuario_modifica',fecha_modifica='$fecha_modifica'
	WHERE id='$id'";
	return ejecutarConsulta($sql);
}
public function desactivar($id){
	$sql="UPDATE contacto_cliente SET estado='INA' WHERE id='$id'";
	return ejecutarConsulta($sql);
}
public function activar($id){
	$sql="UPDATE contacto_cliente SET estado='ACT' WHERE id='$id'";
	return ejecutarConsulta($sql);
}

//metodo para mostrar registros
public function mostrar($id){
	$sql="SELECT * FROM contacto_cliente WHERE id='$id'";
	return ejecutarConsultaSimpleFila($sql);
}

//listar registros 
public function listar(){
	$sql="SELECT cc.id,c.razon_social as cliente,cc.tipo_identificacion,
	cc.identificacion,cc.nombre,cc.direccion,cc.correo_electronico,cc.telefono,cc.estado FROM contacto_cliente cc INNER JOIN cliente c ON cc.cliente_id=c.id ";
	return ejecutarConsulta($sql);
}
//listar y mostrar en selct
public function select(){
	$sql="SELECT * FROM contacto_cliente WHERE estado='ACT'";
	return ejecutarConsulta($sql);
}
public function contactosCientesID($idcliente){
	$sql="SELECT * FROM contacto_cliente WHERE estado='ACT' AND cliente_id='$idcliente'";
	return ejecutarConsulta($sql);
}
}
 ?>
