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
                <?php
                $sql = "SELECT * FROM users WHERE id = '$id'";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $row = mysqli_fetch_assoc($result);
                    $id = $row['id'];
                    $fullname = $row['fullname'];
                    $email = $row['email'];
                    $password = $row['password'];
                    $phone_number = $row['phone_number'];
                }
                ?>
                <form action="" method="POST" id='myForm' class="w-1/2 space-y-3 text-lg">
                    <div class="form-control flex flex-col">
                        <label for="fullName">Fullname</label>
                        <span id="nameError" class="text-lightRed"></span>
                        <input type="text" id="editFullname" name="edit_fullname"
                            class="bg-white p-4 rounded bg-ivory outline-0" value="<?php echo $fullname ?>" required>
                    </div>
                    <div class="form-control flex flex-col">
                        <label for="email">Email Address</label>
                        <span id="emailError" class="text-lightRed"></span>
                        <input type="email" id="editEmail" name="edit_email"
                            class="bg-white p-4 rounded bg-ivory outline-0" value="<?php echo $email ?>" required>
                    </div>
                    <div class="form-control flex flex-col">
                        <label for="phoneNumber">Phone Number</label>
                        <span id="phoneError" class="text-lightRed"></span>
                        <input type="text" id="editPhone" name="edit_phone"
                            class="bg-white p-4 rounded bg-ivory outline-0" value="<?php echo $phone_number ?>"
                            required>
                    </div>
                    <button type="submit" name="update"
                        class=" rounded text-light bg-lessDark py-4 w-full">Update</button>
                </form>
                <!-- Update profile php starts -->
                <?php
                if (isset($_POST['update'])) {
                    $edit_fullname = $_POST['edit_fullname'];
                    $edit_email = $_POST['edit_email'];
                    $edit_phone = $_POST['edit_phone'];

                    // Check if email exists
                    $existingEmailQuery = "SELECT * FROM users WHERE email = '$edit_email'";
                    $existingEmailResult = mysqli_query($conn, $existingEmailQuery);
                    $existingEmailRow = mysqli_fetch_assoc($existingEmailResult);
                    $existingEmail = $existingEmailRow['email'];

                    if (mysqli_num_rows($existingEmailResult) > 0 && $existingEmail != $email) {
                        echo "<p id='error_login' class='absolute bottom-0 right-0 m-6 bg-lightRed text-light px-6 py-3'>
                    Email address is already taken
                    </p>
                    <script>
                    setTimeout(() => {
                        document.getElementById('error_login').classList.add('hidden');
                    }, 3000);
                    </script>";
                    } else {
                        $sql = "UPDATE users SET fullname = '$edit_fullname', email = '$edit_email', phone_number = '$edit_phone' WHERE id = '$id'";
                        $result = mysqli_query($conn, $sql);

                        if ($result) {
                            echo "<script>alert('Profile Updated Successfully. Please login again')</script>";
                            session_destroy();
                            echo "<script>window.location.href='login.php'</script>";
                        } else {
                            echo "<p id='error_login' class='absolute bottom-0 right-0 m-6 bg-lightRed text-light px-6 py-3'>
                        Something went wrong
                        </p>
                        <script>
                        setTimeout(() => {
                            document.getElementById('error_login').classList.add('hidden');
                            window.location.href='profile.php'
                        }, 1000);
                        </script>";
                        }
                    }
                }
                ?>



            </div>
        </div>
</body>

</html>

<script>
// // Get all message container elements
// const messageContainers = document.querySelectorAll('[id^="message-container-"]');

// // Add click event listener to each message container
// messageContainers.forEach(container => {
//     const messageContent = container.querySelector('#message-content');

//     container.addEventListener('click', () => {
//         messageContent.classList.remove('hidden');
//     });
// });


// Edit profile validation

document.getElementById('myForm').addEventListener('submit', (e) => {
    const nameError = document.getElementById('nameError');
    const emailError = document.getElementById('emailError');
    const phoneError = document.getElementById('phoneError');

    const editFullname = document.getElementById('editFullname').value;
    const editEmail = document.getElementById('editEmail').value;
    const editPhone = document.getElementById('editPhone').value;

    // fullname validation
    if (editFullname == '') {
        event.preventDefault();
        nameError.textContent = 'Name cannot be empty.';
    } else if (editFullname.length < 3) {
        event.preventDefault();
        nameError.textContent = "Fullname must be more than 5 characters.";
    } else if (/[^a-zA-Z0-9 ]/.test(editFullname)) {
        event.preventDefault();
        nameError.textContent = "Fullname should not contain special characters.";
    } else if (/\d/.test(editFullname)) {
        event.preventDefault();
        nameError.textContent = "Fullname should not contain numbers.";
    } else {
        nameError.textContent = "";
    }

    // phone number validation
    if (editPhone == '') {
        event.preventDefault();
        phoneError.textContent = 'Phone number cannot be empty.';
    } else if (!/^9/.test(editPhone)) {
        event.preventDefault();
        phoneError.textContent = "Phone number must start with 9";
    } else if (!(editPhone.length == 10)) {
        event.preventDefault();
        phoneError.textContent = 'Phone number must exactly 10 digits.';
    } else if (!/\d/.test(editPhone)) {
        event.preventDefault();
        phoneError.textContent = "Phone number must contain numbers only.";
    } else {
        phoneError.textContent = '';
    }
});
</script>