<?php global $post; ?>
<section class="p_breadcrumbs_section">
  <div class="container">
    <ol>
      <li><a href="<?php echo HOME; ?>">TOP</a></li>
      <?php 
        if( is_category() || is_single() ) {
          $current_category_arr = [];
          $all_categories = get_the_category();
          foreach( $all_categories as $cat ) {
            if( $cat->category_parent == 0 ) {
              $current_category_arr[] = $cat;
            }
          }
          if( is_single() ) {
            echo '<li><a href="' . esc_url( get_category_link( $current_category_arr[0]->term_id ) ) . '">' . $current_category_arr[0]->name . '</a></li>';
            echo '<li>' . get_the_title() . '</li>';
          } else {
            echo '<li>' . $current_category_arr[0]->name . '</li>';
          }
        } elseif ( is_page() ) {
          if( $post->post_parent ) {
            echo '<li><a href="' . esc_url( get_the_permalink( $post->post_parent ) ) . '">' . get_the_title( $post->post_parent ) . '</a></li>';
          }
          echo '<li>' . get_the_title() . '</li>';
        } elseif ( is_search() ) {
          echo '<li>' . get_search_query() . '</li>';
        }
      ?>
    </ol>
  </div>
</section>