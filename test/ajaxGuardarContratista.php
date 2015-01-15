<?php 
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
					$camps	.= 	"contratista_".$camp.",";
					$vals	.= 	"'".$val."'".",";
					$i++;

				}
			}

		
			$camps = substr($camps,0,strlen($camps)-1);
			$vals = substr($vals,0,strlen($vals)-1);

			//echo ("INSERT INTO  urbanizacion (".$camps.") VALUES(".$vals.")");
			agregarContratista($camps,$vals);
			$er = "1";
			echo ($er);
	}

?>