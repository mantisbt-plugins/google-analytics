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

auth_reauthenticate( );
access_ensure_global_level( config_get( 'manage_plugin_threshold' ) );

layout_page_header( lang_get( 'plugin_format_title' ) );

layout_page_begin( 'manage_overview_page.php' );

print_manage_menu( 'manage_plugin_page.php' );

$t_admin_threshald = plugin_config_get( 'admin_threshold' );
$t_track_admins = plugin_config_get( 'track_admins' );
//<br/>
?>

<div class="col-md-12 col-xs-12">
<div class="space-10"></div>
<div class="form-container" >

<form action="<?php echo plugin_page( 'config_update' ) ?>" method="post">

<div class="widget-box widget-color-blue2">
<div class="widget-header widget-header-small">
	<h4 class="widget-title lighter">
		<i class="ace-icon fa fa-text-width"></i>
		<?php echo lang_get( 'plugin_format_title' ) . ': ' . lang_get( 'plugin_format_config' )?>
	</h4>
</div>

<div class="widget-body">
<div class="widget-main no-padding">
<div class="table-responsive">
<table class="table table-bordered table-condensed table-striped">
<!-- <table class="width50" align="center" cellspacing="1"> -->

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

</table>
</div>
</div>
<div class="widget-toolbox padding-8 clearfix">
	<input type="submit" class="btn btn-primary btn-white btn-round" value="<?php echo lang_get( 'change_configuration' )?>" />
</div>
</div>
</div>
</form>
</div>
</div>

<?php
layout_page_end();

