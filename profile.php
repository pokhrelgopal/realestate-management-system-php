<!doctype html>
<html>

<head>
    <?php include 'common/head.php'; ?>
</head>

<body class="container mx-auto bg-slate-100">
    <!-- navbar starts -->
    <?php include 'common/navbar.php'; ?>
    <!-- navbar ends -->

    <?php
    ?>
    <main class="container mx-auto py-8">
        <div class="grid grid-cols-4 gap-4">
            <div class="">
                <?php include 'menu.php'; ?>
            </div>
            <div class="col-span-3">
                <?php include 'profile-listings.php'; ?>
            </div>
        </div>
    </main>
    <script>
    // Get all message container elements
    const messageContainers = document.querySelectorAll('[id^="message-container-"]');

    // Add click event listener to each message container
    messageContainers.forEach(container => {
        const messageContent = container.querySelector('#message-content');

        container.addEventListener('click', () => {
            messageContent.classList.remove('hidden');
        });
    });


    // Edit profile validation

    document.getElementById('myForm').addEventListener('submit', (e) => {
        const nameError = document.getElementById('nameError');
        const emailError = document.getElementById('emailError');
        const passwordError = document.getElementById('passwordError');
        const phoneError = document.getElementById('phoneError');
        const editFullname = document.getElementById('editFullname').value;
        const editEmail = document.getElementById('editEmail').value;
        const editPassword = document.getElementById('editPassword').value;
        const editPhone = document.getElementById('editPhone').value;

        // fullname validation
        if (editFullname == '') {
            event.preventDefault();
            nameError.textContent = 'Name cannot be empty.';
        } else if (editFullname.length < 3) {
            event.preventDefault();
            nameError.textContent = "Fullname must be more than 5 characters.";
        } else if (/\d/.test(editFullname)) {
            event.preventDefault();
            nameError.textContent = "Fullname should not contain numbers.";
        } else {
            nameError.textContent = "";
        }

        // password validation 
        if (editPassword == '') {
            event.preventDefault();
            passwordError.textContent = 'Password cannot be empty.';
        } else if (editPassword.length < 8) {
            event.preventDefault();
            passwordError.textContent = 'Password must be more than 8 characters.';
        } else if (!/\d/.test(editPassword) || !/[a-zA-Z]/.test(editPassword)) {
            event.preventDefault();
            passwordError.textContent = "Password must contain a combination of letters and numbers";
        } else {
            passwordError.textContent = '';
        }

        // phone number validation
        if (editPhone == '') {
            event.preventDefault();
            phoneError.textContent = 'Phone number cannot be empty.';
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
</body>

</html>

<!-- php delete handler -->
<?php
if (isset($_POST['delete-property'])) {
    $property_id = $_POST['property_id'];
    $sql = "DELETE FROM properties WHERE property_id = '$property_id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<script>alert('Property Deleted Successfully')</script>";
        echo "<script>window.location.href='profile.php'</script>";
    } else {
        echo "<script>alert('Property Deletion Failed')</script>";
        echo "<script>window.location.href='profile.php'</script>";
    }
}

if (isset($_POST['deleteAppointment'])) {
    $message_id = $_POST['message_id'];
    $sql = "DELETE FROM messages WHERE message_id = '$message_id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<script>alert('Appointment Deleted Successfully')</script>";
        echo "<script>window.location.href='profile.php'</script>";
    } else {
        echo "<script>alert('Appointment Deletion Failed')</script>";
        echo "<script>window.location.href='profile.php'</script>";
    }
}
?>