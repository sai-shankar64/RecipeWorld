<?php 
include "includes/connect.php";
session_start();
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
                    <h2>Recipes</h2>
                    <ul class="recipes-ul">
                    <?php 
                     $qry = "SELECT * FROM `tbl_recipe` WHERE  1;";
                     // make select query to get all rows from recipe table
                    $sql = mysqli_query($conn,$qry); // execute the quert
                    if(mysqli_num_rows($sql)>0) { // if query returned some rows
                        while($row=mysqli_fetch_assoc($sql)/*your code here*/) { // keep fetching rows using mysqli_fetch_assoc method
                           $imagepath = "images/".$row["photo"];//get imagepath from $row associative array
                           $recipelink = "view.php?rid=".$row['recipe_id']; // learn how we are doing this
                           $name = $row["name"];//get the recipe name
                           $description = $row["description"];//get the description of recipe
                           echo "<li>";
                           echo "<img src='$imagepath'>";
                           echo "<h3><a href='$recipelink'>$name</a></h3>";
                           echo "<p>$description</p>";
                           echo "</li>";
                        } 
                    } else { 
                        echo "<li>No Recipes</li>";
                    }
                    ?>
                    </ul>
            </div> 
            <p class="footer">&#169; 2014 Recipe World</p>
        </div>
    </body>  
</html>