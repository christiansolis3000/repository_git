<?php 

echo "adding new line from master";
echo "nueva linea #1";
include ("db.php");

include ("inc.functions.php");

//print_r($_GET);

if($_GET["accion"]=="guardar")
	{
	    $nuevo = "0"; 
		$camps = "";
		$vals = "";
		$i =0;
			foreach($_GET as $camp => $val)
			{
				if( ( $camp!="accion" ) )
				{
					if( $camp =="hora" ){
						$camps	.= 	"";
						$vals	.= 	"";						
					}else if($camp =="urb_id" ){
						$camps	.= 	"urbanizacion_urb_id,";
						$vals	.= 	"'".$val."'".",";
					}else if($camp =="empresa" ){
						$camps	.= 	"empresa_emp_id,";
						$vals	.= 	"'".$val."'".",";
						$idAlternoEmp = obtenerEmpIdAlterno($val);
						$oidAlternoEmp = mysql_fetch_assoc($idAlternoEmp);
						$idAlterno = $oidAlternoEmp["empresa_id_alterno"];
					}else if($camp =="contratista" ){
						$camps	.= 	"contratista_id_alterno,";
						$vals	.= 	"'".$val."'".",";
						$tContratista = obtenerTipoContratista($val);
						$otipoContratista = mysql_fetch_assoc($tContratista);
						$tipoContratista = $otipoContratista["contratista_tipo"];
					}else if($camp =="fecha_inicio" ){
						list($mes,$dia,$anio) = explode("/",$val);
						$camps	.= 	"concurso_fecha_inicio,";
						$vals	.= 	"'".$anio."-".$mes."-".$dia." ".$_GET["hora"]."',";
						
					}else{
						$camps	.= 	"concurso_".$camp.",";
						$vals	.= 	"'".$val."'".",";
						$i++;
					}
				}
			}

			$camps 	.='contratista_tipo_proveedor,empresa_id_alterno,';
			$vals .= "'".$tipoContratista."','".$idAlterno."',";
			$camps = substr($camps,0,strlen($camps)-1);
			$vals = substr($vals,0,strlen($vals)-1);

			//echo ("INSERT INTO  urbanizacion (".$camps.") VALUES(".$vals.")");
			agregarConcurso($camps,$vals);
			$er = "1";
			echo ($er);
	}

?>