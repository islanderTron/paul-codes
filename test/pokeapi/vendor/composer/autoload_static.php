<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit00bbd87908b3d687afc924d767c825c5
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PokePHP\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PokePHP\\' => 
        array (
            0 => __DIR__ . '/..' . '/danrovito/pokephp/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit00bbd87908b3d687afc924d767c825c5::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit00bbd87908b3d687afc924d767c825c5::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
