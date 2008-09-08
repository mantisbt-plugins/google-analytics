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

access_ensure_global_level( ADMINISTRATOR );

$t_google_uid = plugin_config_get( 'uid' );
$f_google_uid = gpc_get_string( 'uid', null );

if ( $f_google_uid != $t_google_uid ) {
	plugin_config_set( 'uid', $f_google_uid );
}

print_successful_redirect( plugin_page( 'config', true ) );

