<?php 
session_start();
require_once('db.class.php');
require_once('functions.class.php');


class User{

    private $id;
    private $name;
    private $conn;
    private $objfunc;

    public function __construct(){
        $this->objfunc = new Functions();
        $this->conn = new DB();
    }

    public function __set($atribute,$value){
        $this->atribute = $value;
    }

    public function __get($atribute){
        return $this->atribute;
    }

    public function getOne($id){
            $this->id = $id;
           try{
                $c = $this->conn->connect()->prepare('SELECT * FROM users WHERE id=:id');
                $c->bindParam(":id",$this->id);
                $c->execute();
                return $c->fetch();
           } catch(PDOException $e){
                $_SESSION['erro'] = "Ocorreu um erro";
                return 'ERRO:'. $e->getMessage();
           }

    }

    public function getAll(){
        try{
            $conn = DB::connect()->prepare('SELECT * FROM users');
            $conn->execute();
            return $conn->fetchAll();
        } catch(PDOException $e){
            $_SESSION['erro'] = "Ocorreu um erro";
            return 'ERRO:'. $e->getMessage();
        }
    }

    public function insert($data){
        print_r($data);
        $this->name = $this->objfunc->tratarCaracter($data['name'], 1);
        print_r($this->name);
        
        try{
          $c =  $this->conn->connect()->prepare("INSERT INTO users (name) VALUES(:name);");
            $c->bindParam(":name", $this->name);
            if($c->execute()){
                $_SESSION['success'] = "Salvo com sucesso";
                return "OK";
            }else{
                $_SESSION['erro'] = "Ocorreu um erro";
                return 'ERRO';
            }
        } catch(PDOException $e){
            $_SESSION['erro'] = "Ocorreu um erro";
            echo 'ERRO:'. $e->getMessage();
        }
     }

     public function update($data){
        $this->name = $this->objfunc->tratarCaracter($data['name'], 1);
        $this->id = $data['id'];
        try{
            $c = $this->conn->connect()->prepare('UPDATE users SET name=:name WHERE id=:id');
            $c->bindParam(':id',$this->id);
            $c->bindParam(':name',$this->name);
            if($c->execute()){
                $_SESSION['success'] = "Atualizado com sucesso";
                return "OK";
            }else{
                $_SESSION['erro'] = "Ocorreu um erro";
                return 'ERRO';
            }
        } catch(PDOException $e){
            $_SESSION['erro'] = "Ocorreu um erro";
            return 'ERRO:'. $e->getMessage();
        }
     }

     public function delete($id){       
        $this->id = $id;
        try{
            $c = $this->conn->connect()->prepare('DELETE FROM users WHERE id=:id');
            $c->bindParam(':id',$this->id);
            if($c->execute()){
                $_SESSION['success'] = "Deletado com sucesso";
                return "OK";
            }else{
                $_SESSION['erro'] = "Ocorreu um erro";
                return 'ERRO';
            }
        } catch(PDOException $e){
            $_SESSION['erro'] = "Ocorreu um erro";
            return 'ERRO:'. $e->getMessage();
        }
     }
    

}