<?php
//Classe de MODEL encarregada de la gestió de la taula AVIO de la base de dades
include_once ("taccesbd.php");
class TVaixell
{
    private $id;
    private $nom;
    private $numPassatgers;
    private $portOrigen;
    private $portDesti;
    private $imatge;
    private $abd;
    function __construct($v_id, $v_nom, $v_numPassatgers, $v_portOrigen, $v_portDesti, $v_imatge, $servidor, $usuari, $paraula_pas, $nom_bd)
    {
        $this->id = $v_id;
        $this->nom = $v_nom;
        $this->numPassatgers = $v_numPassatgers;
        $this->portOrigen = $v_portOrigen;
        $this->portDesti = $v_portDesti;
        $this->imatge = $v_imatge;
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

    public function totalAtracats()
	{
		$res = 0;
        $sql = "select count(*) as quants from vaixell where portDesti is null";
	
        if ($this->abd->consulta_SQL($sql) )
        {
			
            if ($this->abd->consulta_fila())
            {
                $res = ($this->abd->consulta_dada('quants'));
            }
        }
        return $res;
	}

	public function totalNavegant()
	{
        $res = 0;
		$sql = "select count(*) as quants from vaixell where portDesti is not null";
		if ($this->abd->consulta_SQL($sql) )
        {
            if ($this->abd->consulta_fila())
            {
                $res = ($this->abd->consulta_dada('quants'));
            }
        }
        return $res;
	}

    public function llistaVaixellsNavegant()
    {
        $res = $this->llistaVaixells("select id, nom, numPassatgers from vaixell where portDesti is not null");
        return $res;
    }

    public function llistaVaixellsAtracats()
    {
        $res = $this->llistaVaixells("select id, nom, numPassatgers from vaixell where portDesti is null");
        return $res;
    }

    public function llistaVaixells($SQL)
    {
        $res = false;

        if ($this->abd->consulta_SQL($SQL))
        {   
            $fila = $this->abd->consulta_fila();
            if ($fila == null)
            {
                $res = "<br><h2>Tots els vaixells estan navegant!</h2><br>";
            }
            else
            {
                $res = "<select  name='id'> ";
                while ($fila != null)
                {
                    $id = $this->abd->consulta_dada('id');
                    $nom = $this->abd->consulta_dada('nom'); 
                    $numPassatgers = $this->abd->consulta_dada('numPassatgers');
                    
                    
                    $res = $res . "<option value='" . $id . "'>";
                    $res = $res . "ID : $id - $nom - $numPassatgers </option>";
                    $fila = $this->abd->consulta_fila();
                }
                $res = $res . "</select>";
            }
            $this->abd->tancar_consulta();
        }
        return $res;
    }



    public function salpar ()
	{
        
		$res = false;
        $sql = "UPDATE vaixell SET portDesti = '" . $this->portDesti . "' WHERE id = " . $this->id . ";";
        

        if ($this->abd->consulta_SQL($sql))
        {
            $res = true;      
        }
    
        return $res;
	}

	function atracar ()
	{
        $res = false;
        $sql = "UPDATE vaixell SET portOrigen = '" . $this->portDesti ."' WHERE id = '". $this->id ."';";
        if ($this->abd->consulta_SQL($sql))
        {
            $res = true;       
        }
        return $res;
	}

    public function llistatNavegant()
    {
        $res = false;
        if ($this->abd->consulta_SQL("select * from vaixell where portDesti is not null"))
        {   
            $fila = $this->abd->consulta_fila();
            $res =  "<table border=1><tr bgcolor='lightgray'>
                        <th>id</th><th>nom</th><th>numPassatgers</th>
                    </tr> ";
            while ($fila != null)
            {
                $id = $this->abd->consulta_dada('id');
                $nom = $this->abd->consulta_dada('nom');
                $numPassatgers = $this->abd->consulta_dada('numPassatgers');
   
                $res = $res . "<tr>";
                $res = $res . "<td>$id</td>";
                $res = $res . "<td>$nom</td>";
                $res = $res . "<td align='right'>$numPassatgers</td>";
                $res = $res . "</tr>";
                $fila = $this->abd->consulta_fila();
            }
            $res = $res . "</table>";
            $this->abd->tancar_consulta();
        }
        else
        {
            $res = "<h2>No s'ha pogut realitzar el llistat de vaixells navegant.</h2>";
        }
        return $res; 
    }


    private function escriuCapsalera ($codi, $ciutat, $capacitat)
    {
        $res = "<h1>Dades port</h1>";
        $res = $res . "<h2>El port de $codi situat a $ciutat te $capacitat molls per atracar</h2><br>";
        return $res;
    }


    public function llistatVaixellsAtracats ()
	{
        
		$res = false;
        $sql = "SELECT codi, ciutat, capacitat FROM port WHERE codi = '$this->portOrigen'";

        if ($this->abd->consulta_SQL($sql))
        {
            $fila = $this->abd->consulta_fila();
            $codi = $this->abd->consulta_dada('codi');
            $ciutat = $this->abd->consulta_dada('ciutat');
            $capacitat = $this->abd->consulta_dada('capacitat');
            $res = $this->escriuCapsalera ($codi, $ciutat, $capacitat);
            $sql = "SELECT id, nom, numPassatgers FROM vaixell WHERE port = '$this->portOrigen'";
            if ($this->abd->consulta_SQL($sql))
            {   
                $fila = $this->abd->consulta_fila();
                $res = $res . "<table border=1><tr bgcolor='lightblue'><th>ID Vaixell</th><th>Nom</th><th>Núm. Passatgers</th></tr> ";
                while ($fila != null)
                {
                    $id = $this->abd->consulta_dada('id');
                    $nom = $this->abd->consulta_dada('nom');
                    $numPassatgers = $this->abd->consulta_dada('numPassatgers');
                    
                    $res = $res . "<tr>";
                    $res = $res . "<td align='center'> $id </td>";
                    $res = $res . "<td align='center'> $nom </td>";
                    $res = $res . "<td align='center'> $numPassatgers </td>";
                    $res = $res ."</tr>";
                             
                    $fila = $this->abd->consulta_fila();
                }
                $res = $res . "</table><br>";
                $this->abd->tancar_consulta();
            }
        }
        return $res;
	}
///////////////////////////////////////////////////





}