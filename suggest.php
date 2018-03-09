<?php 
include "includes/connect.php";
session_start();
if(!isset($_SESSION['email'])) 
    header('location:login.php');

if(isset($_POST['sub'])) {
    $rname = $_POST['rname'];
    $description = $_POST['description'];    
    $ingredients = $_POST['ingredients'];
    $directions = $_POST['directions'];
    $user_id=$_SESSION['user_id'];
    $uploadOk = 0;
    // https://www.tutorialspoint.com/php/php_file_uploading.htm
    $filesize=$_FILES["photo"]["size"];
    $allowedextensions=array("jpeg","jpg","gif");
    //$filetype=exif_imagetype($_FILES["photo"]["tmp_name"]);
    $filetype=$_FILES['photo']['type'];
    $file_tmp=$_FILES['photo']['tmp_name'];
    $filename=$_FILES['photo']['name'];
    $tempexplode=explode('.',$filename);
    $fileext=strtolower(end($tempexplode));
    $errors=array();
    if($filesize>50000)
        $errors[]="File size must be exactly 50MB";
    if(!in_array($fileext,$allowedextensions))
        $errors[]="Extension not allowed";
    if(empty($errors)==true)
        $uploadOk=1;
    else
        print_r($errors);
    //To Do: Check the file size. It should be less than 50000.
    //To Do: Restrict the file type to jpg or jpeg or gif.
    //To Do: Uload the file using PHP move_uploaded_file() function
    //TO Do change the $uploadOk to 1 after above if above tasks are completed
    

    if ($uploadOk == 1) {
    $photo= $_FILES["photo"]["name"];
    move_uploaded_file($file_tmp,"images/".$filename);
    $time=date('y-m-d h:i:s');
    $qry = "INSERT INTO `tbl_recipe`(`user_id`, `name`, `description`, `ingredients`, `directions`, `photo`, `add_time`) VALUES ('$user_id','$rname','$description','$ingredients','$directions','$filename','$time');";
    //create an insert query to insert name, userid, description, ingredients, directions and photo name to recipe table
    // execute the query
    mysqli_query($conn,$qry) or die("Connection failed: " . mysqli_error($conn));
        header('location:recipes.php');
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
            <title>Recipe World</title>
            <link rel="stylesheet" href="home.css">
    </head>   
    <body>
        <div class="header">
            <?php include "includes/header.php"?>   
        </div>
        <div class="content">
            <div class="disp">
                <h2>Suggest</h2>
                <h4> <?php if(isset($warning)) echo $warning; ?></h4>
                <!--NOTE: enctype is necessary for upload and you cant use GET, only POST-->
                <form class="form" method="post" action="" enctype="multipart/form-data">
                Recipe Name<input type="text" name="rname">
                Description<textarea name="description"></textarea>
                Ingrediants<textarea name="ingredients"></textarea>
                Directions<textarea name="directions"></textarea>
                Photo<input type="file" name="photo" id="photo">
                <input type="submit" name="sub" value="Click to Submit">
            </form>
            </div> 
            <p class="footer">&#169; 2014 Recipe World</p>
        </div>
    </body>  
</html>