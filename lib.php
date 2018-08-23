<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Plugin creation exercise for Moodle Dev course.
 *
 * @package    tool_rafaellechugo
 * @copyright  2018 Rafael Lechugo
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

function tool_rafaellechugo_extend_navigation_course($navigation, $course, $context) {

    if (has_capability('tool/rafaellechugo:view', $context)) {
        $navigation->add(
            get_string('pluginname', 'tool_rafaellechugo'),
            new moodle_url('/admin/tool/rafaellechugo/index.php', ['id' => $course->id]),
            navigation_node::TYPE_SETTING,
            get_string('pluginname', 'tool_rafaellechugo'),
            'rafaellechugo',
            new pix_icon('icon', '', 'tool_rafaellechugo')
        );
    }
}

function tool_rafaellechugo_add_entry($context, $courseid, $name, $completed) {

    global $DB;

    if (has_capability('tool/rafaellechugo:edit', $context)) {

        $record = new stdclass();
        $record->courseid = $courseid;
        $record->name = $name;
        $record->completed = $completed;

        $DB->insert_record('tool_rafaellechugo', $record);
    }

}