<?php
/**
 * Plugin Name: Universe JS
 * Plugin URI:  https://github.com/sparkartgroup/universe-js
 * Description: Javascript modules and PHP functions for interacting with Sparkart's Universe API.
 * Version:     2.1.1.wordpress-migration
 * Author:      Sparkart Group, Inc.
 * Author URI:  http://www.sparkart.com/
 */
namespace Universe;

function fetch_resource($endpoint, $universe_api_key = null) {
  if (!$universe_api_key && $GLOBALS['solidus_context']) $universe_api_key = $GLOBALS['solidus_context']['site']['integrations']['universe_apikey'];
  if (!$universe_api_key) throw new \Exception('Missing Universe API key');

  $url = "https://services.sparkart.net/api/v1/$endpoint" . (strpos($endpoint, '?') === false ? '?key=' : '&key=') . $universe_api_key;

  if ($GLOBALS['solidus_context']) {
    // Replace dynamic path segments ({tag}, {topic})
    $url = preg_replace_callback('/\{(.+?)\}/', function ($match) {return $GLOBALS['solidus_context']['parameters'][$match[1]];}, $url);
  }

  $request = wp_remote_get($url);
  if (is_wp_error($request)) throw $request;
  $data = json_decode(wp_remote_retrieve_body($request));
  if (strcasecmp($data->status, 'error') == 0) throw new \Exception(implode(', ', $data->messages));
  return $data;
}

function get_template($template) {
  load_template(plugin_dir_path(__FILE__) . $template . '.php', false);
}
