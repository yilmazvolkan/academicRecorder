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
                    $sql = "SELECT MAX(authorName) AS Author_NAME, MAX(authorSurname) AS Author_SURNAME, COUNT(DISTINCT t.topicSOTA, t.Top_ID) AS Author_SOTA FROM Authors a INNER JOIN AuthorPaper ap ON a.Aut_ID = ap.Author_ID INNER JOIN TopicPaper tp ON tp.Paper_ID = ap.Paper_ID INNER JOIN Topics t ON t.Top_ID = tp.Topic_ID GROUP BY (a.authorName) ORDER BY Author_SOTA DESC";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        ?>
                        <h2> Authors </h2>
                        <table border = 1>
                            <tr>
                                <th>Author Name</th>
                                <th>Author Surname</th>
                                <th># of SOTA</th>
                        <?php

                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $row["Author_NAME"]; ?></td>
                                <td><?php echo $row["Author_SURNAME"]; ?></td>
                                <td><?php echo $row["Author_SOTA"]; ?></td>
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
