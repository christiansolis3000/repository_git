<?php 
echo "nueva linea #1";
echo "modificacion #1";
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
					if( $camp == "nombre" ){
						$camps	.= 	"empresa_".$camp.",";
						$vals	.= 	"'".$val."'".",";
						$empresa = $val;
					}else if( $camp == "urbanizacion" ){
						$camps	.= 	"urbanizacion_urb_id,";
						$vals	.= 	"'".$val."'".",";
						$empresa = $val;
					}else{
						$camps	.= 	"empresa_".$camp.",";
						$vals	.= 	"'".$val."'".",";
					}

					$i++;

				}
			}

		
			$camps = substr($camps,0,strlen($camps)-1);
			$vals = substr($vals,0,strlen($vals)-1);

			

			//$result = existeEmpresa($empresa);

			//if ( $result == 0 ){
				//echo ("insert into empresa(".$camps.") values(".$vals.")");
				agregarEmpresa($camps,$vals);
				$er = "1";
			//}else{
				//$er = "2";
			//}
			echo ($er);
	}

?>