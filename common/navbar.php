<nav class="px-4 container mx-auto px-8 border-1 my-0 my-3 shadow-md bg-ivory rounded-lg text-lessDark">
    <div class="flex items-center justify-between h-16 lg:h-20">
        <div class="flex-shrink-0">
            <a href="/realestate-change/index.php" title="" class="flex">
                <p class=" font-bold uppercase text-2xl">homely</p>
            </a>
        </div>
        <div class="ml-auto lg:flex lg:items-center lg:justify-center lg:space-x-10">
            <a href="/realestate-change/index.php" title="" class="text-lg text-black">
                Home </a>
            <a href="/realestate-change/listings.php" title="" class="text-lg text-black">
                Listings </a>
            <div class="w-px h-5 bg-black/20"></div>
            <?php
            include 'connection.php';
            session_start();
            if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {
                $data = $_SESSION['email'];
            } else {
                $data = '';
            }
            $sql = "SELECT * FROM users WHERE email = '$data'";
            if ($result = mysqli_query($conn, $sql)) {
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $name = $row['fullname'];
                    $id = $row['id'];
                    $email = $row['email'];
                    $phone = $row['phone_number'];
                    echo "
                        <a href='/realestate-change/profile.php' class='flex items-center space-x-2'>
                        <img src='/realestate-change/assets/default.png' alt='' class='w-8 h-8 rounded-full'>
                        <span>$name</span></a>
                        ";
                } else {
                    echo "
                        <a  href='login.php' class='px-6 py-3 border-2 rounded bg-indigo-700 text-white'> Log in </a>
                        ";
                }
            }
            ?>
        </div>
    </div>
</nav>