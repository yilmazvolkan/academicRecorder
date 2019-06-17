<html>
    <head>
        <title>Academic SOTA Recorder</title>
    </head>
    <body style="background-color: Moccasin   ; color: Indigo  ; margin: 40 ">

        <h1> Add More Topic </h1>

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
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();

                if($row["isAdmin"] == 1){
                    // Insert the record
                    $sql = "INSERT INTO TopicPaper(Topic_ID, Paper_ID) " .
                        "VALUES('" . $_POST['Top_ID'] . "', '" . $_POST['Pap_ID'] . "')";
                    $sql2 = "UPDATE Topics SET topicSOTA = (SELECT result FROM Papers WHERE Pap_ID = '" . $_POST['Pap_ID'] . "' ) WHERE  Top_ID  = " . $_POST['Top_ID'];
                    if ($conn->query($sql) === TRUE && $conn->query($sql2) === TRUE) {
                        echo "Topic added successfully! <br />";
                    } else {
                        echo "Error updating author record. Topic has already been added:  " . $conn->error;
                    }
                    echo "<br>Click <a href = 'dashboard.php'> here</a> to return to dashboard. <br />";
                    echo "<br>Click <a href = 'add_more_topic.php'> here</a> to add more Topics to the Paper. <br />";
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
