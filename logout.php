<html>
    <head>
        <title>Academic SOTA Recorder</title>
    </head>
    <body style="background-color: Moccasin   ; color: Indigo  ; margin: 40 ">

        <h1> Logout Page </h1>

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
                    session_unset(); 
                    // destroy the session 
                    session_destroy(); 
            ?>
                    User Logout Succesful!
           			<br>
                    <a href = "dashboard.php">Dashboard</a><br />
                    <br>
                <?php
                }
                else{
                ?>
	                <br>
                    You're not even logged in! Click <a href = "dashboard.php"> here </a> to return to dashboard. <br />
                    <br>
        <?php
        		}
            }
            $conn->close();
        ?>
        <h6> Academic SOTA Recorder </h6>

    </body>
</html>
