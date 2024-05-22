<?php
include_once ("tcontrol.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['password'])) {
        $inputPassword = $_POST['password'];
        
				$c = new tcontrol();	
				$res = $c->loginCheck($inputPassword);
				if ($res)
				{
                    include_once("gestio.html");
					
				}
				else
				{
					echo("Contrasenya incorrecta");
				}
       
}
}

?>
