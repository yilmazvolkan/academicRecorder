<html>
    <head>
        <title>Academic SOTA Recorder</title>
    </head>
    <body style="background-color: Moccasin   ; color: Indigo  ; margin: 40 ">

        <h1> Add Paper </h1>

        <?php

            session_start();

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "academic_recorder";

            // Create connection
            $conn = mysqli_connect($servername, $username, $password,$dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            else if (isset($_SESSION['user_id'])) {
                $sql = "SELECT isAdmin FROM users WHERE ID = " . $_SESSION['user_id'];
                $result1 = $conn->query($sql);
                $row = $result1->fetch_assoc();

                if($row["isAdmin"] == 1){
                    // Insert the record
                    $sql1 = "INSERT INTO Papers(title, result, abstract) " .
                        "VALUES('" . $_POST['title'] . "', '" . $_POST['result'] . "', '" . $_POST['abstract'] . "')" ;
                    $sql2 = "SET @Paper_ID = LAST_INSERT_ID()" ;
                    $sql3 = "INSERT INTO AuthorPaper (Author_ID,Paper_ID) VALUES( '" . $_POST['Aut_ID'] . "' , @Paper_ID)";
                    $sql4 = "INSERT INTO TopicPaper (Topic_ID,Paper_ID) VALUES('" . $_POST['Top_ID'] . "' , @Paper_ID)";
                    $sql5 = "SELECT topicSOTA FROM Topics WHERE Top_ID = '" . $_POST['Top_ID'] . "' ";
                    $result2 = $conn->query($sql5);
                    $row2 = $result2->fetch_assoc();
                    if ("" . $_POST['result'] . "" > $row2["topicSOTA"]){
                        $sql6 = "UPDATE Topics SET topicSOTA = '" . $_POST['result'] . "' WHERE Top_ID = '" . $_POST['Top_ID'] . "'";
                        if($conn->query($sql6) === TRUE){
                            echo "SOTA result update success! <br />";
                        }
                        else{
                            echo "Error updating SOTA: " . $conn->error;
                        }
                    }
                    if (($conn->query($sql1) === TRUE) && ($conn->query($sql2) === TRUE)
                        && ($conn->query($sql3) === TRUE) && ($conn->query($sql4) === TRUE)) {
                        echo "Paper was created successfully <br />";
                    } else {
                        echo "Error updating record: " . $conn->error;
                    }
                    echo "<br>Click <a href = 'dashboard.php'> here</a> to return to dashboard. <br />";
                }
                else{
                    ?>
                    <br>
                       Unrestricted Area! Click <a href = "dashboard.php"> here </a> to return to dashboard. <br />
                    <br>
                    <?php
                }
            }
            else{
                ?>
                <br>
                   You're not even logged in! Click <a href = "dashboard.php"> here </a> to return to dashboard. <br />
                <br>
                <?php
            }
            $conn->close();
        ?>
        <h6> Academic SOTA Recorder </h6>

    </body>
</html>
