<?php

use common\models\AdsCampaign;
use yii\bootstrap4\Html;
use yii\helpers\Url;

?>
<style>
    .search_result {
        /*position: absolute;*/
        margin-top: -68px;
        top: 100%;
        left: 0;
        border: 1px solid #ddd;
        background: #fff;
        padding: 10px;
        z-index: 9999;
        box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
    }

</style>

<?php

if (!empty(Yii::$app->request->post('search'))) {

    $search = Yii::$app->request->post('search');
//    $search = mb_eregi_replace("[^a-zа-яё0-9 ]", '', $search);
    $search = trim($search);
    if (Yii::$app->user->identity->isAdmin()) {
        $result = \app\models\Passwords::find()
            ->where(['hash' => $search])
            ->asArray()
            ->all();
    } else {
        $result = \app\models\Passwords::find()
            ->where(['hash' => $search])
            ->andWhere(['user_id' => Yii::$app->user->identity->id])
            ->asArray()
            ->all();
    }


    if ($result) {
        ?>

        <div class="search_result">
            <table>
                <?php foreach ($result as $row): ?>

                    <tr>
                        <td class="search_result-name">
                            <?= $row['hash']; ?>
                        </td>
                        <td>

                        </td>
                        <td class="search_result-btn">
                            <?= Html::button('Показать', [
                                'value' => Url::to(['view-password', 'id' => $row['id']]),
                                'id' => 'btn-view-pass',
                                'class' => 'btn btn-info',
                                'data-pjax' => '0',
                            ]); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>


        <?php
    } else {
        ?>
        <td class="search_result-name">
            Нет результатов
        </td>
        <?php

    }
}
?>

<?php
$js = <<<JS


//функция запуск модального окна по клику кнопки btn-view-pass
// модальное лежит в layout/index
$('button#btn-view-pass').click(function(){
    console.log('клик');
    var container = $('#modalContent');

    container.html('Загрузка данных...');

    var modal =  $('#mainModalSmall');
    modal.modal('show')
    .find('#modalContent')
    .load($(this).attr('value'));

    setTimeout(function(){
        modal.modal('hide')
        .find('#modalContent')
        .empty();
    }, 5000);
});

JS;
$this->registerJs($js);
?>
