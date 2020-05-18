<?php
declare(strict_types=1);

/**
 * BASE CONTROLLER
 * Class Controller
 */
class Controller
{
    /**
     * @param string $model
     * @return mixed
     */
    public function loadModel(string $model)
    {
        require_once '../app/models/' . $model . '.php';

        return new $model();
    }

    /**
     * @param string $view
     * @param array $data
     * @throws ErrorException
     */
    public function loadView(string $view, array $data = [])
    {
        if (file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        } else {
            throw new ErrorException("La vue " . $view . " n'existe pas");
          }
      }
  }
