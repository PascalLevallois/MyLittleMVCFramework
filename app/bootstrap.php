<?php
  // Load Config
  require_once 'config/config.php';

  // Load Helpers
  require_once 'helpers/urlHelper.php';
  require_once 'helpers/sessionHelper.php';
  require_once 'helpers/csrfHelper.php';

  // Autoload Core Class
  spl_autoload_register(function ($className) {
      require_once 'core/' . $className . '.php';
  });
