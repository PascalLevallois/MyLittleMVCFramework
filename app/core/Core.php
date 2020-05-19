<?php

/**
 * Class Core
 * Create URL & load Core AbstractController
 * URL Formet : /controller/method/params
 */
  class Core
  {
      const CONTROLLER = 'Controller';

      /**
       * @var mixed|string
       */
      protected $currentController = 'Pages';
      /**
       * @var mixed|string
       */
      protected $currentMethod = 'route';
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

          if (file_exists(DIR_CONTROLLERS . ucwords($url[0]) . self::CONTROLLER . EXTENSION)) {
              $this->currentController = ucwords($url[0]). self::CONTROLLER;
              unset($url[0]);
          } else {
              $this->currentController = ucwords($this->currentController) . self::CONTROLLER;
          }

          require_once DIR_CONTROLLERS . $this->currentController . EXTENSION;

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
       * Get URL
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
