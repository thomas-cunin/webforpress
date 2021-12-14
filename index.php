<?php get_header(); ?>
<?php
if (have_posts()) :
?>
    <!-- HTML content -->
    <div class="grid grid-cols-3 gap-2">
        <?php
        while (have_posts()) : the_post();
            // Display post content
        ?>
            <div class="max-w-md py-4 px-8 bg-white shadow-lg rounded-lg my-20 flex flex-col">
                <div class="flex justify-center md:justify-end -mt-16">
                <?php if(get_the_post_thumbnail_url()) : ?>
                    <img class="w-20 h-20 object-cover rounded-full border-2 border-indigo-500" src="<?php the_post_thumbnail_url('post-thumb') ?>">
                <?php else : ?>
                    <img class="w-20 h-20 object-cover rounded-full border-2 border-indigo-500" src="https://happy-company.fr/wp-content/themes/wp-bootstrap-starter/inc/assets/img/mascotteFantome.png">
                <?php endif; ?>
                </div>
                <div>
                    <h2 class="text-gray-800 text-3xl font-semibold"><?php the_title(); ?></h2>
                    <p class="mt-2 text-gray-600"><?php the_excerpt(); ?></p>
                </div>
                <div class="flex justify-end mt-4 flex-col items-end justify-self-end">
                    <a href="<?php the_permalink() ?>" class="block uppercase shadow bg-indigo-800 hover:bg-indigo-700 focus:shadow-outline focus:outline-none text-white text-xs py-3 px-10 rounded">Voir plus</a>                </div>
            </div>
        <?php
        endwhile;
        ?>
    </div><?php

        else : { ?>
        <!-- HTML content -->
        <h2>Il n'y a pas de postes</h2>
        <?php
            }
        endif;
        ?><?php echo paginate_links()  ?>
        <?php get_footer() ?>