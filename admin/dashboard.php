<?php include 'common/connection.php'; ?>
<html>

<head>
    <?php include 'common/head.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
</head>
<style>
.chart-canvasOne {
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    max-height: 300px;
}
</style>



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
    if (isset($_POST['logout'])) {
        session_destroy();
        header('location:login.php');
    }
    ?>
    <div class="py-10 container mx-auto">
        <div class="grid grid-cols-4 gap-4">
            <!-- properties/users togglers -->
            <?php include 'menu.php'; ?>
            <?php
            $sql = "SELECT count(*) as total FROM users";
            $result = mysqli_query($conn, $sql);
            $data = mysqli_fetch_assoc($result);
            $totalUsers = $data['total'];

            $sql = "SELECT count(*) as total FROM properties WHERE status = 'on'";
            $result = mysqli_query($conn, $sql);
            $data = mysqli_fetch_assoc($result);
            $totalApprovedProperties = $data['total'];

            $sql = "SELECT count(*) as total FROM properties WHERE status = 'off'";
            $result = mysqli_query($conn, $sql);
            $data = mysqli_fetch_assoc($result);
            $totalPendingProperties = $data['total'];


            $sql = "SELECT count(*) as total FROM properties WHERE province = 'koshi' and status = 'on'";
            $result = mysqli_query($conn, $sql);
            $data = mysqli_fetch_assoc($result);
            $totalKoshiProperties = $data['total'];

            $sql = "SELECT count(*) as total FROM properties WHERE province = 'bagmati' and status = 'on'";
            $result = mysqli_query($conn, $sql);
            $data = mysqli_fetch_assoc($result);
            $totalBagmatiProperties = $data['total'];

            $sql = "SELECT count(*) as total FROM properties WHERE province = 'Madhesh' and status = 'on'";
            $result = mysqli_query($conn, $sql);
            $data = mysqli_fetch_assoc($result);
            $totalMadheshProperties = $data['total'];

            $sql = "SELECT count(*) as total FROM properties WHERE province = 'Gandaki' and status = 'on'";
            $result = mysqli_query($conn, $sql);
            $data = mysqli_fetch_assoc($result);
            $totalGandakiProperties = $data['total'];

            $sql = "SELECT count(*) as total FROM properties WHERE province = 'Lumbini' and status = 'on'";
            $result = mysqli_query($conn, $sql);
            $data = mysqli_fetch_assoc($result);
            $totalLumbiniProperties = $data['total'];

            $sql = "SELECT count(*) as total FROM properties WHERE province = 'Karnali' and status = 'on'";
            $result = mysqli_query($conn, $sql);
            $data = mysqli_fetch_assoc($result);
            $totalKarnaliProperties = $data['total'];

            $sql = "SELECT count(*) as total FROM properties WHERE province = 'Sudurpaschim' and status = 'on'";
            $result = mysqli_query($conn, $sql);
            $data = mysqli_fetch_assoc($result);
            $totalSudurpaschimProperties = $data['total'];
            ?>
            <div class="col-span-3 mt-8">
                <div class="flex items-center justify-between gap-8">
                    <div class="w-50 shadow space-y-3">
                        <p class="text-xl text-center">
                            Active Users
                        </p>
                        <h1 class="text-4xl text-center">
                            <?php echo $totalUsers; ?>
                        </h1>
                    </div>
                    <div class="w-50 shadow space-y-3">
                        <p class="text-xl text-center">
                            Accepted Properties
                        </p>
                        <h1 class="text-4xl text-center">
                            <?php echo $totalApprovedProperties; ?>
                        </h1>
                    </div>
                    <div class="w-50 shadow space-y-3">
                        <p class="text-xl text-center">
                            Pending Properties
                        </p>
                        <h1 class="text-4xl text-center">
                            <?php echo $totalPendingProperties; ?>
                        </h1>
                    </div>
                </div>
                <br>
                <br>
                <br>
                <div class="">
                    <canvas id="propertiesProvince" class="chart-canvasOne shadow" height="300"></canvas>
                </div>

                <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const ctx = document.getElementById("propertiesProvince").getContext("2d");
                    const data = {
                        labels: [
                            "Koshi",
                            "Madhesh",
                            "Bagmati",
                            "Gandaki",
                            "Lumbini",
                            "Karnali",
                            "Sudurpaschim",
                        ],
                        datasets: [{
                            label: "Property Distribution By Province",
                            data: [
                                <?php echo $totalKoshiProperties; ?>,
                                <?php echo $totalMadheshProperties; ?>,
                                <?php echo $totalBagmatiProperties; ?>,
                                <?php echo $totalGandakiProperties; ?>,
                                <?php echo $totalLumbiniProperties; ?>,
                                <?php echo $totalKarnaliProperties; ?>,
                                <?php echo $totalSudurpaschimProperties; ?>,
                            ],
                            backgroundColor: [
                                "rgb(255, 99, 132)",
                                "rgb(54, 162, 235)",
                                "rgb(255, 205, 86)",
                                "rgb(75, 192, 192)",
                                "rgb(153, 102, 255)",
                                "rgb(255, 159, 64)",
                                "rgb(255, 99, 132)",
                            ],
                            borderWidth: 1
                        }]
                    };
                    const config2 = {
                        type: "bar",
                        data: data,
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    };
                    new Chart(ctx, config2);
                });
                </script>


            </div>
        </div>
    </div>
</body>

</html>