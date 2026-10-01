<?php session_start();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OnomatoBoard - Login</title>
    <link rel="stylesheet" href="../../assets/css/login.css">
</head>

<body>
    <div class="card">
        <form action="../controller/login.php" method="post">
            <div class="field">
                <label for="email">Email</label>
                <input type="email" name="email" id="email">
            </div>
            <div class="field">
                <label for="password">Senha</label>
                <input type="password" name="password" id="password">
            </div>
            <div class="submit">
                <button>Enviar</button>
            </div>
        </form>
        <p>Ainda não tem uma conta? <a href="sign-in.php">criar</a></p>
        <?php if (isset($_SESSION['msg'])): ?>
            <div class="msg">
                <?= $_SESSION['msg']; ?>
            </div>
            <?php if ($_SESSION['msg'] === 'Login realizado com sucesso') {
                unset($_SESSION['msg']);
                header('Refresh: 2; url=../../index.php');
                exit;
            } ?>
            <?php unset($_SESSION['msg']); ?>
        <?php endif; ?>
    </div>
</body>

</html>