<div class="sidebar">
  <div class="logo">
    <img src="/public/images/logo.png" alt="logo" width="150" />
  </div>
  <nav>
    <ul>
      <li>
        <a href="/admin/dashboard" <?php echo($_SERVER['REQUEST_URI']) == '/admin/dashboard' ? 'class="active"' : ''; ?>><i class="fas fa-home"></i> Dashboard</a>
      </li>
      <li>
        <a href="/admin/orders" <?php echo($_SERVER['REQUEST_URI']) == '/admin/orders' ? 'class="active"' : ''; ?>><i class="fas fa-shopping-cart"></i> Orders</a>
      </li>
      <li>
        <a href="/admin/users" <?php echo($_SERVER['REQUEST_URI']) == '/admin/users' ? 'class="active"' : ''; ?>><i class="fas fa-users"></i> Users</a>
      </li>
      <li>
        <a href="/admin/admins" 
        <?php echo($_SERVER['REQUEST_URI']) == '/admin/admins' ? 'class="active" ' : ''; ?>
        <?php if (isset($_SESSION['admin']) && $_SESSION['admin']['role'] == 'Admin') { echo 'style="display: none;"'; } ?>
        ><i class="fas fa-user-shield"></i> Admins</a>
      </li>
      <li>
        <a href="/admin/products" 
        <?php echo($_SERVER['REQUEST_URI']) == '/admin/products' ? 'class="active"' : ''; ?>><i class="fas fa-box"></i> Products</a>
      </li>
      <li>
        <a href="/admin/categories" <?php echo($_SERVER['REQUEST_URI']) == '/admin/categories' ? 'class="active"' : ''; ?>><i class="fas fa-list"></i> Categories</a>
      </li>
      <li>
        <a href="/admin/testimonials" <?php echo($_SERVER['REQUEST_URI']) == '/admin/testimonials' ? 'class="active"' : ''; ?>><i class="fas fa-edit"></i> Testimonials</a>
      </li>
    </ul>
  </nav>
  <!-- Bottom Section -->
  <div class="sidebar-bottom">
    <ul>
      <li>
        <a href="/" target="_blank"><i class="fas fa-external-link-alt"></i> Main Site</a>
      </li>
      <li>
        <form action="/admin/logout" method="post" style="display: inline;">
          <button type="submit" class='logout'>
            <a><i class="fas fa-sign-out-alt"></i> Logout</a>
          </button>
        </form>
      </li>
    </ul>
  </div>
</div>