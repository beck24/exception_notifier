<?php

namespace MBeckett\Exception\Notifier;

// test exception handling
if (get_input('exception_test')) {
	// generate a broken query
	$options = array(
		'type' => 'user',
		'order_by' => 'invalid_sql',
		'limit' => 1
	);
	
	elgg_get_entities($options);
}

$title = elgg_echo('exception_notifier:settings:test');
$body = elgg_view('output/longtext', array(
	'value' => elgg_echo('exception_notifier:settings:test:help'),
	'class' => 'elgg-subtext'
));
$body .= elgg_view('output/url', array(
	'text' => elgg_echo('exception_notifier:settings:test:run'),
	'href' => elgg_http_add_url_query_elements(current_page_url(), array('exception_test' => 1)),
	'class' => 'elgg-button elgg-button-submit',
	'style' => 'display:inline-block',
	'target' => '_blank'
));

echo elgg_view_module('main', $title, $body);

// start settings
echo elgg_echo('exception_notifier:settings:emails');
echo elgg_view('input/plaintext', array(
	'name' => 'params[emails]',
	'value' => $vars['entity']->emails
));
echo elgg_view('output/longtext', array(
	'value' => elgg_echo('exception_notifier:settings:emails:help'),
	'class' => 'elgg-subtext'
));

echo elgg_echo('exception_notifier:settings:html');
echo elgg_view('input/plaintext', array(
	'name' => 'html',
	'value' => $vars['entity']->html
));
echo elgg_view('output/longtext', array(
	'value' => elgg_echo('exception_notifier:settings:html:help'),
	'class' => 'elgg-subtext'
));