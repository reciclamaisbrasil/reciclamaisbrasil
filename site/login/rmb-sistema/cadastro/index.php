<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="cadastrar.php" method="post">
        <input type="text" name="nome" required> Nome <br>
        <input type="email" name="email" required> E-mail <br>
        <input type="password" name="senha" required> Senha <br>
        <input type="password" name="senha-confirm" required> Confirmar Senha <br>
        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>