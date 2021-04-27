<?php
require_once "../modelos/Cotizacion.php";
if (strlen(session_id())<1) 
	session_start();



$cotizacion=new Cotizacion();

//CotizacionCabecera
$idcoti=isset($_POST["idcoti"])? limpiarCadena($_POST["idcoti"]):"";
$contacto_cliente_id=isset($_POST["contacto_cliente_id"])? limpiarCadena($_POST["contacto_cliente_id"]):"";
$cuenta_cliente_id=isset($_POST["cuenta_cliente_id"])? limpiarCadena($_POST["cuenta_cliente_id"]):"";
$cliente_id=isset($_POST["cliente_id"])? limpiarCadena($_POST["cliente_id"]):"";
$codigo=isset($_POST["codigo"])? limpiarCadena($_POST["codigo"]):"";
$id_usuario_registra=$_SESSION["idusuario"];
$id_usuario_aprueba=isset($_POST["id_usuario_aprueba"])? limpiarCadena($_POST["id_usuario_aprueba"]):"";
$fecha_registra=date("Y-m-d H:i:s", time());
$fecha_aprueba=isset($_POST["fecha_aprueba"])? limpiarCadena($_POST["fecha_aprueba"]):"";
$comentario=isset($_POST["comentario"])? limpiarCadena($_POST["comentario"]):"";
$fecha_vigencia_desde=isset($_POST["fecha_vigencia_desde"])? limpiarCadena($_POST["fecha_vigencia_desde"]):"";
$fecha_vigencia_hasta=isset($_POST["fecha_vigencia_hasta"])? limpiarCadena($_POST["fecha_vigencia_hasta"]):"";
$moneda_cotizacion=isset($_POST["moneda_cotizacion"])? limpiarCadena($_POST["moneda_cotizacion"]):"";
$estado=isset($_POST["estado"])? limpiarCadena($_POST["estado"]):"";
$id_usuario_modifica=$_SESSION["idusuario"];
$fecha_modifica=date("Y-m-d H:i:s", time());
//CotizacionDetalle

$idcotiDet=isset($_POST["idcotiDet"])? limpiarCadena($_POST["idcotiDet"]):"";
$tipo_vehiculo_id=isset($_POST["tipo_vehiculo_id"])? limpiarCadena($_POST["tipo_vehiculo_id"]):"";
$cotizacion_id=isset($_POST["cotizacion_id"])? limpiarCadena($_POST["cotizacion_id"]):"";
//$cliente_id=isset($_POST["cliente_id"])? limpiarCadena($_POST["cliente_id"]):"";
//$cuenta_cliente_id=isset($_POST["cuenta_cliente_id"])? limpiarCadena($_POST["cuenta_cliente_id"]):"";
$almacen_cliente_id=isset($_POST["almacen_cliente_id"])? limpiarCadena($_POST["almacen_cliente_id"]):"";
$tipo_alcance_servicio=isset($_POST["tipo_alcance_servicio"])? limpiarCadena($_POST["tipo_alcance_servicio"]):"";
$tipo_destino=isset($_POST["tipo_destino"])? limpiarCadena($_POST["tipo_destino"]):"";
$destino=isset($_POST["destino"])? limpiarCadena($_POST["destino"]):"";
$zona_cliente_id=isset($_POST["zona_cliente_id"])? limpiarCadena($_POST["zona_cliente_id"]):"";
$moneda_tarifa=isset($_POST["moneda_tarifa"])? limpiarCadena($_POST["moneda_tarifa"]):"";
$tarifa=isset($_POST["tarifa"])? limpiarCadena($_POST["tarifa"]):"";
$tarifa_adicional_1=isset($_POST["tarifa_adicional_1"])? limpiarCadena($_POST["tarifa_adicional_1"]):"";
$tarifa_adicional_2=isset($_POST["tarifa_adicional_2"])? limpiarCadena($_POST["tarifa_adicional_2"]):"";
$tarifa_adicional_3=isset($_POST["tarifa_adicional_3"])? limpiarCadena($_POST["tarifa_adicional_3"]):"";
$tarifa_adicional_4=isset($_POST["tarifa_adicional_4"])? limpiarCadena($_POST["tarifa_adicional_4"]):"";
$tarifa_adicional_5=isset($_POST["tarifa_adicional_5"])? limpiarCadena($_POST["tarifa_adicional_5"]):"";
$descripcion_tarifa_adicional_1=isset($_POST["descripcion_tarifa_adicional_1"])? limpiarCadena($_POST["descripcion_tarifa_adicional_1"]):"";
$descripcion_tarifa_adicional_2=isset($_POST["descripcion_tarifa_adicional_2"])? limpiarCadena($_POST["descripcion_tarifa_adicional_2"]):"";
$descripcion_tarifa_adicional_3=isset($_POST["descripcion_tarifa_adicional_3"])? limpiarCadena($_POST["descripcion_tarifa_adicional_3"]):"";
$descripcion_tarifa_adicional_4=isset($_POST["descripcion_tarifa_adicional_4"])? limpiarCadena($_POST["descripcion_tarifa_adicional_4"]):"";
$descripcion_tarifa_adicional_5=isset($_POST["descripcion_tarifa_adicional_5"])? limpiarCadena($_POST["descripcion_tarifa_adicional_5"]):"";
$unidad_tiempo_atencion=isset($_POST["unidad_tiempo_atencion"])? limpiarCadena($_POST["unidad_tiempo_atencion"]):"";
$tiempo_atencion_minimo=isset($_POST["tiempo_atencion_minimo"])? limpiarCadena($_POST["tiempo_atencion_minimo"]):"";
$tiempo_atencion_maximo=isset($_POST["tiempo_atencion_maximo"])? limpiarCadena($_POST["tiempo_atencion_maximo"]):"";
$unidad_peso=isset($_POST["unidad_peso"])? limpiarCadena($_POST["unidad_peso"]):"";
$peso_minimo=isset($_POST["peso_minimo"])? limpiarCadena($_POST["peso_minimo"]):"";
$peso_maximo=isset($_POST["peso_maximo"])? limpiarCadena($_POST["peso_maximo"]):"";
$unidad_volumen=isset($_POST["unidad_volumen"])? limpiarCadena($_POST["unidad_volumen"]):"";
$volumen_minimo=isset($_POST["volumen_minimo"])? limpiarCadena($_POST["volumen_minimo"]):"";
$volumen_maximo=isset($_POST["volumen_maximo"])? limpiarCadena($_POST["volumen_maximo"]):"";
$moneda_valor_mercaderia=isset($_POST["moneda_valor_mercaderia"])? limpiarCadena($_POST["moneda_valor_mercaderia"]):"";
$valor_mercaderia_maximo=isset($_POST["valor_mercaderia_maximo"])? limpiarCadena($_POST["valor_mercaderia_maximo"]):"";
$valor_mercaderia_minimo=isset($_POST["valor_mercaderia_minimo"])? limpiarCadena($_POST["valor_mercaderia_minimo"]):"";
$capacidad_vehiculo=isset($_POST["capacidad_vehiculo"])? limpiarCadena($_POST["capacidad_vehiculo"]):"";
$volumen_vehiculo=isset($_POST["volumen_vehiculo"])? limpiarCadena($_POST["volumen_vehiculo"]):"";
//$comentario=isset($_POST["comentario"])? limpiarCadena($_POST["comentario"]):"";
//$estado=isset($_POST["estado"])? limpiarCadena($_POST["estado"]):"";
//$id_usuario_modifica=isset($_POST["id_usuario_modifica"])? limpiarCadena($_POST["id_usuario_modifica"]):"";
//$fecha_modifica=isset($_POST["fecha_modifica"])? limpiarCadena($_POST["fecha_modifica"]):"";


switch ($_GET["op"]) {
	case 'guardaryeditar':
	if (empty($idcoti)) {
		$restID=$cotizacion->insertar($contacto_cliente_id,$cuenta_cliente_id,$cliente_id,$codigo,$id_usuario_registra,$id_usuario_aprueba,$fecha_registra,$fecha_aprueba,$comentario,$fecha_vigencia_desde,$fecha_vigencia_hasta,$moneda_cotizacion,$estado,$fecha_modifica);
		$rspta= array("rpta"=>$restID? "Datos registrados correctamente" : "No se pudo registrar los datos","idCoti"=>$restID);
		$datos=array_merge($rspta);
		echo json_encode($datos);
	}else{                         
         $rspta=$cotizacion->editar($idcoti,$cuenta_cliente_id,$contacto_cliente_id,$fecha_vigencia_desde,$fecha_vigencia_hasta,$id_usuario_aprueba,$fecha_aprueba,$estado,$id_usuario_modifica,$fecha_modifica);
		 $rspta= array("rpta"=>$idcoti? "Datos actualizados correctamente" : "No se pudo actualizar los datos","idCoti"=>$idcoti);
		 $datos=array_merge($rspta);
		 echo json_encode($datos);
	}
		break;
	case 'guardaryeditarDet':
	if (empty($idcotiDet)) {
			$restID=$cotizacion->insertarDet($tipo_vehiculo_id,$idcoti,$cliente_id,$cuenta_cliente_id,$almacen_cliente_id,$tipo_alcance_servicio,$tipo_destino,$destino,$zona_cliente_id,$moneda_tarifa,
			$tarifa,$tarifa_adicional_1,$tarifa_adicional_2,$tarifa_adicional_3,$tarifa_adicional_4,$tarifa_adicional_5,$descripcion_tarifa_adicional_1,$descripcion_tarifa_adicional_2,
			$descripcion_tarifa_adicional_3,$descripcion_tarifa_adicional_4,$descripcion_tarifa_adicional_5,$unidad_tiempo_atencion,$tiempo_atencion_minimo,$tiempo_atencion_maximo,
			$unidad_peso,$peso_minimo,$peso_maximo,$unidad_volumen,$volumen_minimo,$volumen_maximo,$moneda_valor_mercaderia,$valor_mercaderia_maximo,$valor_mercaderia_minimo,
			$capacidad_vehiculo,$volumen_vehiculo,$comentario,$estado,$id_usuario_modifica,$fecha_modifica);
			$rspta= array("rpta"=>$restID? "Datos registrados correctamente" : "No se pudo registrar los datos","idCoti"=>$restID);
			$datos=array_merge($rspta);
			echo json_encode($datos);
	}else{                         
			 $rspta=$cotizacion->editarDet($idcotiDet,$tipo_vehiculo_id,$cotizacion_id,$cliente_id,$cuenta_cliente_id,$almacen_cliente_id,$tipo_alcance_servicio,$tipo_destino,$destino,$zona_cliente_id,$moneda_tarifa,
			 $tarifa,$tarifa_adicional_1,$tarifa_adicional_2,$tarifa_adicional_3,$tarifa_adicional_4,$tarifa_adicional_5,$descripcion_tarifa_adicional_1,$descripcion_tarifa_adicional_2,
			 $descripcion_tarifa_adicional_3,$descripcion_tarifa_adicional_4,$descripcion_tarifa_adicional_5,$unidad_tiempo_atencion,$tiempo_atencion_minimo,$tiempo_atencion_maximo,
			 $unidad_peso,$peso_minimo,$peso_maximo,$unidad_volumen,$volumen_minimo,$volumen_maximo,$moneda_valor_mercaderia,$valor_mercaderia_maximo,$valor_mercaderia_minimo,
			 $capacidad_vehiculo,$volumen_vehiculo,$comentario,$estado,$id_usuario_modifica,$fecha_modifica);
			 $rspta= array("rpta"=>$idcoti? "Datos actualizados correctamente" : "No se pudo actualizar los datos","idCoti"=>$idcoti);
			 $datos=array_merge($rspta);
			 echo json_encode($datos);
	}
		break;
		case 'desactivar':
		$rspta=$cotizacion->desactivar($idcoti);
		echo $rspta ? "Datos desactivados correctamente" : "No se pudo desactivar los datos";
		break;
	case 'activar':
		$rspta=$cotizacion->activar($idcoti);
		echo $rspta ? "Datos activados correctamente" : "No se pudo activar los datos";
		break;
	
	case 'mostrar':
		$rspta=$cotizacion->mostrar($idcoti);
		echo json_encode($rspta);
		break;
	case 'mostrarcoti':
		$rspta=$cotizacion->mostrarcoti($idcoti);
		echo json_encode($rspta);
		break;
	case 'mostrarcotiDet':
		$idcotiDet=$_REQUEST["idcotiDet"]; 
		$rspta=$cotizacion->mostrarcotiDet($idcotiDet);
		echo json_encode($rspta);
		break;

	case 'listar':
		$cliente_id=$_REQUEST["cliente_id"];
		$contacto_cliente_id=$_REQUEST["contacto_cliente_id"];
		$cuenta_cliente_id=$_REQUEST["cuenta_cliente_id"];
		$fecha_desde=$_REQUEST["fecha_desde"];
		$fecha_hasta=$_REQUEST["fecha_hasta"];
		$estado=$_REQUEST["estado"];

		$condicion=' where 1=1';
		if ($cliente_id!=''){
            $condicion=$condicion." and co.cliente_id='$cliente_id'";
		}if($contacto_cliente_id!=''){
			$condicion=$condicion." and co.contacto_cliente_id='$contacto_cliente_id'";
		}if($cuenta_cliente_id!=''){
			$condicion=$condicion." and co.cuenta_cliente_id='$cuenta_cliente_id'";
		}if($estado!=''){
			$condicion=$condicion." and co.estado='$estado'";
		}if($fecha_desde!='' && $fecha_hasta!=''){
			$condicion=$condicion." and co.fecha_registra BETWEEN '$fecha_desde' and '$fecha_hasta' ";
		}
		
		$condicion=$condicion." ORDER BY co.id DESC ";

		$rspta=$cotizacion->listar($condicion);
		$data=Array();

		while ($reg=$rspta->fetch_object()) {
			$link='';
			$url='cotizacion.php?idcoti=';
			if($reg->estado=='ANULADO'){
			    $link='<a  href="'.$url.$reg->id.'"> <button class="btn btn-info btn-xs"><i class="fa fa-file"></i></button></a>';
			}else if($reg->estado=='APROBADO'){
				$link='<a href="'.$url.$reg->id.'"> <button class="btn btn-info btn-xs"><i class="fa fa-search"></i></button></a>'.
				'<a  href="'.$url.$reg->id.'"> <button class="btn btn-info btn-xs"><i class="fa fa-print"></i></button></a> '.
				'<button class="btn btn-warning btn-xs" onclick="anular('.$reg->id.')"><i class="fa fa-close"></i></button>';
			}else if($reg->estado=='PENDIENTE'){
				$link='<a  href="'.$url.$reg->id.'"> <button class="btn btn-info btn-xs"><i class="fa fa-file"></i></button></a>';
			}else if($reg->estado=='INACTIVO'){
				$link='<a href="'.$url.$reg->id.'"> <button class="btn btn-info btn-xs"><i class="fa fa-file"></i></button></a>';
			}
		
			$data[]=array(
			"0"=>$link,
			"1"=>$reg->codigo,
						"2"=>$reg->cuenta,
						"3"=>$reg->contacto,
						"4"=>$reg->fecha_registra,
						"5"=>$reg->fecha_aprueba,
						"6"=>$reg->fecha_vigencia_hasta,
            			"7"=>$reg->estado
              );
		}
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);
		break;

	case 'listarCotDet':
		$idcoti=$_REQUEST["idcoti"];
		$rspta=$cotizacion->listarCotDet($idcoti);
		$data=Array();

		while ($reg=$rspta->fetch_object()) {
			$link='';
			$url='cotizacion.php?id=';
			if($reg->estado=='ACT'){
				$link='<button class="btn btn-warning btn-xs" onclick="buscar('.$reg->idcotiDet.')"><i class="fa fa-search"></i></button>'.
				'<button class="btn btn-warning btn-xs" onclick="editar('.$reg->idcotiDet.')"><i class="fa fa-edit"></i></button>'.
				'<button class="btn btn-warning btn-xs" onclick="anular('.$reg->idcotiDet.')"><i class="fa fa-close"></i></button>';
			}
		
			$data[]=array(
			"0"=>$link,
			"1"=>$reg->idcotiDet,
						"2"=>$reg->almacen,
						"3"=>$reg->alcance,
						"4"=>$reg->destino,
						"5"=>$reg->tipovehiculo,
						"6"=>$reg->vmercaderia,
						"7"=>$reg->pmercaderia,
						"8"=>$reg->tservicio,
						"9"=>$reg->moneda,
						"10"=>$reg->tarifa,
              );
		}
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);
		break;

	case 'selectCliente':
		  require_once "../modelos/Cliente.php";
			$cliente=new Cliente();

			$rspta=$cliente->select();
			$contador=0;
			while ($reg=$rspta->fetch_object()) {
				if($contador==0) {
					echo '<option value='.''.'>'.'SELECCIONE'.'</option>';
				}
				echo '<option value=' . $reg->id.'>'.$reg->razon_social.'</option>';
				$contador++;
			}
			break;
			case 'selectContactos':
			$cliente_id=$_REQUEST["cliente_id"];
		  require_once "../modelos/Contacto_cliente.php";
			$contacto_cliente=new Contacto_cliente();

			$rspta=$contacto_cliente->select();
			$contador=0;
			while ($reg=$rspta->fetch_object()) {
				if($contador==0) {
					echo '<option value='.''.'>'.'SELECCIONE'.'</option>';
				}
				echo '<option value=' . $reg->id.'>'.$reg->nombre.'</option>';
				$contador++;
			}
			break;
	case 'selectContactocliente':
			$cliente_id=$_REQUEST["cliente_id"];
		  require_once "../modelos/Contacto_cliente.php";
			$contacto_cliente=new Contacto_cliente();

			$rspta=$contacto_cliente->contactosCientesID($cliente_id);
			$contador=0;
			while ($reg=$rspta->fetch_object()) {
				if($contador==0) {
					echo '<option value='.''.'>'.'SELECCIONE'.'</option>';
				}
				echo '<option value=' . $reg->id.'>'.$reg->nombre.'</option>';
				$contador++;
			}
			break;

	case 'selectCuentas':
			$cliente_id=$_REQUEST["cliente_id"];
		  require_once "../modelos/Cuenta_cliente.php";
			$cuenta_cliente=new Cuenta_cliente();

			$rspta=$cuenta_cliente->select();
			$contador=0;
			while ($reg=$rspta->fetch_object()) {
				if($contador==0) {
					echo '<option value='.''.'>'.'SELECCIONE'.'</option>';
				}
				echo '<option value=' . $reg->id.'>'.$reg->descripcion.'</option>';
				$contador++;
			}
			break;
	case 'selectCuentacliente':
			$cliente_id=$_REQUEST["cliente_id"];
		  require_once "../modelos/Cuenta_cliente.php";
			$cuenta_cliente=new Cuenta_cliente();

			$rspta=$cuenta_cliente->cuentasCientesID($cliente_id);
			$contador=0;
			while ($reg=$rspta->fetch_object()) {
				if($contador==0) {
					echo '<option value='.''.'>'.'SELECCIONE'.'</option>';
				}
				echo '<option value=' . $reg->id.'>'.$reg->descripcion.'</option>';
				$contador++;
			}
			break;

	case 'selectAlmacenCliente':
			$cliente_id=$_REQUEST["cliente_id"];
		  require_once "../modelos/Almacen_cliente.php";
			$almacen_cliente=new Almacen_cliente();

			$rspta=$almacen_cliente->almacenCientesID($cliente_id);
			$contador=0;
			while ($reg=$rspta->fetch_object()) {
				if($contador==0) {
					echo '<option value='.''.'>'.'SELECCIONE'.'</option>';
				}
				echo '<option value=' . $reg->id.'>'.$reg->descripcion.'</option>';
				$contador++;
			}
			break;

	case 'selectTipoVehiculo':
		  require_once "../modelos/Tipo_vehiculo.php";
			$tipo_vehiculo=new Tipo_vehiculo();

			$rspta=$tipo_vehiculo->select();
			$contador=0;
			while ($reg=$rspta->fetch_object()) {
				if($contador==0) {
					echo '<option value='.''.'>'.'SELECCIONE'.'</option>';
				}
				echo '<option value=' . $reg->id.'>'.$reg->descripcion.'</option>';
				$contador++;
			}
			break;

	case 'mostrarCapacidaVol':
		$id=$_REQUEST["id"];
		require_once "../modelos/Tipo_vehiculo.php";
		$tipo_vehiculo=new Tipo_vehiculo();

		$rspta=$tipo_vehiculo->mostrarCapacidaVol($id);
		echo json_encode($rspta);
		break;

	case 'selectZonaCliente':
		$cliente_id=$_REQUEST["cliente_id"];
	  	require_once "../modelos/Zona_cliente.php";
		$zona_cliente=new Zona_cliente();

		$rspta=$zona_cliente->zonaCientesID($cliente_id);
		$contador=0;
		while ($reg=$rspta->fetch_object()) {
			if($contador==0) {
				echo '<option value='.''.'>'.'SELECCIONE'.'</option>';
			}
			echo '<option value=' . $reg->id.'>'.$reg->nombre.'</option>';
			$contador++;
		}
		break;
	case 'selectZonaDescCliente':
		$idzona=$_REQUEST["zona_id"];
	  	require_once "../modelos/Zona_cliente.php";
		$zona_cliente=new Zona_cliente();

		$rspta=$zona_cliente->destinosZonasID($idzona);
		
		$contador=0;
		while ($reg=$rspta->fetch_object()) {
			$cadena= $reg->descripcion;
			$arraydestinos = explode (",", $cadena); 
			$longitud = count($arraydestinos);
			for($i=0; $i<$longitud; $i++)
			{
				if($contador==0) {
					echo '<option value='.''.'>'.'SELECCIONE'.'</option>';
				}
				echo '<option value=' .$arraydestinos[$i].'>'.$arraydestinos[$i].'</option>';
				$contador++;
			}


			
		}
		break;

}
