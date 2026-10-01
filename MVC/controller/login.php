<?php session_start();
require_once('../model/user.php');

if (
    empty($_POST['email']) ||
    empty($_POST['password'])
) {
    $_SESSION['msg'] = 'Você precisa preencher todos o campos';
    header('Location: ../view/login.php');
    exit;
}

if (check_email($_POST['email'])) {
    $user = get_user_by_email($_POST['email']);
} else {
    $_SESSION['msg'] = 'Este email não foi encontrado';
    header('Location: ../view/login.php');
    exit;
}

if (
    password_verify($_POST['password'], $user['password'])
) {
    $_SESSION['id'] = $user['id'];

    $_SESSION['msg'] = 'Login realizado com sucesso';
    header('Location: ../view/login.php');
    exit;
} else {
    $_SESSION['msg'] = 'senha incorreta';
    header('Location: ../view/login.php');
    exit;
}
