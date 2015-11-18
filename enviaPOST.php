<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Envia POST</title>
    </head>
    <body>
        <h1>Exemplo de envio - Método POST</h1>
        <form action="recebePOST.php" method="post">
            Name: <input type="text" name="name"><br>
            E-mail: <input type="text" name="email"><br>
            <input type="submit">
        </form>
        <?php
        // put your code here
        ?>
    </body>
</html>
