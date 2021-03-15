<?php
    require_once "connexion.php";

    if(isset($_REQUEST['delete_id']))
    {
        $id=$_REQUEST['delete_id'];

        $select_stmt= $db->prepare('SELECT * FROM tbl_file WHERE id =:id');
        $select_stmt->bindParam(':id',$id);
        $select_stmt->execute();
        $row=$select_stmt->fetch(PDO::FETCH_ASSOC);
        unlink("upload/".$row['image']);

        $delete_stmt = $db->prepare('DELETE FROM tbl_file WHERE id = :id');
        $delete_stmt->bindParam(':id',$id);
        $delete_stmt->execute();

        header("Location:index.php");
        }
        
        ?>

    