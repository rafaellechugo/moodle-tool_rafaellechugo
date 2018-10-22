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

require_once(__DIR__ . '/../../../config.php');
require_once(__DIR__ . '/classes/print_data.php');

// Defining variables.
global $DB;

$id = required_param('id', PARAM_ALPHANUMEXT);
$course = $DB->get_record('course', array('id' => $id), '*', MUST_EXIST);

// First, we need to be shure that the users are allowed to be here.
require_login($course);
$systemcontext = context_course::instance($course->id);
require_capability('tool/rafaellechugo:view', $systemcontext);

// Setting the page.
$url = new moodle_url('/admin/tool/rafaellechugo/index.php');
$PAGE->set_context(context_system::instance());
$PAGE->set_url($url, array('id' => $id));
$PAGE->set_pagelayout('report');
$PAGE->set_title('My first Moodle plugin');
$PAGE->set_heading(get_string('pluginname', 'tool_rafaellechugo'));

/* Retrieving data from DB.
 * I'm pretty sure that this SQL code shouldn't be here.
 * Maybe it should be in a lib function?
 */
$query = "  SELECT id, name
            FROM {course_categories}
            WHERE id = (
                SELECT category
                FROM {course}
                WHERE id = $id);";

$coursecategory    = $DB->get_records_sql($query);
$coursedata        = $DB->get_records(
                            'course',
                            array('id' => $id),
                            null,
                            'id, category, fullname, format, startdate'
                    );

echo $OUTPUT->header();

// Showing some basic info.
echo html_writer::div(get_string('course_data_display_1', 'tool_rafaellechugo', $coursedata[$id]->fullname));
echo html_writer::div(get_string('course_data_display_2', 'tool_rafaellechugo', array(
                                    'format' => $coursedata[$id]->format,
                                    'startdate' => date("Y-m-d", $coursedata[$id]->startdate))));
echo html_writer::div(get_string('course_data_display_3', 'tool_rafaellechugo', $coursecategory[$coursedata[$id]->category]->name));

// Let's print the table.
$print = new tool_rafaellechugo_print_data($id);

// If the user has the capability, we'll print the "edit" link.
if (has_capability('tool/rafaellechugo:edit', $systemcontext)) {
    echo html_writer::link(new moodle_url('/admin/tool/rafaellechugo/edit.php', array('id' => $id)),
                            'Edit (todo: to string)');
}

echo $OUTPUT->footer();