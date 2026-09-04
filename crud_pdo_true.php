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

                <button type="submit" name="enviar">Cadastrar</button>
            </form>
        </section>

        <?php
        $nome = $_GET["nome"] ?? 0;
        $telefone = $_GET["telefone"] ?? 0;
        $email = $_GET["email"] ?? 0;
        $enviar = $_GET["enviar"] ?? 0;

        if (isset($_GET["enviar"])) {
            $inserir = $pdo->prepare("INSERT INTO usuario(nome, telefone, email) VALUES (:nome, :telefone, :email)");
            $inserir->bindValue(":nome", $nome);
            $inserir->bindValue(":telefone", $telefone);
            $inserir->bindValue(":email", $email);
            $inserir->execute();

            $_GET["nome"]
        }

        ?>

        <section>
            <table>
                <thead>
                    <tr>
                        <th>NOME</th>
                        <th>TELEFONE</th>
                        <th>EMAIL</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>
</body>

</html>