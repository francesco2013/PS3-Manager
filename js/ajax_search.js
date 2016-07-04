$(document).ready(function() {
		$('#keyword').on('input', function() {
			var searchKeyword = $(this).val();
			var numres = $('#numres').val();
			
			
			if (searchKeyword.length > 0) {
				
				$('#order').fadeTo(5, 0.2);
				$('#order').css("background-color","#A5A5A5");
				$('#order').prop('disabled', 'disabled');
				//
				$('#numres').fadeTo(5, 0.2);
				$('#numres').css("background-color","#A5A5A5");
				$('#numres').prop('disabled', 'disabled'); 
				//
				
				$.post('search.php', { keywords: searchKeyword }, function(data) {
					$('#content_games').empty();

						
                    var n = 1;
					$.each(data, function() {
						 
						
						if(n == numres) { return false; }
						
						if(this.rescount == 0) {
							 $('#res_number').html('No results found.');
							 $('#show_res').empty();
							 $('#content_games').hide();
							 return false;
						}
						
						else { 
							  $('#content_games').show();
							 $('#res_number').html('<b>' + this.rescount + '</b> results.');
						
								if(numres >  this.rescount) { 
									$('#show_res').html('Displaying <b>' + this.rescount + '</b> of ');
								}
								else { 
									$('#show_res').html('Displaying <b>' + numres  + '</b> of ');
								}
						}
						
						
						
						if(this.name) {
							$('#content_games').show();
							if(this.played == 0) {
								
								
								$('#content_games').append('<div class="col-md-4 col-xs-4 gallery-grid" ><a  href="games.php?game=' + this.id + '"><img class="example-image" id="covers_search" src="covers/'+ this.covername +'" ></a><div id="game-name">'+ this.name +'</div></div>');
								
								
							}
							else {
								$('#content_games').append('<div class="col-md-4 col-xs-4 gallery-grid"><a  href="games.php?game=' + this.id + '"><img class="badgex example-image" id="covers_search" src="covers/'+ this.covername +'"><span class="badgex">' + this.numplayed +'</span></a><div id="game-name">'+ this.name +'</div></div>');	
							}
						}
						 n++;
					});
				}, "json");
			}


			else {	
				//$('#order').fadeTo(10, 0.2);
				$('#order').css("background-color","#FFF");
				$('#order').prop('disabled', false);			 
				
				//$('#numres').fadeTo(10, 0.2);
			    $('#numres').css("background-color","#FFF");
				$('#numres').prop('disabled', false);
				
				$('#order').trigger('change');
				
				
			
			}
	});	
});
