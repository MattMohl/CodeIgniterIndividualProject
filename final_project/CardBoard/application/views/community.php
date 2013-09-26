<DOCTYPE html>
	<head>
		<link rel="stylesheet" type="text/css" href="../../assets/style.css">
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
	echo '<form method="post" action="/CardBoard/index.php/app/deckInfo">';
	echo '<label for="deck_name" name="View_Deck">View Deck</label>';
	echo '<select name="deck_name">';
			foreach($decks as $d) {
				echo "<option>".$d['deck_name']."</option>";
			}
	echo '</select>';
	echo '<input type="submit" value="View">';
	echo '</form>';
	echo '</div>';
	}

	?>

	<div style="clear:both;"></div>

	<h2>Community Decks: Help People Improve!</h2>

	<?php
	if(!empty($allDecks)) {
		foreach($allDecks as $deck){
		echo "<div class='com-deck'>";
		echo "<h3>".$deck['deck_name']."</h3>";
		echo "<p>".$deck['description']."</p>";
		echo "<form method='post' action='/CardBoard/index.php/app/deckInfo/true'>";
		echo "<input style='display:none;' name='deck_name' value='".$deck['deck_name']."'>";
		echo "<input type='submit' value='Inspect'>";
		echo "</form>";
		echo "</div>";
		}
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