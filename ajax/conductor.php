<?php 
require_once "../modelos/Conductor.php";
if (strlen(session_id())<1) 
	session_start();

$auxiliar=new Conductor();

$id=isset($_POST["id"])? limpiarCadena($_POST["id"]):"";
$tipo_identificacion=isset($_POST["tipo_identificacion"])? limpiarCadena($_POST["tipo_identificacion"]):"";
$identificacion=isset($_POST["identificacion"])? limpiarCadena($_POST["identificacion"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$licencia=isset($_POST["licencia"])? limpiarCadena($_POST["licencia"]):"";
$clase_licencia=isset($_POST["clase_licencia"])? limpiarCadena($_POST["clase_licencia"]):"";
$fecha_vencimiento_licencia=isset($_POST["fecha_vencimiento_licencia"])? limpiarCadena($_POST["fecha_vencimiento_licencia"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$fecha_nacimiento=isset($_POST["fecha_nacimiento"])? limpiarCadena($_POST["fecha_nacimiento"]):"";
$sctr_pension=isset($_POST["sctr_pension"])? limpiarCadena($_POST["sctr_pension"]):"";
$sctr_salud=isset($_POST["sctr_salud"])? limpiarCadena($_POST["sctr_salud"]):"";
$carnet_sanidad=isset($_POST["carnet_sanidad"])? limpiarCadena($_POST["carnet_sanidad"]):"";
$sexo=isset($_POST["sexo"])? limpiarCadena($_POST["sexo"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$correo_electronico=isset($_POST["correo_electronico"])? limpiarCadena($_POST["correo_electronico"]):"";
$id_usuario_asociado=isset($_POST["id_usuario_asociado"])? limpiarCadena($_POST["id_usuario_asociado"]):"";
$estado=isset($_POST["estado"])? limpiarCadena($_POST["estado"]):"";
$id_usuario_modifica=$_SESSION["idusuario"];
$fecha_modifica=date("Y-m-d H:i:s", time());

switch ($_GET["op"]) {
	case 'guardaryeditar':
	if (empty($id)) {
		$rspta=$auxiliar->insertar($tipo_identificacion,$identificacion,$nombre,$licencia,$clase_licencia,$fecha_vencimiento_licencia,$fecha_nacimiento,$sctr_pension,$sctr_salud,$carnet_sanidad,$sexo,$direccion,$telefono,$correo_electronico,$id_usuario_asociado,$estado,$id_usuario_modifica,$fecha_modifica);
		echo $rspta ? "Datos registrados correctamente" : "No se pudo registrar los datos";
	}else{
         $rspta=$auxiliar->editar($id,$tipo_identificacion,$identificacion,$nombre,$licencia,$clase_licencia,$fecha_vencimiento_licencia,$fecha_nacimiento,$sctr_pension,$sctr_salud,$carnet_sanidad,$sexo,$direccion,$telefono,$correo_electronico,$id_usuario_asociado,$estado,$id_usuario_modifica,$fecha_modifica);
		echo $rspta ? "Datos actualizados correctamente" : "No se pudo actualizar los datos";
	}
		break;
	

	case 'desactivar':
		$rspta=$auxiliar->desactivar($id);
		echo $rspta ? "Datos desactivados correctamente" : "No se pudo desactivar los datos";
		break;
	case 'activar':
		$rspta=$auxiliar->activar($id);
		echo $rspta ? "Datos activados correctamente" : "No se pudo activar los datos";
		break;
	
	case 'mostrar':
		$rspta=$auxiliar->mostrar($id);
		echo json_encode($rspta);
		break;

    case 'listar':
		$rspta=$auxiliar->listar();
		$data=Array();

		while ($reg=$rspta->fetch_object()) {
			$data[]=array(

            "0"=>($reg->estado=='ACT')?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->id.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->id.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->id.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-primary btn-xs" onclick="activar('.$reg->id.')"><i class="fa fa-check"></i></button>',
						"1"=>$reg->tipo_identificacion,
						"2"=>$reg->identificacion,
						"3"=>$reg->nombre,
						"4"=>$reg->licencia,
						"5"=>$reg->clase_licencia,
						"6"=>$reg->fecha_vencimiento_licencia,
						"7"=>$reg->id_usuario_asociado,
            "8"=>($reg->estado=='ACT')?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
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