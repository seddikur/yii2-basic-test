<?php

namespace app\assets;

/**
 * Подключение
 * composer require npm-asset/bootstrap-icons
 * https://icons.getbootstrap.su/
 */

class BootstrapIconsAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@npm/bootstrap-icons';
    public $css = ['font/bootstrap-icons.css'];
}