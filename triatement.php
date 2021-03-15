
<?php
    require_once "connection.php";

    if(isset($_REQUEST[ 'btn_insert' ]))
    {
        try
        {
            $name = $_REQUEST['txt-name'];

            $image= $_FILES["txt_file"]["name"];
            $type=$_FILES["txt_file"]["type"];
            $size=$_FILES["txt_file"]["size"];
            $temp=$_FILES["txt_file"]["tmp_name"];

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
                    $insert_stmt=$db->prepare('INSERT INTO tbl_fie(name, image) VALUES(:fname, :fimage)');
                    $insert_stmt->bindParam(':fname', $name);
                    $insert_stmt->bindParam(':fimage', $image_filee);

                    if($insert_stmt->execute())
                    {
                        $insertMsg= "File upload successly";
                        header("refresh :3; index.php");
                    }}}
                    catch(PDOException $e){
                        echo $e-getMessage;
                    }
                    }
?>