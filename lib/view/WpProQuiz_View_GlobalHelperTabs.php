<?php

class WpProQuiz_View_GlobalHelperTabs
{


    public function getHelperSidebar()
    {
        ob_start();

        $this->showHelperSidebar();

        $content = ob_get_contents();

        ob_end_clean();

        return $content;
    }

    public function getHelperTab()
    {
        ob_start();

        $this->showHelperTabContent();

        $content = ob_get_contents();

        ob_end_clean();

        return array(
            'id' => 'wp_pro_quiz_help_tab_1',
            'title' => __('AtozSites-Pro-Quiz', 'AtozSites-Pro-Quiz'),
            'content' => $content,
        );
    }

    private function showHelperTabContent()
    {
        ?>

        <h2>AtozSites-Pro-Quiz</h2>

        <h4>AtozSites-Pro-Quiz on Github</h4>

        <a class="button" target="_blank" href="https://github.com/AtozSites/AtozSites-Pro-Quiz"><?php _e('AtozSites-Pro-Quiz on Github', 'AtozSites-Pro-Quiz'); ?></a>

      
        <?php
    }

    private function showHelperSidebar()
    {
        ?>

        <p>
            <strong><?php _e('For more information:'); ?></strong>
        </p>
        <p>
            <a href="admin.php?page=wpProQuiz_wpq_support"><?php _e('Support', 'AtozSites-Pro-Quiz'); ?></a>
        </p>
        <p>
            <a href="https://github.com/AtozSites/AtozSites-Pro-Quiz" target="_blank">Github</a>
        </p>
       


        <?php
    }
}
