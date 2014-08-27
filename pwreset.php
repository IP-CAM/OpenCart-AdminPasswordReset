<?php

/**
 * @author Steinweber
 * @copyright 2013-2014
 */


include_once('config.php');
include_once(DIR_SYSTEM.'library/db.php');
$db = new DB(DB_DRIVER,DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_DATABASE);


if(isset($_POST['password']))
{
    $user = $db->query("SELECT * FROM ".DB_PREFIX."user WHERE user_id = '".(int)$_POST['user']."'");
    $insert = $db->query("UPDATE ".DB_PREFIX."user SET password = '".$db->escape(sha1($user->row['salt'] . sha1($user->row['salt'] . sha1($_POST['password']))))."' WHERE user_id = '".(int)$_POST['user']."'");
    if($insert)
    {
        msg('The new password has been changed successfully</p>');
    }
}

$user = $db->query("SELECT * FROM ".DB_PREFIX."user");

if(empty($user->rows))
{
    $options = array();
    info('No user in Database!!!');
}
else
{
    msg(count($user->rows).' user in database');
    foreach($user->rows as $data)
    {
        $options[] = array('id'=>$data['user_id'],'username'=>$data['username']);
    }
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>OpenCart Password Reset</title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <style type="text/css">
<!--
	body {
	margin: 0;
	padding: 0;
	background: #f4f4f4;
	font: 14px;
	font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
}

.link { text-align: center; clear: both; padding: 20px 0; }
.link a { color: #333333; }

.wrapper {
	width: 960px;
	margin: 50px auto;
}

/* Form 1 style */

.form1 {
	width: 450px;
    margin: 100px auto 0;
	background: #fff;
	color: #777;
	-webkit-box-shadow: 0px 0px 8px 2px #d1d1d1;
	-moz-box-shadow: 0px 0px 8px 2px #d1d1d1;
	box-shadow: 0px 0px 8px 2px #d1d1d1; 
	-webkit-border-top-left-radius: 0px;
	-webkit-border-top-right-radius: 0px;
	-webkit-border-bottom-right-radius: 6px;
	-webkit-border-bottom-left-radius: 6px;
	-moz-border-radius-topleft: 0px;
	-moz-border-radius-topright: 0px;
	-moz-border-radius-bottomright: 6px;
	-moz-border-radius-bottomleft: 6px;
	border-top-left-radius: 0px;
	border-top-right-radius: 0px;
	border-bottom-right-radius: 6px;
	border-bottom-left-radius: 6px; 
	overflow: hidden;
}

.formtitle {
	padding: 10px;
	line-height: 16px;
	font-size: 13px;
	text-shadow: -1px -1px #e87c19;
	color: #fff;
	font-weight: bold;
	border-bottom: 1px solid #eb8d19;
	width: 430px;
	background: #ffbd27; /* Old browsers */
	background: -moz-linear-gradient(top, #ffbd27 0%, #ffb119 50%, #ff9d19 51%, #ff9d19 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ffbd27), color-stop(50%,#ffb119), color-stop(51%,#ff9d19), color-stop(100%,#ff9d19)); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top, #ffbd27 0%,#ffb119 50%,#ff9d19 51%,#ff9d19 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top, #ffbd27 0%,#ffb119 50%,#ff9d19 51%,#ff9d19 100%); /* Opera11.10+ */
	background: -ms-linear-gradient(top, #ffbd27 0%,#ffb119 50%,#ff9d19 51%,#ff9d19 100%); /* IE10+ */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffbd27', endColorstr='#ff9d19',GradientType=0 ); /* IE6-9 */
	background: linear-gradient(top, #ffbd27 0%,#ffb119 50%,#ff9d19 51%,#ff9d19 100%); /* W3C */
}

.input {
	width: 410px;
	border-bottom: 1px solid #ddd;
	margin-bottom: 10px;
	margin: 20px;
	overflow: hidden;
}

.inputtext {
	float: left;
	line-height: 18px;
	height: 35px;
	font-size: 14px;
	width: 120px;
}

.inputcontent {
	float: left;
	width: 290px;
	height: 50px;
}

.inputcontent input {
	padding: 0px;
	height: 25px;
	width: 200px;
	line-height: 25px;
	border: 1px solid #c7c7c7;
	-moz-border-radius:6px;
	-webkit-border-radius:6px;
	border-radius:6px;
	color: #777;
    display:block;
}

.inputcontent a {
	color: #0084ff;
	font-size: 12px;
	text-decoration: none;
	line-height: 12px;
}

.nobottomborder {
	border-bottom: 0;
}

.buttons {
	background: #f1f1f1;
	border-top: 1px solid #ddd;
	padding: 15px;
	height: 34px;
}

.greybutton {
	background: #e1e1e1; /* Old browsers */
	background: -moz-linear-gradient(top, #e1e1e1 0%, #bababa 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#e1e1e1), color-stop(100%,#bababa)); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top, #e1e1e1 0%,#bababa 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top, #e1e1e1 0%,#bababa 100%); /* Opera11.10+ */
	background: -ms-linear-gradient(top, #e1e1e1 0%,#bababa 100%); /* IE10+ */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e1e1e1', endColorstr='#bababa',GradientType=0 ); /* IE6-9 */
	background: linear-gradient(top, #e1e1e1 0%,#bababa 100%); /* W3C */ 
	border: 1px solid #bababa;
	-webkit-border-radius: 20px;
	-moz-border-radius: 20px;
	border-radius: 20px; 
	line-height: 20px;
	font-size: 16px;
	padding: 6px 12px;
	color: #fff;
	text-shadow: -1px -1px #bababa;
	float: right;
	margin-left: 10px;
	cursor: pointer;
}

.greybutton:hover{
	background: #bababa; /* Old browsers */
	background: -moz-linear-gradient(top, #bababa 0%, #e1e1e1 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#bababa), color-stop(100%,#e1e1e1)); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top, #bababa 0%,#e1e1e1 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top, #bababa 0%,#e1e1e1 100%); /* Opera11.10+ */
	background: -ms-linear-gradient(top, #bababa 0%,#e1e1e1 100%); /* IE10+ */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#bababa', endColorstr='#e1e1e1',GradientType=0 ); /* IE6-9 */
	background: linear-gradient(top, #bababa 0%,#e1e1e1 100%); /* W3C */ 
}

.orangebutton {
	background: #ffc339; /* Old browsers */
	background: -moz-linear-gradient(top, #ffc339 0%, #ff9b19 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ffc339), color-stop(100%,#ff9b19)); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top, #ffc339 0%,#ff9b19 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top, #ffc339 0%,#ff9b19 100%); /* Opera11.10+ */
	background: -ms-linear-gradient(top, #ffc339 0%,#ff9b19 100%); /* IE10+ */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffc339', endColorstr='#ff9b19',GradientType=0 ); /* IE6-9 */
	background: linear-gradient(top, #ffc339 0%,#ff9b19 100%); /* W3C */
	border: 1px solid #ff9b19;
	-webkit-border-radius: 20px;
	-moz-border-radius: 20px;
	border-radius: 20px; 
	line-height: 20px;
	font-size: 16px;
	padding: 6px 12px;
	color: #fff;
	text-shadow: -1px -1px #ff9b19;
	float: right;
	margin-left: 10px;
	cursor: pointer;
}

.orangebutton:hover{
	background: #ff9b19; /* Old browsers */
	background: -moz-linear-gradient(top, #ff9b19 0%, #ffc339 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ff9b19), color-stop(100%,#ffc339)); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top, #ff9b19 0%,#ffc339 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top, #ff9b19 0%,#ffc339 100%); /* Opera11.10+ */
	background: -ms-linear-gradient(top, #ff9b19 0%,#ffc339 100%); /* IE10+ */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ff9b19', endColorstr='#ffc339',GradientType=0 ); /* IE6-9 */
	background: linear-gradient(top, #ff9b19 0%,#ffc339 100%); /* W3C */
}

.msg{
    color: #36C64C;
    margin: 17px auto 0;
    width: 365px;
}
.info{
    color: #C64037;
    margin: 17px auto 0;
    width: 365px;
}
-->
</style>
</head>
<body>
<form class="form1" action="pwreset.php" method="post">

			<div class="formtitle">Select user and enter the new password</div>
            
			<div class="input">
				<div class="inputtext">Username: </div>
				<div class="inputcontent">

					<select name="user">
                    <?php 
                    foreach($options as $option)
                    {
                      echo '<option value="'.$option['id'].'">'.$option['username'].'</option>';  
                    }
                    ?>
                    </select>

				</div>
			</div>

			<div class="input nobottomborder">
				<div class="inputtext">Password: </div>
				<div class="inputcontent">

					<input type="text" name="password" />

				</div>
			</div>

			<div class="buttons">

				<input class="orangebutton" type="submit" value="Change" />

				<a href="<?php echo HTTP_SERVER.'admin/'; ?>" class="greybutton" >Back to admin</a>

			</div>

		</form>

		

		<div class="link">Powerd by <a href="http://www.steinweber-ug.com">Steinweber UG</a> - OpenCart-Development</div>
	


</body>
</html>
<?php
function info($msg)
{
    echo '<div class="info">'.$msg.'</div>';
}
function msg($msg)
{
    echo '<div class="msg">'.$msg.'</div>';
}
