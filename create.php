<?php
require_once "config.php";

$nome_produto = $tipo_material = $quantidade = $valor = "";
$nome_produto_err = $tipo_material_err = $quantidade_err = $valor_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validação do nome do produto
    $input_nome_produto = trim($_POST["nome_produto"]);
    if (empty($input_nome_produto)) {
        $nome_produto_err = "Por favor, insira o nome do produto.";
    } else {
        $nome_produto = $input_nome_produto;
    }

    // Validação do tipo de material
    $input_tipo_material = trim($_POST["tipo_material"]);
    if (empty($input_tipo_material)) {
        $tipo_material_err = "Por favor, selecione o tipo do material.";
    } else {
        $tipo_material = $input_tipo_material;
    }

    // Validação da quantidade
    $input_quantidade = trim($_POST["quantidade"]);
    if (empty($input_quantidade) || !ctype_digit($input_quantidade)) {
        $quantidade_err = "Por favor, insira um valor inteiro positivo.";
    } else {
        $quantidade = (int)$input_quantidade;
    }

    // Validação do valor
    $input_valor = trim($_POST["valor"]);
    if (empty($input_valor) || !is_numeric($input_valor)) {
        $valor_err = "Por favor, insira um valor numérico.";
    } else {
        $valor = (float)$input_valor;
    }

    // Se não houver erros, insere no banco de dados
    if (empty($nome_produto_err) && empty($tipo_material_err) && empty($quantidade_err) && empty($valor_err)) {
        $sql = "INSERT INTO insumos (nome, tipo, quantidade, valor) VALUES ($1, $2, $3, $4)";
        $params = [$nome_produto, $tipo_material, $quantidade, $valor];

        $result = pg_query_params($link, $sql, $params);

        if ($result) {
            header("location: index.php");
            exit();
        } else {
            echo "Erro ao inserir os dados: " . pg_last_error($link);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Novo Insumo</title>
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
                    <h2 class="mt-4">Adicionar Novo Insumo</h2>
                    <p>Preencha este formulário para adicionar um novo insumo ao banco de dados.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Nome do Produto</label>
                            <input type="text" name="nome_produto" class="form-control <?php echo (!empty($nome_produto_err)) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($nome_produto); ?>">
                            <span class="invalid-feedback"><?php echo $nome_produto_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Tipo do Material</label>
                            <select name="tipo_material" class="form-control <?php echo (!empty($tipo_material_err)) ? 'is-invalid' : ''; ?>">
                                <option value="" disabled <?php echo empty($tipo_material) ? 'selected' : ''; ?>>Selecione o tipo de material</option>
                                <option value="Ração" <?php echo $tipo_material == 'Ração' ? 'selected' : ''; ?>>Ração</option>
                                <option value="Equipamento" <?php echo $tipo_material == 'Equipamento' ? 'selected' : ''; ?>>Equipamento</option>
                                <option value="Remédio" <?php echo $tipo_material == 'Remédio' ? 'selected' : ''; ?>>Remédio</option>
                                <option value="Outros" <?php echo $tipo_material == 'Outros' ? 'selected' : ''; ?>>Outros</option>
                            </select>
                            <span class="invalid-feedback"><?php echo $tipo_material_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Quantidade</label>
                            <input type="text" name="quantidade" class="form-control <?php echo (!empty($quantidade_err)) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($quantidade); ?>">
                            <span class="invalid-feedback"><?php echo $quantidade_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Valor</label>
                            <input type="text" name="valor" class="form-control <?php echo (!empty($valor_err)) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($valor); ?>">
                            <span class="invalid-feedback"><?php echo $valor_err; ?></span>
                        </div>
                        <input type="submit" class="btn btn-success" value="Enviar">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
