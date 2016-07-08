	var accessToken = "8024b7f7c6534b5b8968aa58869e6408";
		var subscriptionKey = "35f6b81c-f11e-403f-8727-badef61c135b";
		var baseUrl = "https://api.api.ai/v1/";
		$(document).ready(function() {
			$("#keyword").keypress(function(event) {
				if (event.which == 5) {
					event.preventDefault();
					send();
				}
			});
			$("#rec").click(function(event) {
				switchRecognition();
			});
		});
		var recognition;
		function startRecognition() {
			recognition = new webkitSpeechRecognition();
			recognition.onstart = function(event) {
				updateRec();
			};
			recognition.onresult = function(event) {
				var text = "";
			    for (var i = event.resultIndex; i < event.results.length; ++i) {
			    	text += event.results[i][0].transcript;
			    }
			    
				
				var searchKeyword = text;
				if(text == "exit") { document.location.href = 'logout.php'; }
				if(text == "log off") { document.location.href = 'logout.php'; }
				if(text == "last played") { document.location.href = 'index.php?order=lastplayed'; }
				if(text == "most played") { document.location.href = 'index.php?order=numplayed'; }
				if(text == "release date") { document.location.href = 'index.php?order=rel_date'; }
				if(text == "score") { document.location.href = 'index.php?order=score'; }
				if(text == "random") { document.location.href = 'games.php?game=random'; }
				if(text == "wyndham") { text = "random"; document.location.href = 'games.php?game=random'; }
				if(text == "zaandam") { text = "random"; document.location.href = 'games.php?game=random'; }
				if(text == "reboot") { document.location.href = 'index.php?command=reboot'; }
				if(text == "restart") { document.location.href = 'index.php?command=reboot'; }
				if(text == "wyndham") { text = "random"; document.location.href = 'games.php?game=random'; }
				if(text == "zaandam") { text = "random"; document.location.href = 'games.php?game=random'; }
				
				
				setInput(text);
				stopRecognition();
				
				
			var numres = $('#numres').val();
			
			if (searchKeyword.length > 0) {
					
				$('#order').fadeTo('fast', 0.4);
				$('#order').css("background-color","#EBEBEB");
				$('#order').prop('disabled', 'disabled');
				//
				$('#numres').fadeTo('fast', 0.4);
				$('#numres').css("background-color","#EBEBEB");
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
								
								
								$('#content_games').append('<div class="col-md-4 col-xs-4 gallery-grid" ><a  href="games.php?game=' + this.id + '"><img class="example-image" id="covers_search" src="covers/'+ this.covername +'" ></a><div class="game-name"><b>'+ this.name +'</b></div></div>');
								
								
							}
							else {
								$('#content_games').append('<div class="col-md-4 col-xs-4 gallery-grid"><a  href="games.php?game=' + this.id + '"><img class="badgex example-image" id="covers_search" src="covers/'+ this.covername +'"><span class="badgex">' + this.numplayed +'</span></a><div class="game-name"><b>'+ this.name +'</b></div></div>');	
							}
						}
						 n++;
					});
				}, "json");
			}

			else {
				
				
				$('#order').css("background-color","#FFF");
				$('#order').prop('disabled', false);
				
				 
				
				$('#numres').css("background-color","#FFF");
				$('#numres').prop('disabled', false);
				
				$('#order').trigger('change');
				
		};

	
				
				
			};
			recognition.onend = function() {
				stopRecognition();
			};
			recognition.lang = "en-US";
			recognition.start();
		}
	
		function stopRecognition() {
			if (recognition) {
				recognition.stop();
				recognition = null;
			}
			updateRec();
		}
		function switchRecognition() {
			if (recognition) {
				stopRecognition();
			} else {
				startRecognition();
			}
		}
		
		function capitalise(string) {
			return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
		}
		
		function setInput(text) {
		
		
			$("#keyword").val(capitalise(text));
			send();
		}
		function updateRec() {
		
			$("#rec").html(recognition ? "<img style='height: 29px; width: auto;' src='images/mic-red.png'>" : "<img style='height: 29px; width: auto;' src='images/mic.png'>");
		}
		function send() {
			var text = $("#keyword").val();
			$.ajax({
				type: "POST",
				url: baseUrl + "query/",
				contentType: "application/json; charset=utf-8",
				dataType: "json",
				headers: {
					"Authorization": "Bearer " + accessToken,
					"ocp-apim-subscription-key": subscriptionKey
				},
				data: JSON.stringify({ q: text, lang: "en" }),
				success: function(data) {
					setResponse(JSON.stringify(data, undefined, 2));
				},
				error: function() {
					setResponse("Internal Server Error");
				}
			});
			setResponse("Loading...");
		}
		function setResponse(val) {
		
			$("#response").text(val);
		}