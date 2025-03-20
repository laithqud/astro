<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="shortcut icon" href="/public/images/fav.png" type="image/x-icon">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Shop</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet" />

  <link rel="stylesheet" href="public/css/shop.css" />
  <link rel="stylesheet" href="public/css/style.css" />


</head>

<body style="margin-top: 110px;">

  <?php include_once 'views/layout/public/header.php'; ?>


  <div class="shop-bg py-3">

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


    <!-- products -->

    <div class="container mt-5">
      <div class="row">
        <!-- Filter Section -->
        <div class="col-md-3">

          <div class="filter-section">
            <div class="d-flex justify-content-between align-items-center">
              <h5>Filters</h5> <a href="/shop" class="ms-2 text-decoration-none">Reset</a>
            </div>
            <form method="get" action="/shop">
              <!-- Search Input -->
              <div class="mb-3">
                <label for="searchInput" class="form-label">Search</label>
                <input type="text" id="searchInput" name="search" class="form-control" placeholder="Search products..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
              </div>
              <!-- Price Range -->
              <div class="mb-3">
                <label for="priceRange" class="form-label">Price Range</label>
                <input type="range" class="form-range" id="priceRange" name="priceRange" min="0" max="350" step="10" value="<?php echo isset($_GET['priceRange']) ? htmlspecialchars($_GET['priceRange']) : '350'; ?>">
                <span id="priceValue">$0 - <?php echo isset($_GET['priceRange']) ? htmlspecialchars($_GET['priceRange']) : '350'; ?></span>
              </div>
              <!-- Categories -->
              <div class="mb-3">
                <label class="form-label">Categories</label>
                <div>
                  <?php
                  $categories = [
                    1 => 'Physical',
                    2 => 'Elemental',
                    3 => 'Mental and Psychic',
                    4 => 'Transformation',
                    5 => 'Dimensional Manipulation',
                    6 => 'Biological Powers',
                    7 => 'Invisibility',
                    8 => 'Nature-Based Powers',
                    9 => 'Memory and Knowledge'
                  ];
                  foreach ($categories as $id => $label) {
                    $checked = isset($_GET["category$id"]) ? 'checked' : '';
                    echo "<div class='form-check'>
                      <input class='form-check-input' type='checkbox' value='$id' id='category$id' name='category$id' $checked>
                      <label class='form-check-label' for='category$id'>$label</label>
                    </div>";
                  }
                  ?>
                </div>
              </div>
              <!-- Duration -->
              <div class="mb-3">
                <label for="durationRange" class="form-label">Duration (1-10)</label>
                <input type="range" class="form-range" id="durationRange" name="duration" min="0" max="10" step="1" value="<?php echo isset($_GET['duration']) ? htmlspecialchars($_GET['duration']) : '0'; ?>">
                <span id="durationValue"><?php echo isset($_GET['duration']) && $_GET['duration'] !== '0' ? htmlspecialchars($_GET['duration']) : 'Pick Duration'; ?></span>
              </div>
              <!-- Power Level -->
              <div class="mb-3">
                <label class="form-label">Power Level</label>
                <div>
                  <?php
                  $powerLevels = ['Low', 'Medium', 'High'];
                  foreach ($powerLevels as $level) {
                    $checked = isset($_GET['powerLevel']) && $_GET['powerLevel'] === $level ? 'checked' : '';
                    echo "<div class='form-check'>
                      <input class='form-check-input' type='radio' name='powerLevel' value='$level' id='power$level' $checked>
                      <label class='form-check-label' for='power$level'>$level</label>
                    </div>";
                  }
                  ?>
                </div>

              </div>
              <button class="btn btn-primary apply w-100" type="submit">Apply Filters</button>
            </form>
          </div>
        </div>
        <!-- Product Listing -->

        <div class="col-md-9 cards ">
          <div class="row row-cols-1 row-cols-md-3 g-3 justify-content-around align-items-center " id="productList">
            <!-- Product Cards -->

            <?php if (empty($products)): ?>
              <p>No products available.</p>
            <?php else: ?>
              <?php foreach ($products as $product): ?>
                <?php include('./views/components/product.view.php'); ?>
              <?php endforeach; ?>
            <?php endif; ?>



          </div>

          <?php if ($totalPages > 1): ?>
            <nav aria-label="Page navigation ">
              <ul class="pagination justify-content-center m-5 ">
                <!-- Previous Page Link -->
                <li class="page-item <?php echo ($currentPage <= 1) ? 'disabled' : ''; ?>">
                  <a class="page-link" href="<?php echo $_SERVER['REQUEST_URI'] . (strpos($_SERVER['REQUEST_URI'], '?') !== false ? '&' : '?') . 'page=' . ($currentPage - 1); ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>

                <!-- First Page Link -->
                <?php if ($currentPage > 3): ?>
                  <li class="page-item">
                    <a class="page-link" href="<?php echo $_SERVER['REQUEST_URI'] . (strpos($_SERVER['REQUEST_URI'], '?') !== false ? '&' : '?') . 'page=1'; ?>">1</a>
                  </li>
                  <?php if ($currentPage > 4): ?>
                    <li class="page-item disabled">
                      <span class="page-link">...</span>
                    </li>
                  <?php endif; ?>
                <?php endif; ?>

                <!-- Page Links -->
                <?php
                $startPage = max(1, $currentPage - 2);
                $endPage = min($totalPages, $currentPage + 2);

                for ($page = $startPage; $page <= $endPage; $page++):
                ?>
                  <li class="page-item <?php echo ($page == $currentPage) ? 'active' : ''; ?>">
                    <a class="page-link" href="<?php echo $_SERVER['REQUEST_URI'] . (strpos($_SERVER['REQUEST_URI'], '?') !== false ? '&' : '?') . 'page=' . $page; ?>">
                      <?php echo $page; ?>
                    </a>
                  </li>
                <?php endfor; ?>

                <!-- Last Page Link -->
                <?php if ($currentPage < $totalPages - 2): ?>
                  <?php if ($currentPage < $totalPages - 3): ?>
                    <li class="page-item disabled">
                      <span class="page-link">...</span>
                    </li>
                  <?php endif; ?>
                  <li class="page-item">
                    <a class="page-link" href="<?php echo $_SERVER['REQUEST_URI'] . (strpos($_SERVER['REQUEST_URI'], '?') !== false ? '&' : '?') . 'page=' . $totalPages; ?>">
                      <?php echo $totalPages; ?>
                    </a>
                  </li>
                <?php endif; ?>

                <!-- Next Page Link -->
                <li class="page-item <?php echo ($currentPage >= $totalPages) ? 'disabled' : ''; ?>">
                  <a class="page-link" href="<?php echo $_SERVER['REQUEST_URI'] . (strpos($_SERVER['REQUEST_URI'], '?') !== false ? '&' : '?') . 'page=' . ($currentPage + 1); ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
              </ul>
            </nav>
          <?php endif; ?>

        </div>
      </div>
    </div>

  </div>

  <?php include_once 'views/layout/public/footer.php'; ?>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Price Range Display
    const priceRange = document.getElementById('priceRange');
    const priceValue = document.getElementById('priceValue');
    priceRange.addEventListener('input', () => {
      priceValue.textContent = `$0 - ${priceRange.value}`;
    });

    // Duration Range Display
    const durationRange = document.getElementById('durationRange');
    const durationValue = document.getElementById('durationValue');
    durationRange.addEventListener('input', () => {
      if (durationRange.value === '0') {
        durationValue.textContent = 'Pick Duration';
      } else {
        durationValue.textContent = durationRange.value;
      }

    });
  </script>



  <script src="public/js/navbar.js"></script>

  <script>
    $(".buy").click(function() {
      $(".bottom").addClass("clicked");
    });

    $(".remove").click(function() {
      $(".bottom").removeClass("clicked");
    });
  </script>
</body>

</html>