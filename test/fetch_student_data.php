<?php
include_once("../config.php");


// Retrieve the search term from the request parameters
$searchTerm = $_GET['q'];

// Construct the SQL query to retrieve the student data
$sql = "SELECT id FROM cys WHERE id LIKE '%$searchTerm%'";

$result = $conn->query($sql);

// Format the student data into the expected JSON format for Select2
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = array(
        'id' => $row['id'],
        'text' => $row['id']
    );
}

echo json_encode($data);

// Close the database connection
$conn->close();

?>
