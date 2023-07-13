<!doctype html>
<html>

<head>
    <?php include 'common/head.php'; ?>
</head>


<body class="container mx-auto bg-slate-100">
    <!-- navbar starts -->
    <?php include 'common/navbar.php'; ?>
    <!-- navbar ends -->

    <main class="container mx-auto py-8">
        <div class="grid grid-cols-4 gap-4">
            <div class="">
                <?php include 'menu.php'; ?>
            </div>
            <div class="col-span-3">

                <form action="" method="POST" id='myForm' class="w-1/2 space-y-3 text-lg">
                    <div class="form-control flex flex-col">
                        <label for="old password">Old Password</label>
                        <span id="oldPasswordError" class="text-lightRed"></span>
                        <input type="password" id="oldPassword" name="oldPassword"
                            class="bg-white p-4 rounded bg-ivory outline-0" value="" required>
                    </div>
                    <div class="form-control flex flex-col">
                        <label for="new password">New Password</label>
                        <span id="newPasswordError" class="text-lightRed"></span>
                        <input type="password" id="newPassword" name="newPassword"
                            class="bg-white p-4 rounded bg-ivory outline-0" value="" required>
                    </div>
                    <div class="form-control flex flex-col">
                        <label for="confirm new password">Confirm New Password</label>
                        <span id="confirmNewPasswordError" class="text-lightRed"></span>
                        <input type="password" id="confirmNewPassword" name="confirmNewPassword"
                            class="bg-white p-4 rounded bg-ivory outline-0" value="" required>
                    </div>

                    <button type="submit" name="changePassword"
                        class=" rounded text-light bg-lessDark py-4 w-full">Change
                        Password</button>
                </form>
            </div>
        </div>
</body>
<script>
const myForm = document.getElementById('myForm');
myForm.addEventListener('submit', (e) => {
    const oldPassword = document.getElementById('oldPassword');
    const newPassword = document.getElementById('newPassword');
    const confirmNewPassword = document.getElementById('confirmNewPassword');
    const oldPasswordError = document.getElementById('oldPasswordError');
    const newPasswordError = document.getElementById('newPasswordError');
    const confirmNewPasswordError = document.getElementById('confirmNewPasswordError');

    // old password validation
    if (oldPassword.value == '') {
        event.preventDefault();
        oldPasswordError.innerHTML = 'Old Password is required';
        oldPassword.focus();
    } else {
        oldPasswordError.innerHTML = '';
    }

    // new password validation
    if (newPassword.value == '') {
        event.preventDefault();
        newPasswordError.innerHTML = 'New Password is required';
        newPassword.focus();
    } else if (newPassword.value.length < 8) {
        event.preventDefault();
        newPasswordError.innerHTML = 'New Password must be at least 6 characters';
        newPassword.focus();
    } else if (newPassword.value.search(/[a-z]/i) < 0) {
        event.preventDefault();
        newPasswordError.innerHTML = 'New Password must contain at least one letter.';
        newPassword.focus();
    } else if (newPassword.value.search(/[0-9]/) < 0) {
        event.preventDefault();
        newPasswordError.innerHTML = 'New Password must contain at least one digit.';
        newPassword.focus();
    } else {
        newPasswordError.innerHTML = '';
    }

    // confirm new password validation
    if (confirmNewPassword.value == '') {
        event.preventDefault();
        confirmNewPasswordError.innerHTML = 'Confirm New Password is required';
        confirmNewPassword.focus();
    } else if (confirmNewPassword.value != newPassword.value) {
        event.preventDefault();
        confirmNewPasswordError.innerHTML = 'Confirm New Password must be same as New Password';
        confirmNewPassword.focus();
    } else {
        confirmNewPasswordError.innerHTML = '';
        console.log('form submitted');
    }
});
</script>

</html>

<?php
// echo $id;
// $id contains the id of the user
if (isset($_POST['changePassword'])) {
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmNewPassword = $_POST['confirmNewPassword'];

    $sql = "SELECT * FROM users WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $password = $row['password'];

    if (password_verify($oldPassword, $password)) {
        if ($newPassword == $confirmNewPassword) {
            $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET password = '$newPassword' WHERE id = '$id'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<p id='error_login' class='absolute bottom-0 right-0 m-6 bg-lightGreen text-dark px-6 py-3'>
                        Password changed successfully
                        </p>
                        <script>
                        setTimeout(() => {
                            document.getElementById('error_login').classList.add('hidden');
                            window.location.href='profile.php'
                        }, 3000);
                        </script>";
            } else {
                echo "<p id='error_login' class='absolute bottom-0 right-0 m-6 bg-lightRed text-light px-6 py-3'>
                        Password not changed. Try again
                        </p>
                        <script>
                        setTimeout(() => {
                            document.getElementById('error_login').classList.add('hidden');
                        }, 1000);
                        </script>";
            }
        } else {
            echo "<p id='error_login' class='absolute bottom-0 right-0 m-6 bg-lightRed text-light px-6 py-3'>
                        New Password and Confirm New Password must be same
                        </p>
                        <script>
                        setTimeout(() => {
                            document.getElementById('error_login').classList.add('hidden');
                        }, 1000);
                        </script>";
        }
    } else {
        echo "<p id='error_login' class='absolute bottom-0 right-0 m-6 bg-lightRed text-light px-6 py-3'>
        Old Password is incorrect
        </p>
        <script>
        setTimeout(() => {
            document.getElementById('error_login').classList.add('hidden');
        }, 1000);
        </script>";
    }
}
?>