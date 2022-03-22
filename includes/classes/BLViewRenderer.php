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
class BLViewRenderer {
    private FilesystemLoader $loader;
    private Environment $twig;
    private static array $instances = [];

    /**
     * Page constructor.
     *
     * @throws LoaderError
     */
    private function __construct() {
        $this->loader = new FilesystemLoader($GLOBALS['twig_template_dir']);
        $this->twig = new Environment($this->loader);
    }

    /**
     * Add Twig template paths.
     *
     * @param string
     * @return void
     * @throws LoaderError
     */
    public function addPath($path, $namespace) {
        $this->loader->addPath($path, $namespace);
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

    protected function __clone() {
    }

    /**
     * Prevent restoring.
     *
     * @throws Exception
     */
    public function __wakeup() {
        throw new Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance(): BLViewRenderer {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }
}
