<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Almacen_cliente{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar regiustro
public function insertar($cliente_id,$descripcion,$direccion,$estado,$id_usuario_modifica,$fecha_modifica){
	$sql="INSERT INTO almacen_cliente (cliente_id,descripcion,direccion,estado,id_usuario_modifica,fecha_modifica)
	 VALUES ('$cliente_id','$descripcion','$direccion','$estado','$id_usuario_modifica','$fecha_modifica')";
	return ejecutarConsulta($sql);
}

public function editar($id,$cliente_id,$descripcion,$direccion,$estado,$id_usuario_modifica,$fecha_modifica){
	$sql="UPDATE almacen_cliente 
	SET cliente_id='$cliente_id',descripcion='$descripcion',direccion='$direccion', 
	estado='$estado',id_usuario_modifica='$id_usuario_modifica',fecha_modifica='$fecha_modifica'
	WHERE id='$id'";
	return ejecutarConsulta($sql);
}
public function desactivar($id){
	$sql="UPDATE almacen_cliente SET estado='INA' WHERE id='$id'";
	return ejecutarConsulta($sql);
}
public function activar($id){
	$sql="UPDATE almacen_cliente SET estado='ACT' WHERE id='$id'";
	return ejecutarConsulta($sql);
}

//metodo para mostrar registros
public function mostrar($id){
	$sql="SELECT * FROM almacen_cliente WHERE id='$id'";
	return ejecutarConsultaSimpleFila($sql);
}

//listar registros 
public function listar(){
	$sql="SELECT zc.id,c.razon_social as cliente,zc.descripcion,zc.direccion,zc.estado FROM almacen_cliente zc INNER JOIN cliente c ON zc.cliente_id=c.id ";
	return ejecutarConsulta($sql);
}

//listar registros activos
public function listarActivos(){
	$sql="SELECT zc.id,c.razon_social as cliente,zc.descripcion,zc.direccion,zc.estado FROM almacen_cliente zc INNER JOIN cliente c ON zc.cliente_id=c.id  WHERE zc.estado='ACT'";
	return ejecutarConsulta($sql);
}

//listar y mostrar en selct
public function select(){
	$sql="SELECT * FROM almacen_cliente WHERE estado='ACT'";	
		return ejecutarConsulta($sql);
}

public function almacenCientesID($idcliente){
	$sql="SELECT * FROM almacen_cliente WHERE estado='ACT' AND cliente_id='$idcliente'";
	return ejecutarConsulta($sql);
}

}
 ?>
