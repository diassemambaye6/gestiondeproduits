

<html>
  <head>
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>




<table class="table table-striped table-bordered table-hover">
  <thead>
    <tr>
    <td><a href="add.php" class="btn btn-primary">Add</a></td>
    </tr>
    <tr>
        <th>Name</th>
        <th>file</th>
        <th>Edit</th>
        <th>Delete</th>
  
    </tr>
    </thead>

    <tbody>

    <?php
         require_once 'connexion.php';
         require_once 'delete.php';
     
        $select_stmt=$db->prepare("SELECT * FROM tbl_file");


        $select_stmt->bindParam(':id', $id);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
        extract($row);




        $select_stmt->execute();
        while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))
        {
            ?>

          
            <tr>
                
                <td><?Php echo $row['name']; ?></td>
               
                <td><img src="upload/<?php echo $row['image']; ?>" width="100px" height="60px"></td>
               
                <td><a href="edit.php?update_id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                <td><a href="?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a></td>
                <td><a href="affich.php?affich_id=<?php echo $row['id']; ?>" class="btn btn-info">show</a></td>
             
            </tr>
            <?php
        }    
        ?>
        </tbody>
        </table>

