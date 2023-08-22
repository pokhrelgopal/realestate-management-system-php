<?php
// check if user is logged in else redirect to login page
if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {
    $data = $_SESSION['email'];
} else {
    echo "<script>window.location.href='login.php'</script>";
}
?>




<div class="bg-ivory rounded text-lessDark text-lg">
    <!-- Showing listings -->
    <a href="/realestate-change/profile.php">
        <div class="border-b p-4 cursor-pointer <?php if (basename($_SERVER['PHP_SELF']) == 'profile.php' || basename($_SERVER['PHP_SELF']) == 'add-property.php') echo 'bg-cleanLight'; ?>"
            id="listing-item">My Listings
        </div>
    </a>
    <!-- Managing Listings -->
    <a href="/realestate-change/manage-listings.php">
        <div class="border-b p-4 cursor-pointer <?php if (basename($_SERVER['PHP_SELF']) == 'manage-listings.php') echo 'bg-cleanLight'; ?>"
            id="manage-item">Manage Listings</div>
    </a>
    <!-- Count message to display in circle -->
    <a href="/realestate-change/enquiries.php">
        <div class="border-b p-4 cursor-pointer <?php if (basename($_SERVER['PHP_SELF']) == 'enquiries.php') echo 'bg-cleanLight'; ?>"
            id="message-item">
            Enquiries
            <?php
            $sql = "SELECT * FROM messages WHERE receiver_id = '$id'";
            $sqlCount = "SELECT COUNT(*) FROM messages WHERE receiver_id = '$id'";
            $result = mysqli_query($conn, $sql);
            $countResult = mysqli_query($conn, $sqlCount);
            if ($countResult) {
                $row = mysqli_fetch_assoc($countResult);
                $ans = $row['COUNT(*)'];
                if ($ans > 0) {
                    echo "<span class='ml-3 px-2 rounded-full bg-lightRed text-light'>$ans</span>";
                } else {
                    echo "";
                }
            }
            ?>
        </div>
    </a>
    <!-- Edit profile button -->
    <a href="/realestate-change/update-profile.php">
        <div class="border-b p-4 cursor-pointer <?php if (basename($_SERVER['PHP_SELF']) == 'update-profile.php') echo 'bg-cleanLight'; ?>"
            id="edit-item">Update Profile
        </div>
    </a>
    <a href="/realestate-change/change-password.php">
        <div class="border-b p-4 cursor-pointer <?php if (basename($_SERVER['PHP_SELF']) == 'change-password.php') echo 'bg-cleanLight'; ?>"
            id="edit-item">Change Password
        </div>
    </a>
    <!-- logout Button -->
    <div class="cursor-pointer hover:bg-red-200">
        <form action="profile.php" method="POST">
            <button type="submit" name="logout" class="w-full p-4 text-left text-lightRed">Logout</button>
        </form>
    </div>
</div>
<?php
// Logout button
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: /realestate-change/index.php");
}
?>