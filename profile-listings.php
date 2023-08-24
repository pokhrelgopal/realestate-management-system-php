<style>
    .bg-lightYellow {
        background-color: #FDE68A;
    }
</style>
<!-- My Listings starts-->
<section class="p-3 bg-white rounded-sm">
    <div class="">
        <div class="flex items-center justify-between space-y-1 pb-10">
            <div>
                <p class="text-2xl font-semibold">My Listings</p>
            </div>
            <div>
                <a href="add-property.php" class="flex items-center space-x-2 bg-lessDark text-light p-3">
                    <i class="fa-solid fa-plus-circle text-lg text-white"></i>
                    <span>Add Property</span>
                </a>
            </div>
        </div>
        <div class="grid grid-cols-1 gap-8 text-center md:grid-cols-3 lg:gap-y-16">
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
                        $status = $row['status'];
                        if ($status == "off") {
                            $class = "bg-lightYellow text-black p-3 rounded";
                            $text = "Pending";
                        } else if ($status == "reject") {
                            $class = "bg-lightRed text-light p-3 rounded";
                            $text = "Rejected";
                        } else {
                            $class = "bg-lightGreen p-3 rounded";
                            $text = "Approved";
                        }
                        echo "
                                            <a href='property.php/?id=$property_id'>
                                                <div class='relative rounded-xl shadow-xl'>
                                                    <button class='absolute m-6 w-fit'>
                                                        <span class='$class'>
                                                            $text
                                                        </span>
                                                    </button>
                                                    <div class='image'>
                                                        <img src='$property_image' class='h-56 w-full object-cover rounded-t-xl' alt=''>
                                                    </div>
                                                    <div class='flex flex-col p-3 space-y-3'>
                                                        <div class='flex items-center justify-between'>
                                                        <p class='text-left text-lg font-semibold'>$property_title</p>
                                                        
                                                        </div>
                                                        <p class='text-left text-sm'>$property_city</p>

                                                    <div class='flex items-center justify-between'>
                                                        <p class='capitalize'> Listed for $property_avilability </p>
                                                    </div>
                                                    </div>
                                                </div>
                                            </a>
                                            ";
                    }
                } else {
                    echo "
                                        <p class='text-2xl text-left'>No properties to show</p>
                                        ";
                }
            }
            ?>
        </div>
    </div>
</section>
<!-- My Listings ends-->