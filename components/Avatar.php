<?php

namespace app\components;

use Yii;
use yii\db\ActiveRecord;
use yii\imagine\Image;
use yii\web\UploadedFile;

/**
 * @property ActiveRecord $model
 *
 * Class Avatar
 * У передаваемого объекта предполагается поле в БД `avatar`, где храним только название изображения
 * use in User and Employee
 */
class Avatar
{
    /**
     * @var string
     */
    private $path;
    /**
     * @var ActiveRecord
     */
    private $model;

    /**
     * Avatar constructor.
     * @param $path string путь до папки с аватарками модели.
     * @param $model ActiveRecord
     */
    public function __construct($path, $model)
    {
        $this->path = $path;
        $this->model = $model;
    }

    /**
     * Сохранение аватарки.
     *
     * @return void
     */
    public function save()
    {
        if ($image = UploadedFile::getInstance($this->model, 'avatar')) {
            $this->model->avatar = Yii::$app->security->generateRandomString() . '.' . $image->getExtension();
            $image->saveAs(Yii::getAlias($this->path) . $this->model->avatar);
            if ($this->model->getOldAttribute('avatar')) {
                $this->removeOldAvatar();
            }
            Image::thumbnail(Yii::getAlias($this->path) . $this->model->avatar, 120, 120)
                ->save(Yii::getAlias($this->path . 'thumbs') . DIRECTORY_SEPARATOR . $this->model->avatar, ['quality' => 50]);
        } else {
            if ($this->model->remove_avatar) {
                $this->removeOldAvatar();
                $this->model->avatar = '';
            } else {
                $this->model->avatar = $this->model->getOldAttribute('avatar');
            }
        }
    }

    /**
     * Удаление старой аватарки при загрузке новой.
     *
     * @return void
     */
    private function removeOldAvatar()
    {
        if (file_exists(Yii::getAlias($this->path) . $this->model->getOldAttribute('avatar'))) {
            unlink(Yii::getAlias($this->path) . $this->model->getOldAttribute('avatar'));
        }
        if (file_exists(Yii::getAlias($this->path . 'thumbs') . DIRECTORY_SEPARATOR . $this->model->getOldAttribute('avatar'))) {
            unlink(Yii::getAlias($this->path . 'thumbs') . DIRECTORY_SEPARATOR . $this->model->getOldAttribute('avatar'));
        }
    }

    /**
     * @param $path string  Путь до папки с аватарками.
     * @param $file string  Имя файла аватарки.
     * @return void
     */
    public static function delete($path, $file)
    {
        if (file_exists(Yii::getAlias($path) . $file)) {
            unlink(Yii::getAlias($path) . $file);
        }
        if (file_exists(Yii::getAlias($path . 'thumbs') . DIRECTORY_SEPARATOR . $file)) {
            unlink(Yii::getAlias($path . 'thumbs') . DIRECTORY_SEPARATOR . $file);
        }
    }
}
