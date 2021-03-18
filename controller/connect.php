<?php
    //setar valores de acordo com seu banco mysql
    define( 'MYSQL_HOST', 'localhost' );
    define( 'MYSQL_USER', 'root' );
    define( 'MYSQL_PASSWORD', '' );
    define( 'MYSQL_DB_NAME', 'project_1' ); //inserir nome do banco
    // try{
    //     $pdo = new PDO( 'mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB_NAME, MYSQL_USER, MYSQL_PASSWORD );
    // }catch ( PDOException $e ){
    //     echo 'Erro ao conectar com o MariaDB: ' . $e->getMessage();
    // }

    class Conexao {
        private static $pdo;
    
        public static function get() {
            try {
                if(!isset(self::$pdo))
                    self::$pdo = new PDO('mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB_NAME, MYSQL_USER, MYSQL_PASSWORD);
                return self::$pdo;
            } catch(Exception $e) {
                throw new Exception($e->getMessage());
            }
        }
    }