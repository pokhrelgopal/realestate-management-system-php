<?php include 'common/connection.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <?php include 'common/head.php'; ?>
</head>

<body class="bg-slate-100 container mx-auto">
    <!-- nav starts -->
    <?php include 'common/navbar.php'; ?>
    <!-- nav ends -->
    <div class="container mx-auto py-8 text-lg">
        <div class="grid grid-cols-4 gap-8">
            <div>
                <?php include 'menu.php'; ?>
            </div>
            <div class="col-span-3 w-2/3">
                <form action="add-property.php" method="POST" class="flex flex-col space-y-3" enctype="multipart/form-data">
                    <div class="space-y-4">
                        <div class="form-control flex flex-col space-y-1">
                            <label for="propertyType">Type of Property</label>
                            <select name="property_type" id="property_type" class="bg-ivory p-3 rounded" required>
                                <option value="house">House</option>
                                <option value="apartment">Apartment</option>
                                <option value="room">Room</option>
                            </select>
                        </div>
                        <div class="form-control flex flex-col space-y-1">
                            <label for="province">Province Name</label>
                            <select name="province" id="province" class="bg-ivory p-3 rounded" required>
                                <option value="koshi">Koshi</option>
                                <option value="madhesh">Madhesh</option>
                                <option value="bagmati">Bagmati</option>
                                <option value="gandaki">Gandaki</option>
                                <option value="lumbini">Lumbini</option>
                                <option value="karnali">Karnali</option>
                                <option value="sudurpaschim">Sudurpaschim</option>
                            </select>
                        </div>
                        <div class="form-control flex flex-col space-y-1">
                            <label for="">City Name</label>
                            <span id="cityError" class="text-red-500"></span>
                            <input type="text" name="city" id="city" placeholder="Eg. Kathmandu" class="bg-ivory p-3 rounded" required>
                        </div>
                        <div class="form-control flex flex-col space-y-1">
                            <label for="">Title of Listing</label>
                            <span id="titleError" class="text-red-500"></span>
                            <input type="text" name="title" id="title" placeholder="Eg. Two bedroom house" class="bg-ivory p-3 rounded" required>
                        </div>
                        <div class="form-control flex flex-col space-y-1">
                            <label for="">Listing Type</label>
                            <select name="listing_type" id="listing_type" class="bg-ivory p-3 rounded" required>
                                <option value="sale">Sale</option>
                                <option value="rent">Rent</option>
                            </select>
                        </div>
                        <div class="form-control flex flex-col space-y-1">
                            <label for="">Description of Listed Property</label>
                            <textarea name="about" id="about" cols="30" rows="10" class="bg-ivory p-3 rounded" placeholder="About property"></textarea>

                        </div>
                        <div class="form-control flex flex-col space-y-1">
                            <label for="">Image of Listed Property <span style="color:orange;">(JPG, JPEG PNG OR GIF are
                                    allowed & less than 4 MB)</span></label>
                            <input type="file" name="imageData" id="image" class="bg-ivory p-3 rounded" required>
                        </div>
                        <div class="form-control flex flex-col space-y-1">
                            <label for="">Price of Listed Property</label>
                            <input type="number" name="price" id="price" class="bg-ivory p-3 rounded" placeholder="Eg. 200000000">
                        </div>
                        <div class="form-control flex flex-col space-y-1">
                            <label for="">Iframe of location (optional)</label>
                            <span id="iframeError" class="text-red-500"></span>
                            <textarea name="iframe" id="iframe" cols="30" rows="5" class="bg-ivory p-3 rounded"></textarea>
                        </div>
                        <button type="submit" id="submit" name="submit" class="w-full bg-lessDark rounded text-light py-4">List
                            Property</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- ====== Contact Section End -->

        <!-- Javascript -->
        <script>
            submit.addEventListener('click', (e) => {
                const city = document.getElementById('city').value;
                const title = document.getElementById('title').value;
                const iframe = document.getElementById('iframe').value;
                const submit = document.getElementById('submit');
                const cityError = document.getElementById('cityError');
                const titleError = document.getElementById('titleError');
                const iframeError = document.getElementById('iframeError');

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

            })
        </script>
</body>

</html>
<?php
if (isset($_POST['submit'])) {
    $property_type = $_POST['property_type'];
    $province = $_POST['province'];
    $title = $_POST['title'];
    $city = $_POST['city'];
    $listing_type = $_POST['listing_type'];
    $about = $_POST['about'];
    $about = mysqli_real_escape_string($conn, $about);
    $price = $_POST['price'];
    $iframe = $_POST['iframe'];
    // imageData 
    $allowedExtensions = array("jpg", "jpeg", "png", "gif");
    $maxFileSize = 4 * 1024 * 1024; // 4 MB

    $filename = $_FILES["imageData"]["name"];
    $tempname = $_FILES["imageData"]["tmp_name"];
    $folder = "images/" . $filename;

    // Check file extension
    $fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    if (!in_array($fileExtension, $allowedExtensions)) {
        echo "
            <p id='error_login' class='absolute top-0 left-0 m-6 bg-lightRed text-light px-6 py-3'>
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

    // Check file size
    if ($_FILES["imageData"]["size"] > $maxFileSize) {
        echo "
            <p id='error_login' class='absolute top-0 left-0 m-6 bg-lightRed text-light px-6 py-3'>
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


    $sql = "INSERT INTO properties (property_type, title, province, `location`,listing_type, about, price, contact_person, img_url,iframe_src,`status`) VALUES ('$property_type', '$title', '$province', '$city','$listing_type', '$about', '$price', '$id', '$folder','$iframe','off')";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<p id='error_login' class='absolute top-0 left-0 m-6 bg-indigo-700 text-white px-6 py-3'>
        Property Listed Successfully
        </p>
        <script>
        setTimeout(() => {
            document.getElementById('error_login').classList.add('hidden');
        }, 3000);
        </script>
        ";
        echo '<script>window.location.href = "profile.php";</script>';
    } else {
        echo "<p id='error_login' class='absolute top-0 left-0 m-6 bg-red-500 text-white px-6 py-3'>
        Property Listing Failed. Please try again
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