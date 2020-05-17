<?php

class WpProQuiz_View_WpqSupport extends WpProQuiz_View_View
{

    public function show()
    {
        ?>

        <div class="wrap">
            <h2><?php _e('Support AtozSites-Pro-Quiz', 'AtozSites-Pro-Quiz'); ?></h2>

        
            <p>
                <?php _e('AtozSites-Pro-Quiz is small but nice free quiz plugin for WordPress.', 'AtozSites-Pro-Quiz'); ?> <br>
                <?php _e('I try to implement all wishes as fast as possible and help with problems.', 'AtozSites-Pro-Quiz'); ?>
                <br>
                <?php _e('Your donations can help to ensure that the project continues to remain free.',
                    'AtozSites-Pro-Quiz'); ?>
            </p>

            <h3>AtozSites-Pro-Quiz on Github</h3>

            <a class="button" target="_blank" href="https://github.com/AtozSites/AtozSites-Pro-Quiz"><?php _e('AtozSites-Pro-Quiz on Github', 'AtozSites-Pro-Quiz'); ?></a>


            <h3><?php _e('AtozSites-Pro-Quiz special modification', 'AtozSites-Pro-Quiz'); ?></h3>
            <h3><?php _e('AtozSites-Pro-Quiz special modification', 'AtozSites-Pro-Quiz'); ?></h3>
            <strong><?php _e('You need special AtozSites-Pro-Quiz modification for your website?',
                    'AtozSites-Pro-Quiz'); ?></strong><br>
            <a class="button-primary" href="admin.php?page=wpProQuiz&module=info_adaptation"
               style="margin-top: 5px;"><?php _e('Learn more', 'AtozSites-Pro-Quiz'); ?></a>

            <h3>AtozSites-Pro-Quiz Wiki</h3>

            <a class="button-primary" target="_blank" href="https://github.com/AtozSites/AtozSites-Pro-Quiz/wiki">--> Wiki <--</a>

            <h3 style="margin-top: 40px;"><?php _e('Translate AtozSites-Pro-Quiz', 'AtozSites-Pro-Quiz'); ?></h3>

            <p>
                <?php _e('To translate AtozSites-Pro-Quiz, please follow these steps:', 'AtozSites-Pro-Quiz'); ?>
            </p>

            <ul style="list-style: decimal; padding: 0 22px;">
                <li><?php _e('Login to your account on wordpress.org (or create an account if you don’t have one yet).', 'AtozSites-Pro-Quiz'); ?></li>
                <li><?php _e('Go to https://translate.wordpress.org.', 'AtozSites-Pro-Quiz'); ?></li>
                <li><?php _e('Select your language and click ‘Contribute Translation’.', 'AtozSites-Pro-Quiz'); ?></li>
                <li><?php _e('Go to the Plugins tab and search for ‘AtozSites-Pro-Quiz’.', 'AtozSites-Pro-Quiz'); ?></li>
                <li><?php _e('Select the plugin and start translating!', 'AtozSites-Pro-Quiz'); ?></li>
            </ul>

        </div>

        <?php
    }
}
