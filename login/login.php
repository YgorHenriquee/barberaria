<?php
require 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        echo "Dados recebidos:<br>";
        echo "Email: $email<br>";
        echo "Password: $password<br>";

        $stmt = $mysqli->prepare('SELECT id, first_name, last_name, password FROM users WHERE email = ?');
        if ($stmt) {
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $firstName, $lastName, $hashedPassword);
            if ($stmt->fetch()) {
                echo "Usuário encontrado.<br>";
                if (password_verify($password, $hashedPassword)) {
                    echo "Senha correta.<br>";
                    $_SESSION['user_id'] = $id;
                    $_SESSION['first_name'] = $firstName;
                    $_SESSION['last_name'] = $lastName;
                    header("Location: /barber2/index.php");
                    exit;
                } else {
                    echo "Senha incorreta.";
                }
            } else {
                echo "Usuário não encontrado.";
            }
            $stmt->close();
        } else {
            echo "Erro ao preparar a declaração: " . $mysqli->error;
        }
    } else {
        echo "Campos de email ou senha não foram enviados.";
    }
} else {
    echo "Método de solicitação inválido.";
}
?>
