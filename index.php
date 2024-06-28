<?php

    require 'connection.php';

    if(isset($_POST['submit'])) {
        $name = $_POST['name'];
        if($_FILES["image"]["error"] === 4) {
        
            echo "<script> alert('image does not exist'); </script>";
        
        }
        else {
            $fileName = $_FILES["image"]["name"];
            $fileSize = $_FILES["image"]["size"];
            $tmpName = $_FILES["image"]["tmp_name"];

            $validImageExtension = ['jpg', 'jpeg', 'png'];
            $imageExtension = explode('.', $fileName);
            $imageExtension = strtolower(end($imageExtension));
            if(!in_array($imageExtension, $validImageExtension)){
                echo "
                
                <script> alert('invalid image format.'); </script>

                ";
            }

      else if($fileSize > 1000000){

            echo " <script> alert('image size is too large.'); </script> ";

            }

            else{

                $newImageName = uniqid();
                $newImageName .= '.' . $imageExtension;

                move_uploaded_file($tmpName, 'img/' . $newImageName);

                $query = "INSERT INTO tbl_upload VALUES('', '$name', '$newImageName')";
                mysqli_query($conn, $query);
                echo "<script> 
                alert('inserted'); 
                document.location.href = 'data.php';
                </script>";

            }

        }
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploading Image in Table and Database</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        form {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        input[type="text"], input[type="file"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: #45a049;
        }
        a {
            display: inline-block;
            margin-top: 10px;
            text-decoration: none;
            color: #007bff;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Upload Image and Save to Database</h2>

    <form action="" method="POST" enctype="multipart/form-data">
        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div>
            <label for="image">Image:</label>
            <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png" required>
        </div>
        <div>
            <button type="submit" name="submit">Submit</button>
        </div>
    </form>

    <a href="data.php">View Uploaded Data</a>
</div>

</body>
</html>
