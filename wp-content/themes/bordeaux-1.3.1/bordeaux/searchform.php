<!-- BEGIN .searchform -->
<form method="get" id="searchform" action="<?php echo home_url(); ?>" class="searchform" name="searchform">
	<input type="text" class="input-text" value="<?php $sr = esc_html($s, 1); if($sr) echo $sr; else echo __('search here', 'bordeaux'); ?>"  onfocus="if (this.value == '<?php echo __('search here', 'bordeaux'); ?>') {this.value = '';};" name="s" id="s" />
	<input type="image" class="input-button" onclick="document.forms.searchform.submit()" value="Search!" src="<?php get_template_directory_uri(); ?>/images/blank.png" />
<!-- END .searchform -->
</form>