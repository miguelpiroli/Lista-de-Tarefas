<?php

if(isset($_POST['id'])){
    require '../db_conn.php';

    $id = $_POST['id'];

    if(empty($id)){
       echo 'error';
    }else {
        $lista = $conn->prepare("SELECT id, checado FROM lista WHERE id=?");
        $lista->execute([$id]);

        $item = $lista->fetch();
        $uId = $item['id'];
        $checado = $item['checado'];

        $uChecado = $checado ? 0 : 1;

        $res = $conn->query("UPDATE lista SET checado=$uChecado WHERE id=$uId");

        if($res){
            echo $checado;
        }else {
            echo "error";
        }
        $conn = null;
        exit();
    }
}else {
    header("Location: ../index.php?mess=error");
}
?>