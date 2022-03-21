<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Lexer;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

/**
 * BlizzlikeCMS View Renderer
 * Class for rendering views/pages.
 **/
class BLViewRenderer {
    private FilesystemLoader $loader;
    private Environment $twig;
    private Lexer $lexer;

    /**
     * Page constructor.
     *
     * @throws LoaderError
     */
    public function __construct() {
        $this->loader = new FilesystemLoader($GLOBALS['templateDir']);
        $this->twig = new Environment($this->loader);
        $this->addGlobalFunction('bem', [Bem::class, 'bemx']);
        $this->lexer = new Lexer($this->twig, [
            // Lexer options
        ]);
        $this->twig->setLexer($this->lexer);
        $this->addPaths();
    }

    /**
     * Add Twig template paths.
     *
     * @return void
     * @throws LoaderError
     */
    private function addPaths() {
        $this->loader->addPath('../assets/templates/layouts/components', 'components');
        $this->loader->addPath('../assets/templates/layouts/grid', 'grid');
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
