<?php session_start();
require_once('../model/sound.php');

if (!isset($_SESSION['id'])) {
    header('Location: ../view/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['id'])) {
    $_SESSION['msg'] = 'Som não encontrado';
    header('Location: ../../index.php');
    exit;
}

$name = trim($_POST['sound_name'] ?? '');

if ($name === '') {
    $_SESSION['msg'] = 'você precisa preencher o nome';
    header('Location: ../../index.php');
    exit;
}

$sound = get_sound_by_id((int) $_POST['id']);

// só o dono do som pode alterar
if (!$sound || $sound['user_id'] != $_SESSION['id']) {
    $_SESSION['msg'] = 'Som não encontrado';
    header('Location: ../../index.php');
    exit;
}

update_sound_name($sound['id'], $name, $_SESSION['id']);

$_SESSION['msg'] = 'Som alterado com sucesso';
header('Location: ../../index.php');
exit;
?>
