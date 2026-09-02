<?php 
    try {
        $pdo = new PDO("pgsql:dbname = crud_pdo; host = localhost; port = 5432", "postgres", "BD_1212<>");
    } catch (PDOException $e) {
        echo "Erro com Banco de Dados: " . $e->getMessage();
    } catch (Exception $e) {
        echo "Erro Genérico: " . $e->getMessage();
    }



    /*
    $dados = $pdo -> prepare("INSERT INTO usuario(nome, telefone, email) VALUES (:nome, :telefone, :email)");
    $dados -> bindValue(":nome", "José");
    $dados -> bindValue(":telefone", "66666666");
    $dados -> bindValue(":email", "jose@gmail.com");
    $dados -> execute();
    */


    
?>