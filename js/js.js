$(document).ready(function(){
  $("#myTable").tablesorter();
});
$( document ).ready( function() {
	
	//$("#myTable").tablesorter();

	$(".seting").click(function() {
  		var name = this.id;
		if(name.length > 0){
			$.post(
				"/complaints.book/ajax.php", 
				{'name': name},
				function( data ) {
					var drop = /^drop-[0-9]+$/;
					var edit = /^btn-[0-9]+$/;
					var img = '';
					var country = 'не задано';
					var site = 'не задано';
					
					
					if(data)
					{
						var data = JSON.parse(data);
						
						// Видалити
						if (drop.test( name ) ) {
							
							var del = parseFloat(name.substr(5));
							var div = $('#result').empty();
							div.append('<input type="hidden" name="drop" value="'+ del +'">');
							if(data[1][0]){
								var img = '<img src="/complaints.book/images/img/' + data[1][0].code + '.png">';
								var country = data[1][0].title;
							}
							if(data[0]){
								if(data[0].site != null){site = data[0].site;}
								div.append('<p><b>Ім\'я</b>: ' + data[0].username + '</p>');
								div.append('<p><b>Електронна скринька</b>: ' + data[0].email + '</p>');
								div.append('<p><b>Сайт</b>: ' + site + '</p>');
								div.append('' + img + ' ' +country  +'; ');
								div.append('<i class="fa fa-clock-o" aria-hidden="true"></i>  ' + data[0].adddate +'; ');
								
								div.append(' <i class="glyphicon glyphicon-globe" aria-hidden="true"></i> ' + data[0].browser + '; ');
								div.append(' <i class="glyphicon glyphicon-globeglyphicon glyphicon-flag"></i> IP: ' + data[0].ipaddress + ';');	
								
								div.append('<hr>');
								div.append('<p><b>Текст звернення</b>: ' + data[0].complaint + '</p>');
									
							}
							div.append('<hr>');
							div.append('<button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash" aria-hidden="true"></i></button>');

						}


						//Редагувати
						if (edit.test( name ) ) {
							var edits = parseFloat(name.substr(4));
							var div = $('#result').empty();
							div.append('<input type="hidden" name="edit[param]" value="'+ edits +'">');
							if(data[1][0]){
								var img = '<img src="/complaints.book/images/img/' + data[1][0].code + '.png">';
								var country = data[1][0].title;
							}
							if(data[0]){
								
								if(data[0].site != null){site = data[0].site;}
								div.append('<div class="form-group">'+
									'<label for="inputName2" class="col-sm-2 col-xs-2 control-label"><span class="text-danger"> * </span> Ім\'я</label>'+
										'<div class="col-sm-9 col-xs-9">'+
											'<input type="text" class="form-control" name="edit[username]" value="'+ data[0].username +'" id="inputName2" placeholder="Ім\'я">'+
										'</div>'+
									'</div>');
								div.append('<div class="form-group">'+
									'<label for="inputEmail2" class="col-sm-2 col-xs-2 control-label"><span class="text-danger"> * </span> Email</label>'+
										'<div class="col-sm-9 col-xs-9">'+
											'<input type="email" class="form-control" name="edit[email]" value="'+ data[0].email +'" id="inputEmail" placeholder="Email">'+
										'</div>'+
									'</div>');
								div.append('<div class="form-group">'+
									'<label for="inputSite2" class="col-sm-2 col-xs-2 control-label"><span class="text-danger"> * </span> Сайт</label>'+
										'<div class="col-sm-9 col-xs-9">'+
											'<input type="text" class="form-control" name="edit[site]" value="'+ site +'" id="inputSite2" placeholder="Сайт">'+
										'</div>'+
									'</div>');
								
								div.append('<div class="form-group">'+
									'<label for="inputText2" class="col-sm-2 col-xs-2 control-label"><span class="text-danger"> * </span> Текст</label>'+
										'<div class="col-sm-9 col-xs-9">'+
											'<textarea class="form-control" rows="5" name="edit[complaint]" id="inputText2">' + data[0].complaint + '</textarea>'+
										'</div>'+
									'</div>');
								div.append('<hr>');
								
								div.append('<input type="hidden" name="edit[country]" value="'+ data[0].country +'">');
								div.append('' + img + ' ' +country  +'; ');
								div.append('<i class="fa fa-clock-o" aria-hidden="true"></i>  ' + data[0].adddate +'; ');
								
								div.append(' <i class="glyphicon glyphicon-globe" aria-hidden="true"></i> ' + data[0].browser + '; ');
								div.append(' <i class="glyphicon glyphicon-globeglyphicon glyphicon-flag"></i> IP: ' + data[0].ipaddress + ';');	
							}
							div.append('<hr>');
							div.append('<button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i></button>');
						}
					}
				}
			);
		}
	});
});

function show_category(){
	var pid = $('#per_id').val();
	$.post("ajax/cms-ajax.php", {'show_category': pid},  function(data){
	var sentJS = JSON.parse(data);
	//console.log(sentJS);
	var i=0;
	$('#createCategory_r').html('');
	while(i < sentJS.length){
		$('#createCategory_r').append('<p class="text"><span onclick=\'change_category('+ sentJS[i]['id'] +',"'+sentJS[i]['name']+'");\'><img src=\"../../img/file_edit2.png\" class=\"cursor\"> </span> '+ sentJS[i]['id'] +' - '+sentJS[i]['name']+'</p>')
		i++;
	}	
	});
}

