<div class="bg-ivory text-lessDark text-lg h-fit mt-8">
    <a href="/realestate-change/admin/dashboard.php">
        <div class="border-b px-3 py-3 cursor-pointer" id="manageProperties">Manage Properties</div>
    </a>
    <a href="/realestate-change/admin/manage-users.php">
        <div class="border-b px-3 py-3 cursor-pointer" id="manageUsers">Manage Users</div>
    </a>
    <a href="/realestate-change/admin/manage-messages.php">
        <div class="border-b px-3 py-3 cursor-pointer" id="manageMessage">Manage Enquiries</div>
    </a>
    <a href="/realestate-change/admin/manage-pending.php">
        <div class="border-b px-3 py-3 cursor-pointer" id="pendingProperties">Pending Properties
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