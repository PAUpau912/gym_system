<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>APEX VITALITY HUB</title>
    <link rel="icon" href="images/apex.jpg" type="icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </body>
</head>


<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <a class="navbar-brand" href="#">
            <img src="images/apex.jpg" width="50" height="50" style = "border-radius: 50%;" alt="Logo">
            APEX VITALITY HUB
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <!-- <li class="nav-item"><a class="nav-link" href="#About">About</a></li> -->
                <li class="nav-item"><a class="nav-link" href="#Membership">Membership</a></li>
                <li class="nav-item"><a class="nav-link" href="#Trainer">Trainer</a></li>
                <li class="nav-item"><a class="nav-link" href="#Gallery">Gallery</a></li>
                <li class="nav-item"><a class="nav-link" href="join.php">Join Us</a></li>
                <li class="nav-item"><a class="nav-link" href="#Contact">Contact</a></li>
            </ul>
        </div>
    </nav>

    <div class="first-container d-flex justify-content-center text-center">
        <div class="container">
            <div class="content">
                <div class="bgbgbg">
                    <h1>FITNESS AND GYM</h1>
                    <h3>START YOUR JOURNEY NOW!<br> LASTG GYM SERVICES</h3>
                    <p class="mt-4">"WELCOME TO<strong> LASTG GYM SERVICE</strong> WHERE FITNESS MEETS COMMUNITY. OUR
                        MISSION IS TO
                        EMPOWER INDIVIDUALS OF ALL AGES AND FITNESS LEVELS TO ACHIEVE THEIR HEALTH AND WELLNESS GOALS IN
                        A
                        SUPPORTIVE AND MOTIVATING ENVIRONMENT. WITH STATE-OF-THE-ART EQUIPMENT, EXPERT TRAINERS, AND A
                        VARIETY OF
                        CLASSES, WE'RE COMMITTED TO HELPING YOU TRANSFORM YOUR LIFESTYLE. WHETHER YOU'RE A SEASONED
                        ATHLETE
                        OR JUST
                        STARTING YOUR FITNESS JOURNEY, WE'RE HERE TO SUPPORT YOU EVERY STEP OF THE WAY. JOIN US AND
                        BECOME
                        THE BEST
                        VERSION OF YOURSELF!"</p>
                </div>

                <a class="joinus" href="join.php"><button class="btn">Join Us!</button></a>
            </div>
        </div>
    </div>

    <!--ABOUT PAGE-->
    <!-- <div id="About" class="container text-center my-5">
        <h1>ABOUT</h1>
        <p class="mt-4">"WELCOME TO<strong> LASTG GYM SERVICE</strong> WHERE FITNESS MEETS COMMUNITY. OUR MISSION IS TO
            EMPOWER INDIVIDUALS OF ALL AGES AND FITNESS LEVELS TO ACHIEVE THEIR HEALTH AND WELLNESS GOALS IN A
            SUPPORTIVE AND MOTIVATING ENVIRONMENT. WITH STATE-OF-THE-ART EQUIPMENT, EXPERT TRAINERS, AND A VARIETY OF
            CLASSES, WE'RE COMMITTED TO HELPING YOU TRANSFORM YOUR LIFESTYLE. WHETHER YOU'RE A SEASONED ATHLETE OR JUST
            STARTING YOUR FITNESS JOURNEY, WE'RE HERE TO SUPPORT YOU EVERY STEP OF THE WAY. JOIN US AND BECOME THE BEST
            VERSION OF YOURSELF!"</p>
    </div> -->

    <!--MEMBERSHIP PAGE-->
    <div id="Membership" class="container my-5">
        <h2 class="text-center">MEMBERSHIP</h2>
        <div id="membershipCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="d-flex justify-content-center">
                        <div class="text-center">
                            <div class="flex">
                                <img src="images/silver.webp" alt="Silver">
                                <div></div>
                                <div>
                                    <h2>Silver</h2>
                                    <p class="price">₱1000 <br><strong>1 Month Voucher</strong><br></p>
                                    <p class="detail">Day Pass Only</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="d-flex justify-content-center">
                        <div class="text-center">
                            <div class="flex">
                                <img src="images/gold.webp" alt="Gold">
                                <div>
                                    <h2>Gold</h2>
                                    <p class="price">₱3000<br><strong>3 Months Voucher</strong><br></p>
                                    <p class="detail"> Day Pass Only<br>Basic Coaches</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="d-flex justify-content-center">
                        <div class="text-center">
                            <div class="flex">
                                <img src="images/platinum.webp" alt="Platinum">
                                <div>

                                    <h2>Platinum</h2>
                                    <p class="price">₱5000 <br><strong>6 Months Voucher</strong><br></p>
                                    <p class="detail">Full Access<br>with Featured Trainer sessions</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#membershipCarousel" role="button" data-slide="prev">
                <img src="images/caroprev.png" width="150" height="150" alt="prev">
            </a>
            <a class="carousel-control-next" href="#membershipCarousel" role="button" data-slide="next">
                <img src="images/caronext.png" width="150" height="150" alt="next">
            </a>
        </div>
    </div>
    <!--TRAINER-->
    <div id="Trainer" class="container my-5">
        <div class="line"></div>
        <h1 class="text-center">FEATURED TRAINER</h1>
        <div class="row text-center">
            <div class="container">
                <div class="row featurette">
                    <div class="col-md-7">
                        <h2 class="featurette-heading fw-normal lh-1">The Functional Fitness Coach. <span
                                class="text-body-secondary"><br>Ava Agile</span></h2>
                        <p class="lead">Ava is a certified functional fitness trainer with a background in physical
                            therapy. She is empathetic and focuses on helping clients improve their everyday movements
                            and functionality.</p>
                    </div>
                    <div class="col-md-5">
                        <img src="images/ava.webp" alt="..." class="img-fluid">
                    </div>
                </div>
                <hr class="featurette-divider">

                <div class="row featurette">
                    <div class="col-md-5">
                        <img src="images/max.webp" alt="..." class="img-fluid">
                    </div>
                    <div class="col-md-7">
                        <h2 class="featurette-heading fw-normal lh-1">The Muscle Builder Coach.<span
                                class="text-body-secondary"><br>Max Muscle</span></h2>
                        <p class="lead">Max is a former competitive bodybuilder turned coach. He has a vibrant
                            personality
                            and is passionate about helping clients achieve their strength and muscle-building goals..
                        </p>
                    </div>
                </div>

                <hr class="featurette-divider">
                <div class="row featurette">
                    <div class="col-md-7">
                        <h2 class="featurette-heading fw-normal lh-1">The Speed and Agility Specialist.<span
                                class="text-body-secondary"><br>Zenith Zoe</span></h2>
                        <p class="lead">Zoe is a certified yoga instructor and meditation practitioner with a calm and
                            composed demeanor. She believes in the power of mindfulness and mental well-being alongside
                            physical fitness.</p>
                    </div>
                    <div class="col-md-5">
                        <img src="images/zoe.webp" alt="..." class="img-fluid">
                    </div>
                </div>

                <hr class="featurette-divider">
                <div class="row featurette">
                    <div class="col-md-5">
                        <img src="images/leo.webp" alt="..." class="img-fluid">
                    </div>
                    <div class="col-md-7">
                        <h2 class="featurette-heading fw-normal lh-1">Weightlifting Wizard.<span
                                class="text-body-secondary"><br>Leo Lean</span></h2>
                        <p class="lead">Leo is an energetic and enthusiastic coach with a background in athletics. He
                            loves
                            high-intensity workouts and believes in pushing clients to their limits for maximum results.
                        </p>
                    </div>
                </div>
                <hr class="featurette-divider">
            </div>
        </div>


    </div>
    <!--GALLERY-->
    <div id="Gallery" class="container my-5">

        <div class=" order-md-2">
            <h2 class="text-center">GALLERY</h2>
            <h4 class="fw-normal text-center">Oh yeah, it’s that good. <span class="text-body-secondary">See
                    for yourself.</span></h4>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-4 col-6 mb-4">
                    <img src="images/im1.webp" class="img-fluid" alt="Images Image 1">
                </div>
                <div class="col-lg-4 col-md-4 col-6 mb-4">
                    <img src="images/im3.webp" class="img-fluid" alt="Images Image 2">
                </div>
                <div class="col-lg-4 col-md-4 col-6 mb-4">
                    <img src="images/im2.webp" class="img-fluid" alt="Images Image 3">
                </div>
                <div class="col-lg-4 col-md-4 col-6 mb-4">
                    <img src="images/im5.webp" class="img-fluid" alt="Images Image 4">
                </div>
                <div class="col-lg-4 col-md-4 col-6 mb-4">
                    <img src="images/im4.webp" class="img-fluid" alt="Images Image 5">
                </div>
                <div class="col-lg-4 col-md-4 col-6 mb-4">
                    <img src="images/im6.webp" class="img-fluid" alt="Images Image 6">
                </div>
            </div>
        </div>
    </div>

    <div>
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item "><a href="#" class="nav-link px-2 text-body-secondary buttombt">Home</a></li>
            <!-- <li class="nav-item ">
                <a href="#About" class="nav-link px-2 text-body-secondary ">About</a>
            </li> -->
            <li class="nav-item "><a href="#Membership" class="nav-link px-2 text-body-secondary">Membership</a>
            </li>
            <li class="nav-item "><a href="#Trainer" class="nav-link px-2 text-body-secondary">Trainer</a></li>
        </ul>
    </div>
    <!--CONTACT-->
    <!--FOOTER-->
    <footer id="Contact" class="text-center">

        <div class="container">
            <h4>LastG Gym Services</h4>
            <p>&copy; 2023 LastG Gym Services. All Rights Reserved.</p>
            <div class="row mt-4">
                <div class="col-md-6 text-left">
                    <h5 style="color:black;">Contact Us</h5>
                    <p>Feel free to reach out to us if you have any questions or inquiries. We're here to help you
                        on
                        your fitness journey!</p>
                    <p><strong>Phone:</strong> 0912-345-6789</p>
                    <p><strong>Email:</strong> lastGservices@gmail.com</p>
                    <p><strong>Address:</strong> 123 Corner St., San Pablo, Laguna, Philippines</p>
                </div>
                <div class="col-md-6 text-left">
                    <h5 style="color:black;">Operating Hours</h5>
                    <p><strong>Monday - Sunday:</strong> 6:00 AM - 12:00 AM</p>
                </div>
            </div>
            <div class="social-icons mt-4">
                <a href="https://www.facebook.com"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.instagram.com"><i class="fab fa-instagram"></i></a>
                <a href="https://www.twitter.com"><i class="fab fa-twitter"></i></a>
            </div>
            <div class="mt-4">
                <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a>
            </div>
        </div>
    </footer>

    <div id="watermark">
        <p>APEX VITALITY HUB, GROUP 4-LASTG</p>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>

</html>