<nav class="fixed-top navnav">
      <!-- Main Navigation Bar -->
      <nav class="navbar navbar-expand-lg navbar-dark top-nav">
        <div class="container d-flex align-items-center justify-content-between mainNav">
          <!-- Toggler for Mobile & Logo -->
          <div class="d-flex align-items-center siteLogo">
            <button
              class="navbar-toggler"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#navbarNav"
              aria-controls="navbarNav"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Logo -->
            <a class="navbar-brand" href="/">
              <img
                src="/public/images/logo.png"
                width="100px"
                alt="logo"
                class="d-inline-block align-top"
              />
            </a>
          </div>
          <!-- Navigation Links -->
          <div class="collapse navbar-collapse justify-content-center siteLinks" id="navbarNav">
            <ul class="navbar-nav gap-lg-5 gap-3">
              <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
              <li class="nav-item"><a class="nav-link" href="/about">About</a></li>
              <li class="nav-item"><a class="nav-link" href="/shop">Shop</a></li>
              <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
            </ul>
          </div>
          <!-- Search Bar -->
          <form class="d-flex align-items-center siteSearch" action="/shop">
            <input
              class="form-control me-2 search-bar"
              type="search"
              placeholder="Search"
              aria-label="Search"
              name="search"
            />
            <button title="Search" class="btn btn-outline-light" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </form>
          <!-- Icons (Wishlist, Cart, Account) -->
          <ul class="navbar-nav ms-auto align-items-center siteIcons">
            <li class="nav-item">
              <a class="nav-link" href="/wishlist" title="Wishlist"><i class="fas fa-heart"></i>
              <?php if (isset($_SESSION['wishlistCount'])) {echo $_SESSION['wishlistCount'];} ?>
            </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/cart" title="Cart">
                <i class="fas fa-shopping-cart">
                </i>
                <?php if (isset($_SESSION['cartCount'])) {echo $_SESSION['cartCount'];} ?>
              </a>
            </li>
            <li class="nav-item">
                <?php if (isset($_SESSION['user'])): ?>
                <a class="nav-link" href="/profile/<?php echo $_SESSION['user']['id']; ?>" title="Account"><i class="fas fa-user"></i></a>
                <?php endif; ?>
            </li>
            <li class="nav-item">
            <?php if (isset($_SESSION['user']) && $_SESSION['user']): ?>
              <form action="/auth/logout" method="post">
              <button type="submit" class="btn login-btn btn-primary">Logout</button>
              </form>
            <?php else: ?>
              <a href="/auth/login" class="btn login-btn btn-primary">Login</a>
            <?php endif; ?>
            </li>
          </ul>
        </div>
      </nav>
      <!-- Secondary Navbar (Bottom) -->
      <nav class="navbar navbar-expand-lg navbar-dark bottom-nav">
        <div class="container d-flex justify-content-center">
          <!-- Category Slider with Navigation Buttons -->
          <div class="d-flex align-items-center w-100">
            <button title="Scroll Left" class="btn btn-outline-light btn-sm scroll-left">
              <i class="fas fa-chevron-left"></i>
            </button>
            <div class="category-slider-container flex-grow-1 mx-2">
              <div class="category-slider">
                <a href="/shop?category1=1" class="btn btn-outline-light mx-1">Physical</a>
                <a href="/shop?category2=2" class="btn btn-outline-light mx-1">Elemental</a>
                <a href="/shop?category3=3" class="btn btn-outline-light mx-1">Mental and Psychic</a>
                <a href="/shop?category4=4" class="btn btn-outline-light mx-1">Transformation</a>
                <a href="/shop?category5=5" class="btn btn-outline-light mx-1">Dimensional Manipulation</a>
                <a href="/shop?category6=6" class="btn btn-outline-light mx-1">Biological Powers</a>
                <a href="/shop?category7=7" class="btn btn-outline-light mx-1">Invisibility</a>
                <a href="/shop?category8=8" class="btn btn-outline-light mx-1">Nature-Based Powers</a>
                <a href="/shop?category9=9" class="btn btn-outline-light mx-1">Memory and Knowledge</a>
              </div>
            </div>
            <button title="Scroll Right" class="btn btn-outline-light btn-sm scroll-right">
              <i class="fas fa-chevron-right"></i>
            </button>
          </div>
        </div>
      </nav>
    </nav>