<?php

/**
 * Class PagestController
 */
class PagesController extends AbstractController
{
    /**
     * PagestController constructor.
     */
    public function __construct()
    {
    }

    /**
     * Call the first method
     * @param string $page
     * @throws Exception
     */
    public function route(string $page)
    {
        if (!$page) {
            $page = 'index';
        }
        try {
            $this->$page();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * HomePage
     * @throws ErrorException
     */
    public function index()
    {
        $data = [
            'title' => 'My Little MVC Framework',
            'description' => "Une simple démonstration d'un squelette de Framework MVC",
        ];

        $this->render('pages/index', $data);
    }

    /**
     * About Page
     * @throws ErrorException
     */
    public function about()
    {
        $data = [
            'title' => 'A propos',
            'description' => 'Application de démonstration'
        ];

        $this->render('pages/about', $data);
    }
}
