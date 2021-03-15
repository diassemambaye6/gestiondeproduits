


<?php
    require_once 'connexion.php';

    if(isset($_REQUEST[ 'btn_insert' ]))
    {
        try
        {
            $name = $_REQUEST['txt-name'];
          

            $image_file= $_FILES["txt-file"]["name"];
             $type=$_FILES['txt-file']['type'];
             $size=$_FILES['txt-file']['size'];
             $temp=$_FILES['txt-file']['tmp_name'];

            $path= "upload/".$image_file;
            if(empty($name)){
                $errorMsg="donner un nom scp";
            }
            else if(empty($image_file)){
                $errorMsg="selectionnez une image";
            }
            else if($type="image/jpg" || $type="image/jpeg" || $type="image/png" || $type="image/gif" ){
                if(!file_exists($path)){
                    if($size < 500000)
                    {
                        move_uploaded_file($temp, "upload/" .$image_file);
                    }
                    else
                    {
                        $errorMsg="yor file to large..";
                    }
                }
                else{
                    $errorMsg="File already exis..";
                }
                }
                else
                {
                    $errorMsg="Upload JPG , JPEG , PNG & GIF Fle Formate...";
                }

                if(!isset($errorMsg))
                {
                    $insert_stmt=$db->prepare('INSERT INTO tbl_file(name, image) VALUES(:fname, :fimage)');
                    $insert_stmt->bindParam(':fname', $name);
                    $insert_stmt->bindParam(':fimage', $image_file);
                   

                    if($insert_stmt->execute())
                    {
                        $insertMsg= "File upload successly";
                       // header("location:index.php");
                    }}}
                    catch(PDOException $e){
                        echo $e-getMessage;
                    }
                    header("location:index.php");
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
          <input type="text" name="txt-name" class="form-control" placeholder="enter name"/>
        </div>
        </div>


        <div class="form-control">
            <label class="col-sm-3 control-label">Price</label>
            <div class="col-sm-6">
            <input type="text" name="txt-price" class="form-control"/>
            </div>
        </div>


        <div class="form-control">
            <label class="col-sm-3 control-label">File</label>
            <div class="col-sm-6">
            <input type="file" name="txt-file" class="form-control"/>
            </div>
        </div>

        <div class="form-control">
            <div class="col-sm-offset-3 col-sm-9 m-t-15">
            <input type="submit" name="btn_insert" class="btn btn-success " value="Insert">
            <a href="index.php" class="btn btn-danger">Cancel</a>
        </div>
        </div>
</form>