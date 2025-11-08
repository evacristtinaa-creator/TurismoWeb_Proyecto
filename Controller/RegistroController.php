<?php
require_once __DIR__ . '/../BaseDatos/bd.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nombre            = $_POST['nombre'];
    $apellidos         = $_POST['apellidos'];
    $correo_electronico = $_POST['email'];             
    $contrasena        = $_POST['password'];           
    $fecha_nac         = $_POST['fecha_nacimiento'];    
    $direccion         = $_POST['direccion'];
    $pais              = $_POST['pais'];
    $numero_telefono   = $_POST['telefono'];           

    $hash = password_hash($contrasena, PASSWORD_DEFAULT);

    $db = new Database();
    $conn = $db->connect();

    $sql = "INSERT INTO usuarios (nombre, apellidos, correo_electronico, contraseña, fecha_nac, direccion, pais, numero_telefono)
            VALUES (:nombre, :apellidos, :correo_electronico, :contrasena, :fecha_nac, :direccion, :pais, :numero_telefono)";
    
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellidos', $apellidos);
    $stmt->bindParam(':correo_electronico', $correo_electronico);
    $stmt->bindParam(':contrasena', $hash);
    $stmt->bindParam(':fecha_nac', $fecha_nac);
    $stmt->bindParam(':direccion', $direccion);
    $stmt->bindParam(':pais', $pais);
    $stmt->bindParam(':numero_telefono', $numero_telefono);
    
    if ($stmt->execute()) {
    header('Location: /perfil_usuario.php'); 
    exit(); 
} else {
    echo "<h3 style='color:red; text-align:center;'>Error al registrar usuario.</h3>";
}

}
?>
