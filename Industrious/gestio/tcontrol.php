<?php
header("Content-Type: text/html;charset=utf-8");

//Classe de CONTROLADOR
include_once ("tpass.php");
include_once ("tport.php");
include_once ("tvaixell.php");


class TControl
{
	private $servidor;
	private $usuari;
	private $paraula_pas;
	private $nom_bd;
	function __construct()
	{
		$this->servidor = "localhost";
		$this->usuari = "root";
		$this->paraula_pas = "usbw";
		$this->nom_bd = "navegalia";
	}

	////////////// Mètodes per a muntar llistes desplegables als fitxers HTML i comprovacions de VISTA
	
	public function totalAtracats()
	{
		$res = 0;
		$av = new TVaixell ("","","","", $this->servidor, $this->usuari, $this->paraula_pas, $this->nom_bd);
        $res = $av->totalAtracats();
        return $res;
	}

	public function totalNavegant()
	{
		$res = 0;
		$av = new TVaixell ("","","","", $this->servidor, $this->usuari, $this->paraula_pas, $this->nom_bd);
        $res = $av->totalNavegant();
        return $res;
	}

	public function llistaVaixellsAtracats()
	{
		$res = 0;
		$av = new TVaixell ("","","","", $this->servidor, $this->usuari, $this->paraula_pas, $this->nom_bd);
		$res = $av->llistaVaixellsAtracats();
		return $res;
	}
	
	public function llistaVaixellsNavegant()
	{
		$res = 0;
		$av = new TVaixell ("","","","", $this->servidor, $this->usuari, $this->paraula_pas, $this->nom_bd);
		$res = $av->llistaVaixellsNavegant();
		return $res;
	}

	public function llistaPorts()
	{
		$res = 0;
		$ae = new Tport("","",0,$this->servidor, $this->usuari, $this->paraula_pas, $this->nom_bd);	
		$res = $ae->llistaPorts();
		return $res;
	}
	
	
	////////// Mètodes per a realitzar les opcions de menú
	
	public function salpar($idVaixell)
	{
		$res = 0;
		$av = new TVaixell ($idVaixell,"","","", $this->servidor, $this->usuari, $this->paraula_pas, $this->nom_bd);
		$res = $av->salpar();
		return $res;
	}

	public function atracar($idVaixell, $idPort)
	{
		$res = 0;
		$av = new TVaixell ($idVaixell,"","",$idPort, $this->servidor, $this->usuari, $this->paraula_pas, $this->nom_bd);
		$res = $av->atracar();
		return $res;
	}

	public function llistatNavegant ()
	{
		$res = 0;
		$ae = new TVaixell ("","","","", $this->servidor, $this->usuari, $this->paraula_pas, $this->nom_bd);
		$res = $ae->llistatNavegant();
		return $res;
	}

	public function llistatVaixellsAtracats ($port)
	{
		$res = 0;
		$ae = new TVaixell ("","","",$port, $this->servidor, $this->usuari, $this->paraula_pas, $this->nom_bd);
		$res = $ae->llistatVaixellsAtracats();
		return $res;
	}

/////////////////////////////////////////

}