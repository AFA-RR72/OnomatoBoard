<?php
function conn(){
    $conn = mysqli_connect('localhost', 'root', '', 'onomatoboard');

    if (!$conn){
        die('Erro de conexão: ' . mysqli_connect_error());
    }

    return $conn;
}

?>