<?php
include 'common/connection.php';
session_start();

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) != 1) {
        echo "
        <p class='absolute m-6 bg-lightRed text-light px-4 py-2'>
            Invalid Credentials.
        </p>
        ";
    } else {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['email'] = $email;
            header('location: index.php');
        } else {
            echo "
            <p class='absolute m-6 bg-lightRed text-light px-4 py-2'>
                Invalid Credentials.
            </p>
            ";
        }
    }
}
?>

<!doctype html>
<html>

<head>
    <?php include 'common/head.php'; ?>
</head>


<body class="bg-cleanLight text-xl">

    <div>
        <div class="flex items-center justify-center my-20">
            <form action="#" method="POST" class="mt-8 w-[550px] bg-light px-8 pb-12 text-lessDark rounded-xl shadow-xl">
                <h1 class="text-3xl text-center py-5">Login here !</h1>
                <div class="space-y-5">
                    <div>
                        <label for="" class="text-gray-900"> Email address </label>
                        <div class="mt-2.5">
                            <input type="email" name="email" id="" placeholder="Enter email to get started" class="block w-full p-4 text-lessDark rounded outline-0 bg-ivory" />
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between">
                            <label for="" class="text-gray-900"> Password </label>
                        </div>
                        <div class="mt-2.5">
                            <input type="password" name="password" id="" placeholder="Enter your password" class="block w-full p-4 text-lessDark rounded outline-0 bg-ivory" />
                        </div>
                    </div>
                    <div>
                        <button type="submit" name="submit" class="w-full py-4 text-dark bg-lessDark rounded">Log
                            in</button>
                    </div>
                    <p class="text-center"> Don't have an account? <a href="signup.php" class="underline">Sign
                            up</a> </p>
                </div>
            </form>
        </div>
    </div>

</body>

</html>