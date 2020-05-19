<?php require APP_ROOT . '/views/layout/header.php'; ?>
  <div class="row">
    <div class="col-md-6 mx-auto">
      <div class="card card-body bg-light mt-5">
        <?php flashMessage('flash_message'); ?>
        <h2>Créer un compte</h2>
        <p>Remplissez ce formulaire avec vos données</p>
        <form action="<?php echo URL_ROOT; ?>/users/register" method="post" name="registerForm">
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(generateCSRFToken('registerForm')); ?>"/>
          <div class="form-group">
            <label for="name">Nom : <sup>*</sup></label>
            <input type="text" name="name" class="form-control form-control-lg <?php echo (!empty($data['name_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($data['name']); ?>">
            <span class="invalid-feedback"><?php echo htmlspecialchars($data['name_error']); ?></span>
          </div>
          <div class="form-group">
            <label for="email">Email: <sup>*</sup></label>
            <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($data['email']); ?>">
            <span class="invalid-feedback"><?php echo htmlspecialchars($data['email_error']); ?></span>
          </div>
          <div class="form-group">
            <label for="password">Mot de passe: <sup>*</sup></label>
            <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($data['password_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($data['password']); ?>">
            <span class="invalid-feedback"><?php echo htmlspecialchars($data['password_error']); ?></span>
          </div>
          <div class="form-group">
            <label for="confirm_password">Confirmation mot de passe: <sup>*</sup></label>
            <input type="password" name="confirm_password" class="form-control form-control-lg <?php echo (!empty($data['confirm_password_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($data['confirm_password']); ?>">
            <span class="invalid-feedback"><?php echo htmlspecialchars($data['confirm_password_error']); ?></span>
          </div>

          <div class="row">
            <div class="col">
              <input type="submit" value="Enregistrement" class="btn btn-primary btn-block">
            </div>
            <div class="col">
              <a href="<?php echo URL_ROOT; ?>/users/connect" class="btn btn-light btn-block">Vous avez un compte ? Connexion</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php require APP_ROOT . '/views/layout/footer.php'; ?>