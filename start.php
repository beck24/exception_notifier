<?php

namespace MBeckett\Exception\Notifier;

const PLUGIN_ID = 'exception_notifier';
const PLUGIN_VERSION = 20150322;
const NOTIFIER = 'exception_notifier.php';
const HTML = 'exception_display.html';

// set the config in case it's not already set in settings
// note this is in the global space prior to init, system to be as early as possible
$notifier = elgg_get_config('exception_include');
if (!$notifier) {
	elgg_set_config('exception_include', elgg_get_config('dataroot') . NOTIFIER);
}

elgg_register_event_handler('init', 'system', __NAMESPACE__ . '\\init');


function init() {
	elgg_register_action('exception_notifier/settings/save', __DIR__ . '/actions/settings/save.php', 'admin');
}


/**
 * create the notification script
 */
function set_notifier() {
	unset_notifier();
	
	$dataroot = elgg_get_config('dataroot');
	
	$contents = file_get_contents(__DIR__ . '/lib/template.php');

	$emails = '';
	$email_string = elgg_get_plugin_setting('emails', PLUGIN_ID);
	if ($email_string) {
		$emails = array_unique(array_map('trim', explode("\n", $email_string)));
		foreach ($emails as $key => $e) {
			if (!is_email_address($e)) {
				unset($emails[$key]);
			}
			$emails[$key] = "'{$e}'";
		}
	}

	$contents = str_replace('{{emails}}', implode(', ', $emails), $contents);
	
	$html = elgg_get_plugin_setting('html', PLUGIN_ID);

	$file = elgg_get_config('dataroot') . NOTIFIER;
	file_put_contents($file, $contents);
	
	$file = elgg_get_config('dataroot') . HTML;
	file_put_contents($file, $html);
}

/**
 * remove the notification script
 */
function unset_notifier() {
	$file = elgg_get_config('dataroot') . NOTIFIER;
	if (file_exists($file)) {
		unlink($file);
	}
	
	$file = elgg_get_config('dataroot') . HTML;
	if (file_exists($file)) {
		unlink($file);
	}
}