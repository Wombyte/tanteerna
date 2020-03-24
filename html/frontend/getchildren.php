<?php
	$headlines = ["Hersteller", "Modell", "Generation", "Serie", "Trim"];
	$ids = ["brand", "model", "generation", "series", "trim"];
	$db = ["name", "modelname", "generationname", "seriename", "trimname"];
	
	$kind = $_GET["kind"];
	$path = explode("#", utf8_decode(urldecode($_GET["path"])));

	$stage = sizeof($path);
	if ($_GET["path"] == "") {
		$stage = 0;
	}
?>

<option value=""><?php echo $headlines[$kind]; ?></option>
	
<?php 
	if($stage >= $kind) {
		$link = mysqli_connect("localhost","root","");
		mysqli_select_db($link, "tuning_datenbankvol2");
		
		$sql = "";
		if ($stage <= 0) {
			$sql = "SELECT * FROM car_make";
		} else {
			$where = "";
			$select = "";
			$from = "";
			switch($stage) {
				case 4: 
					$select = ", trim.name AS trimname " . $select;
					$from = " INNER JOIN car_trim trim ON serie.id_car_serie = trim.id_car_serie " . $from;
					$where = " AND serie.name = '" . $path[3] . "' " . $where;
				case 3:
					$select = ", serie.name AS seriename " . $select;
					$from = " INNER JOIN car_serie serie ON generation.id_car_generation = serie.id_car_generation " . $from;
					$where = " AND generation.name = '" . $path[2] . "' " . $where;
				case 2: 
					$select = ", generation.name AS generationname, 
						generation.year_begin AS begin,
						generation.year_end AS end "
						. $select;
					$from = " INNER JOIN car_generation generation ON model.id_car_model = generation.id_car_model " . $from;
					$where = " AND model.name = '" . $path[1] . "' " . $where;
				case 1: 
					$select = "SELECT make.name AS makename " 
						. ", model.name AS modelname "
						. $select;
					$from = "FROM car_make make "
						. "INNER JOIN car_model model ON make.id_car_make = model.id_car_make"
						. $from;
					$where = " WHERE make.name = '" . $path[0] . "' " . $where;
			}
			$sql = $select . $from . $where . "GROUP BY " . $db[$stage];

			
		}
		
		$res = mysqli_query($link, $sql);
		while ($row = mysqli_fetch_array($res)) {  
			$value = utf8_encode($row[$db[$stage]]);
			$year_value = $value;
			if ($stage == 2) {
				$year_value .= " (" . $row["begin"] . "-" . $row["end"] . ")";
			}
			echo "<option value='$value'>$year_value</option>";
		} 
		
	}
?>