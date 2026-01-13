<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intro PHP</title>
</head>
<body>
    <h1>Teste PHP</h1>
    <p style="color: blue;">
    <?php
        $v = 60;
        $val = 'Lourdes Da Silva';
        if($v > 50) {
           echo 'Maior';
        } else {
           echo 'Menor ou igual';
        }
    ?>
    </p>  
    <input type="text" value="<?= $val ?>">  
</body>
</html>