<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate the email input
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $name = htmlspecialchars($_POST['name']);

    // Check if the email is valid
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Define the file where emails will be saved
        $file = 'emails.txt';

        // Prepare the data to be saved (name and email)
        $data = "Name: " . $name . " | Email: " . $email . "\n";

        // Append the email and name to the file
        if (file_put_contents($file, $data, FILE_APPEND | LOCK_EX)) {
            echo "Thank you, $name. Your email has been saved!";
        } else {
            echo "Error saving your email. Please try again.";
        }
    } else {
        // If the email is invalid, display an error
        echo "Invalid email format. Please go back and try again.";
    }
} else {
    // If the form was not submitted via POST, redirect back to the form
    header("Location: index.html");
    exit();
}
?>
