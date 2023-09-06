<?php
include_once('conexao/conexao.php');

$db = new Database();

class Crud{
    private $conn;
    private $table_name = "animais";

    public function __construct($db){
        $this->conn = $db;
    }

    public function create($postValues){
        $nome = $postValues['nome'];
        $idade = $postValues['idade'];
        $sexo = $postValues['sexo'];
        $especie = $postValues['especie'];

        $query = "INSERT INTO ". $this->table_name . " (nome, idade, sexo, especie) VALUES (?,?,?,?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$nome);
        $stmt->bindParam(2,$idade);
        $stmt->bindParam(3,$sexo);
        $stmt->bindParam(4,$especie);

        $rows = $this->read();
        if($stmt->execute()){
            print "<script>alert('Cadastro Ok!')</script>";
            print "<script> location.href='?action=read'; </script>";
            return true;
        }else{
            return false;
        }
    }

    public function read(){
        $query = "SELECT * FROM ". $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function update($postValues){
        
        $id = $postValues['id'];
        $modelo = $postValues['nome'];
        $marca = $postValues['idade'];
        $placa = $postValues['sexo'];
        $cor = $postValues['especie'];

        if(empty($id) || empty($nome) || empty($idade) || empty($sexo) || empty($especie) ){
            return false;
        }
        
        $query = "UPDATE ". $this->table_name . " SET nome = ?, idade = ?, sexo = ?, especie = ?, WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$nome);
        $stmt->bindParam(2,$idade);
        $stmt->bindParam(3,$sexo);
        $stmt->bindParam(4,$especie);
        $stmt->bindParam(6,$id);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }

    }
        public function readOne($id){
            $query = "SELECT * FROM ". $this->table_name . " WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);

        }

    }
?>