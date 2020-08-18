<?php
get_header();
function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

if(have_posts()) : while(have_posts()) : the_post(); ?>

<div style="margin: 10px auto;float:left;">
<figure><img src="<?php the_post_thumbnail_url(); ?>" alt="<?php echo the_title(); ?>" style="border-radius: 75px;max-width:125px;margin:0 auto;"></figure>

<h4 style="text-align:center"><?php the_title(); ?></h4>

<?php 
echo "<div class='entry-content'>";

if(isMobile()){
    echo "<a href='whatsapp://send?phone=".get_field('whatsapp')."&text=".@nl2br($_POST['produtos'])."' class='checkout-button button alt wc-forward'> ATENDIMENTO</a></div></div>";
}
else {
    echo "<a href='https://api.whatsapp.com/send?phone=".get_field('whatsapp')."&text=".@nl2br($_POST['produtos'])."' class='checkout-button button alt wc-forward'> ATENDIMENTO</a></div></div>";
}

endwhile; endif;

get_footer();