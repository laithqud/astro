<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="/public/images/fav.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About us</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet" />
    <link rel="stylesheet" href="./public/css/style.css" />
    <link rel="stylesheet" href="./public/css/about.css" />

</head>

<body>

    <?php include_once('./views/layout/public/header.php'); ?>



    <div id="video" class="d-flex justify-content-center align-items-center query992">

        <div class="d-flex justify-content-center w-100 align-items-center">
            <video id="our-video" src="./public/images/ourStory.mp4" autoplay loop muted></video>
            <button id="unmute-button" class="btn btn-primary">
                <i id="unmute-icon" class="fas fa-volume-xmark"></i>
            </button>
        </div>

        <script>
            document.getElementById('unmute-button').addEventListener('click', function() {
                var video = document.getElementById('our-video');
                var icon = this.querySelector('#unmute-icon');
                if (video.muted) {
                    video.muted = false;
                    icon.classList.remove('fa-volume-xmark');
                    icon.classList.add('fa-volume-high');
                } else {
                    video.muted = true;
                    icon.classList.remove('fa-volume-high');
                    icon.classList.add('fa-volume-xmark');
                }
            });
        </script>


    </div>


    <div id="our-story" class="container">
        <div class="padding50px">
            <center>
                <h3 class="text-color">Our Story</h3>
            </center>
            <div class="div-story">
                <div class="d-flex query776 story-card">
                    <p class="text-color text-story">Three years ago, an old friend of ours, a scientist, returned from a groundbreaking mission in outer space. They returned with a treasure that took our breath away: a jar containing mysterious dust from an unknown planet! This extraordinary item became the centerpiece of our lab—we never stopped treating it with excitement and curiosity.</p>
                    <img class="story-alignment" src="./public/images/outer_space.jpg" alt="Outer Space">
                </div>
                <div class="d-flex query776 story-card">
                    <img class="story-alignment" src="https://cdn.openart.ai/published/wsqRTjiBYFVtqv6b11GN/XRLala8c_4-tO_512.webp" alt="Chemical Reaction">
                    <p class="text-color text-story">One day, while cleaning the jar, a small mishap changed everything. Some of the precious dust accidentally spilled into a flask containing a complex mixture of chemicals. The reaction caused a small explosion that sent chills through our bodies. When the dust settled, we were left with an incredible collection of unique, shiny fragments.</p>
                </div>
                <div class="d-flex query776 story-card">
                    <p class="text-color text-story">Since then, we have been studying the characteristics of it. To our amazement, we discovered something phenomenal—these substances endowed individuals with superhuman powers! But the most remarkable part was that no two superpowers were alike, even when created with the exact same formula. And that was how StarDust Elixirs was born!</p>
                    <img class="story-alignment" src="./public/images/superPower.jpeg" alt="Superpower">
                </div>
            </div>
        </div>
    </div>


    <div id="our-mission" class="d-flex flex-column padding50px ">
        <div id="div3-divA" style="padding-bottom: 85px;">
            <center>
                <h3 class="text-color">Our Mission</h3>
            </center>
        </div>
        <div id="div3-divB" class="d-flex gap-5 justify-content-around">
            <div class="d-flex flex-column gap-2 our-mission-div">
                <i class="fa-solid fa-lightbulb fa-lg text-color mb-2"></i>
                <h5 class="text-color">Innovation First</h5>
                <p class="text-color">Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit, iusto doloribus aliquam laudantium eius ex.</p>
            </div>
            <div class="d-flex flex-column gap-2 our-mission-div">
                <i class="fa-solid fa-earth-americas fa-lg text-color mb-2"></i>
                <h5 class="text-color">Sustainability</h5>
                <p class="text-color">Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit, iusto doloribus aliquam laudantium eius ex.</p>
            </div>
            <div class="d-flex flex-column gap-2 our-mission-div">
                <i class="fa-solid fa-people-group fa-lg text-color mb-2"></i>
                <h5 class="text-color">Community Impact</h5>
                <p class="text-color">Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit, iusto doloribus aliquam laudantium eius ex.</p>
            </div>
        </div>
    </div>


    <div id="meet-the-team" class=" padding50px">
        <center>
            <h3 class="text-color ">Meet the Team</h3>
        </center>

        <div class="d-flex flex-wrap pt-3 justify-content-center align-items-center ms-5 div-MeetUs-group">
            <div class="div-MeetUs">
                <img class="widthHeight100" src="Public/images/laith.jpg" alt="">
                <p class="padding10px">Dr. Laith, Lead Scientist</p>
            </div>
            <div class="div-MeetUs">
                <img class="widthHeight100" src="public/images/osama.jfif" alt="">
                <p class="padding10px">Dr. Osama, AI & Systems Engineer</p>
            </div>
            <div class="div-MeetUs">
                <img class="widthHeight100" src="/public/images/layan.png" alt="">
                <p class="padding10px">Dr. Layan, Head of Development</p>
            </div>
            <div class="div-MeetUs">
                <img class="widthHeight100" src="Public/images/ola.jfif" alt="">
                <p class="padding10px">Dr. Ola, Chief Engineer</p>
            </div>
            <div class="div-MeetUs">
                <img class="widthHeight100" src="Public/images/yousef.png" alt="">
                <p class="padding10px">Dr. Yousef, Logistics & Customer Success</p>
            </div>
        </div>

    </div>




    <center>
        <div class="cta-container padding50px">
            <h2>Ready to Discover Your Superpower?</h2>
            <a href="/shop" class="cta-button">Get Your Elixir Now</a>
        </div>
    </center>




    <?php include_once('./views/layout/public/footer.php'); ?>




    <script src="https://kit.fontawesome.com/d24639e9bf.js" crossorigin="anonymous"></script>
    <script src="./public/js/navbar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>