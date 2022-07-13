<?php 

    include_once 'connectdb.php';

    session_start();

    if($_SESSION['useremail']=="" OR $_SESSION['role']=="User"){
        header("location:index.php");
    }

    $id = $_POST['pidd'];

    $sql = "delete from tbl_product where pid=$id";

    $delete = $pdo->prepare($sql);

    if($delete->execute()){

    }else{
        echo 'Error in Deleting';
    }


?>