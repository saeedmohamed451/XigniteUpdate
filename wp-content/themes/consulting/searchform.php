<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" class="form-control" placeholder="<?php esc_attr_e( 'Search...', 'consulting' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" />
	<button type="submit"><i class="fa fa-search"></i></button>
</form>