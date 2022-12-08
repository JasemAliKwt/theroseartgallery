<?php

############  Settings  ############

// Your E-Mail Address
$contactF_to        = "jasemalikwt@gmail.com"; // Where To Send The E-Mails
$contactF_mail_from = ""; // Custom Sender's Address (required on GoDaddy hosting)

// Confirmation Letter
$contactF_confirm_do   = "yes"; // Send A Confirmation To Client: "yes" or "no"
$contactF_confirm_s    = "We Have Received Your Letter!"; // Subject Line For The Notification Sent To Your Customer
$contactF_confirm_b    = "<b>Thank you for contacting us!</b> We will get back to you soon."; // Confirmation Letter Content (HTML is allowed);
$contactF_confirm_from = "The Rose Art Gallery"; // Your Company Name That is Shown To The Customer
$contactF_confirm_mail = "jasemalikwt@gmail.com"; // Your E-mail Address That is Shown To The Customer

// Company's Name And Physical Location
$contactF_company_do = "yes"; // Show Company Info: "yes" or "no"
$contactF_company_a  = "The Rose Art Gallery";
$contactF_company_b  = " ";
$contactF_company_c  = " ";
$contactF_company_d  = "Phone: 831 346 9151";
$contactF_company_e  = "Email: jasemalikwt@gmail"; // You May Choose To Replace This Line With An E-mail Address

// Form Settings
$contactF_phone_show    = "yes"; // Show Phone Number Input: "yes" or "no"
$contactF_backup_do     = "yes"; // Save HTML Backup Files From Each E-Mail: "yes" or "no"
$contactF_subject_tag   = "THE ROSE ART GALLERY - CONTACT: "; // Custom Beginning For The Subject Line
$contactF_require_full  = "no"; // Require Full Name: "yes" or "no"
$contactF_limit_name    = 30; // Character Limit For The Name Input
$contactF_minim_name    = 2; // Minimum Characters In The Name
$contactF_limit_email   = 40; // Character Limit For The E-Mail Input
$contactF_minim_email   = 6; // Minimum Characters In The E-Mail
$contactF_limit_subject = 40; // Character Limit For The Subject Input
$contactF_minim_subject = 2; // Minimum Characters In The Subject
$contactF_minim_phone   = 10; // Minimum Characters In The Phone Number
$contactF_limit_phone   = 12; // Character Limit For The Phone Number Input
$contactF_minim_body    = 30; // Minimum Characters In The Message
$contactF_limit_body    = 2000; // Maximum Characters In The Message Box
$contactF_allow_html    = "no"; // Allow HTML: "yes" or "no" (WARNING: some e-mail services flag messages as spam if the message contains HTML with Attachments)
$contactF_disablebtn    = "yes"; // Disable The Submit Button After Message Is Sent: "yes" or "no"
$contactF_nolimit       = "no"; // Disable The 1 Message Per Minute Spam Protection: "yes" or "no"
$contactF_utf           = "yes"; // UTF8 Encode The Messages

// File Attachment Settings
$contactF_u_attachment = "no"; // Allow Attachments
$contactF_u_size       = 5000; // Maximum File Size In Kilobytes (5000 = 5 Megabytes)
$contactF_u_allow_all  = "no"; // Allow All filetypes: "yes" or "no"

/* Accepted Filetypes: jpg, png, gif, zip */
$contactF_u_allow = array(
    "image/pjpeg",
    "image/x-png",
    "image/jpg",
    "image/jpeg",
    "image/png",
    "image/gif",
    'application/zip',
    'application/x-zip-compressed',
    'multipart/x-zip',
    'application/x-compressed'
);

// Error Messages
$contactF_alert_a = "You cannot send an empty message.";
$contactF_alert_b = "The message must be at least 30 characters long.";
$contactF_alert_c = "The name must be at least 2 characters long.";
$contactF_alert_d = "Please enter your full name.";
$contactF_alert_e = "Please enter your real e-mail address.";
$contactF_alert_f = "Your e-mail address must be at least 6 characters long.";
$contactF_alert_g = "The subject line must be at least 2 characters long.";
$contactF_alert_h = "Incorrect Verification code, please try again.";
$contactF_alert_i = "Message sent! We will get back to You as soon as possible.";
$contactF_alert_j = "Couldn't send the message, please try again later.";
$contactF_alert_k = "Please click on the correct icon below.";
$contactF_alert_l = "Sorry, you can only send one message per minute.";
$contactF_alert_m = "The phone number must be at least 10 numbers long.";
$contactF_alert_n = "Attachment Error!";
$contactF_alert_o = "Only JPG, PNG, GIF and ZIP files allowed!";
$contactF_alert_p = "Too Large File!";
$contactF_alert_q = "Session Expired, please resubmit the form!";

// Form Text
$contactF_text_a = "Contact Form";
$contactF_text_b = "Your Name";
$contactF_text_c = "Your E-mail";
$contactF_text_d = "Subject";
$contactF_text_e = "Please click on the";
$contactF_text_f = "icon";
$contactF_text_g = "Phone Nr";
$contactF_text_h = "Attachment <span>(JPG, PNG, GIF or ZIP)</span> ";

// Script's Folder Name
$contactF_dir = "Contact/"; // Update This If You Change The Folder's Name


// HMTL Checking
function contactF_htmlchk($string, $html)
{
    if ($html == "no") {
        $string = htmlentities($string, ENT_QUOTES);
        $string = stripslashes($string);
    }
    return $string;
}

// File List Function
function contactF_files($folder)
{
    $handle = opendir("$folder");
    while (false !== ($file = readdir($handle))) {
        if ($file != '.' && $file != '..') {
            $list[] = $file;
        }
    }
    closedir($handle);
    if (is_array($list)) {
        sort($list);
        reset($list);
    } else {
        $list = 'empty';
    }
    return $list;
}

// User IP Function
function contactF_ip()
{
    if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
        $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    } else {
        $ip = $_SERVER["REMOTE_ADDR"];
    }
    return $ip;
}

// Data Saving Function
function contactF_save($data, $file, $choice)
{
    $fopn = fopen("$file", $choice);
    fwrite($fopn, $data);
    fclose($fopn);
}

// Adding <br /> Line Breaks
function contactF_break($data)
{
    return str_replace("\r\n", "<br />\r\n", $data);
}

// Find The Latest Answer Entry
function contactF_entry($line, $file, $ip)
{
    $data   = array_reverse(file($file));
    $count  = count($data);
    $i      = 0;
    $stop   = '';
    $return = 'empty';
    while ($i < $count && $stop !== 'stop') {
        if ($data[$i] == $ip . "contactF_0\r\n") {
            $return = '0';
            $stop   = 'stop';
        }
        if ($data[$i] == $ip . "contactF_1\r\n") {
            $return = '1';
            $stop   = 'stop';
        }
        if ($data[$i] == $ip . "contactF_2\r\n") {
            $return = '2';
            $stop   = 'stop';
        }
        $i++;
    }
    return $return;
}

// E-mail Sending Function
function email($to, $name, $from, $reply_to, $subject, $phone, $body, $file, $html, $contactF_utf)
{
    
    // Show The Sender's E-mail Address In The Body
    $body_header = "";
    if ($from !== $reply_to) {
        $body_header .= "Message From: $reply_to\r\n\r\n";
    }
    if ($phone !== "") {
        $body_header .= "Phone Number: ".html_entity_decode($phone)."\r\n\r\n";
    }
    $body = "$body_header$body";
    
    // Decode HTML Entities
    $name    = html_entity_decode($name);
    $subject = html_entity_decode($subject);
    
    // Encode With UTF8
    if ($contactF_utf == 'yes') {
    	$name    = utf8_encode($name);
    	$body    = utf8_encode($body);
    	$subject = utf8_encode($subject);
	}
	
	// Remove Disallowed Characters From The Name
    $find    = array(',', '"', '<', "\\");
    $name    = str_replace($find, "", $name);
    
    // Turning HTML On
    if ($html == "yes") {
        $type = "html";
        $body = contactF_break($body);
    } else {
        $type = "plain";
    }
    
    // Message Without File
    if ($file == "") {
        $contactF_header = "From: $name <$from>\r\n";
        $contactF_header .= "Reply-To: $reply_to\r\n";
        $contactF_header .= "MIME-Version: 1.0\r\n";
        $contactF_header .= "Content-type: text/$type; charset=iso-8859-1\r\n";
        $contactF_msg .= "$body\r\n";
        
    // Message With File
    } else {
        $fname           = str_replace($find, "", $file["name"]);
        $fname           = substr($fname, 0, 100);
    	if ($contactF_utf == 'yes') {
    		$fname = utf8_encode($fname);
		}
        $boundary         = "---bound" . md5(uniqid(rand())) . "bound---";
        $attachment       = chunk_split(base64_encode(file_get_contents($file["tmp_name"])));
        $contactF_header  = "From: $name <$from>\r\n";
        $contactF_header .= "Reply-To: $reply_to\r\n";
        $contactF_header .= "MIME-Version: 1.0\r\n";
        $contactF_header .= "Content-Type: multipart/mixed; boundary=first-$boundary\r\n";
        $contactF_msg  = "--first-$boundary\r\n";
		$contactF_msg .= "Content-Type: multipart/alternative; boundary=second-$boundary\r\n\r\n";
		$contactF_msg .= "--second-$boundary\r\n";
		$contactF_msg .= "Content-Type: text/$type; charset=ISO-8859-1\r\n\r\n";
		$contactF_msg .= "$body\r\n";
		$contactF_msg .= "--second-$boundary--\r\n";
		$contactF_msg .= "--first-$boundary\r\n";
		$contactF_msg .= "Content-Type: octet-stream; name=$fname\r\n";
		$contactF_msg .= "Content-Disposition: attachment; filename=$fname\r\n";
		$contactF_msg .= "Content-Transfer-Encoding: base64\r\n";
		$contactF_msg .= "X-Attachment-Id: md5(uniqid(rand()));\r\n\r\n";
		$contactF_msg .= "$attachment\r\n";
		$contactF_msg .= "--first-$boundary--\r\n";
    }
    
    // Sending The Message
    if (mail($to, $subject, $contactF_msg, $contactF_header)) {
        return true;
    } else {
        return false;
    }
}

// Update Folder Permissions
$current = substr(sprintf('%o', fileperms($contactF_dir.'Data')), -4);
if (intval($current) !== 705) {
	chmod($contactF_dir.'Data', 0705);
	chmod($contactF_dir.'Failed', 0705);
	chmod($contactF_dir.'Graphics', 0705);
	chmod($contactF_dir.'Icons Dark', 0705);
	chmod($contactF_dir.'Icons Light', 0705);
	chmod($contactF_dir.'Sent', 0705);
}

// Creating A List Of Images
$contactF_list = contactF_files($contactF_dir . 'Icons ' . $contactF_colors);
$contactF_rand = array_rand($contactF_list, 3);

// Setting Form Variables
$contactF_scriptn = basename($_SERVER['SCRIPT_NAME']);
$contactF_name    = "";
$contactF_email   = "";
$contactF_subject = "";
$contactF_phone   = "";
$contactF_body    = "";
$contactF_bodyx   = "";
$contactF_alert   = "";

// Sending An Email
$contactF_ip    = md5(contactF_ip());
$contactF_date  = date('y_m_d-H-i');
$contactF_micro = "&amp;time=" . str_replace(" ", "%20", microtime());
$contactF_token = md5($contactF_ip.$_SERVER['DOCUMENT_ROOT'].$contactF_to.date('y_m_d'));
if (isset($_POST['contactF_name']) && isset($_POST['contactF_email']) && isset($_POST['contactF_subject']) && isset($_POST['contactF_body'])) {
    
    // Read POST Variables
    $contactF_name    = $_POST['contactF_name'];
    $contactF_email   = $_POST['contactF_email'];
    $contactF_subject = $_POST['contactF_subject'];
    $contactF_body    = $_POST['contactF_body'];
    if (isset($_POST['contactF_phone'])) {
        $contactF_phone = $_POST['contactF_phone'];
    }
    
    // Limit Variable lengths
    $contactF_name    = substr($contactF_name, 0, $contactF_limit_name);
    $contactF_email   = substr($contactF_email, 0, $contactF_limit_email);
    $contactF_subject = substr($contactF_subject, 0, $contactF_limit_subject);
    $contactF_body    = substr($contactF_body, 0, $contactF_limit_body);
    
    // Remove HTML
    $contactF_name    = str_replace("\\", "", contactF_htmlchk($contactF_name, "no"));
    $contactF_email   = str_replace("\\", "", contactF_htmlchk($contactF_email, "no"));
    $contactF_email   = str_replace(",", "", $contactF_email);
    $contactF_subject = contactF_htmlchk($contactF_subject, "no");
    $contactF_bodyx   = contactF_htmlchk($contactF_body, "no");
    
    // Phone Number Limits
    if ($contactF_phone_show == "yes") {
        $contactF_phone = substr($contactF_phone, 0, $contactF_limit_phone);
        $contactF_phone = contactF_htmlchk($contactF_phone, "no");
    }
    
    // Checking Input
    if (!isset($_POST['contactF_contacting'.$contactF_token])) {
		$contactF_alert = $contactF_alert_q;
	} elseif ($contactF_body == "") {
        $contactF_alert = $contactF_alert_a;
    } elseif (strlen($contactF_body) < $contactF_minim_body) {
        $contactF_alert = $contactF_alert_b;
    } elseif (strlen($contactF_name) < $contactF_minim_name) {
        $contactF_alert = $contactF_alert_c;
    } elseif (strpos($contactF_name, " ") == false && $contactF_require_full == "yes") {
        $contactF_alert = $contactF_alert_d;
    } elseif (strpos($contactF_email, "@") == false || strpos($contactF_email, ".") == false) {
        $contactF_alert = $contactF_alert_e;
    } elseif (strlen($contactF_email) < $contactF_minim_email) {
        $contactF_alert = $contactF_alert_f;
    } elseif (strlen($contactF_subject) < $contactF_minim_subject) {
        $contactF_alert = $contactF_alert_g;
    } elseif (strlen($contactF_phone) < $contactF_minim_phone && $contactF_phone_show == "yes") {
        $contactF_alert = $contactF_alert_m;
    } else {
        
        // Checking The Verification Answer
        if (isset($_POST['contactF_verified'])) {
            $contactF_security = $_POST['contactF_verified'];
            if (contactF_entry("$contactF_ip", $contactF_dir . 'Data/Data', $contactF_ip) !== $contactF_security) {
                $contactF_alert = $contactF_alert_h;
            } else {
                
                // Text Backup
                $contactF_backup_p = "";
                if ($contactF_phone_show == "yes") {
                    $contactF_backup_p = "Phone Number: $contactF_phone\r\n";
                }
                $contactF_backup = "From: $contactF_name <$contactF_email>\r\nSubject: $contactF_subject\r\n" . $contactF_backup_p . "Message: $contactF_bodyx\r\n---\r\n\r\n";
                
                // Checking The Timestamp Of The Previous Message
                if (!is_file($contactF_dir . 'Data/Time')) {
                    contactF_save('', $contactF_dir . 'Data/Time', 'a');
                }
                $contactF_time = file($contactF_dir . 'Data/Time');
                $contactF_inar = in_array($contactF_ip . $contactF_date . "\r\n", $contactF_time);
                if ($contactF_nolimit == 'yes') {
	                $contactF_inar = false;
                }
                if (!$contactF_inar) {
                    
                    // Check The Attachment
                    $contactF_file = "";
                    if (isset($_FILES['contactF_file']) && $contactF_u_attachment == "yes") {
                        $contactF_file = $_FILES['contactF_file'];
                        if ($contactF_file["size"] < ($contactF_u_size * 1000)) {
                            if ($contactF_file["error"] > 0 && $contactF_file["error"] !== 4) {
                                $contactF_alert = $contactF_alert = $contactF_alert_n;
                            } elseif ($contactF_file["error"] !== 4) {
                                if ($contactF_u_allow_all !== "yes") {
                                    if (!in_array($contactF_file["type"], $contactF_u_allow)) {
                                        $contactF_alert = $contactF_alert_o;
                                    }
                                }
                            } else {
                                $contactF_file = "";
                            }
                        } else {
                            $contactF_alert = $contactF_alert_p;
                        }
                    }
                    
                    // Setting The Sender's Address
                    if ($contactF_mail_from !== "") {
                        $contactF_from = $contactF_mail_from;
                    } else {
                        $contactF_from = $contactF_email;
                    }
                    
                    // Sending The Message
                    if ($contactF_alert == "") {
                        if (email($contactF_to, $contactF_name, $contactF_from, $contactF_email, $contactF_subject_tag . $contactF_subject, $contactF_phone, $contactF_body, $contactF_file, $contactF_allow_html, $contactF_utf)) {
                            
                            // Saving Timestamps
                            contactF_save($contactF_ip . $contactF_date . "\r\n", $contactF_dir . 'Data/Time', 'a');
                            
                            // Limit The Size Of The Timestamp Files
                            $contactF_truncate = file($contactF_dir . 'Data/Time');
                            $contactF_count    = count($contactF_truncate);
                            if ($contactF_count > 1000) {
                                $contactF_truncate = array_chunk($contactF_truncate, 500);
                                $contactF_lines    = implode(end($contactF_truncate));
                                contactF_save($contactF_lines, $contactF_dir . 'Data/Time', 'w');
                            }
                            
                            // Save A Backup Of The Message
                            if ($contactF_backup_do == 'yes') {
                                contactF_save(contactF_break($contactF_backup), $contactF_dir . 'Sent/' . $contactF_date . ' - ' . $contactF_ip . '.html', "a");
                            }
                            
                            // Confirmation Letter
                            if ($contactF_confirm_do == "yes") {
                                email($contactF_email, $contactF_confirm_from, $contactF_confirm_mail, $contactF_confirm_mail, $contactF_confirm_s, "", $contactF_confirm_b, "", "yes", $contactF_utf);
                            }
                            
                            // Clearing Form Variables
                            $contactF_name    = "";
                            $contactF_email   = "";
                            $contactF_subject = "";
                            $contactF_phone   = "";
                            $contactF_body    = "";
                            $contactF_bodyx   = "";
                            $contactF_alert   = $contactF_alert_i;
                            
                            // Showing Failed Error
                        } else {
                            if ($contactF_backup_do == 'yes') {
                                contactF_save(contactF_break($contactF_backup), $contactF_dir . 'Failed/' . $contactF_date . ' - ' . $contactF_ip . '.html', "a");
                            }
                            $contactF_alert = $contactF_alert_j;
                        }
                    }
                    
                    // Time Limit Error
                } else {
                    $contactF_alert = $contactF_alert_l;
                }
            }
            
            // Security Test Failed
        } else {
            $contactF_alert = $contactF_alert_k;
        }
    }
}

// Saving A New Answer
$contactF_key    = rand(0, 2);
$contactF_answer = $contactF_list[$contactF_rand[$contactF_key]];
$contactF_answer = explode(".", $contactF_answer);
$contactF_answer = $contactF_answer[0];
$contactF_icons  = $contactF_list[$contactF_rand[0]] . "#" . $contactF_list[$contactF_rand[1]] . "#" . $contactF_list[$contactF_rand[2]];
contactF_save($contactF_ip . "contactF_$contactF_key\r\n$contactF_icons\r\n", $contactF_dir . 'Data/Data', 'a');

// Limit The Size Of The Data File
$contactF_truncate = file($contactF_dir . 'Data/Data');
$contactF_count    = count($contactF_truncate);
if ($contactF_count > 1000) {
    $contactF_truncate = array_chunk($contactF_truncate, 500);
    $contactF_lines    = implode(end($contactF_truncate));
    contactF_save($contactF_lines, $contactF_dir . 'Data/Data', 'w');
}

?>
    <!-- Contact -->
    <div id="contactF">
        <div id="contactF-content">
            <form action="<?php
echo $contactF_scriptn.'" id="contactF-form'.$contactF_token.'"';
?> enctype="multipart/form-data" method="post">
                <h1><?php
echo $contactF_text_a;
?></h1>
                    <div id="contactF-alert"<?php
if ($contactF_alert == "") {
    echo ' class="contactF-hide"';
}
?>><?php
echo $contactF_alert;
?></div>
                    <div id="contactF-input">
<?php
if ($contactF_company_do == "yes") {
?>
                        <p id="contactF-company">
                            <span><?php
    echo $contactF_company_a;
?></span>
                            <span><?php
    echo $contactF_company_b;
?></span>
                            <span><?php
    echo $contactF_company_c;
?></span>
                            <span><?php
    echo $contactF_company_d;
?></span>
                            <span><?php
    echo $contactF_company_e;
?></span>
                        </p>
<?php
}
?>
                        <p id="contactF-details"<?php
if ($contactF_company_do !== "yes") {
    echo ' class="contactF-margin"';
}
?>>
                            <span><?php
echo $contactF_text_b;
?>: <em>*</em></span> <input name="contactF_name" type="text" value="<?php
echo $contactF_name;
?>" maxlength="<?php
echo $contactF_limit_name;
?>" />
                            <span><?php
echo $contactF_text_c;
?>: <em>*</em></span> <input name="contactF_email" type="text" value="<?php
echo $contactF_email;
?>" maxlength="<?php
echo $contactF_limit_email;
?>" />
                            <span><?php
echo $contactF_text_d;
?>: <em>*</em></span> <input name="contactF_subject" type="text" value="<?php
echo $contactF_subject;
?>" maxlength="<?php
echo $contactF_limit_subject;
?>" />
<?php
if ($contactF_phone_show == "yes") {
?>
                            <span><?php
    echo $contactF_text_g;
?>: <em>*</em></span> <input name="contactF_phone" type="text" value="<?php
    echo $contactF_phone;
?>" maxlength="<?php
    echo $contactF_limit_phone;
?>" />
<?php
}
?>
                        </p>
                    </div>
                    <div class="contactF-clear"></div>
                    <div id="contactF-txtarea">
                        <p>
                            <textarea name="contactF_body" rows="5" cols="7" maxlength="<?php
echo $contactF_limit_body;
?>"><?php
echo $contactF_bodyx;
?></textarea>
                        </p>
                    </div>
<?php
if ($contactF_u_attachment == "yes") {
?>
                    <div id="contactF-attachment">
                        <label><?php
    echo $contactF_text_h;
?>:</label>
                        <input type="file" name="contactF_file" id="contactF_file">
                    </div>
<?php
}
?>
                    <div id="contactF-verification">
                        <p>
                            <input type="submit" name="contactF_contacting<?php
echo $contactF_token;
?>" value="Send E-mail" <?php
if ($contactF_disablebtn == 'yes' && $contactF_alert == $contactF_alert_i) { 
	echo 'disabled';
} 
?>/>
                            <span><?php
echo "$contactF_text_e <b>$contactF_answer</b> $contactF_text_f";
?>: <em>*</em></span>
                            <input type="radio" id="contactF_0" name="contactF_verified" value="0" /><label for="contactF_0"><img src="<?php
echo $contactF_dir . 'Icons.php?number=0&amp;color=' . $contactF_colors . $contactF_micro;
?>" alt="icon 0"/></label>
                            <input type="radio" id="contactF_1" name="contactF_verified" value="1" /><label for="contactF_1"><img src="<?php
echo $contactF_dir . 'Icons.php?number=1&amp;color=' . $contactF_colors . $contactF_micro;
?>" alt="icon 1"/></label>
                            <input type="radio" id="contactF_2" name="contactF_verified" value="2" /><label for="contactF_2"><img src="<?php
echo $contactF_dir . 'Icons.php?number=2&amp;color=' . $contactF_colors . $contactF_micro;
?>" alt="icon 2"/></label>
                        </p>
                    </div>
            </form>
        </div>
    </div>