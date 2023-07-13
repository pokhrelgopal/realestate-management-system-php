<?php
include 'common/connection.php';
?>

<html>

<head>
    <?php include 'common/head.php'; ?>
</head>

<body class="bg-dark py-24">
    <div class="flex items-center justify-center">
        <form action="" method="post" class="bg-light shadow px-4 py-4 rounded w-1/4">
            <h1 class="text-center text-2xl text-lessDark pb-4">Admin Login</h1>
            <div class="flex flex-col space-y-1">
                <label for="" class="text-lessDark">Username</label>
                <input type="text" name="username" id="" class="p-2 rounded border bg-ivory text-lessDark outline-0">
            </div>
            <div class="flex flex-col space-y-1">
                <label for="" class="text-lessDark">Password</label>
                <input type="password" name="password" id=""
                    class="p-2 rounded border bg-ivory text-lessDark outline-0">
            </div>
            <button type="submit" name="submit" class="bg-lightGray w-full text-light p-2 my-6 rounded">Login</button>
        </form>
    </div>
</body>

</html>

<?php
if (isset($_POST['submit'])) {
    session_start();
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        header('location:dashboard.php');
        $_SESSION['username'] = $username;
    } else {
        echo "<p id='error_login' class='absolute top-0 left-0 m-6 bg-red-500 text-white px-6 py-3'>
        Invalid Credentials.
        </p>
        <script>
        setTimeout(() => {
            document.getElementById('error_login').classList.add('hidden');
        }, 3000);
        </script>
        ";
    }
}

?>