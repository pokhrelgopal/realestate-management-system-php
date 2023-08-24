<?php include 'common/connection.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'common/head.php'; ?>
</head>
<?php
$filteredResults = array();
if (isset($_POST['search'])) {
    $keyword = trim($_POST['keyword']);
    $province = $_POST['province'];
    $city = $_POST['city'];
    $building_type = $_POST['building_type'];
    $buy_type = $_POST['buy_type'];
    $min_price = $_POST['min_price'];
    $max_price = $_POST['max_price'];
    $sql = "SELECT * FROM properties";
    if ($keyword != '') {
        $sql .= " WHERE title LIKE '%$keyword%'";
    } else {
        $sql .= " WHERE title LIKE '%%'";
    }
    if ($province != 'any') {
        $sql .= " AND province = '$province'";
    }
    if ($city != '') {
        $sql .= " AND location like '%$city%'";
    }
    if ($building_type != 'any') {
        $sql .= " AND property_type = '$building_type'";
    }
    if ($buy_type != 'any') {
        $sql .= " AND listing_type = '$buy_type'";
    }
    if ($min_price != '') {
        $sql .= " AND price >= $min_price";
    }
    if ($max_price != '') {
        $sql .= " AND price <= $max_price";
    }
    $sql .= " AND status = 'on'";
    // echo $sql;
    $result = mysqli_query($conn, $sql);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $filteredResults[] = $row;
            }
        } else {
            echo "
            <p id='error_login' class='absolute bottom-0 right-0  m-6 bg-lightRed text-light px-6 py-3'>
        No results found for your entry.
        </p>
        <script>
        setTimeout(() => {
            document.getElementById('error_login').classList.add('hidden');
        }, 4000);
        </script>
            ";
        }
    }
}
?>

<body>
    <!-- navbar starts -->
    <?php include 'common/navbar.php'; ?>
    <!-- navbar ends -->
    <div class="container mx-auto py-16">
        <div class="grid grid-cols-4 gap-4">
            <!-- search form -->
            <div class="shadow-lg p-5 h-fit rounded bg-gray-200">
                <form action="listings.php" method="POST" class="space-y-4">
                    <div class="flex flex-col space-y-2">
                        <input type="text" name="keyword" placeholder="Enter Keyword" class="bg-ivory rounded py-3 px-4 outline-0">
                        <label for="province">Province</label>
                        <select name="province" class="bg-ivory rounded py-3 px-4 outline-0">
                            <option value="any">Any</option>
                            <option value="koshi">Koshi</option>
                            <option value="madhesh">Madhesh</option>
                            <option value="bagmati">Bagmati</option>
                            <option value="gandaki">Gandaki</option>
                            <option value="lumbini">Lumbini</option>
                            <option value="karnali">Karnali</option>
                            <option value="sudurpaschim">Sudurpaschim</option>
                        </select>
                    </div>
                    <div class="flex flex-col space-y-2">
                        <label for="city">City</label>
                        <input type="text" name="city" placeholder="Enter name of the City" class="bg-ivory rounded py-3 px-4 outline-0">
                    </div>
                    <div class="flex flex-col space-y-2">
                        <label for="building_type">Building Type</label>
                        <select name="building_type" class="bg-ivory rounded py-3 px-4 outline-0">
                            <option value="any">Any</option>
                            <option value="house">House</option>
                            <option value="apartment">Apartment</option>
                            <option value="bunglow">Bunglow</option>
                        </select>
                    </div>
                    <div class="flex flex-col space-y-2">
                        <label for="buy_type">Buy Type</label>
                        <select name="buy_type" class="bg-ivory rounded py-3 px-4 outline-0">
                            <option value="any">Any</option>
                            <option value="sale">Sale</option>
                            <option value="rent">Rent</option>
                        </select>
                    </div>
                    <div class="flex flex-col space-y-2">
                        <label for="min_price">Min Price</label>
                        <input type="number" name="min_price" placeholder="Enter Min Price" class="bg-ivory rounded py-3 px-4 outline-0">
                    </div>
                    <div class="flex flex-col space-y-2">
                        <label for="max_price">Max Price</label>
                        <input type="number" name="max_price" placeholder="Enter Max Price" class="bg-ivory rounded py-3 px-4 outline-0">
                    </div>

                    <button type="submit" name="search" class="bg-black text-light rounded w-full py-3" style="background-color: black;">Submit</button>
                    <button type="reset">
                        <i class="fas fa-redo"></i>
                        <span>Reset</span>
                    </button>
                </form>
            </div>
            <div class="col-span-3">
                <div class="grid grid-cols-1 gap-8 text-center md:grid-cols-3 lg:gap-y-16">
                    <?php if (isset($filteredResults) && !empty($filteredResults)) : ?>
                        <?php foreach ($filteredResults as $result) : ?>
                            <a href="property.php/?id=<?php echo $result['property_id'] ?>">
                                <div class="rounded-xl shadow-md">
                                    <div class="image h-60 w-full">
                                        <img src="<?php echo $result['img_url'] ?>" class="h-56 w-full object-cover rounded-t-xl" alt="">
                                    </div>
                                    <div class="flex flex-col p-3 space-y-3">
                                        <div class="flex items-center justify-between">
                                            <p class="text-left text-lg font-semibold"><?php echo $result['title'] ?></p>
                                        </div>
                                        <p class="text-left text-sm"><?php echo $result['location'] ?></p>
                                        <div class="flex items-center justify-between">
                                            <p class="capitalize"> Listed for <?php echo $result['listing_type'] ?> </p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    <?php else :
                        $sql = "SELECT * FROM properties where status = 'on'";
                        $result = mysqli_query($conn, $sql);
                        if ($result) {
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $property_id = $row['property_id'];
                                    $title = $row['title'];
                                    $location = $row['location'];
                                    $img_url = $row['img_url'];
                                    $listing_type = $row['listing_type'];
                                    echo "
                                    <a href='property.php/?id=$property_id'>
                                        <div class='rounded-xl shadow-md'>
                                            <div class='image h-60 w-full'>
                                                <img src='$img_url' class='h-56 w-full object-cover rounded-t-xl' alt=''>
                                            </div>
                                            <div class='flex flex-col p-3 space-y-3'>
                                                <div class='flex items-center justify-between'>
                                                    <p class='text-left text-lg font-semibold'>$title</p>
                                                </div>
                                                <p class='text-left text-sm'>$location</p>
                                                <div class='flex items-center justify-between'>
                                                    <p class='capitalize'> Listed for $listing_type </p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    ";
                                }
                            }
                        }
                    ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- footer starts  -->
    <?php include 'common/footer.php'; ?>

    <!-- footer ends -->
</body>

</html>