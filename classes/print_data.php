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
 * Table log for displaying logs.
 *
 * @package    tool_rafaellechugo
 * @copyright  2018 Rafael Lechugo <rafael@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

require_once($CFG->libdir . '/tablelib.php');

/**
 * Table log class for displaying logs.
 *
 * @package    tool_rafaellechugo
 * @copyright  2018 Rafael Lechugo <rafael@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class tool_rafaellechugo_print_data extends table_sql {

    /**
     * Sets up the table_log parameters.
     *
     * @param string $uniqueid unique id of form.
     */
    public function __construct($uniqueid) {

        global $DB;
       
        $rec = $DB->get_records_sql('SELECT * FROM {tool_rafaellechugo}
                                    WHERE courseid = ?',
                                    array($uniqueid));

        $table = new html_table();
        $table->head = array(
            get_string('table_head_id', 'tool_rafaellechugo'),
            get_string('table_head_courseid', 'tool_rafaellechugo'),
            get_string('table_head_name', 'tool_rafaellechugo'),
            get_string('table_head_completed', 'tool_rafaellechugo'),
            get_string('table_head_priority', 'tool_rafaellechugo'),
            get_string('table_head_tcreated', 'tool_rafaellechugo'),
            get_string('table_head_tmodified', 'tool_rafaellechugo'),
        );

        foreach ($rec as $records) {

            $id = $records->id;
            $courseid = $records->courseid;
            $name = format_string($records->name);
            $completed = $records->completed == 0 ? get_string('no') : get_string('yes');
            $priority = $records->priority;
            $timecreated = UserDate($records->timecreated);
            $timemodified = UserDate($records->timemodified);

            $table->data[] = array($id, $courseid, $name, $completed,
                                    $priority, $timecreated, $timemodified);
        }

        echo html_writer::table($table);
    }

}
