<html>
    <head>
        <title>Academic SOTA Recorder</title>
    </head>
    <body style="background-color: Moccasin   ; color: Indigo  ; margin: 40 ">

        <h1> Remove Paper </h1>

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

                    // Update the record
                    $sql0 = "UPDATE Papers SET result = -1 WHERE Pap_ID = " . $_POST['Pap_ID'];
                    $sql2 = "UPDATE Topics SET topicSOTA = (SELECT MAX(result) FROM Papers WHERE Pap_ID IN(SELECT Paper_ID FROM TopicPaper WHERE Topic_ID IN (SELECT Topic_ID FROM TopicPaper WHERE Paper_ID = '" . $_POST['Pap_ID'] . "'))) WHERE Top_ID IN (SELECT Topic_ID FROM TopicPaper WHERE Paper_ID = '" . $_POST['Pap_ID'] . "')";
                    $sql = "DELETE FROM Papers WHERE Pap_ID = " . $_POST['Pap_ID'];

                    if ($conn->query($sql0) === TRUE) {
                    } else {
                        echo "Error updating SOTA: " . $conn->error;
                    }
                    if ($conn->query($sql2) === TRUE) {
                        echo "SOTA updated successfully! <br />";
                    } else {
                        echo "Error updating SOTA: " . $conn->error;
                    }


                    if ($conn->query($sql) === TRUE) {
                        echo "Paper was deleted successfully! <br />";
                    } else {
                        echo "Error updating record: " . $conn->error;
                    }
                    echo "<br>Click <a href = 'dashboard.php'> here </a> to return to dashboard. <br />";
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
