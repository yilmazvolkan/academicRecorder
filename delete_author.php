<html>
    <head>
        <title>Academic SOTA Recorder</title>
    </head>
   <body style="background-color: Moccasin   ; color: Indigo  ; margin: 40 ">

        <h1> Remove Author </h1>

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
                    $sql = "SELECT Aut_ID, authorName,authorSurname FROM Authors WHERE Aut_ID = " . $_GET['id'];
                    $result = $conn->query($sql);
                    if (!$result) {
                        trigger_error('Invalid query: ' . $conn->error);
                    }
                    // If the record actually exists
                    if ($result->num_rows > 0) {
                        ?>
                        <form action="delete_author_result.php" method="post">
                        <?php

                        // Get the data
                        $row = $result->fetch_assoc();
                        ?>
                            Are you sure you want to delete the following author record? <br />
                            <p>ID: <input type="text" name="Aut_ID" value = "<?php echo $row["Aut_ID"] ?>" readonly /></p>
                            <p>Author Name: <input type="text" name="authorName" value = "<?php echo $row["authorName"] ?>" readonly /></p>
                            <p>Author Surname: <input type="text" name="authorSurname" value = "<?php echo $row["authorSurname"] ?>" readonly /></p>
                            <p><input type="submit" value = "Delete Author" /></p>
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