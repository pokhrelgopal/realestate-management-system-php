<?php
include 'common/connection.php';

if (isset($_POST['submit'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password
    $phone = $_POST['phone'];

    $checkSql = "SELECT * FROM users WHERE email='$email'";
    // TODO: Check if email already exists
    $checkResult = mysqli_query($conn, $checkSql);
    if (mysqli_num_rows($checkResult) > 0) {
        echo "
        <p id='error_login' class='absolute top-0 left-0 m-6 bg-lightRed text-light px-6 py-3'>
        Email address already exists.
        </p>
        <script>
        setTimeout(() => {
            document.getElementById('error_login').classList.add('hidden');
        }, 3000);
        </script>
            ";
    } else {
        $sql = "INSERT INTO users (fullname, email, password, phone_number) VALUES ('$fullname', '$email', '$hashedPassword', '$phone')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "
            <p id='error_login' class='absolute top-0 left-0 m-6 bg-lightGreen text-light px-6 py-3'>
            Account Created Successfully.
            </p>
            <script>
            location.href = 'login.php';
            </script>
                ";
        } else {
            echo "
            <p id='error_login' class='absolute top-0 left-0 m-6 bg-lightRed text-light px-6 py-3'>
            Error creating account.
            </p>
            <script>
            setTimeout(() => {
                document.getElementById('error_login').classList.add('hidden');
            }, 3000);
            </script>
                ";
        }
    }
}
?>

<!doctype html>
<html>
<?php include 'common/head.php'; ?>

<body class="bg-cleanLight text-xl">
    <section>
        <div class="flex items-center justify-center w-full my-6">
            <form id="myForm" action="#" method="post"
                class="mt-8 w-[550px] text-lessDark px-8 pb-12 bg-light rounded-xl shadow-xl">
                <h1 class="text-3xl text-center py-5">Register here !</h1>
                <div class="space-y-5">
                    <div>
                        <label for="" class="font-medium"> Full Name </label><br><span id="fnameError"
                            class="text-lightRed"></span>
                        <div class="mt-2.5">
                            <input type="text" name="fullname" id="fullname" placeholder="Enter your full name"
                                class="block w-full p-4 rounded outline-0 bg-ivory text-lessDark" />
                        </div>
                    </div>

                    <div>
                        <label for="" class="font-medium"> Email address
                        </label><br><span id="emailError" class="text-lightRed"></span>
                        <div class="mt-2.5">
                            <input type="email" name="email" id="email" placeholder="Enter email to get started"
                                class="block w-full p-4 rounded outline-0 bg-ivory text-lessDark" />
                        </div>
                    </div>
                    <div>
                        <label for="" class="font-medium"> Phone Number
                        </label><br><span id="phoneError" class="text-lightRed"></span>
                        <div class="mt-2.5">
                            <input type="text" name="phone" id="phone" placeholder="Phone number"
                                class="block w-full p-4 rounded outline-0 bg-ivory text-lessDark" />
                        </div>
                    </div>

                    <div>
                        <label for="" class="font-medium"> Password </label><br><span id="password1Error"
                            class="text-lightRed"></span>
                        <div class="mt-2.5">
                            <input type="password" name="password" id="password" placeholder="Enter your password"
                                class="block w-full p-4 rounded outline-0 bg-ivory text-lessDark" />
                        </div>
                    </div>
                    <div>
                        <label for="" class="font-medium">Confirm Password
                        </label><br><span id="password2Error" class="text-lightRed"></span>
                        <div class="mt-2.5">
                            <input type="password" name="cpassword" id="cpassword" placeholder="Enter your password"
                                class="block w-full p-4  rounded outline-0 bg-ivory text-lessDark" />
                        </div>
                    </div>
                    <div>
                        <button type="submit" name="submit" class="w-full py-4 text-dark rounded"
                            style="background-color: black;">
                            Create account
                        </button>
                    </div>
                    <p class="text-center"> Already have an account? <a href="login.php" class="underline">Login</a>
                    </p>
                </div>
            </form>
        </div>
    </section>
    <script>
    const myForm = document.getElementById('myForm')
    myForm.addEventListener('submit', function(event) {
        const fullname = document.getElementById('fullname').value;
        const email = document.getElementById('email').value;
        const phone = document.getElementById('phone').value;
        const password = document.getElementById('password').value;
        const cpassword = document.getElementById('cpassword').value;
        const fnameError = document.getElementById('fnameError');
        const emailError = document.getElementById('emailError');
        const phoneError = document.getElementById('phoneError');
        const password1Error = document.getElementById('password1Error');
        const password2Error = document.getElementById('password2Error');

        // fullname validation
        if (fullname === "") {
            event.preventDefault();
            fnameError.textContent = "*required";
        } else if (fullname.length < 3) {
            event.preventDefault();
            fnameError.textContent = "Fullname must be more than 5 characters";
        } else if (/\d/.test(fullname)) {
            event.preventDefault();
            fnameError.textContent = "Fullname should not contain numbers";
        } else if (/[^a-zA-Z0-9 ]/.test(fullname)) {
            event.preventDefault();
            fnameError.textContent = "Fullname should not contain special symbols or characters";
        } else {
            fnameError.textContent = "";
        }


        // email validation
        if (email === "") {
            event.preventDefault();
            emailError.textContent = "*required";
        } else if (email.length < 5) {
            event.preventDefault();
            emailError.textContent = "Email must be more than 5 characters";
        } else {
            emailError.textContent = "";
        }

        // password validtion
        if (password === "") {
            event.preventDefault();
            password1Error.textContent = "*required";
        } else if (password.length < 8) {
            event.preventDefault();
            password1Error.textContent = "Password must be at least 8 characters";
        } else if (!/\d/.test(password) || !/[a-zA-Z]/.test(password)) {
            event.preventDefault();
            password1Error.textContent = "Password must contain a combination of letters and numbers";
        } else {
            password1Error.textContent = "";
        }

        // confirm password validation
        if (cpassword === "") {
            event.preventDefault();
            password2Error.textContent = "*required";
        } else if (cpassword !== password) {
            event.preventDefault();
            password2Error.textContent = "Password does not match";
            password1Error.textContent = "Password does not match";
        } else {
            password2Error.textContent = "";
        }

        // phone validation
        if (phone === "") {
            event.preventDefault();
            phoneError.textContent = "*required";
        } else if (!/^9/.test(phone)) {
            event.preventDefault();
            phoneError.textContent = "Phone number must start with 9";
        } else if (phone.length !== 10) {
            event.preventDefault();
            phoneError.textContent = "Phone number must be 10 digits";
        } else if (!/^[0-9]+$/.test(phone)) {
            event.preventDefault();
            phoneError.textContent = "Phone number must be number only";
        } else {
            phoneError.textContent = "";
        }

    });
    </script>

</body>

</html>