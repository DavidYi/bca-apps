<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0714cbd9d55ba6c5796092dcb3fb4194
{
    public static $files = array (
        '3f8bdd3b35094c73a26f0106e3c0f8b2' => __DIR__ . '/../..' . '/lib/SendGrid.php',
        '9dda55337a76a24e949fbcc5d905a2c7' => __DIR__ . '/../..' . '/lib/helpers/mail/Mail.php',
    );

    public static $prefixesPsr0 = array (
        'S' => 
        array (
            'SendGrid' => 
            array (
                0 => __DIR__ . '/..' . '/sendgrid/php-http-client/lib',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit0714cbd9d55ba6c5796092dcb3fb4194::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
