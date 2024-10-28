<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitb145a38d0504568c0d57da5cd487a152
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

        spl_autoload_register(array('ComposerAutoloaderInitb145a38d0504568c0d57da5cd487a152', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitb145a38d0504568c0d57da5cd487a152', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitb145a38d0504568c0d57da5cd487a152::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}