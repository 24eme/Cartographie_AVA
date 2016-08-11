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
        	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.2.3/leaflet.draw.css" /><!-- plugin règle (image)-->
	<link rel="stylesheet" href="https://makinacorpus.github.io/Leaflet.MeasureControl/leaflet.measurecontrol.css" /><!--plugin règle-->
	<link rel="stylesheet" href="http://localhost/DATA_AVA/leaflet.viewcenter.css" /> <!--plugin recentrer la carte-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"><!-- plugin slide menu (image)-->
	<link rel="stylesheet" href="http://localhost/DATA_AVA/L.Control.SlideMenu.css" /> <!--plugin menu-->
	
		

</head>
<body>

		<div id="entete">
		    
			 <div class="tableau">
			 <table>
			 
				<tr>
				
				<th>  </th>
				
				</tr>
				
				<tr><td><img src="AVA logo.jpg"width="180px "/> </td><td>Bienvenue sur le portail<br /> de l"Association des Viticulteurs d"Alsace</td></tr>
				
			 </table>
			 
			 </div> <!--fin div tableau-->
			
			</div> <!--fin div entete-->
		
	
	
	
		<div id="contenu">
				<div class="col1"><?php
		include ("formulaire_rapide.php");
		
		?>
			</div>
			
				<div class="col2"><div id="map" style="width:1200px; height: 630px"></div></div>
				</div>
		
	<script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script> <!-- Bibliothèque js Leaflet-->
	
		<!--Leaflet Plugins-->
	<script src="http://code.jquery.com/jquery-3.1.0.min.js"  
	integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s="   
	crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-ajax/2.0.0/leaflet.ajax.min.js"></script> <!-- Plugin d"affichage des GeoJSON-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.2.3/leaflet.draw.js"></script> <!-- plugin règle (image)-->
	<script src="https://makinacorpus.github.io/Leaflet.MeasureControl/leaflet.measurecontrol.js"></script> <!-- plugin règle-->
	<script src="http://localhost/DATA_AVA/leaflet.viewcenter.js"></script> <!-- plugin recentrage de la carte-->
	<script src="http://localhost/DATA_AVA/L.Control.SlideMenu.js"></script> <!-- plugin d"affichage du menu-->
	<script src="https://gist.githubusercontent.com/ethertank/1590113/raw/c7d577b72000a6b6079bcf62ecc553318d9d2b03/getRandomColor.js"></script>
	
	
	<script>
	//Ajout de markers de localisation des villes
		
		var cities = new L.LayerGroup() ;
	
		L.marker([48.1056,7.38556]).bindPopup("<b>Bienvenue à Colmar</b><br />").addTo(cities),
		L.marker([48.1951,7.3194]).bindPopup("<b>Bienvenue à Ribeauvillé</b><br />").addTo(cities),
		L.marker([48.4076,7.4487]).bindPopup("<b>Bienvenue à Barr</b><br />").addTo(cities),
		L.marker([48.5404, 7.492]).bindPopup("<b>Bienvenue à Molsheim</b><br />").addTo(cities),
		L.marker([47.9167,7.2]).bindPopup("<b>Bienvenue à Guebwiller</b><br />").addTo(cities),
		L.marker([47.9579,7.3002]).bindPopup("<b>Bienvenue à Rouffach</b><br />").addTo(cities),
		L.marker([49.0333,7.95]).bindPopup("<b>Bienvenue à Wissembourg</b><br />").addTo(cities);
		
		// Attribution et sources + liens d"accès aux tuiles Mapbox
	    var mbAttr = "Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, " +
				"<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, " +
				"Imagery © <a href="http://mapbox.com">Mapbox</a>",
			mbUrl = "https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpandmbXliNDBjZWd2M2x6bDk3c2ZtOTkifQ._QA7i5Mpkd_m30IGElHziw";
			
			//Outil d"aafichage des couches initiales	
			
		  var  satellite  = L.tileLayer(mbUrl, {id: "mapbox.satellite",opacity: 0.8, attribution: mbAttr, maxZoom: 18, minZoom : 11}),
				streets   = L.tileLayer(mbUrl, {id: "mapbox.streets", attribution: mbAttr, maxZoom: 11, minZoom : 0});
		  
			// Affichage des couches GeoJSON
		var contour = new L.GeoJSON.AJAX("http://localhost/DATA/Alsace_admin/testcontour.geojson", {style: stylecontour});
			function stylecontour(feature){
				return{
					weight: 4,
					opacity: 1,
					color: " ThreedShadow ", //contour
					fillColor: "none"
						};
							} 

		var aocparc = new L.GeoJSON.AJAX("http://localhost/DATA/Alsace_AOC/aocparc2.geojson", {style: styleaocparc});
			function styleaocparc(feature){
				return{
					weight: 1,
					opacity: 0.5,
					color: "Azure", //contour
					fillColor: "Azure", //remplissage
					fillOpacity: 0.6
						};
							}
			
		var comviti = new L.GeoJSON.AJAX("http://localhost/DATA/Alsace_AOC/comviticole.geojson", {style: stylecomviti});
				function stylecomviti(feature){
					return{
						weight: 1,
						opacity: 1,
						color: "#CECECE", //contour
						fillColor: "Silver", //remplissage
						fillOpacity: 0.6
							};
								}		
	
	
			var getRandomColor;
		var pe = new L.GeoJSON.AJAX("http://localhost/DATA/PE/pe_combine.geojson", {style: planEncepagement2 }, {onEachFeature: onEachFeature} );
		
	function planEncepagement2(feature){	
	return{
						weight: 1,
						opacity: 1,
						color: "#CECECE", //contour
						fillColor: getRandomColor2(), //remplissage avec une couleur aléatoire
						fillOpacity: 0.6
							};	
		
	}
	
	
function getRandomColor2() { // Du coup sans les parametres
    var letters = "0123456789ABCDEF".split('');
    var color = "#";
    for (var i = 0; i < 6; i++ ) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}
 
function onEachFeature(feature, pe_combine) {
    if (feature.properties && feature.properties.name) {
        pe_combine.bindPopup(feature.properties.name);
    }
}
	
var maCouleurAleatoire = getRandomColor();
console.log(maCouleurAleatoire); // ceci imprime dans la console firebug le contenu de maCouleurAleatoire

	
	var sols = new L.GeoJSON.AJAX("https://github.com/24eme/Cartographie_AVA/blob/gh-pages/DATA/DonneesSols/paysages_ok.geojson" ,{style:styleSOLS});
							function styleSOLS(feature){
  return{
    fillColor: getColor(feature.properties.PAYSAGE),
    weight: 1,
    opacity: 0.4,
	color: "none",
    fillOpacity: 0.7
  };
  
}
function getColor(a){
  return  a== "Terrains argilo-marneux et marno-calcaires" ? "#462E01": //marron foncé 
a== "Terrains de bas fonds" ? "#77B5FE": //bleu clair
a== "Terrains de Lehm" ? "#DF6D14": //orange
a== "Terrains � calcaire dur" ? "#FEF86C": //jaune clair
a== "Terrains � conglom�rat calcaire ou d�carbonat�" ? "#C7CF00": // jaune-vert
a== "Terrains alluviaux et glacis d"�pandage anciens" ? "#25FDE9": //turquoise
a== "Terrains alluviaux r�cents" ? "green": //vert
a== "Terrains argilo ou calcaro-gr�seux" ? "#87591A": //marron clair
a== "Terrains granitiques et gneissiques" ? "#FD6C9E": //rose
a== "Terrains gr�seux" ? "#FEBFD2": //rose clair
a== "Terrains loessiques" ? "#FFFF00": //jaune
a== "Terrains sablo-caillouteux sur argile lourde" ? "#357AB7": //bleu foncé
a== "Terrains schisteux et volcaniques" ? "#660099": //violet
		  
                  "none"; }  ';
        //et puis à un moment
        echo "		var map = L.map('map', {
			center: [" . $result2_f['x'].' '. . ", " . $result2_f['y'] .  " ],
			zoom: 8,
			layers: [streets, cities]
		});"
		
		var baseLayers = {
			"Plan": streets	
		};

		var overlays = {
			"Imagerie": satellite,
			"Contour Administratif": contour,
			"Communes Viticoles": comviti,
			"Parcelles AOC": aocparc,
			"Plan d\'encépagement": pe,
			"Données des sols": sols,
			"Villes": cities
		};

  
		L.control.layers(baseLayers, overlays).addTo(map);
		

		satellite.addTo(map);
		contour.addTo(map);
		aocparc.addTo(map);
		comviti.addTo(map);
		pe.addTo(map);
		sols.addTo(map);
		
		//Outil de mesure
	L.Control.measureControl({position: "topright"}).addTo(map);
 
		// Zoom page entière: on centre large
		var viewCenter = new L.Control.ViewCenter();
		map.addControl(viewCenter);

		//Echelle
	L.control.scale({position:\'bottomright\', imperial: false}).addTo(map); ';
		 //et puis le reste j'usqu'à la fin
		 echo '
</script> <!-- fin de script js-->
	
	</body>
</html>';

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
