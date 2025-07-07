<?php
/*
The comments page for Bones
*/

// don't load it if you can't comment
if ( post_password_required() ) {
	return;
}

?>

<?php // You can start editing here. ?>

	<?php

	$comment_args = array(
		'title_reply'=>'Deixe a sua contribuição:',
		'title_reply_before'=>'<div><p>Este é um espaço de livre manifestação. É dedicado apenas para comentários e opiniões sobre as matérias do Portal da Câmara. Sua contribuição será registrada desde que esteja em acordo com nossas <a href="https://www.saopaulo.sp.leg.br/regras-de-boa-convivencia-digital/">regras de boa convivência digital</a> e <a href="https://www.saopaulo.sp.leg.br/politica-de-privacidade/">políticas de privacidade</a>.</p><div style="text-align:center;padding:15px;background:#e0e0e0;">Nesse espaço não há respostas - somente comentários. Em caso de dúvidas, reclamações ou manifestações que necessitem de resposta <a href="https://www.saopaulo.sp.leg.br/fale-conosco/ouvidoria/">clique aqui</a> e fale com a <a href="https://www.saopaulo.sp.leg.br/fale-conosco/ouvidoria/">Ouvidoria da Câmara Municipal de São Paulo</a>.</div><br/>&nbsp;',
		'fields' => apply_filters(
			'comment_form_default_fields', array(
				'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Nome' ) . ( $req ? ' <span>*</span>' : '' ) . '</label> ' .
					'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
				'email'  => '<p class="comment-form-email">' .
					'<label for="email">' . __( 'E-mail' ) . ( $req ? ' <span>*</span>' : '' ) . '</label> ' .
						'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />'.'</p>',
				'url'    => '' ) ),
			'comment_field' => '<p>' .
				'<label for="comment">' . __( 'Comentário' ) . '</label>' .
				'<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>' .
				'</p>',
			'comment_notes_before' => 'Seus dados não serão publicados. Campos marcados com * são obrigatórios.',
			'comment_notes_after' => '',
			'cookies_consent' => 'Guardar dados.',
			'label_submit' => 'Enviar contribuição',
	);

	comment_form($comment_args);
	#comment_form();
	?>

	<?php 
	// Comment Layout
	function clean_comments( $comment, $args, $depth ) {
		 $GLOBALS['comment'] = $comment; ?>
		<div id="comment-<?php comment_ID(); ?>" <?php comment_class('cf'); ?>>
			<article  class="cf">
				<header class="comment-author vcard">
					<?php
					/*
						this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
						echo get_avatar($comment,$size='32',$default='<path_to_url>' );
					*/
					?>
					<?php // custom gravatar call ?>
					<?php
						// create variable
						$bgauthemail = get_comment_author_email();
					?>
					<img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=40" class="load-gravatar avatar avatar-48 photo" height="40" width="40" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
					<?php // end custom gravatar call ?>
					<?php printf(__( '<cite class="fn">%1$s</cite> %2$s', 'bonestheme' ), get_comment_author_link(), edit_comment_link(__( '(Edit)', 'bonestheme' ),'  ','') ) ?>
					<time datetime="<?php echo comment_time('d-m-Y'); ?>"><?php comment_time(__( 'd/m/Y', 'bonestheme' )); ?></time>

				</header>
				<?php if ($comment->comment_approved == '0') : ?>
					<div class="alert alert-info">
						<p><?php _e( 'Seu comentário aguarda moderação.', 'bonestheme' ) ?></p>
					</div>
				<?php endif; ?>
				<section class="comment_content cf">
					<?php comment_text() ?>
				</section>
				<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
			</article>
		<?php // </li> is added by WordPress automatically ?>
	<?php
	} // don't remove this bracket!

	?>

	<?php if ( have_comments() ) : ?>

		<h3 id="comments-title" class="h2">
			<?php comments_number( __( '<span>Sem</span> Contribuições', 'bonestheme' ), __( '<span>Uma</span> Contribuição', 'bonestheme' ), __( '<span>%</span> Contribuições', 'bonestheme' ) );?>
		</h3>

		<section class="commentlist">
			<?php
				wp_list_comments( array(
					'style'             => 'div',
					'short_ping'        => true,
					'avatar_size'       => 40,
					'callback'          => 'clean_comments',
					'type'              => 'all',
					'reply_text'        => 'Responder',
					'page'              => '',
					'per_page'          => '',
					'reverse_top_level' => null,
					'reverse_children'  => ''
				) );
			?>
		</section>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav class="navigation comment-navigation" role="navigation">
				<div class="comment-nav-prev"><?php previous_comments_link( __( '&larr; Anteriores', 'bonestheme' ) ); ?></div>
				<div class="comment-nav-next"><?php next_comments_link( __( 'Mais contribuições &rarr;', 'bonestheme' ) ); ?></div>
			</nav>
		<?php endif; ?>

		<?php if ( ! comments_open() ) : ?>
			<p class="no-comments"><?php _e( 'Contribuições encerradas.' , 'bonestheme' ); ?></p>
		<?php endif; ?>

	<?php endif; ?>
