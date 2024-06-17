<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $mysqli->prepare('INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)');
    if ($stmt) {
        $stmt->bind_param('ssss', $firstName, $lastName, $email, $password);
        if ($stmt->execute()) {
            // Registro bem-sucedido, redireciona para a página de login com mensagem
            header("Location: /barber2/login/sign-in.html?msg=success");
            exit;
        } else {
            echo "Erro ao executar a inserção: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Erro ao preparar a declaração: " . $mysqli->error;
    }
}
?>
