<!doctype html>
<html>

<head>
    <?php include 'common/head.php'; ?>
</head>

<body>
    <!-- navbar starts -->
    <?php include 'common/navbar.php'; ?>
    <!-- navbar emds -->
    <section class="container mx-auto py-16" id="hero">
        <div class="flex items-center justify-center">
            <div>
                <h1 class="max-w-3xl text-6xl capitalize font-bold text-center">Discover a place you'll love to live
                </h1>
                <p class="text-lg pt-3 text-center">Finding Your Dream Home for a Happy Family Life.</p>
                <div class="pt-8 flex justify-center">
                    <a href="./listings.php"><button class="px-6 text-xl rounded py-4 border-2" type="button">Get
                            Started</button></a>
                </div>
            </div>
        </div>
    </section>
    <!-- How can we help starts -->
    <section class="container mx-auto py-24">
        <div class="flex flex-col items-center justify-center space-y-2">
            <h1 class="text-4xl font-semibold text-black capitalize text-center">see how homely can help</h1>
            <p class="w-80 h-3 bg-lightRed"></p>
        </div>
        <div class="flex items-center justify-center pt-12 gap-8">
            <div class="flex flex-col items-center justify-center py-6 space-y-4">
                <img src="./assets/svg/icon1.svg" alt="">
                <p class="text-xl font-semibold">Buy a property</p>
                <p class="max-w-sm text-center">With homely, you will be able to buy a home of your dreams.</p>
                <a href="listings.php" class="bg-lessDark text-light px-6 py-3 rounded">
                    <span>
                        Find a home
                    </span>
                    <i class="ml-1 fa-solid fa-arrow-right"></i>
                </a>
            </div>
            <div class="flex flex-col items-center justify-center shadow-2xl rounded py-6 space-y-3 p-3">
                <img src="./assets/svg/icon2.svg" alt="">
                <p class="text-xl font-semibold">Sell a property</p>
                <p class="max-w-sm text-center">List your property for sale so that other buyers can contact with you.
                    Its hassle free.</p>
                <a href="./add-property.php" class="bg-lessDark text-light px-6 py-3 rounded">
                    <button class="rounded">
                        <span>
                            Place an ad
                        </span>
                        <i class="ml-1 fa-solid fa-arrow-right"></i>
                    </button>
                </a>
            </div>
            <div class="flex flex-col items-center justify-center py-6 space-y-3">
                <img src="./assets/svg/icon3.svg" alt="">
                <p class="text-xl font-semibold">Rent a property</p>
                <p class="max-w-sm text-center">Renting your property will never be as easy as we can make it for you.
                </p>
                <a href="listings.php" class="bg-lessDark text-light rounded">
                    <button class="bg-indigo-700 text-white px-6 py-3 rounded">
                        <span>
                            Find a rental
                        </span>
                        <i class="ml-1 fa-solid fa-arrow-right"></i>
                    </button>
                </a>
            </div>
        </div>
    </section>
    <!-- How can we help ends -->


    <!-- footer starts  -->
    <?php include 'common/footer.php'; ?>

    <!-- footer ends -->
</body>

</html>