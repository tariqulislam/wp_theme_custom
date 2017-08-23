<?php
if (!function_exists('tfuse_list_page_options')) :
    function tfuse_list_page_options() {
        $pages = get_pages();
        $result = array();
        $result[0] = __('Select a page', 'tfuse');
        foreach ( $pages as $page ) {
            $result[ $page->ID ] = $page->post_title;
        }
        return $result;
    }
endif;

if (!function_exists('tfuse_list_galleries')) :
    function tfuse_list_galleries() {
        $args = array(
            'hide_empty'    => false, 
        ); 
        
        $terms = get_terms('galleries', $args); 
        $result = array();
        $result[0] = __('Select Gallery Category');
                
        if(!empty($terms))
            foreach ( $terms as $term ) {
                if($term->parent == 0)
                    $result[$term->term_id] = $term->name;
            }
        return $result;
    }
endif;