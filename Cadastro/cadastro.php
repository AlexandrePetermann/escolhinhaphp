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
// Inserção de dados
// Verifica se foi preenchido o e-mail
    if (isset($_POST['email']) && !empty($_POST['email'])) {
// Filtragem de entrada de dados
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
    IF ($_GET['cod'] == 'listar') {
        // Listagem de dados
        $sql = "select email, situacao, datacadastro, codigo from lista";
        $q = $conn->query($sql);
        $q->setFetchMode(PDO::FETCH_ASSOC);
        while ($r = $q->fetch()) {
            // adicionado cor
            echo "<p style='color:";
            echo $r['situacao'] ? 'green' : 'red';
            echo ";'>";
            echo $r['email'] . "\t";
            echo $r['situacao'] . "\t";
            echo $r['datacadastro'] . "\t";
            echo "<a href='cadastro.php?cod=d&hash=$r[codigo]' title='Clique para excluir'>"; // Link de exclusão
            echo $r['codigo'];
            echo "</a>";
            echo "</p>";
        }
    } elseIF ($_GET['cod'] == 'd' && isset($_GET['hash'])) {
        // Exclusão de dados
        $sql = 'delete from lista where codigo = :hash';
        $hash = filter_input(INPUT_GET, 'hash', FILTER_SANITIZE_STRING);
        $p = $conn->prepare($sql);
        $q = $p->execute(array(':hash' => $hash));
        echo "Excluido o e-mail!";
        header("Location: cadastro.php?cod=listar");
    }
// validação do e-mail
} else {
// botão cadastrar não foi pressionado
// redirecionada para a pagina inicial
    header('Location: index.php');
}