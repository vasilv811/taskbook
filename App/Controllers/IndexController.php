<?php


namespace App\Controllers;


use Core\Renderer;
use Core\Http\Response;

class IndexController
{
    private Renderer $renderer;

    /**
     * IndexController constructor.
     * @param Renderer $renderer
     */
    public function __construct(Renderer $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * @return Response
     */
    public function getMainPage(): Response
    {
        $content = $this->renderer->generate('/default.php');
        return new Response($content);
    }
}