<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Vehiculo{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar regiustro
public function insertar($tipo_vehiculo_id,$marca,$modelo,$placa,$tipo_propietario,$fecha_vencimiento_soat,$fecha_vencimiento_inspeccion,$fecha_vencimiento_poliza,$gps_activo,$operador_gps,$estado,$id_usuario_modifica,$fecha_modifica){
	$sql="INSERT INTO vehiculo (tipo_vehiculo_id,marca,modelo,placa,tipo_propietario,fecha_vencimiento_soat,fecha_vencimiento_inspeccion,fecha_vencimiento_poliza,gps_activo,operador_gps,estado,id_usuario_modifica,fecha_modifica)
	 VALUES ('$tipo_vehiculo_id','$marca','$modelo','$placa','$tipo_propietario','$fecha_vencimiento_soat','$fecha_vencimiento_inspeccion','$fecha_vencimiento_poliza','$gps_activo','$operador_gps','$estado','$id_usuario_modifica','$fecha_modifica')";
	return ejecutarConsulta($sql);
}

public function editar($id,$tipo_vehiculo_id,$marca,$modelo,$placa,$tipo_propietario,$fecha_vencimiento_soat,$fecha_vencimiento_inspeccion,$fecha_vencimiento_poliza,$gps_activo,$operador_gps,$estado,$id_usuario_modifica,$fecha_modifica){
	$sql="UPDATE vehiculo 
	SET tipo_vehiculo_id='$tipo_vehiculo_id',marca='$marca',modelo='$modelo',placa='$placa',
	tipo_propietario='$tipo_propietario',fecha_vencimiento_soat='$fecha_vencimiento_soat',
	fecha_vencimiento_inspeccion='$fecha_vencimiento_inspeccion',fecha_vencimiento_poliza='$fecha_vencimiento_poliza',gps_activo='$gps_activo',operador_gps='$operador_gps',
	estado='$estado',id_usuario_modifica='$id_usuario_modifica',fecha_modifica='$fecha_modifica'
	WHERE id='$id'";
	return ejecutarConsulta($sql);
}
public function desactivar($id){
	$sql="UPDATE vehiculo SET estado='INA' WHERE id='$id'";
	return ejecutarConsulta($sql);
}
public function activar($id){
	$sql="UPDATE vehiculo SET estado='ACT' WHERE id='$id'";
	return ejecutarConsulta($sql);
}

//metodo para mostrar registros
public function mostrar($id){
	$sql="SELECT * FROM vehiculo WHERE id='$id'";
	return ejecutarConsultaSimpleFila($sql);
}

//listar registros 
public function listar(){
	$sql="SELECT v.id,tv.descripcion as tipo_vehiculo,v.marca,v.modelo,v.placa,
	CASE v.tipo_propietario WHEN 'PRO' THEN 'PROPIO' WHEN 'LEA' THEN 'LEASING' WHEN 'OTR' THEN 'OTRO' end as tipo_propietario,v.fecha_vencimiento_soat,
		v.fecha_vencimiento_inspeccion,v.fecha_vencimiento_poliza,
		CASE v.gps_activo WHEN 'S' THEN 'SI' ELSE 'NO' END AS gps_activo 
		,v.operador_gps,v.estado 
		FROM vehiculo v 
		INNER JOIN tipo_vehiculo tv ON v.tipo_vehiculo_id=tv.id";
	return ejecutarConsulta($sql);
}

public function marcaTipoVehiculo($idtipovehiculo){
	$sql="SELECT * FROM vehiculo WHERE estado='ACT' AND tipo_vehiculo_id='$idtipovehiculo'";
	return ejecutarConsulta($sql);
}
}
