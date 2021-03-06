<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
	
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	 
 
    <title>Simple markers</title>
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
  </head>
  <body>
   
	<div class="row">
	  <div class="col-md-2 col-md-offset-5">
	<form>
        <h4 class="text-center"> Category:</h4>  <select class="form-control" id="job_category">
                        <option value="null">Please Choose Job</option>
                        <option value="DevOps">DevOps</option>
                        <option value="Test">Test</option>
                        <option value="BA">BA</option>
                        <option value="PM">Project Management</option>
                        <option value="ET">Education/Training</option>
                        </select></br>
		 <select class="form-control" id="location">
                        <option value="null">Please Choose Location</option>
                        <option value="A">Auckland</option>
                        <option value="W">Wellington</option>
                        <option value="C">Christchurch</option>
                        <option value="D">Dunedin</option>
                        
                        </select></br>
		 <select class="form-control" id="money">
                        <option value="null">Please Choose payment</option>
                        <option value="V">Volunteer</option>
                        <option value="20">$20</option>
                        <option value="30">$30</option>
                        <option value="40">$40</option>
                        
                        </select></br>
  <h5 class="text-center"> Description:</h5>  
      <textarea class="form-control" rows="5" id="comment" required></textarea></br>
        <button type="button" class="btn btn-danger center-block" onclick="initMap()">Post</button> 
		   <button type="button" class="btn btn-success center-block" onclick="save()">Post</button></br>
          </form>
		  
		  
	 <div id="demo"></div>
	</div>
	</div>
	 
	 <div id="map"></div></br></br>
	 <script> 

	  
      function initMap() {	
 var category=document.getElementById("job_category").value;
	  var location=document.getElementById("location").value;
	  var money=document.getElementById("money").value;
	  var info=document.getElementById("comment").value;	  
	  var description='Select category';
	 
	 var image = 'AA';
	 var myLatLng = {lat: 0, lng: 0};
	 var contentString = 'AA';
	 
	
	if (category=="DevOps")
	{
		 image = 'http://icons.iconarchive.com/icons/iconexpo/speech-balloon-orange/48/speech-balloon-orange-d-icon.png';
		 description='DevOps';
		contentString='DevOps';
	}
	else if(category=="Test"){
	 image = 'http://icons.iconarchive.com/icons/iconexpo/speech-balloon-orange/48/speech-balloon-orange-t-icon.png';
	 description='Test';
	 contentString='Test';
	}
	else if(category=="BA"){
	 image = 'http://icons.iconarchive.com/icons/iconexpo/speech-balloon-orange/48/speech-balloon-orange-b-icon.png';
	 description='Business Analyst';
	 contentString='Business Analyst';
	}
	else if(category=="PM"){

	 image = 'http://icons.iconarchive.com/icons/iconexpo/speech-balloon-orange/48/speech-balloon-orange-p-icon.png';
	 description='Project Management';
	 contentString='Project Management';
	}
	else if(category=="ET"){
	 image = 'http://icons.iconarchive.com/icons/iconexpo/speech-balloon-orange/48/speech-balloon-orange-e-icon.png';
	 description='Education/Training';
	 contentString='Education/Training';
	}
	else{
	
	image = 'http://icons.iconarchive.com/icons/iconka/meow-2/64/cat-hungry-icon.png';
	description='No job mate!';
	contentString='No job mate';
	}
	
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
	description='No job mate!';
	}
	
	if(money=="V"){
	
	contentString=contentString + '/ ' + 'Volunteer' + '/' + info;
	}
	else if(money=="20"){
	
	contentString=contentString + '/ ' + '$20' + '/' + info;
	}
	else if(money=="30"){
	
	contentString=contentString + '/ ' + '$30' + '/' + info;
	}
	else if(money=="40"){
	
	contentString=contentString + '/ ' + '$40' + '/' + info;
	}
	else
	{
	contentString=contentString + '/' + 'No payment selected';
	
	}
	
	  
	 //document.getElementById("demo").innerHTML = image;
       // var myLatLng = {lat: -45.86718, lng: 170.50482};

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: myLatLng, 
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
          ]
        });
		map.setOptions({draggable: false, zoomControl: false, scrollwheel: false, disableDoubleClickZoom: true});

	
                     
	//window.location.href = "ajax.php?name=" + job; 
        var infowindow = new google.maps.InfoWindow({
          content: contentString
        });
		
		 
		
		
	    // var image = 'http://icons.iconarchive.com/icons/atyourservice/service-categories/32/Plumbing-icon.png';
        var marker = new google.maps.Marker({
          position: myLatLng,
		   animation: google.maps.Animation.DROP,
          map: map,
		  icon: image,
		  
          title: description
        });
       marker.addListener('click', toggleBounce);
	   
	   marker.addListener('click', function() {
          infowindow.open(map, marker);
        });
	   function toggleBounce() {
        if (marker.getAnimation() !== null) {
          marker.setAnimation(null);
        } else {
          marker.setAnimation(google.maps.Animation.BOUNCE);
        }
      }
	  var a='';
	  var b='';
	    this.a = category; 
		  this.b = myLatLng; 
		   this.c = money; 
		    this.d = info; 
	  }
	   

      function save() {	
	  var objnew1= new initMap();
	 var loca= JSON.stringify(objnew1.b);

					var job=objnew1.a;					
				 
					var jobMoney = objnew1.c; 
					var jobInfo = objnew1.d; 
					//var job = category;
                    //var jobMoney = money;
					//var jobInfo=info; 					
					
                  
					window.location.href = "ajax.php?name=" + job + "&PostData2=" + loca + "&PostData3=" + jobMoney + "&PostData4=" + jobInfo;  
					//window.location.href = "ajax.php?loca=" + jobLocation;  
	  
	  
	  }
    </script>	
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAyMpixev2LyxXcxJGYlMaqkeYj_TFc8Vg
&callback=initMap">
    </script>
	 
	
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
  </body>
</html>