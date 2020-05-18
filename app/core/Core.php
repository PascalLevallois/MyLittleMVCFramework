<?php
declare(strict_types = 1);

/**
 * Class Core
 * Create URL & load Core Controller
 * URL Formet : /controller/method/params
 */
  class Core
  {
      /**
       * @var mixed|string
       */
      protected $currentController = 'Pages';
      /**
       * @var mixed|string
       */
      protected $currentMethod = 'index';
      /**
       * @var array|false|string[]
       */
      protected $params = [];

      /**
       * Core constructor.
       */
      public function __construct()
      {
          $url = $this->getUrl();
          if (empty($url)) {
              $url = ['', ''];
          }

          if (file_exists('../app/controllers/' . ucwords($url[0]) . 'Controller.php')) {
              $this->currentController = ucwords($url[0]). 'Controller';
              unset($url[0]);
          } else {
              $this->currentController = ucwords($this->currentController) . 'Controller';
          }

          require_once '../app/controllers/'. $this->currentController . '.php';

          $this->currentController = new $this->currentController();

          if (isset($url[1])) {
              if (method_exists($this->currentController, $url[1])) {
                  $this->currentMethod = $url[1];
                  unset($url[1]);
              }
          }

          $this->params = $url ? array_values($url) : [];

          call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
      }

      /**
       * @return false|string[]
       */
      public function getUrl()
      {
          if (isset($_GET['url'])) {
              $url = rtrim($_GET['url'], '/');
              $url = filter_var($url, FILTER_SANITIZE_URL);
              $url = explode('/', $url);

              return $url;
          }
      }
  }
