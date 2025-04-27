<?php
// Processa a operação de exclusão após a confirmação
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Inclui o arquivo de configuração
    require_once "config.php";

    // Prepara uma declaração de exclusão
    $sql = "DELETE FROM insumos WHERE id = $1";

    // Prepara a consulta
    $stmt = pg_prepare($link, "delete_query", $sql);

    if ($stmt) {
        // Define o parâmetro
        $param_id = trim($_POST["id"]);

        // Executa a consulta preparada
        $result = pg_execute($link, "delete_query", array($param_id));

        if ($result) {
            // Registro excluído com sucesso. Redireciona para a página inicial
            header("location: index.php");
            exit();
        } else {
            echo "Algo deu errado. Por favor, tente novamente mais tarde.";
        }
    } else {
        echo "Erro ao preparar a declaração.";
    }

    // Fecha a conexão
    pg_close($link);
} else {
    // Verifica a existência do parâmetro id
    if (empty(trim($_GET["id"]))) {
        // A URL não contém o parâmetro id. Redireciona para a página de erro
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Excluir Insumo</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="wrapper">
        <header>
            <div class="logo" id="logo-placeholder">
                <img src="logo.jpg" height="50px" alt="logo">
            </div>
            <h1>Insumos Agrícolas</h1>
        </header>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-4 mb-3">Excluir Insumo</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Tem certeza de que deseja excluir este insumo?</p>
                            <p>
                                <input type="submit" value="Sim" class="btn btn-danger">
                                <a href="index.php" class="btn btn-secondary">Não</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
