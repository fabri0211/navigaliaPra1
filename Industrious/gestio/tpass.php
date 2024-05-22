<?php
//Classe de MODEL encarregada de la gestió de la taula AVIO de la base de dades
include_once ("taccesbd.php");
class TPass
{
    private $pass;
    private $abd;
    function __construct($v_pass, $servidor, $usuari, $paraula_pas, $nom_bd)
    {
        
        $this->pass = $v_pass;
        $var_abd = new TAccesbd($servidor,$usuari,$paraula_pas,$nom_bd);
        $this->abd = $var_abd;
        $this->abd->connectar_BD();
    }

    function __destruct()
    {
        if (isset($this->abd))
        {
        unset($this->abd);
        }
    }

    public function loginCheck()
	{
		$res = 0;
        $sql = "select count(*) as quants from pass where paraulaPas = '$this->pass'";
	
        if ($this->abd->consulta_SQL($sql) )
        {
			
            if ($this->abd->consulta_fila())
            {
                $res = ($this->abd->consulta_dada('quants'));
                

           } 
        }
        return $res;
	}
}