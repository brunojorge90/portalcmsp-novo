
<section class="banners-row cf">
<?php if( have_rows('banners') ): ?>
	<ul>
	<?php while( have_rows('banners') ): the_row(); 
		// vars
		$image = get_sub_field('imagem');
		$link = get_sub_field('link');
		$destino = get_sub_field('destino');
		?>
		<li>
			<?php if( $link ): ?>
				<a href="<?php echo $link; ?>" <?php if($destino){ echo 'target="_blank"'; }?>>
			<?php endif; ?>
				<img src="<?php echo $image; ?>" alt="Banners" />
			<?php if( $link ): ?>
				</a>
			<?php endif; ?>
		</li>
	<?php endwhile; ?>
	</ul>
<?php endif; ?>
</section>