<?php
include 'fonctions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    $connect = connection_a_la_base();
    
    if($action == 'signup'){
        enregistre_les_information();
    }else{
        connection_de_utilisateur();
    }

    $connect->close();
}else{
    echo "invalide request method . ";
}


?>