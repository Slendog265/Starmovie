<?php
session_start();
include("dol/person.php");

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_FILES['file'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'No se recibió ninguna imagen.']);
    exit;
}

if (!isset($_SESSION['usuario_activo'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'La sesión ha expirado.']);
    exit;
}

$prueba = new Person();
$datos = json_decode($_SESSION['usuario_activo'], true);
$id_usuario = $datos['NUsuario'];
$file = $_FILES['file'];
$upload_dir = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'frontend' . DIRECTORY_SEPARATOR . 'image' . DIRECTORY_SEPARATOR . 'perfil' . DIRECTORY_SEPARATOR;

if ($file['error'] !== UPLOAD_ERR_OK || $file['size'] > 2 * 1024 * 1024) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'La imagen debe pesar menos de 2 MB.']);
    exit;
}

$image_info = @getimagesize($file['tmp_name']);
$allowed_types = [IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF, IMAGETYPE_WEBP];
if ($image_info === false || !in_array($image_info[2], $allowed_types, true)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Selecciona una imagen JPG, PNG, GIF o WEBP.']);
    exit;
}

$consulta = $prueba->connection->prepare("SELECT FPerfil FROM usuario WHERE NUsuario = :nombre_usuario");
$consulta->bindParam(':nombre_usuario', $id_usuario, PDO::PARAM_STR);
$consulta->execute();
$registro = $consulta->fetch(PDO::FETCH_OBJ);
$nombre_anterior = $registro ? $registro->FPerfil : null;

if ($nombre_anterior && $nombre_anterior !== 'DefaultFPerfil.jpg') {
    $archivo_anterior = $upload_dir . basename($nombre_anterior);
    if (is_file($archivo_anterior)) {
        unlink($archivo_anterior);
    }
}

$extension = image_type_to_extension($image_info[2], false);
$nombre_archivo = $id_usuario . '_' . uniqid('', true) . '.' . $extension;
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0775, true);
}

if (!move_uploaded_file($file['tmp_name'], $upload_dir . $nombre_archivo)) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'No se pudo guardar la imagen.']);
    exit;
}

$consulta = $prueba->connection->prepare("UPDATE usuario SET FPerfil = :nombre_archivo WHERE NUsuario = :id_usuario");
$consulta->bindParam(':nombre_archivo', $nombre_archivo, PDO::PARAM_STR);
$consulta->bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);
$consulta->execute();

$prueba->setNUsuario($datos['NUsuario']);
$prueba->setPass($datos['Pass']);
$usuario_actualizado = $prueba->getUser($prueba);
$_SESSION['usuario_activo'] = json_encode($usuario_actualizado);
echo json_encode(['success' => true]);
?>
