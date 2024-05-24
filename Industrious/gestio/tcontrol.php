<?php
header("Content-Type: text/html;charset=utf-8");

//Classe de CONTROLADOR
include_once ("tpass.php");
include_once ("tport.php");
include_once ("tvaixell.php");
include_once ("taccesbd.php");
include_once ("tcontrol.php");




class TControl
{
	private $servidor;
	private $usuari;
	private $paraula_pas;
	private $nom_bd;
	function __construct()
	{
		$this->servidor = "fdb1032.awardspace.net";
		$this->usuari = "4447229_navegalia";
		$this->paraula_pas = "123456789A";
		$this->nom_bd = "4447229_navegalia";
	}

	

	////////////// Mètodes per a muntar llistes desplegables als fitxers HTML i comprovacions de VISTA

	public function loginCheck($pass) {
		$res = 0;
		$av = new TPass ($pass, $this->servidor, $this->usuari, $this->paraula_pas, $this->nom_bd);
        $res = $av->loginCheck();
        return $res;
	}
	
	public function totalAtracats()
	{
		$res = 0;
		$av = new TVaixell ("","","","","","", $this->servidor, $this->usuari, $this->paraula_pas, $this->nom_bd);
        $res = $av->totalAtracats();
        return $res;
	}

	public function totalNavegant()
	{
		$res = 0;
		$av = new TVaixell ("","","","","","", $this->servidor, $this->usuari, $this->paraula_pas, $this->nom_bd);
        $res = $av->totalNavegant();
        return $res;
	}

	public function llistaVaixellsAtracats()
	{
		$res = 0;
		$av = new TVaixell ("","","","","","", $this->servidor, $this->usuari, $this->paraula_pas, $this->nom_bd);
		$res = $av->llistaVaixellsAtracats();
		return $res;
	}

	public function llistaVaixellsNavegant()
	{
		$res = 0;
		$av = new TVaixell ("","","","","","", $this->servidor, $this->usuari, $this->paraula_pas, $this->nom_bd);
		$res = $av->llistaVaixellsNavegant();
		return $res;
	}

	public function llistaPorts()
	{
		$res = 0;
		$ae = new Tport("","","",$this->servidor, $this->usuari, $this->paraula_pas, $this->nom_bd);	
		$res = $ae->llistaPorts();
		return $res;
	}
	
	
	////////// Mètodes per a realitzar les opcions de menú
	
	public function atracar($idVaixell)
	{
		$res = 0;
		$av = new TVaixell ($idVaixell,"","","","","", $this->servidor, $this->usuari, $this->paraula_pas, $this->nom_bd);
		$res = $av->atracar();
		return $res;
	}

	public function salpar($id, $portDesti)
	{
		$res = 0;
		$av = new TVaixell ($id,"","","",$portDesti,"", $this->servidor, $this->usuari, $this->paraula_pas, $this->nom_bd);
		$res = $av->salpar();
		return $res;
	}

	public function llistatNavegant ()
	{
		$res = 0;
		$ae = new TVaixell ("","","","","","", $this->servidor, $this->usuari, $this->paraula_pas, $this->nom_bd);
		$res = $ae->llistatNavegant();
		return $res;
	}

	public function llistatVaixellsAtracats ($portOrigen)
	{
		$res = 0;
		$ae = new TVaixell ("","","",$portOrigen,"","", $this->servidor, $this->usuari, $this->paraula_pas, $this->nom_bd);
		$res = $ae->llistatVaixellsAtracats();
		return $res;
	}

/////////////////////////////////////////

}