  /* выбрать все посты для удаление */
$(function() { 
  $('#deleteAll').on('click', function() {
 			if($(this).is(':checked')){
 				$('.inp-del').prop('checked', true);
			}else{
				$('.inp-del').prop('checked', false);
			}     
  });
});