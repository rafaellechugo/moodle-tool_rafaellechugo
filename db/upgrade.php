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

function xmldb_tool_rafaellechugo_upgrade($oldversion) {

    global $DB;
    $dbman = $DB->get_manager();

    if ($oldversion < 2018081303) {

        // Define table tool_rafaellechugo to be created.
        $table = new xmldb_table('tool_rafaellechugo');

        // Adding fields to table tool_rafaellechugo.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('courseid', XMLDB_TYPE_INTEGER, '10', null, null, null, null);
        $table->add_field('name', XMLDB_TYPE_CHAR, '255', null, null, null, null);
        $table->add_field('completed', XMLDB_TYPE_INTEGER, '1', null, XMLDB_NOTNULL, null, '0');
        $table->add_field('priority', XMLDB_TYPE_INTEGER, '1', null, XMLDB_NOTNULL, null, '1');
        $table->add_field('timecreated', XMLDB_TYPE_INTEGER, '10', null, null, null, null);
        $table->add_field('timemodified', XMLDB_TYPE_INTEGER, '10', null, null, null, null);

        // Adding keys to table tool_rafaellechugo.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));
        $table->add_key('foreign-course_id', XMLDB_KEY_FOREIGN, array('courseid'), 'course', array('id'));
        $table->add_key('unique-courseid_name', XMLDB_KEY_UNIQUE, array('courseid', 'name'));

        // Conditionally launch create table for tool_rafaellechugo.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Rafaellechugo savepoint reached.
        upgrade_plugin_savepoint(true, 2018081303, 'tool', 'rafaellechugo');
    }

    return true;

}