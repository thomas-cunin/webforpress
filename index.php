<?php get_header(); ?>
<?php 
if ( have_posts() ) : 
        ?>
        <!-- HTML content -->
        <div class="grid grid-cols-3 gap-2">
        <?php 
    while ( have_posts() ) : the_post(); 
        // Display post content
        ?>
         <div class="max-w-md py-4 px-8 bg-white shadow-lg rounded-lg my-20">
  <div class="flex justify-center md:justify-end -mt-16">
    <img class="w-20 h-20 object-cover rounded-full border-2 border-indigo-500" src="https://images.unsplash.com/photo-1499714608240-22fc6ad53fb2?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=334&q=80">
  </div>
  <div>
    <h2 class="text-gray-800 text-3xl font-semibold"><?php the_title(); ?></h2>
    <p class="mt-2 text-gray-600"><?php the_excerpt(); ?></p>
  </div>
  <div class="flex justify-end mt-4 flex-col">
    <a href="#" class="text-xl font-medium text-indigo-500"><?php the_category() ?></a>
    <a href="<?php the_permalink() ?>" class="text-xl font-medium text-indigo-500">Voir plus</a>
  </div>
</div>
    <?php 
    endwhile; 
    ?></div><?php
        
    else : { ?>
        <!-- HTML content -->
        <h2>Il n'y a pas de postes</h2>
        <?php 
    }
endif; 
?>
<?php get_footer() ?>

