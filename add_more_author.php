<html>
    <head>
        <title>Academic SOTA Recorder</title>
    </head>
    <body style="background-color: Moccasin   ; color: Indigo  ; margin: 40 ">

        <h1>  Add More Author </h1>

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
        ?>
                    <?php
                        $sql = "SELECT Aut_ID, authorName, authorSurname FROM Authors";
                        $result = $conn->query($sql);
                        $sql2 = "SELECT Pap_ID, title FROM Papers";
                        $result2 = $conn->query($sql2);
                    if ($result->num_rows > 0 && $result2->num_rows > 0) {
                    ?>
                        <form action="add_more_author_result.php" method="post">
                            Author: &nbsp
                            <select name="Aut_ID">
                                <?php while ( $row = $result->fetch_assoc() ){  ?>
                                        <option value = "<?php echo $row["Aut_ID"] ?>"><?php echo "ID: ". $row["Aut_ID"] . "/ Name: " . $row["authorName"] . " " . $row["authorSurname"] ?></option>
                                <?php } ?>
                            </select>
                            Paper: &nbsp
                            <select name="Pap_ID">
                                <?php while ( $row = $result2->fetch_assoc() ){  ?>
                                        <option value = "<?php echo $row["Pap_ID"] ?>"><?php echo "ID: ". $row["Pap_ID"] . "/ Title: " .$row["title"] ?></option>
                                <?php } ?>
                            </select>
                            <p><input type="Submit" value = " Add "/></p>
                        </form>
                <?php
                    }

                    else{
                ?>
                        No Author in DB, First create one!
                        <br>
                        <form action="create_author.php" method="post">
                        <p><input type="submit" value = "Create Author"/></p>
                        </form>
                        <br>
                <?php    
                    }

                    ?>
                    <br>
                        Click <a href = "dashboard.php"> here</a> to return to Dashboard. <br />
                    <br>
                    <?php

                }

                else{
                    ?>
                    <br>
                       Unrestricted Area! Click <a href = "dashboard.php"> here </a> to return to Dashboard. <br />
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