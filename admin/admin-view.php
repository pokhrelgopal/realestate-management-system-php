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
    ?>
    <div class="py-10 container mx-auto">
        <div class="grid grid-cols-4 gap-4">
            <!-- properties/users togglers -->
            <?php include 'menu.php'; ?>
            <div class="col-span-3">
                <?php
                $property_id = $_GET['id'];
                $propertyQuery = "SELECT * FROM properties where property_id='$property_id'";
                $propertyResult = mysqli_query($conn, $propertyQuery);
                $property = mysqli_fetch_assoc($propertyResult);
                $property_type = $property['property_type'];
                $title = $property['title'];
                $province = $property['province'];
                $location = $property['location'];
                $listing_type = $property['listing_type'];
                $iframe_src = $property['iframe_src'];
                $status = $property['status'];
                $about = $property['about'];
                $price = $property['price'];
                $img_url = $property['img_url'];
                $contact_person = $property['contact_person'];

                ?>
                <?php
                if ($status == 'off') {
                    echo "
                    <span class='bg-lightRed text-light w-full p-4 text-lg'>This Listing has not been approved yet.</span>                    ";
                }
                ?>
                <div class='py-6 flex justify-between'>
                    <div class='space-y-2'>
                        <h1 class='text-3xl font-semibold'>
                            <?php echo $title; ?>
                        </h1>
                        <h4 class='text-md capitalize'>
                            <?php echo $location; ?>, <?php echo $province; ?> Province
                        </h4>
                        <h4 class='text-md text-red-600 font-semibold capitalize'>• For
                            Listed <?php echo $listing_type; ?> </h4>
                    </div>
                </div>
                <div>
                    <img src="/realestate-change/<?php echo $property['img_url']; ?>"
                        class='rounded w-full h-[70vh] object-cover' alt='Property Image'>
                </div>
                <div class='col-span-2 space-y-8'>
                    <div class='rounded-xl bg-white p-4 shadow'>
                        <h1 class='text-2xl font-semibold'>Overview</h1>


                        <p class='text-justify text-xl py-4'>
                            <?php echo $about; ?>
                        </p>

                        <div class="py-4 flex space-x-12">
                            <div class="card flex items-center space-x-3">
                                <i class="fa-solid fa-money-bill text-2xl"></i>
                                <div>
                                    <p class="text-lg">Rs. <?php echo $price; ?>

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
                        <?php echo $iframe_src; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>