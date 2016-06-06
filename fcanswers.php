<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
$q = intval($_GET['q']);
$dbHost = getenv('OPENSHIFT_MYSQL_DB_HOST'); 
$dbPort = getenv('OPENSHIFT_MYSQL_DB_PORT'); 
$dbUser = getenv('OPENSHIFT_MYSQL_DB_USERNAME'); 
$dbPassword = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
$link = mysqli_connect("$dbHost", "$dbUser", "$dbPassword", "flashcard_db");

if (!$link) {
    die('Could not connect: ' . mysqli_error($link));
}

mysqli_select_db($link,"flashcard_db");
$sql="SELECT * FROM flashcard WHERE id = '".$q."'";
$result = mysqli_query($link,$sql);

echo "<table>
<tr>
<th>ID</th>
<th>Question</th>
<th>Answer</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['question'] . "</td>";
    echo "<td>" . $row['answer'] . "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($link);
?>
</body>
</html>