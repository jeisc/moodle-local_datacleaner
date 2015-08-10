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
 * @package    cleaner_courses
 * @copyright  2015 Brendan Heywood <brendan@catalyst-au.net>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if (!$ADMIN->fulltree) {
    return;
}

include_once "{$CFG->dirroot}/course/externallib.php";

$settings->add(new admin_setting_configtext('cleaner_courses/minimumage',
            new lang_string('minimumage', 'cleaner_courses'),
            new lang_string('minimumagedesc', 'cleaner_courses'), 365, PARAM_INT));

$categories = core_course_external::get_categories();

// Default to all
$defaultcategories = array();

foreach ($categories as $category) {
    $categoriesbyname[$category['id']] = $category['name'];
    $defaultcategories[$category['id']] = 0;
}
asort($categoriesbyname, SORT_LOCALE_STRING);

$settings->add(new admin_setting_configmulticheckbox(
            'cleaner_courses/categories',
            new lang_string('categories', 'cleaner_courses'),
            new lang_string('categoriesdesc', 'cleaner_courses'),
            $defaultcategories,
            $categoriesbyname
            ));
