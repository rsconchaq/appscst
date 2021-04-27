<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Cotizacion{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar regiustro
public function insertar($contacto_cliente_id,$cuenta_cliente_id,$cliente_id,$codigo,$id_usuario_registra,$id_usuario_aprueba,$fecha_registra,$fecha_aprueba,$comentario,$fecha_vigencia_desde,$fecha_vigencia_hasta,$moneda_cotizacion,$estado,$fecha_modifica){
	$sql="INSERT INTO cotizacion (contacto_cliente_id,cuenta_cliente_id,cliente_id,codigo,id_usuario_registra,id_usuario_aprueba,fecha_registra,fecha_aprueba,comentario,fecha_vigencia_desde,fecha_vigencia_hasta,moneda_cotizacion,estado,fecha_modifica)
	 VALUES ('$contacto_cliente_id','$cuenta_cliente_id','$cliente_id',GenerarCotizacion(),'$id_usuario_registra','$id_usuario_aprueba','$fecha_registra','$fecha_aprueba','$comentario','$fecha_vigencia_desde','$fecha_vigencia_hasta','$moneda_cotizacion','$estado','$fecha_modifica')";
	return ejecutarConsulta_retornarID($sql);
}

public function editar($idcoti,$cuenta_cliente_id,$contacto_cliente_id,$fecha_vigencia_desde,$fecha_vigencia_hasta,$id_usuario_aprueba,$fecha_aprueba,$estado,$id_usuario_modifica,$fecha_modifica){
	$sql="UPDATE cotizacion 
	SET contacto_cliente_id='$contacto_cliente_id', 
	cuenta_cliente_id='$cuenta_cliente_id',id_usuario_aprueba='$id_usuario_aprueba',fecha_aprueba='$fecha_aprueba',
	fecha_vigencia_desde='$fecha_vigencia_desde',fecha_vigencia_hasta='$fecha_vigencia_hasta',
	estado='$estado',fecha_modifica='$fecha_modifica',id_usuario_modifica='$id_usuario_modifica'
	WHERE id='$idcoti'";
	return ejecutarConsulta($sql);
}
public function insertarDet($tipo_vehiculo_id,$cotizacion_id,$cliente_id,$cuenta_cliente_id,$almacen_cliente_id,$tipo_alcance_servicio,$tipo_destino,$destino,$zona_cliente_id,$moneda_tarifa,
$tarifa,$tarifa_adicional_1,$tarifa_adicional_2,$tarifa_adicional_3,$tarifa_adicional_4,$tarifa_adicional_5,$descripcion_tarifa_adicional_1,$descripcion_tarifa_adicional_2,
$descripcion_tarifa_adicional_3,$descripcion_tarifa_adicional_4,$descripcion_tarifa_adicional_5,$unidad_tiempo_atencion,$tiempo_atencion_minimo,$tiempo_atencion_maximo,
$unidad_peso,$peso_minimo,$peso_maximo,$unidad_volumen,$volumen_minimo,$volumen_maximo,$moneda_valor_mercaderia,$valor_mercaderia_maximo,$valor_mercaderia_minimo,
$capacidad_vehiculo,$volumen_vehiculo,$comentario,$estado,$id_usuario_modifica,$fecha_modifica){
	$sql="INSERT INTO detalle_cotizacion (tipo_vehiculo_id, cotizacion_id, cliente_id, cuenta_cliente_id, almacen_cliente_id, tipo_alcance_servicio, tipo_destino, destino, zona_cliente_id, moneda_tarifa, tarifa, 
	tarifa_adicional_1, tarifa_adicional_2, tarifa_adicional_3, tarifa_adicional_4, tarifa_adicional_5, descripcion_tarifa_adicional_1, descripcion_tarifa_adicional_2, descripcion_tarifa_adicional_3, descripcion_tarifa_adicional_4, 
	descripcion_tarifa_adicional_5, unidad_tiempo_atencion, tiempo_atencion_minimo, tiempo_atencion_maximo, unidad_peso, peso_minimo, peso_maximo, unidad_volumen, volumen_minimo, volumen_maximo,
	 moneda_valor_mercaderia, valor_mercaderia_maximo, valor_mercaderia_minimo, capacidad_vehiculo, volumen_vehiculo, comentario, estado, id_usuario_modifica, fecha_modifica)
	 VALUES ('$tipo_vehiculo_id','$cotizacion_id','$cliente_id','$cuenta_cliente_id','$almacen_cliente_id','$tipo_alcance_servicio','$tipo_destino','$destino','$zona_cliente_id','$moneda_tarifa','
$tarifa','$tarifa_adicional_1','$tarifa_adicional_2','$tarifa_adicional_3','$tarifa_adicional_4','$tarifa_adicional_5','$descripcion_tarifa_adicional_1','$descripcion_tarifa_adicional_2','
$descripcion_tarifa_adicional_3','$descripcion_tarifa_adicional_4','$descripcion_tarifa_adicional_5','$unidad_tiempo_atencion','$tiempo_atencion_minimo','$tiempo_atencion_maximo','
$unidad_peso','$peso_minimo','$peso_maximo','$unidad_volumen','$volumen_minimo','$volumen_maximo','$moneda_valor_mercaderia','$valor_mercaderia_maximo','$valor_mercaderia_minimo','
$capacidad_vehiculo','$volumen_vehiculo','$comentario','$estado','$id_usuario_modifica','NOW()')";
	return ejecutarConsulta_retornarID($sql);
}

public function editarDet($idcotiDet,$tipo_vehiculo_id,$cotizacion_id,$cliente_id,$cuenta_cliente_id,$almacen_cliente_id,$tipo_alcance_servicio,$tipo_destino,$destino,$zona_cliente_id,$moneda_tarifa,
$tarifa,$tarifa_adicional_1,$tarifa_adicional_2,$tarifa_adicional_3,$tarifa_adicional_4,$tarifa_adicional_5,$descripcion_tarifa_adicional_1,$descripcion_tarifa_adicional_2,
$descripcion_tarifa_adicional_3,$descripcion_tarifa_adicional_4,$descripcion_tarifa_adicional_5,$unidad_tiempo_atencion,$tiempo_atencion_minimo,$tiempo_atencion_maximo,
$unidad_peso,$peso_minimo,$peso_maximo,$unidad_volumen,$volumen_minimo,$volumen_maximo,$moneda_valor_mercaderia,$valor_mercaderia_maximo,$valor_mercaderia_minimo,
$capacidad_vehiculo,$volumen_vehiculo,$comentario,$estado,$id_usuario_modifica,$fecha_modifica){
	$sql="UPDATE cotizacion 
	SET tipo_vehiculo_id='$tipo_vehiculo_id',cotizacion_id='$cotizacion_id',cliente_id='$cliente_id',cuenta_cliente_id='$cuenta_cliente_id',almacen_cliente_id='$almacen_cliente_id',
tipo_alcance_servicio='$tipo_alcance_servicio',tipo_destino='$tipo_destino',destino='$destino',zona_cliente_id='$zona_cliente_id',moneda_tarifa='$moneda_tarifa',
tarifa='$tarifa',tarifa_adicional_1='$tarifa_adicional_1',tarifa_adicional_2='$tarifa_adicional_2',tarifa_adicional_3='$tarifa_adicional_3',tarifa_adicional_4='$tarifa_adicional_4',
tarifa_adicional_5='$tarifa_adicional_5',descripcion_tarifa_adicional_1='$descripcion_tarifa_adicional_1',descripcion_tarifa_adicional_2='$descripcion_tarifa_adicional_2',
descripcion_tarifa_adicional_3='$descripcion_tarifa_adicional_3',descripcion_tarifa_adicional_4='$descripcion_tarifa_adicional_4',descripcion_tarifa_adicional_5='$descripcion_tarifa_adicional_5',
unidad_tiempo_atencion='$unidad_tiempo_atencion',tiempo_atencion_minimo='$tiempo_atencion_minimo',tiempo_atencion_maximo='$tiempo_atencion_maximo',
unidad_peso='$unidad_peso',peso_minimo='$peso_minimo',peso_maximo='$peso_maximo',unidad_volumen='$unidad_volumen',volumen_minimo='$volumen_minimo',
volumen_maximo='$volumen_maximo',moneda_valor_mercaderia='$moneda_valor_mercaderia',valor_mercaderia_maximo='$valor_mercaderia_maximo',valor_mercaderia_minimo='$valor_mercaderia_minimo',
capacidad_vehiculo='$capacidad_vehiculo',volumen_vehiculo='$volumen_vehiculo',comentario='$comentario',estado='$estado',id_usuario_modifica='$id_usuario_modifica',fecha_modifica='$fecha_modifica'
	WHERE id='$idcotiDet'";
	return ejecutarConsulta($sql);
}
public function desactivar($idcoti){
	$sql="UPDATE cotizacion SET estado='des' WHERE id='$idcoti'";
	return ejecutarConsulta($sql);
}
public function activar($idcoti){
	$sql="UPDATE cotizacion SET estado='act' WHERE id='$idcoti'";
	return ejecutarConsulta($sql);
}

//metodo para mostrar registros
public function mostrar($idcoti){
	$sql="SELECT id, contacto_cliente_id, cuenta_cliente_id, cliente_id, codigo, id_usuario_registra, id_usuario_aprueba, 
	DATE_FORMAT(fecha_registra, '%Y-%m-%d') as fecha_registra, DATE_FORMAT(fecha_aprueba, '%Y-%m-%d') as fecha_aprueba, comentario, fecha_vigencia_desde,
	 fecha_vigencia_hasta, moneda_cotizacion, estado, id_usuario_modifica, DATE_FORMAT(fecha_modifica, '%Y-%m-%d') as fecha_modifica FROM cotizacion WHERE id='$idcoti'";
	return ejecutarConsultaSimpleFila($sql);
}

public function mostrarcoti($idcoti){
	$sql="SELECT cot.cliente_id,cl.razon_social as cliente,cot.cuenta_cliente_id,cu.descripcion as cuenta,cot.contacto_cliente_id,
	co.nombre as contacto,cot.codigo,cot.moneda_cotizacion as moneda
	from cotizacion cot
	inner join cliente cl on cot.cliente_id=cl.id
	inner join cuenta_cliente cu on cot.cuenta_cliente_id=cu.id and cl.id=cu.cliente_id
	inner join contacto_cliente co on cot.contacto_cliente_id=co.id and cl.id=co.cliente_id
	where cot.id='$idcoti'";
	return ejecutarConsultaSimpleFila($sql);
}

public function mostrarcotiDet($idcotiDet){
	$sql=" CALL MostrarCotizacionDetalle($idcotiDet)";
	return ejecutarConsultaSimpleFila($sql);
}

//listar registros 
public function listar($condicion){
	$sql="SELECT co.id,co.codigo,cuc.descripcion as cuenta,coc.nombre as contacto,co.fecha_registra,co.fecha_aprueba,co.fecha_vigencia_hasta,
	CASE co.estado WHEN 'PEN' THEN 'PENDIENTE' WHEN 'APR' THEN 'APROBADO' WHEN 'ANU' THEN 'ANULADO' WHEN 'INA' THEN 'INACTIVO' END estado 
	FROM cotizacion co 
	INNER JOIN cliente c ON co.cliente_id=c.id 
	INNER JOIN cuenta_cliente cuc ON co.cuenta_cliente_id=cuc.id 
	INNER JOIN contacto_cliente coc ON co.contacto_cliente_id=coc.id 
	$condicion";
	return ejecutarConsulta($sql);
}

public function listarCotDet($idcoti){
	$sql=" CALL ListarCotizacionDetalle($idcoti)";
	return ejecutarConsulta($sql);
}

}
 ?>
