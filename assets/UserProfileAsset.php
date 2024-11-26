<?php
//declare(strict_types=1);

namespace app\assets;

//use common\base\ModuleAssetBundle;
use yii\web\AssetBundle;

/**
 * Class UserProfileAsset
 * @author Kovalev Roman <epoxxid@gmail.com>
 */
class UserProfileAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
//    public function init(): void
//    {
//        parent::init();
//        $this->css[] = 'css/user-profile.css';
//
//    }
    public $css = [
        'css/user-profile.css',
    ];
}
