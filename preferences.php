<?php
header('Content-Type: text/xml');
echo "<?xml version='1.0' encoding='UTF-8' standalone='yes' ?>";

$food = htmlspecialchars(strtolower(trim($_POST['userInput'])));
//$foodArray = array('dogs', 'sex', 'ploot', 'blowjobs', 'goats', 'taco', 'tacos', 'weed', 'feminism', 'coding', 'cats', 'fish', 'whales', 'tattoos', 'eating pussy', 'cuddling', "butts", 'jokes', 'oysters', 'orcas', 'getting drunk', 'whiskey', 'beer');
//$propernames = array('steve shives', 'sarah', 'susan', 'johnny cash', 'louis ck', 'louis c.k.', 'aziz ansari', 'stuffy', 'sam', 'stewart', 'star trek', 'sarah druin', 'hank williams', 'hank', 'andygator', 'jim beam', 'new orleans');


// db stuffs
$servername = "localhost";
$username = "preferences";
$password = "luvth0zprefz!";
$dbname = "preferences";
$link = mysqli_connect("localhost", "preferences", "luvth0zprefz!", "preferences") or die("Error" . mysqli_error($link));
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM `prefs` WHERE `value` = '" . $food . "'";
$result = $conn->query($sql);

if ($result->num_rows > 0) { //if it exists in the db, fetch the number of other people that like it
	while($row = $result->fetch_assoc()) {
			$number = $row['number_of_likes'];
			$liked = $row['liked'];
			$category = $row['category'];
			
			//update the number of likes
			$update = mysqli_query($link, "UPDATE prefs SET `number_of_likes` = `number_of_likes` + 1, `date_updated` = NOW() WHERE `value` = '" . $food . "';");
			
			
			$other_people = $number . " other people like this.";
		}
	} else { //if it doesn't exist in the db, add it. 
		$insert_new = mysqli_query($link, "INSERT INTO `prefs` (`id`, `value`, `liked`, `number_of_likes`, `date_created`, `date_updated`) VALUES (NULL, '" . $food .  "', '0', '1', NOW(), NOW());");
		$other_people = '';
	}

 


switch (date("s")) {
	case 00: case 12: case 18:  case 24: case 30: case 36: case 42: case 48: case 54:
		$response = "Heck yeah we love " . $food . ", are you kidding me?";
		$negation = "Nope. " . ucfirst($food) . " is pretty much universally reviled by everyone.";
		$proper = "Brooooooooo! Big fans of " . ucwords($food) . " over here!";
		break;
	case 01: case 07: case 13: case 19: case 20: case 25: case 31: case 37: case 43:  case 49:
		$response = "Now that you mention it we are all about " . $food . ".";
		$negation = "Uh, nobody likes " .$food. ", are you kidding me?";
		$proper = "If loving " . ucwords($food) . " is wrong, we don't want to be right.";
		break;
	case 02: case 08: case 14: case 26: case 32: case 38: case 44:  case 50: case 56:
		$response = ucfirst($food). " is one of our favorite things!";
		$negation = "If I had a dollar for every time I binged on " . $food . " and woke up vomiting...";
		$proper = "I have had a crush on " . ucwords($food) . " since 7th grade, at least.";
		break;
	case 03: case 09: case 21: case 45: case 27: case 33: case 39: case 51:
		$response = "We actually truly love " . $food . " and probably you should too.";
		$negation = "Ah, " . $food . ". Loved by no one but its mother.";
		$proper = "We love " . ucwords($food) . " so much we would marry him or her or whatever.";
		break;

	case 04: case 10: case 16: case 22: case 55: case 28: case 57: case 34: case 40: case 46:  case 52: case 58: 
		$response = "To be honest there are a lot of " . $food . " lovers around here.";
		$negation = "To be honest, I don't know what " . $food . " is but probably it sucks?";
		$proper = "We have actually seen " . ucwords($food) . " naked.";

	case 05: case 11: case 17: case 23: case 29: case 15: case 35: case 41: case 47: case 53: case 59: case 06: 
		$response = "Tell me have you ever really, really really ever loved a " . $food . "?";
		$negation = "Are you asking because you like " . $food . " yourself? Don't lie. We know. Gross.";
		$proper = "Of all the men or women or brands in this world, " . ucwords($food) . " is among the best.";
	
	default:
		$response = "To be honest there are a lot of " . $food . " lovers around here.";
		$negation = "Everything you love about " . $food . " is the worst!";
		$proper = "All my nudes are dedicated to " . ucwords($food) . ", tbh.";
		break; 
}
echo '<response>';
	
if ($category && $category !== "special") {
	if($category == "food") {
		echo $response;
	} elseif ($category == "propername") {
		echo $proper;
	} } else {

		if ($food == '') {
		echo "You haven't typed anything yet. I'm about to call the cops.";
		$other_people = '';
	} elseif ($food == 'music') {
		
		switch (date("h")) { 
			case 01: case 05: case 09: 
			echo '<iframe style="border: 0; width: 333px; height: 470px;" src="https://bandcamp.com/EmbeddedPlayer/album=2699361877/size=large/bgcol=ffffff/linkcol=0687f5/tracklist=false/transparent=true/" seamless><a href="http://threeninjas.net/album/the-sadness-will-last-forever">The Sadness Will Last Forever by Three Ninjas &amp; His Weird Old Tricks</a></iframe>';
			break;

			case 02: case 06: case 10:
			echo '<iframe style="border: 0; width: 350px; height: 470px;" src="https://bandcamp.com/EmbeddedPlayer/album=281090766/size=large/bgcol=ffffff/linkcol=0687f5/tracklist=false/transparent=true/" seamless><a href="http://threeninjas.net/album/alcohol-isolation">Alcohol &amp; Isolation by Three Ninjas</a></iframe>';
			break; 

			case 03: case 07: case 11:
			echo '<iframe style="border: 0; width: 100%; height: 120px;" src="https://bandcamp.com/EmbeddedPlayer/track=3543565637/size=large/bgcol=ffffff/linkcol=0687f5/tracklist=false/artwork=small/transparent=true/" seamless><a href="http://threeninjas.net/track/the-sky-from-tonasket">The Sky From Tonasket by Three Ninjas</a></iframe>';
			break;

			case 04: case 08:
			echo '<iframe style="border: 0; width: 100%; height: 120px;" src="https://bandcamp.com/EmbeddedPlayer/album=285488596/size=large/bgcol=ffffff/linkcol=0687f5/tracklist=false/artwork=small/transparent=true/" seamless><a href="http://threeninjas.net/album/here-lies-three-ninjas">Here Lies Three Ninjas by Three Ninjas</a></iframe>';
			break;

			case 12:
			echo '<iframe style="border: 0; width: 350px; height: 470px;" src="https://bandcamp.com/EmbeddedPlayer/album=170376454/size=large/bgcol=ffffff/linkcol=0687f5/tracklist=false/transparent=true/" seamless><a href="http://threeninjas.net/album/saves-the-world">Saves The World by Three Ninjas</a></iframe>';
			break;

			default:
			echo '<iframe style="border: 0; width: 350px; height: 470px;" src="https://bandcamp.com/EmbeddedPlayer/album=170376454/size=large/bgcol=ffffff/linkcol=0687f5/tracklist=false/transparent=true/" seamless><a href="http://threeninjas.net/album/saves-the-world">Saves The World by Three Ninjas</a></iframe>';
			break;
		}	}

	 elseif ($food == 'jon hendren' || $food == 'fart' || $food == '@fart') {
		echo "Thought leader, strong man, the web's bad boy. Daring, beautiful, handsome, with a large, healthy ass. Who else could it be. #thatsjonbaby";
	} elseif ($food == 'fried chicken') {
		echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/w4C69uJNz-I?rel=0&autoplay=1" frameborder="0" allowfullscreen></iframe>';
	} elseif ($food == 'hannah' || $food == 'hannah jenks') {
		echo '<iframe style="border: 0; width: 100%; height: 120px;" src="https://bandcamp.com/EmbeddedPlayer/album=2699361877/size=large/bgcol=ffffff/linkcol=0687f5/tracklist=false/artwork=small/track=594112988/transparent=true/" seamless><a href="http://threeninjas.net/album/the-sadness-will-last-forever">The Sadness Will Last Forever by Three Ninjas &amp; His Weird Old Tricks</a></iframe>';
	} elseif ($food == 'taisha' || $food == 'taisha mcfall' || $food == 'taisha gilmore') {
		echo '<iframe style="border: 0; width: 100%; height: 120px;" src="https://bandcamp.com/EmbeddedPlayer/album=170376454/size=large/bgcol=ffffff/linkcol=0687f5/tracklist=false/artwork=small/track=115425199/transparent=true/" seamless><a href="http://threeninjas.net/album/saves-the-world">Saves The World by Three Ninjas</a></iframe>';
		echo '<br> Ah, Taisha. Universally beloved of all mankind.';
	} elseif ($food == 'boobs' || $food == 'tits') {
		echo $response;
		echo '<br><img src="boobs.jpg" alt="boobs">';
	}  elseif ($food == 'birds') {
		echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/5UUjJysUMTw?rel=0&autoplay=1" frameborder="0" allowfullscreen></iframe>';
	} elseif ($food == 'dicks') {
		echo '<iframe style="border: 0; width: 100%; height: 120px;" src="https://bandcamp.com/EmbeddedPlayer/track=493237253/size=large/bgcol=ffffff/linkcol=0687f5/tracklist=false/artwork=small/transparent=true/" seamless><a href="http://threeninjas.net/track/my-dick-is-kind-of-big-featuring-jen-mccreight">My Dick Is Kind of Big (featuring Jen McCreight) by Tangentbot and Three Ninjas</a></iframe>';
	} elseif ($food == 'seattle') {
		$response = '';
		$negation = '';
		echo "<h1>NO.</h1>";
	} elseif ($food == 'dogs') {
		echo '
		<iframe width="420" height="315" src="https://www.youtube.com/embed/NF1lwZ24RYI?rel=0&autoplay=1" frameborder="0" allowfullscreen></iframe>
				<iframe width="420" height="315" src="https://www.youtube.com/embed/jKTzjEOqA3I?rel=0&autoplay=1" frameborder="0" allowfullscreen></iframe><br>
				<iframe width="420" height="315" src="https://www.youtube.com/embed/0u3ViA0JEtw?rel=0&autoplay=1" frameborder="0" allowfullscreen></iframe>
				<iframe width="420" height="315" src="https://www.youtube.com/embed/Ipw7XJuNubc?rel=0&autoplay=1" frameborder="0" allowfullscreen></iframe>
		';
	} elseif ($food == 'alex' || $food == 'alexandra') {
		include('poem.php');
		$other_people = "";
	} elseif ($food == 'burritos') {
		echo "<h3>Make a dog burrito.</h3>";
		echo '<iframe src="http://beerheer.com/tests/ajax/jqueryui.html" width="520" height="400" frameBorder="0" style="overflow:hidden">';
	} elseif ($food == 'show me everything') {
		$all_entries_query = 'SELECT * FROM `prefs` ORDER BY `value`;';
		$all_entries = $conn->query($all_entries_query);
		if ($all_entries->num_rows > 0) {
			echo '<table>';
			while ($row = $all_entries->fetch_assoc()) {
				$number = $row['number_of_likes'];
				$liked = $row['liked'];
				$thing = $row['value'];
				$category = $row['category'];
				
				//grab everything from the db, and if it's not already liked, add a 'like it' button next to it that will theoretically update the db!
				if ($thing !== '') {
					echo '<tr><td><span id="to-be-liked">'.$thing.'</span> ('.$number.')</td>';
						if ($liked == 0 || $liked == '' && $category !== 'special') {
							echo '<td><form action="" method="post" id="the-like-form"><input type="submit" value="Like It"/></form></td>';
						} else {
							echo '<td></td>';
						}
					echo "</tr>";
				}
			} echo '</table>';
		}
		$other_people = '';
	} elseif ($food == 'casey' || $food == 'casey martin') {
		echo "It's dark and it doesn't matter and the cold can't touch us<br>
				I'm lying in a bed draped with magnolia and helianthus<br>
				I come from where sadness and loneliness confront us<br>
				but they can't find me here, draped in magnolia and helianthus<br>
				you look like how I pictured dreams that wake up and walk among us<br>
				I only wish to breathe and love magnolia and helianthus<br>
				and now as day is dying slowly, I beg you not go from us<br>
				would that you could always stay, my magnolia and helianthus.";
				$other_people = "";
	}

	else {
		echo $negation;
		$other_people = '';
		
	} }

echo "<br><br>".$other_people. '</response>';



?>