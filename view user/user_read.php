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
        <h2 style="margin-top:0px">User Read</h2>
        <table class="table">
	    <tr><td>USERNAME</td><td><?php echo $USERNAME; ?></td></tr>
	    <tr><td>PASSWORD</td><td><?php echo $PASSWORD; ?></td></tr>
	    <tr><td>ISLOGIN</td><td><?php echo $ISLOGIN; ?></td></tr>
	    <tr><td>VERIFIED</td><td><?php echo $VERIFIED; ?></td></tr>
	    <tr><td>CODE</td><td><?php echo $CODE; ?></td></tr>
	    <tr><td>LASTLOGIN</td><td><?php echo $LASTLOGIN; ?></td></tr>
	    <tr><td>DTMCRT</td><td><?php echo $DTMCRT; ?></td></tr>
	    <tr><td>DTMUPD</td><td><?php echo $DTMUPD; ?></td></tr>
	    <tr><td>USRUPD</td><td><?php echo $USRUPD; ?></td></tr>
	    <tr><td>ACCESS</td><td><?php echo $ACCESS; ?></td></tr>
	    <tr><td>UNIT ID</td><td><?php echo $UNIT_ID; ?></td></tr>
	    <tr><td>USER DETAIL ID</td><td><?php echo $USER_DETAIL_ID; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('d_user') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>