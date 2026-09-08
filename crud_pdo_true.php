<?php
try {
    $pdo = new PDO("pgsql:dbname = crud_pdo; host = localhost; port = 5432", "postgres", "BD_1212<>");
} catch (PDOException $e) {
    echo "Erro com Banco de Dados: " . $e->getMessage();
} catch (Exception $e) {
    echo "Erro Genérico: " . $e->getMessage();
}
session_start();

$emails_salvos = $pdo->prepare("SELECT email FROM usuario");
$emails_salvos->execute();
$array_emails = $emails_salvos->fetchAll(PDO::FETCH_ASSOC);

echo "<pre>";
var_dump($array_emails);
echo "</pre>";

foreach ($array_emails as $usuarios) {
    foreach ($usuarios as $email) {
        echo $email . "<br>";
    }
    echo "<br>";
    unset($email);
}

function verificacao_email($email_atual, $array_emails) {
    foreach ($array_emails as $usuarios) {
        foreach ($usuarios as $email) {
            if ($email_atual == $email) {
                echo $email_atual;
                return false;
            }
        }
    }
    return true;
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
            <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
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
        if (isset($_POST['enviar'])) {
            $nome = $_POST["nome"] ?? 0;
            $telefone = $_POST["telefone"] ?? 0;
            $email = $_POST["email"] ?? 0;
        }

        if (isset($nome) and isset($telefone) and isset($email) and verificacao_email($email, $array_emails)) {
            $inserir = $pdo->prepare("INSERT INTO usuario(nome, telefone, email) VALUES (:nome, :telefone, :email)");
            $inserir->bindValue(":nome", $nome);
            $inserir->bindValue(":telefone", $telefone);
            $inserir->bindValue(":email", $email);
            $inserir->execute();

            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } elseif (!(isset($nome) and isset($telefone) and isset($email))) {
            echo "Preencha todos os campos";
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