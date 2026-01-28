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
        require_once './acessabanco.php';
        $id = $_POST['id'];
        $p = buscaListaDoBancoPorId($id);
        ?>
        <form action="./recebe.php" method="post">
            <input type="text" id="id" name="id" value="<?= $p["id"] ?>" readonly>
            <label for="nome">Nome</label><br>
            <input type="text" id="nome" name="nome" value="<?= $p["nome"] ?>" value=""><br>
            <label for="idade">Idade</label><br>
            <input type="number" id="idade" name="idade" value="<?= $p["idade"] ?>"><br>
            <button>Enviar</button>
        </form>
    </main>
    <footer>
        <p>DEW I 2025.</p>
    </footer>
</body>

</html>