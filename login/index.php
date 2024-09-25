<?php
session_start();
require_once("./app/config/dependencias.php");
require_once("./app/controller/inicio.php");

// Inicializar la lista de productos si aún no existe en la sesión
if (!isset($_SESSION['productos'])) {
    $_SESSION['productos'] = [];
}

// Función para registrar un producto
if (isset($_POST['registroProducto'])) {
    $producto = htmlspecialchars($_POST['producto']);
    $precio = htmlspecialchars($_POST['precio']);

    // Añadir el producto a la lista de productos en la sesión
    $_SESSION['productos'][] = [
        'nombre' => $producto,
        'precio' => $precio
    ];
}

// Función para cerrar sesión
if (isset($_POST['cerrarSesion'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=CSS."bootstrap.min.css";?>">
    <link rel="stylesheet" href="<?=CSS."inicio.css";?>">
    <title>Formulario de datos</title>
</head>
<body class="vh-100">
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col mt-5">
                <!-- Información del usuario en formato de texto corrido -->
                <h3 class="text-center mt-4">
                    Bienvenido usuario <?= $_SESSION['registro']['nombre']; ?> <?= $_SESSION['registro']['apellido']; ?>, su correo electrónico es <?= $_SESSION['registro']['email']; ?>.
                </h3>
                <br>

                <!-- Formulario para registrar productos -->
                <form action="" method="POST">
                    <div class="form-group mb-3">
                        <label for="producto" class="form-label">¿Qué producto quiere ingresar?</label>
                        <input type="text" name="producto" class="form-control" id="producto" placeholder="Nombre del producto" required>
                    </div>

                    <div class="form-group mb-4">
                        <label for="precio" class="form-label">¿Cuál es su precio unitario?</label>
                        <input type="text" name="precio" class="form-control" id="precio" placeholder="Precio unitario" required>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" name="registroProducto" class="btn btn-primary">Registrar Producto</button>
                    </div>
                </form>

                <!-- Botón separado para mostrar lista de productos -->
                <form action="" method="POST" class="mt-3">
                    <button type="submit" name="mostrarLista" class="btn btn-secondary w-100">Mostrar lista de productos</button>
                </form>

                <!-- Mostrar lista de productos si se presiona el botón -->
                <?php if (isset($_POST['mostrarLista'])): ?>
                    <div class="card mt-4">
                        <div class="card-body">
                            <h5 class="card-title">Lista de productos registrados:</h5>
                            <?php if (!empty($_SESSION['productos'])): ?>
                                <ul class="list-group">
                                    <?php foreach ($_SESSION['productos'] as $producto): ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <?= htmlspecialchars($producto['nombre']) ?>
                                            <span class="badge bg-primary rounded-pill">$<?= htmlspecialchars($producto['precio']) ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <p class="text-center mt-3">No hay productos registrados.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Botón para cerrar sesión -->
                <form action="" method="POST">
                    <div class="d-flex justify-content-center mt-4">
                        <button type="submit" name="cerrarSesion" class="btn btn-danger btn-lg">Cerrar sesión</button>
                    </div>
                </form>

            </div>
            <div class="col"></div>
        </div>
    </div>
</body>
</html>
