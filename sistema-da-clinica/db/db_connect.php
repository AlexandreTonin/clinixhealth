<?php
// Configurações do banco de dados
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'clinixhealth';

// Criando a conexão com MySQL
$conn = new mysqli($host, $user, $password, $database);

// Verificando a conexão
if ($conn->connect_error) {
    die('Erro de conexão: ' . $conn->connect_error);
}
?>
