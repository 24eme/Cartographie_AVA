<!DOCTYPE html>
<html>
<head>
	<title>Cartographie AVA </title>
	<meta charset="utf-8" />

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	
</head>
<body>
	
				<?php
				include ('Cartographie_AVA.php');
		
		?>
				
			<?php
			echo "<h3>Formulaire Bas-Rhin</h3>";
			if(isset($_POST["commune"]) && isset($_POST["section"]) && isset($_POST["parcelle"]))
			{
				$dbconn=pg_connect("host = localhost port = 5432 dbname=AVA user=postgres password=postgres");
			$nomville=$_POST['commune'];
			$section=$_POST['section'];
			$parcelle=$_POST['parcelle'];
			$result=pg_query($dbconn, "SELECT count(*) from \"BR_FORM\" where nomville = '$nomville' and section='$section' and tex='$parcelle'");
			
			$result_f=pg_fetch_array($result);
			
			
			if( ! $result)
			{
				echo "Problème lors de la requête SQL";
			}
			else
				{
				if($result_f['count']==0)
				{
				echo "<h3>Aucun résultats ne correspond à votre recherche!</h3>"	;
				}
				else{
					$result2=pg_query($dbconn, "SELECT nomville, section, tex, x, y from \"BR_FORM\" where nomville  = '$nomville'  and section='$section' and tex='$parcelle'");
					
					
				while($result2_f=pg_fetch_array($result2))
				{
					
					echo "<p>".$result2_f['nomville'].' '.$result2_f['section'].' '.$result2_f['tex'].' '.$result2_f['x'].' '.$result2_f['y']."</p>";
					
				}
			}
				}
			}
				
			echo "<h3>Formulaire Haut-Rhin</h3>";
			if(isset($_POST["commune"]) && isset($_POST["section"]) && isset($_POST["parcelle"]))
			{
				$dbconn=pg_connect("host = localhost port = 5432 dbname=AVA user=postgres password=postgres");
			$nomville=$_POST['commune'];
			$section=$_POST['section'];
			$parcelle=$_POST['parcelle'];
			$result=pg_query($dbconn, "SELECT count(*) from \"HR_FORM\" where nomville = '$nomville' and section='$section' and numero='$parcelle'");
			
			$result_f=pg_fetch_array($result);
			
			
			if( ! $result)
			{
				echo "Problème lors de la requête SQL";
			}
			else
				{
				if($result_f['count']==0)
				{
				echo "<h3>Aucun résultats ne correspond à votre recherche!</h3>"	;
				}
				else{
					$result2=pg_query($dbconn, "SELECT nomville, section, numero, x, y from \"HR_FORM\" where nomville  = '$nomville'  and section='$section' and numero='$parcelle'");
					
					
				while($result2_f=pg_fetch_array($result2))
				{
					// Ici par exemple tu pourrais écrire tout l'équivalent de index.php genre
					
					echo '<!DOCTYPE html>
<html>
<head>
	<title>Cartographie AVA </title>
	<meta charset="utf-8" />

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.css" /> <!-- style Leaflet-->
        ....';
        //et puis à un moment
        echo "		var map = L.map('map', {
			center: [" . $result2_f['x'].' '. . ", " . $result2_f['y'] .  " ],
			zoom: 8,
			layers: [streets, cities]
		});"
		 //et puis le reste j'usqu'à la fin
		 echo '
</script> <!-- fin de script js-->
	
	</body>
</html>';
		
					
					echo "<p>".$result2_f['nomville'].' '.$result2_f['section'].' '.$result2_f['numero'].' '.$result2_f['x'].' '.$result2_f['y']."</p>";
					
				}
			}
				}
			}
				?>
			
			
		
		
</body>
</html>
