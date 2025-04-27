<?php
// Verifica se o parâmetro ID foi passado
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    // Inclui o arquivo de configuração
    require_once "config.php";

    // Prepara a variável de ID
    $param_id = trim($_GET["id"]);

    // Prepara a instrução SQL
    $sql = "SELECT * FROM insumos WHERE id = $1";

    // Prepara a query no PostgreSQL
    $stmt = pg_prepare($link, "read_insumo", $sql);

    if ($stmt) {
        // Executa a consulta passando o parâmetro
        $result = pg_execute($link, "read_insumo", array($param_id));

        if ($result && pg_num_rows($result) == 1) {
            $row = pg_fetch_assoc($result);

            // Recupera os dados
            $name = $row["nome"];
            $type = $row["tipo"];
            $quantity = $row["quantidade"];
            $value = $row["valor"];
        } else {
            // Redireciona para a página de erro se não encontrar
            header("location: error.php");
            exit();
        }
    } else {
        echo "Ocorreu um erro ao preparar a consulta.";
        exit();
    }

    // Fecha a conexão
    pg_close($link);
} else {
    // Redireciona se o ID não for informado
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Visualizar Insumo</title>
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
                    <h1 class="mt-5 mb-3">Visualizar Insumo</h1>
                    <div class="form-group">
                        <label>Nome do Produto</label>
                        <p><b><?php echo htmlspecialchars($name); ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Tipo do Material</label>
                        <p><b><?php echo htmlspecialchars($type); ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Quantidade</label>
                        <p><b><?php echo htmlspecialchars($quantity); ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Valor</label>
                        <p><b>R$ <?php echo number_format($value, 2, ',', '.'); ?></b></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Voltar</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
