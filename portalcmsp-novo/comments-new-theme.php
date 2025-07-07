<?php
/*
The comments page for Bones
*/

// don't load it if you can't comment
if (post_password_required()) {
    return;
}

?>

<?php // You can start editing here. ?>

<?php ?>
<div class="flex flex-end">
    <div class="close">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M18 6L6 18" stroke="#717171" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M6 6L18 18" stroke="#717171" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </div>
</div>
<div class="aviso">
    Este é um espaço de livre manifestação. É dedicado apenas para comentários e opiniões sobre as matérias do Portal da
    Câmara. Sua contribuição será registrada desde que esteja em acordo com nossas regras de boa convivência digital e
    políticas de privacidade.
    <div class="aviso-2">
        Nesse espaço não há respostas - somente comentários. Em caso de dúvidas, reclamações ou manifestações que
        necessitem de respostas clique aqui e fale com a Ouvidoria da Câmara Municipal de São Paulo.
    </div>
</div>

<?php
$comment_args = array(
    'title_reply' => 'Enviar mensagem',
    'fields' => apply_filters(
        'comment_form_default_fields', array(
        'author' => '<p class="comment-form-author">' . '<label for="author" class="label">' . __('Nome') . ($req ? ' <span>*</span>' : '') . '</label> ' .
            '<input class="field-style" id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . ' /></p>',
        'email' => '<p class="comment-form-email">' .
            '<label for="email" class="label">' . __('E-mail') . ($req ? ' <span>*</span>' : '') . '</label> ' .
            '<input class="field-style" id="email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . ' />' . '</p>',
        'url' => '')),
    'comment_field' => '<p>' .
        '<label for="comment" class="label">' . __('Comentário *') . '</label>' .
        '<textarea class="field-style" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>' .
        '</p>',
    'comment_notes_after' => '',
    'class_submit' => 'button-primary',
    'label_submit' => 'Enviar'
);
ob_start();
comment_form($comment_args);
$form = ob_get_clean();
$form = str_replace("<p class=\"form-submit\">", "<p class=\"form-submit\">Enviar comentário" ,$form);
$form = str_replace("<h3", "<p" ,$form);
$form = str_replace("</h3", "</searp" ,$form);
echo $form;
ob_end_flush();


?>

<?php if (have_comments()) : ?>

    <p id="comments-title" class="h2">
        <?php comments_number(__('Comentários', 'bonestheme'), __('<span>Um</span> comentário', 'bonestheme'), __('Comentários', 'bonestheme')); ?>
    </p>

    <section class="commentlist">
        <?php
        wp_list_comments(array(
            'style' => 'div',
            'short_ping' => true,
            'avatar_size' => 40,
            'callback' => 'bones_comments',
            'type' => 'all',
            'reply_text' => 'Responder',
            'page' => '',
            'per_page' => '',
            'reverse_top_level' => null,
            'reverse_children' => ''
        ));
        ?>
    </section>

    <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
        <nav class="navigation comment-navigation" role="navigation">
            <div class="comment-nav-prev"><?php previous_comments_link(__('&larr; Anteriores', 'bonestheme')); ?></div>
            <div class="comment-nav-next"><?php next_comments_link(__('Mais contribuições &rarr;', 'bonestheme')); ?></div>
        </nav>
    <?php endif; ?>

    <?php if (!comments_open()) : ?>
        <p class="no-comments"><?php _e('Contribuições encerradas.', 'bonestheme'); ?></p>
    <?php endif; ?>

<?php endif; ?>

<?php

/**$comment_args = array(
 * 'title_reply'=>'Deixe a sua contribuição:',
 * 'fields' => apply_filters(
 * 'comment_form_default_fields', array(
 * 'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Nome' ) . ( $req ? ' <span>*</span>' : '' ) . '</label> ' .
 * '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
 * 'email'  => '<p class="comment-form-email">' .
 * '<label for="email">' . __( 'E-mail' ) . ( $req ? ' <span>*</span>' : '' ) . '</label> ' .
 * '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />'.'</p>',
 * 'url'    => '' ) ),
 * 'comment_field' => '<p>' .
 * '<label for="comment">' . __( 'Comentário' ) . '</label>' .
 * '<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>' .
 * '</p>',
 * 'comment_notes_after' => '',
 * );*/

?>
