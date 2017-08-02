  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

 <?php
   $usernamefield= array(
  'id' =>'usernamefield',
  'name' =>'usernamefield',
  'class' => 'form-control',
  'value' =>'',
  'type' =>'text',
  'placeholder' => 'Username'
  );
  $datetimefield=  array(
  'id' =>'datetimefield',
  'name' =>'datetimefield',
  'class' => 'form-control',
  'value' =>'',
  'type' =>'text',
  'placeholder' => 'Date'
  );


?>
<div class="col-xs-6 col-md-4">
    <form action="browsechecksbyuser" method="post">
    <div class="form-group">
        <label for="usernamefield">Username</label>
        <?php echo form_input($usernamefield); ?>
    </div>

    <h3>Select a username from the list:</h3>
  
    <div class="btn-group-vertical" role="group">
        <?php foreach ($users as $key => $value) { ?>
            <input type="button" id="btn#<?php echo $users[$key]->username; ?>"  class="btn btn-default uvalues" value="<?php echo $users[$key]->username; ?>"/>
        <?php } ?>
    </div>
</div> 
<div class="col-xs-6 col-md-4">
    <div class="form-group">
        <label for="latitude">Date</label>
        <?php echo form_input($datetimefield); ?>
    </div>

    <button type="submit" class="btn btn-default">Search</button></form>
    <?php echo validation_errors('<p class="alert alert-danger">'); ?>
    </form>
</div>

<script>
  $( function() {
    $( "#datetimefield" ).datepicker();
    $('.uvalues').click(function(){
        var id = this.id;
        var username = id.split("#");
        $('#usernamefield').val(username[1]);
    });
  } );
</script>