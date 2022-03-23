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

    /**
     * Page constructor.
     *
     */
    protected function __construct() {
        parent::__construct();
        $this->loader = new FilesystemLoader($GLOBALS['twig_template_dir']);
        $this->twig = new Environment($this->loader);
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
            echo $this->twig->render($templateName . '.html.twig', $GLOBALS['data']);
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
}
