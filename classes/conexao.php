<?php
    define('Host', 'localhost');
    define('USUARIO', 'root');
    define('SENHA', '');
    define('DB', 'rmb');
    $conexao = mysqli_connect(Host, USUARIO, SENHA, DB) or die ('Não foi possível conectar');
?>