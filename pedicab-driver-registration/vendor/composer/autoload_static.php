<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit71354e8028321a09440e02f9b5f36729
{
    public static $files = array (
        '79f66bc0a1900f77abe4a9a299057a0a' => __DIR__ . '/..' . '/starkbank/ecdsa/src/ellipticcurve.php',
    );

    public static $prefixLengthsPsr4 = array (
        's' => 
        array (
            'setasign\\Fpdi\\' => 14,
        ),
        'S' => 
        array (
            'SendGrid\\Stats\\' => 15,
            'SendGrid\\Mail\\' => 14,
            'SendGrid\\Helper\\' => 16,
            'SendGrid\\EventWebhook\\' => 22,
            'SendGrid\\Contacts\\' => 18,
            'SendGrid\\' => 9,
        ),
        'E' => 
        array (
            'Endroid\\QrCode\\' => 15,
        ),
        'D' => 
        array (
            'DASPRiD\\Enum\\' => 13,
        ),
        'B' => 
        array (
            'BaconQrCode\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'setasign\\Fpdi\\' => 
        array (
            0 => __DIR__ . '/..' . '/setasign/fpdi/src',
        ),
        'SendGrid\\Stats\\' => 
        array (
            0 => __DIR__ . '/..' . '/sendgrid/sendgrid/lib/stats',
        ),
        'SendGrid\\Mail\\' => 
        array (
            0 => __DIR__ . '/..' . '/sendgrid/sendgrid/lib/mail',
        ),
        'SendGrid\\Helper\\' => 
        array (
            0 => __DIR__ . '/..' . '/sendgrid/sendgrid/lib/helper',
        ),
        'SendGrid\\EventWebhook\\' => 
        array (
            0 => __DIR__ . '/..' . '/sendgrid/sendgrid/lib/eventwebhook',
        ),
        'SendGrid\\Contacts\\' => 
        array (
            0 => __DIR__ . '/..' . '/sendgrid/sendgrid/lib/contacts',
        ),
        'SendGrid\\' => 
        array (
            0 => __DIR__ . '/..' . '/sendgrid/php-http-client/lib',
        ),
        'Endroid\\QrCode\\' => 
        array (
            0 => __DIR__ . '/..' . '/endroid/qr-code/src',
        ),
        'DASPRiD\\Enum\\' => 
        array (
            0 => __DIR__ . '/..' . '/dasprid/enum/src',
        ),
        'BaconQrCode\\' => 
        array (
            0 => __DIR__ . '/..' . '/bacon/bacon-qr-code/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'I' => 
        array (
            'Imagick' => 
            array (
                0 => __DIR__ . '/..' . '/calcinai/php-imagick/src',
            ),
        ),
    );

    public static $classMap = array (
        'BaseSendGridClientInterface' => __DIR__ . '/..' . '/sendgrid/sendgrid/lib/BaseSendGridClientInterface.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'FPDF' => __DIR__ . '/..' . '/setasign/fpdf/fpdf.php',
        'SendGrid' => __DIR__ . '/..' . '/sendgrid/sendgrid/lib/SendGrid.php',
        'TwilioEmail' => __DIR__ . '/..' . '/sendgrid/sendgrid/lib/TwilioEmail.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit71354e8028321a09440e02f9b5f36729::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit71354e8028321a09440e02f9b5f36729::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit71354e8028321a09440e02f9b5f36729::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit71354e8028321a09440e02f9b5f36729::$classMap;

        }, null, ClassLoader::class);
    }
}
