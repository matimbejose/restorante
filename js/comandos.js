// JavaScript Document
$(document).ready(function(){
    $(".btn").click(function(event) {
       event.preventDefault();
        $.ajax({
        //pegando a url apartir do href do link
            url: $(this).attr("href"),
            type: 'GET',
            context: jQuery('#resultado'),
            success: function(res_cadastra){			
				
				$(".inputs").html(res_cadastra);
			
				$.post('atualiza.php', function(atualiza_comentarios){			
				$("#comentarios").html(atualiza_comentarios);
				});
		return false;
            },
		});
        });    
    });
////////////////////////////////////////////////////
