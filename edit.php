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
require_once('lib.php');

// Defining variables.
global $DB;

$id = required_param('id', PARAM_ALPHANUMEXT);
$name = optional_param('name', 'unknown', PARAM_ALPHANUMEXT);
$completed = optional_param('completed', 0, PARAM_BOOL);

$course = $DB->get_record('course', array('id' => $id), '*', MUST_EXIST);

// First, we need to be shure that the users are allowed to be here.
require_login($course);
$systemcontext = context_course::instance($course->id);
require_capability('tool/rafaellechugo:edit', $systemcontext);

/* Creating a instance of "tool_rafaellechugo_print_form"
 * and sending the action URL as a parameter (this page itself)
 */
$mform = new tool_rafaellechugo_print_form('edit.php?id='.$id.'&name='.$name.'&completed='.$completed);

/* If everything is okay with the petition, call the lib.php function
 * tool_rafaellechugo_add_entry to write the data on DB.
 * By the way, why do I have to require lib.php on this file? Shouldn't 
 * it be autoloaded?
 */
if (!$mform->is_cancelled() && $data = $mform->get_data()) {
    tool_rafaellechugo_add_entry($systemcontext, $id, $name, $completed);
}

// Setting the page.
$url = new moodle_url('/admin/tool/rafaellechugo/index.php');
$PAGE->set_context(context_system::instance());
$PAGE->set_url($url, array('id' => $id));
$PAGE->set_pagelayout('report');
$PAGE->set_title('My first Moodle plugin');
$PAGE->set_heading(get_string('pluginname', 'tool_rafaellechugo'));

echo $OUTPUT->header();

// Let's print the form.
$mform->display();

echo $OUTPUT->footer();