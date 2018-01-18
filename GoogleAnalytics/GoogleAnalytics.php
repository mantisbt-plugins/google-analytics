<?php
# Copyright (C) 2008	John Reese
#
# This program is free software: you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.

class GoogleAnalyticsPlugin extends MantisPlugin {
	
	// This code allow script based on CSP 2.0 (nonce)
	// const noncevalue = 'HCpcYCEnfgaoi987vbldhgUNBL';
	
	function register() {
		$this->name = plugin_lang_get( 'title' );
		$this->description = plugin_lang_get( 'description' );
		$this->page = 'config';

		$this->version = "2.0";
		$this->requires = array(
			'MantisCore' => '2.0',
		);

		$this->author = "John Reese";
		$this->contact = 'jreese@leetcode.net';
		$this->url = 'http://leetcode.net';
	}

	function config() {
		return array(
			'admin_threshold' => ADMINISTRATOR,
			'track_admins' => true,

			'google_uid' => 'UA-XXXX-X',
		);
	}

	function hooks() {
		return array(
			'EVENT_LAYOUT_RESOURCES' => 'resources',
			'EVENT_CORE_HEADERS' => 'csp_headers'
		);
	}
	
	function resources() {
		# Don't use analytics on login pages
		$t_file = $_SERVER['SCRIPT_FILENAME'];
		if ( strpos( basename( $t_file ), 'login' ) ) {
			return;
		}

		$t_admin_threshold = plugin_config_get( 'admin_threshold' );
		$t_track_admins = plugin_config_get( 'track_admins' );

		$t_google_uid = string_attribute( plugin_config_get( 'google_uid' ) );

		if ( ( is_blank( $t_google_uid ) || 'UA-XXXX-X' == $t_google_uid ) ||
	   		( !$t_track_admins && access_has_global_level( $t_admin_threshold ) ) ) {
			return;
		}
		// This code allow script based on CSP 2.0 (nonce)
        // $noncevalue = constant('GoogleAnalyticsPlugin::noncevalue');
		// <script nonce="$noncevalue">
		$t_google_js = <<< HTML

<!-- Google Analytics -->
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

ga('create', '$t_google_uid', 'auto');
ga('send', 'pageview');
</script>
<!-- End Google Analytics -->

HTML;

		return $t_google_js;
	}
	
	function csp_headers() {
		// This code allow script based on CSP 1.0
		http_csp_add( 'script-src', "'unsafe-inline'" );  
		http_csp_add( 'script-src', 'https://www.google-analytics.com' ); 
		http_csp_add( 'img-src', 'https://www.google-analytics.com' ); 
		http_csp_add( 'img-src', 'http://stats.g.doubleclick.net' ); 
		http_csp_add( 'img-src', 'https://www.google.com' ); 
		http_csp_add( 'img-src', 'https://www.google.com.ua' ); 
		
		// This code allow script based on CSP 2.0 (nonce)
		// $noncevalue = constant('GoogleAnalyticsPlugin::noncevalue');
		// http_csp_add( 'script-src', "'nonce-$noncevalue'" ); 
		// http_csp_add( 'script-src', 'https://www.google-analytics.com' ); 
		// http_csp_add( 'img-src', 'https://www.google-analytics.com' ); 
		// http_csp_add( 'img-src', 'http://stats.g.doubleclick.net' ); 
		// http_csp_add( 'img-src', 'https://www.google.com' ); 
		// http_csp_add( 'img-src', 'https://www.google.com.ua' ); 
	}
}

