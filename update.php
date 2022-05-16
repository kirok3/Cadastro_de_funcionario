<?php 
        require_once "../util/config.php";
        if($_GET['id']){
            $id = $_GET['id'];
            $sql = "SELECT * FROM funcionario WHERE idfuncionario = ?";
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_array($result);
        }
        if($_SERVER['REQUEST_METHOD'] == "POST"){        
            $nome = $_POST["nome"];
            $telefone = $_POST["telefone"];
            $endereco = $_POST["endereco"];
            $id = $_POST["id"];
            $sql = "UPDATE funcionario SET nome = ?, telefone = ?, endereco = ?  WHERE idfuncionario = ?";
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, "sssi", $nome, $telefone, $endereco, $senha, $email, $id);
            if(mysqli_stmt_execute($stmt)){
                header('location: index.php');
                exit;
            } else {
                echo "Ocorreu um erro";
            }
        }
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Alterar funcionario</title>
    </head>
    <body>
    <h2>Alteração de funcionario</h2>
    <form method="post" action="update.php">
        <p>Nome:<input type="text" name="nome" value="<?php echo $row['nome'] ?>"></p>
        <p>Telefone:<input type="text" name="telefone" value="<?php echo $row['telefone'] ?>"></p>
        <p>Endereco:<input type="text" name="endereco" value="<?php echo $row['endereco'] ?>"></p>
        <input type="hidden" name="id" value="<?php echo $row['idfuncionario'] ?>">
        <p><input type="submit" value="Alterar"></p>
    </form>
    <p><a href='index.php'>Voltar</a></p>
    </body>
    </html>