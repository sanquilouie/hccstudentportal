<?php

// Include database configuration file
include_once("../config.php");

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get the student ID from the form data
    $studentID = $_POST["deleteStudentID"];

    // Prepare the SQL query to delete the student record
    $sql = "DELETE FROM students WHERE studentid=?";

    // Prepare the statement
    $stmt = mysqli_prepare($conn, $sql);

    // Bind the parameter
    mysqli_stmt_bind_param($stmt, "i", $studentID);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Close the statement
    mysqli_stmt_close($stmt);

    // Close the database connection
    mysqli_close($mysqli);
}
