<?php session_start();
require_once('../model/sound.php');
require_once('../config/init.php');

if (!isset($_SESSION['id'])) {
    header('Location: ../view/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['id'])) {
    $_SESSION['msg'] = 'Som não encontrado';
    header('Location: ../../index.php');
    exit;
}

$sound = get_sound_by_id((int) $_POST['id']);

// só o dono do som pode apagar
if (!$sound || $sound['user_id'] != $_SESSION['id']) {
    $_SESSION['msg'] = 'Som não encontrado';
    header('Location: ../../index.php');
    exit;
}

delete_sound($sound['id'], $_SESSION['id']);

// remove o arquivo de áudio do disco
$file = BASE_PATH . $sound['path'];
if (is_file($file)) {
    unlink($file);
}

$_SESSION['msg'] = 'Som apagado com sucesso';
header('Location: ../../index.php');
exit;
?>
