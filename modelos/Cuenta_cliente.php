<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Cuenta_cliente{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar regiustro
public function insertar($cliente_id,$descripcion,$estado,$id_usuario_modifica,$fecha_modifica){
	$sql="INSERT INTO cuenta_cliente (cliente_id,descripcion,estado,id_usuario_modifica,fecha_modifica)
	 VALUES ('$cliente_id','$descripcion','$estado','$id_usuario_modifica','$fecha_modifica')";
	return ejecutarConsulta($sql);
}

public function editar($id,$cliente_id,$descripcion,$estado,$id_usuario_modifica,$fecha_modifica){
	$sql="UPDATE cuenta_cliente 
	SET cliente_id='$cliente_id',descripcion='$descripcion', 
	estado='$estado',id_usuario_modifica='$id_usuario_modifica',fecha_modifica='$fecha_modifica'
	WHERE id='$id'";
	return ejecutarConsulta($sql);
}
public function desactivar($id){
	$sql="UPDATE cuenta_cliente SET estado='INA' WHERE id='$id'";
	return ejecutarConsulta($sql);
}
public function activar($id){
	$sql="UPDATE cuenta_cliente SET estado='ACT' WHERE id='$id'";
	return ejecutarConsulta($sql);
}

//metodo para mostrar registros
public function mostrar($id){
	$sql="SELECT * FROM cuenta_cliente WHERE id='$id'";
	return ejecutarConsultaSimpleFila($sql);
}

//listar registros 
public function listar(){
	$sql="SELECT cc.id,c.razon_social as cliente,cc.descripcion,cc.estado FROM cuenta_cliente cc INNER JOIN cliente c ON cc.cliente_id=c.id ";
	return ejecutarConsulta($sql);
}

//listar y mostrar en selct
public function select(){
	$sql="SELECT * FROM cuenta_cliente WHERE estado='ACT'";
	return ejecutarConsulta($sql);
}

public function cuentasCientesID($idcliente){
	$sql="SELECT * FROM cuenta_cliente WHERE estado='ACT' AND cliente_id='$idcliente'";
	return ejecutarConsulta($sql);
}

}
 ?>
