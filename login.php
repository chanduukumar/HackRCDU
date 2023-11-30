<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate and sanitize the input (you can add more validation as needed)
    $username = htmlspecialchars(trim($username));
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $password = htmlspecialchars(trim($password));

    // Check if any of the fields are empty
    if (empty($username) || empty($email) || empty($password)) {
        echo "All fields are required.";
    } else {
        // In a real-world scenario, you would hash the password before storing it
        // For demonstration purposes, we'll store it in plain text (not recommended)
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare the data to be stored
        $userData = "$username|$email|$hashedPassword\n";

        // Open the file in append mode and write the data
        // Replace 'users.txt' with the actual file path you want to use
        $file = fopen("users.txt", "a");
        fwrite($file, $userData);
        fclose($file);

        echo "Registration successful!";
    }
}
?>

