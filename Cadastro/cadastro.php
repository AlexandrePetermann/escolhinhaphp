<?php

function gerarCodigo() {
    return sha1(mt_rand());
}

// Verifica se foi enviado através do botão
If (isset($_POST['btn'])) {
    // Faz a requisição para conexão com o DB
    require_once 'dbconfig.php';
    /*
      Conexão com o banco de dados
     */
    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    } catch (PDOException $pe) {
        die("Não foi feito a conexão com $dbname, erro: " . $pe->getMessage());
    }

    /*
      Recepção de dados
     */
//    echo "<h1>$_POST[email]</h1>";
    // Verifica se foi preenchido o e-mail
    if (isset($_POST['email']) && !empty($_POST['email'])) {
        // FIltragem de entrada de dados
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $cod = gerarCodigo();
        // String SQL
        $sql = "Insert Into lista (email,codigo,datacadastro) values(:email,:cod,now())";
        $parametros = array(':email'=>$email, 
                            ':cod'=> $cod);
        $p = $conn->prepare($sql);
        $q = $p->execute($parametros);
    }
} else {
    // botão cadastrar não foi pressionado
    // redirecionada para a pagina inicial
    header('Location: index.php');
}
$conn = null;

