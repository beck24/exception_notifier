<?php

/**
 * {{emails}} and {{html}} replaced when the include file is generated
 * 
 * $exception is the Exception object
 */

// array of emails to notify of exceptions
$notify = array({{emails}});


$url = $_SERVER[ 'HTTP_HOST']. $_SERVER['REQUEST_URI'];
$title = $exception->getMessage();
$body = htmlentities(print_r($exception, true), ENT_QUOTES, 'UTF-8');
$message =  <<<MESSAGE
	{$title}
		
	{$body}
MESSAGE;

foreach ($notify as $n) {
	error_log('sending email to: ' . $n);
	mail($n, "Exception:  {$url}",  $message);
} 

if (file_exists(__DIR__ . '/exception_display.html')) {
	$HTML = file_get_contents(__DIR__ . '/exception_display.html');

	$output = trim($HTML);

	if ($output) {
		echo $output;
	}
}
