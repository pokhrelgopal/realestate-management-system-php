<!doctype html>
<html>

<head>
    <?php include 'common/head.php'; ?>
</head>


<body class="container mx-auto bg-slate-100">
    <!-- Nav starts -->
    <?php include 'common/navbar.php'; ?>
    <!-- nav ends -->

    <main class="container mx-auto py-8">
        <div class="grid grid-cols-4 gap-4">
            <div class="">
                <?php include 'menu.php'; ?>
            </div>
            <div class="col-span-3">
                <?php
                $sql = "SELECT * FROM messages WHERE receiver_id = '$id'";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $message_id = $row['message_id'];
                            $sender_name = $row['sender_name'];
                            $property_id = $row['property_id'];
                            $date_posted = $row['date_posted'];
                            $sender_email = $row['sender_email'];
                            $sender_phone = $row['sender_phone'];
                            $sender_message = $row['message'];
                            $sql2 = "SELECT * FROM properties WHERE property_id = '$property_id'";
                            $result2 = mysqli_query($conn, $sql2);
                            if ($result2) {
                                if (mysqli_num_rows($result2) > 0) {
                                    while ($row2 = mysqli_fetch_assoc($result2)) {
                                        $property_title = $row2['title'];
                                        $property_image = $row2['img_url'];
                                    }
                                }
                            }

                            echo
                            "
                                <div id='message-container-$id' class='bg-ivory rounded text-lessDark mb-3'>
                                    <div class='p-3 rounded flex items-center justify-between'>
                                        <div class='flex items-center space-x-3'>
                                            <img src='/realestate/assets/default.png' class='h-8' alt=''>
                                            <p class='ml-3'><span>$sender_name </span>has sent you an enquiry request.</p> 
                                        </div>
                                        <div class='dropdown'>
                                            <i class='fa-solid fa-chevron-down'></i>
                                        </div>
                                    </div>
                                    <div id='message-content' class='hidden py-3 border-t border-lessDark px-14'>
                                        <div class='grid grid-cols-4 gap-4 items-center'>
                                            <div class='col-span-3 space-y-2 text-lg'>
                                                <p>Regarding : <span>$property_title</span></p>
                                                <p>Contact : <span>$sender_phone</span></p>
                                                <p>Email : <span>$sender_email</span></p>
                                                <p>Message : <span>$sender_message</span></p>
                                                <small class='text-gray-300 italic'>$date_posted</small>
                                            </div>
                                            <div>
                                                <img src='/realestate-change/$property_image' class='h-56 w-full object-cover rounded-xl shadow' alt=''>
                                            </div>
                                        </div>
                                        <form method='post' action=''>
                                        <button style='background-color:red;' type='submit' name='deleteAppointment' class='btn bg-lightRed text-light p-2 rounded'>Remove</button>
                                        <input type='hidden' name='message_id' value='$message_id'>
                                        </form>
                                    </div>
                                </div>
                            ";
                        }
                    } else {
                        echo "
                            <div class='rounded bg-white p-3'>
                            <p class='text-2xl text-left'>No Enquiries to show</p>
                            </div>
                            ";
                    }
                }
                ?>
            </div>
        </div>
        <script>
        const messageContainers = document.querySelectorAll('[id^="message-container-"]');
        messageContainers.forEach(container => {
            const messageContent = container.querySelector('#message-content');
            container.addEventListener('click', () => {
                messageContent.classList.remove('hidden');
            });
        });
        </script>
</body>

</html>

<?php
if (isset($_POST['deleteAppointment'])) {
    $message_id = $_POST['message_id'];
    $sql = "DELETE FROM messages WHERE message_id = '$message_id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<p id='error_login' class='absolute bottom-0 right-0 m-6 bg-lightGreen text-dark px-6 py-3'>
        Appointment Deleted Successfully    
        </p>
        <script>
        setTimeout(() => {
            document.getElementById('error_login').classList.add('hidden');
            window.location.href='profile.php'
        }, 1000);
        </script>
        ";
    } else {
        echo "<p id='error_login' class='absolute bottom-0 right-0 m-6 bg-lightRed text-light px-6 py-3'>
        Appointment Deletion Failed
        </p>
        <script>
        setTimeout(() => {
            document.getElementById('error_login').classList.add('hidden');
            window.location.href='profile.php'
        }, 1000);
        </script>
        ";
    }
}
?>