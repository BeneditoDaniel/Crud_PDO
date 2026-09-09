<?php

//-----------CONECTANDO COM BD

try {
    $pdo = new PDO("pgsql:dbname = crud_pdo; host = localhost; port = 5432", "postgres", "BD_1212<>");
} catch (PDOException $e) {
    echo "Erro com Banco de Dados: " . $e->getMessage();
} catch (Exception $e) {
    echo "Erro Genérico: " . $e->getMessage();
}
session_start();



//------------LENDO OS USUÁRIOS JÁ CADASTRADOS

$usuarios_salvos = $pdo->prepare("SELECT * FROM usuario");
$usuarios_salvos->execute();
$array_usuarios = $usuarios_salvos->fetchAll(PDO::FETCH_ASSOC);

echo "<pre>";
var_dump($array_usuarios);
echo "</pre>";



//------------LENDO OS EMAILS JÁ CADASTRADOS

$emails_salvos = $pdo->prepare("SELECT email FROM usuario");
$emails_salvos->execute();
$array_emails = $emails_salvos->fetchAll(PDO::FETCH_ASSOC);

echo "<pre>";
var_dump($array_emails);
echo "</pre>";




//-------------VERIFICAÇÃO SE O EMAIL COLOCADO JÁ EXISTE

function verificacao_email($email_atual, $array_emails)
{
    foreach ($array_emails as $usuarios) {
        foreach ($usuarios as $email) {
            if ($email_atual == $email) {
                echo "Email já cadastrado";
                return false;
            }
        }
    }
    return true;
}



//--------------STARTANDO VARIÁVEL PARA LEMBRAR INFORMAÇÕES DO INPUT

if (!isset($_SESSION['ultimo_nome'])) {
    $_SESSION['ultimo_nome'] = "";
}
if (!isset($_SESSION['ultimo_telefone'])) {
    $_SESSION['ultimo_telefone'] = "";
}
if (!isset($_SESSION['ultimo_email'])) {
    $_SESSION['ultimo_email'] = "";
}




//------------VERIFICANDO SE O BOTÃO FOI CLICADO, SE SIM, ATRIBUIR OS VALORES OBTIDOS NOS INPUTS ÀS VARIÁVEIS

if (isset($_POST["enviar"])) {
    $nome = $_POST["nome"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];
}


//-------------VERIFICANDO SE OS VALORES SÃO CONDIZENTES AOS ESPERADOS E OS ENVIANDO PARA O BD

if ((empty($nome) or empty($telefone) or empty($email)) and isset($_POST['enviar'])) {
    echo "Preencha todos os campos";

    if (!empty($nome)) {
        $_SESSION['ultimo_nome'] = $nome;
    } else {
        $_SESSION['ultimo_nome'] = "";
    }

    if (!empty($telefone)) {
        $_SESSION['ultimo_telefone'] = $telefone;
    } else {
        $_SESSION['ultimo_telefone'] = "";
    }

    if (!empty($email)) {
        $_SESSION['ultimo_email'] = $email;
    } else {
        $_SESSION['ultimo_email'] = "";
    }

} elseif (!empty($nome) and !empty($telefone) and !empty($email) and verificacao_email($email, $array_emails)) {
    $inserir = $pdo->prepare("INSERT INTO usuario(nome, telefone, email) VALUES (:nome, :telefone, :email)");
    $inserir->bindValue(":nome", $nome);
    $inserir->bindValue(":telefone", $telefone);
    $inserir->bindValue(":email", $email);
    $inserir->execute();

    unset($_SESSION['ultimo_nome']);
    unset($_SESSION['ultimo_telefone']);
    unset($_SESSION['ultimo_email']);

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>



<!------------------CÓDIGO HTML DO FORMULÁRIO-->

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
                <input type="text" id="nome" name="nome" value="<?= $_SESSION['ultimo_nome'] ?>">

                <label for="telefone">Telefone</label>
                <input type="text" id="telefone" name="telefone" value="<?= $_SESSION['ultimo_telefone'] ?>">

                <label for="email">Email</label>
                <input type="text" id="email" name="email" value="<?= $_SESSION['ultimo_email'] ?>">

                <button type="submit" name="enviar">Cadastrar</button>
            </form>
        </section>


        <!----------------CÓDIGO HTML DA TABELA-->

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
                    <?php 
                    foreach ($array_usuarios as $usuarios) {
                        echo "<tr>";
                        foreach ($variable as $key => $value) {
                            # code...
                        }
                        echo "</tr>";
                    }
                    ?>
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