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
		
			if(isset($_POST["commune"]) && isset($_POST["section"]) && isset($_POST["parcelle"]))
			{
				$dbconn=pg_connect("host = localhost port = 5432 dbname=AVA user=postgres password=postgres");
			$nomville=$_POST['commune'];
			$section=$_POST['section'];
			$parcelle=$_POST['parcelle'];
			$result=pg_query($dbconn, "SELECT count(*) from \"BR_FORM\" where \"NomVille\"  = '$nomville' and sec='$section' and parc=$parcelle");
			
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
					$result2=pg_query($dbconn, "SELECT \"NomVille\", sec, parc from \"BR_FORM\" where \"NomVille\"  = '$nomville'  and sec='$section' and parc=$parcelle");
					
					
				while($result2_f=pg_fetch_array($result2))
				{
					
					echo "<p>".$result2_f['NomVille'].' '.$result2_f['sec'].' '.$result2_f['parc']."</p>";
					
				}
			}
				}
			}
				?>
			
			
		
		
</body>
</html>