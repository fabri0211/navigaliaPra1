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

    public function llistaVaixells()
    {
        $res = false;
        if ($this->abd->consulta_SQL("select codi, ciutat from port order by codi"))
        {   
            $fila = $this->abd->consulta_fila();
            $res =  "<select name='port'>";
            while ($fila != null)
            {
                $codi = $this->abd->consulta_dada('codi');
                $ciutat = $this->abd->consulta_dada('ciutat');
                            
                $res = $res . "<option value='" . $fila["codi"] . "'>".$fila["ciutat"]." - " . $fila["ciutat"]. "</option>";
               
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