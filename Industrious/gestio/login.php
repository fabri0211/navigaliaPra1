<?php
$servername = "localhost"; // Cambia esto a la dirección de tu servidor
$username = "root"; // Cambia esto a tu nombre de usuario de la base de datos
$password = "usbw"; // Cambia esto a tu contraseña de la base de datos
$dbname = "navegalia"; // Cambia esto al nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputPassword = $_POST['password'];

    // Consulta para obtener la contraseña desde la base de datos
    $sql = "SELECT paraulaPas FROM 'pass' WHERE 1"; // Cambia la consulta según tu estructura de base de datos
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Obtener la fila de resultados
        $row = $result->fetch_assoc();
        $storedPassword = $row['password'];

        // Verificar la contraseña ingresada con la almacenada (usando password_verify si está hashada)
        if (password_verify($inputPassword, $storedPassword)) {
            echo "Contraseña correcta. Acceso concedido.";
        } else {
            echo "Contraseña incorrecta. Inténtalo de nuevo.";
        }
    } else {
        echo "No se encontró el usuario.";
    }
}

$conn->close();
?>
