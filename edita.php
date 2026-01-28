<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intro PHP</title>
</head>

<body>
    <header>
        <h1>Intro PHP</h1>
    </header>
    <main>
        <?php
        require_once './g_acessabanco.php';

        // echo '<pre>';
        // var_dump($_REQUEST);
        // var_dump($_GET);
        // var_dump($_POST);
        // echo '</pre>';
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $idade = $_POST['idade'];

        if (editaRegistroNoBanco($id, $nome, $idade)) {
            echo 'Salvou!';
        } else {
            echo 'Não salvou!';
        }
        ?>
        <a href="./form.html">Voltar para o form</a>
    </main>
    <footer>
        <p>DEW I 2025.</p>
    </footer>
</body>

</html>