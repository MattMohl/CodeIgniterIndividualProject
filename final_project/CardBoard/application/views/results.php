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

	<div class="view-deck">
		<form method="post" action="/CardBoard/index.php/app/deckInfo">
			<label for="deck_name" name="View_Deck">View Deck</label>
			<select name="deck_name">
				<?php
					if(!empty($decks)) {
						foreach($decks as $d) {
							echo "<option>".$d['deck_name']."</option>";
						}
					}
				?>
			</select>
			<input type="submit" value="View">
		</form>
	</div>

	<div style="clear:both;"></div>

	<div class="color-box">
		<h2>Browse by color</h2>
		<form method="post" action="/CardBoard/index.php/app/white"><input class="whiteBtn" type="submit" value="White"></form>
		<form method="post" action="/CardBoard/index.php/app/blue"><input class="blueBtn" type="submit" value="Blue"></form>
		<form method="post" action="/CardBoard/index.php/app/black"><input class="blackBtn" type="submit" value="Black"></form>
		<form method="post" action="/CardBoard/index.php/app/red"><input class="redBtn" type="submit" value="Red"></form>
		<form method="post" action="/CardBoard/index.php/app/green"><input class="greenBtn" type="submit" value="Green"></form>
	</div>

	<?php
		if(empty($decks)) {
			echo "<h2>Start by Adding a Deck</h2>";
		}
		foreach($cards as $card) {
			echo "<div class='card-box'>";
			echo "<div class='card";
			foreach($card['colors'] as $color) {
				echo " ".$color;
			}
			echo "'>";
			echo "<h3>".$card['name']."</h3>";
			if(!empty($card['manaCost'])) {echo "<p class='manaCost'>".$card['manaCost']."</p>";}
			echo "<p class='type'>".$card['type']."</p>";
			if(!empty($card['text'])) {echo "<p class='rules'>".$card['text']."</p>";}
			// if(!empty($card['flavor'])) {echo "<p>".$card['flavor']."</p>";}
			if(!empty($card['power']) && !empty($card['toughness'])) {echo "<p class='pt'>".$card['power']." / ".$card['toughness']."</p>";}
			echo "</div>";
			echo "<div class='order-form'>";
			echo "<form method='post' action='/CardBoard/index.php/app/setNumInDeck'>";
			echo "<label for='deck_name' name='Deck_Name'>To Deck</label>";
			echo "<select name='deck_name'>";
			foreach($decks as $deck) {
				echo "<option>".$deck['deck_name']."</option>";
			}
			echo "</select>";
			echo "<label for='num' name='Num'>Amount</label>";
			echo "<input type='text' name='num'>";
			echo "<input style='display:none;' type='text' name='multiverseid' value=".$card['multiverseid'].">";
			echo "<input type='submit' value='Save'>";
			echo "</form>";
			echo "</div>";
			echo "</div>";
		}
	?>

	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>

	<script type="text/javascript">
		var button = $('.new-deck-toggle');
		var form = $('.new-deck');

		$(form).toggle();

		$(button).live('click', function(e) {
			$(form).toggle();
		});
	</script>

</body>
</html>