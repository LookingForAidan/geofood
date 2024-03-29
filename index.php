<?php
?>

<!DOCTYPE html>
<html lang="en">
  <head>

  	<title>GeoFood</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">



<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>




<style>
#toptext{
	height: 100%;
}

#map_canvas{
       	height: 85%;
       	width: 98%;
       	position: absolute;
     	left:0;
 	right: 0;
 	margin-right: auto;
 	margin-left: auto;
      }
#map_canvas img{ 
	max-width: none;

}
#map_canvas label{
	width: auto; display: inline;
}
</style>








<!--Linking to the jQuery library.-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript"></script>

<!--Linking to the Google Maps API-->
<script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDPHuX3mEiwT882qPscfVccvtFMFXH31EY&sensor=true">
</script>

<script type="text/javascript">

var lat = 0;
var long = 0;


$(document).ready(function(){
  
  






//Connects to the Flickr API and reads the results of the query into a JSON array. This query uses the 'flickr.photos.search' method to access all the photos in a particular person's user account. It also uses arguments to read in the latitude and longitude of each picture. It passes the resultant JSON array to the 'displayImages3' function below.
$.getJSON('https://api.flickr.com/services/rest/?method=flickr.photos.search&api_key=14297ac064071890b801ebfad557487f&tags=food,drink,coffee&has_geo=1&extras=geo&format=json&jsoncallback=?', displayImages3);






function displayImages3(data){
	
	                //Loop through the results in the JSON array. The 'data.photos.photo' bit is what you are trying to 'get at'. i.e. this loop looks at each photo in turn.
                    $.each(data.photos.photo, function(i,item){
					
					//Read in the lat and long of each photo and stores it in a variable.
                    lat = item.latitude;
					long = item.longitude;
					
					//Get the url for the image.
					var photoURL = 'http://farm' + item.farm + '.static.flickr.com/' + item.server + '/' + item.id + '_' + item.secret + '_m.jpg';
					htmlString = '<img src="' + photoURL + '">';
					var contentString = '<div id="content">' + htmlString + '</div>';

					//Create a new info window using the Google Maps API
					var infowindow = new google.maps.InfoWindow({
						 //Adds the content, which includes the html to display the image from Flickr, to the info window.
  		 				 content: contentString
					});

					//Create a new marker position using the Google Maps API.
					var myLatlngMarker = new google.maps.LatLng(lat,long);

					//Create a new marker using the Google Maps API, and assigns the marker to the map created below.
					var marker = new google.maps.Marker({
   					position: myLatlngMarker,
     				map: myMap,
     				title:"Photo"
					});

					//Uses the Google Maps API to add an event listener that triggers the info window to open if a marker is clicked.
					google.maps.event.addListener(marker, 'click', function() {
  					infowindow.open(myMap,marker);
					});
		});
}

});

</script>

</head>
<body>
	<center>
	
	
			<div id="toptext">


   				 <h2>Hello, World!</h2>
    			<p>19% of people post pictures of thier food online, let's have a look.</p>
</div>

	


    

<div id="map_canvas">
	
<script>
//Using the Google Maps API to create the map.
var myLatlngCenter = new google.maps.LatLng(50,0);
var mapOptions = {
          center: myLatlngCenter,
          zoom: 3,
          mapTypeId: google.maps.MapTypeId.ROADMAP
};
var myMap = new google.maps.Map(document.getElementById("map_canvas"),mapOptions);
</script>
</div>
</center>
</body>
</html># geofood 
