<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc94282066b37db717bd33a803010a46a
{
    public static $prefixLengthsPsr4 = array (
        't' => 
        array (
            'think\\composer\\' => 15,
            'think\\' => 6,
        ),
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'think\\composer\\' => 
        array (
            0 => __DIR__ . '/..' . '/topthink/think-installer/src',
        ),
        'think\\' => 
        array (
            0 => __DIR__ . '/../..' . '/thinkphp/library/think',
        ),
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/application',
        ),
    );

    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'PHPExcel' => 
            array (
                0 => __DIR__ . '/..' . '/phpoffice/phpexcel/Classes',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc94282066b37db717bd33a803010a46a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc94282066b37db717bd33a803010a46a::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitc94282066b37db717bd33a803010a46a::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
