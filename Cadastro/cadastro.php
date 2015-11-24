<?php

require_once 'dbconfig.php';

// Verifica se foi enviado através do botão
If (isset($_POST['btn'])) {
    /*
      Conexão com o banco de dados
     */
    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    } catch (PDOException $pe) {
        die("Não foi feito a cone $dbname :" . $pe->getMessage());
    }

    /*
      Recepção de dados
     */
    echo "<h1>$_POST[$email]</h1>";
}  else {
    // botão cadastrar não foi pressionado
    // redirecionada para a pagina inicial
    header('Location: index.php');
}
$conn = null;

