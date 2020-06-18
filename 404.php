<?php include "inc/header.php"; ?>
	
	<div class="Contentsection templete clear">

		<div class="MainContent clear">
			<div class="about">
				<div class="notfound">
    				<p><span>404</span> Not Found</p>
    			</div>		
			</div>


			<!-- <div class="googlemap">
				<div id="map"></div>

			</div> -->
		</div>


	<?php include "inc/sidebar.php"; ?>

<?php include "inc/footer.php"; ?>

<!-- <script src="http://maps.google.com/maps/api/js"></script>
  <script src="js/gmaps.js"></script>

 <script type="text/javascript">
    var map;
    $(document).ready(function(){
      var map = new GMaps({
        el: '#map',
        lat: 23.7808875,
        lng: 90.2792374
      });
 

      GMaps.geolocate({
        success: function(position){
          map.setCenter(position.coords.latitude, position.coords.longitude);
        },
        error: function(error){
          alert('Geolocation failed: '+error.message);
        },
        not_supported: function(){
          alert("Your browser does not support geolocation");
        },
        always: function(){
          alert("Done!");
        }
      });
    });
  </script> -->
