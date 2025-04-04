<?php
// Configuração da conexão com PostgreSQL
define('DB_SERVER', 'localhost');
define('DB_PORT', '5432'); // Porta padrão do PostgreSQL
define('DB_USERNAME', 'seu_usuario');
define('DB_PASSWORD', 'sua_senha');
define('DB_NAME', 'seu_banco_de_dados');

// Conexão com o PostgreSQL
$link = pg_connect("host=" . DB_SERVER . " port=" . DB_PORT . " dbname=" . DB_NAME . " user=" . DB_USERNAME . " password=" . DB_PASSWORD);

if (!$link) {
    die("Erro ao conectar ao banco de dados: " . pg_last_error());
}
?>

