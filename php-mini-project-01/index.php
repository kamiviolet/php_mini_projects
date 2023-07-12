<?php include __DIR__."/components/header.php";?>

<?php
    $username = $email = "";
    $username_error = $email_error = "";

    if (isset($_POST["submit"])) {
        if (empty($_POST["username"])) {
            $username_error = "username is required.";
        } else {
            $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }

        if (empty($_POST["email"])) {
            $email_error = "email is required.";
        } else {
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);        
        }

        if (empty($username_error) && empty($email_error)) {
            $query = "INSERT INTO `users` (`id`, `username`, `email`, `account_created_time`) VALUES (NULL, '$username', '$email', current_timestamp());";
            echo "First step done!";
            mysqli_query($connection, "ALTER TABLE `users` AUTO_INCREMENT = 3");
            if (mysqli_query($connection, $query)) {
                header("Location: confirmation.php");
            } else {
                echo "Error: " . mysqli_error($connection);
            }
        }
    }
?>

    <main>
        <form action=<?= htmlspecialchars($_SERVER["PHP_SELF"]);?> method="POST">
            <label for="username">Username: </label>
            <input
                type="text"
                name="username"
                placeholder="Please enter your username."
                value="<?=$username; ?>"
                class="<?=!$username_error? :"is-invalid";?>"
                require
            >
            <div class="warning"><?=$username_error;?></div>
            <label for="email">Email: </label>
            <input
                type="email"
                name="email"
                value="<?= $email; ?>"
                class="<?= !$email_error? :"is-invalid";?>"
                require
            >
            <div class="warning"><?=$email_error;?></div>
            <input type="submit" name="submit" value="SUBMIT">
        </form>
    </main>
</body>
</html>