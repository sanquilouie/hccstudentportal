<?php

// Include database configuration file
include_once("../config.php");

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get the student ID from the form data
    $studentID = $_POST["updateStudentID"];

    // Get the updated student data from the form data
    $firstName = $_POST["updateFirstName"];
    $lastName = $_POST["updateLastName"];
    $contact = $_POST["updateContact"];
    $birthday = $_POST["updateBirthday"];
    $course = $_POST["updateCourse"];

    // Prepare the SQL query to update the student record
    $sql = "UPDATE students SET firstname=?, lastname=?, contact=?, birthday=?, course=? WHERE studentid=?";

    // Prepare the statement
    $stmt = mysqli_prepare($conn, $sql);

    // Bind the parameters
    mysqli_stmt_bind_param($stmt, "sssssi", $firstName, $lastName, $contact, $birthday, $course, $studentID);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Close the statement
    mysqli_stmt_close($stmt);

    // Close the database connection
    mysqli_close($mysqli);
}
