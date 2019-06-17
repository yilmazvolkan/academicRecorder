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

                    // List Authors
                    $sql = "SELECT Aut_ID, authorName, authorSurname FROM Authors";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        ?>
                        <h2> Authors </h2>
                        <table border = 1>
                            <tr>
                                <th>ID</th>
                                <th>Author Name</th>
                                <th>Author Surname</th>
                        <?php

                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
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
                    <br>
                    <br>
                    
                    
                    <?php
                    // List Topics
                    $sql = "SELECT Top_ID, topicName,topicSOTA FROM Topics";
                    $result = $conn->query($sql);

                    
                    if ($result->num_rows > 0) {
                        ?>
                        <h2> Topics </h2>
                        <table border = 1>
                            <tr>
                                <th>ID</th>
                                <th>Topic Name</th>
                                <th>SOTA Result</th>
                                <th>Paper Title</th>
                        <?php

                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $row["Top_ID"]; ?></td>
                                <td><?php echo $row["topicName"]; ?></td>
                                <td><?php echo $row["topicSOTA"]; ?></td>

                                <?php
                                //Get Topics

                                $sqlPaper = "SELECT title FROM Papers WHERE result = (SELECT MAX(result) FROM Papers WHERE Pap_ID IN(SELECT Paper_ID FROM TopicPaper WHERE Topic_ID = " . $row["Top_ID"] . "))";


                                $resultPap = $conn->query($sqlPaper);
                                // output data of each row
                                $topics = '';
                                while($row2 = $resultPap->fetch_assoc()) {
                                    $topics .= $row2["title"]. ', ';
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
                        echo "The topics table is empty!";
                    }

                    ?>

                    <br>
                    <br>
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
                                <th>ID</th>
                                <th>Title</th>
                                <th>Result</th>
                                <th>Abstract</th>
                                <th>Author</th>
                                <th>Topic</th>
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
                                $sqlAuthor = "SELECT authorName,authorSurname FROM Authors WHERE Aut_ID IN (SELECT Author_ID FROM AuthorPaper WHERE Paper_ID =" . $row["Pap_ID"] . ")";
                                $result2 = $conn->query($sqlAuthor);
                                $authors = '';
                                // output data of each row
                                while($row2 = $result2->fetch_assoc()) {
                                    $authors .= $row2["authorName"].' '.$row2["authorSurname"]. ', ';
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
                        echo "The Papers table is empty!";
                    }
                    ?>
                    <br>
                    <br>
                    <br>
                    <br>

                    <h2> View all Papers of the Author </h2>
                    <?php
                        $sql = "SELECT Aut_ID, authorName, authorSurname FROM Authors";
                        $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                    ?>
                        <form action="view_paper_result.php" method="post">
                            Author Name: &nbsp
                            <select name="Aut_ID">
                                <?php while ( $row = $result->fetch_assoc() ){  ?>
                                        <option value = "<?php echo $row["Aut_ID"] ?>"><?php echo $row["authorName"]. ' '. $row["authorSurname"] ?></option>
                                <?php } ?>
                            </select>
                            <p><input type="Submit" value = "View"/></p>
                        </form>
                    <?php
                    }

                    else{
                    ?>
                        No Authors in DB, First create one!
                        Click <a href = "dashboard.php"> here</a> to return to dashboard. <br />
                    <?php    
                    }

                    ?>

                    <br>
                    <br>
                    <br>
                    <br>

                    <h2> View all Papers of the Topic </h2>
                    <?php
                        $sql = "SELECT Top_ID, topicName FROM Topics";
                        $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                    ?>
                        <form action="view_paper_result2.php" method="post">
                            Topic Name: &nbsp
                            <select name="Top_ID">
                                <?php while ( $row = $result->fetch_assoc() ){  ?>
                                        <option value = "<?php echo $row["Top_ID"] ?>"><?php echo $row["topicName"] ?></option>
                                <?php } ?>
                            </select>
                            <p><input type="Submit" value = "View"/></p>
                        </form>
                    <?php
                    }

                    else{
                    ?>
                        No Authors in DB, First create one!
                        Click <a href = "dashboard.php"> here</a> to return to dashboard. <br />
                    <?php    
                    }

                    ?>

                    <br>
                    <br>
                    <br>
                    <br>


                    <h2> Search Keyword on all Papers </h2>
                    <?php
                    if ($result->num_rows > 0) {
                    ?>
                        <form action="search_on_paper.php" method="post">
                            <p>Keyword: <input type="text" name="keyword" value = "" /></p>
                            <p><input type="Submit" value = "Search"/></p>
                        </form>
                    <?php
                    }

                    else{
                    ?>
                        You enter wrong keyword!
                        Click <a href = "dashboard.php"> here</a> to return to dashboard. <br />
                    <?php    
                    }

                    ?>

                    <br>
                    <br>
                    <br>
                    <br>

                   <h2> Rank authors by number of SOTA Results </h2>
                    Click <a href = "rank_authors.php"> here</a> view the result <br />

                    <br>
                    <br>
                    <br>
                    <br>

                    <h2> View all Coworkers of the Author </h2>
                    <?php
                        $sql = "SELECT Aut_ID, authorName,authorSurname FROM Authors";
                        $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                    ?>
                        <form action="coworker_result.php" method="post">
                            Author Name: &nbsp
                            <select name="Aut_ID">
                                <?php while ( $row = $result->fetch_assoc() ){  ?>
                                        <option value = "<?php echo $row["Aut_ID"] ?>"><?php echo $row["authorName"] .' '.$row["authorSurname"]  ?></option>
                                <?php } ?>
                            </select>
                            <p><input type="Submit" value = "View"/></p>
                        </form>
                    <?php
                    }

                    else{
                    ?>
                        No Authors in DB, First create one!
                        Click <a href = "dashboard.php"> here</a> to return to dashboard. <br />
                    <?php    
                    }

                    ?>

                    <br>
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
                   You're not even logged in! Click <a href = "dashboard.php"> here</a> to return to dashboard. <br />
                <br>
                <?php
            }

            $conn->close();
        ?>
        <h6> Academic SOTA Recorder </h6>

    </body>
</html>
