<?php
//Chama os dados que foram definidos no ficheiro connect.php
require_once "connect.php";
//Classe responsavel por connectar a base de dados
class Connect_db{   
    private static $instance;
    //Cria uma conexão com a base de dados
    public static function getConnection()
    {
        if (!isset(self::$instance)) {
            try {
                self::$instance = new PDO("mysql:host=" . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        return self::$instance;
    }
    //Onde todas a query sql serão tratadas
    public static function prepare($sql){
        return self::getConnection()->prepare($sql);
    }
}
?>