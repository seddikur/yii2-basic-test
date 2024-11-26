<?php

namespace app\modules\profile;

use app\modules\profile\helpers\UserProfileUrlHelper;
//use backend\modules\tasks\helpers\TasksUrlHelper;
use yii\base\Module as BaseModule;

/**
 * Class Module
 */
class Module extends BaseModule
{
    /** @var string */
    public $defaultRoute = 'view';

    /** @var UserProfileUrlHelper */
    public $urlHelper;


    /**
     * Module constructor.
     * @param string               $id
     * @param null|BaseModule      $parent
     * @param UserProfileUrlHelper $urlHelper
     * @param array                $config
     */
    public function __construct(
        string $id,
        ?BaseModule $parent = null,
        UserProfileUrlHelper $urlHelper,
        array $config = []
    )
    {
        parent::__construct($id, $parent, $config);
        $this->urlHelper = $urlHelper;
    }
}
