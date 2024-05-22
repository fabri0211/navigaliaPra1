<?php
header("Content-Type: text/html;charset=utf-8");
include_once ("tcontrol.php");
//include_once ("tpass.php");
//include_once ("tport.php");
//include_once ("tvaixell.php");

function mostrarError ($missatge)
{
	include_once("missatge.html");
			
};

function mostrarMissatge ($missatge)
{
	include_once("missatge.html");
			
};

//////////////////////////// CODI /////////////////////

if (isset($_POST["opcio"]))
{
	$opcio = $_POST["opcio"];
	switch ($opcio)
	{
		case "Salpar":
			//comprobem que es pot enlairar un avió
			$c = new tcontrol();
			$numAtracats = $c->totalAtracats();

			//Si encara hi ha avions aterrats
			if ($numAtracats > 0)
			{
				include_once("salpar.html");
			}
			else
			{
				mostrarError("Tots els vaixells estan navegant");
			}
			
			break;
		
		case "Atracar":
			// comprovem que es pot aterrar algún avió
			$c = new tcontrol();
			$numNavegant = $c->totalNavegant();
			//si hi ha algún avió volant, es pot aterrar
			if ($numNavegant > 0)
			{
				include_once("atracar.html");	
			}
			else
			{
				mostrarError("No hi ha cap vaixell navegant");

			}
			break;
		
		case "Navegant":
			include_once("llistatNavegant.html");
			break;

		case "Atracats":
			include_once("llistatAPort.html");
			break;
				
		default:
			echo "<br>ERROR: Opció no disponible<br>";

	}
}
?>