<?php session_start(); ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OnomatoBoard - Cadastro</title>
    <link rel="stylesheet" href="../../assets/css/sign-in.css">
</head>

<body>
    <div class="card">
        <form action="../controller/sign-in.php" method="post">
            <div class="field">
                <label for="name">Nome</label>
                <input type="text" name="name" id="name">
            </div>
            <div class="field">
                <label for="email">Email</label>
                <input type="email" name="email" id="email">
            </div>
            <div class="field">
                <label for="password">Senha</label>
                <input type="password" name="password" id="password">
            </div>
            <div class="field">
                <label for="pass-confirm">Confirme a senha</label>
                <input type="password" name="pass_confirm" id="pass-confirm">
            </div>
            <div class="submit">
                <button>Enviar</button>
            </div>
        </form>
        <?php if (isset($_SESSION['msg'])): ?>
            <div class="msg">
                <?= $_SESSION['msg']; ?>
            </div>
            <?php if ($_SESSION['msg'] === 'Usuário criado com sucesso') {
                unset($_SESSION['msg']);
                header('Refresh: 2; url=login.php');
                exit;
            } ?>
            <?php unset($_SESSION['msg']); ?>
        <?php endif; ?>
    </div>
</body>

</html>