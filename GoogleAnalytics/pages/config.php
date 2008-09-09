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

html_page_top1( plugin_lang_get( 'title' ) );
html_page_top2();

$t_admin_threshald = plugin_config_get( 'admin_threshold' );
$t_track_admins = plugin_config_get( 'track_admins' );

?>
<br/>

<form action="<?php echo plugin_page( 'config_update' ) ?>" method="post">
<table class="width50" align="center" cellspacing="1">

<tr>
<td class="form-title" colspan="2"><?php echo plugin_lang_get( 'title' ) ?></td>
</tr>

<tr <?php echo helper_alternate_class() ?>>
<td class="category"><?php echo plugin_lang_get( 'google_uid' ) ?></td>
<td><input name="google_uid" value="<?php echo string_attribute( plugin_config_get( 'google_uid' ) ) ?>"/></td>
</tr>

<tr>
<td class="spacer"></td>
</tr>

<tr <?php echo helper_alternate_class() ?>>
<td class="category"><?php echo plugin_lang_get( 'admin_threshold' ) ?></td>
<td><select name="admin_threshold"><?php print_enum_string_option_list( 'access_levels', plugin_config_get( 'admin_threshold' ) ) ?></select></td>
</tr>

<tr <?php echo helper_alternate_class() ?>>
<td class="category"><?php echo plugin_lang_get( 'track_admins' ) ?></td>
<td><input name="track_admins" type="checkbox" <?php echo (ON == $t_track_admins ? 'checked="checked"' : '') ?>></td>
</tr>

<tr>
<td class="center" colspan="2"><input type="submit"/></td>
</tr>

</table>
</form>

<?php
html_page_bottom1( __FILE__ );

