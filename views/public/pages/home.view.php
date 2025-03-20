<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="shortcut icon" href="/public/images/fav.png" type="image/x-icon">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AstruCures</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet" />
  <!-- Font Awesome for Icons -->
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    rel="stylesheet" />
  <link rel="stylesheet" href="/public/css/style.css" />
  <!-- Splide.js CSS -->
  <link href="
    https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css
    " rel="stylesheet">

</head>

<body>


  <?php if (isset($_SESSION['flash_error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 end-0 m-3" role="alert" style="width: auto; z-index: 1050; transition: transform 0.3s ease; transform: translateY(-50px);">
      <?php echo $_SESSION['flash_error'];
      unset($_SESSION['flash_error']); ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>
  <?php if (isset($_SESSION['flash_success'])): ?>
    <div class="alert alert-success alert-dismissible fade show position-fixed top-0 end-0 m-3" role="alert" style="width: auto; z-index: 1050; transition: transform 0.3s ease; transform: translateY(-50px);">
      <?php echo $_SESSION['flash_success'];
      unset($_SESSION['flash_success']); ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>
  <script>
    document.querySelectorAll('.alert').forEach(alert => {
      setTimeout(() => {
        alert.style.transform = 'translateY(0)';
      }, 100);
    });
  </script>


  <?php include_once('./views/layout/public/header.php'); ?>

  <!-- hero -->


  <div class="hero">
    <div class="hero-content">
      <h1>Astro Cures</h1>
      <!-- <span>- XXX -</span> -->
      <p class="hero-description">Unlock Your True Potential. Elevate your abilities with Astro Cures' cutting-edge superpower pills. The future of human evolution starts here.
      </p>
      <div class="hero-buttons">
        <a href="/shop" class="btn btn-primary">Shop Now</a>
        <a href="/about" class="btn btn-secondary">Learn More</a>
      </div>
    </div>
  </div>


  <!-- best sellers -->

  <div class="container section">
    <h1>Best Sellers</h1>
    <div id="image-slider" class="splide container">
      <div class="splide__track ">
        <ul class="splide__list  ">


          <?php foreach ($bestSellers as $product): ?>
            <li class="splide__slide">
              <?php include('./views/components/product.view.php'); ?>
            </li>
          <?php endforeach; ?>

        </ul>
      </div>
    </div>
  </div>

  <!-- create your own -->

  <div class="container d-flex flex-row create">
    <div class="text d-flex flex-column  p-1">
      <h1>Creat Your Own Super Power!</h1>
      <p>Construct and create your super power and our scintenst will make the formula with perfect balance.</p>
      <div class="feature-container ">


        <!-- Card 1 -->
        <div class="feature-card">
          <div class="text-content">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#ff0077" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
              <path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z" />
            </svg>
            <h6>Name Your Super Power</h6>
            <p>Go crazy and as creative as you desire!</p>
          </div>
        </div>

        <!-- Card 2 -->
        <div class="feature-card">
          <div class="text-content">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#ffdd00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="10" x2="14" y1="2" y2="2" />
              <line x1="12" x2="15" y1="14" y2="11" />
              <circle cx="12" cy="14" r="8" />
            </svg>
            <h6>For how long do you want to be a hero?</h6>
            <p>Remember, time is money!</p>
          </div>
        </div>

        <!-- Card 3 -->
        <div class="feature-card">
          <div class="text-content">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#0077ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M10 2v2" />
              <path d="M14 2v4" />
              <path d="M17 2a1 1 0 0 1 1 1v9H6V3a1 1 0 0 1 1-1z" />
              <path d="M6 12a1 1 0 0 0-1 1v1a2 2 0 0 0 2 2h2a1 1 0 0 1 1 1v2.9a2 2 0 1 0 4 0V17a1 1 0 0 1 1-1h2a2 2 0 0 0 2-2v-1a1 1 0 0 0-1-1" />
            </svg>
            <h6>Do you like to be creative?</h6>
            <p>You don't have to be an artist, our AI will help you!</p>
          </div>
        </div>

        <!-- Card 4 -->
        <div class="feature-card">
          <div class="text-content">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#77ff00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M21 7 6.82 21.18a2.83 2.83 0 0 1-3.99-.01a2.83 2.83 0 0 1 0-4L17 3" />
              <path d="m16 2 6 6" />
              <path d="M12 16H4" />
            </svg>
            <h6>Read About the Ingredients</h6>
            <p>The space matter is confidential, but you can know all about the chemicals used!</p>
          </div>
        </div>

      </div>
      <a href="/about" class="btn-gradient">Coming Soon</a>
    </div>


    <div class="image ">
      <img src="./public/images/sectionPhoto2.png" alt="">
    </div>

  </div>

  <!-- New Arrivals -->

  <div class="container section">
    <h1>New Arrivals</h1>
    <div id="image-slider-new" class="splide container">
      <div class="splide__track ">
        <ul class="splide__list  ">


          <?php foreach ($newArrivals as $product): ?>
            <li class="splide__slide">
              <?php include('./views/components/product.view.php'); ?>
            </li>
          <?php endforeach; ?>

        </ul>
      </div>
    </div>
  </div>




  <!-- Testimonials Section -->
  <div class="container section">
    <div class="d-flex justify-content-between align-items-center">
      <h1>Testimonials</h1>
      <?php if (isset($_SESSION['user'])): ?>
        <a href="/testimonials/add" class="btn btn-primary">Add Yours</a>
      <?php endif; ?>
    </div>
    <div id="testimonials-slider" class="splide container">
      <div class="splide__track">
        <ul class="splide__list">
          <?php foreach ($testimonials as $testimonial): ?>
            <li class="splide__slide">
              <div class="testimonial-card">
                <div class="testimonial-content">
                  <p>
                  <blockquote>"<?php echo $testimonial['message']; ?>"</blockquote>
                  </p>
                </div>
                <div class="testimonial-author">
                  <span class="name"><?php echo $testimonial['name']; ?></span>
                </div>
              </div>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>



  <?php include_once('./views/layout/public/footer.php'); ?>












  <script src="/public/js/navbar.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
  <!-- Splide.js JavaScript -->
  <script src="
    https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js
    "></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      new Splide('#image-slider', {
        type: 'loop', // Infinite loop mode
        perPage: 4, // Show 3 slides at a time
        perMove: 2, // Move 1 slide at a time
        autoplay: true, // Enable autoplay
        interval: 3000, // Change slide every 3 seconds
        gap: '20px', // Space between slides
        padding: '50px', // Padding around the slider
        pagination: false, // Disable pagination
        breakpoints: {
          1200: {
            perPage: 3,
            gap: '50px',
            padding: '40px'
          },
          1024: {
            perPage: 2,
            gap: '40px',
            padding: '30px'
          }, // Show 2 slides on smaller screens
          768: {
            perPage: 2,
            perMove: 1,
            gap: '30px',
            padding: '20px'
          }, // Show 1 slide on mobile
          568: {
            perPage: 1,
            perMove: 1,
            gap: '40px',
            padding: '80px'
          }, // Show 1 slide on mobile
          400: {
            perPage: 1,
            perMove: 1,
            gap: '40px',
            padding: '60px'
          }
        }
      }).mount();

      new Splide('#image-slider-new', {
        type: 'loop',
        perPage: 4,
        perMove: 2,
        autoplay: true,
        interval: 3000,
        gap: '20px',
        padding: '50px',
        pagination: false,
        breakpoints: {
          1200: {
            perPage: 3,
            gap: '50px',
            padding: '40px'
          },
          1024: {
            perPage: 2,
            gap: '40px',
            padding: '30px'
          }, // Show 2 slides on smaller screens
          768: {
            perPage: 2,
            perMove: 1,
            gap: '30px',
            padding: '20px'
          }, // Show 1 slide on mobile
          568: {
            perPage: 1,
            perMove: 1,
            gap: '40px',
            padding: '80px'
          }, // Show 1 slide on mobile
          400: {
            perPage: 1,
            perMove: 1,
            gap: '40px',
            padding: '60px'
          } // Show 1 slide on mobile
        }
      }).mount();
    });


    document.addEventListener('DOMContentLoaded', function() {
      new Splide('#testimonials-slider', {
        type: 'loop', // Infinite loop mode
        perPage: 3, // Show 3 testimonials at a time
        perMove: 1, // Move 1 testimonial at a time
        autoplay: true, // Enable autoplay
        interval: 3000, // Change slide every 3 seconds
        gap: '20px', // Space between slides
        padding: '50px', // Padding around the slider
        pagination: false, // Disable pagination
        breakpoints: {
          1200: {
            perPage: 3,
            gap: '20px',
            padding: '40px'
          },
          1024: {
            perPage: 2,
            gap: '20px',
            padding: '30px'
          }, // Show 2 testimonials on smaller screens
          768: {
            perPage: 1,
            gap: '20px',
            padding: '20px'
          }, // Show 1 testimonial on mobile
          568: {
            perPage: 1,
            gap: '20px',
            padding: '10px'
          }, // Show 1 testimonial on mobile
          400: {
            perPage: 1,
            gap: '20px',
            padding: '10px'
          } // Show 1 testimonial on mobile
        }
      }).mount();
    });
  </script>

</body>

</html>