<style>

</style>

<div class="bg-ivory text-lessDark text-lg h-fit mt-8">
    <a href="/realestate-change/admin/dashboard.php">
        <div class="border-b px-3 py-3 cursor-pointer <?php if (basename($_SERVER['PHP_SELF']) == 'dashboard.php' || basename($_SERVER['PHP_SELF']) == 'add-property.php') echo 'bg-cleanLight'; ?>" id="manageProperties">Dashboard</div>
    </a>
    <a href="/realestate-change/admin/manage-properties.php">
        <div class="border-b px-3 py-3 cursor-pointer <?php if (basename($_SERVER['PHP_SELF']) == 'manage-properties.php' || basename($_SERVER['PHP_SELF']) == 'add-property.php') echo 'bg-cleanLight'; ?>" id="manageProperties">Manage Properties</div>
    </a>
    <a href="/realestate-change/admin/manage-users.php">
        <div class="border-b px-3 py-3 cursor-pointer <?php if (basename($_SERVER['PHP_SELF']) == 'manage-users.php' || basename($_SERVER['PHP_SELF']) == 'add-property.php') echo 'bg-cleanLight'; ?>" id="manageUsers">Manage Users</div>
    </a>
    <a href="/realestate-change/admin/manage-messages.php">
        <div class="border-b px-3 py-3 cursor-pointer <?php if (basename($_SERVER['PHP_SELF']) == 'manage-messages.php' || basename($_SERVER['PHP_SELF']) == 'add-property.php') echo 'bg-cleanLight'; ?>" id="manageMessage">Manage Enquiries</div>
    </a>
    <a href="/realestate-change/admin/manage-pending.php">
        <div class="border-b px-3 py-3 cursor-pointer <?php if (basename($_SERVER['PHP_SELF']) == 'manage-pending.php' || basename($_SERVER['PHP_SELF']) == 'add-property.php') echo 'bg-cleanLight'; ?>" id="pendingProperties">Pending Properties
        </div>
    </a>

    <form action="" method="post" class="bottom-0 w-full">
        <button type="submit" name="logout" class=" px-4 mt-2 text-lightRed rounded w-full text-left">Logout</button>
    </form>

</div>

<?php
if (isset($_POST['logout'])) {
    session_destroy();
    header('location:/realestate-change/admin/login.php');
}
?>