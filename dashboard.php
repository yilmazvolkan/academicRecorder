<html>
    <head>
        <title>Academic SOTA Recorder</title>
    </head>
    <body style="background-color: Moccasin   ; color: Indigo  ; margin: 40 ">

        <h1> Dashboard </h1>

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
            else{

                if (isset($_SESSION['user_id'])) {
                    $sql = "SELECT isAdmin FROM users WHERE ID = " . $_SESSION['user_id'];
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();

                    if($row["isAdmin"] == 1){
                      ?> 
                        <form action="admin_panel.php" method="post">
                            <p><input type="submit" value = "Admin Panel"/></p>
                        </form>
                      
                      <?php 
                    }
           ?>
                    <form action="user_panel.php" method="post">
                        <p><input type="submit" value = "User Panel"/></p>
                    </form>

                    <form action="logout.php" method="post">
                        <p><input type="submit" value = "Logout"/></p>
                    </form>

                <?php
                }
                else{
        ?>
                    <form action="register.php" method="post">
                        <p><input type="submit" value = "Register"/></p>
                    </form>

                    <form action="login.php" method="post">
                        <p><input type="submit" value = "Login"/></p>
                    </form>
        <?php
                }
        
            }
            $conn->close();
        ?>

        <h6> Academic SOTA Recorder </h6>

    </body>
</html>
