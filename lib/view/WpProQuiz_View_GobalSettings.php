<?php

/**
 * @property WpProQuiz_Model_GlobalSettings settings
 * @property bool isRaw
 * @property WpProQuiz_Model_Category[] category
 * @property WpProQuiz_Model_Category[] categoryQuiz
 * @property array email
 * @property array userEmail
 * @property WpProQuiz_Model_Template[] templateQuiz
 * @property WpProQuiz_Model_Template[] templateQuestion
 * @property string toplistDataFormat
 * @property string statisticTimeFormat
 */
class WpProQuiz_View_GobalSettings extends WpProQuiz_View_View
{

    public function show()
    {
        ?>
        <style>
            .wpProQuiz-tab-content:not(.wpProQuiz-tab-content-active) {
                display: none;
            }
        </style>

        <div class="wrap wpProQuiz_globalSettings">
            <h2 style="margin-bottom: 10px;"><?php _e('Global settings', 'AtozSites-Pro-Quiz'); ?></h2>

            <div class="nav-tab-wrapper wpProQuiz-top-tab-wrapper">
                <a href="#globalContent" data-tab="globalContent" class="nav-tab nav-tab-active"><?php _e('Global settings', 'AtozSites-Pro-Quiz'); ?></a>
                <a href="#problemContent" data-tab="problemContent" class="nav-tab "><?php _e('Settings in case of problems', 'AtozSites-Pro-Quiz'); ?></a>
            </div>

            <form method="post">
                <div id="poststuff">
                    <div id="globalContent" class="wpProQuiz-tab-content wpProQuiz-tab-content-active">

                        <?php $this->globalSettings(); ?>

                    </div>

                    <div id="problemContent" class="wpProQuiz-tab-content">
                        <div class="postbox">
                            <?php $this->problemSettings(); ?>
                        </div>
                    </div>

                    <input type="submit" name="submit" class="button-primary" id="wpProQuiz_save"
                           value="<?php _e('Save', 'AtozSites-Pro-Quiz'); ?>">
                </div>
            </form>
        </div>

        <?php
    }

    private function globalSettings()
    {

        ?>
        <div class="postbox">
            <h3 class="hndle"><?php _e('Global settings', 'AtozSites-Pro-Quiz'); ?></h3>

            <div class="inside">
                <table class="form-table">
                    <tbody>
                    <tr>
                        <th scope="row">
                            <?php _e('Leaderboard time format', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text">
                                    <span><?php _e('Leaderboard time format', 'AtozSites-Pro-Quiz'); ?></span>
                                </legend>
                                <label>
                                    <input type="radio" name="toplist_date_format"
                                           value="d.m.Y H:i" <?php $this->checked($this->toplistDataFormat,
                                        'd.m.Y H:i'); ?>> 06.11.2010 12:50
                                </label> <br>
                                <label>
                                    <input type="radio" name="toplist_date_format"
                                           value="Y/m/d g:i A" <?php $this->checked($this->toplistDataFormat,
                                        'Y/m/d g:i A'); ?>> 2010/11/06 12:50 AM
                                </label> <br>
                                <label>
                                    <input type="radio" name="toplist_date_format"
                                           value="Y/m/d \a\t g:i A" <?php $this->checked($this->toplistDataFormat,
                                        'Y/m/d \a\t g:i A'); ?>> 2010/11/06 at 12:50 AM
                                </label> <br>
                                <label>
                                    <input type="radio" name="toplist_date_format"
                                           value="Y/m/d \a\t g:ia" <?php $this->checked($this->toplistDataFormat,
                                        'Y/m/d \a\t g:ia'); ?>> 2010/11/06 at 12:50am
                                </label> <br>
                                <label>
                                    <input type="radio" name="toplist_date_format"
                                           value="F j, Y g:i a" <?php $this->checked($this->toplistDataFormat,
                                        'F j, Y g:i a'); ?>> November 6, 2010 12:50 am
                                </label> <br>
                                <label>
                                    <input type="radio" name="toplist_date_format"
                                           value="M j, Y @ G:i" <?php $this->checked($this->toplistDataFormat,
                                        'M j, Y @ G:i'); ?>> Nov 6, 2010 @ 0:50
                                </label> <br>
                                <label>
                                    <input type="radio" name="toplist_date_format"
                                           value="custom" <?php echo in_array($this->toplistDataFormat, array(
                                        'd.m.Y H:i',
                                        'Y/m/d g:i A',
                                        'Y/m/d \a\t g:i A',
                                        'Y/m/d \a\t g:ia',
                                        'F j, Y g:i a',
                                        'M j, Y @ G:i'
                                    )) ? '' : 'checked="checked"'; ?> >
                                    <?php _e('Custom', 'AtozSites-Pro-Quiz'); ?>:
                                    <input class="medium-text" name="toplist_date_format_custom" style="width: 100px;"
                                           value="<?php echo $this->toplistDataFormat; ?>">
                                </label>

                                <p>
                                    <a href="http://codex.wordpress.org/Formatting_Date_and_Time"
                                       target="_blank"><?php _e('Documentation on date and time formatting',
                                            'AtozSites-Pro-Quiz'); ?></a>
                                </p>
                            </fieldset>
                        </td>
                    </tr>

                    <tr>
                        <th scope="row">
                            <?php _e('Statistic time format', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text">
                                    <span><?php _e('Statistic time format', 'AtozSites-Pro-Quiz'); ?></span>
                                </legend>

                                <label>
                                    <?php _e('Select example:', 'AtozSites-Pro-Quiz'); ?>
                                    <select id="statistic_time_format_select">
                                        <option value="0"></option>
                                        <option value="d.m.Y H:i"> 06.11.2010 12:50</option>
                                        <option value="Y/m/d g:i A"> 2010/11/06 12:50 AM</option>
                                        <option value="Y/m/d \a\t g:i A"> 2010/11/06 at 12:50 AM</option>
                                        <option value="Y/m/d \a\t g:ia"> 2010/11/06 at 12:50am</option>
                                        <option value="F j, Y g:i a"> November 6, 2010 12:50 am</option>
                                        <option value="M j, Y @ G:i"> Nov 6, 2010 @ 0:50</option>
                                    </select>
                                </label>

                                <div style="margin-top: 10px;">
                                    <label>
                                        <?php _e('Time format:', 'AtozSites-Pro-Quiz'); ?>:
                                        <input class="medium-text" name="statisticTimeFormat"
                                               value="<?php echo $this->statisticTimeFormat; ?>">
                                    </label>

                                    <p>
                                        <a href="http://codex.wordpress.org/Formatting_Date_and_Time"
                                           target="_blank"><?php _e('Documentation on date and time formatting',
                                                'AtozSites-Pro-Quiz'); ?></a>
                                    </p>
                                </div>
                            </fieldset>
                        </td>
                    </tr>

                    <tr>
                        <th scope="row">
                            <?php _e('Category management', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text">
                                    <span><?php _e('Category management', 'AtozSites-Pro-Quiz'); ?></span>
                                </legend>
                                <select name="category">
                                    <?php foreach ($this->category as $cat) {
                                        echo '<option value="' . $cat->getCategoryId() . '">' . $cat->getCategoryName() . '</option>';

                                    } ?>
                                </select>

                                <div style="padding-top: 5px;">
                                    <input type="text" value="" name="categoryEditText">
                                </div>
                                <div style="padding-top: 5px;">
                                    <input type="button" value="<?php _e('Delete', 'AtozSites-Pro-Quiz'); ?>"
                                           name="categoryDelete" class="button-secondary">
                                    <input type="button" value="<?php _e('Edit', 'AtozSites-Pro-Quiz'); ?>" name="categoryEdit"
                                           class="button-secondary">
                                </div>
                            </fieldset>
                        </td>
                    </tr>
                    <tr>

                        <th scope="row">
                            <?php _e('Quiz Category management', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text">
                                    <span><?php _e('Quiz Category management', 'AtozSites-Pro-Quiz'); ?></span>
                                </legend>
                                <select name="categoryQuiz">
                                    <?php foreach ($this->categoryQuiz as $cat) {
                                        echo '<option value="' . $cat->getCategoryId() . '">' . $cat->getCategoryName() . '</option>';

                                    } ?>
                                </select>

                                <div style="padding-top: 5px;">
                                    <input type="text" value="" name="categoryQuizEditText">
                                </div>
                                <div style="padding-top: 5px;">
                                    <input type="button" value="<?php _e('Delete', 'AtozSites-Pro-Quiz'); ?>"
                                           name="categoryQuizDelete" class="button-secondary">
                                    <input type="button" value="<?php _e('Edit', 'AtozSites-Pro-Quiz'); ?>"
                                           name="categoryQuizEdit" class="button-secondary">
                                </div>
                            </fieldset>
                        </td>
                    </tr>

                    <tr>
                        <th scope="row">
                            <?php _e('Quiz template management', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text">
                                    <span><?php _e('Quiz template management', 'AtozSites-Pro-Quiz'); ?></span>
                                </legend>
                                <select name="templateQuiz">
                                    <?php foreach ($this->templateQuiz as $templateQuiz) {
                                        echo '<option value="' . $templateQuiz->getTemplateId() . '">' . esc_html($templateQuiz->getName()) . '</option>';

                                    } ?>
                                </select>

                                <div style="padding-top: 5px;">
                                    <input type="text" value="" name="templateQuizEditText">
                                </div>
                                <div style="padding-top: 5px;">
                                    <input type="button" value="<?php _e('Delete', 'AtozSites-Pro-Quiz'); ?>"
                                           name="templateQuizDelete" class="button-secondary">
                                    <input type="button" value="<?php _e('Edit', 'AtozSites-Pro-Quiz'); ?>"
                                           name="templateQuizEdit" class="button-secondary">
                                </div>
                            </fieldset>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php _e('Question template management', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text">
                                    <span><?php _e('Question template management', 'AtozSites-Pro-Quiz'); ?></span>
                                </legend>
                                <select name="templateQuestion">
                                    <?php foreach ($this->templateQuestion as $templateQuestion) {
                                        echo '<option value="' . $templateQuestion->getTemplateId() . '">' . esc_html($templateQuestion->getName()) . '</option>';

                                    } ?>
                                </select>

                                <div style="padding-top: 5px;">
                                    <input type="text" value="" name="templateQuestionEditText">
                                </div>
                                <div style="padding-top: 5px;">
                                    <input type="button" value="<?php _e('Delete', 'AtozSites-Pro-Quiz'); ?>"
                                           name="templateQuestionDelete" class="button-secondary">
                                    <input type="button" value="<?php _e('Edit', 'AtozSites-Pro-Quiz'); ?>"
                                           name="templateQuestionEdit" class="button-secondary">
                                </div>
                            </fieldset>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <?php
    }

    private function problemSettings()
    {
        if ($this->isRaw) {
            $rawSystem = __('to activate', 'AtozSites-Pro-Quiz');
        } else {
            $rawSystem = __('not to activate', 'AtozSites-Pro-Quiz');
        }

        ?>

        <div class="updated" id="problemInfo" style="display: none;">
            <h3><?php _e('Please note', 'AtozSites-Pro-Quiz'); ?></h3>

            <p>
                <?php _e('These settings should only be set in cases of problems with AtozSites-Pro-Quiz.', 'AtozSites-Pro-Quiz'); ?>
            </p>
        </div>

        <h3 class="hndle"><?php _e('Settings in case of problems', 'AtozSites-Pro-Quiz'); ?></h3>
        <div class="inside">
            <table class="form-table">
                <tbody>
                <tr>
                    <th scope="row">
                        <?php _e('Automatically add [raw] shortcode', 'AtozSites-Pro-Quiz'); ?>
                    </th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text">
                                <span><?php _e('Automatically add [raw] shortcode', 'AtozSites-Pro-Quiz'); ?></span>
                            </legend>
                            <label>
                                <input type="checkbox" value="1"
                                       name="addRawShortcode" <?php echo $this->settings->isAddRawShortcode() ? 'checked="checked"' : '' ?> >
                                <?php _e('Activate', 'AtozSites-Pro-Quiz'); ?> <span
                                    class="description">( <?php printf(__('It is recommended %s this option on your system.',
                                        'AtozSites-Pro-Quiz'),
                                        '<span style=" font-weight: bold;">' . $rawSystem . '</span>'); ?> )</span>
                            </label>

                            <p class="description">
                                <?php _e('If this option is activated, a [raw] shortcode is automatically set around WpProQuiz shortcode ( [WpProQuiz X] ) into [raw] [WpProQuiz X] [/raw]',
                                    'AtozSites-Pro-Quiz'); ?>
                            </p>

                            <p class="description">
                                <?php _e('Own themes changes internal  order of filters, what causes the problems. With additional shortcode [raw] this is prevented.',
                                    'AtozSites-Pro-Quiz'); ?>
                            </p>
                        </fieldset>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <?php _e('Do not load the Javascript-files in the footer', 'AtozSites-Pro-Quiz'); ?>
                    </th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text">
                                <span><?php _e('Do not load the Javascript-files in the footer',
                                        'AtozSites-Pro-Quiz'); ?></span>
                            </legend>
                            <label>
                                <input type="checkbox" value="1"
                                       name="jsLoadInHead" <?php echo $this->settings->isJsLoadInHead() ? 'checked="checked"' : '' ?> >
                                <?php _e('Activate', 'AtozSites-Pro-Quiz'); ?>
                            </label>

                            <p class="description">
                                <?php _e('Generally all WpProQuiz-Javascript files are loaded in the footer and only when they are really needed.',
                                    'AtozSites-Pro-Quiz'); ?>
                            </p>

                            <p class="description">
                                <?php _e('In very old Wordpress themes this can lead to problems.', 'AtozSites-Pro-Quiz'); ?>
                            </p>

                            <p class="description">
                                <?php _e('If you activate this option, all WpProQuiz-Javascript files are loaded in the header even if they are not needed.',
                                    'AtozSites-Pro-Quiz'); ?>
                            </p>

                            <p class="description">
                                <?php printf(__('Anyone who wants to learn more about this topic should read through the following websites %s and %s.',
                                    'AtozSites-Pro-Quiz'),
                                    '<a href="http://codex.wordpress.org/Theme_Development#Footer_.28footer.php.29" target="_blank">Theme Development</a>',
                                    '<a href="http://codex.wordpress.org/Function_Reference/wp_footer" target="_blank">Function Reference/wp footer</a>'); ?>
                            </p>
                        </fieldset>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <?php _e('Touch Library', 'AtozSites-Pro-Quiz'); ?>
                    </th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text">
                                <span><?php _e('Touch Library', 'AtozSites-Pro-Quiz'); ?></span>
                            </legend>
                            <label>
                                <input type="checkbox" value="1"
                                       name="touchLibraryDeactivate" <?php echo $this->settings->isTouchLibraryDeactivate() ? 'checked="checked"' : '' ?> >
                                <?php _e('Deactivate', 'AtozSites-Pro-Quiz'); ?>
                            </label>

                            <p class="description">
                                <?php _e('In Version 0.13 a new Touch Library was added for mobile devices.',
                                    'AtozSites-Pro-Quiz'); ?>
                            </p>

                            <p class="description">
                                <?php _e('If you have any problems with the Touch Library, please deactivate it.',
                                    'AtozSites-Pro-Quiz'); ?>
                            </p>
                        </fieldset>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <?php _e('jQuery support cors', 'AtozSites-Pro-Quiz'); ?>
                    </th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text">
                                <span><?php _e('jQuery support cors', 'AtozSites-Pro-Quiz'); ?></span>
                            </legend>
                            <label>
                                <input type="checkbox" value="1"
                                       name="corsActivated" <?php echo $this->settings->isCorsActivated() ? 'checked="checked"' : '' ?> >
                                <?php _e('Activate', 'AtozSites-Pro-Quiz'); ?>
                            </label>

                            <p class="description">
                                <?php _e('Is required only in rare cases.', 'AtozSites-Pro-Quiz'); ?>
                            </p>

                            <p class="description">
                                <?php _e('If you have problems with the front ajax, please activate it.',
                                    'AtozSites-Pro-Quiz'); ?>
                            </p>

                            <p class="description">
                                <?php _e('e.g. Domain with special characters in combination with IE',
                                    'AtozSites-Pro-Quiz'); ?>
                            </p>
                        </fieldset>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <?php _e('Repair database', 'AtozSites-Pro-Quiz'); ?>
                    </th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text">
                                <span><?php _e('Repair database', 'AtozSites-Pro-Quiz'); ?></span>
                            </legend>
                            <input type="submit" name="databaseFix" class="button-primary"
                                   value="<?php _e('Repair database', 'AtozSites-Pro-Quiz'); ?>">

                            <p class="description">
                                <?php _e('No date will be deleted. Only AtozSites-Pro-Quiz tables will be repaired.',
                                    'AtozSites-Pro-Quiz'); ?>
                            </p>
                        </fieldset>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <?php
    }

}
