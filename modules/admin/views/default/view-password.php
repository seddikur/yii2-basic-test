<?php

/** @var \app\modules\admin\services\PasswordEncryption $view_password */
?>

<div class="row">
    <p class="text-center text-success">
        <?php if ($view_password != null): ?>
            <?= $view_password; ?>
        <?php else: ?>
    <p class="text-center text-danger">
        Пароль отсутствует
    </p>
    <?php endif; ?>
    </p>
</div>

