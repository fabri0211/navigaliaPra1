<?php
header("Content-Type: text/html;charset=utf-8");
include_once("tcontrol.php");

function mostrarError ($missatge)
{
	include_once("missatge.html");
			
};

function mostrarMissatge ($missatge)
{
	include_once("missatge.html");
			
};

// Aquí van les opcions de menú que necessiten demanar a l'usuari alguna dada addicional 
if (isset($_POST["opcio"]))
{
	$opcio = $_POST["opcio"];
	switch ($opcio)
	{
		case "Atracar":
		{
			if (isset($_POST["id"]) )
			{
				$id = $_POST["id"];
				$c = new tcontrol();	
				$res = $c->atracar($id);
				if ($res)
				{
					mostrarMissatge("Vaixell atracat correctament");
				}
				else
				{
					mostrarError("Error en atracar vaixel");
				}
			}
			break;
		}

		case "Salpar":
		{
			if (isset($_POST["idVaixell"]) && isset($_POST["idPortDesti"]) )
			{
				$id = $_POST["idVaixell"];
				$port = $_POST["idPortDesti"];
				$c = new tcontrol();
				$res = $c->salpar($id, $port);
				if ($res)
				{
					mostrarMissatge("Vaixell salpat correctament");
				}
				else
				{
					mostrarError("Error al salpar vaixell");
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





