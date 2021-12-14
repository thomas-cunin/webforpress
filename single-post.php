<?php get_header(); ?>
<?php
if (have_posts()) :
?>
    <!-- HTML content -->
    <?php

    while (have_posts()) : the_post();
        // Display post content
        if(get_post_meta( get_the_ID(), 'montheme_sponso' )) : ?>
            <div class="bg-cover bg-center  h-auto text-white py-24 px-10 object-fill" style="background-image: url(https://images.unsplash.com/photo-1526304640581-d334cdbbf45e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80)">
       <div class="md:w-1/5 bg-indigo-400 py-3 px-3">
        <!-- <p class="font-bold text-sm uppercase"></p> -->
        <p class="text-3xl font-bold">Avertissement</p>
        <p class="text-2xl mb-10 leading-none">Cet article est sponsorisé</p>
        </div>  
    </div>
        <?php endif; ?>
        <div class="max-w-md py-4 px-8 bg-white shadow-lg rounded-lg my-20">
            <div class="flex justify-center md:justify-end -mt-16">
                <img class="w-20 h-20 object-cover rounded-full border-2 border-indigo-500" src="https://images.unsplash.com/photo-1499714608240-22fc6ad53fb2?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=334&q=80">
            </div>
            <div>
                <h2 class="text-gray-800 text-3xl font-semibold"><?php the_title(); ?></h2>
                <p class="mt-2 text-gray-600"><?php the_content(); ?></p>
            </div>
            <div class="flex justify-end mt-4">
                <a href="#" class="text-xl font-medium text-indigo-500"><?php the_category() ?></a>
            </div>
        </div>
    <?php
    endwhile;
    
else : {
    ?>
        <!-- HTML content -->
        <h2>Il n'y a pas de poste</h2>
<?php
    }
endif;
?>

<?php
$the_query = new WP_Query( [
    'post__not_in'=>[get_the_ID()],
    'post_type'=>'post',
    'posts_per_page'=>3

] );
if ($the_query->have_posts()) :
?>
    <!-- HTML content -->
    
    <?php
    while ($the_query->have_posts()) : 
        $the_query->the_post();
        // Display post content
        if(1 == 0) : ?>
            <div class="bg-cover bg-center  h-auto text-white py-24 px-10 object-fill" style="background-image: url(https://images.unsplash.com/photo-1526304640581-d334cdbbf45e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80)">
       <div class="md:w-1/5 bg-indigo-400 py-3 px-3">
        <!-- <p class="font-bold text-sm uppercase"></p> -->
        <p class="text-3xl font-bold">Avertissement</p>
        <p class="text-2xl mb-10 leading-none">Cet article est sponsorisé</p>
        </div>  
    </div>
        <?php endif; ?>
        <div class="max-w-md py-4 px-8 bg-white shadow-lg rounded-lg my-20">
            <div class="flex justify-center md:justify-end -mt-16">
                <img class="w-20 h-20 object-cover rounded-full border-2 border-indigo-500" src="https://images.unsplash.com/photo-1499714608240-22fc6ad53fb2?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=334&q=80">
            </div>
            <div>
                <h2 class="text-gray-800 text-3xl font-semibold"><?php the_title(); ?></h2>
                <p class="mt-2 text-gray-600"><?php the_excerpt(); ?></p>
            </div>
            <div class="flex justify-end mt-4">
                <a href="#" class="text-xl font-medium text-indigo-500"><?php the_category() ?></a>
            </div>
        </div>
    <?php
    endwhile;
    
else : {
    ?>
        <!-- HTML content -->
        <h2>Il n'y a pas de poste</h2>
<?php
    }
endif;
?>

<?php 
get_footer() ?>