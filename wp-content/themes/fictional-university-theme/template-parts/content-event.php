<div class="event-summary">
    <a class="event-summary__date t-center" href="<?php the_permalink(); ?>">
        <span class="event-summary__month">
            <!-- correctly format event date using inbuilt DateTime class -->
            <?php $eventDate = new DateTime(get_field('event_date'));
            echo $eventDate->format('M'); ?>
        </span>
        <span class="event-summary__day">
            <?php $eventDate = new DateTime(get_field('event_date'));
            echo $eventDate->format('d'); ?>
        </span>
    </a>
    <div class="event-summary__content">
        <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>">
                <?php the_title() ?>
            </a></h5>

        <?php if (has_excerpt()) {
            the_excerpt();
        } else {
            wp_trim_words(the_content(), 18);
        }
        ; ?>
        <a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a>
    </div>
</div>