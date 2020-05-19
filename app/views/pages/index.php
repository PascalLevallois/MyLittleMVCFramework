<?php require APP_ROOT . '/views/layout/header.php'; ?>
  <div class="jumbotron jumbotron-fluid text-center">
    <div class="container">
    <h1 class="display-3"><?php echo htmlspecialchars($data['title']); ?></h1>
    <p class="lead"><?php echo htmlspecialchars($data['description']); ?></p>
    </div>
  </div> 
<?php require APP_ROOT . '/views/layout/footer.php'; ?>
