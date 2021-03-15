
<?php

        require_once "connexion.php";

        if(isset($_REQUEST['update_id']))
        
        {
            try
            {
                $id = $_REQUEST['update_id'];
                $select_stmt = $db->prepare('SELECT * FROM tbl_file WHERE id =:id');
                $select_stmt->bindParam(':id', $id);
                $select_stmt->execute();
                $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
                extract($row);
            }
            catch(PDOException $e)
            {
                $e->getMessage();
            }
        }

        if(isset($_REQUEST['btn_update']))
        {
            try
            {
                $name = $_REQUEST['txt-name'];

                $image_file= $_FILES['txt-file']['name'];
                $type=$_FILES['txt-file']['type'];
                $size=$_FILES['txt-file']['size'];
                $temp=$_FILES['txt-file']['tmp_name'];

                $path="upload/" .$image_file;
                $directory= "upload/";

                if($image_file)
                {
                    if($type=="image/jpg" || $type=="image/jpeg" || $type=="image/png" || $type=="image/gif")
                    {
                        if(!file_exists($path))
                        {
                            if($size < 500000)
                            {
                               // unlink($directory.$row['image']);
                                move_uploaded_file($temp, "upload/" .$image_file);
                            }
                            else
                            {
                                $errorMsg="yor file to large..";
                            }
                        }
                        else
                        {
                            $errorMsg="File already exis..";
                        }
                        }
                        else
                        {
                            $errorMsg="Upload JPG , JPEG , PNG & GIF Fle Formate...";
                        }
                    }
                            else
                            {

                            $image_file=$row['image'];
                            }

                        if(!isset($errorMsg))
                        {
                            $update_stmt=$db->prepare('UPDATE tbl_file SET name=:name_up, image=:file_up WHERE id=:id');
                            $update_stmt->bindParam(':name_up', $name);
                            $update_stmt->bindParam(':file_up', $image_file);
                            $update_stmt->bindParam(':id', $id);

                            if($update_stmt->execute())
                            {
                                $updateMsg= "File upload successly";
                                //header("location: index.php");
                            }
                          }
                        }
                        catch (PDOException $e)
                        {
                            echo $e-getMessage;
                        }
                        header("location: index.php");
                        }



    ?>

<html>
  <head>
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>



<form method="POST" class="form-horizontal" enctype=multipart/form-data>

<div class="form-group">
          <label class="col-sm-3 control-label"  >Name</label>
        <div class="col-sm-6">
          <input type="text" name="txt-name" class="form-control" value="<?php echo $name; ?>" required/>
        </div>
        </div>

        <div class="form-control">
            <label class="col-sm-3 control-label">File</label>
            <div class="col-sm-6">
            <input type="file" name="txt-file" class="form-control" value="<?php echo $image_file; ?>"/>
            <p><img src="upload/<?php echo $image_file; ?>" heith="100" width="100"></p>
            </div>
        </div>

        <div class="form-control">
            <div class="col-sm-offset-3 col-sm-9 m-t-15">
            <input type="submit" name="btn_update" class="btn btn-success " value="Update">
            <a href="index.php" class="btn btn-danger">Cancel</a>
        </div>
        </div>
</form>