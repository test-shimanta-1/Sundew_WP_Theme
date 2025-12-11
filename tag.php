<?php get_header(); ?>

    <main id="main" class="site-main" role="main">

        <?php if ( have_posts() ) : ?>

            <header class="page-header">
                <h1><?php printf( 'Posts Tagged: %s', single_tag_title( '', false ) ); ?></h1>
                <?php if ( tag_description() ) : ?>
                    <div class="tag-description">
                        <?php echo tag_description(); ?>
                    </div>
                <?php endif; ?>
            </header>

            <?php while ( have_posts() ) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <h2><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                    </header>

                    <div class="entry-content">
                        <?php the_excerpt(); ?>
                    </div>
                </article>

            <?php endwhile; ?>

            <?php the_posts_pagination(); ?>

        <?php else : ?>

            <p>No posts found with this tag.</p>

        <?php endif; ?>

    </main>

<?php get_footer(); ?>