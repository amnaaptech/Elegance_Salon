<?php
session_start();
include('config.php'); 

if (isset($_POST['register'])) {
    // Retrieve input values from the login form
    $username = $_POST['name'];
    $userEmail = $_POST['email'];
    $password = $_POST['password'];

    $_SESSION['email'] = $userEmail;

    // Check if the login is for the admin account
    if ($username === 'admin' && $password === 'admin' && $userEmail === 'admin@gmail.com') {
        $_SESSION['username'] = 'admin';
        header('Location: ../Admin Dashboard/dashboard.php');
        exit();
    } else {
        // Query to find the user in the database
        $query = "SELECT * FROM registration WHERE Name = '$username'";
        $result = mysqli_query($conn, $query);

        // Check if the user exists
        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

            // Verify the password and email
            if ($password === $user['Password'] && $userEmail === $user['Email']) {
                // Store user info in session, including the user ID
                $_SESSION['username'] = $user['Name'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['user_id'] = $user['id'];  // Store the user's unique ID in the session

                // Redirect based on role
                if ($user['role'] === 'receptionist') {
                    header('Location: ../Receptionist Panel/dashboard.php');
                    exit();
                } elseif ($user['role'] === 'barber') {
                    header('Location: ../barber panel/dashboard.php');
                    exit();
                } elseif ($user['role'] === 'user') {
                    header('Location: ../index.php');
                    exit();
                } else {
                    header('Location: index.php');
                    exit();
                }
            } else {
                echo "Incorrect password or Email";
            }
        } else {
            echo "No user found with that username";
        }
    }
}
?>
