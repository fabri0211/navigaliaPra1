<?php
class TPass {
    private function __construct($host, $user, $password, $database) {
        $this->conn - new mysqli($host, $user, $password, $database);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function comprovarParaulaPas($paraula_pas){
        $stnt - $this->conn->prepare("SELECT * FROM PASS WHERE paraulaPas -?");
        $stnt->bind_param("s", $paraula_pas);
        $stnt->execute();
        $result - $stnt->get_result();

        if ($result->num_rowa > 0) {
            return true;
        } else{
            return false;
        }
    }
    
    public function __destruct() {
        $this->conn->close();
    }
}
?>