<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',                            'rb');
define('FOPEN_READ_WRITE',                        'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',        'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',    'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',                    'ab');
define('FOPEN_READ_WRITE_CREATE',                'a+b');
define('FOPEN_WRITE_CREATE_STRICT',                'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',        'x+b');

define('PRIVATE_IMAGE_PATH', 'uploads/2016/private/');
define('REGULAR_IMAGE_PATH', '/');
define('CURRENT_SESS', 'Online Result Card 9th Annual 2016');
define('CURRENT_SESS_YEAR', 'Result HSSC (Part-II) Supply 2016');
define('SESS', '2');
define('MCLASS', '12');


define('VERIFICATION_TITLE', 'Online NOC System');
define('NOC_APP_NO', '400000');
define('NOC_APP_NO1', '100000');
define('DIRPATH','F:\xampp\htdocs\Share Images\OldPics'); 








