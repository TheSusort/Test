<?php
	$album1 = array(
		array(1, "When the Morning Comes", "3:12"),
		array(2, "Had I Known You Better Then", "3:22"),
		array(3, "Las Vegas Turnaround (The Stewardess Song)", "2:57"),
		array(4, "She's Gone", "5:15"),
		array(5, "I'm Just a Kid (Don't Make Me Feel Like a Man)", "3:20"),
		array(6, "Abandoned Luncheonette", "3:55"),
		array(7, "Lady Rain", "4:26"),
		array(8, "Laughing Boy", "3:20"),
		array(9, "Everytime I Look At You", "7:04")
	);
	$album2 = array(
		array(1, "Back Together Again", "3:25"),
		array(2, "Rich Girl", "2:24"),
		array(3, "Crazy Eyes", "3:03"),
		array(4, "Do What You Want, Be Who You Are", "4:33"),
		array(5, "Kerry", "3:50"),
		array(6, "London Luck & Love", "3:01"),
		array(7, "Room To Breathe", "4:13"),
		array(8, "You'll Never Learn", "4:14"),
		array(9, "Falling", "6:12")	
	);
	$album3 = array(
		array(1, "It's A Laugh", "3:50"),
		array(2, "Melody For A Memory", "4:54"),
		array(3, "The Last Time", "2:53"),
		array(4, "I Don't Wanna Lose You", "3:49"),
		array(5, "Have I Been Away Too Long", "4:24"),
		array(6, "Alley Katz", "3:05"),
		array(7, "Don't Blame It On Love", "3:58"),
		array(8, "Serious Music", "4:10"),
		array(9, "Pleasure Beach", "3:13"),
		array(10, "August Day", "3:06")	
	);
	$album4 = array(
		array(1, "Private Eyes", "3:39"),
		array(2, "Looking For A Good Sign", "3:57"),
		array(3, "I Can't Go For That(No Can Do)", "5:09"),
		array(4, "Mano a Mano", "3:56"),
		array(5, "Did It In A Minute", "3:39"),
		array(6, "Head Above Water", "3:36"),
		array(7, "Tell Me What You Want", "3:51"),
		array(8, "Friday Let Me Down", "3:35"),
		array(9, "Unguarded Minute", "4:10"),
		array(10, "Your Imagination", "4:10"),
		array(11, "Some Men", "4:15")	
	);
	
	
	
			      
	$al = $_REQUEST['al'];	
				      
	switch($al) {
		case 1:	
		$calbum = $album1;
		$len = "36:42";
		$img = "http://i57.tinypic.com/29z4h8m.jpg";
		break;
		
		case 2:
		$calbum = $album2;
		$len = "34:51";
		$img = "http://i59.tinypic.com/148n345.jpg";
		break;
		
		case 3:
		$calbum = $album3;
		$len = "36:49";
		$img = "http://i58.tinypic.com/28k1umb.jpg";
		break;
		
		case 4:
		$calbum = $album4;
		$len = "47:47";
		$img = "http://i58.tinypic.com/2zscwap.jpg";		
		break;
	}
	
	$set = '
			<div id="album_cover">
				<img src='.$img.' />
			</div>
			<div id="album_songs">
			<table>
				<tr>
					<th>No.</th>
					<th>Title</th>
					<th>Length</th>
		      </tr>';
	
	for ($row = 0; $row < count($calbum); $row++) {
  		$set = 
  		$set . '<tr>
					<td class="song_no">'.$calbum[$row][0].'</td>
					<td class="song_title">'.$calbum[$row][1].'</td>
					<td class="song_length">'.$calbum[$row][2].'</td>
				</tr>';
	}
	
	$set = 
	$set . '<tr>
					<td colspan="2"><strong>Total length:</strong></td>
					<td class="song_length"><strong>'.$len.'</strong></td>
			  </tr>
			</table>';
	echo $set;
?>