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
            <div>
                <?php include 'menu.php'; ?>
            </div>
            <div class="col-span-3">
                <?php
                $sql = "SELECT * FROM properties WHERE contact_person = '$id'";
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
                            $property_province = $row['province'];
                            $property_title = $row['title'];
                            $contact = $row['contact_person'];
                            echo "
                                <div class='property-block bg-white mb-3 rounded shadow-lg'>
                                <div class='flex items-center justify-between'>
                                    <div class='flex items-center space-x-3'>
                                        <img src='$property_image' class='h-16 w-20 object-cover rounded-l' alt=''>
                                        <p>$property_title</p>
                                    </div>
                                    <div class='title'></div>
                                    <div class='actions px-3 space-x-4 flex '>
                                        <a href='edit-property.php/?id=$property_id'>
                                        <button class='btn btn-primary'>
                                            <i class='fa-solid fa-edit'></i>
                                            Edit
                                        </button>
                                        </a>
                                        <form action='' method='POST'>
                                            <input type='hidden' name='property_id' value='$property_id'>
                                            <button type='submit' name='delete-property' class='btn btn-danger'>
                                                <i class='fa-solid fa-trash text-lightRed'></i>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                                            ";
                        }
                    } else {
                        echo "
                            <div class='rounded bg-white p-3'>
                            <p class='text-2xl text-left'>No properties to show</p>
                            </div>
                            ";
                    }
                }
                ?>
            </div>
        </div>
</body>

</html>

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

?>