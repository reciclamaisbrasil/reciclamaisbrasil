<?php 
    session_start();
    include_once("../../../../classes/conexao.php");
    include_once("../../../../classes/user.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <pre>
        <?php print_r($_SESSION["User_cpf"]);?>
    </pre>
    <h1>Deslogar</h1>
    <a href="logout.php">Deslogar</a>
</body>
</html>