<?php
// Verifica se o parâmetro ID foi passado
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    require_once "config.php";

    $param_id = trim($_GET["id"]);

    // Prepara a instrução SQL
    $sql = "SELECT * FROM insumos WHERE id = $1";

    // Prepara a query no PostgreSQL
    $stmt = pg_prepare($link, "read_insumo", $sql);

    if ($stmt) {
        // Executa com o ID como parâmetro
        $result = pg_execute($link, "read_insumo", array($param_id));

        if ($result && pg_num_rows($result) == 1) {
            $row = pg_fetch_assoc($result);

            // Recupera os dados
            $name = $row["nome"];
            $type = $row["tipo"];
            $quantity = $row["quantidade"];
            $value = $row["valor"];
        } else {
            // Redireciona se não encontrar o insumo
            header("location: error.php");
            exit();
        }
    } else {
        echo "Ocorreu um erro na preparação da consulta.";
    }

    // Fecha a conexão
    pg_close($link);
} else {
    // Redireciona se o ID não for informado
    header("location: error.php");
    exit();
}
?>

