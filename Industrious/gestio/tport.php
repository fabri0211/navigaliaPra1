<?php
//Classe de MODEL encarregada de la gestió de la taula AEROPORT de la base de dades
include_once ("taccesbd.php");
class Tport
{
    private $nom;
    private $ciutat;
    private $nPistes;
    private $abd;
    function __construct($v_nom, $v_ciutat, $v_nPistes, $servidor, $usuari, $paraula_pas, $nom_bd)
    {
        $this->nom = $v_nom;
        $this->ciutat = $v_ciutat;
        $this->nPistes = $v_nPistes;
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
        if ($this->abd->consulta_SQL("select nom, ciutat from port order by nom"))
        {   
            $fila = $this->abd->consulta_fila();
            $res =  "<select name='port'>";
            while ($fila != null)
            {
                $nom = $this->abd->consulta_dada('nom');
                $ciutat = $this->abd->consulta_dada('ciutat');
                            
                $res = $res . "<option value='" . $fila["nom"] . "'>".$fila["nom"]." - " . $fila["ciutat"]. "</option>";
               
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