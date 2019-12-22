<?php
	session_start();
?>

<html>
<head>
	<meta charset="utf-8" />
    <title>YourSpec</title>
	<link rel="stylesheet" type="text/css" href="../../style/StartLayout.css">
	<link rel="stylesheet" type="text/css" href="../../style/car-selection.css">
	<script src="../../script/plugins/ChipController/ChipsController.js"></script>
</head>
<body>
	<main>
		<?php include('../frontend/header.php'); ?>
		
		<h2 id="headline">Autos auswählen</h2>
		
		<div id="content-container">
			<div class="fill-width">
				<div id="car-selection-container-stage0">
					<!-- AJAX: next select -->
				</div>
			</div>
			<div class="fill-width">
				<button class="button-style" id="add-car-button" onclick="addCar()">Auto hinzufügen</button>
			</div>
			<form id="car-collection-form" method="post">
				<div class="fill-width" id="car-chip-container">
					<!-- AJAX: chips -->
				</div>
				<input id="car-hidden-input" type="hidden" name="car-selection">
				<div class="fill-width">
					<input class="button-style" id="car-submit-button" type="submit" name="submit" value="abschicken">
				</div>
			</form>
		</div>
	</main>
	<script src="../../script/car-selection.js"></script>
	<script>
		updateDropdown(0);
	</script>
</body>
</html>