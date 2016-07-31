
jQuery(function($){
	$(document).ready(function(){
		//$('.imgButton').click(open_media_window);
		$('#img1').click(function(){
			open_media_window('img1');
		});
		$('#img2').click(function(){
			open_media_window('img2');
		});
		$('#img3').click(function(){
			open_media_window('img3');
		});
		$('#img4').click(function(){
			open_media_window('img4');
		});
		
		$('#newIngredient').click(function(){
			var count = $('.ingredient tr').length -2;
			count = count + 1;
			var row = $('#template').clone();
			row.appendTo($('.ingredient'));
			$('#countIn').val(count);
			row.attr('id','');
			row.find('input[name = nameIn]').attr('name','nameIn'+count);
			row.find('input[name = amount]').attr('name','amount'+count);
			row.find('td:first').html(count);
			row.show();
		});
		$(document).on('click', ".deleteIn", function() {
			var count = $('.ingredient tr').length -2;
			$('#countIn').val(count -1);
			var row = $(this).parent().parent();
			var index = row.index();
			$(".ingredient tr:gt("+index+")").each(function(){
				$(this).find('td:first').html(index-1);

				var name = $(this).find('td').eq(1).find('input');
				$(name).attr('name','nameIn'+(index-1));
				var amount = $(this).find('td').eq(2).find('input');
				$(amount).attr('name','amount'+(index-1));
				index = index+1;
			})
			row.remove();
			
		})
		
	});
	function open_media_window(id){
		var window = wp.media({
			title: 'Insert a media',
			library: {type: 'image'},
			multiple: false,
			button: {text: 'Insert'},
		});
		window.on('select', function(){
	        var first = window.state().get('selection').first().toJSON();
	        $('#src_'+id).val(first['url']);
	        $('#fr_'+id).attr('src',first['url']);

	        
	    });
	    window.open();
	}

})