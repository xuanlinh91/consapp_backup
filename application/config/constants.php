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
define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');
define('BASE_URL', 'C:\xampp\htdocs\mss');
define('DEFAULT_PAGE_TITLE', 'Consoleapp');
define('USER_SESSION_KEY', 'uid');
define('POST_DATA', 'post_data');
define('SUCCESS_CLASS',		'success');
define('INFO_CLASS',		'info');
define('ERROR_CLASS',		'error');
define('WARNING_CLASS',		'warning');
define('ADMIN_MAIL', 'vsiitest123456@gmail.com');
define('USERNAME', 'vsiitest123456@gmail.com');
define('PASSWORD','vsiitest123456abc');
define('HOST_MAIL','smtp.gmail.com');
define('ALT_BODY_FORGOT_ID', '**This is a system auto-generated email.**');
define('ALT_BODY_FORGOT_PASSWORD', '**This is a system auto-generated email.**');
define('ALT_BODY_ACTIVE_ACCOUNT', '**This is a system auto-generated email.**');
define('ALT_BODY_WEEKLY_NOTIFICATION', 'This email contains information to report progress on last week');
define('ALT_BODY_FINISH_SURVEY_NOTIFICATION', 'This email contains information to survey finish'); define('ALT_BODY_REPORT_NOTIFICATION', 'This email contains information to report finish');
define('PORT', 587);
define('SMTPSECURE','tls'); // or 'ssl'
define('ROLE_ADMIN', 1);
define('ROLE_AGENCY', 2);
define('ROLE_NORMAL', 3);
define('ROLE_RESTRICTED', 4);
define('ID_PREFIX', '');
define('REPORT_VIEW_ALL', '0');
define('REPORT_VIEW_INTERNAL', '1');
define('REPORT_VIEW_EXTERNAL', '2');
define('LOCK_TIMEOUT', '5'); //minute
/**
 * Define constant for Company Info module
 */
define('IS_PRIMARY', '1');
define('IS_NOT_PRIMARY', '0');
/**
 * Define information config to create PDF
 */
define('LOGO_HEADER_WIDTH', 188);
define('TCPDF_MARGIN_HEADER', 7);
define('TCPDF_MARGIN_FOOTER', 10);
define ('TCPDF_MARGIN_TOP', 32);
define ('TCPDF_MARGIN_BOTTOM', 29);
define ('TCPDF_MARGIN_LEFT', 10);
define ('TCPDF_MARGIN_RIGHT', 20);
define ('TCPDF_FONT_NAME_MAIN', 'centurygothic');
define ('TCPDF_FONT_SIZE_MAIN', 10);
define('PDF_UNIT_PX', 'mm' );
define ('TCPDF_FONT_NAME_DATA', 'centurygothic');
define ('TCPDF_FONT_SIZE_DATA', 8);
define ('TCPDF_FONT_MONOSPACED', 'centurygothic');
define ('TCPDF_IMAGE_SCALE_RATIO', 1.25);
define('TCHEAD_MAGNIFICATION', 1.1);
define('TCK_CELL_HEIGHT_RATIO', 1.25);
define('TCK_TITLE_MAGNIFICATION', 1.3);
define('TCK_SMALL_RATIO', 2/3);
/**
 * End of Define information config to create PDF
 */
define('ADMIN_WEEKLY', 'pham.van.quan@vsi-international.com');
define('CONSULTANT_WEEKLY', 'pham.van.quan@vsi-international.com');
// define('SUB_PAGE', 'ONLINE SURVEY');
// define('PREFIX_SUB_PAGE', ' | ');
define('SUB_PAGE', '');
define('PREFIX_SUB_PAGE', '');
define('NUM_LINK_PAGINATION', 1);
define('PER_IN_PAGE', 10);
define('ADMINISTRATOR_KEY', 'ADMINISTRATOR');
define('CONSULTANT_KEY', 'CONSULTANT');
define('USERNORMAL_KEY', 'USERNORMAL');
define('CONVERTER_LINK', '/usr/local/bin');
define('CHART_1_COLOR', 'red');
define('CHART_2_COLOR', 'yellow');
define('CHART_3_COLOR', 'lime');
define('CHART_4_COLOR', 'blue');
define('CHART_1_COLOR_AFTER', 'rgb(255,30,45)');
define('CHART_2_COLOR_AFTER', 'rgb(255,255,45)');
define('CHART_3_COLOR_AFTER', 'rgb(15,255,45)');
define('CHART_4_COLOR_AFTER', 'rgb(45,45,255)');
define('WEEKLY_NOTIFICATION_KEY', 'DH5AVdT0uGeNWfZLkgfutHfDeYrqELjjTZrnulm9RY');
/**
 * Define information config to tracking summary
 */
define('TRACKING_NOT_COMPLETED', 0);
define('TRACKING_IN_PROGRESS', 1);
define('TRACKING_COMPLETED', 2);
define('TRACKING_AVAILABLE', 3);
define('STAGE_1', 1);
define('STAGE_2', 2);
define('STAGE_3', 3);
define('STAGE_4', 4);
define('STAGE_5', 5);
define('STAGE_6', 6);
define('STAGE_7', 7);
define('LEADER_OFFICER', 1);
define('OPTION_ANSWER', 137);
/* End of file constants.php */
/* Location: ./application/config/constants.php */

define('DEFAULT_BLANK_SELECT', 'Select One...');
define('LOCK_COMPANY_INFO', 1);
define('LOCK_COMPANY_PROFILE', 2);
define('REPORT_TEMPLATE', 'files/template');

define('LATEST_SURVEY', 0);
define('SECOND_LATEST_SURVEY', 1);

define('M100', 100000000);
define('M80', 80000000);
define('M50', 50000000);
define('M30', 30000000);
define('M10', 10000000);
define('M5', 5000000);
define('M3', 3000000);
define('M1', 1000000);

