<!doctype html>
<html>

<head>
    <?php include 'common/connection.php'; ?>
    <?php include 'common/head.php'; ?>
    <style>
    .text-lightRed {
        color: #ff0000;
    }

    .text-yellow {
        color: #ffcc00;
    }
    </style>
</head>

<body class="container mx-auto bg-slate-100 text-lg">
    <!-- Nav starts -->
    <?php include 'common/navbar.php'; ?>
    <!-- nav ends -->
    <?php
    $id = $_GET['id'];
    $sql = "SELECT * FROM properties where property_id = '$id'";
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
                $property_iframe = $row['iframe_src'];
            }
        } else {
            echo "error";
        }
    }
    ?>
    <div class="container mx-auto py-8">
        <div class="grid grid-cols-4 gap-4">
            <div>
                <?php include 'menu.php'; ?>
            </div>
            <div class="col-span-3">
                <div class="w-2/3">
                    <form action="" method="POST" class="flex flex-col space-y-3" enctype="multipart/form-data">
                        <div class="space-y-4">
                            <div class="form-control flex flex-col space-y-1">
                                <label for="propertyType">Type of Property</label>
                                <select name="property_type" id="property_type" class="bg-ivory outline-0 p-3 rounded"
                                    required>
                                    <option value="house" <?php if ($property_type == 'house') echo 'selected'; ?>>House
                                    </option>
                                    <option value="apartment"
                                        <?php if ($property_type == 'apartment') echo 'selected'; ?>>Apartment</option>
                                    <option value="room" <?php if ($property_type == 'room') echo 'selected'; ?>>Room
                                    </option>
                                </select>

                            </div>
                            <div class="form-control flex flex-col space-y-1">
                                <label for="province">Province Name</label>
                                <select name="province" id="province" class="bg-ivory outline-0 p-3 rounded" required>
                                    <option value="koshi" <?php if ($property_province == 'koshi') echo 'selected'; ?>>
                                        Koshi</option>
                                    <option value="madhesh"
                                        <?php if ($property_province == 'madhesh') echo 'selected'; ?>>Madhesh</option>
                                    <option value="bagmati"
                                        <?php if ($property_province == 'bagmati') echo 'selected'; ?>>Bagmati</option>
                                    <option value="gandaki"
                                        <?php if ($property_province == 'gandaki') echo 'selected'; ?>>Gandaki</option>
                                    <option value="lumbini"
                                        <?php if ($property_province == 'lumbini') echo 'selected'; ?>>Lumbini</option>
                                    <option value="karnali"
                                        <?php if ($property_province == 'karnali') echo 'selected'; ?>>Karnali</option>
                                    <option value="sudurpaschim"
                                        <?php if ($property_province == 'sudurpaschim') echo 'selected'; ?>>Sudurpaschim
                                    </option>
                                </select>

                            </div>
                            <div class="form-control flex flex-col space-y-1">
                                <label for="">City Name</label>
                                <span class="text-lightRed" id="cityError"></span>
                                <input type="text" name="city" id="city" value="<?php echo $property_city ?>"
                                    class="bg-ivory outline-0 p-3 rounded" required>
                            </div>
                            <div class="form-control flex flex-col space-y-1">
                                <label for="">Title of Listing</label>
                                <span class="text-lightRed" id="titleError"></span>
                                <input type="text" name="title" id="title" value="<?php echo $property_title ?>"
                                    class="bg-ivory outline-0 p-3 rounded" required>
                            </div>
                            <div class="form-control flex flex-col space-y-1">
                                <label for="">Listing Type</label>
                                <select name="listing_type" id="listing_type" class="bg-ivory outline-0 p-3 rounded"
                                    required>
                                    <option value="sale">Sale</option>
                                    <option value="rent">Rent</option>
                                </select>
                            </div>
                            <div class="form-control flex flex-col space-y-1">
                                <label for="">Description of Listed Property</label>
                                <span class="text-lightRed" id="aboutError"></span>
                                <textarea name="about" id="about" cols="30" rows="10"
                                    class="bg-ivory outline-0 p-3 rounded"><?php echo $property_about ?></textarea>

                            </div>
                            <div class="form-control flex flex-col space-y-1">
                                <label for="">Image of Listed Property &nbsp;
                                    <span class="text-yellow">(Only JPG, JPEG, PNG and GIF are
                                        allowed)*</span>

                                </label>
                                <input type="file" name="imageData" id="image" class="bg-ivory outline-0 p-3 rounded">
                            </div>
                            <div class="form-control flex flex-col space-y-1">
                                <label for="">Price of Listed Property</label>
                                <span class="text-lightRed" id="priceError"></span>
                                <input type="number" name="price" id="price" class="bg-ivory outline-0 p-3 rounded"
                                    value="<?php echo $property_price ?>">
                            </div>
                            <div class="form-control flex flex-col space-y-1">
                                <label for="">Iframe of location (optional)</label>
                                <textarea name="iframe" id="iframe" cols="30" rows="5"
                                    class="bg-ivory outline-0 p-3 rounded"><?php echo $property_iframe ?></textarea>
                            </div>
                            <button style="background-color: black;" type="submit" id="submit" name="update"
                                class="w-full text-light py-3 rounded">Update Property</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
        submit.addEventListener('click', (e) => {
            const city = document.getElementById('city').value;
            const title = document.getElementById('title').value;
            const iframe = document.getElementById('iframe').value;
            const about = document.getElementById('about').value;
            const price = document.getElementById('price').value;

            const cityError = document.getElementById('cityError');
            const titleError = document.getElementById('titleError');
            const iframeError = document.getElementById('iframeError');
            const aboutError = document.getElementById('aboutError');
            const priceError = document.getElementById('priceError');

            const submit = document.getElementById('submit');
            // city validation
            if (city === '') {
                e.preventDefault();
                cityError.innerHTML = 'City name is required';
            } else if (/\d/.test(city)) {
                e.preventDefault();
                cityError.innerHTML = 'City name must not contain numbers';
            } else {
                cityError.innerHTML = '';
            }

            // title validation
            if (title === '') {
                e.preventDefault();
                titleError.innerHTML = 'Title is required';
            } else if (!/[a-zA-Z]/.test(title)) {
                e.preventDefault();
                titleError.innerHTML = 'Title must have text and not only numbers';
            } else {
                titleError.innerHTML = '';
            }

            // iframe validation
            if (iframe !== '') {
                if (!/^<iframe[\s\S]*<\/iframe>$/.test(iframe)) {
                    e.preventDefault();
                    iframeError.innerHTML = 'Iframe must be valid or empty.';
                } else {
                    iframeError.innerHTML = '';
                }
            }
            //about validation
            if (about === '') {
                e.preventDefault();
                aboutError.innerHTML = 'About property is required *';
            } else if (about.length < 20) {
                e.preventDefault();
                aboutError.innerHTML = 'About property must be atleast 20 characters long';
            } else {
                aboutError.innerHTML = '';
            }


            // price validation
            if (price === '') {
                e.preventDefault();
                priceError.innerHTML = 'Price of property is required *';
            } else if (price < 100) {
                e.preventDefault();
                priceError.innerHTML = 'Price must be at least 100';
            } else {
                priceError.innerHTML = '';
            }
        })
        </script>

</body>

</html>
<?php

if (isset($_POST['update'])) {
    $property_type = $_POST['property_type'];
    $property_province = $_POST['province'];
    $property_city = $_POST['city'];
    $property_title = $_POST['title'];
    $property_about = $_POST['about'];
    $property_listing_type = $_POST['listing_type'];
    $property_price = $_POST['price'];
    $property_iframe = $_POST['iframe'];


    // Check if a new image is uploaded
    if ($_FILES['imageData']['size'] > 0) {
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");
        $maxFileSize = 4 * 1024 * 1024; // 4 MB

        $filename = $_FILES["imageData"]["name"];
        $tempname = $_FILES["imageData"]["tmp_name"];
        $folder = "images/" . $filename;

        // Check file extension
        $fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedExtensions)) {
            echo "
                <p id='error_login' class='absolute bottom-0 right-0 m-6 bg-lightRed text-light px-6 py-3'>
                Only JPG, JPEG, PNG & GIF files are allowed.
                </p>
                <script>
                setTimeout(() => {
                    document.getElementById('error_login').classList.add('hidden');
                }, 4000);
                </script>
            ";
            exit;
        }

        if ($_FILES["imageData"]["size"] > $maxFileSize) {
            echo "
                <p id='error_login' class='absolute bottom-0 right-0 m-6 bg-lightRed text-light px-6 py-3'>
                Maximum allowed file size is 4 MB.
                </p>
                <script>
                setTimeout(() => {
                    document.getElementById('error_login').classList.add('hidden');
                }, 3000);
                </script>
            ";
            exit;
        }

        // Move the uploaded file to the desired location
        if (move_uploaded_file($tempname, $folder)) {
            echo "File uploaded successfully.";
        } else {
            echo "Error uploading file.";
        }
    }

    // sql command
    $sql = "UPDATE properties SET property_type = '$property_type', province = '$property_province', location = '$property_city', title = '$property_title', about = '$property_about', listing_type = '$property_listing_type', price = '$property_price', iframe_src = '$property_iframe',status='off'";

    // Add image update to the SQL command if a new image is uploaded
    if ($_FILES['imageData']['size'] > 0) {
        $sql .= ", img_url = '$folder'";
    }

    $sql .= " WHERE property_id = '$id'";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<p id='error_login' class='absolute bottom-0 right-0 m-6 bg-lightGreen text-dark px-6 py-3'>
        Property Updated Successfully.
        </p>
        <script>
        setTimeout(() => {
            document.getElementById('error_login').classList.add('hidden');
            window.location.href='../manage-listings.php'
        }, 1000);
        </script>
        ";
    } else {
        echo "<p id='error_login' class='absolute bottom-0 right-0 m-6 bg-lightRed text-light px-6 py-3'>
        Property Update Failed.
        </p>
        <script>
        setTimeout(() => {
            document.getElementById('error_login').classList.add('hidden');
        }, 3000);
        </script>
        ";
    }
}
?>