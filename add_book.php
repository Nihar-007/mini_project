<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
</head>
<body>
    <form action="#" method="post" enctype="multipart/form-data">
    
    <label for="bname">Book Name :</label>
    <input type="text" name="bname" autocomplete="off" ><br><br>

    <label for="aname">Author Name :</label>
    <input type="text" name="aname" autocomplete="off" ><br><br>
    
    <label for="bimage">Upload Image : </label>
    <input type="file" name="file" autocomplete="off" ><br><br>

    <input type="submit" name="submit">
    <button name="cancel">Cancel</button>

    </form>
</body>
</html>

<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $conn = mysqli_connect("localhost","root","","miniproject");
        
        $name = $_POST['bname'];
        $aname = $_POST['aname'];
        $image = $_FILES['file'];
        
        // print_r($image);
        
        $image_name = $image['name'];
        $temp_loc = $image['tmp_name'];
        
        // echo $image_name;
        // echo "<br>".$temp_loc;

        $folder = "images/";
        $upload = $folder.$image_name;
        $exe = array(".png",".jpeg");
        // echo "<br>".$upload;
        if(isset($_POST['submit'])){
            $sql = "INSERT into `add_book` (`b_name`,`b_author`,`b_image`) values ('$name','$aname','$image_name')";
            $result = mysqli_query($conn,$sql);
            if($result){
                move_uploaded_file($temp_loc,$upload);
                header("location: addmin.php");
                
            }
        }
        elseif(isset($_POST['cancel'])){
            header("location: addmin.php");
        }
    }
?>