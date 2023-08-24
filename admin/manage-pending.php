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
                <div class="pendingData">
                    <?php
                    $propertyQuery = "SELECT * FROM properties where status='off'";
                    $propertyResult = mysqli_query($conn, $propertyQuery);
                    if (mysqli_num_rows($propertyResult) > 0) {
                    ?>
                        <table class="table-auto w-full">
                            <thead>
                                <tr>
                                    <th class="border px-2 py-2">Title</th>
                                    <th class="border px-2 py-2">Price</th>
                                    <th class="border px-2 py-2">Image</th>
                                    <th class="border px-2 py-2">Listed By</th>
                                    <th class="border px-2 py-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($property = mysqli_fetch_assoc($propertyResult)) {
                                ?>
                                    <tr>
                                        <td class="border px-2 py-2 text-center"><?php echo $property['title']; ?></td>
                                        <td class="border px-2 py-2 text-center"><?php echo $property['price']; ?></td>
                                        <td class="border px-2 py-2"><img src="/realestate-change/<?php echo $property['img_url']; ?>" alt="" class="w-20 rounded"></td>
                                        <td class="border px-2 py-2 text-center">
                                            <?php
                                            $query = "SELECT * FROM users WHERE id='$property[contact_person]'";
                                            $result = mysqli_query($conn, $query);
                                            $user = mysqli_fetch_assoc($result);
                                            echo $user['fullname'];
                                            ?>
                                        </td>
                                        <td class="border px-2 py-2 text-center">
                                            <form action="" method="post" class="flex space-x-2">
                                                <input type="hidden" name="property_id" value="<?php echo $property['property_id']; ?>">
                                                <a href="/realestate-change/admin/admin-view.php?id=<?php echo $property['property_id'] ?>"><button type="button" style="background-color: teal;" class="text-lessDark p-2 rounded">View</button></a>
                                                <button type="submit" name="approveProperty" class="text-lessDark p-2 rounded" style="background-color: greenyellow;">Approve</button>
                                                <button style="background-color: red;" type="submit" name="deleteRequestProperty" class="text-light p-2 rounded"> Reject</button>
                                            </form>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<h1 class='text-center text-2xl'>No Pending Listings</h1>";
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
if (isset($_POST['approveProperty'])) {
    $property_id = $_POST['property_id'];
    $updateQuery = "UPDATE properties SET status='on' WHERE property_id='$property_id'";
    $updateResult = mysqli_query($conn, $updateQuery);
    if ($updateResult) {
        echo "
                <p id='error_login' class='absolute bottom-0 right-0 m-6 bg-lightGreen text-lessDark px-6 py-3'>
               Property Approved
                </p>
                <script>
                setTimeout(() => {
                    document.getElementById('error_login').classList.add('hidden');
                    location.href = 'manage-pending.php';
                }, 3000);
                </script>
            ";
    } else {
        echo "<script>alert('Something went wrong.')</script>";
    }
}
if (isset($_POST['deleteRequestProperty'])) {
    $property_id = $_POST['property_id'];
    $disapproveQuery = "UPDATE properties SET status='reject' WHERE property_id='$property_id'";
    $disapproveResult = mysqli_query($conn, $disapproveQuery);
    if ($disapproveResult) {
        echo "
                <p id='error_login' class='absolute bottom-0 right-0 m-6 bg-lightRed text-light px-6 py-3'>
               Property Rejected
                </p>
                <script>
                setTimeout(() => {
                    document.getElementById('error_login').classList.add('hidden');
                    location.href = 'manage-pending.php';
                }, 3000);
                </script>
            ";
    } else {
        echo "<script>alert('Something went wrong.')</script>";
    }
}

?>