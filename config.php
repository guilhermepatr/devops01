<?php
// Configuração da conexão com PostgreSQL
define('DB_SERVER', 'db.multipass');
define('DB_PORT', '5432'); // Porta padrão do PostgreSQL
define('DB_USERNAME', 'phpcrud');
define('DB_PASSWORD', '123456');
define('DB_NAME', 'insums');

// Conexão com o PostgreSQL
$link = pg_connect("host=" . DB_SERVER . " port=" . DB_PORT . " dbname=" . DB_NAME . " user=" . DB_USERNAME . " password=" . DB_PASSWORD);

if (!$link) {
    die("Erro ao conectar ao banco de dados: " . pg_last_error());
}
?>

