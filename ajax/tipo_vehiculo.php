er fewddd<?php
require_once "../modelos/Tipo_vehiculo.php";
if (strlen(session_id())<1) 
	session_start();
	
$tip_veh=new Tipo_vehiculo();

$id=isset($_POST["id"])? limpiarCadena($_POST["id"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$capacidad=isset($_POST["capacidad"])? limpiarCadena($_POST["capacidad"]):"";
$volumen=isset($_POST["volumen"])? limpiarCadena($_POST["volumen"]):"";
$estado=isset($_POST["estado"])? limpiarCadena($_POST["estado"]):"";
$id_usuario_modifica=$_SESSION["idusuario"];
$fecha_modifica=date("Y-m-d H:i:s", time());

switch ($_GET["op"]) {
	case 'guardaryeditar':

	if (empty($id)) {
		$rspta=$tip_veh->insertar($descripcion,$capacidad,$volumen,$estado,$id_usuario_modifica,$fecha_modifica);
		echo $rspta ? "Datos registrados correctamente" : "No se pudo registrar los datos";
	}else{
         $rspta=$tip_veh->editar($id,$descripcion,$capacidad,$volumen,$estado,$id_usuario_modifica,$fecha_modifica);
		echo $rspta ? "Datos actualizados correctamente" : "No se pudo actualizar los datos";
	}
		break;
	

	case 'desactivar':
		$rspta=$tip_veh->desactivar($id);
		echo $rspta ? "Datos desactivados correctamente" : "No se pudo desactivar los datos";
		break;
	case 'activar':
		$rspta=$tip_veh->activar($id);
		echo $rspta ? "Datos activados correctamente" : "No se pudo activar los datos";
		break;
	
	case 'mostrar':
		$rspta=$tip_veh->mostrar($id);
		echo json_encode($rspta);
		break;

	case 'mostrarCapacidaVol':
		$rspta=$tip_veh->mostrarCapacidaVol($id);
		echo json_encode($rspta);
		break;		

    case 'listar':
		$rspta=$tip_veh->listar();
		$data=Array();

		while ($reg=$rspta->fetch_object()) {
			$data[]=array(
            "0"=>($reg->estado=='ACT')?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->id.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->id.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->id.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-primary btn-xs" onclick="activar('.$reg->id.')"><i class="fa fa-check"></i></button>',
						"1"=>$reg->descripcion,
						"2"=>$reg->capacidad,
						"3"=>$reg->volumen,
            "4"=>($reg->estado=='ACT')?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
              );
		}
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);
		break;

}
 ?>