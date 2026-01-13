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
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOME</th>
                    <th>IDADE</th>
                </tr>
            </thead>
            <tbody>
            <?php
            require_once './g_acessabanco.php';
            $lista = buscaListaDoBanco();
            foreach ($lista as $pessoa) {
                echo '<tr>';
                echo '<td>' . $pessoa['id'] . '</td>';
                echo '<td>' . $pessoa['nome'] . '</td>';
                echo '<td>' . $pessoa['idade'] . '</td>';
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>    
        <a href="./g_form.html">Voltar para o form</a>
    </main>
    <footer>
        <p>DEW I 2025.</p>
    </footer>
</body>
</html>