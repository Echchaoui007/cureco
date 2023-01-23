<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
  <div class="container">

    <a class="navbar-brand" href="<?php echo URLROOT; ?>"><?php echo SITENAME; ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <a class="nav-link" href="<?php echo URLROOT; ?>">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo URLROOT; ?>/pages/gallery">Gallery</a>
      </li>
    </ul>
    
    <ul class="navbar-nav ml-auto">
      <?php if (isset($_SESSION['user_id'])) : ?>
        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            User
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/posts/dashboard">Dashboard</a>
            <li class="nav-item">
              <a class="dropdown-item" href="<?php echo URLROOT; ?>/users/logout">Logout</a>
            </li>
          </div>
</div>

<?php else : ?>
  
  <div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      User
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
      <li class="nav-item ">
        <a class="dropdown-item" href="<?php echo URLROOT; ?>/users/register">Register</a>
    </li>
    <li class="nav-item">
      <a class="dropdown-item" href="<?php echo URLROOT; ?>/users/login">Login</a>
    </li>
  </div>
</div>
<?php endif; ?>
</ul>
</div>
</div>
</nav>