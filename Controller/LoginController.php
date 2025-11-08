<?php
require_once __DIR__ . '/../BaseDatos/bd.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['email'];       
    $contrasena = $_POST['password']; 

    $db = new Database();
    $conn = $db->connect();

    $sql = "SELECT * FROM usuarios WHERE correo_electronico = :correo";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':correo', $correo);
    $stmt->execute();

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($contrasena, $usuario['contraseña'])) {
        
        $_SESSION['usuario'] = $usuario['nombre'];
        $_SESSION['correo'] = $usuario['correo_electronico'];

        
        header('Location: /perfil_usuario.php');
        exit();
    } else {
        echo "Correo o contraseña incorrectos.";
    }
}
?>
