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


    /*
    $dados = $pdo -> prepare("SELECT * FROM usuario WHERE id = :id");
    $dados -> bindValue(":id", "1");
    $dados -> execute();
    */


    /*
    $dados = $pdo -> prepare("UPDATE usuario SET email = :email WHERE id = :id");
    $dados -> bindValue(":email", "feelgood@gmail.com");
    $dados -> bindValue(":id", "3");
    $dados -> execute();
    */


    $dados = $pdo -> prepare ("SELECT * FROM usuario");
    //$dados -> bindValue(":id", 4);
    $dados -> execute();
    $array = $dados -> fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($array as $usuarios) {
        foreach ($usuarios as $chave => $valor) {
            echo $chave . ": " . $valor . "<br>";
        }
        echo "<br>";
    }
?>