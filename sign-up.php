<?php

include 'components/connect.php';

if (isset($_POST['submit'])) {
    // Validate and sanitize user input
    $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $address = filter_var($_POST['address'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $pass = sha1($_POST['pass']);
    $cpass = sha1($_POST['cpass']);

    // Prevent duplicate email entries
    $select_user = $con->prepare("SELECT * FROM users WHERE email = ?");
    $select_user->bind_param("s", $email);
    $select_user->execute();
    $result = $select_user->get_result();

    if ($result->num_rows > 0) {
        echo "Email already taken";
    } else if ($pass != $cpass) {
        echo "Password not matching";
    } else {
        // Insert data into database
        $insert_user = $con->prepare("INSERT INTO users (name, email, phone, address, password) VALUES (?, ?, ?, ?, ?)");
        $insert_user->bind_param("sssss", $name, $email, $phone, $address, $cpass);
        $insert_user->execute();
        echo "Registered successfully!";
        $insert_user->close();
    }

    // Close prepared statements
    $select_user->close();

}



?>

<?php include 'components/header.php'; ?>

<section class="page-title title-bg13">
    <div class="d-table">
        <div class="d-table-cell">
            <h2>Sign Up</h2>
            <ul>
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li>Sign Up</li>
            </ul>
        </div>
    </div>
    <div class="lines">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
    </div>
</section>


<div class="signup-section ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-8 offset-md-2 offset-lg-3">
                <form class="signup-form" method="post">
                    <div class="form-group">
                        <label>Enter Username</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Username" required>
                    </div>
                    <div class="form-group">
                        <label>Enter Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter Your Email" required>
                    </div>
                    <div class="form-group">
                        <label>Enter Phone no</label>
                        <input type="text" name="phone" class="form-control" placeholder="Enter Your Phone no" required>
                    </div>
                    <div class="form-group">
                        <label>Enter Address</label>
                        <input type="text" name="address" class="form-control" placeholder="Enter Your Phone no"
                            required>
                    </div>
                    <div class="form-group">
                        <label>Enter Password</label>
                        <input type="password" name="pass" class="form-control" placeholder="Enter Your Password"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="cpass" class="form-control" placeholder="Enter Your Password"
                            required>
                    </div>

                    <div class="signup-btn text-center">
                        <button type="submit" name="submit">Sign Up</button>
                    </div>
                    <div class="other-signup text-center">
                        <span>Or sign up with</span>
                        <ul>
                            <li>
                                <a href="#">
                                    <i class='bx bxl-google'></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class='bx bxl-facebook'></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class='bx bxl-twitter'></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class='bx bxl-linkedin'></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="create-btn text-center">
                        <p>
                            Have an Account?
                            <a href="signin.html">
                                Sign In
                                <i class='bx bx-chevrons-right bx-fade-right'></i>
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<section class="subscribe-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="section-title">
                    <h2>Get New Job Notifications</h2>
                    <p>Subscribe & get all related jobs notification</p>
                </div>
            </div>
            <div class="col-md-6">
                <form class="newsletter-form" data-toggle="validator">
                    <input type="email" class="form-control" placeholder="Enter your email" name="EMAIL" required
                        autocomplete="off">
                    <button class="default-btn sub-btn" type="submit">
                        Subscribe
                    </button>
                    <div id="validator-newsletter" class="form-result"></div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php include 'components/footer.php'; ?>