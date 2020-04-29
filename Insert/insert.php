<?php
require("connection.php");

//File upload
$target_dir = "/htdocs/response/uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "<h1 style=\"color:red;\">File is not an image.</h1>";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "<h1 style=\"color:red;\">Sorry, file already exists.</h1>";
    $uploadOk = 0;
}

// Allow certain file formats
if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
) {
    echo "<h1 style=\"color:red;\">Sorry, only JPG, JPEG, PNG & GIF files are allowed.</h1>";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "<h1 style=\"color:red;\">Sorry, your file was not uploaded.</h1>";
    // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "<center><h1 style=\"color:green;\">The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.</h1></center>";
        rename("/htdocs/response/uploads/" . basename($_FILES["fileToUpload"]["name"]), "/htdocs/response/uploads/" . $_POST["phone"] . ".jpg");

        $formdata = array($_POST["hint"], $_POST["ques1"], $_POST["ques2"], $_POST["ques3"], $_POST["ques4"], $_POST["ques5"], $_POST["ques6"], $_POST["ques7"], $_POST["ques8"], $_POST["ques9"], $_POST["ques10"], $_POST["ques11"], $_POST["ques12"], $_POST["ques13"], $_POST["ques14"], basename($_FILES["fileToUpload"]["name"]), $_POST["phone"]);
        $sql = "INSERT INTO `response` (`solved`, `hint`, `ques1`, `ques2`, `ques3`, `ques4`, `ques5`, `ques6`, `ques7`, `ques8`, `ques9`, `ques10`, `ques11`, `ques12`, `ques13`, `ques14`, `photo`, `phone`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        //INSERT INTO `response` (`solved`, `hint`, `ques1`, `ques2`, `ques3`, `ques4`, `ques5`, `ques6`, `ques7`, `ques8`, `ques9`, `ques10`, `ques11`, `ques12`, `ques13`, `ques14`, `photo`, `phone`) VALUES ('0', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1');
        $stmt = $conn->prepare($sql);
        $val = 0;
        $stmt->bind_param("isssssssssssssssss", $val, $formdata[0], $formdata[1], $formdata[2], $formdata[3], $formdata[4], $formdata[5], $formdata[6], $formdata[7], $formdata[8], $formdata[9], $formdata[10], $formdata[11], $formdata[12], $formdata[13], $formdata[14], $formdata[15], $formdata[16]);
        if ($stmt->execute()) {
            echo ("<center><h1 style=\"color:green;\">Success</h1></center>");
        }


        $stmt->close();
        $conn->close();
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}


//DB Insertion
