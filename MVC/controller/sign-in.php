<?php session_start();
require_once('../model/user.php');

if (
    empty($_POST['name']) ||
    empty($_POST['email']) ||
    empty($_POST['password']) ||
    empty($_POST['pass_confirm'])
) {
    $_SESSION['msg'] = 'Você precisa preencher todos o campos';
    header('Location: ../view/sign-in.php');
    exit;
} elseif (check_email($_POST['email'])) {
     $_SESSION['msg'] = 'este email já está em uso';
    header('Location: ../view/sign-in.php');
    exit;
} elseif ($_POST['password'] !== $_POST['pass_confirm']) {
    $_SESSION['msg'] = 'As senhas precisam ser as mesmas';
    header('Location: ../view/sign-in.php');
    exit;
} else {
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    create_user($_POST['name'], $_POST['email'], $password);

    $_SESSION['msg'] = 'Usuário criado com sucesso';

    header('Location: ../view/sign-in.php');
    exit;
}
