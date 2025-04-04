require_once "config.php";

$nome_produto = $tipo_material = $quantidade = $valor = "";
$nome_produto_err = $tipo_material_err = $quantidade_err = $valor_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_nome_produto = trim($_POST["nome_produto"]);
    if (empty($input_nome_produto)) {
        $nome_produto_err = "Por favor, insira o nome do produto.";
    } else {
        $nome_produto = $input_nome_produto;
    }

    $input_tipo_material = trim($_POST["tipo_material"]);
    if (empty($input_tipo_material)) {
        $tipo_material_err = "Por favor, selecione o tipo do material.";
    } else {
        $tipo_material = $input_tipo_material;
    }

    $input_quantidade = trim($_POST["quantidade"]);
    if (empty($input_quantidade) || !ctype_digit($input_quantidade)) {
        $quantidade_err = "Por favor, insira um valor inteiro positivo.";
    } else {
        $quantidade = (int) $input_quantidade;
    }

    $input_valor = trim($_POST["valor"]);
    if (empty($input_valor) || !is_numeric($input_valor)) {
        $valor_err = "Por favor, insira um valor numérico.";
    } else {
        $valor = (float) $input_valor;
    }

    if (empty($nome_produto_err) && empty($tipo_material_err) && empty($quantidade_err) && empty($valor_err)) {
        $sql = "INSERT INTO insumos (nome, tipo, quantidade, valor) VALUES ($1, $2, $3, $4)";
        
        $stmt = pg_prepare($link, "insert_insumo", $sql);
        if ($stmt) {
            $result = pg_execute($link, "insert_insumo", [$nome_produto, $tipo_material, $quantidade, $valor]);

            if ($result) {
                header("location: index.php");
                exit();
            } else {
                echo "Erro ao inserir os dados: " . pg_last_error($link);
            }
        }
    }
    pg_close($link);
}

