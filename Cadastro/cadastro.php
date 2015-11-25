<?php

function gerarCodigo() {
    return sha1(mt_rand());
}

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


// Verifica se foi enviado através do botão
If (isset($_POST['btn'])) {
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
        $parametros = array(':email' => $email,
            ':cod' => $cod);
        $p = $conn->prepare($sql);
        $q = $p->execute($parametros);
    }
} elseif (isset($_GET['cod'])) {
    // Listagem de dados
    $sql = "select email, situacao, datacadastro from lista";
    $q = $conn->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
    while ($r = $q->fetch()) {
        echo "<p>";
        echo $r['email'] . "\t";
        echo $r['situacao'] . "\t";
        echo $r['datacadastro'] . "\t";
    }
    // Exclusão de dados
    // validação do e-mail
} else {
    // botão cadastrar não foi pressionado
    // redirecionada para a pagina inicial
    header('Location: index.php');
}