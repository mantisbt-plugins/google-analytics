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

$f_google_uid = gpc_get_string( 'google_uid', '' );
$f_admin_threshold = gpc_get_int( 'admin_threshold' );
$f_track_admins = gpc_get_bool( 'track_admins', false );

plugin_config_set( 'google_uid', $f_google_uid );
plugin_config_set( 'admin_threshold', $f_admin_threshold );
plugin_config_set( 'track_admins', $f_track_admins );

print_successful_redirect( plugin_page( 'config', true ) );

