<html>
    <head>
        <title>Academic SOTA Recorder</title>
    </head>
   <body style="background-color: Moccasin   ; color: Indigo  ; margin: 40 ">

        <h1> Edit Paper </h1>

        <?php

            session_start();

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "academic_recorder";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

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
                    $sql = "SELECT Pap_ID, title, result, abstract FROM Papers WHERE Pap_ID = " . $_GET['id'];
                    $result = $conn->query($sql);

                    // If the record actually exists
                    if ($result->num_rows > 0) {
                        ?>
                        <form action="edit_paper_result.php" method="post">


                        <?php

                        // Get the data
                        $row = $result->fetch_assoc();
                        ?>
                            <p>ID: <input type="text" name="Pap_ID" value = "<?php echo $row["Pap_ID"] ?>" readonly /></p>
                            <p>Paper Title: <input type="text" name="title" value = "<?php echo $row["title"] ?>" /></p>
                            <p>Paper Result: <input type="text" name="result" value = "<?php echo $row["result"] ?>" /></p>
                            <p>Paper Abstract: <input type="text" name="abstract" value = "<?php echo $row["abstract"] ?>" /></p>
                            <p><input type="Submit" value = "Save Changes" /></p>
                        </form>
                        <?php
                    } else {
                        echo "Record does not exist";
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
