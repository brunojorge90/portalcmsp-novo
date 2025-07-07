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

	<?php if ( have_comments() ) : ?>

		<p id="comments-title" class="h2">
			<?php comments_number( __( '<span>No</span> Contribuições', 'bonestheme' ), __( '<span>Uma</span> Contribuição', 'bonestheme' ), __( '<span>%</span> Contribuições', 'bonestheme' ) );?>
		</p>

		<section class="commentlist">
			<?php
				wp_list_comments( array(
					'style'             => 'div',
					'short_ping'        => true,
					'avatar_size'       => 40,
					'callback'          => 'bones_comments',
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

	<?php

	/**$comment_args = array(
		'title_reply'=>'Deixe a sua contribuição:',
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
			'comment_notes_after' => '',
	);*/
	
	$comment_args = array(
		'title_reply'=>'Deixe o seu comentário:',
		'title_reply_before'=>'<div><p>Este é um espaço de livre manifestação. É dedicado apenas para comentários e opiniões sobre as matérias do Portal da Câmara. Sua contribuição será registrada desde que esteja em acordo com nossas <a href="https://www.saopaulo.sp.leg.br/regras-de-boa-convivencia-digital/">regras de boa convivência digital</a> e <a href="https://www.saopaulo.sp.leg.br/politica-de-privacidade/">políticas de privacidade</a>.</p><div style="text-align:center;padding:15px;background:#e0e0e0;">Nesse espaço não há respostas - somente comentários. Em caso de dúvidas, reclamações ou manifestações que necessitem de resposta <a href="https://www.saopaulo.sp.leg.br/fale-conosco/ouvidoria/">clique aqui</a> e fale com a <a href="https://www.saopaulo.sp.leg.br/fale-conosco/ouvidoria/">Ouvidoria da Câmara Municipal de São Paulo</a>.</div><br/>&nbsp;',
		'fields' => apply_filters(
			'comment_form_default_fields', array(
				'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Nome' ) . ( $req ? ' <span>*</span>' : '' ) . '</label> ' .
					'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . ' /></p>',
				'email'  => '<p class="comment-form-email">' .
					'<label for="email">' . __( 'E-mail' ) . ( $req ? ' <span>*</span>' : '' ) . '</label> ' .
						'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . ' />'.'</p>',
				'url'    => '' ) ),
			'comment_field' => '<p>' .
				'<label for="comment">' . __( 'Comentário' ) . '</label>' .
				'<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>' .
				'</p>',
			'comment_notes_after' => '',
	);

	comment_form($comment_args);
	#comment_form();
	?>
