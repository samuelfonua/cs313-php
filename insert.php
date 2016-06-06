<?php

$dbHost = getenv('OPENSHIFT_MYSQL_DB_HOST'); 
$dbPort = getenv('OPENSHIFT_MYSQL_DB_PORT'); 
$dbUser = getenv('OPENSHIFT_MYSQL_DB_USERNAME'); 
$dbPassword = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
$link = mysqli_connect("$dbHost", "$dbUser", "$dbPassword", "flashcard_db");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Escape user inputs for security
$question = mysqli_real_escape_string($link, $_POST['q']);
$answer = mysqli_real_escape_string($link, $_POST['a']);

 
// attempt insert query execution
$sql = "INSERT INTO flashcard (question, answer) VALUES ('$question', '$answer')";
if(mysqli_query($link, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// close connection
mysqli_close($link);
?>