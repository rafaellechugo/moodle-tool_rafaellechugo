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

require_once("$CFG->libdir/formslib.php");

/**
 * Table log class for displaying logs.
 *
 * @package    tool_rafaellechugo
 * @copyright  2018 Rafael Lechugo <rafael@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class tool_rafaellechugo_print_form extends moodleform {

    //Add elements to form
    public function definition() {

        $id = required_param('id', PARAM_ALPHANUMEXT);

        $mform = $this->_form;
 
        $mform->addElement('text', 'name', 'Name (todo: string)');
        $mform->setType('name', PARAM_ALPHANUM);
        $mform->setDefault('name', 'Enter your name (todo: string)');

        $mform->addElement('checkbox', 'completed', 'Completed (todo: string)');
        $mform->setType('completed', PARAM_ALPHANUM);

        $mform->addElement('hidden', 'courseid', 'Course (todo: string)');
        $mform->setType('courseid', PARAM_ALPHANUM);
        $mform->setDefault('courseid', $id);

        $this->add_action_buttons(true);
    }
}
