<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use app\assets\BootstrapIconsAsset;
use yii\widgets\Pjax;

// регистрируем иконки
BootstrapIconsAsset::register($this);

AppAsset::register($this);


$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>



<?php
\yii\bootstrap5\Modal::begin([
    'id' => 'mainModal',
    'size' => 'modal-lg',
]);
echo "<div id='modalContent'></div>";
\yii\bootstrap5\Modal::end();
?>
<?php
\yii\bootstrap5\Modal::begin([
    'id' => 'mainModalSmall',
    'size' => 'modal-sm',
    'headerOptions' => ['id' => 'modalHeader'],
]);
//echo "<div id='modalContent'>Поиск ...</div>";
echo '<div id="modalContent"></div>';
\yii\bootstrap5\Modal::end();
?>




<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-light bg-light  fixed-top']
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
//            ['label' => 'Главная', 'url' => ['/site'], 'visible' => Yii::$app->user->identity->isAdmin()],
            //['label' => 'Проекты', 'url' => ['/admin/projects']],
            ['label' => 'Организации', 'url' => ['/admin/organizations'], 'visible' => Yii::$app->user->identity->isAdmin()],
            ['label' => 'Пользователи', 'url' => ['/admin/user/index'], 'visible' => Yii::$app->user->identity->isAdmin()],
            ['label' => 'Группы', 'url' => ['/admin/groups/index'], 'visible' => Yii::$app->user->identity->isAdmin()],
            ['label' => 'Пароли', 'url' => ['/admin/passwords/index'], 'visible' => Yii::$app->user->identity->isAdmin()],
            ['label' => 'Сервисы', 'url' => ['/admin/service/index'], 'visible' => Yii::$app->user->identity->isAdmin()],
            [
                'label' => Yii::$app->user->identity->username,
                'items' => [
//                    [
//                        'label' => 'Профиль' ,
//                        'url' => ['/user/profile/index'],
//                    ],
                    '<div class="dropdown text-end"></div>',
                    [
                        'label' => 'Выйти',
                        'url' => ['/site/logout'],
                        'linkOptions' => ['data-method' => 'post']
                    ],
                ],
            ],


//            Yii::$app->user->isGuest
//                ? ['label' => 'Login', 'url' => ['/site/login']]
//                : '<li class="nav-item">'
//                . Html::beginForm(['/site/logout'])
//                . Html::submitButton(
//                    'Выйти  (' . Yii::$app->user->identity->username . ')',
//                    ['class' => 'nav-link btn btn-link logout']
//                )
//                . Html::endForm()
//                . '</li>'
        ]
    ]);
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget([
                'homeLink' => ['label' => 'PassMGR ', 'url' => '/'],
                    'links' => $this->params['breadcrumbs']
            ]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<?php Pjax::begin(['id' => 'pjaxModalUniversal']); ?><?php Pjax::end(); ?>



<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; PassMGR <?= date('Y') ?></div>
            <div class="col-md-6 text-center text-md-end">Менеджер паролей</div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
