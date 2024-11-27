<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Passwords $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="passwords-form">
<?php

$password = 'secret';
$hash = '$2y$11$J5WhTKn.OMk.G6O/Wu4keOtkgEPfnLc4jgwAYy/QWXrZgvkqwwDn6';

$algorithm = PASSWORD_BCRYPT;
// bcrypt's cost parameter can change over time as hardware improves
$options = ['cost' => 12];

// Verify stored hash against plain-text password
if (password_verify($password, $hash)) {
    \yii\helpers\VarDumper::dump($password, 10, true);
    // Check if either the algorithm or the options have changed
//    if (password_needs_rehash($hash, $algorithm, $options)) {
//        // If so, create a new hash, and replace the old one
//        $newHash = password_hash($password, $algorithm, $options);
//        \yii\helpers\VarDumper::dump($newHash, 10, true);
//        // Update the user record with the $newHash
//    }

    // Perform the login.
}
// Our password.. the kind of thing and idiot would have on his luggage:
$password_plaintext = "secret";

// Hash it up, fuzzball!
$password_hash = password_hash( $password_plaintext, PASSWORD_DEFAULT, [ 'cost' => 11 ] );
\yii\helpers\VarDumper::dump($password_hash, 10, true);
\yii\helpers\VarDumper::dump(password_get_info( $password_hash ), 10, true);

echo md5("qwe123++");
$password = 'secret';
$salt = '1sJg3hfdf'; // соль - сложная случайная строка
$password = md5($salt . $password); // соленый пароль

\yii\helpers\VarDumper::dump($password, 10, true);
\yii\helpers\VarDumper::dump(crypt($password, $salt), 10, true);

//if (password_verify($password, $hash1)) {
//    echo 'true';
//    // хеш от этого пароля
//} else {
//    echo 'false';
//    // хеш не от этого пароля
//}
//\yii\helpers\VarDumper::dump($hash,10,true);
echo 'Соль';
//\yii\helpers\VarDumper::dump(Yii::$app->user->identity->auth_key, 10, true);

?>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sault')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hash')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->dropDownList(
        \yii\helpers\ArrayHelper::map(\app\models\Users::find()->asArray()->all(), 'id', 'username')
    ); ?>

    <?= $form->field($model, 'user_id')->dropDownList(
        \yii\helpers\ArrayHelper::map(\app\models\Organizations::find()->asArray()->all(), 'id', 'title')
    ); ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
