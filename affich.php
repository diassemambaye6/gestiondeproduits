<?php

require_once 'connexion.php';

        

 $select_stmt=$db->prepare("SELECT * FROM tbl_file");


$select_stmt->bindParam(':id', $id);
$select_stmt->execute();
$row = $select_stmt->fetch(PDO::FETCH_ASSOC);
extract($row);




// $select_stmt->execute();
 while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))
{
    ?>

        <td><?Php echo $row['name']; ?></td> 
   

        <center><table class="table-primary">
                 <tr>
                       <td><img src="upload/<?php echo $row['image']; ?>" width="700px" height="700px"></td>
                </tr>

<?php
}
?>
