<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit05c0cd243ed2a5b00b7e2e62d5000bba
{
    public static $prefixesPsr0 = array (
        'D' => 
        array (
            'Dropbox' => 
            array (
                0 => __DIR__ . '/..' . '/dropbox/dropbox-sdk/lib',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit05c0cd243ed2a5b00b7e2e62d5000bba::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
