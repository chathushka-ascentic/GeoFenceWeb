
<div class="col-xs-12 col-md-8"><div id="map" style="width: 700px; height: 400px;"></div>
 <?php
   $longitude= array(
  'id' =>'longitude',
  'name' =>'longitude',
  'class' => 'form-control',
  'value' =>$v_longitude,
  'type' =>'text',
  'placeholder' => 'Longitude'
  );
  $latitude=  array(
  'id' =>'latitude',
  'name' =>'latitude',
  'class' => 'form-control',
  'value' =>$v_latitude,
  'type' =>'text',
  'placeholder' => 'Latitude'
  );

 $radius=  array(
  'id' =>'radius',
  'name' =>'radius',
  'class' => 'form-control',
  'value' =>$v_radius,
  'type' =>'text',
  'placeholder' => 'Radius'
  );

?>

</div>
<div class="col-xs-6 col-md-4">
    <form action="setfencer" method="post">
    <div class="form-group">
        <label for="longitude">Longitude</label>
        <?php echo form_input($longitude); ?>
    </div>
    <div class="form-group">
        <label for="latitude">Latitude</label>
        <?php echo form_input($latitude); ?>
    </div>

    <div class="form-group">
        <label for="radius">Radius (in Meters)</label>
        <?php echo form_input($radius); ?>
    </div>
    <input id='coordinate' class="btn btn-default" type="button" value="Goto coordinates">
    <button type="submit" class="btn btn-default">Save Marker</button>
    
    <?php if($submitted != ""){ ?>
        <div class="alert alert-success" role="alert"><?php echo $submitted ?></div>
    <?php } ?>
    <?php echo validation_errors('<p class="alert alert-danger">'); ?>
    </form>

</div>

<script src="<?php echo site_url('../js/jquery.googlemap.js'); ?>"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC4iC_e54q6-IOuR_fCHQX7m_RCVqJu4XI"></script>

<script type="text/javascript">
$(document).ready(function(){
    var lat =  $("#latitude").val();
    var long = $("#longitude").val();

    $("#map").googleMap({
          scrollwheel:true,
      zoom: 10, // Initial zoom level (optional)
      coords: [lat, long], // Map center (optional)
      type: "ROADMAP" // Map type (optional)
    });

    $("#map").addMarker({
            id: 'marker1',
        draggable: true,
        scrollwheel:true,
        coords: [lat, long],// Postal address
    	success: function(e) {
    	    $("#latitude").val(e.lat);
    	    $("#longitude").val(e.lon);
    	}
	    });
   
    function addMarker(){
        $("#map").addMarker({
            id: 'marker1',
        draggable: true,
        zoom: 100,
        scrollwheel:true,
    	coords: [lat, long], // Postal address
    	success: function(e) {
    	    $("#latitude").val(e.lat);
    	    $("#longitude").val(e.lon);
    	}
	    });
    }
    
    function cleanMarker(){
        $("#map").removeMarker("marker1");
    }
    
    $('#coordinate').click(function(){
        cleanMarker();
        addMarker();
    });


  })
</script>

