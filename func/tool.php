<?php
/**
 * Convert \n and \r\n and \r to <br />
 *
 * @param string $string String to transform
 * @return string New string
 */
function nl2br2($string) {
    return str_replace(array("\r\n", "\r", "\n"), '<br />', $string);
}

// Serves an external document for download as an HTTP attachment.
function download_document($filename, $mimetype = 'application/octet-stream') {
    if(!file_exists($filename) || !is_readable($filename)) return false;
    $base = basename($filename);
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Disposition: attachment; filename=$base");
    header("Content-Length: " . filesize($filename));
    header("Content-Type: $mimetype");
    readfile($filename);
    exit();
}
function clean($data) {
    if (is_array($data)) {
        foreach ($data as $key => $value) {
            unset($data[$key]);

            $data[clean($key)] = clean($value);
        }
    } else {
        $data = htmlspecialchars($data, ENT_COMPAT);
    }

    return $data;
}

function getSlugId($slug) {

    $s_array=explode("-", $slug);

    return $id=array_shift($s_array);



}
function is_valid_email($email) {
    $result = TRUE;
    if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $email)) {
        $result = FALSE;
    }
    return $result;
}
function limit_string($string, $limit = LIMIT_STRING) {
    // Return early if the string is already shorter than the limit
    if(strlen($string) < $limit) {
        return $string;
    }

    $regex = "/(.{1,$limit})\b/";
    preg_match($regex, $string, $matches);
    return $matches[1];
}
function slug($str) {
    return str_replace(" ","-", $str);
}

function encrypt($text) {
   $data=base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, SECURE_HASH, $text, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
   return rtrim(strtr($data, '+/', '-_'),"=");
}

function decrypt($text) {
    return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, SECURE_HASH, base64_decode(str_pad(strtr($text, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT)), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
}

function str_replace_word($filters,$haystack) {

    foreach($filters as $needle) {
        $pattern = "/\b$needle\b/i";
        $replacement= preg_replace('/^[a-zA-Z0-9_]*$/', str_repeat('*',strlen($needle)), $needle);
        $haystack = preg_replace($pattern, $replacement, $haystack);
    }
    return $haystack;
}
function str_exist_word($filters,$haystack) {
    foreach($filters as $needle) {
        $pattern = "/\b$needle\b/i";
        $result += preg_match($pattern, $haystack);
    }
    return $result;
}

function send_mail($htmlmsg='',$txtmsg='',$to=array(),$subject=null,$reply_to=null) {

    require_once 'plugin/swift/swift_required.php';
	
    $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl');

	$transport->setTimeout(4);
	if (!$transport)
	{
	return 0;
	}

    $from='noreply@flingrider.com';
	$transport->setUsername($from);
	$transport->setPassword('flingrider');
	
    $mailer = Swift_Mailer::newInstance($transport);

    if(!isset($subject)){
        $subject=DEFAULT_SUBJECT;
    }
    //Create a message
    $message = Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom($from)
            ->setTo($to)
            ->setBody($htmlmsg,'text/html')
            ->addPart($txtmsg,'text/plain');
    ;

    
    if(isset($reply_to)){
        $message->setReplyTo($reply_to);
    }

    if (!$mailer->send($message, $failures)) {
        $message= "Internal Failure";
        $flag=0;
    }
    else {

        $message= "Message Sent";
        $flag=1;
    }
    return array("success"=>$flag,"message"=>$message);
}

?>
