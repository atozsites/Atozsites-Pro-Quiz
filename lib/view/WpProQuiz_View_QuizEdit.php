<?php

/**
 * @property WpProQuiz_Model_Form[] forms
 * @property WpProQuiz_Model_Quiz quiz
 * @property array prerequisiteQuizList
 * @property WpProQuiz_Model_Template[] templates
 * @property array quizList
 * @property bool captchaIsInstalled
 * @property WpProQuiz_Model_Category[] categories
 * @property string header
 */
class WpProQuiz_View_QuizEdit extends WpProQuiz_View_View
{
    public function show()
    {
        $this->inlineStyle();
        ?>
        <div class="wrap wpProQuiz_quizEdit">
            <h2 style="margin-bottom: 10px;"><?php echo $this->header; ?></h2>

            <form method="post"
                  action="<?php echo admin_url('admin.php?page=wpProQuiz&action=addEdit&quizId=' . $this->quiz->getId()); ?>">

                <input type="hidden" name="ajax_quiz_id" value="<?php echo $this->quiz->getId(); ?>">

                <a style="float: left;" class="button-secondary" href="<?php echo admin_url('admin.php?page=wpProQuiz'); ?>">
                    <?php _e('back to overview', 'AtozSites-Pro-Quiz'); ?>
                </a>

                <div style="float: right;">
                    <select name="templateLoadId">
                        <?php
                        foreach ($this->templates as $template) {
                            echo '<option value="', $template->getTemplateId(), '">', esc_html($template->getName()), '</option>';
                        }
                        ?>
                    </select>
                    <input type="submit" name="templateLoad" value="<?php _e('load template', 'AtozSites-Pro-Quiz'); ?>"
                           class="button-primary">
                </div>
                <div style="clear: both;"></div>

                <?php $this->tabBar(); ?>
                <?php $this->tabContents() ?>

                <div id="poststuff">

                    <div style="float: left;">
                        <input type="submit" name="submit" class="button-primary" id="wpProQuiz_save"
                               value="<?php _e('Save', 'AtozSites-Pro-Quiz'); ?>">
                    </div>
                    <div style="float: right;">
                        <input type="text" placeholder="<?php _e('template name', 'AtozSites-Pro-Quiz'); ?>"
                               class="regular-text" name="templateName" style="border: 1px solid rgb(255, 134, 134);">
                        <select name="templateSaveList">
                            <option value="0">=== <?php _e('Create new template', 'AtozSites-Pro-Quiz'); ?> ===</option>
                            <?php
                            foreach ($this->templates as $template) {
                                echo '<option value="', $template->getTemplateId(), '">', esc_html($template->getName()), '</option>';
                            }
                            ?>
                        </select>

                        <input type="submit" name="template" class="button-primary" id="wpProQuiz_saveTemplate"
                               value="<?php _e('Save as template', 'AtozSites-Pro-Quiz'); ?>">
                    </div>
                    <div style="clear: both;"></div>
                </div>
            </form>
        </div>
        <?php
    }

    private function inlineStyle()
    {
        ?>
        <style>
            .wpProQuiz_quizModus th, .wpProQuiz_quizModus td {
                border-right: 1px solid #A0A0A0;
                padding: 5px;
            }

            .wpProQuiz_demoBox {
                position: relative;
            }
            .wpProQuiz-tab-content:not(.wpProQuiz-tab-content-active) {
                display: none;
            }
            .wpProQuiz_demoBox > div, .wpProQuiz_demoBox > span {
                z-index: 9999999;
                position: absolute;
                background-color: #E9E9E9;
                padding: 10px;
                box-shadow: 0 0 10px 4px rgb(44, 44, 44);
                display: none;
            }
        </style>
        <?php
    }

    private function tabBar()
    {
        ?>
        <div class="nav-tab-wrapper wpProQuiz-top-tab-wrapper">
            <a href="#tabGeneral" data-tab="tabGeneral" class="nav-tab nav-tab-active"><?php _e('General', 'AtozSites-Pro-Quiz'); ?></a>
            <a href="#tabResult" data-tab="tabResult" class="nav-tab "><?php _e('Result', 'AtozSites-Pro-Quiz'); ?></a>
            <a href="#tabOptions" data-tab="tabOptions" class="nav-tab "><?php _e('Options', 'AtozSites-Pro-Quiz'); ?></a>
            <a href="#tabCustomFields" data-tab="tabCustomFields" class="nav-tab "><?php _e('Custom fields', 'AtozSites-Pro-Quiz'); ?></a>
            <a href="#tabLeaderboard" data-tab="tabLeaderboard" class="nav-tab "><?php _e('Leaderboard', 'AtozSites-Pro-Quiz'); ?></a>
            <a href="#tabEmailSettings" data-tab="tabEmailSettings" class="nav-tab "><?php _e('Email Settings', 'AtozSites-Pro-Quiz'); ?></a>
            <a href="#tabPlugins" data-tab="tabPlugins" class="nav-tab "><?php _e('Plugins', 'AtozSites-Pro-Quiz'); ?></a>
            <?php do_action('wpProQuiz_quizEdit_tab_wrapper', $this); ?>
        </div>
        <?php
    }

    private function tabContents()
    {
        ?>
        <div id="poststuff">
            <div id="tabGeneral" class="wpProQuiz-tab-content wpProQuiz-tab-content-active">
                <?php $this->tabGerneral(); ?>
            </div>
            <div id="tabEmailSettings" class="wpProQuiz-tab-content">
                <?php $this->tabEmailSettings(); ?>
            </div>
            <div id="tabCustomFields" class="wpProQuiz-tab-content">
                <?php $this->tabCustomFields(); ?>
            </div>
            <div id="tabLeaderboard" class="wpProQuiz-tab-content">
                <?php $this->tabLeaderboard(); ?>
            </div>
            <div id="tabResult" class="wpProQuiz-tab-content">
                <?php $this->tabResult(); ?>
            </div>
            <div id="tabOptions" class="wpProQuiz-tab-content">
                <?php $this->tabOptions(); ?>
            </div>
            <div id="tabPlugins" class="wpProQuiz-tab-content">
                <?php $this->tabPlugins(); ?>
            </div>
            <?php do_action('wpProQuiz_quizEdit_tab_content', $this); ?>
        </div>
        <?php
    }

    private function tabGerneral()
    {
        $this->postBoxTitle();
        $this->postBoxCategory();
        $this->postBoxQuizMode();
        $this->postBoxQuizDescription();

        do_action('wpProQuiz_quizEdit_tab_content_gerneral', $this);
    }

    private function tabEmailSettings()
    {
        $this->postBoxAdminEmailOption();
        $this->postBoxUserEmailOption();

        do_action('wpProQuiz_quizEdit_tab_content_email_settings', $this);
    }

    private function tabCustomFields()
    {
        $this->postBoxForms();

        do_action('wpProQuiz_quizEdit_tab_content_form', $this);
    }

    private function tabLeaderboard()
    {
        $this->postBoxLeaderboardOptions();

        do_action('wpProQuiz_quizEdit_tab_content_leaderboard', $this);
    }

    private function tabResult()
    {
        $this->postBoxResult();
        $this->postBoxResultOptions();

        do_action('wpProQuiz_quizEdit_tab_content_result', $this);
    }

    private function tabOptions()
    {
        $this->postBoxOptions();
        $this->postBoxQuestionOptions();

        do_action('wpProQuiz_quizEdit_tab_content_options', $this);
    }

    private function tabPlugins()
    {
        /** @deprecated use wpProQuiz_quizEdit_tab_plugins hook */
        do_action('wpProQuiz_action_plugin_quizEdit', $this);


        do_action('wpProQuiz_quizEdit_tab_content_plugins', $this);
    }

    private function postBoxOptions()
    {
        ?>
        <div class="postbox">
            <h3 class="hndle"><?php _e('Options', 'AtozSites-Pro-Quiz'); ?></h3>

            <div class="inside">
                <table class="form-table">
                    <tbody>
                    <tr>
                        <th scope="row">
                            <?php _e('Hide quiz title', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text">
                                    <span><?php _e('Hide title', 'AtozSites-Pro-Quiz'); ?></span>
                                </legend>
                                <label for="title_hidden">
                                    <input type="checkbox" id="title_hidden" value="1"
                                           name="titleHidden" <?php echo $this->quiz->isTitleHidden() ? 'checked="checked"' : '' ?> >
                                    <?php _e('Activate', 'AtozSites-Pro-Quiz'); ?>
                                </label>

                                <p class="description">
                                    <?php _e('The title serves as quiz heading.', 'AtozSites-Pro-Quiz'); ?>
                                </p>
                            </fieldset>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php _e('Hide "Restart quiz" button', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text">
                                    <span><?php _e('Hide "Restart quiz" button', 'AtozSites-Pro-Quiz'); ?></span>
                                </legend>
                                <label for="btn_restart_quiz_hidden">
                                    <input type="checkbox" id="btn_restart_quiz_hidden" value="1"
                                           name="btnRestartQuizHidden" <?php echo $this->quiz->isBtnRestartQuizHidden() ? 'checked="checked"' : '' ?> >
                                    <?php _e('Activate', 'AtozSites-Pro-Quiz'); ?>
                                </label>

                                <p class="description">
                                    <?php _e('Hide the "Restart quiz" button in the Frontend.',
                                        'AtozSites-Pro-Quiz'); ?>
                                </p>
                            </fieldset>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php _e('Hide "View question" button', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text">
                                    <span><?php _e('Hide "View question" button', 'AtozSites-Pro-Quiz'); ?></span>
                                </legend>
                                <label for="btn_view_question_hidden">
                                    <input type="checkbox" id="btn_view_question_hidden" value="1"
                                           name="btnViewQuestionHidden" <?php echo $this->quiz->isBtnViewQuestionHidden() ? 'checked="checked"' : '' ?> >
                                    <?php _e('Activate', 'AtozSites-Pro-Quiz'); ?>
                                </label>

                                <p class="description">
                                    <?php _e('Hide the "View question" button in the Frontend.',
                                        'AtozSites-Pro-Quiz'); ?>
                                </p>
                            </fieldset>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php _e('Display question randomly', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text">
                                    <span><?php _e('Display question randomly', 'AtozSites-Pro-Quiz'); ?></span>
                                </legend>
                                <label for="question_random">
                                    <input type="checkbox" id="question_random" value="1"
                                           name="questionRandom" <?php echo $this->quiz->isQuestionRandom() ? 'checked="checked"' : '' ?> >
                                    <?php _e('Activate', 'AtozSites-Pro-Quiz'); ?>
                                </label>
                            </fieldset>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php _e('Display answers randomly', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text">
                                    <span><?php _e('Display answers randomly', 'AtozSites-Pro-Quiz'); ?></span>
                                </legend>
                                <label for="answer_random">
                                    <input type="checkbox" id="answer_random" value="1"
                                           name="answerRandom" <?php echo $this->quiz->isAnswerRandom() ? 'checked="checked"' : '' ?> >
                                    <?php _e('Activate', 'AtozSites-Pro-Quiz'); ?>
                                </label>
                            </fieldset>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php _e('Sort questions by category', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text">
                                    <span><?php _e('Sort questions by category', 'AtozSites-Pro-Quiz'); ?></span>
                                </legend>
                                <label>
                                    <input type="checkbox" value="1"
                                           name="sortCategories" <?php $this->checked($this->quiz->isSortCategories()); ?> >
                                    <?php _e('Activate', 'AtozSites-Pro-Quiz'); ?>
                                </label>

                                <p class="description">
                                    <?php _e('Also works in conjunction with the "display randomly question" option.',
                                        'AtozSites-Pro-Quiz'); ?>
                                </p>
                            </fieldset>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php _e('Time limit', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text">
                                    <span><?php _e('Time limit', 'AtozSites-Pro-Quiz'); ?></span>
                                </legend>
                                <label for="time_limit">
                                    <input type="number" min="0" class="small-text" id="time_limit"
                                           value="<?php echo $this->quiz->getTimeLimit(); ?>"
                                           name="timeLimit"> <?php _e('Seconds', 'AtozSites-Pro-Quiz'); ?>
                                </label>

                                <p class="description">
                                    <?php _e('0 = no limit', 'AtozSites-Pro-Quiz'); ?>
                                </p>
                            </fieldset>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php _e('Statistics', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text">
                                    <span><?php _e('Statistics', 'AtozSites-Pro-Quiz'); ?></span>
                                </legend>
                                <label for="statistics_on">
                                    <input type="checkbox" id="statistics_on" value="1"
                                           name="statisticsOn" <?php echo $this->quiz->isStatisticsOn() ? 'checked="checked"' : ''; ?>>
                                    <?php _e('Activate', 'AtozSites-Pro-Quiz'); ?>
                                </label>

                                <p class="description">
                                    <?php _e('Statistics about right or wrong answers. Statistics will be saved by completed quiz, not after every question. The statistics is only visible over administration menu. (internal statistics)',
                                        'AtozSites-Pro-Quiz'); ?>
                                </p>
                            </fieldset>
                        </td>
                    </tr>
                    <tr id="statistics_ip_lock_tr" style="display: none;">
                        <th scope="row">
                            <?php _e('Statistics IP-lock', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text">
                                    <span><?php _e('Statistics IP-lock', 'AtozSites-Pro-Quiz'); ?></span>
                                </legend>
                                <label for="statistics_ip_lock">
                                    <input type="number" min="0" class="small-text" id="statistics_ip_lock"
                                           value="<?php echo ($this->quiz->getStatisticsIpLock() === null) ? 1440 : $this->quiz->getStatisticsIpLock(); ?>"
                                           name="statisticsIpLock">
                                    <?php _e('in minutes (recommended 1440 minutes = 1 day)',
                                        'AtozSites-Pro-Quiz'); ?>
                                </label>

                                <p class="description">
                                    <?php _e('Protect the statistics from spam. Result will only be saved every X minutes from same IP. (0 = deactivated)',
                                        'AtozSites-Pro-Quiz'); ?>
                                </p>
                            </fieldset>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php _e('Execute quiz only once', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <fieldset>

                                <legend class="screen-reader-text">
                                    <span><?php _e('Execute quiz only once', 'AtozSites-Pro-Quiz'); ?></span>
                                </legend>

                                <label>
                                    <input type="checkbox" value="1"
                                           name="quizRunOnce" <?php echo $this->quiz->isQuizRunOnce() ? 'checked="checked"' : '' ?>>
                                    <?php _e('Activate', 'AtozSites-Pro-Quiz'); ?>
                                </label>

                                <p class="description">
                                    <?php _e('If you activate this option, the user can complete the quiz only once. Afterwards the quiz is blocked for this user.',
                                        'AtozSites-Pro-Quiz'); ?>
                                </p>

                                <div id="wpProQuiz_quiz_run_once_type"
                                     style="margin-bottom: 5px; display: none;">
                                    <?php _e('This option applies to:', 'AtozSites-Pro-Quiz');

                                    $quizRunOnceType = $this->quiz->getQuizRunOnceType();
                                    $quizRunOnceType = ($quizRunOnceType == 0) ? 1 : $quizRunOnceType;

                                    ?>
                                    <label>
                                        <input name="quizRunOnceType" type="radio"
                                               value="1" <?php echo ($quizRunOnceType == 1) ? 'checked="checked"' : ''; ?>>
                                        <?php _e('all users', 'AtozSites-Pro-Quiz'); ?>
                                    </label>
                                    <label>
                                        <input name="quizRunOnceType" type="radio"
                                               value="2" <?php echo ($quizRunOnceType == 2) ? 'checked="checked"' : ''; ?>>
                                        <?php _e('registered useres only', 'AtozSites-Pro-Quiz'); ?>
                                    </label>
                                    <label>
                                        <input name="quizRunOnceType" type="radio"
                                               value="3" <?php echo ($quizRunOnceType == 3) ? 'checked="checked"' : ''; ?>>
                                        <?php _e('anonymous users only', 'AtozSites-Pro-Quiz'); ?>
                                    </label>

                                    <div id="wpProQuiz_quiz_run_once_cookie" style="margin-top: 10px;">
                                        <label>
                                            <input type="checkbox" value="1"
                                                   name="quizRunOnceCookie" <?php echo $this->quiz->isQuizRunOnceCookie() ? 'checked="checked"' : '' ?>>
                                            <?php _e('user identification by cookie', 'AtozSites-Pro-Quiz'); ?>
                                        </label>

                                        <p class="description">
                                            <?php _e('If you activate this option, a cookie is set additionally for unregistrated (anonymous) users. This ensures a longer assignment of the user than the simple assignment by the IP address.',
                                                'AtozSites-Pro-Quiz'); ?>
                                        </p>
                                    </div>

                                    <div style="margin-top: 15px;">
                                        <input class="button-secondary" type="button" name="resetQuizLock"
                                               value="<?php _e('Reset the user identification',
                                                   'AtozSites-Pro-Quiz'); ?>">
                                        <span id="resetLockMsg"
                                              style="display:none; background-color: rgb(255, 255, 173); border: 1px solid rgb(143, 143, 143); padding: 4px; margin-left: 5px; "><?php _e('User identification has been reset.'); ?></span>

                                        <p class="description">
                                            <?php _e('Resets user identification for all users.',
                                                'AtozSites-Pro-Quiz'); ?>
                                        </p>
                                    </div>
                                </div>
                            </fieldset>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php _e('Show only specific number of questions', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text">
                                                <span><?php _e('Show only specific number of questions',
                                                        'AtozSites-Pro-Quiz'); ?></span>
                                </legend>
                                <label>
                                    <input type="checkbox" value="1"
                                           name="showMaxQuestion" <?php echo $this->quiz->isShowMaxQuestion() ? 'checked="checked"' : '' ?>>
                                    <?php _e('Activate', 'AtozSites-Pro-Quiz'); ?>
                                </label>

                                <p class="description">
                                    <?php _e('If you enable this option, maximum number of displayed questions will be X from X questions. (The output of questions is random)',
                                        'AtozSites-Pro-Quiz'); ?>
                                </p>

                                <div id="wpProQuiz_showMaxBox" style="display: none;">
                                    <label>
                                        <?php _e('How many questions should be displayed simultaneously:',
                                            'AtozSites-Pro-Quiz'); ?>
                                        <input class="small-text" type="text" name="showMaxQuestionValue"
                                               value="<?php echo $this->quiz->getShowMaxQuestionValue(); ?>">
                                    </label>
                                    <label>
                                        <input type="checkbox" value="1"
                                               name="showMaxQuestionPercent" <?php echo $this->quiz->isShowMaxQuestionPercent() ? 'checked="checked"' : '' ?>>
                                        <?php _e('in percent', 'AtozSites-Pro-Quiz'); ?>
                                    </label>
                                </div>
                            </fieldset>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php _e('Prerequisites', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text">
                                    <span><?php _e('Prerequisites', 'AtozSites-Pro-Quiz'); ?></span>
                                </legend>
                                <label>
                                    <input type="checkbox" value="1"
                                           name="prerequisite" <?php $this->checked($this->quiz->isPrerequisite()); ?>>
                                    <?php _e('Activate', 'AtozSites-Pro-Quiz'); ?>
                                </label>

                                <p class="description">
                                    <?php _e('If you enable this option, you can choose quiz, which user have to finish before he can start this quiz.',
                                        'AtozSites-Pro-Quiz'); ?>
                                </p>

                                <p class="description">
                                    <?php _e('In all selected quizzes statistic function have to be active. If it is not it will be activated automatically.',
                                        'AtozSites-Pro-Quiz'); ?>
                                </p>

                                <div id="prerequisiteBox" style="display: none;">
                                    <table>
                                        <tr>
                                            <th style="width: 120px; padding: 0;"><?php _e('Quiz',
                                                    'AtozSites-Pro-Quiz'); ?></th>
                                            <th style="padding: 0; width: 50px;"></th>
                                            <th style="padding: 0; width: 400px;"><?php _e('Prerequisites (This quiz have to be finished)',
                                                    'AtozSites-Pro-Quiz'); ?></th>
                                        </tr>
                                        <tr>
                                            <td style="padding: 0;">
                                                <select multiple="multiple" size="8" style="width: 200px;"
                                                        name="quizList">
                                                    <?php foreach ($this->quizList as $list) {
                                                        if (in_array($list['id'],
                                                            $this->prerequisiteQuizList)) {
                                                            continue;
                                                        }

                                                        echo '<option value="' . $list['id'] . '">' . $list['name'] . '</option>';
                                                    } ?>
                                                </select>
                                            </td>
                                            <td style="padding: 0; text-align: center;">
                                                <div>
                                                    <input type="button" id="btnPrerequisiteAdd"
                                                           value="&gt;&gt;">
                                                </div>
                                                <div>
                                                    <input type="button" id="btnPrerequisiteDelete"
                                                           value="&lt;&lt;">
                                                </div>
                                            </td>
                                            <td style="padding: 0;">
                                                <select multiple="multiple" size="8" style="width: 200px"
                                                        name="prerequisiteList[]">
                                                    <?php foreach ($this->quizList as $list) {
                                                        if (!in_array($list['id'],
                                                            $this->prerequisiteQuizList)
                                                        ) {
                                                            continue;
                                                        }

                                                        echo '<option value="' . $list['id'] . '">' . $list['name'] . '</option>';
                                                    } ?>
                                                </select>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </fieldset>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php _e('Question overview', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text">
                                    <span><?php _e('Question overview', 'AtozSites-Pro-Quiz'); ?></span>
                                </legend>
                                <label>
                                    <input type="checkbox" value="1"
                                           name="showReviewQuestion" <?php $this->checked($this->quiz->isShowReviewQuestion()); ?>>
                                    <?php _e('Activate', 'AtozSites-Pro-Quiz'); ?>
                                </label>

                                <p class="description">
                                    <?php _e('Add at the top of the quiz a question overview, which allows easy navigation. Additional questions can be marked "to review".',
                                        'AtozSites-Pro-Quiz'); ?>
                                </p>

                                <p class="description">
                                    <?php _e('Additional quiz overview will be displayed, before quiz is finished.',
                                        'AtozSites-Pro-Quiz'); ?>
                                </p>

                                <div class="wpProQuiz_demoBox">
                                    <?php _e('Question overview', 'AtozSites-Pro-Quiz'); ?>: <a
                                            href="#"><?php _e('Demo', 'AtozSites-Pro-Quiz'); ?></a>

                                    <div>
                                        <img alt=""
                                             src="<?php echo WPPROQUIZ_URL . '/img/questionOverview.png'; ?> ">
                                    </div>
                                </div>
                                <div class="wpProQuiz_demoBox">
                                    <?php _e('Quiz-summary', 'AtozSites-Pro-Quiz'); ?>: <a
                                            href="#"><?php _e('Demo', 'AtozSites-Pro-Quiz'); ?></a>

                                    <div>
                                        <img alt=""
                                             src="<?php echo WPPROQUIZ_URL . '/img/quizSummary.png'; ?> ">
                                    </div>
                                </div>
                            </fieldset>
                        </td>
                    </tr>
                    <tr class="wpProQuiz_reviewQuestionOptions" style="display: none;">
                        <th scope="row">
                            <?php _e('Quiz-summary', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text">
                                    <span><?php _e('Quiz-summary', 'AtozSites-Pro-Quiz'); ?></span>
                                </legend>
                                <label>
                                    <input type="checkbox" value="1"
                                           name="quizSummaryHide" <?php $this->checked($this->quiz->isQuizSummaryHide()); ?>>
                                    <?php _e('Deactivate', 'AtozSites-Pro-Quiz'); ?>
                                </label>

                                <p class="description">
                                    <?php _e('If you enalbe this option, no quiz overview will be displayed, before finishing quiz.',
                                        'AtozSites-Pro-Quiz'); ?>
                                </p>
                            </fieldset>
                        </td>
                    </tr>
                    <tr class="wpProQuiz_reviewQuestionOptions" style="display: none;">
                        <th scope="row">
                            <?php _e('Skip question', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text">
                                    <span><?php _e('Skip question', 'AtozSites-Pro-Quiz'); ?></span>
                                </legend>
                                <label>
                                    <input type="checkbox" value="1"
                                           name="skipQuestionDisabled" <?php $this->checked($this->quiz->isSkipQuestionDisabled()); ?>>
                                    <?php _e('Deactivate', 'AtozSites-Pro-Quiz'); ?>
                                </label>

                                <p class="description">
                                    <?php _e('If you enable this option, user won\'t be able to skip question. (only in "Overview -> next" mode). User still will be able to navigate over "Question-Overview"',
                                        'AtozSites-Pro-Quiz'); ?>
                                </p>
                            </fieldset>
                        </td>
                    </tr>
                    <!--
							<tr>
								<th scope="row">
									<?php _e('Admin e-mail notification', 'AtozSites-Pro-Quiz'); ?>
								</th>
								<td>
									<fieldset>
										<legend class="screen-reader-text">
											<span><?php _e('Admin e-mail notification', 'AtozSites-Pro-Quiz'); ?></span>
										</legend>
										<label>
											<input type="radio" name="emailNotification" value="<?php echo WpProQuiz_Model_Quiz::QUIZ_EMAIL_NOTE_NONE; ?>" <?php $this->checked($this->quiz->getEmailNotification(),
                        WpProQuiz_Model_Quiz::QUIZ_EMAIL_NOTE_NONE); ?>>
											<?php _e('Deactivate', 'AtozSites-Pro-Quiz'); ?>
										</label>
										<label>
											<input type="radio" name="emailNotification" value="<?php echo WpProQuiz_Model_Quiz::QUIZ_EMAIL_NOTE_REG_USER; ?>" <?php $this->checked($this->quiz->getEmailNotification(),
                        WpProQuiz_Model_Quiz::QUIZ_EMAIL_NOTE_REG_USER); ?>>
											<?php _e('for registered users only', 'AtozSites-Pro-Quiz'); ?>
										</label>
										<label>
											<input type="radio" name="emailNotification" value="<?php echo WpProQuiz_Model_Quiz::QUIZ_EMAIL_NOTE_ALL; ?>" <?php $this->checked($this->quiz->getEmailNotification(),
                        WpProQuiz_Model_Quiz::QUIZ_EMAIL_NOTE_ALL); ?>>
											<?php _e('for all users', 'AtozSites-Pro-Quiz'); ?>
										</label>
										<p class="description">
											<?php _e('If you enable this option, you will be informed if a user completes this quiz.',
                        'AtozSites-Pro-Quiz'); ?>
										</p>
										<p class="description">
											<?php _e('E-Mail settings can be edited in global settings.',
                        'AtozSites-Pro-Quiz'); ?>
										</p>
									</fieldset>
								</td>
							</tr>

							<tr>
								<th scope="row">
									<?php _e('User e-mail notification', 'AtozSites-Pro-Quiz'); ?>
								</th>
								<td>
									<fieldset>
										<legend class="screen-reader-text">
											<span><?php _e('User e-mail notification', 'AtozSites-Pro-Quiz'); ?></span>
										</legend>
										<label>
											<input type="checkbox" name="userEmailNotification" value="1" <?php $this->checked($this->quiz->isUserEmailNotification()); ?>>
											<?php _e('Activate', 'AtozSites-Pro-Quiz'); ?>
										</label>
										<p class="description">
											<?php _e('If you enable this option, an email is sent with his quiz result to the user. (only registered users)',
                        'AtozSites-Pro-Quiz'); ?>
										</p>
										<p class="description">
											<?php _e('E-Mail settings can be edited in global settings.',
                        'AtozSites-Pro-Quiz'); ?>
										</p>
									</fieldset>
								</td>
							</tr>
							 -->
                    <tr>
                        <th scope="row">
                            <?php _e('Autostart', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text">
                                    <span><?php _e('Autostart', 'AtozSites-Pro-Quiz'); ?></span>
                                </legend>
                                <label>
                                    <input type="checkbox" name="autostart"
                                           value="1" <?php $this->checked($this->quiz->isAutostart()); ?>>
                                    <?php _e('Activate', 'AtozSites-Pro-Quiz'); ?>
                                </label>

                                <p class="description">
                                    <?php _e('If you enable this option, the quiz will start automatically after the page is loaded.',
                                        'AtozSites-Pro-Quiz'); ?>
                                </p>
                            </fieldset>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php _e('Only registered users are allowed to start the quiz',
                                'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text">
                                                <span><?php _e('Only registered users are allowed to start the quiz',
                                                        'AtozSites-Pro-Quiz'); ?></span>
                                </legend>
                                <label>
                                    <input type="checkbox" name="startOnlyRegisteredUser"
                                           value="1" <?php $this->checked($this->quiz->isStartOnlyRegisteredUser()); ?>>
                                    <?php _e('Activate', 'AtozSites-Pro-Quiz'); ?>
                                </label>

                                <p class="description">
                                    <?php _e('If you enable this option, only registered users allowed start the quiz.',
                                        'AtozSites-Pro-Quiz'); ?>
                                </p>
                            </fieldset>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
    }

    private function postBoxResult()
    {
        ?>
        <div class="postbox">
            <h3 class="hndle"><?php _e('Results text', 'AtozSites-Pro-Quiz'); ?><?php _e('(optional)',
                    'AtozSites-Pro-Quiz'); ?></h3>

            <div class="inside">
                <p class="description">
                    <?php _e('This text will be displayed at the end of the quiz (in results). (this text is optional)',
                        'AtozSites-Pro-Quiz'); ?>
                </p>

                <div style="padding-top: 10px; padding-bottom: 10px;">
                    <label for="wpProQuiz_resultGradeEnabled">
                        <?php _e('Activate graduation', 'AtozSites-Pro-Quiz'); ?>
                        <input type="checkbox" name="resultGradeEnabled" id="wpProQuiz_resultGradeEnabled"
                               value="1" <?php echo $this->quiz->isResultGradeEnabled() ? 'checked="checked"' : ''; ?>>
                    </label>
                </div>
                <div style="display: none;" id="resultGrade">
                    <div>
                        <strong><?php _e('Hint:', 'AtozSites-Pro-Quiz'); ?></strong>
                        <ul style="list-style-type: square; padding: 5px; margin-left: 20px; margin-top: 0;">
                            <li><?php _e('Maximal 15 levels', 'AtozSites-Pro-Quiz'); ?></li>
                            <li>
                                <?php printf(__('Percentages refer to the total score of the quiz. (Current total %d points in %d questions.',
                                    'AtozSites-Pro-Quiz'),
                                    $this->quiz->fetchSumQuestionPoints(),
                                    $this->quiz->fetchCountQuestions()); ?>
                            </li>
                            <li><?php _e('Values can also be mixed up', 'AtozSites-Pro-Quiz'); ?></li>
                            <li><?php _e('10,15% or 10.15% allowed (max. two digits after the decimal point)',
                                    'AtozSites-Pro-Quiz'); ?></li>
                        </ul>

                    </div>
                    <div>
                        <ul id="resultList">
                            <?php
                            $resultText = $this->quiz->getResultText();

                            for ($i = 0; $i < 15; $i++) {

                                if ($this->quiz->isResultGradeEnabled() && isset($resultText['text'][$i])) {
                                    ?>
                                    <li style="padding: 5px; border: 1px dotted;">
                                        <div
                                                style="margin-bottom: 5px;"><?php wp_editor($resultText['text'][$i],
                                                'resultText_' . $i, array(
                                                    'textarea_rows' => 3,
                                                    'textarea_name' => 'resultTextGrade[text][]'
                                                )); ?></div>
                                        <div
                                                style="margin-bottom: 5px;background-color: rgb(207, 207, 207);padding: 10px;">
                                            <?php _e('from:', 'AtozSites-Pro-Quiz'); ?> <input type="text"
                                                                                        name="resultTextGrade[prozent][]"
                                                                                        class="small-text"
                                                                                        value="<?php echo $resultText['prozent'][$i] ?>"> <?php _e('percent',
                                                'AtozSites-Pro-Quiz'); ?> <?php printf(__('(Will be displayed, when result-percent is >= <span class="resultProzent">%s</span>%%)',
                                                'AtozSites-Pro-Quiz'), $resultText['prozent'][$i]); ?>
                                            <input type="button" style="float: right;"
                                                   class="button-primary deleteResult"
                                                   value="<?php _e('Delete graduation', 'AtozSites-Pro-Quiz'); ?>">

                                            <div style="clear: right;"></div>
                                            <input type="hidden" value="1" name="resultTextGrade[activ][]">
                                        </div>
                                    </li>

                                <?php } else { ?>
                                    <li style="padding: 5px; border: 1px dotted; <?php echo $i ? 'display:none;' : '' ?>">
                                        <div style="margin-bottom: 5px;"><?php wp_editor('',
                                                'resultText_' . $i, array(
                                                    'textarea_rows' => 3,
                                                    'textarea_name' => 'resultTextGrade[text][]'
                                                )); ?></div>
                                        <div
                                                style="margin-bottom: 5px;background-color: rgb(207, 207, 207);padding: 10px;">
                                            <?php _e('from:', 'AtozSites-Pro-Quiz'); ?> <input type="text"
                                                                                        name="resultTextGrade[prozent][]"
                                                                                        class="small-text"
                                                                                        value="0"> <?php _e('percent',
                                                'AtozSites-Pro-Quiz'); ?> <?php printf(__('(Will be displayed, when result-percent is >= <span class="resultProzent">%s</span>%%)',
                                                'AtozSites-Pro-Quiz'), '0'); ?>
                                            <input type="button" style="float: right;"
                                                   class="button-primary deleteResult"
                                                   value="<?php _e('Delete graduation', 'AtozSites-Pro-Quiz'); ?>">

                                            <div style="clear: right;"></div>
                                            <input type="hidden" value="<?php echo $i ? '0' : '1' ?>"
                                                   name="resultTextGrade[activ][]">
                                        </div>
                                    </li>
                                <?php }
                            } ?>
                        </ul>
                        <input type="button" class="button-primary addResult"
                               value="<?php _e('Add graduation', 'AtozSites-Pro-Quiz'); ?>">
                    </div>
                </div>
                <div id="resultNormal">
                    <?php

                    $resultText = is_array($resultText) ? '' : $resultText;
                    wp_editor($resultText, 'resultText', array('textarea_rows' => 10));
                    ?>
                </div>

                <h4><?php _e('Custom fields - Variables', 'AtozSites-Pro-Quiz'); ?></h4>
                <ul class="formVariables"></ul>

            </div>
        </div>
        <?php
    }

    private function postBoxTitle()
    {
        ?>
        <div class="postbox">
            <h3 class="hndle"><?php _e('Quiz title', 'AtozSites-Pro-Quiz'); ?><?php _e('(required)',
                    'AtozSites-Pro-Quiz'); ?></h3>

            <div class="inside">
                <input name="name" id="wpProQuiz_title" type="text" class="regular-text"
                       value="<?php echo htmlspecialchars($this->quiz->getName(), ENT_QUOTES); ?>">
            </div>
        </div>
        <?php
    }

    private function postBoxCategory()
    {
        ?>
        <div class="postbox">
            <h3 class="hndle"><?php _e('Category', 'AtozSites-Pro-Quiz'); ?><?php _e('(optional)',
                    'AtozSites-Pro-Quiz'); ?></h3>

            <div class="inside">
                <p class="description">
                    <?php _e('You can assign classify category for a quiz.', 'AtozSites-Pro-Quiz'); ?>
                </p>

                <p class="description">
                    <?php _e('You can manage categories in global settings.', 'AtozSites-Pro-Quiz'); ?>
                </p>

                <div>
                    <select name="category">
                        <option value="-1">--- <?php _e('Create new category', 'AtozSites-Pro-Quiz'); ?>----
                        </option>
                        <option
                                value="0" <?php echo $this->quiz->getCategoryId() == 0 ? 'selected="selected"' : ''; ?>>
                            --- <?php _e('No category', 'AtozSites-Pro-Quiz'); ?> ---
                        </option>
                        <?php
                        foreach ($this->categories as $cat) {
                            echo '<option ' . ($this->quiz->getCategoryId() == $cat->getCategoryId() ? 'selected="selected"' : '') . ' value="' . $cat->getCategoryId() . '">' . $cat->getCategoryName() . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div style="display: none;" id="categoryAddBox">
                    <h4><?php _e('Create new category', 'AtozSites-Pro-Quiz'); ?></h4>
                    <input type="text" name="categoryAdd" value="">
                    <input type="button" class="button-secondary" name="" id="categoryAddBtn"
                           value="<?php _e('Create', 'AtozSites-Pro-Quiz'); ?>">
                </div>
                <div id="categoryMsgBox"
                     style="display:none; padding: 5px; border: 1px solid rgb(160, 160, 160); background-color: rgb(255, 255, 168); font-weight: bold; margin: 5px; ">
                    Kategorie gespeichert
                </div>
            </div>
        </div>
        <?php
    }

    private function postBoxQuizDescription()
    {
        ?>
        <div class="postbox">
            <h3 class="hndle"><?php _e('Quiz description', 'AtozSites-Pro-Quiz'); ?><?php _e('(required)',
                    'AtozSites-Pro-Quiz'); ?></h3>

            <div class="inside">
                <p class="description">
                    <?php _e('This text will be displayed before start of the quiz.', 'AtozSites-Pro-Quiz'); ?>
                </p>
                <?php
                wp_editor($this->quiz->getText(), "text");
                ?>
            </div>
        </div>
        <?php
    }

    private function postBoxResultOptions()
    {
        ?>
        <div class="postbox">
            <h3 class="hndle"><?php _e('Result-Options', 'AtozSites-Pro-Quiz'); ?></h3>

            <div class="inside">
                <table class="form-table">
                    <tbody>
                    <tr>
                        <th scope="row">
                            <?php _e('Show average points', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text">
                                    <span><?php _e('Show average points', 'AtozSites-Pro-Quiz'); ?></span>
                                </legend>
                                <label>
                                    <input type="checkbox" value="1"
                                           name="showAverageResult" <?php $this->checked($this->quiz->isShowAverageResult()); ?>>
                                    <?php _e('Activate', 'AtozSites-Pro-Quiz'); ?>
                                </label>

                                <p class="description">
                                    <?php _e('Statistics-function must be enabled.', 'AtozSites-Pro-Quiz'); ?>
                                </p>

                                <div class="wpProQuiz_demoBox">
                                    <a href="#"><?php _e('Demo', 'AtozSites-Pro-Quiz'); ?></a>

                                    <div>
                                        <img alt="" src="<?php echo WPPROQUIZ_URL . '/img/averagePoints.png'; ?> ">
                                    </div>
                                </div>
                            </fieldset>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php _e('Show category score', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text">
                                    <span><?php _e('Show category score', 'AtozSites-Pro-Quiz'); ?></span>
                                </legend>
                                <label>
                                    <input type="checkbox" name="showCategoryScore"
                                           value="1" <?php $this->checked($this->quiz->isShowCategoryScore()); ?>>
                                    <?php _e('Activate', 'AtozSites-Pro-Quiz'); ?>
                                </label>

                                <p class="description">
                                    <?php _e('If you enable this option, the results of each category is displayed on the results page.',
                                        'AtozSites-Pro-Quiz'); ?>
                                </p>
                            </fieldset>

                            <div class="wpProQuiz_demoBox">
                                <a href="#"><?php _e('Demo', 'AtozSites-Pro-Quiz'); ?></a>

                                <div>
                                    <img alt="" src="<?php echo WPPROQUIZ_URL . '/img/catOverview.png'; ?> ">
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php _e('Hide correct questions - display', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text">
                                    <span><?php _e('Hide correct questions - display', 'AtozSites-Pro-Quiz'); ?></span>
                                </legend>
                                <label>
                                    <input type="checkbox" name="hideResultCorrectQuestion"
                                           value="1" <?php $this->checked($this->quiz->isHideResultCorrectQuestion()); ?>>
                                    <?php _e('Activate', 'AtozSites-Pro-Quiz'); ?>
                                </label>

                                <p class="description">
                                    <?php _e('If you select this option, no longer the number of correctly answered questions are displayed on the results page.',
                                        'AtozSites-Pro-Quiz'); ?>
                                </p>
                            </fieldset>

                            <div class="wpProQuiz_demoBox">
                                <a href="#"><?php _e('Demo', 'AtozSites-Pro-Quiz'); ?></a>

                                <div>
                                    <img alt="" src="<?php echo WPPROQUIZ_URL . '/img/hideCorrectQuestion.png'; ?> ">
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php _e('Hide quiz time - display', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text">
                                    <span><?php _e('Hide quiz time - display', 'AtozSites-Pro-Quiz'); ?></span>
                                </legend>
                                <label>
                                    <input type="checkbox" name="hideResultQuizTime"
                                           value="1" <?php $this->checked($this->quiz->isHideResultQuizTime()); ?>>
                                    <?php _e('Activate', 'AtozSites-Pro-Quiz'); ?>
                                </label>

                                <p class="description">
                                    <?php _e('If you enable this option, the time for finishing the quiz won\'t be displayed on the results page anymore.',
                                        'AtozSites-Pro-Quiz'); ?>
                                </p>
                            </fieldset>

                            <div class="wpProQuiz_demoBox">
                                <a href="#"><?php _e('Demo', 'AtozSites-Pro-Quiz'); ?></a>

                                <div>
                                    <img alt="" src="<?php echo WPPROQUIZ_URL . '/img/hideQuizTime.png'; ?> ">
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php _e('Hide score - display', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text">
                                    <span><?php _e('Hide score - display', 'AtozSites-Pro-Quiz'); ?></span>
                                </legend>
                                <label>
                                    <input type="checkbox" name="hideResultPoints"
                                           value="1" <?php $this->checked($this->quiz->isHideResultPoints()); ?>>
                                    <?php _e('Activate', 'AtozSites-Pro-Quiz'); ?>
                                </label>

                                <p class="description">
                                    <?php _e('If you enable this option, final score won\'t be displayed on the results page anymore.',
                                        'AtozSites-Pro-Quiz'); ?>
                                </p>
                            </fieldset>

                            <div class="wpProQuiz_demoBox">
                                <a href="#"><?php _e('Demo', 'AtozSites-Pro-Quiz'); ?></a>

                                <div>
                                    <img alt="" src="<?php echo WPPROQUIZ_URL . '/img/hideQuizPoints.png'; ?> ">
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <?php
    }

    private function postBoxQuestionOptions()
    {
        ?>

        <div class="postbox">
            <h3 class="hndle"><?php _e('Question-Options', 'AtozSites-Pro-Quiz'); ?></h3>

            <div class="inside">
                <table class="form-table">
                    <tbody>
                    <tr>
                        <th scope="row">
                            <?php _e('Show points', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text">
                                    <span><?php _e('Show points', 'AtozSites-Pro-Quiz'); ?></span>
                                </legend>
                                <label for="show_points">
                                    <input type="checkbox" id="show_points" value="1"
                                           name="showPoints" <?php echo $this->quiz->isShowPoints() ? 'checked="checked"' : '' ?> >
                                    <?php _e('Activate', 'AtozSites-Pro-Quiz'); ?>
                                </label>

                                <p class="description">
                                    <?php _e('Shows in quiz, how many points are reachable for respective question.',
                                        'AtozSites-Pro-Quiz'); ?>
                                </p>
                            </fieldset>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php _e('Number answers', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text">
                                    <span><?php _e('Number answers', 'AtozSites-Pro-Quiz'); ?></span>
                                </legend>
                                <label>
                                    <input type="checkbox" value="1"
                                           name="numberedAnswer" <?php echo $this->quiz->isNumberedAnswer() ? 'checked="checked"' : '' ?>>
                                    <?php _e('Activate', 'AtozSites-Pro-Quiz'); ?>
                                </label>

                                <p class="description">
                                    <?php _e('If this option is activated, all answers are numbered (only single and multiple choice)',
                                        'AtozSites-Pro-Quiz'); ?>
                                </p>

                                <div class="wpProQuiz_demoBox">
                                    <a href="#"><?php _e('Demo', 'AtozSites-Pro-Quiz'); ?></a>

                                    <div>
                                        <img alt="" src="<?php echo WPPROQUIZ_URL . '/img/numbering.png'; ?> ">
                                    </div>
                                </div>
                            </fieldset>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php _e('Hide correct- and incorrect message', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text">
                                    <span><?php _e('Hide correct- and incorrect message', 'AtozSites-Pro-Quiz'); ?></span>
                                </legend>
                                <label>
                                    <input type="checkbox" value="1"
                                           name="hideAnswerMessageBox" <?php echo $this->quiz->isHideAnswerMessageBox() ? 'checked="checked"' : '' ?>>
                                    <?php _e('Activate', 'AtozSites-Pro-Quiz'); ?>
                                </label>

                                <p class="description">
                                    <?php _e('If you enable this option, no correct- or incorrect message will be displayed.',
                                        'AtozSites-Pro-Quiz'); ?>
                                </p>

                                <div class="wpProQuiz_demoBox">
                                    <a href="#"><?php _e('Demo', 'AtozSites-Pro-Quiz'); ?></a>

                                    <div>
                                        <img alt=""
                                             src="<?php echo WPPROQUIZ_URL . '/img/hideAnswerMessageBox.png'; ?> ">
                                    </div>
                                </div>
                            </fieldset>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php _e('Correct and incorrect answer mark', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text">
                                    <span><?php _e('Correct and incorrect answer mark', 'AtozSites-Pro-Quiz'); ?></span>
                                </legend>
                                <label>
                                    <input type="checkbox" value="1"
                                           name="disabledAnswerMark" <?php echo $this->quiz->isDisabledAnswerMark() ? 'checked="checked"' : '' ?>>
                                    <?php _e('Deactivate', 'AtozSites-Pro-Quiz'); ?>
                                </label>

                                <p class="description">
                                    <?php _e('If you enable this option, answers won\'t be color highlighted as correct or incorrect. ',
                                        'AtozSites-Pro-Quiz'); ?>
                                </p>

                                <div class="wpProQuiz_demoBox">
                                    <a href="#"><?php _e('Demo', 'AtozSites-Pro-Quiz'); ?></a>

                                    <div>
                                        <img alt="" src="<?php echo WPPROQUIZ_URL . '/img/mark.png'; ?> ">
                                    </div>
                                </div>
                            </fieldset>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php _e('Force user to answer each question', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text">
                                    <span><?php _e('Force user to answer each question', 'AtozSites-Pro-Quiz'); ?></span>
                                </legend>
                                <label>
                                    <input type="checkbox" value="1"
                                           name="forcingQuestionSolve" <?php $this->checked($this->quiz->isForcingQuestionSolve()); ?>>
                                    <?php _e('Activate', 'AtozSites-Pro-Quiz'); ?>
                                </label>

                                <p class="description">
                                    <?php _e('If you enable this option, the user is forced to answer each question.',
                                        'AtozSites-Pro-Quiz'); ?> <br>
                                    <?php _e('If the option "Question overview" is activated, this notification will appear after end of the quiz, otherwise after each question.',
                                        'AtozSites-Pro-Quiz'); ?>
                                </p>
                            </fieldset>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php _e('Hide question position overview', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text">
                                    <span><?php _e('Hide question position overview', 'AtozSites-Pro-Quiz'); ?></span>
                                </legend>
                                <label>
                                    <input type="checkbox" value="1"
                                           name="hideQuestionPositionOverview" <?php $this->checked($this->quiz->isHideQuestionPositionOverview()); ?>>
                                    <?php _e('Activate', 'AtozSites-Pro-Quiz'); ?>
                                </label>

                                <p class="description">
                                    <?php _e('If you enable this option, the question position overview is hidden.',
                                        'AtozSites-Pro-Quiz'); ?>
                                </p>

                                <div class="wpProQuiz_demoBox">
                                    <a href="#"><?php _e('Demo', 'AtozSites-Pro-Quiz'); ?></a>

                                    <div>
                                        <img alt=""
                                             src="<?php echo WPPROQUIZ_URL . '/img/hideQuestionPositionOverview.png'; ?> ">
                                    </div>
                                </div>
                            </fieldset>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php _e('Hide question numbering', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text">
                                    <span><?php _e('Hide question numbering', 'AtozSites-Pro-Quiz'); ?></span>
                                </legend>
                                <label>
                                    <input type="checkbox" value="1"
                                           name="hideQuestionNumbering" <?php $this->checked($this->quiz->isHideQuestionNumbering()); ?>>
                                    <?php _e('Activate', 'AtozSites-Pro-Quiz'); ?>
                                </label>

                                <p class="description">
                                    <?php _e('If you enable this option, the question numbering is hidden.',
                                        'AtozSites-Pro-Quiz'); ?>
                                </p>

                                <div class="wpProQuiz_demoBox">
                                    <a href="#"><?php _e('Demo', 'AtozSites-Pro-Quiz'); ?></a>

                                    <div>
                                        <img alt=""
                                             src="<?php echo WPPROQUIZ_URL . '/img/hideQuestionNumbering.png'; ?> ">
                                    </div>
                                </div>
                            </fieldset>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php _e('Display category', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text">
                                    <span><?php _e('Display category', 'AtozSites-Pro-Quiz'); ?></span>
                                </legend>
                                <label>
                                    <input type="checkbox" value="1"
                                           name="showCategory" <?php $this->checked($this->quiz->isShowCategory()); ?>>
                                    <?php _e('Activate', 'AtozSites-Pro-Quiz'); ?>
                                </label>

                                <p class="description">
                                    <?php _e('If you enable this option, category will be displayed in the question.',
                                        'AtozSites-Pro-Quiz'); ?>
                                </p>

                                <div class="wpProQuiz_demoBox">
                                    <a href="#"><?php _e('Demo', 'AtozSites-Pro-Quiz'); ?></a>

                                    <div>
                                        <img alt="" src="<?php echo WPPROQUIZ_URL . '/img/showCategory.png'; ?> ">
                                    </div>
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

    private function postBoxLeaderboardOptions()
    {
        ?>
        <div class="postbox">
            <h3 class="hndle"><?php _e('Leaderboard', 'AtozSites-Pro-Quiz'); ?><?php _e('(optional)', 'AtozSites-Pro-Quiz'); ?></h3>

            <div class="inside">
                <p>
                    <?php _e('The leaderboard allows users to enter results in public list and to share the result this way.',
                        'AtozSites-Pro-Quiz'); ?>
                </p>

                <p>
                    <?php _e('The leaderboard works independent from internal statistics function.', 'AtozSites-Pro-Quiz'); ?>
                </p>
                <table class="form-table">
                    <tbody id="toplistBox">
                    <tr>
                        <th scope="row">
                            <?php _e('Leaderboard', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <label>
                                <input type="checkbox" name="toplistActivated"
                                       value="1" <?php echo $this->quiz->isToplistActivated() ? 'checked="checked"' : ''; ?>>
                                <?php _e('Activate', 'AtozSites-Pro-Quiz'); ?>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php _e('Who can sign up to the list', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <label>
                                <input name="toplistDataAddPermissions" type="radio"
                                       value="1" <?php echo $this->quiz->getToplistDataAddPermissions() == 1 ? 'checked="checked"' : ''; ?>>
                                <?php _e('all users', 'AtozSites-Pro-Quiz'); ?>
                            </label>
                            <label>
                                <input name="toplistDataAddPermissions" type="radio"
                                       value="2" <?php echo $this->quiz->getToplistDataAddPermissions() == 2 ? 'checked="checked"' : ''; ?>>
                                <?php _e('registered useres only', 'AtozSites-Pro-Quiz'); ?>
                            </label>
                            <label>
                                <input name="toplistDataAddPermissions" type="radio"
                                       value="3" <?php echo $this->quiz->getToplistDataAddPermissions() == 3 ? 'checked="checked"' : ''; ?>>
                                <?php _e('anonymous users only', 'AtozSites-Pro-Quiz'); ?>
                            </label>

                            <p class="description">
                                <?php _e('Not registered users have to enter name and e-mail (e-mail won\'t be displayed)',
                                    'AtozSites-Pro-Quiz'); ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php _e('insert automatically', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <label>
                                <input name="toplistDataAddAutomatic" type="checkbox"
                                       value="1" <?php $this->checked($this->quiz->isToplistDataAddAutomatic()); ?>>
                                <?php _e('Activate', 'AtozSites-Pro-Quiz'); ?>
                            </label>

                            <p class="description">
                                <?php _e('If you enable this option, logged in users will be automatically entered into leaderboard',
                                    'AtozSites-Pro-Quiz'); ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php _e('display captcha', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <label>
                                <input type="checkbox" name="toplistDataCaptcha"
                                       value="1" <?php echo $this->quiz->isToplistDataCaptcha() ? 'checked="checked"' : ''; ?> <?php echo $this->captchaIsInstalled ? '' : 'disabled="disabled"'; ?>>
                                <?php _e('Activate', 'AtozSites-Pro-Quiz'); ?>
                            </label>

                            <p class="description">
                                <?php _e('If you enable this option, additional captcha will be displayed for users who are not registered.',
                                    'AtozSites-Pro-Quiz'); ?>
                            </p>

                            <p class="description" style="color: red;">
                                <?php _e('This option requires additional plugin:', 'AtozSites-Pro-Quiz'); ?>
                                <a href="http://wordpress.org/extend/plugins/really-simple-captcha/" target="_blank">Really
                                    Simple CAPTCHA</a>
                            </p>
                            <?php if ($this->captchaIsInstalled) { ?>
                                <p class="description" style="color: green;">
                                    <?php _e('Plugin has been detected.', 'AtozSites-Pro-Quiz'); ?>
                                </p>
                            <?php } else { ?>
                                <p class="description" style="color: red;">
                                    <?php _e('Plugin is not installed.', 'AtozSites-Pro-Quiz'); ?>
                                </p>
                            <?php } ?>

                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php _e('Sort list by', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <label>
                                <input name="toplistDataSort" type="radio"
                                       value="1" <?php echo ($this->quiz->getToplistDataSort() == 1) ? 'checked="checked"' : ''; ?>>
                                <?php _e('best user', 'AtozSites-Pro-Quiz'); ?>
                            </label>
                            <label>
                                <input name="toplistDataSort" type="radio"
                                       value="2" <?php echo ($this->quiz->getToplistDataSort() == 2) ? 'checked="checked"' : ''; ?>>
                                <?php _e('newest entry', 'AtozSites-Pro-Quiz'); ?>
                            </label>
                            <label>
                                <input name="toplistDataSort" type="radio"
                                       value="3" <?php echo ($this->quiz->getToplistDataSort() == 3) ? 'checked="checked"' : ''; ?>>
                                <?php _e('oldest entry', 'AtozSites-Pro-Quiz'); ?>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php _e('Users can apply multiple times', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <div>
                                <label>
                                    <input type="checkbox" name="toplistDataAddMultiple"
                                           value="1" <?php echo $this->quiz->isToplistDataAddMultiple() ? 'checked="checked"' : ''; ?>>
                                    <?php _e('Activate', 'AtozSites-Pro-Quiz'); ?>
                                </label>
                            </div>
                            <div id="toplistDataAddBlockBox" style="display: none;">
                                <label>
                                    <?php _e('User can apply after:', 'AtozSites-Pro-Quiz'); ?>
                                    <input type="number" min="0" class="small-text" name="toplistDataAddBlock"
                                           value="<?php echo $this->quiz->getToplistDataAddBlock(); ?>">
                                    <?php _e('minute', 'AtozSites-Pro-Quiz'); ?>
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php _e('How many entries should be displayed', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <div>
                                <label>
                                    <input type="number" min="0" class="small-text" name="toplistDataShowLimit"
                                           value="<?php echo $this->quiz->getToplistDataShowLimit(); ?>">
                                    <?php _e('Entries', 'AtozSites-Pro-Quiz'); ?>
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php _e('Automatically display leaderboard in quiz result', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <div style="margin-top: 6px;">
                                <?php _e('Where should leaderboard be displayed:', 'AtozSites-Pro-Quiz'); ?>
                                <label style="margin-right: 5px; margin-left: 5px;">
                                    <input type="radio" name="toplistDataShowIn"
                                           value="0" <?php echo ($this->quiz->getToplistDataShowIn() == 0) ? 'checked="checked"' : ''; ?>>
                                    <?php _e('don\'t display', 'AtozSites-Pro-Quiz'); ?>
                                </label>
                                <label>
                                    <input type="radio" name="toplistDataShowIn"
                                           value="1" <?php echo ($this->quiz->getToplistDataShowIn() == 1) ? 'checked="checked"' : ''; ?>>
                                    <?php _e('below the "result text"', 'AtozSites-Pro-Quiz'); ?>
                                </label>
									<span class="wpProQuiz_demoBox" style="margin-right: 5px;">
										<a href="#"><?php _e('Demo', 'AtozSites-Pro-Quiz'); ?></a>
										<span>
											<img alt=""
                                                 src="<?php echo WPPROQUIZ_URL . '/img/leaderboardInResultText.png'; ?> ">
										</span>
									</span>
                                <label>
                                    <input type="radio" name="toplistDataShowIn"
                                           value="2" <?php echo ($this->quiz->getToplistDataShowIn() == 2) ? 'checked="checked"' : ''; ?>>
                                    <?php _e('in a button', 'AtozSites-Pro-Quiz'); ?>
                                </label>
									<span class="wpProQuiz_demoBox">
										<a href="#"><?php _e('Demo', 'AtozSites-Pro-Quiz'); ?></a>
										<span>
											<img alt=""
                                                 src="<?php echo WPPROQUIZ_URL . '/img/leaderboardInButton.png'; ?> ">
										</span>
									</span>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
    }

    private function postBoxQuizMode()
    {
        ?>
        <div class="postbox">
            <h3 class="hndle"><?php _e('Quiz-Mode', 'AtozSites-Pro-Quiz'); ?><?php _e('(required)', 'AtozSites-Pro-Quiz'); ?></h3>

            <div class="inside">
                <table style="width: 100%; border-collapse: collapse; border: 1px solid #A0A0A0;"
                       class="wpProQuiz_quizModus">
                    <thead>
                    <tr>
                        <th style="width: 25%;"><?php _e('Normal', 'AtozSites-Pro-Quiz'); ?></th>
                        <th style="width: 25%;"><?php _e('Normal + Back-Button', 'AtozSites-Pro-Quiz'); ?></th>
                        <th style="width: 25%;"><?php _e('Check -> continue', 'AtozSites-Pro-Quiz'); ?></th>
                        <th style="width: 25%;"><?php _e('Questions below each other', 'AtozSites-Pro-Quiz'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><label><input type="radio" name="quizModus"
                                          value="0" <?php $this->checked($this->quiz->getQuizModus(),
                                    WpProQuiz_Model_Quiz::QUIZ_MODUS_NORMAL); ?>> <?php _e('Activate',
                                    'AtozSites-Pro-Quiz'); ?></label></td>
                        <td><label><input type="radio" name="quizModus"
                                          value="1" <?php $this->checked($this->quiz->getQuizModus(),
                                    WpProQuiz_Model_Quiz::QUIZ_MODUS_BACK_BUTTON); ?>> <?php _e('Activate',
                                    'AtozSites-Pro-Quiz'); ?></label></td>
                        <td><label><input type="radio" name="quizModus"
                                          value="2" <?php $this->checked($this->quiz->getQuizModus(),
                                    WpProQuiz_Model_Quiz::QUIZ_MODUS_CHECK); ?>> <?php _e('Activate', 'AtozSites-Pro-Quiz'); ?>
                            </label></td>
                        <td><label><input type="radio" name="quizModus"
                                          value="3" <?php $this->checked($this->quiz->getQuizModus(),
                                    WpProQuiz_Model_Quiz::QUIZ_MODUS_SINGLE); ?>> <?php _e('Activate',
                                    'AtozSites-Pro-Quiz'); ?></label></td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e('Displays all questions sequentially, "right" or "false" will be displayed at the end of the quiz.',
                                'AtozSites-Pro-Quiz'); ?>
                        </td>
                        <td>
                            <?php _e('Allows to use the back button in a question.', 'AtozSites-Pro-Quiz'); ?>
                        </td>
                        <td>
                            <?php _e('Shows "right or wrong" after each question.', 'AtozSites-Pro-Quiz'); ?>
                        </td>
                        <td>
                            <?php _e('If this option is activated, all answers are displayed below each other, i.e. all questions are on a single page.',
                                'AtozSites-Pro-Quiz'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="wpProQuiz_demoBox">
                                <a href="#"><?php _e('Demo', 'AtozSites-Pro-Quiz'); ?></a>

                                <div>
                                    <img alt="" src="<?php echo WPPROQUIZ_URL . '/img/normal.png'; ?> ">
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="wpProQuiz_demoBox">
                                <a href="#"><?php _e('Demo', 'AtozSites-Pro-Quiz'); ?></a>

                                <div>
                                    <img alt="" src="<?php echo WPPROQUIZ_URL . '/img/backButton.png'; ?> ">
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="wpProQuiz_demoBox" style="position: relative;">
                                <a href="#"><?php _e('Demo', 'AtozSites-Pro-Quiz'); ?></a>

                                <div>
                                    <img alt="" src="<?php echo WPPROQUIZ_URL . '/img/checkCcontinue.png'; ?> ">
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="wpProQuiz_demoBox" style="position: relative;">
                                <a href="#"><?php _e('Demo', 'AtozSites-Pro-Quiz'); ?></a>

                                <div>
                                    <img alt="" src="<?php echo WPPROQUIZ_URL . '/img/singlePage.png'; ?> ">
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <?php _e('How many questions to be displayed on a page:', 'AtozSites-Pro-Quiz'); ?><br>
                            <input type="number" name="questionsPerPage"
                                   value="<?php echo $this->quiz->getQuestionsPerPage(); ?>" min="0">
									<span class="description">
										<?php _e('(0 = All on one page)', 'AtozSites-Pro-Quiz'); ?>
									</span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
    }

    private function postBoxForms()
    {
        $forms = $this->forms;
        $index = 0;

        if (!is_array($forms) || !count($forms)) {
            $forms = array(new WpProQuiz_Model_Form(), new WpProQuiz_Model_Form());
        } else {
            array_unshift($forms, new WpProQuiz_Model_Form());
        }

        ?>
        <div class="postbox">
            <h3 class="hndle"><?php _e('Custom fields', 'AtozSites-Pro-Quiz'); ?></h3>

            <div class="inside">

                <p class="description">
                    <?php _e('You can create custom fields, e.g. to request the name or the e-mail address of the users.',
                        'AtozSites-Pro-Quiz'); ?>
                </p>

                <p class="description">
                    <?php _e('The statistic function have to be enabled.', 'AtozSites-Pro-Quiz'); ?>
                </p>

                <table class="form-table">
                    <tbody>
                    <tr>
                        <th scope="row">
                            <?php _e('Custom fields enable', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text">
                                    <span><?php _e('Custom fields enable', 'AtozSites-Pro-Quiz'); ?></span>
                                </legend>
                                <label>
                                    <input type="checkbox" id="formActivated" value="1"
                                           name="formActivated" <?php $this->checked($this->quiz->isFormActivated()); ?>>
                                    <?php _e('Activate', 'AtozSites-Pro-Quiz'); ?>
                                </label>

                                <p class="description">
                                    <?php _e('If you enable this option, custom fields are enabled.', 'AtozSites-Pro-Quiz'); ?>
                                </p>
                            </fieldset>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php _e('Display position', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text">
                                    <span><?php _e('Display position', 'AtozSites-Pro-Quiz'); ?></span>
                                </legend>
                                <?php _e('Where should the fileds be displayed:', 'AtozSites-Pro-Quiz'); ?>
                                <label>
                                    <input type="radio"
                                           value="<?php echo WpProQuiz_Model_Quiz::QUIZ_FORM_POSITION_START; ?>"
                                           name="formShowPosition" <?php $this->checked($this->quiz->getFormShowPosition(),
                                        WpProQuiz_Model_Quiz::QUIZ_FORM_POSITION_START); ?>>
                                    <?php _e('On the quiz startpage', 'AtozSites-Pro-Quiz'); ?>

                                    <div style="display: inline-block;" class="wpProQuiz_demoBox">
                                        <a href="#"><?php _e('Demo', 'AtozSites-Pro-Quiz'); ?></a>

                                        <div>
                                            <img alt=""
                                                 src="<?php echo WPPROQUIZ_URL . '/img/customFieldsFront.png'; ?> ">
                                        </div>
                                    </div>

                                </label>
                                <label>
                                    <input type="radio"
                                           value="<?php echo WpProQuiz_Model_Quiz::QUIZ_FORM_POSITION_END; ?>"
                                           name="formShowPosition" <?php $this->checked($this->quiz->getFormShowPosition(),
                                        WpProQuiz_Model_Quiz::QUIZ_FORM_POSITION_END); ?> >
                                    <?php _e('At the end of the quiz (before the quiz result)', 'AtozSites-Pro-Quiz'); ?>

                                    <div style="display: inline-block;" class="wpProQuiz_demoBox">
                                        <a href="#"><?php _e('Demo', 'AtozSites-Pro-Quiz'); ?></a>

                                        <div>
                                            <img alt=""
                                                 src="<?php echo WPPROQUIZ_URL . '/img/customFieldsEnd1.png'; ?> ">
                                        </div>
                                    </div>

                                    <div style="display: inline-block;" class="wpProQuiz_demoBox">
                                        <a href="#"><?php _e('Demo', 'AtozSites-Pro-Quiz'); ?></a>

                                        <div>
                                            <img alt=""
                                                 src="<?php echo WPPROQUIZ_URL . '/img/customFieldsEnd2.png'; ?> ">
                                        </div>
                                    </div>

                                </label>
                            </fieldset>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <div style="margin-top: 10px; padding: 10px; border: 1px solid #C2C2C2;">
                    <table style=" width: 100%; text-align: left; " id="form_table">
                        <thead>
                        <tr>
                            <th>#ID</th>
                            <th><?php _e('Field name', 'AtozSites-Pro-Quiz'); ?></th>
                            <th><?php _e('Type', 'AtozSites-Pro-Quiz'); ?></th>
                            <th><?php _e('Required?', 'AtozSites-Pro-Quiz'); ?></th>
                            <th>
                                <?php _e('Show in statistic table?', 'AtozSites-Pro-Quiz'); ?>
                                <div style="display: inline-block;" class="wpProQuiz_demoBox">
                                    <a href="#"><?php _e('Demo', 'AtozSites-Pro-Quiz'); ?></a>

                                    <div>
                                        <img alt=""
                                             src="<?php echo WPPROQUIZ_URL . '/img/formStatisticOverview.png'; ?> ">
                                    </div>
                                </div>
                            </th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($forms as $form) {
                            $checkType = $this->selectedArray($form->getType(), array(
                                WpProQuiz_Model_Form::FORM_TYPE_TEXT,
                                WpProQuiz_Model_Form::FORM_TYPE_TEXTAREA,
                                WpProQuiz_Model_Form::FORM_TYPE_CHECKBOX,
                                WpProQuiz_Model_Form::FORM_TYPE_SELECT,
                                WpProQuiz_Model_Form::FORM_TYPE_RADIO,
                                WpProQuiz_Model_Form::FORM_TYPE_NUMBER,
                                WpProQuiz_Model_Form::FORM_TYPE_EMAIL,
                                WpProQuiz_Model_Form::FORM_TYPE_YES_NO,
                                WpProQuiz_Model_Form::FORM_TYPE_DATE
                            ));
                            ?>
                            <tr <?php echo $index++ == 0 ? 'style="display: none;"' : '' ?>>
                                <td>
                                    <?php echo $index - 2; ?>
                                </td>
                                <td>
                                    <input type="text" name="form[][fieldname]"
                                           value="<?php echo esc_attr($form->getFieldname()); ?>"
                                           class="regular-text formFieldName"/>
                                </td>
                                <td style="position: relative;">
                                    <select name="form[][type]">
                                        <option
                                            value="<?php echo WpProQuiz_Model_Form::FORM_TYPE_TEXT; ?>" <?php echo $checkType[0]; ?>><?php _e('Text',
                                                'AtozSites-Pro-Quiz'); ?></option>
                                        <option
                                            value="<?php echo WpProQuiz_Model_Form::FORM_TYPE_TEXTAREA; ?>" <?php echo $checkType[1]; ?>><?php _e('Textarea',
                                                'AtozSites-Pro-Quiz'); ?></option>
                                        <option
                                            value="<?php echo WpProQuiz_Model_Form::FORM_TYPE_CHECKBOX; ?>" <?php echo $checkType[2]; ?>><?php _e('Checkbox',
                                                'AtozSites-Pro-Quiz'); ?></option>
                                        <option
                                            value="<?php echo WpProQuiz_Model_Form::FORM_TYPE_SELECT; ?>" <?php echo $checkType[3]; ?>><?php _e('Drop-Down menu',
                                                'AtozSites-Pro-Quiz'); ?></option>
                                        <option
                                            value="<?php echo WpProQuiz_Model_Form::FORM_TYPE_RADIO; ?>" <?php echo $checkType[4]; ?>><?php _e('Radio',
                                                'AtozSites-Pro-Quiz'); ?></option>
                                        <option
                                            value="<?php echo WpProQuiz_Model_Form::FORM_TYPE_NUMBER; ?>" <?php echo $checkType[5]; ?>><?php _e('Number',
                                                'AtozSites-Pro-Quiz'); ?></option>
                                        <option
                                            value="<?php echo WpProQuiz_Model_Form::FORM_TYPE_EMAIL; ?>" <?php echo $checkType[6]; ?>><?php _e('Email',
                                                'AtozSites-Pro-Quiz'); ?></option>
                                        <option
                                            value="<?php echo WpProQuiz_Model_Form::FORM_TYPE_YES_NO; ?>" <?php echo $checkType[7]; ?>><?php _e('Yes/No',
                                                'AtozSites-Pro-Quiz'); ?></option>
                                        <option
                                            value="<?php echo WpProQuiz_Model_Form::FORM_TYPE_DATE; ?>" <?php echo $checkType[8]; ?>><?php _e('Date',
                                                'AtozSites-Pro-Quiz'); ?></option>
                                    </select>

                                    <a href="#" class="editDropDown"><?php _e('Edit list', 'AtozSites-Pro-Quiz'); ?></a>

                                    <div class="dropDownEditBox"
                                         style="position: absolute; border: 1px solid #AFAFAF; background: #EBEBEB; padding: 5px; bottom: 0;right: 0;box-shadow: 1px 1px 1px 1px #AFAFAF; display: none;">
                                        <h4><?php _e('One entry per line', 'AtozSites-Pro-Quiz'); ?></h4>

                                        <div>
                                            <textarea rows="5" cols="50"
                                                      name="form[][data]"><?php echo $form->getData() === null ? '' : esc_textarea(implode("\n",
                                                    $form->getData())); ?></textarea>
                                        </div>

                                        <input type="button" value="<?php _e('OK', 'AtozSites-Pro-Quiz'); ?>"
                                               class="button-primary">
                                    </div>
                                </td>
                                <td>
                                    <input type="checkbox" name="form[][required]"
                                           value="1" <?php $this->checked($form->isRequired()); ?>>
                                </td>
                                <td>
                                    <input type="checkbox" name="form[][show_in_statistic]"
                                           value="1" <?php $this->checked($form->isShowInStatistic()); ?>>
                                </td>
                                <td>
                                    <input type="button" name="form_delete"
                                           value="<?php _e('Delete', 'AtozSites-Pro-Quiz'); ?>" class="button-secondary">
                                    <a class="form_move button-secondary" href="#" style="cursor:move;"><?php _e('Move',
                                            'AtozSites-Pro-Quiz'); ?></a>

                                    <input type="hidden" name="form[][form_id]"
                                           value="<?php echo $form->getFormId(); ?>">
                                    <input type="hidden" name="form[][form_delete]" value="0">
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>

                    <div style="margin-top: 10px;">
                        <input type="button" name="form_add" id="form_add"
                               value="<?php _e('Add field', 'AtozSites-Pro-Quiz'); ?>" class="button-secondary">
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    private function postBoxAdminEmailOption()
    {
        /** @var WpProQuiz_Model_Email * */
        $email = $this->quiz->getAdminEmail();
        $email = $email === null ? WpProQuiz_Model_Email::getDefault(true) : $email;
        ?>
        <div class="postbox" id="adminEmailSettings">
            <h3 class="hndle"><?php _e('Admin e-mail settings', 'AtozSites-Pro-Quiz'); ?></h3>

            <div class="inside">
                <table class="form-table">
                    <tbody>
                    <tr>
                        <th scope="row">
                            <?php _e('Admin e-mail notification', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text">
                                    <span><?php _e('Admin e-mail notification', 'AtozSites-Pro-Quiz'); ?></span>
                                </legend>
                                <label>
                                    <input type="radio" name="emailNotification"
                                           value="<?php echo WpProQuiz_Model_Quiz::QUIZ_EMAIL_NOTE_NONE; ?>" <?php $this->checked($this->quiz->getEmailNotification(),
                                        WpProQuiz_Model_Quiz::QUIZ_EMAIL_NOTE_NONE); ?>>
                                    <?php _e('Deactivate', 'AtozSites-Pro-Quiz'); ?>
                                </label>
                                <label>
                                    <input type="radio" name="emailNotification"
                                           value="<?php echo WpProQuiz_Model_Quiz::QUIZ_EMAIL_NOTE_REG_USER; ?>" <?php $this->checked($this->quiz->getEmailNotification(),
                                        WpProQuiz_Model_Quiz::QUIZ_EMAIL_NOTE_REG_USER); ?>>
                                    <?php _e('for registered users only', 'AtozSites-Pro-Quiz'); ?>
                                </label>
                                <label>
                                    <input type="radio" name="emailNotification"
                                           value="<?php echo WpProQuiz_Model_Quiz::QUIZ_EMAIL_NOTE_ALL; ?>" <?php $this->checked($this->quiz->getEmailNotification(),
                                        WpProQuiz_Model_Quiz::QUIZ_EMAIL_NOTE_ALL); ?>>
                                    <?php _e('for all users', 'AtozSites-Pro-Quiz'); ?>
                                </label>

                                <p class="description">
                                    <?php _e('If you enable this option, you will be informed if a user completes this quiz.',
                                        'AtozSites-Pro-Quiz'); ?>
                                </p>
                            </fieldset>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php _e('To:', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <label>
                                <input type="text" name="adminEmail[to]" value="<?php echo $email->getTo(); ?>"
                                       class="regular-text">
                            </label>

                            <p class="description">
                                <?php _e('Separate multiple email addresses with a comma, e.g. wp@test.com, test@test.com',
                                    'AtozSites-Pro-Quiz'); ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php _e('From:', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <label>
                                <input type="text" name="adminEmail[from]" value="<?php echo $email->getFrom(); ?>"
                                       class="regular-text">
                            </label>
                            <!-- 								<p class="description"> -->
                            <?php //_e('Server-Adresse empfohlen, z.B. info@YOUR-PAGE.com', 'AtozSites-Pro-Quiz');
                            ?>
                            <!-- 								</p> -->
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php _e('Subject:', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <label>
                                <input type="text" name="adminEmail[subject]"
                                       value="<?php echo $email->getSubject(); ?>" class="regular-text">
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php _e('HTML', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <label>
                                <input type="checkbox" name="adminEmail[html]"
                                       value="1" <?php $this->checked($email->isHtml()); ?>> <?php _e('Activate',
                                    'AtozSites-Pro-Quiz'); ?>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php _e('Message body:', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <?php
                            wp_editor($email->getMessage(), 'adminEmailEditor',
                                array('textarea_rows' => 20, 'textarea_name' => 'adminEmail[message]'));
                            ?>

                            <div style="padding-top: 10px;">
                                <table style="width: 100%;">
                                    <thead>
                                    <tr>
                                        <th style="padding: 0;">
                                            <?php _e('Allowed variables', 'AtozSites-Pro-Quiz'); ?>
                                        </th>
                                        <th style="padding: 0;">
                                            <?php _e('Custom fields - Variables', 'AtozSites-Pro-Quiz'); ?>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td style="vertical-align: top;">
                                            <ul>
                                                <li><span>$userId</span> - <?php _e('User-ID', 'AtozSites-Pro-Quiz'); ?></li>
                                                <li><span>$username</span> - <?php _e('Username', 'AtozSites-Pro-Quiz'); ?>
                                                </li>
                                                <li><span>$quizname</span> - <?php _e('Quiz-Name', 'AtozSites-Pro-Quiz'); ?>
                                                </li>
                                                <li><span>$result</span> - <?php _e('Result in precent',
                                                        'AtozSites-Pro-Quiz'); ?></li>
                                                <li><span>$points</span> - <?php _e('Reached points', 'AtozSites-Pro-Quiz'); ?>
                                                </li>
                                                <li><span>$ip</span> - <?php _e('IP-address of the user',
                                                        'AtozSites-Pro-Quiz'); ?></li>
                                                <li><span>$categories</span> - <?php _e('Category-Overview',
                                                        'AtozSites-Pro-Quiz'); ?></li>
                                            </ul>
                                        </td>
                                        <td style="vertical-align: top;">
                                            <ul class="formVariables"></ul>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>

                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <?php

    }

    private function postBoxUserEmailOption()
    {
        /** @var WpProQuiz_Model_Email * */
        $email = $this->quiz->getUserEmail();
        $email = $email === null ? WpProQuiz_Model_Email::getDefault(false) : $email;
        $to = $email->getTo();
        ?>
        <div class="postbox" id="userEmailSettings">
            <h3 class="hndle"><?php _e('User e-mail settings', 'AtozSites-Pro-Quiz'); ?></h3>

            <div class="inside">
                <table class="form-table">
                    <tbody>
                    <tr>
                        <th scope="row">
                            <?php _e('User e-mail notification', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text">
                                    <span><?php _e('User e-mail notification', 'AtozSites-Pro-Quiz'); ?></span>
                                </legend>
                                <label>
                                    <input type="checkbox" name="userEmailNotification"
                                           value="1" <?php $this->checked($this->quiz->isUserEmailNotification()); ?>>
                                    <?php _e('Activate', 'AtozSites-Pro-Quiz'); ?>
                                </label>

                                <p class="description">
                                    <?php _e('If you enable this option, an email is sent with his quiz result to the user.',
                                        'AtozSites-Pro-Quiz'); ?>
                                </p>
                            </fieldset>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php _e('To:', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <label>
                                <input type="checkbox" name="userEmail[toUser]"
                                       value="1" <?php $this->checked($email->isToUser()); ?>>
                                <?php _e('User Email-Address (only registered users)', 'AtozSites-Pro-Quiz'); ?>
                            </label><br>
                            <label>
                                <input type="checkbox" name="userEmail[toForm]"
                                       value="1" <?php $this->checked($email->isToForm()); ?>>
                                <?php _e('Custom fields', 'AtozSites-Pro-Quiz'); ?> :
                                <select name="userEmail[to]" class="emailFormVariables"
                                        data-default="<?php echo empty($to) && $to != 0 ? -1 : $email->getTo(); ?>"></select>
                                <?php _e('(Type Email)', 'AtozSites-Pro-Quiz'); ?>
                            </label>

                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php _e('From:', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <label>
                                <input type="text" name="userEmail[from]" value="<?php echo $email->getFrom(); ?>"
                                       class="regular-text">
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php _e('Subject:', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <label>
                                <input type="text" name="userEmail[subject]" value="<?php echo $email->getSubject(); ?>"
                                       class="regular-text">
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php _e('HTML', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <label>
                                <input type="checkbox" name="userEmail[html]"
                                       value="1" <?php $this->checked($email->isHtml()); ?>> <?php _e('Activate',
                                    'AtozSites-Pro-Quiz'); ?>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php _e('Message body:', 'AtozSites-Pro-Quiz'); ?>
                        </th>
                        <td>
                            <?php
                            wp_editor($email->getMessage(), 'userEmailEditor',
                                array('textarea_rows' => 20, 'textarea_name' => 'userEmail[message]'));
                            ?>

                            <div style="padding-top: 10px;">
                                <table style="width: 100%;">
                                    <thead>
                                    <tr>
                                        <th style="padding: 0;">
                                            <?php _e('Allowed variables', 'AtozSites-Pro-Quiz'); ?>
                                        </th>
                                        <th style="padding: 0;">
                                            <?php _e('Custom fields - Variables', 'AtozSites-Pro-Quiz'); ?>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td style="vertical-align: top;">
                                            <ul>
                                                <li><span>$userId</span> - <?php _e('User-ID', 'AtozSites-Pro-Quiz'); ?></li>
                                                <li><span>$username</span> - <?php _e('Username', 'AtozSites-Pro-Quiz'); ?>
                                                </li>
                                                <li><span>$quizname</span> - <?php _e('Quiz-Name', 'AtozSites-Pro-Quiz'); ?>
                                                </li>
                                                <li><span>$result</span> - <?php _e('Result in precent',
                                                        'AtozSites-Pro-Quiz'); ?></li>
                                                <li><span>$points</span> - <?php _e('Reached points', 'AtozSites-Pro-Quiz'); ?>
                                                </li>
                                                <li><span>$ip</span> - <?php _e('IP-address of the user',
                                                        'AtozSites-Pro-Quiz'); ?></li>
                                                <li><span>$categories</span> - <?php _e('Category-Overview',
                                                        'AtozSites-Pro-Quiz'); ?></li>
                                            </ul>
                                        </td>
                                        <td style="vertical-align: top;">
                                            <ul class="formVariables"></ul>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>

                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
    }
}
