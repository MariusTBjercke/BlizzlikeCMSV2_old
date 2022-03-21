<?php

/**
 * Bem Twig functions
 */
class Bem {
    public const NS_SEPARATOR = '-';
    public const ELEMENT_SEPARATOR = '__';
    public const MODIFIER_SEPARATOR = '_';

    public const NS_OBJECT = 'o';
    public const NS_COMPONENT = 'c';
    public const NS_JS = 'js';

    /**
     * Twig function to easily create BEM class names
     *
     * @param string $blockName The block name.
     * @param string|null $element The element name (if any).
     * @param string[] $modifiers Modifier names that will be added to the block and element.
     * @param boolean $createJsClasses Set to true if this should also generate js-prefixed classes.
     * @return string
     */
    public static function bemx(string $blockName, ?string $element = null, array $modifiers = [], bool $createJsClasses = false): string {
        $classes = [];

        if (empty($element)) {
            $baseClass = $blockName;
        } else {
            $baseClass = $blockName . self::ELEMENT_SEPARATOR . $element;
        }

        $classes[] = $baseClass;

        foreach ($modifiers as $modifier) {
            if (!empty(trim($modifier))) {
                $classes[] = $baseClass . self::MODIFIER_SEPARATOR . $modifier;
            }
        }

        //$createJsClasses = true;
        if ($createJsClasses) {
            $jsClasses = [];
            foreach ($classes as $class) {
                $jsClasses[] = self::replaceClassNamespace($class, self::NS_JS);
            }

            $classes = array_merge($classes, $jsClasses);
        }


        return implode(' ', $classes);
    }

    /**
     * Replace the namespace of a css class with a new one
     *
     * @param string $className The class name.
     * @param string $newNamespace The new namespace.
     * @return string
     */
    private static function replaceClassNamespace(string $className, string $newNamespace): string {
        $pattern = [
            '/^' . self::NS_COMPONENT . self::NS_SEPARATOR . '/',
            '/^' . self::NS_OBJECT . self::NS_SEPARATOR . '/',
            '/^' . self::NS_JS . self::NS_SEPARATOR . '/',
        ];
        $replacement = $newNamespace . self::NS_SEPARATOR;
        $subject = $className;
        return preg_replace($pattern, $replacement, $subject);
    }
}
