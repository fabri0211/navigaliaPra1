<?php
//Classe de MODEL encarregada de la gestió de la taula AEROPORT de la base de dades
include_once ("taccesbd.php");
class Tport
{
    private $codi;
    private $ciutat;
    private $capacitat;
    private $abd;
    function __construct($v_codi, $v_ciutat, $v_capacitat, $servidor, $usuari, $paraula_pas, $nom_bd)
    {
        $this->codi = $v_codi;
        $this->ciutat = $v_ciutat;
        $this->capacitat = $v_capacitat;
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

    public function llistaPorts()
    {
        $res = false;
        if ($this->abd->consulta_SQL("select * from port order by codi"))
        {   
            $fila = $this->abd->consulta_fila();
            $res =  "<select name='port'>";
            while ($fila != null)
            {
                $codi = $this->abd->consulta_dada('codi');
                $ciutat = $this->abd->consulta_dada('ciutat');
                $capacitat = $this->abd->consulta_dada('capacitat');
                $numVaixells = $this->abd->consulta_dada('numVaixells');
                $ocupacio = ($capacitat != 0) ? round(($numVaixells * 100) / $capacitat) : 0;
                            
                $res = $res . "<option value='" . $fila["codi"] . "'>". "Codi : " .$fila["codi"]." - " . $fila["ciutat"]. " - " .$fila["numVaixells"]. " de " .$fila["capacitat"]. " Vaixells - Ocupació: " .$ocupacio. "% ". "</option>";
               
                $fila = $this->abd->consulta_fila();
            }
            $res = $res . "</select><br>";
            $this->abd->tancar_consulta();
        }
        else
        {
            $res = "<select name='port'></select><br>";
        }
        return $res; 
    }


///////////////////////////////////////////////////

}