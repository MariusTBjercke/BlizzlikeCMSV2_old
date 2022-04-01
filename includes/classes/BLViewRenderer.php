<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

/**
 * BlizzlikeCMS View Renderer
 * Class for rendering views/pages.
 **/
class BLViewRenderer extends Singleton {
    private FilesystemLoader $loader;
    private Environment $twig;
    private bool $requiresAuth;
    private array $data;

    /**
     * Page constructor.
     *
     */
    protected function __construct() {
        parent::__construct();
        $this->loader = new FilesystemLoader($_SERVER['DOCUMENT_ROOT'] . $_ENV['TWIG_TEMPLATES_PATH']);
        $this->twig = new Environment($this->loader);
        $this->requiresAuth = false;
    }

    /**
     * Add Twig template paths.
     *
     * @param $path
     * @param $namespace
     * @return void
     */
    public function addPath($path, $namespace) {
        try {
            $this->loader->addPath($path, $namespace);
        } catch (LoaderError $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    /**
     * Render view/page.
     *
     * @param string $templateName Name of template to be rendered (without extension).
     * @return void
     */
    public function render(string $templateName) {
        try {
            if ($this->requiresAuth) {
                if (!isset($_SESSION['user'])) {
                    echo $this->twig->render('index.html.twig', $this->getData());
                } else {
                    echo $this->twig->render($templateName . '.html.twig', $this->getData());
                }
            } else {
                echo $this->twig->render($templateName . '.html.twig', $this->getData());
            }
        } catch (LoaderError | RuntimeError | SyntaxError $e) {
            echo "Error rendering: " . $e->getMessage();
        }
    }

    /**
     * Add a global Twig function.
     *
     * @param string $name Function name.
     * @param callable $function Function to be called.
     * @return void
     */
    public function addGlobalFunction(string $name, callable $function) {
        $this->twig->addFunction(new TwigFunction($name, $function));
    }

    /**
     * Get authentication requirement status.
     *
     * @return bool
     */
    public function getAuth() {
        return $this->requiresAuth;
    }

    /**
     * Set authentication requirement status.
     *
     * @param bool $auth Authentication requirement status.
     */
    public function setAuth(bool $auth) {
        $this->requiresAuth = $auth;
    }

    public function setData(array $data) {
        $this->data = $data;
    }

    public function getData(): array {
        return $this->data;
    }
}
