<html>
    <head>
        <title>Academic SOTA Recorder</title>
    </head>
    <body style="background-color: Moccasin   ; color: Indigo  ; margin: 40 ">

        <h1> Remove Topic </h1>

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

                    // Fetch the record
                    $sql = "SELECT Top_ID, topicName FROM Topics WHERE Top_ID = " . $_GET['id'];
                    $result = $conn->query($sql);
                    if (!$result) {
                        trigger_error('Invalid query: ' . $conn->error);
                    }
                    // If the record actually exists
                    if ($result->num_rows > 0) {
                        ?>
                        <form action="delete_topic_result.php" method="post">
                        <?php

                        // Get the data
                        $row = $result->fetch_assoc();
                        ?>
                            Are you sure you want to delete the following topic record? <br />
                            <p>ID: <input type="text" name="Top_ID" value = "<?php echo $row["Top_ID"] ?>" readonly /></p>
                            <p>Topic Name: <input type="text" name="topicName" value = "<?php echo $row["topicName"] ?>" readonly /></p>
                            <p><input type="submit" value = "Delete Topic" /></p>
                        </form>
                        <?php
                    } else {
                        echo "Record does not exist";
                    }
                    echo "<br>Click <a href = 'dashboard.php'> here</a> to return to dashboard. <br />";
                }else{
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