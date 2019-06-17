<html>
    <head>
        <title>Academic SOTA Recorder</title>
    </head>
    <body style="background-color: Moccasin   ; color: Indigo  ; margin: 40 ">

        <h1> Login Page </h1>

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
           ?>
           			<form action="dashboard.php" method="post">
                        <p>You're already logged in: <input type="submit" value = "Dashboard"/></p>
                    </form>
                <?php
                }
                else{
	                // Insert the record
	                $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ? LIMIT 1");
			        $stmt->bind_param('s', $username);  // Bind "$email" to parameter.
			        $username = $_POST['username'];
			        $stmt->execute();    // Execute the prepared query.
			        $stmt->store_result();
	 
	        		// get variables from result.
	        		$stmt->bind_result($user_id, $user_password);
	        		$stmt->fetch();

	        		if ($stmt->num_rows == 1) {
	        			if (password_verify($_POST['password'], $user_password)){
	        			//if(strcmp ($user_password , $_POST['password']) == 0){
	        				$_SESSION["user_id"] = $user_id;
	        				
	        				echo "Succesfully Logged In! <br />";
	        				?>
	        				<br>
	                		<a href = "dashboard.php">Dashboard</a><br />
	                		<br>
	                		<?php
	        			}
	        			else{
		                    echo "Login attempt failed <br />";
		        			?>
		        			<br>
		                	<a href = "dashboard.php">Try Again</a><br />
		                	<br>
		                	<?php
		                }
	                }
	                else{
	                    echo "Login attempt failed! <br />";
	        			?>
	        			<br>
	                	<a href = "dashboard.php">Try Again</a><br />
	                	<br>
	                	<?php
	                } 
	            }
            $conn->close();
        }
        ?>
        <h6> Academic SOTA Recorder </h6>

    </body>
</html>
