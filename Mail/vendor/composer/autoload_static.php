<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitcb2f3e2f8a74c93c6a0e00f92f3a57a1
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitcb2f3e2f8a74c93c6a0e00f92f3a57a1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitcb2f3e2f8a74c93c6a0e00f92f3a57a1::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
