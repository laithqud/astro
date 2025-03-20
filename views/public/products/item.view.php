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
  <link rel="stylesheet" href="/public/css/style.css" />
  <link rel="stylesheet" href="/public/css/product.css">


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



  <div class="container py-3">
    <div class="row ">
      <div class="col-md-6 text-center">
        <div class="product-image-container">
          <img src="/public/images/products/<?php echo $product['image_url']; ?>"
            alt="Elixir Bottle" class="product-image">
        </div>

      </div>

      <div class="col-md-6">
        <div class="card1">
          <h2><?php echo $product['name']; ?></h2>
          <p class="text-warning"><?php echo $product['category']; ?></p>
          <p>⭐⭐⭐⭐⭐ (128 reviews)</p>
          <h3> <?php echo $product['price']; ?> ASTRO</h3>
          <!-- <div class="d-flex align-items-center my-3">
                        <button class="btn btn-outline-light">-</button>
                        <span class="mx-3">1</span>
                        <button class="btn btn-outline-light">+</button>
                    </div> -->
          <form class="add-cart-form" id="add-cart-form-<?php echo $product['id']; ?>" action="/cart/add/<?php echo $product['id']; ?>" method="POST">
            <button type="submit" class="btn btn-primary w-50">
              <span>Add to Cart</span>
            </button>
          </form>
          <div class="info-section mt-3">
            <div class="info-box">
              <i class="fa-solid fa-brain text-purple-400 mb-2"></i>
              <p class="mb-1"><strong>Power Level</strong></p>
              <p><?php echo $product['power_level']; ?></p>
            </div>
            <div class="info-box">
              <i class="fa-solid fa-clock text-purple-400 mb-1"></i>
              <p class="mb-1"><strong>Duration</strong></p>
              <p><?php echo $product['duration']; ?> Earth Hours</p>

            </div>
            <?php if ($product['stock'] <= 3 && $product['stock'] > 0): ?>
              <div class="info-box">
                <i class="fa-solid fa-box-open text-purple-400 mb-2"></i>
                <p class="mb-1"><strong>Harry Up, Only </strong></p>
                <p><?php echo $product['stock']; ?> left </p>
              </div>
            <?php elseif ($product['stock'] == 0): ?>
              <div class="info-box">
                <i class="fa-solid fa-box-open text-purple-400 mb-2"></i>
                <p class="mb-1"><strong>Out of Stock</strong></p>
              </div>
            <?php endif; ?>
          </div>
          <p class="mt-3"><?php echo $product['description']; ?></p>

        </div>
      </div>
    </div>
  </div>


  <?php include_once('./views/layout/public/footer.php'); ?>





  <script src="/public/js/navbar.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>