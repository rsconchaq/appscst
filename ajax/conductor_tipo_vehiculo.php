<?php
require_once "../modelos/Conductor_tipo_vehiculo.php";
if (strlen(session_id())<1) 
	session_start();

$con_tip_veh=new Conductor_tipo_vehiculo();

$id=isset($_POST["id"])? limpiarCadena($_POST["id"]):"";
$conductor_id=isset($_POST["conductor_id"])? limpiarCadena($_POST["conductor_id"]):"";
$tipo_vehiculo_id=isset($_POST["tipo_vehiculo_id"])? limpiarCadena($_POST["tipo_vehiculo_id"]):"";
$estado=isset($_POST["estado"])? limpiarCadena($_POST["estado"]):"";
$id_usuario_modifica=$_SESSION["idusuario"];
$fecha_modifica=date("Y-m-d H:i:s", time());

switch ($_GET["op"]) {
	case 'guardaryeditar':

	if (empty($id)) {
		$rspta=$con_tip_veh->insertar($conductor_id,$tipo_vehiculo_id,$estado,$id_usuario_modifica,$fecha_modifica);
		echo $rspta ? "Datos registrados correctamente" : "No se pudo registrar los datos";
	}else{
         $rspta=$con_tip_veh->editar($id,$conductor_id,$tipo_vehiculo_id,$estado,$id_usuario_modifica,$fecha_modifica);
		echo $rspta ? "Datos actualizados correctamente" : "No se pudo actualizar los datos";
	}
		break;
	

	case 'desactivar':
		$rspta=$con_tip_veh->desactivar($id);
		echo $rspta ? "Datos desactivados correctamente" : "No se pudo desactivar los datos";
		break;
	case 'activar':
		$rspta=$con_tip_veh->activar($id);
		echo $rspta ? "Datos activados correctamente" : "No se pudo activar los datos";
		break;
	
	case 'mostrar':
		$rspta=$con_tip_veh->mostrar($id);
		echo json_encode($rspta);
		break;

    case 'listar':
		$rspta=$con_tip_veh->listar();
		$data=Array();

		while ($reg=$rspta->fetch_object()) {
			$data[]=array(
            "0"=>($reg->estado=='ACT')?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->id.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->id.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->id.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-primary btn-xs" onclick="activar('.$reg->id.')"><i class="fa fa-check"></i></button>',
						"1"=>$reg->conductor,
						"2"=>$reg->tipo_vehiculo,
            "3"=>($reg->estado=='ACT')?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
              );
		}
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);
		break;

		case 'selectConductor':
		  require_once "../modelos/Conductor.php";
			$conductor=new Conductor();

			$rspta=$conductor->select();

			while ($reg=$rspta->fetch_object()) {
				echo '<option value=' . $reg->id.'>'.$reg->nombre.'</option>';
			}
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