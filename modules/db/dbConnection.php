<?php
    class db {
        public static function conectar() {
            try {
                $host = 'localhost';
                $dbName = 'mejias';
                $dbUser = 'root';
                $dbPassword = '';
                $conn = new PDO("mysql:host=$host; dbname=$dbName", $dbUser, $dbPassword);
                return $conn;
            } catch (PDOException $error1) {
                echo 'no es posible conectarse con la base de datos ('.$error1->getMessage().')';
            } catch (Exception $error2) {
                echo 'error general ('.$error2->getMessage().')';
            }
        }
    }
?>