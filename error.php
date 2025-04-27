<?php
// Define o código de resposta HTTP
http_response_code(400);

// Define o cabeçalho de Content-Type explicitamente (boa prática)
header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Erro - Solicitação Inválida</title>
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
                    <h2 class="mt-5 mb-3">Solicitação Inválida</h2>
                    <div class="alert alert-danger" role="alert" aria-live="assertive">
                        <p>Desculpe, houve um problema com sua solicitação. Isso pode ter ocorrido por um dos seguintes motivos:</p>
                        <ul>
                            <li>O ID do insumo não foi fornecido corretamente.</li>
                            <li>Ocorreu um erro na URL.</li>
                            <li>O insumo que você tentou acessar não existe mais.</li>
                        </ul>
                        <p>Por favor, <a href="index.php" class="alert-link">volte para a página inicial</a> e tente novamente.</p>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
