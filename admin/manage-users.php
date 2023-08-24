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
                <!-- manage users -->
                <div class="userData">
                    <?php
                    $usersQuery = "SELECT * FROM users";
                    $usersResult = mysqli_query($conn, $usersQuery);
                    if (mysqli_num_rows($usersResult) > 0) {
                    ?>
                        <table class="table-auto w-full">
                            <thead>
                                <tr>
                                    <th class="border px-4 py-2">ID</th>
                                    <th class="border px-4 py-2">Name</th>
                                    <th class="border px-4 py-2">Email</th>
                                    <th class="border px-4 py-2">Phone</th>
                                    <th class="border px-4 py-2">Total Listings</th>
                                    <th class="border px-4 py-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($user = mysqli_fetch_assoc($usersResult)) {
                                ?>
                                    <tr>
                                        <td class="border px-4 py-2"><?php echo $user['id']; ?></td>
                                        <td class="border px-4 py-2"><?php echo $user['fullname']; ?></td>
                                        <td class="border px-4 py-2"><?php echo $user['email']; ?></td>
                                        <td class="border px-4 py-2"><?php
                                                                        if ($user['phone_number'] == '') {
                                                                            echo 'Not Provided';
                                                                        } else {
                                                                            echo $user['phone_number'];
                                                                        }
                                                                        ?>
                                        </td>
                                        <td class="border px-4 py-2 text-center">
                                            <?php
                                            $query = "SELECT * FROM properties WHERE contact_person='$user[id]'";
                                            $result = mysqli_query($conn, $query);
                                            echo mysqli_num_rows($result);
                                            ?>
                                        </td>
                                        <td class="border px-4 py-2 text-center">
                                            <form action="" method="post">
                                                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                                <button style="background-color: red;" type="submit" name="deleteUser" class="text-light p-2 rounded"> Delete
                                                    User</button>
                                            </form>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<h1 class='text-center text-2xl'>No Users Found</h1>";
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

if (isset($_POST['deleteUser'])) {
    $user_id = $_POST['user_id'];
    $deleteQuery = "DELETE FROM users WHERE id=$user_id";
    $deleteResult = mysqli_query($conn, $deleteQuery);
    if ($deleteResult) {
        echo "
                <p id='error_login' class='absolute bottom-0 right-0 m-6 bg-lightRed text-light px-6 py-3'>
               User Deleted Successfully.
                </p>
                <script>
                setTimeout(() => {
                    document.getElementById('error_login').classList.add('hidden');
                    location.href = 'manage-users.php';
                }, 3000);
                </script>
            ";
    } else {
        echo "<script>alert('Something went wrong.')</script>";
    }
}
?>