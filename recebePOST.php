<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Recebe POST</title>
    </head>
    <body>
        <h1>Exemplo de recebimento - Método POST</h1>
        Bem-vindo <?php echo $_POST["name"]; ?><br>
        Seu endereço de e-mail é <?php echo $_POST["email"]; ?>
    </body>
</html>
