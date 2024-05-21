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
		case "Salpar":
		{
			if (isset($_POST["idVaixell"]) )
			{
				$id = $_POST["idVaixell"];
				$c = new tcontrol();	
				$res = $c->salpar($id);
				if ($res)
				{
					mostrarMissatge("Vaixell salpat correctament");
				}
				else
				{
					mostrarError("Error en salpar vaixel");
				}
			}
			break;
		}

		case "Atracar":
		{
			if (isset($_POST["idVaixell"]) && isset($_POST["port"]) )
			{
				$id = $_POST["idVaixell"];
				$port = $_POST["port"];
				$c = new tcontrol();
				$res = $c->atracar($id, $port);
				if ($res)
				{
					mostrarMissatge("Vaixell atracat correctament");
				}
				else
				{
					mostrarError("Error al atracar vaixell");
				}
			}
			break;
		}

		case "Llistat":
		{
			if (isset($_POST["port"]))
			{
				$port = $_POST["port"];
				$c = new TControl();
				$res = $c->llistatVaixellsAtracats($aeroport);
				if ($res)
				{
					mostrarMissatge($res);
				}
				else
				{
					mostrarError("Error en generar la llista de vaixells atracats a $port");
				}
			}
			break;	
		}

		default:
			mostrarError("Error: opció incorrecta");
	}
}





