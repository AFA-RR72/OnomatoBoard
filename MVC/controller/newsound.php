<?php session_start();
require_once('../model/user.php');
require_once('../model/sound.php');
require_once('../config/init.php');

if ( $_FILES['sound']['error'] !== UPLOAD_ERR_OK) {
    $_SESSION['msg'] = 'Arquivo não encontrado';
    header('Location: ../../index.php');
    exit;
} elseif(empty(trim($_POST['sound_name']))) {
    $_SESSION['msg'] = 'você precisa preencher o nome';
    header('Location: ../../index.php');
    exit;
}

$name = uniqid() . '.mp3';
move_uploaded_file($_FILES['sound']['tmp_name'], BASE_PATH . 'uploads/audio/' . $name);

$dbName = 'uploads/audio/' . $name;

save_sound($_POST['sound_name'], $dbName, $_SESSION['id']);

$_SESSION['msg'] = "Arquivo salvo com sucesso";
header('Location: ../../index.php');
exit;
?>