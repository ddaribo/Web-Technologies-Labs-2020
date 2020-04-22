<?php

class DBConnect{
        
        private $connection;

        function __construct(){
            $dbhost = "localhost";
            $username = "root";
            $pass = "";
            $dbname = "exercise";

            try{
                $this->connection = new PDO("mysql:host=$dbhost;dbname=$dbname",$username, $pass,
                [
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]); /*this is an array */
            } catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        public function getConnection(){
            return $this->connection;
        }

        public function dbinsert($title, $description, $lecturer){
           try{

               $insertStatement = $this->connection->prepare(
                   "INSERT INTO electives (title, description, lecturer) VALUES (:title, :description, :lecturer);"
               );
    
               $insertResult = $insertStatement->execute([
                   'title' => $title,
                   'description' => $description,
                   'lecturer' => $lecturer,
               ]);
               
               if($insertResult){
                   echo json_encode(['success' => true]);
               } else{
                   var_dump($insertStatement->errorInfo());
                   echo json_encode(['success' => false]);
               }
           }catch(PDOException $e){
                echo $e->getMessage();
           }
        }

        public function dbSelectAll(){
            try{
                $fecthStatement = $this->connection->prepare("SELECT * FROM `electives`");
                $fecthStatement->execute([]); /*Needs array parameter*/
                $electives = $fecthStatement->fetchAll();

                foreach($electives as $elective ){
                   echo json_encode($elective, JSON_UNESCAPED_UNICODE); 
                   /*without this constant json_encode escapes cyrilic characters as ascii code in the browser - this fixes the issue*/
                   echo "<br>";
                }
            }catch(PDOException $e){
                echo $e->getMessage();
           }
        }
    }

?>