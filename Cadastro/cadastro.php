<?php

function gerarCodigo() {
    return sha1(mt_rand());
}

/*
 * Função que converte data 
 * de   AAAA-MM-DD HH:II:SS 
 * para DD/MM/AAAA HH:II:SS 
 */

function converteData($dataMysql) {
    $dataPHP = $dataMysql;
    if ($dataMysql) {
        $dataPHP = date('d/m/Y G:i:s', strtotime($dataMysql));
    }
    return $dataPHP;
}

// Faz a requisição para conexão com o DB
if ($_SERVER['SERVER_ADDR'] == '127.0.0.1') {
//require_once 'dbconfig.php';
    require_once 'dbConfigHostinger';
} ELSE {
// Inclusão da função que envia e-mail
    include_once 'emailConfirma.php';
}
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

        // Envio de e-mail para confirmação 
        $link = "<a href='HTTP://" . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'];
        $link .= "?cod=u&sit=0&email=$email'";
        $link .= "title='Clique para confirmar seu e-mail'>";
        $link .= "Clique para confirmar seu e-mail";
        $link .= "</a>";

        emailConfirma($email, $link);

        header("Location: cadastro.php?cod=listar");
    }
} elseif (isset($_GET['cod'])) {
    IF ($_GET['cod'] == 'listar') {
        // Listagem de dados
        $sql = "select * from lista";
        $q = $conn->query($sql);
        $q->setFetchMode(PDO::FETCH_ASSOC);
        while ($r = $q->fetch()) {
            // adicionado cor
            echo "<p style='color:";
            echo $r['situacao'] ? 'green' : 'red';
            echo ";'>";
            echo $r['email'] . "\t";
            echo $r['codigo'] . "\t";
            echo converteData($r['dataCadastro']) . "\t";
            echo "<a href='" . $_SERVER['PHP_SELF'];
            echo "?cod=u&sit=$r[situacao]&email=$r[email]' title='Clique para atualizar'>"; // Link de atualização
            echo $r['situacao'];
            echo "</a>";
            echo converteData($r['dataAtualizacao']) . "\t";
            echo "<a href='" . $_SERVER['PHP_SELF'];
            echo "?cod=d&hash=$r[codigo]' title='Clique para excluir'>"; // Link de exclusão
            echo "</a>";
            echo "</p>";
        }
    } elseIF ($_GET['cod'] == 'd' && isset($_GET['hash'])) {
        // Exclusão de dados
        $sql = 'delete from lista where codigo = :hash';
        $hash = filter_input(INPUT_GET, 'hash', FILTER_SANITIZE_STRING);
        $p = $conn->prepare($sql);
        $q = $p->execute(array(':hash' => $hash));
        header("Location: cadastro.php?cod=listar");
    } elseif ($_GET['cod'] == 'u' && isset($_GET['sit']) && isset($_GET['email'])) {
        // atualização de dados
        $email = filter_input(INPUT_GET, 'email', FILTER_SANITIZE_STRING);
        IF ($_GET['sit'] == '1') {
            $sql = 'update lista set '
                    . 'dataAtualizacao = NULL, '
                    . 'situacao = 0 '
                    . 'Where email = :email';
        } else {
            $sql = 'update lista set '
                    . 'dataAtualizacao = Now(), '
                    . 'situacao = 1 '
                    . 'Where email = :email';
        }
        $p = $conn->prepare($sql);
        $q = $p->execute(array(':email' => $email));
        header("Location: cadastro.php?cod=listar");
    }
} else {
// botão cadastrar não foi pressionado
// redirecionada para a pagina inicial
    header('Location: index.php');
}