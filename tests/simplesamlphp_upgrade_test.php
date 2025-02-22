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
 * auth_saml2 SimpleSAMLphp upgrade unit tests
 *
 * @package    auth_saml2
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * auth_saml2 SimpleSAMLphp upgrade unit tests
 *
 * @package    auth_saml2
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class auth_saml2_simplesamlphp_upgrade_testcase extends advanced_testcase {

    /**
     * Test to ensure that composer files are removed from compiled extlib/simplesamlphp.
     */
    public function test_remove_composer_files_from_compiled_extlib_simplesamlphp() {
        $this->resetAfterTest();

        $filenames = [
            "auth/saml2/.extlib/simplesamlphp/composer.json",
            "auth/saml2/.extlib/simplesamlphp/composer.lock",
        ];

        foreach ($filenames as $filename) {
            $this->assertFileNotExists($filename);
        }
    }

    /**
     * Test to ensure that PHPMailer are removed from autoloaded files.
     */
    public function test_remove_phpmailer_from_autoloaded_files() {
        $this->resetAfterTest();

        $filenames = [
            "auth/saml2/.extlib/simplesamlphp/vendor/composer/autoload_psr4.php",
            "auth/saml2/.extlib/simplesamlphp/vendor/composer/autoload_static.php",
            "auth/saml2/.extlib/simplesamlphp/vendor/composer/installed.json",
            "auth/saml2/.extlib/simplesamlphp/vendor/phpmailer/phpmailer/composer.json",
        ];

        foreach ($filenames as $filename) {
            $this->assertFalse(strpos(file_get_contents($filename), "PHPMailer\\\\PHPMailer\\\\"));
            $this->assertFalse(strpos(file_get_contents($filename), "PHPMailer\\\\Test\\\\"));
        }
    }
}
