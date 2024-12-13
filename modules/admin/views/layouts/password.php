<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

                <?= $content ?>


    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage();