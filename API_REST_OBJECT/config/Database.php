<?php
Class Database 
{
    private $host = "localhost";
    private $port = "3306";
    private $dbname = "API_REST";
    private $idBDD = "root";
    private $mdpBDD = "root";

    public function getConnection()
    {
        $connection = null;

        try{
            $connection = new PDO("mysql:host=$this->host:$this->port;dbname=$this->dbname", $this->idBDD, $this->mdpBDD,        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        } catch(PDOException $exception){
            echo "Erreur de connection : " . $exception->getMessage();
        }

        return $connection;
    }

}

//     $pdo = new PDO("mysql:host=localhost:3306;dbname=exempleprojet",$idBDD,$mdpBDD);
?>