<!doctype html>
<html>

<head>
    <?php include 'common/connection.php'; ?>
    <?php include 'common/head.php'; ?>
    <style>
        iframe {
            width: 100%;
            height: 500px;
        }

        .text-lightRed {
            color: #ff0000;
        }
    </style>
</head>

<body class="bg-slate-100">

    <!-- navbar starts -->
    <?php include 'common/navbar.php'; ?>
    <!-- navbar ends -->
    <div class="container mx-auto">
        <?php
        // check if user is logged in else redirect to login page, there is email in session
        if (!isset($_SESSION['email'])) {
            header("Location: /realestate-change/login.php");
        }


        $idProperty = $_GET['id'];
        $sql = "SELECT * FROM properties where property_id = '$idProperty'";

        $result = mysqli_query($conn, $sql);
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $property_id = $row['property_id'];
                    $property_type = $row['property_type'];
                    $property_avilability = $row['listing_type'];
                    $property_about = $row['about'];
                    $property_image = $row['img_url'];
                    $property_price = $row['price'];
                    $property_city = $row['location'];
                    // $property_date = $row['date_listed'];
                    $property_province = $row['province'];
                    $property_title = $row['title'];
                    $contact = $row['contact_person'];
                    $property_iframe = $row['iframe_src'];
                    $property_status = $row['status'];

                    $sql = "SELECT * FROM users where id = $contact";
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $contact_name = $row['fullname'];
                                $contact_email = $row['email'];
                                $contact_phone = $row['phone_number'];
                                if ($contact_phone == null) {
                                    $contact_phone = "Not Provided";
                                } else {
                                    $contact_phone = $row['phone_number'];
                                }
                            }
                        }
                    }
                }
            } else {
                echo "error";
            }
        }
        ?>
        <div class='pt-10 pb-20'>
            <div>
                <?php
                if ($property_status == 'off') {
                    echo "
                    <span class='bg-lightRed text-light w-full p-4 text-lg'>This Listing has not been approved yet.</span>                    ";
                }
                ?>
                <div class='py-6 flex justify-between'>
                    <div class='space-y-2'>
                        <h1 class='text-3xl font-semibold'>
                            <?php echo $property_title; ?>
                        </h1>
                        <h4 class='text-md capitalize'>
                            <?php echo $property_city; ?>, <?php echo $property_province; ?>
                        </h4>
                        <h4 class='text-md text-red-600 font-semibold capitalize'>• For
                            <?php echo $property_avilability; ?> </h4>
                    </div>
                </div>

                <div class="flex justify-center">
                    <img src='/realestate-change/<?php echo $property_image; ?>' class='rounded w-auto object-contain' alt='Property Image' style="height: 90vh;">
                </div>

                <div class='grid grid-cols-3 gap-4 pt-8'>
                    <div class='col-span-2 space-y-8'>
                        <div class='rounded-xl bg-white p-4 shadow'>
                            <h1 class='text-2xl font-semibold'>Overview</h1>


                            <p class='text-justify py-4'>
                                <?php echo $property_about; ?>
                            </p>

                            <div class="py-4 flex space-x-12">
                                <div class="card flex items-center space-x-3">
                                    <i class="fa-solid fa-money-bill text-2xl"></i>
                                    <div>
                                        <p class="text-lg">Rs. <?php echo $property_price; ?>

                                            <?php
                                            if ($property_avilability == "rent") {
                                                echo "Per Month";
                                            } else {
                                                echo "";
                                            }
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class='rounded-xl bg-white p-4 shadow'>
                            <h1 class='text-2xl font-semibold'>Location</h1>
                            <?php echo $property_iframe; ?>
                        </div>
                    </div>

                    <?php
                    if (!($contact == $id)) {
                        echo "
                            <div class='rounded-xl bg-white h-fit p-4 shadow text-lg'>
                                <p class='text-xl capitalize pb-4'>Contact property owner</p>
                                <div class='flex items-center space-x-4'>
                                    <div>
                                        <img src='/realestate-change/assets/default.png' class='w-16 h-16 rounded-full' alt=''>
                                    </div>
                                    <div>
                                    
                                        <p class='font-semibold'>
                                        <i class='fa-solid fa-user'></i>
                                            $contact_name
                                        </p>
                                        <p>
                                        <i class='fa-solid fa-phone'></i>
                                        $contact_phone
                                        </p>
                                        <p>
                                        <i class='fa-solid fa-envelope'></i>
                                        $contact_email
                                        </p>
                                    </div>
                                    </div>

                                                <form id='appForm' action='' method='POST' class='pt-5 space-y-5'>
                                            <div>
                                                <label for='name'>Name</label>
                                                <input type='text' name='message_name' id='name' value='$name' class='w-full bg-cleanLight text-lightGray outline-0 rounded p-3' required disabled>
                                            </div>
                                            <div>
                                                <label for='name'>Email</label>
                                                <input type='email' name='message_email' id='name' value='$email' class='w-full bg-cleanLight text-lightGray outline-0 rounded p-3' required disabled>
                                            </div>
                                            <div>
                                                <label for='name'>Phone</label>
                                                <input type='text' name='message_phone' disabled value='$phone' id='editPhone' class='w-full bg-cleanLight text-lightGray outline-0 rounded p-3'>
                                                </div>
                                                <div>
                                                <label for='name'>Enquiry Message</label><br>
                                                <span id='messageError' class='text-lightRed'></span>
                                                <textarea name='message_text' id='message' cols='30' rows='10' class='w-full bg-ivory outline-0 rounded p-3' required></textarea>
                                            </div>
                                            <div>
                                                <button
                                                id='submit_message' 
                                                style='background-color: black;' type='submit' name='submit_message' class='bg-lessDark text-light py-3 rounded w-full'>
                                                Submit Enquiry
                                                <i class='ml-3 fa-solid fa-paper-plane'></i>
                                                </button>
                                            </div>
                                        </form>
                                        ";
                    }
                    ?>
                    <script>
                        const appForm = document.getElementById('appForm');
                        const messageError = document.getElementById('messageError');
                        const message = document.getElementById('message')

                        appForm.addEventListener('submit', (e) => {
                            if (message.value == '') {
                                e.preventDefault();
                                messageError.textContent = 'Message cannot be empty.';
                            } else if (!/[a-zA-Z]/.test(message.value)) {
                                e.preventDefault();
                                messageError.textContent = 'Message can not be only numbers.';
                            } else if (message.value.length < 10) {
                                e.preventDefault();
                                messageError.textContent = 'Message must be more than 10 characters.';
                            } else {
                                messageError.textContent = '';
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
    </div>

</body>

</html>

<?php
if (isset($_POST['submit_message'])) {

    if (!isset($_SESSION['email'])) {
        echo "<p id='error_login' class='absolute top-0 left-0 m-6 bg-red-500 text-white px-6 py-3'>
        Please Login to send a message.
        </p>
        <script>
        setTimeout(() => {
            document.getElementById('error_login').classList.add('hidden');

        }, 3000);
        </script>
        ";
        exit();
    }
    $message_name = $name;
    $message_email = $email;
    $message_phone = $phone;
    $message_text = $_POST['message_text'];

    $check = "SELECT * FROM messages WHERE sender_id = '$id' AND property_id = '$property_id'";
    $check_result = mysqli_query($conn, $check);
    if (mysqli_num_rows($check_result) > 0) {
        echo "<p id='error_login' class='absolute bottom-0 right-0 m-6 bg-lightRed text-light px-6 py-3'>
        You have already sent enquiry to this owner.
        </p>
        <script>
        setTimeout(() => {
            document.getElementById('error_login').classList.add('hidden');
        }, 3000);
        </script>
        ";
        exit();
    } else {
        $sql = "INSERT INTO messages (receiver_id,sender_id,sender_name, sender_email, sender_phone, `message`, property_id) VALUES ('$contact','$id','$message_name', '$message_email', '$message_phone', '$message_text', '$property_id')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "
            <p id='error_login' class='absolute bottom-0 right-0 m-6 bg-lightGreen px-6 py-3'>
        Your enquiry has been sent.
        </p>
        <script>
        setTimeout(() => {
            document.getElementById('error_login').classList.add('hidden');
        }, 3000);
        </script>
            ";
        } else {
            echo "<p id='error_login' class='absolute top-0 left-0 m-6 bg-red-500 text-white px-6 py-3'>
        Enquiry could not be sent.
        </p>
        <script>
        setTimeout(() => {
            document.getElementById('error_login').classList.add('hidden');
        }, 3000);
        </script>
        ";
        }
    }
}



?>