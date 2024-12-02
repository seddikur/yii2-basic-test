<?php
use yii\helpers\Html;

$this->title = 'Поиск пароля по hash';
//$this->params['breadcrumbs'][] = $this->title;
?>


<div class="admin-default-index">
    <?php
    // поле поиска по hash
    echo $this->render('search'); ?>
</div>
<!--5474dc4f409dfda4f6d6c099a028fc8e-->
<?php
$js = <<<JS


function btnSearchClick() {
    let inputSearch = $('#catalog-search-input');
    console.log(inputSearch.val());
    let action = '/admin/default/index';
     action += '?' + $.param(inputSearch.val());
     console.log(action);
     time =  80;
        timeout = setTimeout(function() {
              $.pjax.reload({
              url: action,
              method: 'POST',
              container: "#static-main-pjax"
              });
        }, time);
}// btnSearchClick()


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
                alert('Error!');
            }
			});
		 } else {
			result.html('');
			result.fadeOut(10);
		 }
	});
 
	$(document).on('click', function(e){
		if (!$(e.target).closest('.search_box').length){
			result.html('');
			result.fadeOut(10);
		}
	});
	
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