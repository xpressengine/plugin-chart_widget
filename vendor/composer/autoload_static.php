<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitae4a9d0933074749c1ca22073ef17048
{
    public static $prefixLengthsPsr4 = array (
        'X' => 
        array (
            'Xpressengine\\Plugins\\ChartWidget\\' => 33,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Xpressengine\\Plugins\\ChartWidget\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Xpressengine\\Plugins\\ChartWidget\\Skins\\WidgetSkin' => __DIR__ . '/../..' . '/skins/widget/WidgetSkin.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitae4a9d0933074749c1ca22073ef17048::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitae4a9d0933074749c1ca22073ef17048::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitae4a9d0933074749c1ca22073ef17048::$classMap;

        }, null, ClassLoader::class);
    }
}
