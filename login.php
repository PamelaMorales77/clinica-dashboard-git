<?php
// login.php

session_start();
// Incluye la conexión a la DB
include('db_connection.php');

$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $conn->prepare("SELECT id, nombre, password_hash, rol FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        // NOTA: Usamos la contraseña simple '123456' para esta práctica.
        if ($password === $user['password_hash']) { 
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nombre'];
            $_SESSION['user_role'] = $user['rol'];
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "Usuario no encontrado.";
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Clínica</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="flex">
        <aside class="w-64 bg-gray-800 h-screen p-4 text-white">
            <h1 class="text-xl font-bold mb-6">Clínica Dashboard</h1>
            <p class="text-sm text-gray-400 mb-4">Bienvenido, <?php echo $userName; ?> (<?php echo $userRole; ?>)</p>
            <ul>
                <li class="mb-2"><a href="dashboard.php" class="block p-2 rounded bg-gray-700">Inicio</a></li>
                <li class="mb-2"><a href="logout.php" class="block p-2 rounded hover:bg-red-700 bg-red-500">Cerrar Sesión</a></li>
            </ul>
        </aside>
        <main class="flex-1 p-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-8">Resumen General</h1>
            <p class="text-gray-600">Este dashboard ahora está protegido por login y sesiones. Módulos y métricas serán implementados a continuación.</p>
        </main>
    </div>
</body>
</html>