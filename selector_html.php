<?php

if($_GET['order']) {


		if($selector == 'name') {
			
			
			$html_select = '<option value="name" selected="selected">Name</option>
				<option value="score">Score</option>
				<option value="lastplayed">Last Played</option>
				<option value="numplayed" >Most Played</option>
				<option value="dateadded">Date Added</option>
				<option value="rel_date">Release Date</option>
				<option value="neverplayed">Never Played</option>
				<option value="random">Random Games</option>
				';
				
		} 
		
		if($selector == 'score') {
				
			$html_select = '<option value="name" >Name</option>
				<option value="score" selected="selected">Score</option>
				<option value="lastplayed">Last Played</option>
				<option value="numplayed" >Most Played</option>
				<option value="dateadded">Date Added</option>
				<option value="rel_date">Release Date</option>
				<option value="neverplayed">Never Played</option>
				<option value="random">Random Games</option>
				';
		} 


		if($selector == 'lastplayed') {
			$html_select = '<option value="name" >Name</option>
				<option value="score" >Score</option>
				<option value="lastplayed" selected="selected">Last Played</option>
				<option value="numplayed" >Most Played</option>
				<option value="dateadded">Date Added</option>
				<option value="rel_date">Release Date</option>
				<option value="neverplayed">Never Played</option>
				<option value="random">Random Games</option>
				';
		} 

		if($selector == 'numplayed') {
			$html_select = '<option value="name" >Name</option>
				<option value="score" >Score</option>
				<option value="lastplayed" >Last Played</option>
				<option value="numplayed" selected="selected">Most Played</option>
				<option value="dateadded">Date Added</option>
				<option value="rel_date">Release Date</option>
				<option value="neverplayed">Never Played</option>
				<option value="random">Random Games</option>
				';
		} 
		
		if($selector == 'dateadded') {
			$html_select = '<option value="name" >Name</option>
				<option value="score" >Score</option>
				<option value="lastplayed" >Last Played</option>
				<option value="numplayed">Most Played</option>
				<option value="dateadded" selected="selected">Date Added</option>
				<option value="rel_date">Release Date</option>
				<option value="neverplayed">Never Played</option>
				<option value="random">Random Games</option>';
				
		} 
		
		if($selector == 'rel_date') {
			$html_select = '<option value="name" >Name</option>
				<option value="score" >Score</option>
				<option value="lastplayed" >Last Played</option>
				<option value="numplayed">Most Played</option>
				<option value="dateadded" >Date Added</option>
				<option value="rel_date" selected="selected">Release Date</option>
				<option value="neverplayed">Never Played</option>
				<option value="random">Random Games</option>';
		} 
		
		if($selector == 'neverplayed') {
			$html_select = '<option value="name" >Name</option>
				<option value="score" >Score</option>
				<option value="lastplayed" >Last Played</option>
				<option value="numplayed">Most Played</option>
				<option value="dateadded" >Date Added</option>
				<option value="rel_date" >Release Date</option>
				<option value="neverplayed" selected="selected">Never Played</option>
				<option value="random">Random Games</option>';
		} 

			if($selector == 'random') {
			$html_select = '<option value="name" >Name</option>
				<option value="score" >Score</option>
				<option value="lastplayed" >Last Played</option>
				<option value="numplayed">Most Played</option>
				<option value="dateadded" >Date Added</option>
				<option value="rel_date" >Release Date</option>
				<option value="neverplayed">Never Played</option>
				<option value="random" selected="selected">Random Games</option>';
		} 
}

else {
	$html_select = '<option value="name" >Name</option>
				<option value="score" >Score</option>
				<option value="lastplayed" selected="selected">Last Played</option>
				<option value="numplayed">Most Played</option>
				<option value="dateadded">Date Added</option>
				<option value="rel_date">Release Date</option>
				<option value="neverplayed">Never Played</option>
				<option value="random">Random Games</option>';
}


if($_GET['numres']) {
	
	if($numres_select == "30") {
		
		$html_numres = '<option value="30" selected="selected">30 results</option>
				<option value="50" >50 results</option>
				<option value="100" >100 results</option>
				<option value="'.$games_number.'">All results</option>';
	}
	if($numres_select == "50") {
		
		$html_numres = '<option value="30" >30 results</option>
				<option value="50" selected="selected">50 results</option>
				<option value="100" >100 results</option>
				<option value="'.$games_number.'">All results</option>';
	}
	
	if($numres_select == "100") {
		
		$html_numres = '<option value="30" >30 results</option>
				<option value="50" >50 results</option>
				<option value="100" selected="selected">100 results</option>
				<option value="'.$games_number.'" >All results</option>';
	}
	
	if($numres_select == $games_number) {
		
		$html_numres = '<option value="30" >30 results</option>
				<option value="50" >50 results</option>
				<option value="100" >100 results</option>
				<option value="'.$games_number.'" selected="selected">All results</option>';
	}
	
}

elseif(empty($_GET['numres'])) {
	$html_numres = '<option value="30" selected="selected">30 results</option>
				<option value="50" >50 results</option>
				<option value="100" >100 results</option>
				<option value="'.$games_number.'">All results</option>';
	
}

?>