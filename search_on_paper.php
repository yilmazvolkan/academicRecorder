<html>
    <head>
        <title>Academic SOTA Recorder</title>
    </head>
    <body style="background-color: Moccasin   ; color: Indigo  ; margin: 40 ">

        <h1> User Panel </h1>

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

                    $sql = "SELECT * FROM Papers WHERE (title LIKE '%" . $_POST['keyword'] . "%' or abstract LIKE  '%" . $_POST['keyword'] . "%'  )";
                    $result = $conn->query($sql);
                    if (!$result) {
                        trigger_error('Invalid query: ' . $conn->error);
                    }

                    if ($result->num_rows > 0) {
                        ?>
                        <h3> Search results </h3>
                        <table border = 1>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Result</th>
                                <th>Abstract</th>
                                <th>Authors</th>
                                <th>Topics</th>

                        <?php

                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $row["Pap_ID"]; ?></td>
                                <td><?php echo $row["title"]; ?></td>
                                <td><?php echo $row["result"]; ?></td>
                                <td><?php echo $row["abstract"]; ?></td>
                                <?php
                                //Get Authors
                                $sqlAuthor = "SELECT authorName, authorSurname FROM Authors WHERE Aut_ID IN (SELECT Author_ID FROM AuthorPaper WHERE Paper_ID =" . $row["Pap_ID"] . ")";
                                $result2 = $conn->query($sqlAuthor);
                                $authors = '';
                                // output data of each row
                                while($row2 = $result2->fetch_assoc()) {
                                    $authors .= $row2["authorName"]. ' ' .$row2["authorName"]. ', ';
                                }
                                $authors = rtrim($authors, ', ');
                                ?>
                                <td><?php echo $authors; ?></td>


                                <?php
                                //Get Topics
                                $sqlTopic = "SELECT topicName FROM Topics WHERE Top_ID IN (SELECT Topic_ID FROM TopicPaper WHERE Paper_ID =" . $row["Pap_ID"] . ")";
                                $result3 = $conn->query($sqlTopic);
                                $topics = '';
                                // output data of each row
                                while($row3 = $result3->fetch_assoc()) {
                                    $topics .= $row3["topicName"]. ', ';
                                }
                                $topics = rtrim($topics, ', ');
                                ?>
                                <td><?php echo $topics; ?></td>
                            </tr>
                            <?php
                        }

                        ?>
                        </table>
                        <?php
                    } else {
                        echo "Cannot find this word!";
                    }

                    ?>

                    <br>
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
