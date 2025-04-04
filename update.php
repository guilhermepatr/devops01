<?php
// Inclui o arquivo de configuração
require_once "config.php";

// Define variáveis e inicializa com valores vazios
$name = $type = $quantity = $value = "";
$name_err = $type_err = $quantity_err = $value_err = "";

// Captura o ID via GET ou POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $param_id = trim($_POST["id"]);
} elseif (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    $param_id = trim($_GET["id"]);
} else {
    header("location: error.php");
    exit();
}

// Processa o formulário quando enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validação dos campos
    $input_name = trim($_POST["nome"]);
    $name = empty($input_name) ? $name_err = "Por favor, insira o nome do produto." : $input_name;

    $input_type = trim($_POST["tipo"]);
    $type = empty($input_type) ? $type_err = "Por favor, insira o tipo do material." : $input_type;

    $input_quantity = trim($_POST["quantidade"]);
    if (empty($input_quantity)) {
        $quantity_err = "Por favor, insira a quantidade.";
    } elseif (!ctype_digit($input_quantity)) {
        $quantity_err = "Por favor, insira um valor inteiro positivo.";
    } else {
        $quantity = $input_quantity;
    }

    $input_value = trim($_POST["valor"]);
    if (empty($input_value)) {
        $value_err = "Por favor, insira o valor.";
    } elseif (!is_numeric($input_value)) {
        $value_err = "Por favor, insira um valor numérico.";
    } else {
        $value = $input_value;
    }

    // Se não houver erros, realiza a atualização
    if (empty($name_err) && empty($type_err) && empty($quantity_err) && empty($value_err)) {
        $sql = "UPDATE insumos SET nome = $1, tipo = $2, quantidade = $3, valor = $4 WHERE id = $5";

        $stmt = pg_prepare($link, "update_insumo", $sql);
        if ($stmt) {
            $result = pg_execute($link, "update_insumo", array($name, $type, $quantity, $value, $param_id));

            if ($result) {
                header("location: index.php");
                exit();
            } else {
                echo "Erro ao atualizar o registro. Tente novamente mais tarde.";
            }
        }
    }

    pg_close($link);
} else {
    // Busca os dados do insumo para preencher o formulário
    $sql = "SELECT * FROM insumos WHERE id = $1";

    $stmt = pg_prepare($link, "select_insumo", $sql);
    if ($stmt) {
        $result = pg_execute($link, "select_insumo", array($param_id));

        if ($result && pg_num_rows($result) == 1) {
            $row = pg_fetch_assoc($result);
            $name = $row["nome"];
            $type = $row["tipo"];
            $quantity = $row["quantidade"];
            $value = $row["valor"];
        } else {
            header("location: error.php");
            exit();
        }
    }

    pg_close($link);
}
?>

