<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
	<div class="form-row search-form-row">
		<label class="hidden" for="s">Pesquise no site:</label>
		<input type="text" id="irbusca" value="<?php the_search_query(); ?>" name="s" class="s" placeholder="Pesquise no site" />
		<input type="submit" class="searchsubmit" value="Search" />
	</div>
</form>