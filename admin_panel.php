<html>
    <head>
        <title>Academic SOTA Recorder</title>
    </head>
    <body style="background-color: Moccasin   ; color: Indigo  ; margin: 40 ">

        <h1> Admin Panel </h1>

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

                    // List Authors
                    $sql = "SELECT Aut_ID, authorName, authorSurname FROM Authors";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        ?>
                        <h2> Authors </h2>
                        <table border = 1>
                            <tr>
                                <th>Operations</th>
                                <th>ID</th>
                                <th>Author Name</th>
                                <th>Author Surname</th>
                        <?php

                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td>
                                    <a href = "delete_author.php?id=<?php echo $row["Aut_ID"]; ?>"><img src = "img/delete.png" alt = "Delete" /></a>
                                    <a href = "edit_author.php?id=<?php echo $row["Aut_ID"]; ?>"><img src = "img/edit.png" alt = "Edit" /></a>
                                </td>
                                <td><?php echo $row["Aut_ID"]; ?></td>
                                <td><?php echo $row["authorName"]; ?></td>
                                <td><?php echo $row["authorSurname"]; ?></td>
                            </tr>
                            <?php
                        }

                        ?>
                        </table>
                        <?php
                    } else {
                        echo "The authors table is empty!";
                    }

                    ?>

                    <br>
                    <a href = "create_author.php">Add a new author</a><br />
                    <br>
                    <br>
                    
                    
                    <?php
                    // List Topics
                    $sql = "SELECT Top_ID, topicName FROM Topics";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        ?>
                        <h2> Topics </h2>
                        <table border = 1>
                            <tr>
                                <th>Operations</th>
                                <th>ID</th>
                                <th>Topic Name</th>
                        <?php

                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td>
                                    <a href = "delete_topic.php?id=<?php echo $row["Top_ID"]; ?>"><img src = "img/delete.png" alt = "Delete" /></a>
                                    <a href = "edit_topic.php?id=<?php echo $row["Top_ID"]; ?>"><img src = "img/edit.png" alt = "Edit" /></a>
                                </td>
                                <td><?php echo $row["Top_ID"]; ?></td>
                                <td><?php echo $row["topicName"]; ?></td>
                            </tr>
                            <?php
                        }

                        ?>
                        </table>
                        <?php
                    } else {
                        echo "The topics table is empty!";
                    }

                    ?>

                    <br>
                    <br>
                    <a href = "create_topic.php">Add a new topic</a><br />
                    <br>
                    <br>

                    
                    <?php
                    // List Papers
                    $sql = "SELECT Pap_ID, result, title, abstract FROM Papers";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        ?>
                        <h2> Papers </h2>
                        <table border = 1>
                            <tr>
                                <th>Operations</th>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Result</th>
                                <th>Abstract</th>
                        <?php

                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td>
                                    <a href = "delete_paper.php?id=<?php echo $row["Pap_ID"]; ?>"><img src = "img/delete.png" alt = "Delete" /></a>
                                    <a href = "edit_paper.php?id=<?php echo $row["Pap_ID"]; ?>"><img src = "img/edit.png" alt = "Edit" /></a>
                                </td>
                                <td><?php echo $row["Pap_ID"]; ?></td>
                                <td><?php echo $row["title"]; ?></td>
                                <td><?php echo $row["result"]; ?></td>
                                <td><?php echo $row["abstract"]; ?></td>
                            </tr>
                            <?php
                        }

                        ?>
                        </table>
                        <?php
                    } else {
                        echo "The Papers table is empty!";
                    }
                    ?>
                    <br>
                    <br>
                    <a href = "create_paper.php">Add a new paper</a><br />
                    <br>
                    <br>

                    Click <a href = "add_more_author.php"> here</a> to add more Authors to the Paper <br />

                    <br>
                    <br>
                    Click <a href = "add_more_topic.php"> here</a> to add more Topics to the Paper <br />
                    <br>
                    <br>
                    Click <a href = "dashboard.php"> here</a> to return to dashboard. <br />
                    <br>
                    
                    <?php
                }
                else{
                    ?>
                    <br>
                       Unrestricted Area! Click <a href = "dashboard.php"> here</a> to return to dashboard. <br />
                    <br>
                    <?php
                }
            }
            else{
                ?>
                <br>
                   You're not even logged in! Click <a href = "dashboard.php"> here</a> to return to dashboard. <br />
                <br>
                <?php
            }

            $conn->close();
        ?>
        <h6> Academic SOTA Recorder </h6>

    </body>
</html>
