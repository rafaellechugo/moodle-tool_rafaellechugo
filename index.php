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

// Standard GPL and phpdocs
require_once(__DIR__ . '/../../../config.php');

global $DB;

$id = required_param('id', PARAM_ALPHANUMEXT);

$url = new moodle_url('/admin/tool/rafaellechugo/index.php');
$PAGE->set_context(context_system::instance());
$PAGE->set_url($url, array('id' => $id));
$PAGE->set_pagelayout('report');
$PAGE->set_title('My first Moodle plugin');
$PAGE->set_heading(get_string('pluginname', 'tool_rafaellechugo'));

$query = "  SELECT id, name
            FROM {course_categories}
            WHERE id = (
            SELECT category
            FROM {course}
            WHERE id = $id);";

$course_category    = $DB->get_records_sql($query);
$course_data        = $DB->get_records(
                            'course', 
                            array('id'=>$id), 
                            null, 
                            'id, category, fullname, format, startdate'
                    );

echo $OUTPUT->header();

echo html_writer::div(get_string('course_data_display_1', 'tool_rafaellechugo', $course_data[$id]->fullname));
echo html_writer::div(get_string('course_data_display_2', 'tool_rafaellechugo', array('format' => $course_data[$id]->format, 'startdate' => date("Y-m-d",$course_data[$id]->startdate))));
echo html_writer::div(get_string('course_data_display_3', 'tool_rafaellechugo', $course_category[$course_data[$id]->category]->name));

echo $OUTPUT->footer();