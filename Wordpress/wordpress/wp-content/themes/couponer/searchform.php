<form role="search" method="get" id="searchform" class="searchform form-control-custom" action="<?php echo esc_url( site_url('/') ); ?>">
	<div>
		<input type="text" value="" name="s" id="s" placeholder="<?php esc_attr_e('Search...','coupon'); ?>">
		<input type="submit" id="searchsubmit" value="Search">
	</div>
</form>