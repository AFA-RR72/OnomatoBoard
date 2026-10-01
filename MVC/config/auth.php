<?php
function check_login(){
    if (!isset($_SESSION['id'])){
        header('Location: ' . BASE_URL . 'MVC/view/login.php');
        exit;
    }
}

?>