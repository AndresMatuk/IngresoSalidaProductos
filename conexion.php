<?php 
require '../vendor/autoload.php';
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__); 
$dotenv->load();

    class Conectar{
        protected $dbh;

        protected function Conexion(){
            try{
                $host = $_ENV['DB_HOST'];
                $dbname = $_ENV['DB_NAME'];
                $user = $_ENV['DB_USER'];
                $password = $_ENV['DB_PASS'];

                $conectar = $this->dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
                return $conectar;
        } catch (Exception $e){
            print "error DB!! : " . $e->getMessage() . "<br/>";
            die();
        }
    }
    public function set_names(){
        return $this->dbh->query("SET NAMES 'utf8'");
    }
}
?>