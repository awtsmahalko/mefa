<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="keywords" content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, material pro admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, material design, material dashboard bootstrap 5 dashboard template" />
    <meta name="description" content="MaterialPro is powerful and clean admin dashboard template, inpired from Google's Material Design" />
    <meta name="robots" content="noindex,nofollow" />
    <title>MEFA: Main Emergency Fire Alert</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/materialpro/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png" />
    <!-- Custom CSS -->
    <link href="../dist/css/style.min.css" rel="stylesheet" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body data-theme="dark">
    <div class="main-wrapper">
        <!-- -------------------------------------------------------------- -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- -------------------------------------------------------------- -->
        <div class="preloader">
            <svg class="tea lds-ripple" width="37" height="48" viewbox="0 0 37 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M27.0819 17H3.02508C1.91076 17 1.01376 17.9059 1.0485 19.0197C1.15761 22.5177 1.49703 29.7374 2.5 34C4.07125 40.6778 7.18553 44.8868 8.44856 46.3845C8.79051 46.79 9.29799 47 9.82843 47H20.0218C20.639 47 21.2193 46.7159 21.5659 46.2052C22.6765 44.5687 25.2312 40.4282 27.5 34C28.9757 29.8188 29.084 22.4043 29.0441 18.9156C29.0319 17.8436 28.1539 17 27.0819 17Z" stroke="#1e88e5" stroke-width="2"></path>
                <path d="M29 23.5C29 23.5 34.5 20.5 35.5 25.4999C36.0986 28.4926 34.2033 31.5383 32 32.8713C29.4555 34.4108 28 34 28 34" stroke="#1e88e5" stroke-width="2"></path>
                <path id="teabag" fill="#1e88e5" fill-rule="evenodd" clip-rule="evenodd" d="M16 25V17H14V25H12C10.3431 25 9 26.3431 9 28V34C9 35.6569 10.3431 37 12 37H18C19.6569 37 21 35.6569 21 34V28C21 26.3431 19.6569 25 18 25H16ZM11 28C11 27.4477 11.4477 27 12 27H18C18.5523 27 19 27.4477 19 28V34C19 34.5523 18.5523 35 18 35H12C11.4477 35 11 34.5523 11 34V28Z"></path>
                <path id="steamL" d="M17 1C17 1 17 4.5 14 6.5C11 8.5 11 12 11 12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke="#1e88e5"></path>
                <path id="steamR" d="M21 6C21 6 21 8.22727 19 9.5C17 10.7727 17 13 17 13" stroke="#1e88e5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </div>
        <!-- -------------------------------------------------------------- -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- -------------------------------------------------------------- -->
        <!-- -------------------------------------------------------------- -->
        <!-- Login box.scss -->
        <!-- -------------------------------------------------------------- -->
        <div class="row auth-wrapper gx-0">
            <div class="col-lg-4 col-xl-3 bg-danger auth-box-2 on-sidebar">
                <div class="h-100 d-flex align-items-center justify-content-center">
                    <div class="row justify-content-center text-center">
                        <div class="col-md-7 col-lg-12 col-xl-9">
                            <div>
                                <span class="db"><img src="../assets/images/background/bfp.png" width="200px" alt="logo" /></span>
                            </div>
                            <h2 class="text-white mt-4 fw-light">
                                <span class="font-weight-medium">MEFA: </span> MAIN EMERGENCY FIRE ALERT
                            </h2>
                            <p class="op-5 text-white fs-4 mt-4">
                                MEFA: Main Emergency Fire Alert Application is an application responsible for notifying residents and authorities about a Fire being detected through device with smoke sensor.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-xl-9 d-flex align-items-center justify-content-center">
                <div class="row justify-content-center w-100 mt-4 mt-lg-0">
                    <div class="col-lg-6 col-xl-3 col-md-7">
                        <div class="card" id="registerform">
                            <div class="card-body">
                                <h2>Sign Up Form</h2>
                                <p class="text-muted fs-4">
                                    Enter given details for new account
                                </p>
                                <form class="form-horizontal mt-4 pt-4 needs-validation" novalidate action="auth/signup.php">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control form-input-bg" id="tb-rfname" placeholder="john deo" name="user_fullname" required />
                                        <label for="tb-rfname">Full Name</label>
                                        <div class="invalid-feedback">Full name is required</div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control form-input-bg" id="tb-remail" placeholder="john@gmail.com" required />
                                        <label for="tb-remail">Username</label>
                                        <div class="invalid-feedback">Username is required</div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control form-input-bg" id="text-rpassword" placeholder="*****" required />
                                        <label for="text-rpassword">Password</label>
                                        <div class="invalid-feedback">Password is required</div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control form-input-bg" id="text-rcpassword" placeholder="*****" required />
                                        <label for="text-rcpassword">Confirm Password</label>
                                        <div class="invalid-feedback">Password is required</div>
                                    </div>
                                    <div class="form-check mb-4 pb-2">
                                        <input class="form-check-input" type="checkbox" value="" id="r-me" required />
                                        <label class="form-check-label" for="r-me">
                                            Remember me
                                        </label>
                                        <div class="invalid-feedback">
                                            You must agree before submitting.
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-stretch button-group">
                                        <button type="submit" class="btn btn-info btn-lg px-4">
                                            Submit
                                        </button>
                                        <a href="javascript:void(0)" id="to-login2" class="
                          btn btn-lg btn-light-secondary
                          text-secondary
                          font-weight-medium
                        ">Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card" id="loginform">
                            <div class="card-body">
                                <h2>Welcome to MEFA</h2>
                                <p class="text-muted fs-4">
                                    New Here?
                                    <a href="javascript:void(0)" id="to-register">Create an account</a>
                                </p>
                                <form class="form-horizontal mt-4 pt-4 needs-validation" novalidate action="auth/login.php">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control form-input-bg" id="tb-email" autocomplete="off" placeholder="Username" name="username" required />
                                        <label for="tb-email">Username</label>
                                        <div class="invalid-feedback">Username is required</div>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control form-input-bg" id="text-password" placeholder="*****" name="password" required />
                                        <label for="text-password">Password</label>
                                        <div class="invalid-feedback">Password is required</div>
                                    </div>

                                    <div class="d-flex align-items-center mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="r-me1" required />
                                            <label class="form-check-label" for="r-me1">
                                                Remember me
                                            </label>
                                            <div class="invalid-feedback">
                                                You must agree before submitting.
                                            </div>
                                        </div>
                                        <div class="ms-auto">
                                            <a href="javascript:void(0)" id="to-recover" class="fw-bold">Forgot Password?</a>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-stretch button-group mt-4 pt-2">
                                        <button type="submit" class="btn btn-info btn-lg px-4">
                                            Sign in
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card" id="recoverform">
                            <div class="card-body">
                                <div class="logo">
                                    <h3>Recover Password</h3>
                                    <p class="text-muted fs-4">
                                        Enter your Email and instructions will be sent to you!
                                    </p>
                                </div>
                                <div class="mt-4 pt-4">
                                    <!-- Form -->
                                    <form action="index.html">
                                        <!-- email -->
                                        <div class="mb-4 pb-2">
                                            <div class="form-floating">
                                                <input class="form-control form-input-bg" type="email" required="" placeholder="Email address" />
                                                <label for="tb-email">Email</label>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-stretch button-group">
                                            <button type="submit" class="btn btn-info btn-lg px-4">
                                                Submit
                                            </button>
                                            <a href="javascript:void(0)" id="to-login" class="
                            btn btn-lg btn-light-secondary
                            text-secondary
                            font-weight-medium
                          ">Cancel</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- -------------------------------------------------------------- -->
        <!-- Login box.scss -->
        <!-- -------------------------------------------------------------- -->
    </div>
    <!-- -------------------------------------------------------------- -->
    <!-- All Required js -->
    <!-- -------------------------------------------------------------- -->
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(".preloader").fadeOut();
        // ---------------------------
        // Login and Recover Password
        // ---------------------------
        $("#to-recover").on("click", function() {
            $("#loginform").hide();
            $("#recoverform").fadeIn();
        });

        $("#to-login").on("click", function() {
            $("#loginform").fadeIn();
            $("#recoverform").hide();
        });

        $("#to-register").on("click", function() {
            $("#loginform").hide();
            $("#registerform").fadeIn();
        });

        $("#to-login2").on("click", function() {
            $("#loginform").fadeIn();
            $("#registerform").hide();
        });

        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            "use strict";

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll(".needs-validation");

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms).forEach(function(form) {
                form.addEventListener(
                    "submit",
                    function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                        }

                        form.classList.add("was-validated");
                    },
                    false
                );
            });
        })();
    </script>
</body>

</html>