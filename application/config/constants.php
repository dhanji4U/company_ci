<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
** Application secret credentials
*/
defined('KEY_256')                      OR define('KEY_256', hash('sha256', '1xjNv9xBS6Pb3mDpxNVVX5QUOOytDAXI'));
defined('IV')                           OR define('IV', '1xjNv9xBS6Pb3mDp');
defined('ENC_METHOD')                   OR define('ENC_METHOD', 'AES-256-CBC');
defined('API_KEY')                      OR define('API_KEY', 'FF7FADF3F57143BEB37A97F55E421');

/*
** Application Stuff
*/  
defined('THEME_COLOR')                  OR define('THEME_COLOR', 'theme-blue');
defined('APP_COLOR')                    OR define('APP_COLOR', '#0075BE');
defined('PROJECT_NAME')                 OR define('PROJECT_NAME', 'Garela');
defined('ADMIN_SESSION_NAME')           OR define('ADMIN_SESSION_NAME', 'garelaadmindata');
defined('ADMIN_TIMEZONE')               OR define('ADMIN_TIMEZONE', 'garelaadmintimezone');
defined('ADMIN_SHORTDATE')				OR define('ADMIN_SHORTDATE', 'd-m-Y');
defined('ADMIN_SHORTTIME')				OR define('ADMIN_SHORTTIME', 'h:i A');
defined('ADMIN_LONGDATE')				OR define('ADMIN_LONGDATE', 'd-m-Y h:i A');

defined('API_BASE_URL')                 OR define('API_BASE_URL', 'http://localhost:5803/api/v1/');
defined('LOGO_NAME')      		        OR define('LOGO_NAME','assets/images/logo.jpg');
defined('SMTP_EMAIL')      		        OR define('SMTP_EMAIL','dhanjibhagat1152@gmail.com');
defined('SMTP_PASSWORD')      		    OR define('SMTP_PASSWORD','mnnktkzjsmwhivou');

defined('USER_IMAGE')                   OR define('USER_IMAGE','garela/user/');
defined('COUNTRIES_IMAGE')              OR define('COUNTRIES_IMAGE','garela/flag/');

defined('CURRENCY')						OR define('CURRENCY', '$');
defined('DATABASE_DATETIME')		    OR define('DATABASE_DATETIME', 'Y-m-d H:i:s');
defined('DATABASE_DATE')		        OR define('DATABASE_DATE', 'Y-m-d');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

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
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');


/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code
