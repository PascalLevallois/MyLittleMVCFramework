<?php

/**
 * Class PagesController
 */
class PagesController extends Controller
{
    /**
     * PagesController constructor.
     */
    public function __construct()
    {
    }

    /**
     * @throws ErrorException
     */
    public function index()
    {
        $data = [
            'title' => 'My Little MVC Framework',
            'description' => "Une simple demonstration d'un squelette de Framework MVC",
        ];

        $this->loadView('pages/index', $data);
    }

    /**
     * @throws ErrorException
     */
    public function about()
    {
        $data = [
            'title' => 'A propos',
            'description' => 'Application de démonstration'
        ];

        $this->loadView('pages/about', $data);
    }
}
