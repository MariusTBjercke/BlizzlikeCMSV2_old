<?php

/**
 * Redirect Twig function.
 */
class BLTwigRedirect {
    /**
     * Twig function to redirect to a page.
     *
     * @param string $template The template name that you want to redirect to.
     * @return void
     */
    public static function redirect(string $template): void {
        header('Location: index.php?page=' . $template);
    }

    /**
     * Twig function to redirect to home if logged in.
     */
    public static function redirectIfLoggedIn(): void {
        if (isset($_SESSION['user'])) {
            header('Location: index.php?page=home');
        }
    }
}
