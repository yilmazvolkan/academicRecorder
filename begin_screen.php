<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "academic_recorder";


// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE academic_recorder";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully!";
} else {
    echo "Error while creating the database: " . $conn->error;
}

echo "<br>";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// sql to create Tables

$sql = "CREATE TABLE Papers(
Pap_ID int(6) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
result int(6) UNSIGNED NOT NULL ,
title varchar(30) NOT NULL ,
abstract varchar(100) NOT NULL ,
UNIQUE (title)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table Papers created successfully!";
} else {
    echo "Error while creating table: " . $conn->error;
}

echo "<br>";

$sql = "CREATE TABLE Authors(
Aut_ID int(6) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
authorName varchar(20) NOT NULL ,
authorSurname varchar(20) NOT NULL ,
CONSTRAINT aut_na_sur UNIQUE (authorName, authorSurname)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table Authors created successfully!";
} else {
    echo "Error while creating the table: " . $conn->error;
}

echo "<br>";

$sql = "CREATE TABLE AuthorPaper(
Author_ID int(6) UNSIGNED NOT NULL ,
FOREIGN KEY(Author_ID) REFERENCES Authors(Aut_ID)
ON DELETE CASCADE ON UPDATE CASCADE,
Paper_ID int(6) UNSIGNED NOT NULL ,
FOREIGN KEY(Paper_ID) REFERENCES Papers(Pap_ID)
ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT aut_pap_no UNIQUE (Author_ID,Paper_ID)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table AuthorPaper created successfully!";
} else {
    echo "Error while creating the table: " . $conn->error;
}

echo "<br>";


$sql = "CREATE TABLE Topics
(
Top_ID int(6) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
topicName varchar(20) NOT NULL ,
topicSOTA int(6) NOT NULL ,
UNIQUE (topicName,topicSOTA)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table Topics created successfully!";
} else {
    echo "Error while creating table: " . $conn->error;
}

echo "<br>";

$sql = "CREATE TABLE TopicPaper
(
Topic_ID int(6) UNSIGNED NOT NULL ,
FOREIGN KEY(Topic_ID) REFERENCES Topics(Top_ID)
ON DELETE CASCADE ON UPDATE CASCADE,
Paper_ID int(6) UNSIGNED NOT NULL ,
FOREIGN KEY(Paper_ID) REFERENCES Papers(Pap_ID)
ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT top_pap_no UNIQUE (Topic_ID,Paper_ID)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table TopicPaper created successfully!";
} else {
    echo "Error while creating table: " . $conn->error;
}

echo "<br>";

$sql = "CREATE TABLE users (
ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
username VARCHAR(30) NOT NULL,
password VARCHAR(96) NOT NULL,
isAdmin INT(1) NOT NULL,
UNIQUE (username)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table users created successfully!";
} else {
    echo "Error while creating table: " . $conn->error;
}

echo "<br>";


$hash = password_hash('password', PASSWORD_DEFAULT);
$sql = "INSERT INTO users(username, password, isAdmin) " .
    "VALUES('admin', '" . $hash . "', 1)";

if ($conn->query($sql) === TRUE) {
    echo "Admin created successfully!: <br>Username: admin <br>Password: password";
} else {
    echo "Error creating the admin: " . $conn->error;
}


echo "<br><br><a href = \"dashboard.php\">Dashboard</a><br /><br />";

$conn->close();
?>