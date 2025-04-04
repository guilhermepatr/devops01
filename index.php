<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Insumos Agrícolas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="estilo.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="wrapper">
        <header>
            <div class="logo" id="logo-placeholder">
                <img src="logo.jpg" height="50px" alt="logo">
            </div>
            <h1>Insumos Agrícolas</h1>
        </header>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex align-items-center justify-content-between mt-3 mb-3">
                        <h2 class="mb-0">Lista de Insumos</h2>
                        <a href="create.php" class="btn btn-success"><i class="fa fa-plus"></i> Adicionar Novo Insumo</a>
                    </div>

<?php
// Inclui o arquivo de configuração
require_once "config.php";

// Consulta os insumos
$sql = "SELECT * FROM insumos";
$result = pg_query($link, $sql);

if ($result) {
    if (pg_num_rows($result) > 0) {
        echo '<table class="table table-bordered table-striped text-center">';
        echo "<thead class='thead-dark'>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Nome do Produto</th>";
        echo "<th>Tipo</th>";
        echo "<th>Quantidade</th>";
        echo "<th>Valor</th>";
        echo "<th>Ação</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = pg_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
            echo "<td>" . htmlspecialchars($row['tipo']) . "</td>";
            echo "<td>" . htmlspecialchars($row['quantidade']) . "</td>";
            echo "<td>R$ " . number_format($row['valor'], 2, ',', '.') . "</td>";
            echo "<td>";
            echo '<a href="read.php?id=' . $row['id'] . '" class="btn btn-info btn-sm" title="Visualizar"><i class="fa fa-eye"></i></a> ';
            echo '<a href="update.php?id=' . $row['id'] . '" class="btn btn-warning btn-sm" title="Editar"><i class="fa fa-pencil"></i></a> ';
            echo '<a href="delete.php?id=' . $row['id'] . '" class="btn btn-danger btn-sm" title="Excluir"><i class="fa fa-trash"></i></a>';
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo '<div class="alert alert-warning"><em>Nenhum registro encontrado.</em></div>';
    }
} else {
    echo '<div class="alert alert-danger"><strong>Erro na consulta:</strong> ' . pg_last_error($link) . '</div>';
}

// Fecha a conexão
pg_close($link);
?>

                </div>
            </div>        
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('[data-bs-toggle="tooltip"]').tooltip();
        });
    </script>
</body>
</html>

