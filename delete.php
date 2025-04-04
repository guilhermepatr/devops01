<?php
// Processa a operação de exclusão após a confirmação
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    require_once "config.php";

    // Prepara a consulta de exclusão
    $sql = "DELETE FROM insumos WHERE id = $1";
    $stmt = pg_prepare($link, "delete_insumo", $sql);

    if ($stmt) {
        // Executa a declaração preparada
        $result = pg_execute($link, "delete_insumo", array($_POST["id"]));
        
        if ($result) {
            header("location: index.php");
            exit();
        } else {
            echo "Erro ao excluir o insumo.";
        }
    }

    // Fecha a conexão
    pg_close($link);
} else {
    // Se não houver ID válido, redireciona para a página de erro
    header("location: error.php");
    exit();
}
?>

