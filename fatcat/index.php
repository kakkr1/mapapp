<?php
session_start();
include_once 'dbconnect.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>Google Map</title>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

 <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
       width: 90%; height: 500px;margin-top:0px;margin-left:auto;margin-right:auto; 
		 
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
<style type="text/css">
h1.heading{padding:0px;margin: 0px 0px 10px 0px;text-align:center;font: 18px Georgia, "Times New Roman", Times, serif;}

/* width and height of google map */
#google_map {width: 90%; height: 500px;margin-top:0px;margin-left:auto;margin-right:auto;}

/* Marker Edit form */
.marker-edit label{display:block;margin-bottom: 5px;}
.marker-edit label span {width: 100px;float: left;}
.marker-edit label input, .marker-edit label select{height: 24px;}
.marker-edit label textarea{height: 60px;}
.marker-edit label input, .marker-edit label select, .marker-edit label textarea {width: 60%;margin:0px;padding-left: 5px;border: 1px solid #DDD;border-radius: 3px;}

/* Marker Info Window */
h1.marker-heading{color: #585858;margin: 0px;padding: 0px;font: 18px "Trebuchet MS", Arial;border-bottom: 1px dotted #D8D8D8;}
div.marker-info-win {max-width: 300px;margin-right: -20px;}
div.marker-info-win p{padding: 0px;margin: 10px 0px 10px 0;}
div.marker-inner-win{padding: 5px;}
button.save-marker, button.remove-marker{border: none;background: rgba(0, 0, 0, 0);color: #00F;padding: 0px;text-decoration: underline;margin-right: 10px;cursor: pointer;
}
.img-center {margin:0 auto;}</style>
</head>
<body>       
<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php">Fat Cat</a>
		</div>
		<div class="collapse navbar-collapse" id="navbar1">
			<ul class="nav navbar-nav navbar-right">
				<?php if (isset($_SESSION['usr_id'])) {echo $_SESSION['usr_id']; ?>
				<li><p class="navbar-text">Signed in as <?php echo $_SESSION['usr_name']; ?></p></li>
				<li><a href="logout.php">Log Out</a></li><br>
				
				<?php } else { ?>
				<li><a href="login.php">Login</a></li>
				<li><a href="register.php">Sign Up</a></li>
				<?php } ?>
			</ul>
		</div>
	</div>
</nav>   
<?php if (isset($_SESSION['usr_id'])) { ?>
<div class="row">
	  <div class="col-md-2 col-md-offset-5">
	<form>
        </br></br>
		 <h4 class="text-center"> Choose Location:</h4> 
		 <select class="form-control" id="location" onchange="map_initialize()">
                        <option value="null">Please Choose Location</option>
                        <option value="A">Auckland</option>
                        <option value="W">Wellington</option>
                        <option value="C">Christchurch</option>
                        <option value="D">Dunedin</option>
                        
                        </select></br>
	  <button type="button" id="mapsingle"class="btn btn-danger center-block" onclick="map_initialize()"><i>Run</i></button>  </br>
	    <button type="button" id="mapall" class="btn btn-danger center-block"  ><i>Run All</i></button>  </br>
          </form>
		  
		  
	 <div id="demo"></div>
	 <!--
	 
	 <ul class="list-group">
	 <h4 class="text-center"> Total Jobs:</h4> 
	  
  <li id="aa" class="list-group-item"> </li>
  
</ul>

-->
	</div>

	</div>   
 

<div id="google_map"></div></br></br>
<?php } else { ?>
 
<img src="icons/cat.jpg" class="img-responsive img-circle img-center" alt="Cinque Terre">
 

<?php } ?>

<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAyMpixev2LyxXcxJGYlMaqkeYj_TFc8Vg
&callback=initMap"></script>
<script type="text/javascript">
 
 var marker="marker";
		var yes = document.getElementById("mapall");
var no = document.getElementById("mapsingle");

	
var mapCenter = new google.maps.LatLng(47.6145, -122.3418); //Google map Coordinates
	var map;
	
	var myLatLng = {lat: 0, lng: 0};
	 yes.onclick = function() {
   
	marker="markerall";
	 map_initialize(); 
}	
 no.onclick = function() {
   
	marker="marker";
	 map_initialize(); 
}	
	 map_initialize(); // initialize google map
	
	//############### Google Map Initialize ##############
	function map_initialize()
	{
		var location=document.getElementById("location").value;
		if(location=="A"){
	 myLatLng = {lat: -36.8440353, lng: 174.7648781}; 
	
	}
	else if(location=="W"){
	myLatLng = {lat: -41.2854538, lng: 174.774864};  
	}
	else if(location=="C"){
	myLatLng = {lat: -43.5262519, lng:  172.6306705}; 
	}
	else if(location=="D"){
	myLatLng = {lat: -45.86718, lng: 170.50482};  
	}
	else{
	myLatLng = {lat: 0, lng: 0};  
	}
			var googleMapOptions = 
			{ 
				center: myLatLng, // map center
				zoom: 15, //zoom level, 0 = earth view to higher value
				  disableDefaultUI: true,
				styles: [
            {elementType: 'geometry', stylers: [{color: '#242f3e'}]},
            {elementType: 'labels.text.stroke', stylers: [{color: '#242f3e'}]},
            {elementType: 'labels.text.fill', stylers: [{color: '#746855'}]},
            {
              featureType: 'administrative.locality',
              elementType: 'labels.text.fill',
              stylers: [{color: '#d59563'}]
            },
            {
              featureType: 'poi',
              elementType: 'labels.text.fill',
              stylers: [{color: '#d59563'}]
            },
            {
              featureType: 'poi.park',
              elementType: 'geometry',
              stylers: [{color: '#263c3f'}]
            },
            {
              featureType: 'poi.park',
              elementType: 'labels.text.fill',
              stylers: [{color: '#6b9a76'}]
            },
            {
              featureType: 'road',
              elementType: 'geometry',
              stylers: [{color: '#38414e'}]
            },
            {
              featureType: 'road',
              elementType: 'geometry.stroke',
              stylers: [{color: '#212a37'}]
            },
            {
              featureType: 'road',
              elementType: 'labels.text.fill',
              stylers: [{color: '#9ca5b3'}]
            },
            {
              featureType: 'road.highway',
              elementType: 'geometry',
              stylers: [{color: '#746855'}]
            },
            {
              featureType: 'road.highway',
              elementType: 'geometry.stroke',
              stylers: [{color: '#1f2835'}]
            },
            {
              featureType: 'road.highway',
              elementType: 'labels.text.fill',
              stylers: [{color: '#f3d19c'}]
            },
            {
              featureType: 'transit',
              elementType: 'geometry',
              stylers: [{color: '#2f3948'}]
            },
            {
              featureType: 'transit.station',
              elementType: 'labels.text.fill',
              stylers: [{color: '#d59563'}]
            },
            {
              featureType: 'water',
              elementType: 'geometry',
              stylers: [{color: '#17263c'}]
            },
            {
              featureType: 'water',
              elementType: 'labels.text.fill',
              stylers: [{color: '#515c6d'}]
            },
            {
              featureType: 'water',
              elementType: 'labels.text.stroke',
              stylers: [{color: '#17263c'}]
            }
          ],
				zoomControlOptions: {
				style: google.maps.ZoomControlStyle.SMALL //zoom control size
			},
				scaleControl: true, // enable scale control
				mapTypeId: google.maps.MapTypeId.ROADMAP // google map type
			};
	
		   	map = new google.maps.Map(document.getElementById("google_map"), googleMapOptions);			
			
		
			//	var text="";
		
			
			//Load Markers from the XML File, Check (map_process.php)
			$.get("map_process.php", function (data) {
				$(data).find(marker).each(function () {
						var name ;
						var address ;
						var type ;
						var point ;
					    name 		= $(this).attr('name');
					    address 	= '<p>'+ $(this).attr('address') +'</p>';
					    type 		= $(this).attr('type');
					    point 	= new google.maps.LatLng(parseFloat($(this).attr('lat')),parseFloat($(this).attr('lng')));
					  create_marker(point, name, address, false, false, false, "http://icons.iconarchive.com/icons/iconka/saint-whiskers/32/cat-food-hearts-icon.png");
		
					//for (var i = 0; i < type.length; i++) { 
						//	 text += type[i]  ;
					//	}
						 
						//text=text+" <br>";
						//console.log(text); //gives the default message
				  //document.getElementById('aa').innerHTML = text;
				//  document.getElementById('aa').innerHTML = text;
				
				 
				 
				}
				);				  
		
			});	
			 
				//map.setOptions({draggable: false, zoomControl: false, scrollwheel: false, disableDoubleClickZoom: true});
			//Right Click to Drop a New Marker
			google.maps.event.addListener(map, 'click', function(event) {
				//Edit form to be displayed with new marker
				var EditForm = '<p><div class="marker-edit">'+
				'<form action="ajax-save.php" method="POST" name="SaveMarker" id="SaveMarker">'+
				'<label for="pName"><span>Place Name :</span><input type="text" name="pName" class="save-name" placeholder="Enter Title" maxlength="40" /></label>'+
				'<label for="pDesc"><span>Description :</span><textarea name="pDesc" class="save-desc" placeholder="Enter Address" maxlength="150"></textarea></label>'+
				' <h4 class="text-center"> Category:</h4>  <select name="pType" class="save-type" >  <option value="null">Please Choose Category...</option>'+
                        '<option value="DevOps">DevOps</option>'+
                       '<option value="Test">Test</option>'+
                        '<option value="BA">BA</option>'+
                        '<option value="PM">Project Management</option>'+
                        '<option value="ET">Education/Training</option>'+
                        '</select></br>'+
				'</form>'+
				'</div></p><button name="save-marker" class="save-marker">Save Marker Details</button>';
				
				
 
				
				//Drop a new Marker with our Edit Form
				create_marker(event.latLng, 'New Marker', EditForm, true, true, true, "http://icons.iconarchive.com/icons/iconka/meow-2/32/cat-sing-icon.png");
			});
										
	}
	
	//############### Create Marker Function ##############
	function create_marker(MapPos, MapTitle, MapDesc,  InfoOpenDefault, DragAble, Removable, iconPath)
	{	  	  		  
		
		//new marker
		var marker = new google.maps.Marker({
			position: MapPos,
			map: map,
			draggable:DragAble,
			animation: google.maps.Animation.DROP,
			title:"Hello World!",
			icon: iconPath
		});
		
		//Content structure of info Window for the Markers
		var contentString = $('<div class="marker-info-win">'+
		'<div class="marker-inner-win"><span class="info-content">'+
		'<h1 class="marker-heading">'+MapTitle+'</h1>'+
		MapDesc+ 
		'</span><button name="remove-marker" class="remove-marker" title="Remove Marker">Remove Marker</button>'+
		'</div></div>');	

		
		//Create an infoWindow
		var infowindow = new google.maps.InfoWindow();
		//set the content of infoWindow
		infowindow.setContent(contentString[0]);

		//Find remove button in infoWindow
		var removeBtn 	= contentString.find('button.remove-marker')[0];
		var saveBtn 	= contentString.find('button.save-marker')[0];

		//add click listner to remove marker button
		google.maps.event.addDomListener(removeBtn, "click", function(event) {
			remove_marker(marker);
		});
		
		if(typeof saveBtn !== 'undefined') //continue only when save button is present
		{
			//add click listner to save marker button
			google.maps.event.addDomListener(saveBtn, "click", function(event) {
				var mReplace = contentString.find('span.info-content'); //html to be replaced after success
				var mName = contentString.find('input.save-name')[0].value; //name input field value
				var mDesc  = contentString.find('textarea.save-desc')[0].value; //description input field value
				var mType = contentString.find('select.save-type')[0].value; //type of marker
				
				if(mName =='' || mDesc =='')
				{
					alert("Please enter Name and Description!");
				}else{
					save_marker(marker, mName, mDesc, mType, mReplace); //call save marker function
			 
				}
			});
		}
		
		//add click listner to save marker button		 
		google.maps.event.addListener(marker, 'click', function() {
				infowindow.open(map,marker); // click on marker opens info window 
	    });
		  
		if(InfoOpenDefault) //whether info window should be open by default
		{
		  infowindow.open(map,marker);
		}
	}
	
	//############### Remove Marker Function ##############
	function remove_marker(Marker)
	{
		
		/* determine whether marker is draggable 
		new markers are draggable and saved markers are fixed */
		if(Marker.getDraggable()) 
		{
			Marker.setMap(null); //just remove new marker
		}
		else
		{
			//Remove saved marker from DB and map using jQuery Ajax
			var mLatLang = Marker.getPosition().toUrlValue(); //get marker position
			var myData = {del : 'true', latlang : mLatLang}; //post variables
			$.ajax({
			  type: "POST",
			  url: "map_process.php",
			  data: myData,
			  success:function(data){
					Marker.setMap(null); 
					alert(data);
				},
				error:function (xhr, ajaxOptions, thrownError){
					alert(thrownError); //throw any errors
				}
			});
		}

	}
	
	//############### Save Marker Function ##############
	function save_marker(Marker, mName, mAddress, mType, replaceWin)
	{
		//Save new marker using jQuery Ajax
		var mLatLang = Marker.getPosition().toUrlValue(); //get marker position
		var myData = {name : mName, address : mAddress, latlang : mLatLang, type : mType }; //post variables
		console.log(replaceWin);		
		$.ajax({
		  type: "POST",
		  url: "map_process.php",
		  data: myData,
		  success:function(data){
				replaceWin.html(data); //replace info window with new html
				Marker.setDraggable(false); //set marker to fixed
				Marker.setIcon('http://icons.iconarchive.com/icons/iconka/saint-whiskers/32/cat-food-hearts-icon.png'); //replace icon
            },
            error:function (xhr, ajaxOptions, thrownError){
                alert(thrownError); //throw any errors
            }
		});
	}

 		
</script>
</body>
</html>