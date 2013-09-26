<DOCTYPE html>
	<head>
		<link rel="stylesheet" type="text/css" href="../assets/style.css">
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
	</head>

<html>
<body>

	<header>
		<h1><a href="landing.html">CardBoard</a></h1>

		<div>
			<form action="/CardBoard/index.php/main/logout">
				<input type="submit" value="Logout">
			</form>
			<form action="/CardBoard/index.php/app">
				<input type="submit" value="Home">
			</form>
			<form action="/CardBoard/index.php/app/community">
				<input type="submit" value="Community">
			</form>
		</div>

	</header>

	<input class="new-deck-toggle" type="submit" value="Create New Deck">

	<div class="new-deck">
		<form method="post" action="/CardBoard/index.php/app/newDeck">
			<h2>Create a new deck</h2>
			<label for="deck_name" name="Deck_Name">Deck Name</label>
			<input type="text" name="deck_name">
			<label for="description" name="Description">Description</label>
			<input type="text" name="description">
			<input type="submit" value="Create">
		</form>
	</div>

	<?php
	if(!empty($decks)) {
	echo '<div class="view-deck">';
	echo	'<form method="post" action="/CardBoard/index.php/app/deckInfo">';
	echo		'<label for="deck_name" name="View_Deck">View Deck</label>';
	echo		'<select name="deck_name">';
						foreach($decks as $d) {
							echo "<option>".$d['deck_name']."</option>";
						}
	echo		'</select>';
	echo		'<input type="submit" value="View">';
	echo	'</form>';
	echo '</div>';
	}

	?>

	<div style="clear:both;"></div>

	<?php
		if(empty($decks)) {
			echo "<h2>^ Start By adding a Deck</h2>";
		}else {
			echo '<div class="color-box">';
			echo	'<h2>Browse by color</h2>';
			echo	'<form method="post" action="/CardBoard/index.php/app/white"><input class="whiteBtn" type="submit" value="White"></form>';
			echo	'<form method="post" action="/CardBoard/index.php/app/blue"><input class="blueBtn" type="submit" value="Blue"></form>';
			echo	'<form method="post" action="/CardBoard/index.php/app/black"><input class="blackBtn" type="submit" value="Black"></form>';
			echo	'<form method="post" action="/CardBoard/index.php/app/red"><input class="redBtn" type="submit" value="Red"></form>';
			echo	'<form method="post" action="/CardBoard/index.php/app/green"><input class="greenBtn" type="submit" value="Green"></form>';
			echo '</div>';
		}
	?>

	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>

	<script type="text/javascript">
		(function($) {
			var button = $('.new-deck-toggle');
			var form = $('.new-deck');

			$(form).toggle();

			$(button).live('click', function(e) {
				$(form).toggle();
			});
		})(jQuery);
	</script>

</body>
</html>