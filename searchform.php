<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<div class="input-group">
		<label for="s" class="sr-only">Search for</label>
	  <input type="text" class="form-control" name="s" placeholder="<?php echo __( 'Search for...', 'quickly' ) ?>">
	  	<span class="input-group-btn">
	    <button type="submit" class="btn btn-secondary" type="button"><?php __( 'Go!', 'quickly' ) ?></button>
	  </span>
	</div>
</form>