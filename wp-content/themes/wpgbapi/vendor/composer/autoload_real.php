<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitce6d552c1bd3d1e6ac1f26d4e40830bd
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInitce6d552c1bd3d1e6ac1f26d4e40830bd', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitce6d552c1bd3d1e6ac1f26d4e40830bd', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitce6d552c1bd3d1e6ac1f26d4e40830bd::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
