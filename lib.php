<?php 

defined('MOODLE_INTERNAL') || die;

function tool_rafaellechugo_extend_navigation_course($navigation, $course, $context) {
    $navigation->add(
    get_string('pluginname', 'tool_rafaellechugo'),
    new moodle_url('/admin/tool/rafaellechugo/index.php', ['id' => $course->id]),
    navigation_node::TYPE_SETTING,
    get_string('pluginname', 'tool_rafaellechugo'),
    'rafaellechugo',
    new pix_icon('icon', '', 'tool_rafaellechugo'));
}