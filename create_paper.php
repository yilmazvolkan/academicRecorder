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
                        $sql2 = "SELECT Top_ID, topicName FROM Topics";
                        $result2 = $conn->query($sql2);
                    if ($result->num_rows > 0 && $result2->num_rows > 0) {
                    ?>
                        <form action="create_paper_result.php" method="post">
                            Author Name: &nbsp
                            <select name="Aut_ID">
                                <?php while ( $row = $result->fetch_assoc() ){  ?>
                                        <option value = "<?php echo $row["Aut_ID"] ?>"><?php echo $row["authorName"] ." " . $row["authorSurname"] ?></option>
                                <?php } ?>
                            </select>
                            <p>Paper Title: <input type="text" name="title" value = "" /></p>
                            <p>Paper Result: <input type="text" name="result" value = "" /></p>
                            <p>Paper Abstract: <input type="text" name="abstract" value = "" /></p>
                            Topic Name: &nbsp
                            <select name="Top_ID">
                                <?php while ( $row = $result2->fetch_assoc() ){  ?>
                                        <option value = "<?php echo $row["Top_ID"] ?>"><?php echo $row["topicName"] ?></option>
                                <?php } ?>
                            </select>
                            <p><input type="Submit" value = "Create Paper Record"/></p>
                        </form>
                <?php
                    }

                    else{
                ?>
                        No Authors or Topics in DB, First create one!
                        <form action="create_author.php" method="post">
                        <p><input type="submit" value = "Create Author"/></p>
                        </form>
                        <br>
                        <form action="create_topic.php" method="post">
                        <p><input type="submit" value = "Create Topic"/></p>
                        </form>
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