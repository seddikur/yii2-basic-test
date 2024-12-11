<!--            <div class="col-6">-->
<!--                <div class="card">-->
<!--                    <div class="card-header">-->
<!--                        Пароли пользователя-->
<!--                    </div>-->
<!--                    <div class="card-body">-->
<!--                        --><?php //Pjax::begin(); ?>
<!--                        --><?//= \kartik\grid\GridView::widget([
//                            'dataProvider' => $dataProviderGroupPassword,
//                            'columns' => [
//                                // ['class' => 'yii\grid\SerialColumn'],
//
//                                [
//                                    'attribute' => 'password',
//                                    'format' => 'raw',
//                                    'value' => function ($model) {
//                                        /** @var $model Passwords */
////                                        $html = HTML::a($model->organization->title, ['organizations/view', 'id' => $model->organization_id]);
////                                        return $html;
//                                        return $model->password;
//                                    },
//                                ],
//                                [
//                                    'class' => \yii\grid\ActionColumn::class,
//                                    'template' => '{update}    {delete}',
//                                    'urlCreator' => function ($action, Passwords $model, $key, $index, $column) {
//                                        return Url::toRoute([$action, 'id' => $model->id]);
//                                    },
//                                    'buttons' => [
//                                        'update' => function ($url, $model, $key) {
//                                            return Html::button('<i class="bi bi-pencil text-warning"></i>', [
//                                                'value' => Url::to(['update_org', 'id' => $model->id]),
//                                                'id' => 'btn-update-org',
//                                                'class' => 'btn btn-light',
//                                                'data-pjax' => '0'
//                                            ]);
//                                        },
//                                        'delete' => function ($url, $model, $key) {
//                                            return Html::a('<i class="bi bi-trash text-danger"></i>', ['delete_org', 'id' => $model->id],
//                                                ['data-confirm' => 'Удалить?', 'data-method' => 'post', 'data-pjax' => '1',]);
//                                        },
//                                    ]
//                                ],
//                            ],
//                        ]); ?>
<!--                        --><?php //Pjax::end(); ?>
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->