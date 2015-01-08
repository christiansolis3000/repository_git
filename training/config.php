<?php  // Moodle configuration file

unset($CFG);
global $CFG;
$CFG = new stdClass();

$CFG->dbtype    = 'mysqli';
$CFG->dblibrary = 'native';
$CFG->dbhost    = 'prodlmsdb.cefradhqi7qp.us-west-2.rds.amazonaws.com';
$CFG->dbname    = 'training_moodle_db';
$CFG->dbuser    = 'lmsdbuser';
$CFG->dbpass    = 'pr0dLM$$';
$CFG->prefix    = 'mdl_';
$CFG->dboptions = array (
  'dbpersist' => 0,
  'dbport' => '',
  'dbsocket' => '',
);

$CFG->wwwroot   = 'http://learn.thinkhr.com/training';
$CFG->dataroot  = '/var/moodledata';
$CFG->admin     = 'admin';
//$CFG->maintenance_enabled=0;

$CFG->directorypermissions = 0777;

require_once(dirname(__FILE__) . '/lib/setup.php');

/* Uncomment the following section if you want to debug something */
/*
ini_set ('display_errors', 'on');
ini_set ('log_errors', 'on');
ini_set ('display_startup_errors', 'on');
ini_set ('error_reporting', E_ALL);
*/


// There is no php closing tag in this file,
// it is intentional because it prevents trailing whitespace problems!



//This is a test file 08-01-2015

