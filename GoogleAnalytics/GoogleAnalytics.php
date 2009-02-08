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

	function register() {
		$this->name = plugin_lang_get( 'title' );
		$this->description = plugin_lang_get( 'description' );
		$this->page = 'config';

		$this->version = "1.0";
		$this->requires = array(
			'MantisCore' => "1.2",
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
			'EVENT_LAYOUT_BODY_END' => 'footer',
		);
	}

	function footer() {
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

		$t_google_js = <<< EOT
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("$t_google_uid");
pageTracker._trackPageview();
</script>
EOT;

		return $t_google_js;
	}
}

