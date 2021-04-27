<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Servicio_urgente{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar registro
public function insertar($cuenta_cliente_id,$contacto_cliente_id,$cliente_id,$fecha_inicio_programado,$fecha_fin_programado,
$moneda_servicio,$estado,$id_usuario_registra,$id_usuario_modifica,$fecha_modifica,
$tipo_vehiculo_id,$almacen_cliente_id,$tipo_alcance_servicio,$tipo_destino,$destino,$zona_cliente_id,$valor_servicio,
$vehiculo_id,$conductor_id,$tipo_material,$fechasalida,$fechacarga,$numero_trafico,$numero_eir,$tipo_flete,$tipo_servicio,$comentario){
	
	$sql="INSERT INTO cotizacion (contacto_cliente_id,cuenta_cliente_id,cliente_id,codigo,id_usuario_registra,fecha_registra,
	fecha_vigencia_desde,fecha_vigencia_hasta,moneda_cotizacion,estado,id_usuario_modifica,fecha_modifica) 
	VALUES ('$contacto_cliente_id','$cuenta_cliente_id','$cliente_id',GenerarCotizacion(),'$id_usuario_registra','$fecha_modifica',
	'$fecha_inicio_programado','$fecha_fin_programado','$moneda_servicio','$estado','$id_usuario_modifica','$fecha_modifica')";
	$idcotinew=ejecutarConsulta_retornarID($sql);

	$sql_cotideta="INSERT INTO detalle_cotizacion (tipo_vehiculo_id, cotizacion_id, cliente_id, cuenta_cliente_id,
	 almacen_cliente_id, tipo_alcance_servicio, tipo_destino, destino, zona_cliente_id, moneda_tarifa, tarifa,estado, id_usuario_modifica, fecha_modifica) 
	VALUES('$tipo_vehiculo_id','$idcotinew','$cliente_id','$cuenta_cliente_id','$almacen_cliente_id','$tipo_alcance_servicio',
	'$tipo_destino','$destino','$zona_cliente_id','$moneda_servicio','$valor_servicio','ACT','$id_usuario_modifica','$fecha_modifica')";
	$idcotidetnew=ejecutarConsulta_retornarID($sql_cotideta);
	   
	$sql_servicio="INSERT INTO servicio (codigo, contacto_cliente_id, tipo_vehiculo_id, vehiculo_id, detalle_cotizacion_id,
	 conductor_id, cotizacion_id, cliente_id, cuenta_cliente_id, almacen_cliente_id, tipo_material, fecha_registro, fecha_inicio_programado,
	  fecha_fin_programado, fecha_salida, fecha_carga, tipo_destino, tipo_alcance_servicio, zona_cliente_id, zona_destino, moneda_servicio, valor_servicio,numero_trafico,
	  numero_eir,tipo_flete,tipo_servicio,comentario,estado,id_usuario_modifica, fecha_modifica) 
	VALUES(GenerarServicio(),'$contacto_cliente_id','$tipo_vehiculo_id','$vehiculo_id','$idcotidetnew','$conductor_id',
	'$idcotinew','$cliente_id','$cuenta_cliente_id','$almacen_cliente_id','$tipo_material','$fecha_modifica','$fecha_inicio_programado','$fecha_fin_programado',
	'$fechasalida','$fechacarga','$tipo_destino','$tipo_alcance_servicio','$zona_cliente_id','$destino','$moneda_servicio','$valor_servicio','$numero_trafico',
	'$numero_eir','$tipo_flete','$tipo_servicio','$comentario','$estado','$id_usuario_modifica','$fecha_modifica')";	 	
	 return ejecutarConsulta_retornarID($sql_servicio);
}

public function anular($idventa){
	$sql="UPDATE venta SET estado='Anulado' WHERE idventa='$idventa'";
	return ejecutarConsulta($sql);
}


//implementar un metodopara mostrar los datos de unregistro a modificar
public function mostrar($idserv){
	$sql="SELECT id, codigo, contacto_cliente_id, tipo_vehiculo_id, vehiculo_id, detalle_cotizacion_id, conductor_id, 
	cotizacion_id, cliente_id, cuenta_cliente_id, almacen_cliente_id, tipo_material, fecha_registro, 
	DATE_FORMAT(fecha_inicio_programado, '%Y-%m-%d') as fecha_inicio_programado,  DATE_FORMAT(fecha_fin_programado, '%Y-%m-%d') as fecha_fin_programado,
	DATE_FORMAT(fecha_salida, '%Y-%m-%d') as fecha_salida, DATE_FORMAT(fecha_salida, '%H:%i') as hora_salida, 
	DATE_FORMAT(fecha_carga, '%Y-%m-%d') as fecha_carga, DATE_FORMAT(fecha_carga, '%H:%i') as hora_carga, 
	DATE_FORMAT(fecha_descarga, '%Y-%m-%d') as fecha_descarga, 
	tipo_destino, tipo_alcance_servicio, zona_cliente_id, zona_destino, zona_carga, zona_descarga, 
	moneda_servicio, valor_servicio, unidad_peso, peso_carga, unidad_volumen, volumen_carga, moneda_mercaderia, 
	valor_mercaderia, unidad_tiempo_atencion, tiempo_atencion, numero_trafico, guia_remision_transportista,
	 numero_eir, tipo_flete, tipo_servicio, codigo_referencia, comentario, fecha_termino_atencion, liquidacion_id, 
	 numero_liquidacion, fecha_liquidacion, factura_id, numero_factura, DATE_FORMAT(fecha_facturacion, '%Y-%m-%d') as fecha_facturacion, estado, id_usuario_modifica, 
	 DATE_FORMAT(fecha_modifica, '%Y-%m-%d') as fecha_modifica, modificable
	 FROM servicio  
	 WHERE id=$idserv";
	return ejecutarConsultaSimpleFila($sql);
}

public function listarDetalle($idventa){
	$sql="SELECT s.codigo,cc.nombre,ac.descripcion,s.zona_destino,v.marca,v.placa,c.nombre,s.numero_trafico,s.tipo_flete,s.fecha_inicio_programado,s.fecha_salida,s.fecha_carga, 
	from servicio s 
	inner join contacto_cliente cc on s.contacto_cliente_id=cc.id
	inner join almacen_cliente ac on s.almacen_cliente_id=ac.id
	inner join conductor c on s.conductor_id=c.id
	inner join vehiculo v on s.vehiculo_id=v.id";
	return ejecutarConsulta($sql);
}

//listar registros
public function listar($condicion){
	$sql="SELECT  s.id,s.codigo,cc.nombre as solicitante,ac.descripcion,s.zona_destino,v.marca,v.placa,c.nombre as condctor,s.numero_trafico,s.tipo_flete,s.fecha_inicio_programado,DATE_FORMAT(s.fecha_salida, '%H:%I:%S %p' ) as hora_salida,DATE_FORMAT(s.fecha_carga, '%H:%I:%S %p' ) as hora_carga,
	case s.estado WHEN 'PEN' THEN 'PENDIENTE'WHEN 'PGM' THEN 'PROGRAMADO' WHEN 'PRO' THEN 'PROCESO' WHEN 'ATE' THEN 'ATENDIDO' WHEN 'LIQ' THEN 'LIQUIDADO' WHEN 'FAC' THEN 'FACTURADO' WHEN 'PAG' THEN 'PAGADO' WHEN 'ANU' THEN 'ANULADO' end as estado 
	from servicio s 
	inner join contacto_cliente cc on s.contacto_cliente_id=cc.id
	inner join almacen_cliente ac on s.almacen_cliente_id=ac.id
	inner join conductor c on s.conductor_id=c.id
	inner join vehiculo v on s.vehiculo_id=v.id 
	$condicion";
	return ejecutarConsulta($sql);
}


public function ventacabecera($idventa){
	$sql= "SELECT v.idventa, v.idcliente, p.nombre AS cliente, p.direccion, p.tipo_documento, p.num_documento, p.email, p.telefono, v.idusuario, u.nombre AS usuario, v.tipo_comprobante, v.serie_comprobante, v.num_comprobante, DATE(v.fecha_hora) AS fecha, v.impuesto, v.total_venta FROM venta v INNER JOIN persona p ON v.idcliente=p.idpersona INNER JOIN usuario u ON v.idusuario=u.idusuario WHERE v.idventa='$idventa'";
	return ejecutarConsulta($sql);
}

public function ventadetalles($idventa){
	$sql="SELECT a.nombre AS articulo, a.codigo, d.cantidad, d.precio_venta, d.descuento, (d.cantidad*d.precio_venta-d.descuento) AS subtotal FROM detalle_venta d INNER JOIN articulo a ON d.idarticulo=a.idarticulo WHERE d.idventa='$idventa'";
         return ejecutarConsulta($sql);
}


}
