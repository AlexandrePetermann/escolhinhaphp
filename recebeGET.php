<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Recebe GET</title>
    </head>
    <body>
        <?php if (isset($_GET["name"])):
            ?>
            <h1>Exemplo de recebimento - Método GET</h1>
            Bem-vindo <?php echo $_GET["name"] ?><br>
            Seu endereço de e-mail é <?php echo $_GET["email"]; ?>
            <?php
        endif;
        ?>
        <pre> <!--Debug-->
            <?php
            var_dump($_GET);
            ?>
        </pre>

    </body>
</html>
