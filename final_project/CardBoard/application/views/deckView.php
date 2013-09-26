<DOCTYPE html>
	<head>
		<?php if(!$secure):?>
			<link rel="stylesheet" type="text/css" href="../../assets/style.css">
		<?php elseif($secure):?>
			<link rel="stylesheet" type="text/css" href="../../../assets/style.css">
		<?php endif;?>	
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
	<input class="new-comment-toggle" type="submit" value="Leave Comment">

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

	<div class="new-comment">
		<form method="post" action="/CardBoard/index.php/app/comment">
			<h2>Leave a Comment</h2>
			<label for="text" name="Text">Comment</label>
			<input type="text" name="text">
			<?php
			echo "<input type='hidden' name='deck_name' value='".$cards[0]['deck_name']."'>";
			?>
			<input type="submit" value="Submit">
		</form>
	</div>

	<div style="clear:both"></div>

	<?php
		if(!empty($cards)) {
			echo "<div class='color-box'><h2>".$cards[0]['deck_name']."</h2></div>";

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
				echo "<p class='num'>X".$card['num']."</p>";
				if(!empty($card['power']) && !empty($card['toughness'])) {echo "<p class='pt'>".$card['power']." / ".$card['toughness']."</p>";}
				echo "</div>";
				if(!$secure) {
				echo "<div class='order-form'>";
				echo "<form method='post' action='/CardBoard/index.php/app/setNumInDeck'>";
				echo "<input name='deck_name' style='display:none' value='".$card['deck_name']."'>";
				echo "<label for='num' name='Num'>Amount</label>";
				echo "<input type='text' name='num' value='".$card['num']."'>";
				echo "<input style='display:none;' type='text' name='multiverseid' value=".$card['multiverseid'].">";
				echo "<input type='submit' value='Save'>";
				echo "</form>";
				echo "</div>";
				}
				echo "</div>";
			}

			if(!empty($comments)) {
				echo "<h2 style='clear:both;'>Comments</h2>";
				foreach($comments as $comment) {
					echo "<div class='comment-box'>";
					echo "<h3>".$comment['author']."</h3>";
					echo "<p>".$comment['text']."</p>";
					echo "</div>";
				}
			}
		}else {
			echo "<h2>You don't have any cards yet. Click 'Home' to add some!</h2>";
		}
	?>

	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>

	<script type="text/javascript">
		var button1 = $('.new-deck-toggle');
		var form1 = $('.new-deck');
		var button2 = $('.new-comment-toggle');
		var form2 = $('.new-comment');

		$(form1).toggle();
		$(form2).toggle();

		$(button2).live('click', function(e) {
			$(form2).toggle();
		});

		$(button1).live('click', function(e) {
			$(form1).toggle();
		});
	</script>

</body>
</html>