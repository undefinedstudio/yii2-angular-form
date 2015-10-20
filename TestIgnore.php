<?php

namespace undefinedstudio\yii2\angularform\test;

class TestIgnore
{
    public static function postUpdate()
    {
        echo getcwd();
    }

    public static function postPackageInstall()
    {
        echo getcwd();
    }
}