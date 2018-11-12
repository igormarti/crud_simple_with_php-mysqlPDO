<?php 

    class DB{

        private static $username = 'root';
        private static $password ='database';

      public function connect(){
            try{
                $c = new PDO('mysql:host=localhost;dbname=crud', self::$username, self::$password);
                $c->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              
                return $c;
            }catch(PDOException $e){
                    echo 'ERRO'.$e->getMessage();
            }

        }    


    }

   ?> 
  


