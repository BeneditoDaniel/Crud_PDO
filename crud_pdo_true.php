<?php
try {
    $pdo = new PDO("pgsql:dbname = crud_pdo; host = localhost; port = 5432", "postgres", "BD_1212<>");
} catch (PDOException $e) {
    echo "Erro com Banco de Dados: " . $e->getMessage();
} catch (Exception $e) {
    echo "Erro Genérico: " . $e->getMessage();
}
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud_PDO</title>
</head>
<body>
    <main>
        <section>
            <h1>CADASTRAR USUÁRIO</h1>
            <form action="<?= $_SERVER["PHP_SELF"] ?>" method="get">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome">

                <label for="telefone">Telefone</label>
                <input type="text" id="telefone" name="telefone">
                
                <label for="email">Email</label>
                <input type="text" id="email" name="email">

                <input type="submit" value="Cadastrar">
            </form>
        </section>
        <section>
            
        </section>
    </main>
</body>
</html>