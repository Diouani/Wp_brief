 <?php

$eventtime = date('Y');
$prev_limit_year = $eventtime - 1;
$prev_month = '';
$prev_year = '';
$args = array(
        'post_type'        => 'event',
        'post_status' => array('publish', 'future' ),
        'posts_per_page' => 20,
        'ignore_sticky_posts' => 1,
        'orderby' => 'date',
        'order' => 'desc',
);

$postsbymonth = new WP_Query($args);

while($postsbymonth->have_posts()) {
    $country = get_post_meta(get_the_ID(),'country', true);
    $location = get_post_meta(get_the_ID(),'location', true);
    $time_event = get_post_meta(get_the_ID(),'time_event', true);
    $day_event = get_post_meta(get_the_ID(),'day_event', true);
    $media_type = get_post_meta(get_the_ID(), 'media_type', true);
    $postsbymonth->the_post();
    ?>
    <div class="month-event">
    <?php
    if(get_the_time('F') != $prev_month || get_the_time('Y') != $prev_year && get_the_time('Y') == $prev_limit_year) {

                   echo "<h2>".get_the_time('F')."</h2>\n\n";

        }

    ?>
    <ul class="event-list event-entries-wrap">
        <li class="event-list-item item">
           <div class="event-main">
                    <div class="event-list-time">
                        <div class="event-day">
                            <?php echo get_the_time("d"); ?>
                        </div>
                        <div class="event-month">
                            <?php echo get_the_time("F"); ?>
                        </div>
                    </div>
                    <div class="event-list-content">
                        <div class="title-eventpost">
                            <a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>     
                        </div>
                        <div class="time-event">
                            <p class="hours"><i aria-hidden="true" class="fa fa-clock-o"></i> <?php echo  $time_event;?></p>
                            <p class="hours"><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo $location;?></p>
                        </div>
                    </div>
            </div>
        </li>
    </ul>
    </div>            
    <?php

    $prev_month = get_the_time('F');
    $prev_year = get_the_time('Y');


}

?>
