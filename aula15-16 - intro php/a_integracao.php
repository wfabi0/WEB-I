<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intro PHP</title>
</head>

<body>

    <h1>Teste PHP</h1>
    <p>
        <?php
        $v = 50;
        if ($v > 20) {
            echo "O valor é maior que 20";
        } else {
            echo "O valor é 20 ou menor";
        }
        ?>
    </p>
    <input type="text" value="<?php echo $v; ?>">

</body>

</html>