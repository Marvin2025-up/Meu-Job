<?php 
class Conexao {
    private static $host = "localhost";
    private static $user = "root";
    private static $pass = "";
    private static $dbname = "sistema_presenca";
    private static $port = 3307;
    private static $con = null;


    public static function ligar(){
        if(self::$con === null){
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            try{
                self::$con = new mysqli(
                    self::$host, 
                    self::$user,
                    self::$pass,
                    self::$dbname,
                    self::$port
                );
                self::$con->set_charset("utf8mb4");
            } catch (Exception $e){
                die("Erro ao conecta a Base de dados". $e->getMessage());
            }
        }
        return self::$con;
    }
}
?>