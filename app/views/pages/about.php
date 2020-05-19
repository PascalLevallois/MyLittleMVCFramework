<?php require APP_ROOT . '/views/layout/header.php'; ?>
  <h1><?php echo htmlspecialchars($data['title']); ?></h1>
  <p><?php echo htmlspecialchars($data['description']); ?></p>
<?php require APP_ROOT . '/views/layout/footer.php'; ?>