<?php
session_start();

if ($_POST) {
    if (
        isset($_POST['nombre']) && !empty($_POST['nombre']) &&
        isset($_POST['apellido']) && !empty($_POST['apellido']) &&
        isset($_POST['email']) && !empty($_POST['email']) &&
        isset($_POST['pass']) && !empty($_POST['pass'])
    ) {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];

        $_SESSION['registro'] = [
            "nombre" => $nombre,
            "apellido" => $apellido,
            "email" => $email,
            "pass" => $pass
        ];

        // Respuesta exitosa en JSON
        echo json_encode([1, "Registro aceptado."]);
    } else {
        // Respuesta en caso de error (campos vacíos)
        echo json_encode([0, "Todos los campos son obligatorios."]);
    }
}
?>
