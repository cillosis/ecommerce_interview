<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd0b087c7cf9e652ef6cc8794dc5ce713
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd0b087c7cf9e652ef6cc8794dc5ce713::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd0b087c7cf9e652ef6cc8794dc5ce713::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}