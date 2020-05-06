
<?php
/// Server directory : htdocs/response/uploads
$target_dir = "./uploads/";
$phone_trim = trim($_POST["phone"]);
echo("<title>Madhu image</title>");
if (check($phone_trim)) {

    if (file_exists($target_dir . $phone_trim . ".jpg")) {
        echo ("<br><br><br><center><h1 style=\"color:red;font-weight:bolder;\">File uploaded already !</h1></center>");
    } else {
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 10174706) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                rename("./uploads/" . basename($_FILES["fileToUpload"]["name"]), "./uploads/" . $_POST["phone"] . ".jpg");
                echo "<br><br><br><center><h1 style=\"color:green;font-weight:bolder;\">Image uploaded sucessfully.<br>Thank You !<br></h1></center>";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
} else echo "<br><br><br><center><h1 style=\"color:green;font-weight:bolder;\">Phone number not Found! <br><a href=\"./form.html\">Click here to fill the form and upload your photo</a></h1></center>";



function check($phone)
{
    require("connection.php");
    $sql = "SELECT * FROM response WHERE phone=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $phone);
    $stmt->execute();
    $result = $stmt->get_result(); // get the mysqli result
    if ($result->num_rows == 1) {
        return 1;
    } else return 0;

}




?>