<?php
namespace  app\modules\profile\controllers;

use app\assets\UserProfileAsset;
use app\models\Users;
use app\modules\profile\Module;
use app\modules\profile\services\UserPermissionService;
use app\modules\profile\services\UserProfileRepository;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Class BaseController
 * @property Module $module
 */
class BaseController extends Controller
{
    /** @var UserProfileRepository */
    protected $repository;
    /** @var UserPermissionService */
    protected $permissionService;

    /**
     * @param string                $id     идентификатор этого контроллера.
     * @param Module                $module модуль, к которому относится этот контроллер.
     * @param UserProfileRepository $repository
     * @param UserPermissionService $permissionService
     * @param array                 $config пары имя-значение, которые будут использоваться для инициализации свойств объекта.
     * @throws \yii\base\InvalidConfigException
     */
    public function __construct(
        string $id,
        Module $module,
        UserProfileRepository $repository,
        UserPermissionService $permissionService,
        array $config = []
    )
    {
        parent::__construct($id, $module, $config);

        $this->getView()->registerAssetBundle(UserProfileAsset::class);
        $this->repository = $repository;
        $this->permissionService = $permissionService;
    }

    /**
     * @param $id
     * @return Users
     * @throws NotFoundHttpException
     */
    protected function findUser($id): Users
    {
        if ($employee = $this->repository->findUsersById($id)) {
            return $employee;
        }
        throw new NotFoundHttpException("Пользователь с ID = $id не существует");
    }
}
