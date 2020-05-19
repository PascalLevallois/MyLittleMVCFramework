<?php

/**
 * BASE CONTROLLER
 * Class AbstractController
 */
abstract class AbstractController
{

    /**
     * Route for Controller
     * @param string $page
     */
    public function route(string $page)
    {

    }

    /**
     * Load Models
     * @param string $model
     * @return mixed
     */
    public function loadModel(string $model)
    {
        require_once DIR_MODELS . $model . EXTENSION;

        return new $model();
    }

    /**
     * Render View
     * @param string $view
     * @param array $data
     * @throws ErrorException
     */
    public function render(string $view, array $data = [])
    {
        if (file_exists(DIR_VIEWS. $view . EXTENSION)) {
            require_once DIR_VIEWS . $view . EXTENSION;
        } else {
            throw new ErrorException("La vue " . $view . " n'existe pas");
        }
    }
}
