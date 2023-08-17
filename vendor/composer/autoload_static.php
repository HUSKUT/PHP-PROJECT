<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb9f3d00b0639acd1980c85ce0576c795
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Christiaandames\\PhpPdo\\' => 23,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Christiaandames\\PhpPdo\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb9f3d00b0639acd1980c85ce0576c795::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb9f3d00b0639acd1980c85ce0576c795::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb9f3d00b0639acd1980c85ce0576c795::$classMap;

        }, null, ClassLoader::class);
    }
}