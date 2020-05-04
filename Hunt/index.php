<?php
require("../Insert/connection.php");

$sql = "SELECT phone,hint,ques1 FROM response";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html class="no-js">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title></title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="./style.css" />
    <link href="https://fonts.googleapis.com/css2?family=Caveat&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Leckerli+One&display=swap" rel="stylesheet">
</head>

<body>
    <center>
        <img src="https://media.giphy.com/media/l4FGroaKiE5uuMBiM/source.gif" id="questiongif" />
        <?php
        if ($result->num_rows > 0) {
            // output data of each row
            $counter = 1;
            while ($row = $result->fetch_assoc()) {

                echo ("<div class=\"card\">
                <h1 class=\"puzzleno\">#" . $counter . "</h1>
                <div class=\"hint\">" . $row["hint"] . "</div>
                <br />
                <br />
                <form action=\"./view.php\" method=\"POST\" id=\"form" . $counter . "\" class=\"form\" autocomplete=\"off\">
                    <input type=\"text\" name=\"name\" placeholder=\"Who am I ?\" id=\"q" . $counter . "text\" />
                    <input type=\"hidden\" name=\"phone\" value=\"" . $row["phone"] . "\" />
                </form>
                <br>
            </div>
    
    
            <script>
                var q" . $counter . "text = document.getElementById(\"q" . $counter . "text\");
    
                q" . $counter . "text.onkeyup = function() {
                    console.log(q" . $counter . "text.value);
                    if ( q" . $counter . "text.value == \"" . $row["ques1"] . "\") {
                        document.getElementById(\"form" . $counter . "\").submit();
                    }
                };
            </script>");
                $counter++;
            }
        }

        ?>
        <br>
        <br>
    </center>
</body>

</html>