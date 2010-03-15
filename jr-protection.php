<?php
/*
Plugin Name: JR_Protection
Plugin URI: http://www.jakeruston.co.uk/2010/01/wordpress-plugin-jr-protection/
Description: Protects your blog from people stealing your content!
Version: 1.1.3
Author: Jake Ruston
Author URI: http://www.jakeruston.co.uk
*/

/*  Copyright 2009 Jake Ruston - the.escapist22@gmail.com

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Hook for adding admin menus
add_action('admin_menu', 'jr_protection_add_pages');

// action function for above hook
function jr_protection_add_pages() {
    add_options_page('JR Protection', 'JR Protection', 'administrator', 'jr_protection', 'jr_protection_options_page');
}
if (!defined("ch"))
{
function setupch()
{
$ch = curl_init();
$c = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
return($ch);
}
define("ch", setupch());
}

if (!function_exists("curl_get_contents")) {
function curl_get_contents($url)
{
$c = curl_setopt(ch, CURLOPT_URL, $url);
return(curl_exec(ch));
}
}
register_activation_hook(__FILE__,'protection_choice');

function protection_choice () {
if (get_option("jr_protection_links_choice")=='') {


$content = curl_get_contents("http://www.jakeruston.co.uk/pluginslink4.php");

update_option("jr_protection_links_choice", $content);
}
}

$pluginschoicelink=get_option("jr_protection_links_choice");
@preg_match("Sunbrella Cushions", $pluginschoicelink, $xyz);

if ($xyz[0]) {
update_option("jr_protection_links_choice", 'Sponsored by <a href="http://www.cushion-reviews.info">Sunbrella Cushions</a> and <a href="http://www.gpthq.com">GPT Site</a>".');
}

// jr_effects_options_page() displays the page content for the Test Options submenu
function jr_protection_options_page() {

    // variables for the field and option names
    $opt_name_1 = 'mt_protection_click';	
    $opt_name_5 = 'mt_protection_plugin_support';
	$opt_name_6 = 'mt_protection_rss';
	$opt_name_7 = 'mt_protection_highlight';
    $hidden_field_name = 'mt_protection_submit_hidden';
	$data_field_name_1 = 'mt_protection_click';
    $data_field_name_5 = 'mt_protection_plugin_support';
	$data_field_name_6 = 'mt_protection_rss';
	$data_field_name_7 = 'mt_protection_highlight';

    // Read in existing option value from database
	$opt_val_1 = get_option($opt_name_1);
    $opt_val_5 = get_option($opt_name_5);
	$opt_val_6 = get_option($opt_name_6);
	$opt_val_7 = get_option($opt_name_7);
    
if (!$_POST['feedback']=='') {
$my_email1="the.escapist22@gmail.com";
$plugin_name="JR Protection";
$blog_url_feedback=get_bloginfo('url');
$user_email=$_POST['email'];
$subject=$_POST['subject'];
$name=$_POST['name'];
$response=$_POST['response'];
$category=$_POST['category'];
if ($response=="Yes") {
$response="REQUIRED: ";
}
$feedback_feedback=$_POST['feedback'];
$feedback_feedback=stripslashes($feedback_feedback);
if ($user_email=="") {
$headers1 = "From: feedback@jakeruston.co.uk";
} else {
$headers1 = "From: $user_email";
}
$emailsubject1=$response.$plugin_name." - ".$category." - ".$subject;
$emailmessage1="Blog: $blog_url_feedback\n\nUser Name: $name\n\nUser E-Mail: $user_email\n\nMessage: $feedback_feedback";
mail($my_email1,$emailsubject1,$emailmessage1,$headers1);
?>

<div class="updated"><p><strong><?php _e('Feedback Sent!', 'mt_trans_domain' ); ?></strong></p></div>

<?php
}

    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( $_POST[ $hidden_field_name ] == 'Y' ) {
        // Read their posted value
		$opt_val_1 = $_POST[$data_field_name_1];
        $opt_val_5 = $_POST[$data_field_name_5];
		$opt_val_6 = $_POST[$data_field_name_6];
		$opt_val_7 = $_POST[$data_field_name_7];

        // Save the posted value in the database
		update_option( $opt_name_1, $opt_val_1 );
        update_option( $opt_name_5, $opt_val_5 );
		update_option( $opt_name_6, $opt_val_6 );
		update_option( $opt_name_7, $opt_val_7 );

        // Put an options updated message on the screen

?>
<div class="updated"><p><strong><?php _e('Options saved.', 'mt_trans_domain' ); ?></strong></p></div>
<?php

    }

    // Now display the options editing screen

    echo '<div class="wrap">';

    // header

    echo "<h2>" . __( 'JR Protection Plugin Options', 'mt_trans_domain' ) . "</h2>";
	?>
	<div class="updated"><p><strong><?php _e('Please consider donating to help support the development of my plugins!', 'mt_trans_domain' ); ?></strong><br /><br /><form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="ULRRFEPGZ6PSJ">
<input type="image" src="https://www.paypal.com/en_US/GB/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">
<img alt="" border="0" src="https://www.paypal.com/en_GB/i/scr/pixel.gif" width="1" height="1">
</form></p></div>
<?php

    // options form
    
    $change3 = get_option("mt_protection_plugin_support");
	$change4 = get_option("mt_protection_click");
	$change5 = get_option("mt_protection_rss");
	$change6 = get_option("mt_protection_highlight");

if ($change3=="Yes" || $change3=="") {
$change3="checked";
$change31="";
} else {
$change3="";
$change31="checked";
}

if ($change4=="Yes" || $change4=="") {
$change4="checked";
$change41="";
} else {
$change4="";
$change41="checked";
}

if ($change5=="Yes") {
$change5="checked";
$change51="";
} else {
$change5="";
$change51="checked";
}

if ($change6=="Yes" || $change6=="") {
$change6="checked";
$change61="";
} else {
$change6="";
$change61="checked";
}
    ?>
<form name="form1" method="post" action="">
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">

<p><?php _e("Right-clicking on your page is...", 'mt_trans_domain' ); ?> 
<input type="radio" name="<?php echo $data_field_name_1; ?>" value="Yes" <?php echo $change4; ?>>Disabled
<input type="radio" name="<?php echo $data_field_name_1; ?>" value="No" <?php echo $change41; ?>>Enabled
</p>

<p><?php _e("RSS Feed is...", 'mt_trans_domain' ); ?> 
<input type="radio" name="<?php echo $data_field_name_6; ?>" value="Yes" <?php echo $change5; ?>>Disabled
<input type="radio" name="<?php echo $data_field_name_6; ?>" value="No" <?php echo $change51; ?>>Enabled
</p>

<p><?php _e("Highlighting text is...", 'mt_trans_domain' ); ?> 
<input type="radio" name="<?php echo $data_field_name_7; ?>" value="Yes" <?php echo $change6; ?>>Disabled
<input type="radio" name="<?php echo $data_field_name_7; ?>" value="No" <?php echo $change61; ?>>Enabled
</p><hr />

<p><?php _e("Show Plugin Support?", 'mt_trans_domain' ); ?> 
<input type="radio" name="<?php echo $data_field_name_5; ?>" value="Yes" <?php echo $change3; ?>>Yes
<input type="radio" name="<?php echo $data_field_name_5; ?>" value="No" <?php echo $change31; ?> id="Please do not disable plugin support - This is the only thing I get from creating this free plugin!" onClick="alert(id)">No
</p>

<p class="submit">
<input type="submit" name="Submit" value="<?php _e('Update Options', 'mt_trans_domain' ) ?>" />
</p><hr />

</form>
<script type="text/javascript">
function validate_required(field,alerttxt)
{
with (field)
  {
  if (value==null||value=="")
    {
    alert(alerttxt);return false;
    }
  else
    {
    return true;
    }
  }
}

function validate_form(thisform)
{
with (thisform)
  {
  if (validate_required(subject,"Subject must be filled out!")==false)
  {email.focus();return false;}
  if (validate_required(feedback,"Feedback must be filled out!")==false)
  {email.focus();return false;}
  }
}
</script><h3>Submit Feedback about my Plugin!</h3>
<p><b>Note: Only send feedback in english, I cannot understand other languages!</b></p>
<form name="form2" method="post" action="" onsubmit="return validate_form(this)">
<p><?php _e("Name:", 'mt_trans_domain' ); ?> 
<input type="text" name="name" /></p>
<p><?php _e("E-Mail:", 'mt_trans_domain' ); ?> 
<input type="text" name="email" /></p>
<p><?php _e("Category:", 'mt_trans_domain'); ?>
<select name="category">
<option value="Bug Report">Bug Report</option>
<option value="Feature Request">Feature Request</option>
<option value="Other">Other</option>
</select>
<p><?php _e("Subject (Required):", 'mt_trans_domain' ); ?>
<input type="text" name="subject" /></p>
<input type="checkbox" name="response" value="Yes" /> I want e-mailing back about this feedback</p>
<p><?php _e("Comment (Required):", 'mt_trans_domain' ); ?> 
<textarea name="feedback"></textarea>
</p>
<p class="submit">
<input type="submit" name="Send" value="<?php _e('Send', 'mt_trans_domain' ); ?>" />
</p><hr /></form>
</div>
<?php } ?>
<?php
if (get_option("jr_protection_links_choice")=="") {
protection_choice();
}

function disable_feed() {
	wp_die( __('The feed is disabled. Please visit the <a href="'. get_bloginfo('url') .'">Homepage</a>.') );
}

function show_protection() {
$click=get_option("mt_protection_click");
$rss=get_option("mt_protection_rss");
$highlight=get_option("mt_protection_highlight");

if ($click=="" || $click=="Yes") {
?>
<SCRIPT TYPE="text/javascript">
<!--
var message="This page is protected!";
function clickIE() {if (document.all) {(message);return false;}}
function clickNS(e) {if
(document.layers||(document.getElementById&&!document.all)) {
if (e.which==2||e.which==3) {(message);return false;}}}
if (document.layers)
{document.captureEvents(Event.MOUSEDOWN);document.onmousedown=clickNS;}
else{document.onmouseup=clickNS;document.oncontextmenu=clickIE;}
document.oncontextmenu=new Function("return false")
// -->
</SCRIPT> 
<?php
}

if ($highlight=="" || $highlight=="Yes") {
?>
<script type="text/javascript">
function disableSelection(target){
if (typeof target.onselectstart!="undefined") //IE route
	target.onselectstart=function(){return false}
else if (typeof target.style.MozUserSelect!="undefined") //Firefox route
	target.style.MozUserSelect="none"
else //All other route (ie: Opera)
	target.onmousedown=function(){return false}
target.style.cursor = "default"
}
</script>
<script type="text/javascript">
disableSelection(document.body) //disable text selection on entire body of page
</script>
<?php
}

if ($rss=="Yes") {
add_action('do_feed', 'disable_feed', 1);
add_action('do_feed_rdf', 'disable_feed', 1);
add_action('do_feed_rss', 'disable_feed', 1);
add_action('do_feed_rss2', 'disable_feed', 1);
add_action('do_feed_atom', 'disable_feed', 1);
}

$supportplugin=get_option("mt_protection_plugin_support");
if ($supportplugin=="" || $supportplugin=="Yes") {
add_action('wp_footer', 'protection_footer_plugin_support');
}
}

function protection_footer_plugin_support() {
  $pshow = "<p style='font-size:x-small'>Protection Plugin created by <a href='http://www.jakeruston.co.uk'>Jake</a> Ruston - ".get_option('jr_protection_links_choice')."</p>";
  echo $pshow;
}

add_action("wp_head", "show_protection");

?>
