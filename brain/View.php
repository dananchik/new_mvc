<?php


namespace brain;

use mysql_xdevapi\Exception;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once 'vendor/autoload.php';

class View
{

    protected $twig;
    protected $loader;

    function __construct()
    {
        $this->loader = new FilesystemLoader('views');
        $this->twig = new Environment($this->loader, ['cache' => false]);

    }

    function render($template_name, $params = [])
    {
        try {
            $template = $this->twig->load($template_name . '.html');
            echo $template->render($params);
        } catch (Exception $e) {
            print_r($e->getMessage());
        }

    }
}