<?php 
require_once "../modelos/Vehiculo.php";
if (strlen(session_id())<1) 
	session_start();

$vehiculo=new Vehiculo();

$id=isset($_POST["id"])? limpiarCadena($_POST["id"]):"";
$tipo_vehiculo_id=isset($_POST["tipo_vehiculo_id"])? limpiarCadena($_POST["tipo_vehiculo_id"]):"";
$marca=isset($_POST["marca"])? limpiarCadena($_POST["marca"]):"";
$modelo=isset($_POST["modelo"])? limpiarCadena($_POST["modelo"]):"";
$placa=isset($_POST["placa"])? limpiarCadena($_POST["placa"]):"";
$tipo_propietario=isset($_POST["tipo_propietario"])? limpiarCadena($_POST["tipo_propietario"]):"";
$fecha_vencimiento_soat=isset($_POST["fecha_vencimiento_soat"])? limpiarCadena($_POST["fecha_vencimiento_soat"]):"";
$fecha_vencimiento_inspeccion=isset($_POST["fecha_vencimiento_inspeccion"])? limpiarCadena($_POST["fecha_vencimiento_inspeccion"]):"";
$fecha_vencimiento_poliza=isset($_POST["fecha_vencimiento_poliza"])? limpiarCadena($_POST["fecha_vencimiento_poliza"]):"";
$gps_activo=isset($_POST["gps_activo"])? limpiarCadena($_POST["gps_activo"]):"";
$operador_gps=isset($_POST["operador_gps"])? limpiarCadena($_POST["operador_gps"]):"";
$estado=isset($_POST["estado"])? limpiarCadena($_POST["estado"]):"";
$id_usuario_modifica=$_SESSION["idusuario"];
$fecha_modifica=date("Y-m-d H:i:s", time());

switch ($_GET["op"]) {
	case 'guardaryeditar':
	if (empty($id)) {
		$rspta=$vehiculo->insertar($tipo_vehiculo_id,$marca,$modelo,$placa,$tipo_propietario,$fecha_vencimiento_soat,$fecha_vencimiento_inspeccion,$fecha_vencimiento_poliza,$gps_activo,$operador_gps,$estado,$id_usuario_modifica,$fecha_modifica);
		echo $rspta ? "Datos registrados correctamente" : "No se pudo registrar los datos";
	}else{
         $rspta=$vehiculo->editar($id,$tipo_vehiculo_id,$marca,$modelo,$placa,$tipo_propietario,$fecha_vencimiento_soat,$fecha_vencimiento_inspeccion,$fecha_vencimiento_poliza,$gps_activo,$operador_gps,$estado,$id_usuario_modifica,$fecha_modifica);
		echo $rspta ? "Datos actualizados correctamente" : "No se pudo actualizar los datos";
	}
		break;
	

	case 'desactivar':
		$rspta=$vehiculo->desactivar($id);
		echo $rspta ? "Datos desactivados correctamente" : "No se pudo desactivar los datos";
		break;
	case 'activar':
		$rspta=$vehiculo->activar($id);
		echo $rspta ? "Datos activados correctamente" : "No se pudo activar los datos";
		break;
	
	case 'mostrar':
		$rspta=$vehiculo->mostrar($id);
		echo json_encode($rspta);
		break;

    case 'listar':
		$rspta=$vehiculo->listar();
		$data=Array();

		while ($reg=$rspta->fetch_object()) {
			$data[]=array(
            "0"=>($reg->estado=='ACT')?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->id.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->id.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->id.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-primary btn-xs" onclick="activar('.$reg->id.')"><i class="fa fa-check"></i></button>',
						"1"=>$reg->tipo_vehiculo,
						"2"=>$reg->marca,
						"3"=>$reg->modelo,
						"4"=>$reg->placa,
						"5"=>$reg->tipo_propietario,
						"6"=>$reg->fecha_vencimiento_soat,
						"7"=>$reg->fecha_vencimiento_inspeccion,
						"8"=>$reg->fecha_vencimiento_poliza,
						"9"=>$reg->gps_activo,
						"10"=>$reg->operador_gps,
            "11"=>($reg->estado=='ACT')?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
              );
		}
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);
		break;

		case 'selectTipo_vehiculo':
		require_once "../modelos/Tipo_vehiculo.php";
		$tipo_vehiculo=new Tipo_vehiculo();

		$rspta=$tipo_vehiculo->select();

		while ($reg=$rspta->fetch_object()) {
			echo '<option value=' . $reg->id.'>'.$reg->descripcion.'</option>';
		}
		break;
}
 ?>