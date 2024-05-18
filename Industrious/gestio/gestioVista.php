<?php
header("Content-Type: text/html;charset=utf-8");
include_once("tcontrol.php");

function mostrarError ($missatge)
{
	include_once("missatgeCap.html");
	echo "$missatge";
	include_once("missatgePeu.html");		
};

function mostrarMissatge ($missatge)
{
	include_once("missatgeCap.html");
	echo "$missatge";
	include_once("missatgePeu.html");		
};

// Aquí van les opcions de menú que necessiten demanar a l'usuari alguna dada addicional 
if (isset($_POST["opcio"]))
{
	$opcio = $_POST["opcio"];
	switch ($opcio)
	{
		case "Enlairar":
		{
			if (isset($_POST["idAvio"]) )
			{
				$id = $_POST["idAvio"];
				$c = new tcontrol();	
				$res = $c->enlairar($id);
				if ($res)
				{
					mostrarMissatge("Avió enlairat correctament");
				}
				else
				{
					mostrarError("Error en enlairar l'avió");
				}
			}
			break;
		}

		case "Aterrar":
		{
			if (isset($_POST["idAvio"]) && isset($_POST["aeroport"]) )
			{
				$id = $_POST["idAvio"];
				$aero = $_POST["aeroport"];
				$c = new tcontrol();
				$res = $c->aterrar($id, $aero);
				if ($res)
				{
					mostrarMissatge("Avió aterrat correctament a l'aeroport");
				}
				else
				{
					mostrarError("Error en aterrar l'avió");
				}
			}
			break;
		}

		case "Llistat":
		{
			if (isset($_POST["aeroport"]))
			{
				$aeroport = $_POST["aeroport"];
				$c = new TControl();
				$res = $c->llistatAvionsAeroport($aeroport);
				if ($res)
				{
					mostrarMissatge($res);
				}
				else
				{
					mostrarError("Error en generar la llista d'avions aterrats a $aeroport");
				}
			}
			break;	
		}

		default:
			mostrarError("Error: opció incorrecta");
	}
}





