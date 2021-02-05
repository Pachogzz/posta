<form role="search" method="get" class="search-form form-row text-center" action="<?php echo home_url( '/' ); ?>">
	<div class="col text-right">
	    <label class="sr-only" for="s"><?php echo _x( 'Buscar:', 'label' ) ?></label>
	    <input type="search" id="s" class="form-control search-field"
			placeholder="<?php echo esc_attr_x( 'Buscar', 'placeholder' ) ?>"
			value="<?php echo get_search_query() ?>" name="s"
			title="<?php echo esc_attr_x( 'Busqueda para:', 'label' ) ?>" />
    	<button type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Buscar', 'submit button' ) ?>" ><i class="fas fa-search"></i></button>
    </div>
</form>