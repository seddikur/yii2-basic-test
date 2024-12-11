<?php

use yii\helpers\Html;

$this->title = 'Поиск пароля по hash';
//$this->params['breadcrumbs'][] = $this->title;
?>


    <div class="row">
        <div class="col col-lg-4">
            <div class="admin-default-index">
                <?php
                // поле поиска по hash
               // echo $this->render('search'); ?>
            </div>
        </div
    </div


    <div class="col-sm-4">
        <form method="get" action="<?= \yii\helpers\Url::to(['default/search']); ?>" class="pull-right">
            <div class="row">
                <div class="col col-lg-4">
                    <div class="input-group">
                        <input type="text" id="search-password" name="query" class="form-control" placeholder="Поиск паролей">
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

<?php
$js = <<<JS


//функция запуск модального окна по клику кнопки btn-view-pass
// модальное лежит в layout/index
// $('#search-password').on('keyup', function(){
//     console.log('клик');
//     console.log($(this).attr('value'));
//      var container = $('#modalContent');
//         container.html('Загрузка данных...');
//         $('#mainModalSmall').modal('show')
//             .find('#modalContent')
//             .load($(this).attr('value'));
//
//     setTimeout(function(){
//         modal.modal('hide')
//         .find('#modalContent')
//         .empty();
//     }, 5000);
// });

JS;
$this->registerJs($js);
?>




<?php
$js = <<<JS


// function btnSearchClick() {
//     let inputSearch = $('#catalog-search-input');
//     console.log(inputSearch.val());
//     let action = '/admin/default/index';
//      action += '?' + $.param(inputSearch.val());
//      console.log(action);
//      time =  80;
//         timeout = setTimeout(function() {
//               $.pjax.reload({
//               url: action,
//               method: 'POST',
//               container: "#static-main-pjax"
//               });
//         }, time);
// }// btnSearchClick()


function btnSearchClick2() {
    let inputSearch = $('#catalog-search-input');
    console.log(inputSearch.val());
     let action = '/admin/default/index';
     $.ajax({
            type: "POST",
            url:'/admin/default/index',
            data: inputSearch.val(),
            dataType: "json",
            // async: false,
            success: function(result) {
                console.log(result)
                // if (result == true) {
                //     $("#dtp-row-" + counter).remove();
                // }
            },
             error: function(){
                alert('Error!');
            }
        });
   }// btnSearchClick2() 
  // $(document).on("click", "#catalog-search-btn", btnSearchClick);
  // $(document).on("click", "#catalog-search-btn", btnSearchClick2);
  
  
  //Поиск
  $(document).ready(function(e) {	
	var result = $('#search_box-result');
	
	$('#search').on('keyup', function(){
     
		var search = $(this).val();
        console.log(search);
		if ((search != '') && (search.length > 1)){
			$.ajax({
				type: "POST",
				url: "/admin/default/ajax-search",
				data: {'search': search},
				success: function(msg){
					result.html(msg);
					if(msg != ''){	
						result.fadeIn();
					} else {
						result.fadeOut(100);
					}
				},
				 error: function(){
                alert('Нет совпадений!');
            }
			});
		 } else {
			result.html('');
			result.fadeOut(10);
		 }
	});
 
//	$(document).on('click', function(e){
//		if (!$(e.target).closest('.search_box').length){
//			result.html('');
//			result.fadeOut(10);
//		}
//	});
	
    //строка название
	// $(document).on('click', '.search_result-name a', function(){
	// 	$('#search').val($(this).text());
	// 	result.fadeOut(10);
	// 	return false;
	// });
	//
	
	
	$(document).on('click', function(e){
		if (!$(e.target).closest('.search_box').length){
			result.html('');
			result.fadeOut(10);
		}
	});
	
});

  
JS;
$this->registerJs($js);
?>