<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">User <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">USERNAME <?php echo form_error('USERNAME') ?></label>
            <input type="text" class="form-control" name="USERNAME" id="USERNAME" placeholder="USERNAME" value="<?php echo $USERNAME; ?>" />
        </div>
	    <div class="form-group">
            <label for="char">PASSWORD <?php echo form_error('PASSWORD') ?></label>
            <input type="text" class="form-control" name="PASSWORD" id="PASSWORD" placeholder="PASSWORD" value="<?php echo $PASSWORD; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">ISLOGIN <?php echo form_error('ISLOGIN') ?></label>
            <input type="text" class="form-control" name="ISLOGIN" id="ISLOGIN" placeholder="ISLOGIN" value="<?php echo $ISLOGIN; ?>" />
        </div>
	    <div class="form-group">
            <label for="enum">VERIFIED <?php echo form_error('VERIFIED') ?></label>
            <input type="text" class="form-control" name="VERIFIED" id="VERIFIED" placeholder="VERIFIED" value="<?php echo $VERIFIED; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">CODE <?php echo form_error('CODE') ?></label>
            <input type="text" class="form-control" name="CODE" id="CODE" placeholder="CODE" value="<?php echo $CODE; ?>" />
        </div>
	    <div class="form-group">
            <label for="datetime">LASTLOGIN <?php echo form_error('LASTLOGIN') ?></label>
            <input type="text" class="form-control" name="LASTLOGIN" id="LASTLOGIN" placeholder="LASTLOGIN" value="<?php echo $LASTLOGIN; ?>" />
        </div>
	    <div class="form-group">
            <label for="datetime">DTMCRT <?php echo form_error('DTMCRT') ?></label>
            <input type="text" class="form-control" name="DTMCRT" id="DTMCRT" placeholder="DTMCRT" value="<?php echo $DTMCRT; ?>" />
        </div>
	    <div class="form-group">
            <label for="datetime">DTMUPD <?php echo form_error('DTMUPD') ?></label>
            <input type="text" class="form-control" name="DTMUPD" id="DTMUPD" placeholder="DTMUPD" value="<?php echo $DTMUPD; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">USRUPD <?php echo form_error('USRUPD') ?></label>
            <input type="text" class="form-control" name="USRUPD" id="USRUPD" placeholder="USRUPD" value="<?php echo $USRUPD; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">ACCESS <?php echo form_error('ACCESS') ?></label>
            <input type="text" class="form-control" name="ACCESS" id="ACCESS" placeholder="ACCESS" value="<?php echo $ACCESS; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">UNIT ID <?php echo form_error('UNIT_ID') ?></label>
            <input type="text" class="form-control" name="UNIT_ID" id="UNIT_ID" placeholder="UNIT ID" value="<?php echo $UNIT_ID; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">USER DETAIL ID <?php echo form_error('USER_DETAIL_ID') ?></label>
            <input type="text" class="form-control" name="USER_DETAIL_ID" id="USER_DETAIL_ID" placeholder="USER DETAIL ID" value="<?php echo $USER_DETAIL_ID; ?>" />
        </div>
	    <input type="hidden" name="GUID" value="<?php echo $GUID; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('d_user') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>