<?php

class Publicidade
{
    public function __construct() {
        add_action('init', [$this, 'register_publicidade_post_type']);
        add_filter('use_block_editor_for_post_type', [$this, 'disable_classic_editor_for_publicidade'], 10, 2);

        add_filter('post_type_link', [$this, 'custom_publicidade_permalink'], 10, 2);

    }


    public function register_publicidade_post_type() {
        $labels = array(
            'name'                  => _x('Publicidades', 'Post Type General Name', 'textdomain'),
            'singular_name'         => _x('Publicidade', 'Post Type Singular Name', 'textdomain'),
            'menu_name'             => __('Publicidades', 'textdomain'),
            'name_admin_bar'        => __('Publicidade', 'textdomain'),
            'archives'              => __('Arquivo de Publicidades', 'textdomain'),
            'attributes'            => __('Atributos de Publicidade', 'textdomain'),
            'parent_item_colon'     => __('Publicidade Parental:', 'textdomain'),
            'all_items'             => __('Todas Publicidades', 'textdomain'),
            'add_new_item'          => __('Adicionar Nova Publicidade', 'textdomain'),
            'add_new'               => __('Adicionar Novo', 'textdomain'),
            'new_item'              => __('Nova Publicidade', 'textdomain'),
            'edit_item'             => __('Editar Publicidade', 'textdomain'),
            'update_item'           => __('Atualizar Publicidade', 'textdomain'),
            'view_item'             => __('Visualizar Publicidade', 'textdomain'),
            'view_items'            => __('Visualizar Publicidades', 'textdomain'),
            'search_items'          => __('Procurar Publicidade', 'textdomain'),
            'not_found'             => __('Não encontrado', 'textdomain'),
            'not_found_in_trash'    => __('Não encontrado no Lixo', 'textdomain'),
            'featured_image'        => __('Imagem Destaque', 'textdomain'),
            'set_featured_image'    => __('Definir imagem destaque', 'textdomain'),
            'remove_featured_image' => __('Remover imagem destaque', 'textdomain'),
            'use_featured_image'    => __('Usar como imagem destaque', 'textdomain'),
            'insert_into_item'      => __('Inserir na Publicidade', 'textdomain'),
            'uploaded_to_this_item' => __('Enviado para esta Publicidade', 'textdomain'),
            'items_list'            => __('Lista de Publicidades', 'textdomain'),
            'items_list_navigation' => __('Navegação da lista de Publicidades', 'textdomain'),
            'filter_items_list'     => __('Filtrar lista de Publicidades', 'textdomain'),
        );
        $args = array(
            'label'                 => __('Publicidade', 'textdomain'),
            'description'           => __('Post Type para Publicidades', 'textdomain'),
            'labels'                => $labels,
            'supports'              => array('title', 'editor', 'thumbnail'),
            'taxonomies'            => array('category', 'post_tag'),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'post',
            'show_in_rest'          => true, // Habilitar o Gutenberg,
            'rewrite'               => array('slug' => 'publicidade', 'with_front' => false), // Adicionado para customizar o slug

        );
        register_post_type('publicidade', $args);
    }

    public function disable_classic_editor_for_publicidade($use_block_editor, $post_type) {
        if ($post_type === 'publicidade') {
            return true; // Habilitar o Gutenberg
        }
        return $use_block_editor;
    }

    public function custom_publicidade_permalink($post_link, $post) {
        if ($post->post_type === 'publicidade') {
            return home_url('/publicidade/' . $post->post_name . '/');
        }
        return $post_link;
    }
}