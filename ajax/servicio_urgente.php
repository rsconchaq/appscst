<?php

require_once "../modelos/Servicio_urgente.php";
if (strlen(session_id())<1) 
	session_start();

$servicio = new Servicio_urgente();

date_default_timezone_set('America/Lima');
$idserv=isset($_POST["idserv"])? limpiarCadena($_POST["idserv"]):"";
$idcliente=isset($_POST["idcliente"])? limpiarCadena($_POST["idcliente"]):"";
$idusuario=$_SESSION["idusuario"];
$tipo_comprobante=isset($_POST["tipo_comprobante"])? limpiarCadena($_POST["tipo_comprobante"]):"";
$serie_comprobante=isset($_POST["serie_comprobante"])? limpiarCadena($_POST["serie_comprobante"]):"";
$num_comprobante=isset($_POST["num_comprobante"])? limpiarCadena($_POST["num_comprobante"]):"";
$fecha_hora=isset($_POST["fecha_hora"])? limpiarCadena($_POST["fecha_hora"]):"";
$impuesto=isset($_POST["impuesto"])? limpiarCadena($_POST["impuesto"]):"";
$total_venta=isset($_POST["total_venta"])? limpiarCadena($_POST["total_venta"]):"";

$idcoti=isset($_POST["idcoti"])? limpiarCadena($_POST["idcoti"]):"";
$cuenta_cliente_id=isset($_POST["cuenta_cliente_id"])? limpiarCadena($_POST["cuenta_cliente_id"]):"";
$contacto_cliente_id=isset($_POST["contacto_cliente_id"])? limpiarCadena($_POST["contacto_cliente_id"]):"";
$cliente_id=isset($_POST["cliente_id"])? limpiarCadena($_POST["cliente_id"]):"";
$fecha_inicio_programado=isset($_POST["fecha_inicio_programado"])? limpiarCadena($_POST["fecha_inicio_programado"]):"";
$fecha_fin_programado=isset($_POST["fecha_fin_programado"])? limpiarCadena($_POST["fecha_fin_programado"]):"";
$moneda_servicio=isset($_POST["moneda_servicio"])? limpiarCadena($_POST["moneda_servicio"]):"";
$estado=isset($_POST["estado"])? limpiarCadena($_POST["estado"]):"";
$id_usuario_registra=$_SESSION["idusuario"];
$id_usuario_modifica=$_SESSION["idusuario"];
$fecha_modifica=date("Y-m-d H:i:s", time());

$tipo_vehiculo_id=isset($_POST["tipo_vehiculo_id"])? limpiarCadena($_POST["tipo_vehiculo_id"]):"";
$almacen_cliente_id=isset($_POST["almacen_cliente_id"])? limpiarCadena($_POST["almacen_cliente_id"]):"";
$tipo_alcance_servicio=isset($_POST["tipo_alcance_servicio"])? limpiarCadena($_POST["tipo_alcance_servicio"]):"";
$tipo_destino=isset($_POST["tipo_destino"])? limpiarCadena($_POST["tipo_destino"]):"";
$zona_cliente_id=isset($_POST["zona_cliente_id"])? limpiarCadena($_POST["zona_cliente_id"]):"";
$destino=isset($_POST["destino"])? limpiarCadena($_POST["destino"]):"";
$zona_destino=isset($_POST["zona_destino"])? limpiarCadena($_POST["zona_destino"]):"";

$valor_servicio=isset($_POST["valor_servicio"])? limpiarCadena($_POST["valor_servicio"]):"";

$vehiculo_id=isset($_POST["vehiculo_id"])? limpiarCadena($_POST["vehiculo_id"]):"";
$conductor_id=isset($_POST["conductor_id"])? limpiarCadena($_POST["conductor_id"]):"";
$tipo_material=isset($_POST["tipo_material"])? limpiarCadena($_POST["tipo_material"]):"";
$fecha_salida=isset($_POST["fecha_salida"])? limpiarCadena($_POST["fecha_salida"]):"";
$hora_salida=isset($_POST["hora_salida"])? limpiarCadena($_POST["hora_salida"]):"";
$fecha_carga=isset($_POST["fecha_carga"])? limpiarCadena($_POST["fecha_carga"]):"";
$hora_carga=isset($_POST["hora_carga"])? limpiarCadena($_POST["hora_carga"]):"";
$numero_trafico=isset($_POST["numero_trafico"])? limpiarCadena($_POST["numero_trafico"]):"";
$numero_eir=isset($_POST["numero_eir"])? limpiarCadena($_POST["numero_eir"]):"";
$tipo_flete=isset($_POST["tipo_flete"])? limpiarCadena($_POST["tipo_flete"]):"";
$tipo_servicio=isset($_POST["tipo_servicio"])? limpiarCadena($_POST["tipo_servicio"]):"";
$comentario=isset($_POST["comentario"])? limpiarCadena($_POST["comentario"]):"";

$fechasalida=$fecha_salida." ".$hora_salida.":00";
$fechacarga=$fecha_carga." ".$hora_carga.":00";

if($destino==''){
	$destino=$zona_destino;

}

switch ($_GET["op"]) {
	case 'guardaryeditar':
	if (empty($idserv)) {
		$restID=$servicio->insertar($cuenta_cliente_id,$contacto_cliente_id,$cliente_id,$fecha_inicio_programado,$fecha_fin_programado,
		$moneda_servicio,$estado,$id_usuario_registra,$id_usuario_modifica,$fecha_modifica,
		$tipo_vehiculo_id,$almacen_cliente_id,$tipo_alcance_servicio,$tipo_destino,$destino,$zona_cliente_id,$valor_servicio,
	  $vehiculo_id,$conductor_id,$tipo_material,$fechasalida,$fechacarga,$numero_trafico,$numero_eir,$tipo_flete,$tipo_servicio,$comentario); 


		if($restID>0){
			$dato=$servicio->mostrar($restID);
		 }
		$rspta= array("rpta"=>$restID? "Datos registrados correctamente" : "No se pudo registrar los datos");
		$datos=array_merge($dato,$rspta);
		echo json_encode($datos);
	}else{
        
	}
		break;
	

	case 'anular':
		$rspta=$venta->anular($idventa);
		echo $rspta ? "Ingreso anulado correctamente" : "No se pudo anular el ingreso";
		break;
	
	case 'mostrar':
		$rspta=$venta->mostrar($idventa);
		echo json_encode($rspta);
		break;

	case 'listarServicios':
		//recibimos el idventa
		$id=$_GET['id'];

		$rspta=$venta->listarDetalle($id);
		$total=0;
		echo ' <thead style="background-color:#A9D0F5">
        <th>Opciones</th>
        <th>Articulo</th>
        <th>Cantidad</th>
        <th>Precio Venta</th>
        <th>Descuento</th>
        <th>Subtotal</th>
       </thead>';
		while ($reg=$rspta->fetch_object()) {
			echo '<tr class="filas">
			<td></td>
			<td>'.$reg->nombre.'</td>
			<td>'.$reg->cantidad.'</td>
			<td>'.$reg->precio_venta.'</td>
			<td>'.$reg->descuento.'</td>
			<td>'.$reg->subtotal.'</td></tr>';
			$total=$total+($reg->precio_venta*$reg->cantidad-$reg->descuento);
		}
		echo '<tfoot>
         <th>TOTAL</th>
         <th></th>
         <th></th>
         <th></th>
         <th></th>
         <th><h4 id="total">S/. '.$total.'</h4><input type="hidden" name="total_venta" id="total_venta"></th>
       </tfoot>';
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
               $condicion=$condicion." and s.cliente_id='$cliente_id'";
		}if($contacto_cliente_id!=''){
			$condicion=$condicion." and s.contacto_cliente_id='$contacto_cliente_id'";
		}if($cuenta_cliente_id!=''){
			$condicion=$condicion." and s.cuenta_cliente_id='$cuenta_cliente_id'";
		}if($estado!=''){
			$condicion=$condicion." and s.estado='$estado'";
		}if($fecha_desde!='' && $fecha_hasta!=''){
			$condicion=$condicion." and s.fecha_modifica BETWEEN '$fecha_desde' and '$fecha_hasta'";
		}
		

		$rspta=$servicio->listar($condicion);
		$data=Array();

		while ($reg=$rspta->fetch_object()) {
			$data[]=array(
            "0"=>($reg->estado=='ACT')?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->id.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->id.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->id.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-primary btn-xs" onclick="activar('.$reg->id.')"><i class="fa fa-check"></i></button>',
			"1"=>$reg->codigo,
			"2"=>$reg->solicitante,
			"3"=>$reg->descripcion,
			"4"=>$reg->zona_destino,
			"5"=>$reg->marca,
			"6"=>$reg->placa,
			"7"=>$reg->condctor,
			"8"=>$reg->numero_trafico,
			"9"=>$reg->tipo_flete,
			"10"=>$reg->fecha_inicio_programado,
			"11"=>$reg->hora_salida,
			"12"=>$reg->hora_carga,
            "13"=>$reg->estado
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
			$cliente = new Cliente();

			$rspta = $cliente->select();

			$contador=0;
			while ($reg=$rspta->fetch_object()) {
				
				if($contador==0) {
					echo '<option value='.''.'>'.'SELECCIONE'.'</option>';
				}
				echo '<option value='.$reg->id.'>'.$reg->razon_social.'</option>';
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

			case 'selectAlmacencliente':
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

			case 'selectZonacliente':
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

			case 'selectDestinozona':
			$zona_cliente_id=$_REQUEST["zona_cliente_id"];
		  require_once "../modelos/Zona_cliente.php";
			$zona_cliente=new Zona_cliente();

			$rspta=$zona_cliente->destinosZonasID($zona_cliente_id);

			while ($reg=$rspta->fetch_object()) {
				$array = explode(",", $reg->descripcion);
				$contador=0;
				foreach($array as $llave => $valores) { 
					if($contador==0) {
						echo '<option value='.''.'>'.'SELECCIONE'.'</option>';
					}
					echo '<option value="' .$valores.'">'.$valores.'</option>';
					$contador++;
					}
			}
			break;

			case 'selectTipovehiculo':
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

			case 'selectVehiculoTipoVehiculo':
			$tipo_vehiculo_id=$_REQUEST["tipo_vehiculo_id"];
		  require_once "../modelos/Vehiculo.php";
			$vehiculo=new Vehiculo();

			$rspta=$vehiculo->marcaTipoVehiculo($tipo_vehiculo_id);

			$contador=0;
			while ($reg=$rspta->fetch_object()) {
				
				if($contador==0) {
					echo '<option value='.''.'>'.'SELECCIONE'.'</option>';
				}
				echo '<option value=' . $reg->id.'>'.$reg->marca.' - '.$reg->placa.'</option>';
				$contador++;
			}
			break;

			case 'selectConductorTipoVehiculo':
			$tipo_vehiculo_id=$_REQUEST["tipo_vehiculo_id"];
		  require_once "../modelos/Conductor.php";
			$conductor=new Conductor();

			$rspta=$conductor->selectConductorTipoVehiculo($tipo_vehiculo_id);
			$contador=0;
			while ($reg=$rspta->fetch_object()) {

				if($contador==0) {
					echo '<option value='.''.'>'.'SELECCIONE'.'</option>';
				}
				echo '<option value=' . $reg->conductor_id.'>'.$reg->nombre.'</option>';
				$contador++;
			}
			break;

		case 'selectServicioAdicionalTipo':
		require_once "../modelos/Tipo_adicional_servicio.php";
		$tipo_adicional_servicio=new Tipo_adicional_servicio();

		$rspta=$tipo_adicional_servicio->select();
		$contador=0;
		while ($reg=$rspta->fetch_object()) {
			if($contador==0) {
				echo '<option value='.''.'>'.'SELECCIONE'.'</option>';
			}
			echo '<option value=' . $reg->id.'>'.$reg->descripcion.'</option>';
			$contador++;
		}
		break;
		case 'selectServicioAdicionalAuxiliar':
		require_once "../modelos/Auxiliar.php";
		$auxiliar=new Auxiliar();

		$rspta=$auxiliar->select();
		$contador=0;
		while ($reg=$rspta->fetch_object()) {
			if($contador==0) {
				echo '<option value='.''.'>'.'SELECCIONE'.'</option>';
			}
			echo '<option value=' . $reg->id.'>'.$reg->nombre.'</option>';
			$contador++;
		}
		break;
}
 ?>