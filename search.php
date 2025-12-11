<?php get_header(); ?>

<main>
    <div class="container">
        <header class="page-header">
            <h1 class="page-title">
                <?php printf( esc_html__( 'Search Results for: %s', 'your-textdomain' ), '<span>' . get_search_query() . '</span>' ); ?>
            </h1>
        </header>

        <?php if ( have_posts() ) : ?>
            
            <div class="search-results">
                <?php
                while ( have_posts() ) :
                    the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('search-result-item'); ?>>
                        <h2 class="entry-title">
                            <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                        </h2>
                        
                        <div class="entry-summary">
                            <?php the_excerpt(); ?>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <div class="pagination">
                <?php
                // Default pagination
                the_posts_pagination( array(
                    'prev_text' => __('« Previous', 'your-textdomain'),
                    'next_text' => __('Next »', 'your-textdomain'),
                ) );
                ?>
            </div>

        <?php else : ?>

            <div class="no-results not-found">
                <h2><?php esc_html_e( 'Nothing Found', 'your-textdomain' ); ?></h2>
                <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'your-textdomain' ); ?></p>

                <?php get_search_form(); ?>
            </div>

        <?php endif; ?>
    </div>

</main>

<?php get_footer(); ?>