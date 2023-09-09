<?php include 'common/connection.php'; ?>
<html>

<head>
    <?php include 'common/head.php'; ?>
</head>

<body class="bg-slate-100">
    <?php
    error_reporting(0);
    session_start();
    if (isset($_SESSION['username'])) {
    ?>
        <?php include 'common/admin-navbar.php'; ?>
    <?php
    } else {
        header('location:login.php');
    }
    if (isset($_POST['logout'])) {
        session_destroy();
        header('location:login.php');
    }
    ?>
    <div class="py-10 container mx-auto">
        <div class="grid grid-cols-4 gap-4">
            <!-- properties/users togglers -->
            <?php include 'menu.php'; ?>
            <div class="col-span-3 mt-8">
                <div class="messageData">
                    <?php
                    $messageQuery = "SELECT * FROM messages";
                    $messageResult = mysqli_query($conn, $messageQuery);
                    if (mysqli_num_rows($messageResult) > 0) {
                    ?>
                        <table class="table-auto w-full">
                            <thead>
                                <tr>
                                    <th class="border px-4 py-2">ID</th>
                                    <th class="border px-4 py-2">Sender Name</th>
                                    <th class="border px-4 py-2">Receiver Name</th>
                                    <th class="border px-4 py-2">Message</th>
                                    <th class="border px-4 py-2">Related Property</th>
                                    <th class="border px-4 py-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($message = mysqli_fetch_assoc($messageResult)) {
                                ?>
                                    <tr>
                                        <td class="border px-4 py-2"><?php echo $message['message_id']; ?></td>
                                        <td class="border px-4 py-2"><?php echo $message['sender_name']; ?></td>
                                        <td class="border px-4 py-2">
                                            <?php
                                            $query = "SELECT * FROM users WHERE id='$message[receiver_id]'";
                                            $result = mysqli_query($conn, $query);
                                            $user = mysqli_fetch_assoc($result);
                                            echo $user['fullname'];
                                            ?>
                                        </td>
                                        <td class="border px-4 py-2"><?php echo $message['message']; ?></td>
                                        <td class="border px-4 py-2">
                                            <?php
                                            $query = "SELECT * FROM properties WHERE property_id='$message[property_id]'";
                                            $result = mysqli_query($conn, $query);
                                            $property = mysqli_fetch_assoc($result);
                                            echo $property['title'];
                                            ?>
                                        </td>
                                        <td class="border px-4 py-2 text-center">
                                            <form action="" method="post">
                                                <input type="hidden" name="message_id" value="<?php echo $message['message_id']; ?>">
                                                <button style="background-color: red;" type="submit" name="deleteMessage" class="text-light text-white p-2 rounded"> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<h1 class='text-center text-2xl'>No Messages Found</h1>";
                            }
                            ?>
                            </tbody>
                        </table>
                </div>

            </div>
        </div>
    </div>
</body>

</html>
<!-- php actions -->
<?php

if (isset($_POST['deleteMessage'])) {
    $message_id = $_POST['message_id'];
    $deleteQuery = "DELETE FROM messages WHERE message_id='$message_id'";
    $deleteResult = mysqli_query($conn, $deleteQuery);
    if ($deleteResult) {
        echo "
        <p id='error_login' class='absolute bottom-0 right-0 m-6 bg-lightRed text-light px-6 py-3'>
       Message Deleted Successfully.
        </p>
        <script>
        setTimeout(() => {
            document.getElementById('error_login').classList.add('hidden');
            location.href = 'manage-messages.php';
        }, 3000);
        </script>
    ";
    } else {
        echo "<script>alert('Something went wrong.')</script>";
    }
}
?>