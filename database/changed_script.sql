/*

Sample required query for change script

1. Create table:
	CREATE TABLE IF NOT EXISTS `table_name` ();

2. Alter table

	- Alter table add column	
		ALTER TABLE 'table_name' ADD COLUMN `column_name` /params/;

   - Alter  table drop column
		ALTER TABLE `table_name` DROP COLUMN `column_name`;


	- Alter table drop index
			ALTER TABLE `table_name` DROP INDEX `index_name` IF EXISTS;


3. Drop table
	DROP TABLE IF EXISTS `table_name`;

*/

-- change t_user date deleted and created

ALTER TABLE `t_user`
	MODIFY COLUMN `DT_DELETED` TIMESTAMP NULL DEFAULT NULL AFTER `DT_LAST_LOGIN`,
	MODIFY COLUMN `DT_CREATED` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP AFTER `DT_DELETED`;
UPDATE `t_user` SET `DT_DELETED` = NULL WHERE `DT_DELETED` = '0000-00-00 00:00:00';
-- create table t_company_profile by huytv 21/4/2015
CREATE TABLE IF NOT EXISTS `t_company_profile` (
	`ID_COMPANY` VARCHAR(50) NULL DEFAULT NULL,
	`NM_COMPANY` VARCHAR(50) NULL DEFAULT NULL,
	`ID_SURVEY` INT(11) NULL DEFAULT NULL,
	`ID_FAMILY_OWNED` INT(11) NULL DEFAULT NULL,
	`N_REVENUE` VARCHAR(50) NULL DEFAULT NULL,
	`N_STAFF_SIZE` VARCHAR(50) NULL DEFAULT NULL,
	`N_HR_SIZE` VARCHAR(50) NULL DEFAULT NULL,
	`NM_INDUSTRY` VARCHAR(50) NULL DEFAULT NULL,
	`NM_TYPE` VARCHAR(50) NULL DEFAULT NULL,
	`ID_CONSULTANT_ORG` VARCHAR(50) NULL DEFAULT NULL,
	`ID_GS1` INT(11) NULL DEFAULT NULL,
	`ID_GS2` INT(11) NULL DEFAULT NULL,
	`ID_STATUS` INT(11) NULL DEFAULT NULL
);

-- insert database 

INSERT INTO `mss`.`email_template` (`TYPE`, `TEMPLATE_KEY`, `TEMPLATE_SUBJECT`, `TEMPLATE_BODY`) VALUES ('EMAIL', 'SEND_NEW_PASSWORD', 'SUBJECT : GET NEW PASSWORD', '<!DOCTYPE html>
<html>
<head>
<title>HAY GROUP COMPANY</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=320, target-densitydpi=device-dpi">
<style type="text/css">
@media only screen and (max-width: 660px) {
table[class=w0], td[class=w0] {
  width: 0 !important;
}
table[class=w10], td[class=w10], img[class=w10] {
  width: 10px !important;
}
table[class=w15], td[class=w15], img[class=w15] {
  width: 5px !important;
}
table[class=w30], td[class=w30], img[class=w30] {
  width: 10px !important;
}
table[class=w60], td[class=w60], img[class=w60] {
  width: 10px !important;
}
table[class=w125], td[class=w125], img[class=w125] {
  width: 80px !important;
}
table[class=w130], td[class=w130], img[class=w130] {
  width: 55px !important;
}
table[class=w140], td[class=w140], img[class=w140] {
  width: 90px !important;
}
table[class=w160], td[class=w160], img[class=w160] {
  width: 180px !important;
}
table[class=w170], td[class=w170], img[class=w170] {
  width: 100px !important;
}
table[class=w180], td[class=w180], img[class=w180] {
  width: 80px !important;
}
table[class=w195], td[class=w195], img[class=w195] {
  width: 80px !important;
}
table[class=w220], td[class=w220], img[class=w220] {
  width: 80px !important;
}
table[class=w240], td[class=w240], img[class=w240] {
  width: 180px !important;
}
table[class=w255], td[class=w255], img[class=w255] {
  width: 185px !important;
}
table[class=w275], td[class=w275], img[class=w275] {
  width: 135px !important;
}
table[class=w280], td[class=w280], img[class=w280] {
  width: 135px !important;
}
table[class=w300], td[class=w300], img[class=w300] {
  width: 140px !important;
}
table[class=w325], td[class=w325], img[class=w325] {
  width: 95px !important;
}
table[class=w360], td[class=w360], img[class=w360] {
  width: 140px !important;
}
table[class=w410], td[class=w410], img[class=w410] {
  width: 180px !important;
}
table[class=w470], td[class=w470], img[class=w470] {
  width: 200px !important;
}
table[class=w580], td[class=w580], img[class=w580] {
  width: 280px !important;
}
table[class=w640], td[class=w640], img[class=w640] {
  width: 300px !important;
}
table[class*=hide], td[class*=hide], img[class*=hide], p[class*=hide], span[class*=hide] {
  display: none !important;
}
table[class=h0], td[class=h0] {
  height: 0 !important;
}
p[class=footer-content-left] {
  text-align: center !important;
}
#headline p {
  font-size: 30px !important;
}
.article-content, #left-sidebar {
  -webkit-text-size-adjust: 90% !important;
  -ms-text-size-adjust: 90% !important;
}
.header-content, .footer-content-left {
  -webkit-text-size-adjust: 80% !important;
  -ms-text-size-adjust: 80% !important;
}
img {
  height: auto;
  line-height: 100%;
}
}
#outlook a {
  padding: 0;
}
body {
  width: 100% !important;
}
.ReadMsgBody {
  width: 100%;
}
.ExternalClass {
  width: 100%;
  display: block !important;
}
body {
  background-color: #c7c7c7;
  margin: 0;
  padding: 0;
}
img {
  outline: none;
  text-decoration: none;
  display: block;
}
br, strong br, b br, em br, i br {
  line-height: 100%;
}
h1, h2, h3, h4, h5, h6 {
  line-height: 100% !important;
  -webkit-font-smoothing: antialiased;
}
h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {
  color: blue !important;
}
h1 a:active, h2 a:active, h3 a:active, h4 a:active, h5 a:active, h6 a:active {
  color: red !important;
}
h1 a:visited, h2 a:visited, h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited {
  color: purple !important;
}
table td, table tr {
  border-collapse: collapse;
}
.yshortcuts, .yshortcuts a, .yshortcuts a:link, .yshortcuts a:visited, .yshortcuts a:hover, .yshortcuts a span {
  color: black;
  text-decoration: none !important;
  border-bottom: none !important;
  background: none !important;
}
code {
  white-space: normal;
  word-break: break-all;
}
#background-table {
  background-color: #c7c7c7;
}
#top-bar {
  border-radius: 6px 6px 0px 0px;
  -moz-border-radius: 6px 6px 0px 0px;
  -webkit-border-radius: 6px 6px 0px 0px;
  -webkit-font-smoothing: antialiased;
  background-color: #2E2E2E;
  color: #888888;
}
#top-bar a {
  font-weight: bold;
  color: #eeeeee;
  text-decoration: none;
}
#footer {
  border-radius: 0px 0px 6px 6px;
  -moz-border-radius: 0px 0px 6px 6px;
  -webkit-border-radius: 0px 0px 6px 6px;
  -webkit-font-smoothing: antialiased;
}
body, td {
  font-family: HelveticaNeue, sans-serif;
}
.header-content, .footer-content-left, .footer-content-right {
  -webkit-text-size-adjust: none;
  -ms-text-size-adjust: none;
}
.header-content {
  font-size: 12px;
  color: #888888;
}
.header-content a {
  font-weight: bold;
  color: #eeeeee;
  text-decoration: none;
}
#headline p {
  color: #000c8f;
  font-family: HelveticaNeue, sans-serif;
  font-size: 36px;
  text-align: center;
  margin-top: 0px;
  margin-bottom: 30px;
}
#headline p a {
  color: #000c8f;
  text-decoration: none;
}
.article-title {
  font-size: 18px;
  line-height: 24px;
  color: #0f0080;
  font-weight: bold;
  margin-top: 0px;
  margin-bottom: 18px;
  font-family: HelveticaNeue, sans-serif;
}
.article-title a {
  color: #0f0080;
  text-decoration: none;
}
.article-title.with-meta {
  margin-bottom: 0;
}
.article-meta {
  font-size: 13px;
  line-height: 20px;
  color: #ccc;
  font-weight: bold;
  margin-top: 0;
}
.article-content {
  font-size: 13px;
  line-height: 18px;
  color: #444444;
  margin-top: 0px;
  margin-bottom: 18px;
  font-family: HelveticaNeue, sans-serif;
}
.article-content a {
  color: #2f82de;
  font-weight: bold;
  text-decoration: none;
}
.article-content img {
  max-width: 100%
}
.article-content ol, .article-content ul {
  margin-top: 0px;
  margin-bottom: 18px;
  margin-left: 19px;
  padding: 0;
}
.article-content li {
  font-size: 13px;
  line-height: 18px;
  color: #444444;
}
.article-content li a {
  color: #2f82de;
  text-decoration: underline;
}
.article-content p {
  margin-bottom: 15px;
}
.footer-content-left {
  font-size: 12px;
  line-height: 15px;
  color: #888888;
  margin-top: 0px;
  margin-bottom: 15px;
}
.footer-content-left a {
  color: #eeeeee;
  font-weight: bold;
  text-decoration: none;
}
.footer-content-right {
  font-size: 11px;
  line-height: 16px;
  color: #888888;
  margin-top: 0px;
  margin-bottom: 15px;
}
.footer-content-right a {
  color: #eeeeee;
  font-weight: bold;
  text-decoration: none;
}
#footer {
  background-color: #000000;
  color: #888888;
}
#footer a {
  color: #eeeeee;
  text-decoration: none;
  font-weight: bold;
}
#permission-reminder {
  white-space: normal;
}
#street-address {
  color: #ffffff;
  white-space: normal;
}
#email-footer{
    width: 1024 px !important;
}
</style>
<!--[if gte mso 9]>
<style _tmplitem="10222" >
.article-content ol, .article-content ul {
   margin: 0 0 0 24px !important;
   padding: 0 !important;
   list-style-position: inside !important;
}
</style>
<![endif]-->
<meta name="robots" content="noindex,nofollow">
<meta property="og:title" content="Hay Group">
</head>
<body style="width:100% !important;background-color:#c7c7c7;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:HelveticaNeue, sans-serif;">
<table width="100%" cellpadding="0" cellspacing="0" border="0" id="background-table" style="background-color:#c7c7c7;">
  <tbody>
    <tr style="border-collapse:collapse;">
      <td align="center" bgcolor="#c7c7c7" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w640" width="640" cellpadding="0" cellspacing="0" border="0" style="margin-top:0;margin-bottom:0;margin-right:10px;margin-left:10px;">
          <tbody>
            <tr style="border-collapse:collapse;">
              <td class="w640" width="640" height="20" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
            </tr>
            <tr style="border-collapse:collapse;">
              <td class="w640" width="640" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table id="top-bar" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" style="border-radius:6px 6px 0px 0px;-moz-border-radius:6px 6px 0px 0px;-webkit-border-radius:6px 6px 0px 0px;-webkit-font-smoothing:antialiased;background-color:#2E2E2E;color:#888888;">
                  <tbody>
                    <tr style="border-collapse:collapse;">
                      <td class="w15" width="15" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w325" width="350" valign="middle" align="left" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">
                          <tbody>
                            <tr style="border-collapse:collapse;">
                              <td class="w325" width="350" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                            </tr>
                          </tbody>
                        </table>
                        <div class="header-content" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;color:#888888;"><p style="font-weight:bold;color:#eeeeee;text-decoration:none">Home Page<span class="hide">&nbsp;&nbsp;|&nbsp;</span></p>
                        </div>
                        <table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">
                          <tbody>
                            <tr style="border-collapse:collapse;">
                              <td class="w325" width="350" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                            </tr>
                          </tbody>
                        </table></td>
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w255" width="255" valign="middle" align="right" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">
                          <tbody>
                            <tr style="border-collapse:collapse;">
                              <td class="w255" width="255" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                            </tr>
                          </tbody>
                        </table>
                        <table cellpadding="0" cellspacing="0" border="0">
                          <tbody>
                            <tr style="border-collapse:collapse;"> </tr>
                          </tbody>
                        </table>
                        <table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">
                          <tbody>
                            <tr style="border-collapse:collapse;">
                              <td class="w255" width="255" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                            </tr>
                          </tbody>
                        </table></td>
                      <td class="w15" width="15" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr style="border-collapse:collapse;">
              <td id="header" class="w640" width="640" align="center" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w640" width="640" cellpadding="0" cellspacing="0" border="0">
                  <tbody>
                    <tr style="border-collapse:collapse;">
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w580" width="580" height="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                    </tr>
                    <tr style="border-collapse:collapse;">
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w580" width="580" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><div align="center" id="headline">
                          <p style="color:#000c8f;font-family:HelveticaNeue, sans-serif;font-size:36px;text-align:center;margin-top:0px;margin-bottom:30px;"> <strong>Hay Group Company</strong> </p>
                        </div></td>
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr style="border-collapse:collapse;">
              <td class="w640" width="640" height="30" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
            </tr>
            <tr id="simple-content-row" style="border-collapse:collapse;">
              <td class="w640" width="640" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table align="left" class="w640" width="640" cellpadding="0" cellspacing="0" border="0">
                  <tbody>
                    <tr style="border-collapse:collapse;">
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w580" width="580" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w580" width="580" cellpadding="0" cellspacing="0" border="0">
                          <tbody>
                            <tr style="border-collapse:collapse;">
                              <td class="w580" width="580" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><p align="left" class="article-title" style="font-size:18px;line-height:24px;color:#0f0080;font-weight:bold;margin-top:0px;margin-bottom:18px;font-family:HelveticaNeue, sans-serif;">Request Retrieve Password</p>
                                <div align="left" class="article-content" style="font-size:14px;line-height:14px;color:#444444;margin-top:0px;margin-bottom:18px;font-family:HelveticaNeue, sans-serif;">Hi <strong>{TX_USERNAME}</strong>, 
                                <p>You have requested to reset the password for the following account:</p>
                                </br>
                                <p>Username: <strong>{TX_USERNAME}</strong></p>
                                </br>
                                 <p>Generated Password: <strong>{TX_SECURITY_CODE}</strong></p>                                
                                </div>
                              </td>
                            </tr>
                            <tr style="border-collapse:collapse;">
                              <td class="w580" width="580" height="10" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                            </tr>
                          </tbody>
                        </table></td>
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr style="border-collapse:collapse;">
              <td class="w640" width="640" height="15" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
            </tr>
            <tr style="border-collapse:collapse;">
              <td class="w640" width="640" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table id="footer" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#000000" style="border-radius:0px 0px 6px 6px;-moz-border-radius:0px 0px 6px 6px;-webkit-border-radius:0px 0px 6px 6px;-webkit-font-smoothing:antialiased;background-color:#000000;color:#888888;">
                  <tbody>
                    <tr style="border-collapse:collapse;">
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w580 h0" width="360" height="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w0" width="60" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w0" width="160" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                    </tr>
                    <tr style="border-collapse:collapse;">
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;padding-left: 20px;"></td>
                      <td class="w580" width="90%" valign="top" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><span class="hide">
                        <p id="permission-reminder" align="left" class="footer-content-left" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;line-height:15px;color:#888888;margin-top:0px;margin-bottom:15px;white-space:normal;"><span>About Hay Group</span><br style="line-height:100%;">
                          <span>Hay Group is a global management consulting firm that works with leaders to transform strategy into reality. We develop talent, organize people to be more effective and motivate them to perform at their best.</span></p>
                        </span>
                        <p align="left" class="footer-content-left" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;line-height:15px;color:#888888;margin-top:0px;margin-bottom:15px;"><a style="color: #15c;">{ALT_BODY}</a> |</p></td>
                    </tr>
                    <tr style="border-collapse:collapse;">
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w580 h0" width="360" height="15" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr style="border-collapse:collapse;">
              <td class="w640" width="640" height="60" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
            </tr>
          </tbody>
        </table></td>
    </tr>
  </tbody>
</table>
</body>
</html>');
-- create table t_org_mapping by huytv on April 22th 2015
CREATE TABLE IF NOT EXISTS `t_org_mapping` (
	`NM_ROOT_ORG` VARCHAR(50) NULL DEFAULT NULL,
	`NM_AGENCY` VARCHAR(50) NULL DEFAULT NULL
);
-- create table t_company_profile
CREATE TABLE `t_company_profile` (
	`ID_COMPANY` VARCHAR(50) NULL DEFAULT NULL,
	`NM_COMPANY` VARCHAR(50) NULL DEFAULT NULL,
	`ID_SURVEY` INT(11) NULL DEFAULT NULL,
	`DT_ASSESSMENT` INT(11) NULL DEFAULT NULL,
	`NM_CEO` VARCHAR(50) NULL DEFAULT NULL,
	`NM_DESIGNATION1` VARCHAR(50) NULL DEFAULT NULL,
	`N_HP1` VARCHAR(50) NULL DEFAULT NULL,
	`N_EMAIL1` VARCHAR(50) NULL DEFAULT NULL,
	`NM_HR` VARCHAR(50) NULL DEFAULT NULL,
	`NM_DESIGNATION2` VARCHAR(50) NULL DEFAULT NULL,
	`N_HP2` INT(11) NULL DEFAULT NULL,
	`N_EMAIL2` INT(11) NULL DEFAULT NULL,
	`NM_INDUSTRY` INT(11) NULL DEFAULT NULL,
	`NM_TYPE` VARCHAR(50) NULL DEFAULT NULL,
	`NM_SCOPE` VARCHAR(50) NULL DEFAULT NULL,
	`N_L_REVENUE` VARCHAR(50) NULL DEFAULT NULL,
	`N_O_REVENUE` VARCHAR(50) NULL DEFAULT NULL,
	`N_GROSS` VARCHAR(50) NULL DEFAULT NULL,
	`N_LOCAL_STAFF` VARCHAR(50) NULL DEFAULT NULL,
	`N_UNI` VARCHAR(50) NULL DEFAULT NULL,
	`N_POLY` VARCHAR(50) NULL DEFAULT NULL,
	`N_ITE` VARCHAR(50) NULL DEFAULT NULL,
	`N_PARTTIME` VARCHAR(50) NULL DEFAULT NULL,
	`N_L_HR` VARCHAR(50) NULL DEFAULT NULL,
	`N_OVERSEAS_STAFF` VARCHAR(50) NULL DEFAULT NULL,
	`N_OVERSEAS_HR` VARCHAR(50) NULL DEFAULT NULL,
	`N_L_RETENTION` VARCHAR(50) NULL DEFAULT NULL,
	`N_O_RETENTION` VARCHAR(50) NULL DEFAULT NULL,
	`N_L_TURNOVER` VARCHAR(50) NULL DEFAULT NULL,
	`N_O_TURNOVER` VARCHAR(50) NULL DEFAULT NULL,
	`N_TRAINING_COST` VARCHAR(50) NULL DEFAULT NULL,
	`N_TRAINING_PARTICIPATION` VARCHAR(50) NULL DEFAULT NULL,
	`ID_CONSULTANT_ORG` VARCHAR(50) NULL DEFAULT NULL,
	`ID_GS1` VARCHAR(50) NULL DEFAULT NULL,
	`ID_MS2` VARCHAR(50) NULL DEFAULT NULL,
	`ID_LC3` VARCHAR(50) NULL DEFAULT NULL,
	`ID_STATUS` VARCHAR(50) NULL DEFAULT NULL,
	`ID_REPORT_TYPE` VARCHAR(50) NULL DEFAULT NULL
)

;
-- insert data to t_org_mapping
INSERT INTO `t_org_mapping` (`NM_AGENCY`) VALUES ('HAY GROUP 1');
INSERT INTO `t_org_mapping` (`NM_AGENCY`) VALUES ('HAY GROUP 2');
INSERT INTO `t_org_mapping` (`NM_AGENCY`) VALUES ('HAY GROUP 3');
INSERT INTO `t_org_mapping` (`NM_AGENCY`) VALUES ('HAY GROUP 4');
INSERT INTO `t_org_mapping` (`NM_AGENCY`) VALUES ('HAY GROUP 5');
INSERT INTO `t_org_mapping` (`NM_AGENCY`) VALUES ('HAY GROUP 6');
INSERT INTO `t_org_mapping` (`NM_AGENCY`) VALUES ('HAY GROUP 7');
INSERT INTO `t_org_mapping` (`NM_AGENCY`) VALUES ('HAY GROUP 8');

-- add stage 7 to t_tracking
ALTER TABLE `t_tracking`
 ADD COLUMN `STAGE_7` SMALLINT(6) NOT NULL DEFAULT 0 AFTER `STAGE_6`;
-- alter company profile
ALTER TABLE `t_company_profile`
	MODIFY COLUMN `ID_STATUS` TINYINT(5) NULL DEFAULT '0' AFTER `ID_LC3`;

-- insert sample data t_org_mapping
UPDATE `t_org_mapping` SET `NM_ROOT_ORG` = 'HAY GROUP 1';

-- update table t_user, t_mapping sample data
UPDATE `t_user` SET `NM_ORGANISATION` = CONCAT('HAY GROUP ', FLOOR(1+RAND()*(9)));
UPDATE `t_org_mapping` SET `NM_ROOT_ORG` = CONCAT('HAY GROUP ', FLOOR(1+RAND()*(9))),`NM_AGENCY` = CONCAT('HAY GROUP ', FLOOR(1+RAND()*(9)));

-- change database table t_training_participants 24/4
ALTER TABLE `t_training_participants`
	MODIFY COLUMN `NM_ORGANISATION` VARCHAR(50) NOT NULL AFTER `NM_PARTICIPANT`;
-- add sample data
UPDATE `t_training_participants` SET `NM_ORGANISATION` = CONCAT('HAY GROUP ', FLOOR(1+RAND()*(9)));

-- Update db for gap recommendation module
ALTER TABLE `t_gap_analysis_matrix`
	MODIFY COLUMN  `ID_CATEGORY` VARCHAR(50) NOT NULL FIRST;
	
ALTER TABLE `t_gap_analysis_rec`
	MODIFY COLUMN  `ID_CATEGORY` VARCHAR(50) NOT NULL AFTER `ID_SURVEY`;
	
INSERT INTO `t_gap_analysis_matrix` (`ID_CATEGORY`, `ID_QUESTION`, `IN_SCORE`, `TX_DEFAULT`) VALUES	('A1', 0, 0, 'Recommendation 01');
INSERT INTO `t_gap_analysis_matrix` (`ID_CATEGORY`, `ID_QUESTION`, `IN_SCORE`, `TX_DEFAULT`) VALUES ('A2', 1, 3, 'Recommendation 01');
INSERT INTO `t_gap_analysis_matrix` (`ID_CATEGORY`, `ID_QUESTION`, `IN_SCORE`, `TX_DEFAULT`) VALUES	('A3', 1, 2, 'Recommendation 02');
INSERT INTO `t_gap_analysis_matrix` (`ID_CATEGORY`, `ID_QUESTION`, `IN_SCORE`, `TX_DEFAULT`) VALUES	('A4', 2, 3, 'Recommendation 03');
INSERT INTO `t_gap_analysis_matrix` (`ID_CATEGORY`, `ID_QUESTION`, `IN_SCORE`, `TX_DEFAULT`) VALUES	('A5', 3, 2, 'Recommendation 04');
INSERT INTO `t_gap_analysis_matrix` (`ID_CATEGORY`, `ID_QUESTION`, `IN_SCORE`, `TX_DEFAULT`) VALUES	('A6', 4, 3, 'Recommendation 05');
INSERT INTO `t_gap_analysis_matrix` (`ID_CATEGORY`, `ID_QUESTION`, `IN_SCORE`, `TX_DEFAULT`) VALUES	('A7', 5, 3, 'Recommendation 06');
INSERT INTO `t_gap_analysis_matrix` (`ID_CATEGORY`, `ID_QUESTION`, `IN_SCORE`, `TX_DEFAULT`) VALUES	('A8', 6, 3, 'Recommendation 07');
INSERT INTO `t_gap_analysis_matrix` (`ID_CATEGORY`, `ID_QUESTION`, `IN_SCORE`, `TX_DEFAULT`) VALUES	('A9', 7, 2, 'Recommendation 08');
INSERT INTO `t_gap_analysis_matrix` (`ID_CATEGORY`, `ID_QUESTION`, `IN_SCORE`, `TX_DEFAULT`) VALUES	('A10', 8, 3, 'Recommendation 09');
INSERT INTO `t_gap_analysis_matrix` (`ID_CATEGORY`, `ID_QUESTION`, `IN_SCORE`, `TX_DEFAULT`) VALUES	('A11', 9, 3, 'Recommendation 10');
INSERT INTO `t_gap_analysis_matrix` (`ID_CATEGORY`, `ID_QUESTION`, `IN_SCORE`, `TX_DEFAULT`) VALUES	('A12', 10, 3, 'Recommendation 11');
INSERT INTO `t_gap_analysis_matrix` (`ID_CATEGORY`, `ID_QUESTION`, `IN_SCORE`, `TX_DEFAULT`) VALUES	('A13', 11, 3, 'Recommendation 12');
INSERT INTO `t_gap_analysis_matrix` (`ID_CATEGORY`, `ID_QUESTION`, `IN_SCORE`, `TX_DEFAULT`) VALUES	('A14', 12, 4, 'Recommendation 14');
INSERT INTO `t_gap_analysis_matrix` (`ID_CATEGORY`, `ID_QUESTION`, `IN_SCORE`, `TX_DEFAULT`) VALUES	('A15', 13, 4, 'Recommendation 15');
INSERT INTO `t_gap_analysis_matrix` (`ID_CATEGORY`, `ID_QUESTION`, `IN_SCORE`, `TX_DEFAULT`) VALUES	('A16', 14, 3, 'Recommendation 16');
INSERT INTO `t_gap_analysis_matrix` (`ID_CATEGORY`, `ID_QUESTION`, `IN_SCORE`, `TX_DEFAULT`) VALUES	('A17', 15, 3, 'Recommendation 17');

ALTER TABLE `t_survey_response_hdr`
	ADD COLUMN `TX_FREE` TEXT NOT NULL AFTER `INIT`;

-- insert data to t_dropdown huytv 25/4/2015

DELETE FROM t_dropdown;

INSERT INTO `t_dropdown` (`ID_DROPDOWN`, `NM_TYPE`, `VALUE`) VALUES
  (1, 'Company_Industry', 'Biomedical & Healthcare Services'),
  (3, 'Company_Industry', 'Electronics, Environmental, Chemical & engineering '),
  (4, 'Company_Industry', 'Chemicals'),
  (5, 'Company_Industry', 'Food and Beverage Services'),
  (6, 'Company_Industry', 'Food Manufacturing'),
  (7, 'Company_Industry', 'Furniture'),
  (8, 'Company_Industry', 'Logistics'),
  (9, 'Company_Industry', 'General Manufacturing'),
  (10, 'Company_Industry', 'Precision Engineering'),
  (11, 'Company_Industry', 'Printing'),
  (12, 'Company_Industry', 'Retail'),
  (13, 'Company_Industry', 'Textile & Apparel'),
  (14, 'Company_Industry', 'Transport Engineering'),
  (15, 'Company_Type', 'Listed Company'),
  (16, 'Company_Type', 'Private Company'),
  (17, 'Company_Type', 'Family Run Business'),
  (18, 'Company_Type', 'Private Company,planning to list(within 2 years)'),
  (26, 'Revenue', '$100M and above'),
  (27, 'Revenue', '$50M to < $100M'),
  (28, 'Revenue', '$25M to < $50M'),
  (29, 'Revenue', '$10M to < $25M'),
  (30, 'Revenue', '$5M to <  $10M'),
  (31, 'Revenue', '$1M to < $5M'),
  (32, 'Revenue', '< $1M'),
  (35, 'Total_Staff', 'More than 1300'),
  (36, 'Total_Staff', '801 to 1300'),
  (37, 'Total_Staff', '401 to 800'),
  (38, 'Total_Staff', '201 to 400'),
  (39, 'Total_Staff', '101 to 200'),
  (40, 'Total_Staff', '51 to 100'),
  (41, 'Total_Staff', 'Less than 50'),
  (42, 'HR_Staff', 'More than 10'),
  (43, 'HR_Staff', '6 to 10'),
  (44, 'HR_Staff', '3 to 5'),
  (45, 'HR_Staff', '1 to 2'),
  (46, 'HR_Staff', 'No dedicated HR Function'),
  (47, 'HR_Staff', 'HR Function is outsourced'),
  (48, 'Company_Industry', 'Cleantech/Environmental Solutions'),
  (49, 'Company_Industry', 'Construction'),
  (50, 'Company_Industry', 'Electronics'),
  (51, 'Company_Industry', 'Engineering Services'),
  (52, 'Company_Industry', 'Information Technology/Infocomm'),
  (53, 'Company_Industry', 'Packaging'),
  (54, 'Company_Industry', 'Professional Services'),
  (55, 'Company_Industry', 'Private Education'),
  (56, 'Company_Industry', 'Other'),
  (57, 'Scope_Of_Operation', 'Local market'),
  (58, 'Scope_Of_Operation', 'Overseas market');

ALTER TABLE `t_company_profile`
ADD COLUMN `ID_AI` SMALLINT(6) NULL AUTO_INCREMENT PRIMARY KEY FIRST;


-- change email template linhnx 5/4
UPDATE `email_template` SET `TEMPLATE_BODY` = '<!DOCTYPE html>
<html>

<head>
    <title>HAY GROUP COMPANY</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=320, target-densitydpi=device-dpi">
    <style type="text/css">
        @media only screen and (max-width: 660px) {
            table[class=w0], td[class=w0] {
                width: 0 !important;
            }
            table[class=w10],
            td[class=w10],
            img[class=w10] {
                width: 10px !important;
            }
            table[class=w15],
            td[class=w15],
            img[class=w15] {
                width: 5px !important;
            }
            table[class=w30],
            td[class=w30],
            img[class=w30] {
                width: 10px !important;
            }
            table[class=w60],
            td[class=w60],
            img[class=w60] {
                width: 10px !important;
            }
            table[class=w125],
            td[class=w125],
            img[class=w125] {
                width: 80px !important;
            }
            table[class=w130],
            td[class=w130],
            img[class=w130] {
                width: 55px !important;
            }
            table[class=w140],
            td[class=w140],
            img[class=w140] {
                width: 90px !important;
            }
            table[class=w160],
            td[class=w160],
            img[class=w160] {
                width: 180px !important;
            }
            table[class=w170],
            td[class=w170],
            img[class=w170] {
                width: 100px !important;
            }
            table[class=w180],
            td[class=w180],
            img[class=w180] {
                width: 80px !important;
            }
            table[class=w195],
            td[class=w195],
            img[class=w195] {
                width: 80px !important;
            }
            table[class=w220],
            td[class=w220],
            img[class=w220] {
                width: 80px !important;
            }
            table[class=w240],
            td[class=w240],
            img[class=w240] {
                width: 180px !important;
            }
            table[class=w255],
            td[class=w255],
            img[class=w255] {
                width: 185px !important;
            }
            table[class=w275],
            td[class=w275],
            img[class=w275] {
                width: 135px !important;
            }
            table[class=w280],
            td[class=w280],
            img[class=w280] {
                width: 135px !important;
            }
            table[class=w300],
            td[class=w300],
            img[class=w300] {
                width: 140px !important;
            }
            table[class=w325],
            td[class=w325],
            img[class=w325] {
                width: 95px !important;
            }
            table[class=w360],
            td[class=w360],
            img[class=w360] {
                width: 140px !important;
            }
            table[class=w410],
            td[class=w410],
            img[class=w410] {
                width: 180px !important;
            }
            table[class=w470],
            td[class=w470],
            img[class=w470] {
                width: 200px !important;
            }
            table[class=w580],
            td[class=w580],
            img[class=w580] {
                width: 280px !important;
            }
            table[class=w640],
            td[class=w640],
            img[class=w640] {
                width: 300px !important;
            }
            table[class*=hide],
            td[class*=hide],
            img[class*=hide],
            p[class*=hide],
            span[class*=hide] {
                display: none !important;
            }
            table[class=h0],
            td[class=h0] {
                height: 0 !important;
            }
            p[class=footer-content-left] {
                text-align: center !important;
            }
            #headline p {
                font-size: 30px !important;
            }
            .article-content,
            #left-sidebar {
                -webkit-text-size-adjust: 90% !important;
                -ms-text-size-adjust: 90% !important;
            }
            .header-content,
            .footer-content-left {
                -webkit-text-size-adjust: 80% !important;
                -ms-text-size-adjust: 80% !important;
            }
            img {
                height: auto;
                line-height: 100%;
            }
        }

        #outlook a {
            padding: 0;
        }

        body {
            width: 100% !important;
        }

        .ReadMsgBody {
            width: 100%;
        }

        .ExternalClass {
            width: 100%;
            display: block !important;
        }

        body {
            background-color: #c7c7c7;
            margin: 0;
            padding: 0;
        }

        img {
            outline: none;
            text-decoration: none;
            display: block;
        }

        br,
        strong br,
        b br,
        em br,
        i br {
            line-height: 100%;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            line-height: 100% !important;
            -webkit-font-smoothing: antialiased;
        }

        h1 a,
        h2 a,
        h3 a,
        h4 a,
        h5 a,
        h6 a {
            color: blue !important;
        }

        h1 a:active,
        h2 a:active,
        h3 a:active,
        h4 a:active,
        h5 a:active,
        h6 a:active {
            color: red !important;
        }

        h1 a:visited,
        h2 a:visited,
        h3 a:visited,
        h4 a:visited,
        h5 a:visited,
        h6 a:visited {
            color: purple !important;
        }

        table td,
        table tr {
            border-collapse: collapse;
        }

        .yshortcuts,
        .yshortcuts a,
        .yshortcuts a:link,
        .yshortcuts a:visited,
        .yshortcuts a:hover,
        .yshortcuts a span {
            color: black;
            text-decoration: none !important;
            border-bottom: none !important;
            background: none !important;
        }

        code {
            white-space: normal;
            word-break: break-all;
        }

        #background-table {
            background-color: #c7c7c7;
        }

        #top-bar {
            border-radius: 6px 6px 0px 0px;
            -moz-border-radius: 6px 6px 0px 0px;
            -webkit-border-radius: 6px 6px 0px 0px;
            -webkit-font-smoothing: antialiased;
            background-color: #2E2E2E;
            color: #888888;
        }

        #top-bar a {
            font-weight: bold;
            color: #eeeeee;
            text-decoration: none;
        }

        #footer {
            border-radius: 0px 0px 6px 6px;
            -moz-border-radius: 0px 0px 6px 6px;
            -webkit-border-radius: 0px 0px 6px 6px;
            -webkit-font-smoothing: antialiased;
        }

        body,
        td {
            font-family: HelveticaNeue, sans-serif;
        }

        .header-content,
        .footer-content-left,
        .footer-content-right {
            -webkit-text-size-adjust: none;
            -ms-text-size-adjust: none;
        }

        .header-content {
            font-size: 12px;
            color: #888888;
        }

        .header-content a {
            font-weight: bold;
            color: #eeeeee;
            text-decoration: none;
        }

        #headline p {
            color: #000c8f;
            font-family: HelveticaNeue, sans-serif;
            font-size: 36px;
            text-align: center;
            margin-top: 0px;
            margin-bottom: 30px;
        }

        #headline p a {
            color: #000c8f;
            text-decoration: none;
        }

        .article-title {
            font-size: 18px;
            line-height: 24px;
            color: #0f0080;
            font-weight: bold;
            margin-top: 0px;
            margin-bottom: 18px;
            font-family: HelveticaNeue, sans-serif;
        }

        .article-title a {
            color: #0f0080;
            text-decoration: none;
        }

        .article-title.with-meta {
            margin-bottom: 0;
        }

        .article-meta {
            font-size: 13px;
            line-height: 20px;
            color: #ccc;
            font-weight: bold;
            margin-top: 0;
        }

        .article-content {
            font-size: 13px;
            line-height: 18px;
            color: #444444;
            margin-top: 0px;
            margin-bottom: 18px;
            font-family: HelveticaNeue, sans-serif;
        }

        .article-content a {
            color: #2f82de;
            font-weight: bold;
            text-decoration: none;
        }

        .article-content img {
            max-width: 100%
        }

        .article-content ol,
        .article-content ul {
            margin-top: 0px;
            margin-bottom: 18px;
            margin-left: 19px;
            padding: 0;
        }

        .article-content li {
            font-size: 13px;
            line-height: 18px;
            color: #444444;
        }

        .article-content li a {
            color: #2f82de;
            text-decoration: underline;
        }

        .article-content p {
            margin-bottom: 15px;
        }

        .footer-content-left {
            font-size: 12px;
            line-height: 15px;
            color: #888888;
            margin-top: 0px;
            margin-bottom: 15px;
        }

        .footer-content-left a {
            color: #eeeeee;
            font-weight: bold;
            text-decoration: none;
        }

        .footer-content-right {
            font-size: 11px;
            line-height: 16px;
            color: #888888;
            margin-top: 0px;
            margin-bottom: 15px;
        }

        .footer-content-right a {
            color: #eeeeee;
            font-weight: bold;
            text-decoration: none;
        }

        #footer {
            background-color: #000000;
            color: #888888;
        }

        #footer a {
            color: #eeeeee;
            text-decoration: none;
            font-weight: bold;
        }

        #permission-reminder {
            white-space: normal;
        }

        #street-address {
            color: #ffffff;
            white-space: normal;
        }

        #email-footer {
            width: 1024 px !important;
        }
    </style>
    <!--[if gte mso 9]>       <style _tmplitem="10222" >.article-content ol, .article-content ul {   margin: 0 0 0 24px !important;   padding: 0 !important;   list-style-position: inside !important;}</style>       <![endif]-->
    <meta name="robots" content="noindex,nofollow">
    <meta property="og:title" content="Hay Group"> </head>

<body style="width:100% !important;background-color:#c7c7c7;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:HelveticaNeue, sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" id="background-table" style="background-color:#c7c7c7;">
        <tbody>
            <tr style="border-collapse:collapse;">
                <td align="center" bgcolor="#c7c7c7" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;">
                    <table class="w640" width="640" cellpadding="0" cellspacing="0" border="0" style="margin-top:0;margin-bottom:0;margin-right:10px;margin-left:10px;">
                        <tbody>
                            <tr style="border-collapse:collapse;">
                                <td class="w640" width="640" height="20" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                            </tr>
                            <tr style="border-collapse:collapse;">
                                <td class="w640" width="640" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;">
                                    <table id="top-bar" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" style="border-radius:6px 6px 0px 0px;-moz-border-radius:6px 6px 0px 0px;-webkit-border-radius:6px 6px 0px 0px;-webkit-font-smoothing:antialiased;background-color:#2E2E2E;color:#888888;">
                                        <tbody>
                                            <tr style="border-collapse:collapse;">
                                                <td class="w15" width="15" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                                                <td class="w325" width="350" valign="middle" align="left" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;">
                                                    <table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">
                                                        <tbody>
                                                            <tr style="border-collapse:collapse;">
                                                                <td class="w325" width="350" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <div class="header-content" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;color:#888888;">
                                                        <p style="font-weight:bold;color:#eeeeee;text-decoration:none">Home Page</p>
                                                    </div>
                                                    <table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">
                                                        <tbody>
                                                            <tr style="border-collapse:collapse;">
                                                                <td class="w325" width="350" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                                <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                                                <td class="w255" width="255" valign="middle" align="right" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;">
                                                    <table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">
                                                        <tbody>
                                                            <tr style="border-collapse:collapse;">
                                                                <td class="w255" width="255" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <table cellpadding="0" cellspacing="0" border="0">
                                                        <tbody>
                                                            <tr style="border-collapse:collapse;"> </tr>
                                                        </tbody>
                                                    </table>
                                                    <table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">
                                                        <tbody>
                                                            <tr style="border-collapse:collapse;">
                                                                <td class="w255" width="255" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                                <td class="w15" width="15" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr style="border-collapse:collapse;">
                                <td id="header" class="w640" width="640" align="center" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;">
                                    <table class="w640" width="640" cellpadding="0" cellspacing="0" border="0">
                                        <tbody>
                                            <tr style="border-collapse:collapse;">
                                                <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                                                <td class="w580" width="580" height="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                                                <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                                            </tr>
                                            <tr style="border-collapse:collapse;">
                                                <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                                                <td class="w580" width="580" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;">
                                                    <div align="center" id="headline">
                                                        <p style="color:#000c8f;font-family:HelveticaNeue, sans-serif;font-size:36px;text-align:center;margin-top:0px;margin-bottom:30px;"> <strong>Hay Group Company</strong> </p>
                                                    </div>
                                                </td>
                                                <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr style="border-collapse:collapse;">
                                <td class="w640" width="640" height="30" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                            </tr>
                            <tr id="simple-content-row" style="border-collapse:collapse;">
                                <td class="w640" width="640" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;">
                                    <table align="left" class="w640" width="640" cellpadding="0" cellspacing="0" border="0">
                                        <tbody>
                                            <tr style="border-collapse:collapse;">
                                                <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                                                <td class="w580" width="580" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;">
                                                    <table class="w580" width="580" cellpadding="0" cellspacing="0" border="0">
                                                        <tbody>
                                                            <tr style="border-collapse:collapse;">
                                                                <td class="w580" width="580" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;">
                                                                    <p align="left" class="article-title" style="font-size:18px;line-height:24px;color:#0f0080;font-weight:bold;margin-top:0px;margin-bottom:18px;font-family:HelveticaNeue, sans-serif;">Account Setup</p>
                                                                    <div align="left" class="article-content" style="font-size:14px;line-height:14px;color:#444444;margin-top:0px;margin-bottom:18px;font-family:HelveticaNeue, sans-serif;"> Hi <strong>{TX_USER_NAME}</strong>,
                                                                        <p>You have requested to active the following account:</p>
                                                                        </br>
                                                                        <p>Username: <strong>{TX_USERNAME}</strong></p>
                                                                        </br>
                                                                        <p>Generated Password: <strong>{TX_PASSWORD}</strong></p>
                                                                        <p>Click<a href="{LINK_ACTIVE}"><em> Here </em></a>to activate your account</p>
                                                                        <!-- <p>To reset the password, please go to the <a href="{LOGIN_PAGE}"><em> login page </em></a> and login with the given password. Upon login, you will be prompted to reset your password. Thank you.</p> -->
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr style="border-collapse:collapse;">
                                                                <td class="w580" width="580" height="10" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                                <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr style="border-collapse:collapse;">
                                <td class="w640" width="640" height="15" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                            </tr>
                            <tr style="border-collapse:collapse;">
                                <td class="w640" width="640" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;">
                                    <table id="footer" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#000000" style="border-radius:0px 0px 6px 6px;-moz-border-radius:0px 0px 6px 6px;-webkit-border-radius:0px 0px 6px 6px;-webkit-font-smoothing:antialiased;background-color:#000000;color:#888888;">
                                        <tbody>
                                            <tr style="border-collapse:collapse;">
                                                <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                                                <td class="w580 h0" width="360" height="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                                                <td class="w0" width="60" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                                                <td class="w0" width="160" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                                                <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                                            </tr>
                                            <tr style="border-collapse:collapse;">
                                                <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;padding-left: 20px;"></td>
                                                <td class="w580" width="90%" valign="top" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"> <span class="hide">                                              <p id="permission-reminder" align="left" class="footer-content-left" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;line-height:15px;color:#888888;margin-top:0px;margin-bottom:15px;white-space:normal;"><span>About Hay Group</span>
                                                    <br style="line-height:100%;"> <span>Hay Group is a global management consulting firm that works with leaders to transform strategy into reality. We develop talent, organize people to be more effective and motivate them to perform at their best.</span></p>
                                                    </span>
                                                    <p align="left" class="footer-content-left" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;line-height:15px;color:#888888;margin-top:0px;margin-bottom:15px;"><a style="color: #15c;">{ALT_BODY}</a></p>
                                                </td>
                                            </tr>
                                            <tr style="border-collapse:collapse;">
                                                <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                                                <td class="w580 h0" width="360" height="15" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                                                <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr style="border-collapse:collapse;">
                                <td class="w640" width="640" height="60" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>' WHERE `TEMPLATE_KEY` = 'ACTIVE_ACCOUNT';
-- QuangDV 
ALTER TABLE `t_company_assignment` ADD `ID_PRIMARY` tinyint NULL DEFAULT '0';
-- linh nx add column
ALTER TABLE `t_training_session`
ADD COLUMN `NM_SESSION_NAME` VARCHAR(50) NOT NULL AFTER `NM_SESSION`;
	
-- huytv 4/5/2015
ALTER TABLE `t_company_profile`
CHANGE COLUMN `ID_STATUS` `ID_STATUS` INT(11) NULL DEFAULT '0' AFTER `ID_LC3`;

ALTER TABLE `t_company_profile`
ADD COLUMN `TX_NOTES_1` VARCHAR(250) NULL DEFAULT NULL AFTER `ID_REPORT_TYPE`,
ADD COLUMN `TX_NOTES_2` VARCHAR(250) NULL DEFAULT NULL AFTER `TX_NOTES_1`,
ADD COLUMN `TX_NOTES_3` VARCHAR(250) NULL DEFAULT NULL AFTER `TX_NOTES_2`;

-- linhnx create table norm score

CREATE TABLE IF NOT EXISTS `t_norm_scores` (
	`DT_START` DATETIME NULL, `DT_END` DATETIME NULL,
	`ID_QUESTION` INT NULL,
	`S_SCORE` FLOAT NULL
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
;

-- linhnx alter table t_tracking
ALTER TABLE `t_tracking`
MODIFY COLUMN `ID_COMPANY` VARCHAR(50) NOT NULL COMMENT 'Company ID' FIRST;
ALTER TABLE `t_norm_scores`
MODIFY COLUMN `S_SCORE` VARCHAR(50) NULL DEFAULT NULL AFTER `ID_QUESTION`;

UPDATE `t_tracking` SET `ID_COMPANY` = CONCAT('CoID00', FLOOR(1+RAND()*(9)));

-- huytv

INSERT INTO `t_growth_stage` (`NM_TYPE`,`VALUE`) VALUES ('QUESTION_3','Leaders are focused on managing day-to-day activities and the commercial aspects of the business. People capability issues are attended to when the need arises. Usually through direct intervention by the business owner(s).');
INSERT INTO `t_growth_stage` (`NM_TYPE`,`VALUE`) VALUES ('QUESTION_3','Leaders recognize that people capability issues are a constraint
that needs to be controlled or it will affect the commercial aspects
of the business. Actions usually led by HR and/or the business
owner(s).');
INSERT INTO `t_growth_stage` (`NM_TYPE`,`VALUE`) VALUES ('QUESTION_3','Leaders see people capability issues as a key managerial
responsibility. The focus is on implementing the right processes to
avoid holding the business back or meeting the increasing needs of
business. Usually coordination or guidance support is provided to
business units by HR.');
INSERT INTO `t_growth_stage` (`NM_TYPE`,`VALUE`) VALUES ('QUESTION_3','Leaders see people capability issues as a key strategic resource
which requires deep investment. They seek to meet current and
future needs with involvement from all managers in partnership with
HR. Line managers are actively engaged in people matters.');
INSERT INTO `t_growth_stage` (`NM_TYPE`,`VALUE`) VALUES ('QUESTION_3','Leaders regard people capability as an integral part of the
competitive advantage of the business. Their approach in
addressing people capability issues is well-integrated with current
and future organisational needs. Usually with involvement of all
employees in leadership positions, in partnership with HR.');

-- linhnx update email template 6/5/2015

UPDATE `email_template` SET `TEMPLATE_SUBJECT`='HRMD: Request for User Name', `TEMPLATE_BODY` = '<!DOCTYPE html>
<html>
<head>
<title>HAY GROUP COMPANY</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=320, target-densitydpi=device-dpi">
<style type="text/css">
@media only screen and (max-width: 660px) {
table[class=w0], td[class=w0] {
  width: 0 !important;
}
table[class=w10], td[class=w10], img[class=w10] {
  width: 10px !important;
}
table[class=w15], td[class=w15], img[class=w15] {
  width: 5px !important;
}
table[class=w30], td[class=w30], img[class=w30] {
  width: 10px !important;
}
table[class=w60], td[class=w60], img[class=w60] {
  width: 10px !important;
}
table[class=w125], td[class=w125], img[class=w125] {
  width: 80px !important;
}
table[class=w130], td[class=w130], img[class=w130] {
  width: 55px !important;
}
table[class=w140], td[class=w140], img[class=w140] {
  width: 90px !important;
}
table[class=w160], td[class=w160], img[class=w160] {
  width: 180px !important;
}
table[class=w170], td[class=w170], img[class=w170] {
  width: 100px !important;
}
table[class=w180], td[class=w180], img[class=w180] {
  width: 80px !important;
}
table[class=w195], td[class=w195], img[class=w195] {
  width: 80px !important;
}
table[class=w220], td[class=w220], img[class=w220] {
  width: 80px !important;
}
table[class=w240], td[class=w240], img[class=w240] {
  width: 180px !important;
}
table[class=w255], td[class=w255], img[class=w255] {
  width: 185px !important;
}
table[class=w275], td[class=w275], img[class=w275] {
  width: 135px !important;
}
table[class=w280], td[class=w280], img[class=w280] {
  width: 135px !important;
}
table[class=w300], td[class=w300], img[class=w300] {
  width: 140px !important;
}
table[class=w325], td[class=w325], img[class=w325] {
  width: 95px !important;
}
table[class=w360], td[class=w360], img[class=w360] {
  width: 140px !important;
}
table[class=w410], td[class=w410], img[class=w410] {
  width: 180px !important;
}
table[class=w470], td[class=w470], img[class=w470] {
  width: 200px !important;
}
table[class=w580], td[class=w580], img[class=w580] {
  width: 280px !important;
}
table[class=w640], td[class=w640], img[class=w640] {
  width: 300px !important;
}
table[class*=hide], td[class*=hide], img[class*=hide], p[class*=hide], span[class*=hide] {
  display: none !important;
}
table[class=h0], td[class=h0] {
  height: 0 !important;
}
p[class=footer-content-left] {
  text-align: center !important;
}
#headline p {
  font-size: 30px !important;
}
.article-content, #left-sidebar {
  -webkit-text-size-adjust: 90% !important;
  -ms-text-size-adjust: 90% !important;
}
.header-content, .footer-content-left {
  -webkit-text-size-adjust: 80% !important;
  -ms-text-size-adjust: 80% !important;
}
img {
  height: auto;
  line-height: 100%;
}
}
#outlook a {
  padding: 0;
}
body {
  width: 100% !important;
}
.ReadMsgBody {
  width: 100%;
}
.ExternalClass {
  width: 100%;
  display: block !important;
}
body {
  background-color: #c7c7c7;
  margin: 0;
  padding: 0;
}
img {
  outline: none;
  text-decoration: none;
  display: block;
}
br, strong br, b br, em br, i br {
  line-height: 100%;
}
h1, h2, h3, h4, h5, h6 {
  line-height: 100% !important;
  -webkit-font-smoothing: antialiased;
}
h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {
  color: blue !important;
}
h1 a:active, h2 a:active, h3 a:active, h4 a:active, h5 a:active, h6 a:active {
  color: red !important;
}
h1 a:visited, h2 a:visited, h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited {
  color: purple !important;
}
table td, table tr {
  border-collapse: collapse;
}
.yshortcuts, .yshortcuts a, .yshortcuts a:link, .yshortcuts a:visited, .yshortcuts a:hover, .yshortcuts a span {
  color: black;
  text-decoration: none !important;
  border-bottom: none !important;
  background: none !important;
}
code {
  white-space: normal;
  word-break: break-all;
}
#background-table {
  background-color: #c7c7c7;
}
#top-bar {
  border-radius: 6px 6px 0px 0px;
  -moz-border-radius: 6px 6px 0px 0px;
  -webkit-border-radius: 6px 6px 0px 0px;
  -webkit-font-smoothing: antialiased;
  background-color: #2E2E2E;
  color: #888888;
}
#top-bar a {
  font-weight: bold;
  color: #eeeeee;
  text-decoration: none;
}
#footer {
  border-radius: 0px 0px 6px 6px;
  -moz-border-radius: 0px 0px 6px 6px;
  -webkit-border-radius: 0px 0px 6px 6px;
  -webkit-font-smoothing: antialiased;
}
body, td {
  font-family: HelveticaNeue, sans-serif;
}
.header-content, .footer-content-left, .footer-content-right {
  -webkit-text-size-adjust: none;
  -ms-text-size-adjust: none;
}
.header-content {
  font-size: 12px;
  color: #888888;
}
.header-content a {
  font-weight: bold;
  color: #eeeeee;
  text-decoration: none;
}
#headline p {
  color: #000c8f;
  font-family: HelveticaNeue, sans-serif;
  font-size: 36px;
  text-align: center;
  margin-top: 0px;
  margin-bottom: 30px;
}
#headline p a {
  color: #000c8f;
  text-decoration: none;
}
.article-title {
  font-size: 18px;
  line-height: 24px;
  color: #0f0080;
  font-weight: bold;
  margin-top: 0px;
  margin-bottom: 18px;
  font-family: HelveticaNeue, sans-serif;
}
.article-title a {
  color: #0f0080;
  text-decoration: none;
}
.article-title.with-meta {
  margin-bottom: 0;
}
.article-meta {
  font-size: 13px;
  line-height: 20px;
  color: #ccc;
  font-weight: bold;
  margin-top: 0;
}
.article-content {
  font-size: 13px;
  line-height: 18px;
  color: #444444;
  margin-top: 0px;
  margin-bottom: 18px;
  font-family: HelveticaNeue, sans-serif;
}
.article-content a {
  color: #2f82de;
  font-weight: bold;
  text-decoration: none;
}
.article-content img {
  max-width: 100%
}
.article-content ol, .article-content ul {
  margin-top: 0px;
  margin-bottom: 18px;
  margin-left: 19px;
  padding: 0;
}
.article-content li {
  font-size: 13px;
  line-height: 18px;
  color: #444444;
}
.article-content li a {
  color: #2f82de;
  text-decoration: underline;
}
.article-content p {
  margin-bottom: 15px;
}
.footer-content-left {
  font-size: 12px;
  line-height: 15px;
  color: #888888;
  margin-top: 0px;
  margin-bottom: 15px;
}
.footer-content-left a {
  color: #eeeeee;
  font-weight: bold;
  text-decoration: none;
}
.footer-content-right {
  font-size: 11px;
  line-height: 16px;
  color: #888888;
  margin-top: 0px;
  margin-bottom: 15px;
}
.footer-content-right a {
  color: #eeeeee;
  font-weight: bold;
  text-decoration: none;
}
#footer {
  background-color: #000000;
  color: #888888;
}
#footer a {
  color: #eeeeee;
  text-decoration: none;
  font-weight: bold;
}
#permission-reminder {
  white-space: normal;
}
#street-address {
  color: #ffffff;
  white-space: normal;
}
#email-footer{
    width: 1024 px !important;
}
</style>
<!--[if gte mso 9]>
<style _tmplitem="10222" >
.article-content ol, .article-content ul {
   margin: 0 0 0 24px !important;
   padding: 0 !important;
   list-style-position: inside !important;
}
</style>
<![endif]-->
<meta name="robots" content="noindex,nofollow">
<meta property="og:title" content="Hay Group">
</head>
<body style="width:100% !important;background-color:#c7c7c7;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:HelveticaNeue, sans-serif;">
<table width="100%" cellpadding="0" cellspacing="0" border="0" id="background-table" style="background-color:#c7c7c7;">
  <tbody>
    <tr style="border-collapse:collapse;">
      <td align="center" bgcolor="#c7c7c7" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w640" width="640" cellpadding="0" cellspacing="0" border="0" style="margin-top:0;margin-bottom:0;margin-right:10px;margin-left:10px;">
          <tbody>
            <tr style="border-collapse:collapse;">
              <td class="w640" width="640" height="20" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
            </tr>
            <tr style="border-collapse:collapse;">
              <td class="w640" width="640" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table id="top-bar" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" style="border-radius:6px 6px 0px 0px;-moz-border-radius:6px 6px 0px 0px;-webkit-border-radius:6px 6px 0px 0px;-webkit-font-smoothing:antialiased;background-color:#2E2E2E;color:#888888;">
                  <tbody>
                    <tr style="border-collapse:collapse;">
                      <td class="w15" width="15" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w325" width="350" valign="middle" align="left" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">
                          <tbody>
                            <tr style="border-collapse:collapse;">
                              <td class="w325" width="350" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                            </tr>
                          </tbody>
                        </table>
                        <div class="header-content" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;color:#888888;"><p style="font-weight:bold;color:#eeeeee;text-decoration:none">Home Page<span class="hide">&nbsp;&nbsp;|&nbsp;</span></p>
                        </div>
                        <table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">
                          <tbody>
                            <tr style="border-collapse:collapse;">
                              <td class="w325" width="350" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                            </tr>
                          </tbody>
                        </table></td>
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w255" width="255" valign="middle" align="right" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">
                          <tbody>
                            <tr style="border-collapse:collapse;">
                              <td class="w255" width="255" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                            </tr>
                          </tbody>
                        </table>
                        <table cellpadding="0" cellspacing="0" border="0">
                          <tbody>
                            <tr style="border-collapse:collapse;"> </tr>
                          </tbody>
                        </table>
                        <table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">
                          <tbody>
                            <tr style="border-collapse:collapse;">
                              <td class="w255" width="255" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                            </tr>
                          </tbody>
                        </table></td>
                      <td class="w15" width="15" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr style="border-collapse:collapse;">
              <td id="header" class="w640" width="640" align="center" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w640" width="640" cellpadding="0" cellspacing="0" border="0">
                  <tbody>
                    <tr style="border-collapse:collapse;">
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w580" width="580" height="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                    </tr>
                    <tr style="border-collapse:collapse;">
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w580" width="580" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><div align="center" id="headline">
                          <p style="color:#000c8f;font-family:HelveticaNeue, sans-serif;font-size:36px;text-align:center;margin-top:0px;margin-bottom:30px;"> <strong>Hay Group Company</strong> </p>
                        </div></td>
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr style="border-collapse:collapse;">
              <td class="w640" width="640" height="30" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
            </tr>
            <tr id="simple-content-row" style="border-collapse:collapse;">
              <td class="w640" width="640" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table align="left" class="w640" width="640" cellpadding="0" cellspacing="0" border="0">
                  <tbody>
                    <tr style="border-collapse:collapse;">
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w580" width="580" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w580" width="580" cellpadding="0" cellspacing="0" border="0">
                          <tbody>
                            <tr style="border-collapse:collapse;">
                              <td class="w580" width="580" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><p align="left" class="article-title" style="font-size:18px;line-height:24px;color:#0f0080;font-weight:bold;margin-top:0px;margin-bottom:18px;font-family:HelveticaNeue, sans-serif;">Request for User Name</p>
                                <div align="left" class="article-content" style="font-size:14px;line-height:14px;color:#444444;margin-top:0px;margin-bottom:18px;font-family:HelveticaNeue, sans-serif;">Hi,
                                <p>You or someone had submitted a request to retrieve your User Name for HRMD, please see your details below:</p>
                                </br>
                                <p>Username: <strong>{ID_LOGIN}</strong></p>
                                </br>
                                <p>Click<a href="{LINK_LOGIN}"><em> Here </em></a>to login</p>
                                <p>If you have not submitted this request, kindly ignore this email. Thank you.</p>
                                </div>
                              </td>
                            </tr>
                            <tr style="border-collapse:collapse;">
                              <td class="w580" width="580" height="10" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                            </tr>
                          </tbody>
                        </table></td>
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr style="border-collapse:collapse;">
              <td class="w640" width="640" height="15" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
            </tr>
            <tr style="border-collapse:collapse;">
              <td class="w640" width="640" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table id="footer" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#000000" style="border-radius:0px 0px 6px 6px;-moz-border-radius:0px 0px 6px 6px;-webkit-border-radius:0px 0px 6px 6px;-webkit-font-smoothing:antialiased;background-color:#000000;color:#888888;">
                  <tbody>
                    <tr style="border-collapse:collapse;">
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w580 h0" width="360" height="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w0" width="60" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w0" width="160" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                    </tr>
                    <tr style="border-collapse:collapse;">
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;padding-left: 20px;"></td>
                      <td class="w580" width="90%" valign="top" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><span class="hide">
                        <p id="permission-reminder" align="left" class="footer-content-left" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;line-height:15px;color:#888888;margin-top:0px;margin-bottom:15px;white-space:normal;"><span>About Hay Group</span><br style="line-height:100%;">
                          <span>Hay Group is a global management consulting firm that works with leaders to transform strategy into reality. We develop talent, organize people to be more effective and motivate them to perform at their best.</span></p>
                        </span>
                        <p align="left" class="footer-content-left" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;line-height:15px;color:#888888;margin-top:0px;margin-bottom:15px;"><a style="color: #15c;">{ALT_BODY}</a> |</p></td>
                    </tr>
                    <tr style="border-collapse:collapse;">
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w580 h0" width="360" height="15" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr style="border-collapse:collapse;">
              <td class="w640" width="640" height="60" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
            </tr>
          </tbody>
        </table></td>
    </tr>
  </tbody>
</table>
</body>
</html>' WHERE  `ID`=2;
UPDATE `email_template` SET `TEMPLATE_SUBJECT`='HRMD: Request for Password Reset', `TEMPLATE_BODY` = '<!DOCTYPE html>
<html>
<head>
<title>HAY GROUP COMPANY</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=320, target-densitydpi=device-dpi">
<style type="text/css">
@media only screen and (max-width: 660px) {
table[class=w0], td[class=w0] {
  width: 0 !important;
}
table[class=w10], td[class=w10], img[class=w10] {
  width: 10px !important;
}
table[class=w15], td[class=w15], img[class=w15] {
  width: 5px !important;
}
table[class=w30], td[class=w30], img[class=w30] {
  width: 10px !important;
}
table[class=w60], td[class=w60], img[class=w60] {
  width: 10px !important;
}
table[class=w125], td[class=w125], img[class=w125] {
  width: 80px !important;
}
table[class=w130], td[class=w130], img[class=w130] {
  width: 55px !important;
}
table[class=w140], td[class=w140], img[class=w140] {
  width: 90px !important;
}
table[class=w160], td[class=w160], img[class=w160] {
  width: 180px !important;
}
table[class=w170], td[class=w170], img[class=w170] {
  width: 100px !important;
}
table[class=w180], td[class=w180], img[class=w180] {
  width: 80px !important;
}
table[class=w195], td[class=w195], img[class=w195] {
  width: 80px !important;
}
table[class=w220], td[class=w220], img[class=w220] {
  width: 80px !important;
}
table[class=w240], td[class=w240], img[class=w240] {
  width: 180px !important;
}
table[class=w255], td[class=w255], img[class=w255] {
  width: 185px !important;
}
table[class=w275], td[class=w275], img[class=w275] {
  width: 135px !important;
}
table[class=w280], td[class=w280], img[class=w280] {
  width: 135px !important;
}
table[class=w300], td[class=w300], img[class=w300] {
  width: 140px !important;
}
table[class=w325], td[class=w325], img[class=w325] {
  width: 95px !important;
}
table[class=w360], td[class=w360], img[class=w360] {
  width: 140px !important;
}
table[class=w410], td[class=w410], img[class=w410] {
  width: 180px !important;
}
table[class=w470], td[class=w470], img[class=w470] {
  width: 200px !important;
}
table[class=w580], td[class=w580], img[class=w580] {
  width: 280px !important;
}
table[class=w640], td[class=w640], img[class=w640] {
  width: 300px !important;
}
table[class*=hide], td[class*=hide], img[class*=hide], p[class*=hide], span[class*=hide] {
  display: none !important;
}
table[class=h0], td[class=h0] {
  height: 0 !important;
}
p[class=footer-content-left] {
  text-align: center !important;
}
#headline p {
  font-size: 30px !important;
}
.article-content, #left-sidebar {
  -webkit-text-size-adjust: 90% !important;
  -ms-text-size-adjust: 90% !important;
}
.header-content, .footer-content-left {
  -webkit-text-size-adjust: 80% !important;
  -ms-text-size-adjust: 80% !important;
}
img {
  height: auto;
  line-height: 100%;
}
}
#outlook a {
  padding: 0;
}
body {
  width: 100% !important;
}
.ReadMsgBody {
  width: 100%;
}
.ExternalClass {
  width: 100%;
  display: block !important;
}
body {
  background-color: #c7c7c7;
  margin: 0;
  padding: 0;
}
img {
  outline: none;
  text-decoration: none;
  display: block;
}
br, strong br, b br, em br, i br {
  line-height: 100%;
}
h1, h2, h3, h4, h5, h6 {
  line-height: 100% !important;
  -webkit-font-smoothing: antialiased;
}
h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {
  color: blue !important;
}
h1 a:active, h2 a:active, h3 a:active, h4 a:active, h5 a:active, h6 a:active {
  color: red !important;
}
h1 a:visited, h2 a:visited, h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited {
  color: purple !important;
}
table td, table tr {
  border-collapse: collapse;
}
.yshortcuts, .yshortcuts a, .yshortcuts a:link, .yshortcuts a:visited, .yshortcuts a:hover, .yshortcuts a span {
  color: black;
  text-decoration: none !important;
  border-bottom: none !important;
  background: none !important;
}
code {
  white-space: normal;
  word-break: break-all;
}
#background-table {
  background-color: #c7c7c7;
}
#top-bar {
  border-radius: 6px 6px 0px 0px;
  -moz-border-radius: 6px 6px 0px 0px;
  -webkit-border-radius: 6px 6px 0px 0px;
  -webkit-font-smoothing: antialiased;
  background-color: #2E2E2E;
  color: #888888;
}
#top-bar a {
  font-weight: bold;
  color: #eeeeee;
  text-decoration: none;
}
#footer {
  border-radius: 0px 0px 6px 6px;
  -moz-border-radius: 0px 0px 6px 6px;
  -webkit-border-radius: 0px 0px 6px 6px;
  -webkit-font-smoothing: antialiased;
}
body, td {
  font-family: HelveticaNeue, sans-serif;
}
.header-content, .footer-content-left, .footer-content-right {
  -webkit-text-size-adjust: none;
  -ms-text-size-adjust: none;
}
.header-content {
  font-size: 12px;
  color: #888888;
}
.header-content a {
  font-weight: bold;
  color: #eeeeee;
  text-decoration: none;
}
#headline p {
  color: #000c8f;
  font-family: HelveticaNeue, sans-serif;
  font-size: 36px;
  text-align: center;
  margin-top: 0px;
  margin-bottom: 30px;
}
#headline p a {
  color: #000c8f;
  text-decoration: none;
}
.article-title {
  font-size: 18px;
  line-height: 24px;
  color: #0f0080;
  font-weight: bold;
  margin-top: 0px;
  margin-bottom: 18px;
  font-family: HelveticaNeue, sans-serif;
}
.article-title a {
  color: #0f0080;
  text-decoration: none;
}
.article-title.with-meta {
  margin-bottom: 0;
}
.article-meta {
  font-size: 13px;
  line-height: 20px;
  color: #ccc;
  font-weight: bold;
  margin-top: 0;
}
.article-content {
  font-size: 13px;
  line-height: 18px;
  color: #444444;
  margin-top: 0px;
  margin-bottom: 18px;
  font-family: HelveticaNeue, sans-serif;
}
.article-content a {
  color: #2f82de;
  font-weight: bold;
  text-decoration: none;
}
.article-content img {
  max-width: 100%
}
.article-content ol, .article-content ul {
  margin-top: 0px;
  margin-bottom: 18px;
  margin-left: 19px;
  padding: 0;
}
.article-content li {
  font-size: 13px;
  line-height: 18px;
  color: #444444;
}
.article-content li a {
  color: #2f82de;
  text-decoration: underline;
}
.article-content p {
  margin-bottom: 15px;
}
.footer-content-left {
  font-size: 12px;
  line-height: 15px;
  color: #888888;
  margin-top: 0px;
  margin-bottom: 15px;
}
.footer-content-left a {
  color: #eeeeee;
  font-weight: bold;
  text-decoration: none;
}
.footer-content-right {
  font-size: 11px;
  line-height: 16px;
  color: #888888;
  margin-top: 0px;
  margin-bottom: 15px;
}
.footer-content-right a {
  color: #eeeeee;
  font-weight: bold;
  text-decoration: none;
}
#footer {
  background-color: #000000;
  color: #888888;
}
#footer a {
  color: #eeeeee;
  text-decoration: none;
  font-weight: bold;
}
#permission-reminder {
  white-space: normal;
}
#street-address {
  color: #ffffff;
  white-space: normal;
}
#email-footer{
    width: 1024 px !important;
}
</style>
<!--[if gte mso 9]>
<style _tmplitem="10222" >
.article-content ol, .article-content ul {
   margin: 0 0 0 24px !important;
   padding: 0 !important;
   list-style-position: inside !important;
}
</style>
<![endif]-->
<meta name="robots" content="noindex,nofollow">
<meta property="og:title" content="Hay Group">
</head>
<body style="width:100% !important;background-color:#c7c7c7;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:HelveticaNeue, sans-serif;">
<table width="100%" cellpadding="0" cellspacing="0" border="0" id="background-table" style="background-color:#c7c7c7;">
  <tbody>
    <tr style="border-collapse:collapse;">
      <td align="center" bgcolor="#c7c7c7" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w640" width="640" cellpadding="0" cellspacing="0" border="0" style="margin-top:0;margin-bottom:0;margin-right:10px;margin-left:10px;">
          <tbody>
            <tr style="border-collapse:collapse;">
              <td class="w640" width="640" height="20" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
            </tr>
            <tr style="border-collapse:collapse;">
              <td class="w640" width="640" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table id="top-bar" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" style="border-radius:6px 6px 0px 0px;-moz-border-radius:6px 6px 0px 0px;-webkit-border-radius:6px 6px 0px 0px;-webkit-font-smoothing:antialiased;background-color:#2E2E2E;color:#888888;">
                  <tbody>
                    <tr style="border-collapse:collapse;">
                      <td class="w15" width="15" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w325" width="350" valign="middle" align="left" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">
                          <tbody>
                            <tr style="border-collapse:collapse;">
                              <td class="w325" width="350" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                            </tr>
                          </tbody>
                        </table>
                        <div class="header-content" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;color:#888888;"><p style="font-weight:bold;color:#eeeeee;text-decoration:none">Home Page<span class="hide">&nbsp;&nbsp;|&nbsp;</span></p>
                        </div>
                        <table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">
                          <tbody>
                            <tr style="border-collapse:collapse;">
                              <td class="w325" width="350" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                            </tr>
                          </tbody>
                        </table></td>
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w255" width="255" valign="middle" align="right" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">
                          <tbody>
                            <tr style="border-collapse:collapse;">
                              <td class="w255" width="255" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                            </tr>
                          </tbody>
                        </table>
                        <table cellpadding="0" cellspacing="0" border="0">
                          <tbody>
                            <tr style="border-collapse:collapse;"> </tr>
                          </tbody>
                        </table>
                        <table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">
                          <tbody>
                            <tr style="border-collapse:collapse;">
                              <td class="w255" width="255" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                            </tr>
                          </tbody>
                        </table></td>
                      <td class="w15" width="15" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr style="border-collapse:collapse;">
              <td id="header" class="w640" width="640" align="center" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w640" width="640" cellpadding="0" cellspacing="0" border="0">
                  <tbody>
                    <tr style="border-collapse:collapse;">
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w580" width="580" height="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                    </tr>
                    <tr style="border-collapse:collapse;">
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w580" width="580" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><div align="center" id="headline">
                          <p style="color:#000c8f;font-family:HelveticaNeue, sans-serif;font-size:36px;text-align:center;margin-top:0px;margin-bottom:30px;"> <strong>Hay Group Company</strong> </p>
                        </div></td>
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr style="border-collapse:collapse;">
              <td class="w640" width="640" height="30" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
            </tr>
            <tr id="simple-content-row" style="border-collapse:collapse;">
              <td class="w640" width="640" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table align="left" class="w640" width="640" cellpadding="0" cellspacing="0" border="0">
                  <tbody>
                    <tr style="border-collapse:collapse;">
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w580" width="580" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w580" width="580" cellpadding="0" cellspacing="0" border="0">
                          <tbody>
                            <tr style="border-collapse:collapse;">
                              <td class="w580" width="580" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><p align="left" class="article-title" style="font-size:18px;line-height:24px;color:#0f0080;font-weight:bold;margin-top:0px;margin-bottom:18px;font-family:HelveticaNeue, sans-serif;">Request for Password Reset</p>
                                <div align="left" class="article-content" style="font-size:14px;line-height:14px;color:#444444;margin-top:0px;margin-bottom:18px;font-family:HelveticaNeue, sans-serif;">Hi <strong>{TX_USERNAME}</strong>,
                                <p>You have requested to reset the password for the following account:</p>
                                </br>
                                <p>Username: <strong>{TX_USERNAME}</strong></p>
                                </br>
                                 <p>Generated Password: <strong>{TX_SECURITY_CODE}</strong></p>
                                <p>Click<a href="{LINK_CHANGEPASSWORD}"><em> Here </em></a>to confirm change password</p>
                                <p>To reset the password, please go to the <a href="{LOGIN_PAGE}"><em> login page </em></a> and login with the given password. Upon login, you will be prompted to reset your password. Thank you.</p>
                                </div>
                              </td>
                            </tr>
                            <tr style="border-collapse:collapse;">
                              <td class="w580" width="580" height="10" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                            </tr>
                          </tbody>
                        </table></td>
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr style="border-collapse:collapse;">
              <td class="w640" width="640" height="15" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
            </tr>
            <tr style="border-collapse:collapse;">
              <td class="w640" width="640" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table id="footer" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#000000" style="border-radius:0px 0px 6px 6px;-moz-border-radius:0px 0px 6px 6px;-webkit-border-radius:0px 0px 6px 6px;-webkit-font-smoothing:antialiased;background-color:#000000;color:#888888;">
                  <tbody>
                    <tr style="border-collapse:collapse;">
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w580 h0" width="360" height="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w0" width="60" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w0" width="160" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                    </tr>
                    <tr style="border-collapse:collapse;">
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;padding-left: 20px;"></td>
                      <td class="w580" width="90%" valign="top" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><span class="hide">
                        <p id="permission-reminder" align="left" class="footer-content-left" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;line-height:15px;color:#888888;margin-top:0px;margin-bottom:15px;white-space:normal;"><span>About Hay Group</span><br style="line-height:100%;">
                          <span>Hay Group is a global management consulting firm that works with leaders to transform strategy into reality. We develop talent, organize people to be more effective and motivate them to perform at their best.</span></p>
                        </span>
                        <p align="left" class="footer-content-left" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;line-height:15px;color:#888888;margin-top:0px;margin-bottom:15px;"><a style="color: #15c;">{ALT_BODY}</a> |</p></td>
                    </tr>
                    <tr style="border-collapse:collapse;">
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w580 h0" width="360" height="15" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr style="border-collapse:collapse;">
              <td class="w640" width="640" height="60" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
            </tr>
          </tbody>
        </table></td>
    </tr>
  </tbody>
</table>
</body>
</html>' WHERE  `ID`=3;

-- 06/05/2015 QuangDV
ALTER TABLE `t_tracking`
  ADD COLUMN `ID_TRACKING` INT(11) NOT NULL AUTO_INCREMENT FIRST,
  ADD PRIMARY KEY (`ID_TRACKING`),
  ADD INDEX `ID_TRACKING` (`ID_TRACKING`);

-- linhnx alter table t_tracking add ID_PROFILE column
ALTER TABLE `t_tracking`
	ADD COLUMN `ID_PROFILE` VARCHAR(50) NOT NULL AFTER `ID_COMPANY`;
-- huytv delete some column in t_company_info
ALTER TABLE `t_company_info`
DROP COLUMN `ID_STATUS`,
DROP COLUMN `ID_FAMILY_OWNED`,
DROP COLUMN `N_REVENUE`,
DROP COLUMN `N_STAFF_SIZE`,
DROP COLUMN `N_HR_SIZE`,
DROP COLUMN `NM_INDUSTRY`,
DROP COLUMN `NM_TYPE`,
DROP COLUMN `ID_GS1`,
DROP COLUMN `ID_GS2`;
-- huytv modify t_growth_stage

INSERT INTO `t_growth_stage` (`NM_TYPE`, `VALUE`) VALUES ('QUESTION_2', 'The owner and business are quite separate, both financially and \r\noperationally. Experienced and professional staff operates with \r\nhigh degree of autonomy.');

UPDATE `t_growth_stage` SET `VALUE`='The company has a workable business model but is concerned \r\nwith the ability to generate enough cash to break even (and to \r\ncover repair/ replacement of capital assets as they wear out) or \r\nscale up to a viable size.' WHERE  `ID_GS`=1;

UPDATE `t_growth_stage` SET `VALUE`='The company is profitable and the objective is to keep it stable
without additional risks or investments. The management is
concerned with keeping the status quo for as long as possible.' WHERE  `ID_GS`=2;

UPDATE `t_growth_stage` SET `VALUE`='The company is profitable and the objective is to consolidate and
shore up financial resources (including securing additional funds
or loans) so as to be able to expand. There is the decision to take
the risk/ challenge to “go big”.' WHERE  `ID_GS`=3;

UPDATE `t_growth_stage` SET `VALUE`='The company is currently expanding rapidly. It is investing and
trying to balance control and the desire to grow. It is concerned
with managing its cash and operations prudently to avoid
expanding too fast with emphasis on improving its systems.' WHERE  `ID_GS`=4;

UPDATE `t_growth_stage` SET `VALUE`='The company has attained substantial size, finances and
managerial talent. It is trying to control the financial gains and
consolidate by professionalizing its systems and tools. It is
concerned with how to preserve its agility, innovation and
entrepreneurial spirit.' WHERE  `ID_GS`=5;

UPDATE `t_growth_stage` SET `VALUE`='The owner manages everyone and everything.' WHERE  `ID_GS`=6;

UPDATE `t_growth_stage` SET `VALUE`='The owner is still synonymous with the business. Sales or general
manager carries out well-defined orders of the owner.' WHERE  `ID_GS`=7;

UPDATE `t_growth_stage` SET `VALUE`='Functional managers take over certain duties of the owner.
e.g. Financial Controller taking over financial matters.' WHERE  `ID_GS`=8;

UPDATE `t_growth_stage` SET `VALUE`='The owner and business are reasonably separate but owner
presence & stock control are still strong. There are competent key
managers in place.' WHERE  `ID_GS`=9;

-- LINHNX add column

ALTER TABLE `t_gap_analysis_matrix`
	ADD COLUMN `TO_BE_SCORE` TINYINT(4) NOT NULL AFTER `IN_SCORE`;

-- linhnx update email template
UPDATE `email_template` SET `TEMPLATE_BODY`='<!DOCTYPE html>
<html>
<head>
<title>HAY GROUP COMPANY</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=320, target-densitydpi=device-dpi">
<style type="text/css">
@media only screen and (max-width: 660px) {
table[class=w0], td[class=w0] {
  width: 0 !important;
}
table[class=w10], td[class=w10], img[class=w10] {
  width: 10px !important;
}
table[class=w15], td[class=w15], img[class=w15] {
  width: 5px !important;
}
table[class=w30], td[class=w30], img[class=w30] {
  width: 10px !important;
}
table[class=w60], td[class=w60], img[class=w60] {
  width: 10px !important;
}
table[class=w125], td[class=w125], img[class=w125] {
  width: 80px !important;
}
table[class=w130], td[class=w130], img[class=w130] {
  width: 55px !important;
}
table[class=w140], td[class=w140], img[class=w140] {
  width: 90px !important;
}
table[class=w160], td[class=w160], img[class=w160] {
  width: 180px !important;
}
table[class=w170], td[class=w170], img[class=w170] {
  width: 100px !important;
}
table[class=w180], td[class=w180], img[class=w180] {
  width: 80px !important;
}
table[class=w195], td[class=w195], img[class=w195] {
  width: 80px !important;
}
table[class=w220], td[class=w220], img[class=w220] {
  width: 80px !important;
}
table[class=w240], td[class=w240], img[class=w240] {
  width: 180px !important;
}
table[class=w255], td[class=w255], img[class=w255] {
  width: 185px !important;
}
table[class=w275], td[class=w275], img[class=w275] {
  width: 135px !important;
}
table[class=w280], td[class=w280], img[class=w280] {
  width: 135px !important;
}
table[class=w300], td[class=w300], img[class=w300] {
  width: 140px !important;
}
table[class=w325], td[class=w325], img[class=w325] {
  width: 95px !important;
}
table[class=w360], td[class=w360], img[class=w360] {
  width: 140px !important;
}
table[class=w410], td[class=w410], img[class=w410] {
  width: 180px !important;
}
table[class=w470], td[class=w470], img[class=w470] {
  width: 200px !important;
}
table[class=w580], td[class=w580], img[class=w580] {
  width: 280px !important;
}
table[class=w640], td[class=w640], img[class=w640] {
  width: 300px !important;
}
table[class*=hide], td[class*=hide], img[class*=hide], p[class*=hide], span[class*=hide] {
  display: none !important;
}
table[class=h0], td[class=h0] {
  height: 0 !important;
}
p[class=footer-content-left] {
  text-align: center !important;
}
#headline p {
  font-size: 30px !important;
}
.article-content, #left-sidebar {
  -webkit-text-size-adjust: 90% !important;
  -ms-text-size-adjust: 90% !important;
}
.header-content, .footer-content-left {
  -webkit-text-size-adjust: 80% !important;
  -ms-text-size-adjust: 80% !important;
}
img {
  height: auto;
  line-height: 100%;
}
}
#outlook a {
  padding: 0;
}
body {
  width: 100% !important;
}
.ReadMsgBody {
  width: 100%;
}
.ExternalClass {
  width: 100%;
  display: block !important;
}
body {
  background-color: #c7c7c7;
  margin: 0;
  padding: 0;
}
img {
  outline: none;
  text-decoration: none;
  display: block;
}
br, strong br, b br, em br, i br {
  line-height: 100%;
}
h1, h2, h3, h4, h5, h6 {
  line-height: 100% !important;
  -webkit-font-smoothing: antialiased;
}
h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {
  color: blue !important;
}
h1 a:active, h2 a:active, h3 a:active, h4 a:active, h5 a:active, h6 a:active {
  color: red !important;
}
h1 a:visited, h2 a:visited, h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited {
  color: purple !important;
}
table td, table tr {
  border-collapse: collapse;
}
.yshortcuts, .yshortcuts a, .yshortcuts a:link, .yshortcuts a:visited, .yshortcuts a:hover, .yshortcuts a span {
  color: black;
  text-decoration: none !important;
  border-bottom: none !important;
  background: none !important;
}
code {
  white-space: normal;
  word-break: break-all;
}
#background-table {
  background-color: #c7c7c7;
}
#top-bar {
  border-radius: 6px 6px 0px 0px;
  -moz-border-radius: 6px 6px 0px 0px;
  -webkit-border-radius: 6px 6px 0px 0px;
  -webkit-font-smoothing: antialiased;
  background-color: #2E2E2E;
  color: #888888;
}
#top-bar a {
  font-weight: bold;
  color: #eeeeee;
  text-decoration: none;
}
#footer {
  border-radius: 0px 0px 6px 6px;
  -moz-border-radius: 0px 0px 6px 6px;
  -webkit-border-radius: 0px 0px 6px 6px;
  -webkit-font-smoothing: antialiased;
}
body, td {
  font-family: HelveticaNeue, sans-serif;
}
.header-content, .footer-content-left, .footer-content-right {
  -webkit-text-size-adjust: none;
  -ms-text-size-adjust: none;
}
.header-content {
  font-size: 12px;
  color: #888888;
}
.header-content a {
  font-weight: bold;
  color: #eeeeee;
  text-decoration: none;
}
#headline p {
  color: #000c8f;
  font-family: HelveticaNeue, sans-serif;
  font-size: 36px;
  text-align: center;
  margin-top: 0px;
  margin-bottom: 30px;
}
#headline p a {
  color: #000c8f;
  text-decoration: none;
}
.article-title {
  font-size: 18px;
  line-height: 24px;
  color: #0f0080;
  font-weight: bold;
  margin-top: 0px;
  margin-bottom: 18px;
  font-family: HelveticaNeue, sans-serif;
}
.article-title a {
  color: #0f0080;
  text-decoration: none;
}
.article-title.with-meta {
  margin-bottom: 0;
}
.article-meta {
  font-size: 13px;
  line-height: 20px;
  color: #ccc;
  font-weight: bold;
  margin-top: 0;
}
.article-content {
  font-size: 13px;
  line-height: 18px;
  color: #444444;
  margin-top: 0px;
  margin-bottom: 18px;
  font-family: HelveticaNeue, sans-serif;
}
.article-content a {
  color: #2f82de;
  font-weight: bold;
  text-decoration: none;
}
.article-content img {
  max-width: 100%
}
.article-content ol, .article-content ul {
  margin-top: 0px;
  margin-bottom: 18px;
  margin-left: 19px;
  padding: 0;
}
.article-content li {
  font-size: 13px;
  line-height: 18px;
  color: #444444;
}
.article-content li a {
  color: #2f82de;
  text-decoration: underline;
}
.article-content p {
  margin-bottom: 15px;
}
.footer-content-left {
  font-size: 12px;
  line-height: 15px;
  color: #888888;
  margin-top: 0px;
  margin-bottom: 15px;
}
.footer-content-left a {
  color: #eeeeee;
  font-weight: bold;
  text-decoration: none;
}
.footer-content-right {
  font-size: 11px;
  line-height: 16px;
  color: #888888;
  margin-top: 0px;
  margin-bottom: 15px;
}
.footer-content-right a {
  color: #eeeeee;
  font-weight: bold;
  text-decoration: none;
}
#footer {
  background-color: #000000;
  color: #888888;
}
#footer a {
  color: #eeeeee;
  text-decoration: none;
  font-weight: bold;
}
#permission-reminder {
  white-space: normal;
}
#street-address {
  color: #ffffff;
  white-space: normal;
}
#email-footer{
    width: 1024 px !important;
}
</style>
<!--[if gte mso 9]>
<style _tmplitem="10222" >
.article-content ol, .article-content ul {
   margin: 0 0 0 24px !important;
   padding: 0 !important;
   list-style-position: inside !important;
}
</style>
<![endif]-->
<meta name="robots" content="noindex,nofollow">
<meta property="og:title" content="Hay Group">
</head>
<body style="width:100% !important;background-color:#c7c7c7;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:HelveticaNeue, sans-serif;">
<table width="100%" cellpadding="0" cellspacing="0" border="0" id="background-table" style="background-color:#c7c7c7;">
  <tbody>
    <tr style="border-collapse:collapse;">
      <td align="center" bgcolor="#c7c7c7" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w640" width="640" cellpadding="0" cellspacing="0" border="0" style="margin-top:0;margin-bottom:0;margin-right:10px;margin-left:10px;">
          <tbody>
            <tr style="border-collapse:collapse;">
              <td class="w640" width="640" height="20" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
            </tr>
            <tr style="border-collapse:collapse;">
              <td class="w640" width="640" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table id="top-bar" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" style="border-radius:6px 6px 0px 0px;-moz-border-radius:6px 6px 0px 0px;-webkit-border-radius:6px 6px 0px 0px;-webkit-font-smoothing:antialiased;background-color:#2E2E2E;color:#888888;">
                  <tbody>
                    <tr style="border-collapse:collapse;">
                      <td class="w15" width="15" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w325" width="350" valign="middle" align="left" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">
                          <tbody>
                            <tr style="border-collapse:collapse;">
                              <td class="w325" width="350" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                            </tr>
                          </tbody>
                        </table>
                        <div class="header-content" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;color:#888888;"><p style="font-weight:bold;color:#eeeeee;text-decoration:none">Home Page<span class="hide">&nbsp;&nbsp;|&nbsp;</span></p>
                        </div>
                        <table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">
                          <tbody>
                            <tr style="border-collapse:collapse;">
                              <td class="w325" width="350" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                            </tr>
                          </tbody>
                        </table></td>
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w255" width="255" valign="middle" align="right" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">
                          <tbody>
                            <tr style="border-collapse:collapse;">
                              <td class="w255" width="255" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                            </tr>
                          </tbody>
                        </table>
                        <table cellpadding="0" cellspacing="0" border="0">
                          <tbody>
                            <tr style="border-collapse:collapse;"> </tr>
                          </tbody>
                        </table>
                        <table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">
                          <tbody>
                            <tr style="border-collapse:collapse;">
                              <td class="w255" width="255" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                            </tr>
                          </tbody>
                        </table></td>
                      <td class="w15" width="15" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr style="border-collapse:collapse;">
              <td id="header" class="w640" width="640" align="center" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w640" width="640" cellpadding="0" cellspacing="0" border="0">
                  <tbody>
                    <tr style="border-collapse:collapse;">
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w580" width="580" height="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                    </tr>
                    <tr style="border-collapse:collapse;">
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w580" width="580" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><div align="center" id="headline">
                          <p style="color:#000c8f;font-family:HelveticaNeue, sans-serif;font-size:36px;text-align:center;margin-top:0px;margin-bottom:30px;"> <strong>Hay Group Company</strong> </p>
                        </div></td>
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr style="border-collapse:collapse;">
              <td class="w640" width="640" height="30" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
            </tr>
            <tr id="simple-content-row" style="border-collapse:collapse;">
              <td class="w640" width="640" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table align="left" class="w640" width="640" cellpadding="0" cellspacing="0" border="0">
                  <tbody>
                    <tr style="border-collapse:collapse;">
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w580" width="580" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w580" width="580" cellpadding="0" cellspacing="0" border="0">
                          <tbody>
                            <tr style="border-collapse:collapse;">
                              <td class="w580" width="580" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><p align="left" class="article-title" style="font-size:18px;line-height:24px;color:#0f0080;font-weight:bold;margin-top:0px;margin-bottom:18px;font-family:HelveticaNeue, sans-serif;">Request Retrieve Password</p>
                                <div align="left" class="article-content" style="font-size:14px;line-height:14px;color:#444444;margin-top:0px;margin-bottom:18px;font-family:HelveticaNeue, sans-serif;">Hi <strong>{TX_USERNAME}</strong>,
                                <p>You have requested to reset the password for the following account:</p>
                                </br>
                                <p>Username: <strong>{TX_USERNAME}</strong></p>
                                </br>
                                 <p>Generated Password: <strong>{TX_SECURITY_CODE}</strong></p>
                                <p>Click<a href="{LINK_CHANGEPASSWORD}"><em> Here </em></a>to confirm change password</p>
                                </div>
                              </td>
                            </tr>
                            <tr style="border-collapse:collapse;">
                              <td class="w580" width="580" height="10" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                            </tr>
                          </tbody>
                        </table></td>
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr style="border-collapse:collapse;">
              <td class="w640" width="640" height="15" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
            </tr>
            <tr style="border-collapse:collapse;">
              <td class="w640" width="640" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table id="footer" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#000000" style="border-radius:0px 0px 6px 6px;-moz-border-radius:0px 0px 6px 6px;-webkit-border-radius:0px 0px 6px 6px;-webkit-font-smoothing:antialiased;background-color:#000000;color:#888888;">
                  <tbody>
                    <tr style="border-collapse:collapse;">
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w580 h0" width="360" height="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w0" width="60" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w0" width="160" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                    </tr>
                    <tr style="border-collapse:collapse;">
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;padding-left: 20px;"></td>
                      <td class="w580" width="90%" valign="top" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><span class="hide">
                        <p id="permission-reminder" align="left" class="footer-content-left" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;line-height:15px;color:#888888;margin-top:0px;margin-bottom:15px;white-space:normal;"><span>About Hay Group</span><br style="line-height:100%;">
                          <span>Hay Group is a global management consulting firm that works with leaders to transform strategy into reality. We develop talent, organize people to be more effective and motivate them to perform at their best.</span></p>
                        </span>
                        <p align="left" class="footer-content-left" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;line-height:15px;color:#888888;margin-top:0px;margin-bottom:15px;"><a style="color: #15c;">{ALT_BODY}</a> |</p></td>
                    </tr>
                    <tr style="border-collapse:collapse;">
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w580 h0" width="360" height="15" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr style="border-collapse:collapse;">
              <td class="w640" width="640" height="60" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
            </tr>
          </tbody>
        </table></td>
    </tr>
  </tbody>
</table>
</body>
</html>' WHERE  `ID`=3;
-- QuangDV : 12/05/2015
TRUNCATE `t_survey_benchmark_dtl`;
ALTER TABLE `t_survey_benchmark_dtl` AUTO_INCREMENT=1;
INSERT INTO `t_survey_benchmark_dtl` (`ID`, `ID_MATURITY`, `NM_CATEGORY`, `ID_QUESTION`, `ID_ANSWER`) VALUES
  (1, 1, 'RECRUITMENT', 1, 1),
  (2, 1, 'RECRUITMENT', 2, 5),
  (3, 1, 'RECRUITMENT', 3, 9),
  (4, 1, 'HR MANAGEMENT', 4, 13),
  (5, 1, 'HR MANAGEMENT', 5, 17),
  (6, 1, 'HR MANAGEMENT', 6, 21),
  (7, 1, 'MANPOWER PLANNING', 7, 26),
  (8, 1, 'MANPOWER PLANNING', 8, 29),
  (9, 1, 'MANPOWER PLANNING', 9, 33),
  (10, 1, 'TRAINING & DEVELOPMENT', 10, 37),
  (11, 1, 'TRAINING & DEVELOPMENT', 11, 41),
  (12, 1, 'TRAINING & DEVELOPMENT', 12, 45),
  (13, 1, 'TRAINING & DEVELOPMENT', 13, 49),
  (14, 1, 'PERFORMANCE MANAGEMENT', 14, 53),
  (15, 1, 'PERFORMANCE MANAGEMENT', 15, 57),
  (16, 1, 'PERFORMANCE MANAGEMENT', 16, 61),
  (17, 1, 'PERFORMANCE MANAGEMENT', 17, 65),
  (18, 1, 'COMPENSATION & BENEFITS', 18, 69),
  (19, 1, 'COMPENSATION & BENEFITS', 19, 73),
  (20, 1, 'COMPENSATION & BENEFITS', 20, 77),
  (21, 1, 'TALENT MANAGEMENT & SUCCESSION PLANNING', 21, 81),
  (22, 1, 'TALENT MANAGEMENT & SUCCESSION PLANNING', 22, 85),
  (23, 1, 'TALENT MANAGEMENT & SUCCESSION PLANNING', 23, 89),
  (24, 1, 'ORGANIZATION CULTURE & CORE VALUES', 24, 93),
  (25, 1, 'ORGANIZATION CULTURE & CORE VALUES', 25, 97),
  (26, 1, 'ORGANIZATION CULTURE & CORE VALUES', 26, 101),
  (27, 1, 'EMPLOYEE ENGAGEMENT & COMMUNICATIONS', 27, 105),
  (28, 1, 'EMPLOYEE ENGAGEMENT & COMMUNICATIONS', 28, 109),
  (29, 1, 'EMPLOYEE VALUE PROPOSITION (EVP)', 29, 113),
  (30, 1, 'EMPLOYEE VALUE PROPOSITION (EVP)', 30, 117),
  (31, 1, 'EMPLOYEE VALUE PROPOSITION (EVP)', 31, 121),
  (32, 1, 'INTERNATIONAL MOBILITY', 32, 125),
  (33, 1, 'INTERNATIONAL MOBILITY', 33, 129),
  (34, 2, 'RECRUITMENT', 1, 2),
  (35, 2, 'RECRUITMENT', 2, 6),
  (36, 2, 'RECRUITMENT', 3, 10),
  (37, 2, 'HR MANAGEMENT', 4, 14),
  (38, 2, 'HR MANAGEMENT', 5, 17),
  (39, 2, 'HR MANAGEMENT', 6, 21),
  (40, 2, 'MANPOWER PLANNING', 7, 26),
  (41, 2, 'MANPOWER PLANNING', 8, 29),
  (42, 2, 'MANPOWER PLANNING', 9, 33),
  (43, 2, 'TRAINING & DEVELOPMENT', 10, 37),
  (44, 2, 'TRAINING & DEVELOPMENT', 11, 41),
  (45, 2, 'TRAINING & DEVELOPMENT', 12, 46),
  (46, 2, 'TRAINING & DEVELOPMENT', 13, 49),
  (47, 2, 'PERFORMANCE MANAGEMENT', 14, 54),
  (48, 2, 'PERFORMANCE MANAGEMENT', 15, 58),
  (49, 2, 'PERFORMANCE MANAGEMENT', 16, 61),
  (50, 2, 'PERFORMANCE MANAGEMENT', 17, 66),
  (51, 2, 'COMPENSATION & BENEFITS', 18, 70),
  (52, 2, 'COMPENSATION & BENEFITS', 19, 74),
  (53, 2, 'COMPENSATION & BENEFITS', 20, 78),
  (54, 2, 'TALENT MANAGEMENT & SUCCESSION PLANNING', 21, 81),
  (55, 2, 'TALENT MANAGEMENT & SUCCESSION PLANNING', 22, 85),
  (56, 2, 'TALENT MANAGEMENT & SUCCESSION PLANNING', 23, 89),
  (57, 2, 'ORGANIZATION CULTURE & CORE VALUES', 24, 93),
  (58, 2, 'ORGANIZATION CULTURE & CORE VALUES', 25, 97),
  (59, 2, 'ORGANIZATION CULTURE & CORE VALUES', 26, 101),
  (60, 2, 'EMPLOYEE ENGAGEMENT & COMMUNICATIONS', 27, 105),
  (61, 2, 'EMPLOYEE ENGAGEMENT & COMMUNICATIONS', 28, 109),
  (62, 2, 'EMPLOYEE VALUE PROPOSITION (EVP)', 29, 113),
  (63, 2, 'EMPLOYEE VALUE PROPOSITION (EVP)', 30, 117),
  (64, 2, 'EMPLOYEE VALUE PROPOSITION (EVP)', 31, 121),
  (65, 2, 'INTERNATIONAL MOBILITY', 32, 125),
  (66, 2, 'INTERNATIONAL MOBILITY', 33, 129),
  (67, 3, 'RECRUITMENT', 1, 3),
  (68, 3, 'RECRUITMENT', 2, 7),
  (69, 3, 'RECRUITMENT', 3, 11),
  (70, 3, 'HR MANAGEMENT', 4, 14),
  (71, 3, 'HR MANAGEMENT', 5, 18),
  (72, 3, 'HR MANAGEMENT', 6, 22),
  (73, 3, 'MANPOWER PLANNING', 7, 27),
  (74, 3, 'MANPOWER PLANNING', 8, 31),
  (75, 3, 'MANPOWER PLANNING', 9, 35),
  (76, 3, 'TRAINING & DEVELOPMENT', 10, 38),
  (77, 3, 'TRAINING & DEVELOPMENT', 11, 42),
  (78, 3, 'TRAINING & DEVELOPMENT', 12, 46),
  (79, 3, 'TRAINING & DEVELOPMENT', 13, 50),
  (80, 3, 'PERFORMANCE MANAGEMENT', 14, 55),
  (81, 3, 'PERFORMANCE MANAGEMENT', 15, 59),
  (82, 3, 'PERFORMANCE MANAGEMENT', 16, 63),
  (83, 3, 'PERFORMANCE MANAGEMENT', 17, 67),
  (84, 3, 'COMPENSATION & BENEFITS', 18, 71),
  (85, 3, 'COMPENSATION & BENEFITS', 19, 75),
  (86, 3, 'COMPENSATION & BENEFITS', 20, 79),
  (87, 3, 'TALENT MANAGEMENT & SUCCESSION PLANNING', 21, 82),
  (88, 3, 'TALENT MANAGEMENT & SUCCESSION PLANNING', 22, 87),
  (89, 3, 'TALENT MANAGEMENT & SUCCESSION PLANNING', 23, 91),
  (90, 3, 'ORGANIZATION CULTURE & CORE VALUES', 24, 94),
  (91, 3, 'ORGANIZATION CULTURE & CORE VALUES', 25, 98),
  (92, 3, 'ORGANIZATION CULTURE & CORE VALUES', 26, 102),
  (93, 3, 'EMPLOYEE ENGAGEMENT & COMMUNICATIONS', 27, 106),
  (94, 3, 'EMPLOYEE ENGAGEMENT & COMMUNICATIONS', 28, 110),
  (95, 3, 'EMPLOYEE VALUE PROPOSITION (EVP)', 29, 115),
  (96, 3, 'EMPLOYEE VALUE PROPOSITION (EVP)', 30, 119),
  (97, 3, 'EMPLOYEE VALUE PROPOSITION (EVP)', 31, 123),
  (98, 3, 'INTERNATIONAL MOBILITY', 32, 127),
  (99, 3, 'INTERNATIONAL MOBILITY', 33, 131),
  (100, 4, 'RECRUITMENT', 1, 3),
  (101, 4, 'RECRUITMENT', 2, 7),
  (102, 4, 'RECRUITMENT', 3, 11),
  (103, 4, 'HR MANAGEMENT', 4, 15),
  (104, 4, 'HR MANAGEMENT', 5, 19),
  (105, 4, 'HR MANAGEMENT', 6, 23),
  (106, 4, 'MANPOWER PLANNING', 7, 27),
  (107, 4, 'MANPOWER PLANNING', 8, 31),
  (108, 4, 'MANPOWER PLANNING', 9, 35),
  (109, 4, 'TRAINING & DEVELOPMENT', 10, 39),
  (110, 4, 'TRAINING & DEVELOPMENT', 11, 43),
  (111, 4, 'TRAINING & DEVELOPMENT', 12, 47),
  (112, 4, 'TRAINING & DEVELOPMENT', 13, 51),
  (113, 4, 'PERFORMANCE MANAGEMENT', 14, 55),
  (114, 4, 'PERFORMANCE MANAGEMENT', 15, 59),
  (115, 4, 'PERFORMANCE MANAGEMENT', 16, 63),
  (116, 4, 'PERFORMANCE MANAGEMENT', 17, 67),
  (117, 4, 'COMPENSATION & BENEFITS', 18, 71),
  (118, 4, 'COMPENSATION & BENEFITS', 19, 75),
  (119, 4, 'COMPENSATION & BENEFITS', 20, 79),
  (120, 4, 'TALENT MANAGEMENT & SUCCESSION PLANNING', 21, 83),
  (121, 4, 'TALENT MANAGEMENT & SUCCESSION PLANNING', 22, 87),
  (122, 4, 'TALENT MANAGEMENT & SUCCESSION PLANNING', 23, 91),
  (123, 4, 'ORGANIZATION CULTURE & CORE VALUES', 24, 95),
  (124, 4, 'ORGANIZATION CULTURE & CORE VALUES', 25, 99),
  (125, 4, 'ORGANIZATION CULTURE & CORE VALUES', 26, 103),
  (126, 4, 'EMPLOYEE ENGAGEMENT & COMMUNICATIONS', 27, 107),
  (127, 4, 'EMPLOYEE ENGAGEMENT & COMMUNICATIONS', 28, 111),
  (128, 4, 'EMPLOYEE VALUE PROPOSITION (EVP)', 29, 115),
  (129, 4, 'EMPLOYEE VALUE PROPOSITION (EVP)', 30, 119),
  (130, 4, 'EMPLOYEE VALUE PROPOSITION (EVP)', 31, 123),
  (131, 4, 'INTERNATIONAL MOBILITY', 32, 127),
  (132, 4, 'INTERNATIONAL MOBILITY', 33, 131),
  (133, 5, 'RECRUITMENT', 1, 4),
  (134, 5, 'RECRUITMENT', 2, 8),
  (135, 5, 'RECRUITMENT', 3, 12),
  (136, 5, 'HR MANAGEMENT', 4, 16),
  (137, 5, 'HR MANAGEMENT', 5, 20),
  (138, 5, 'HR MANAGEMENT', 6, 24),
  (139, 5, 'MANPOWER PLANNING', 7, 28),
  (140, 5, 'MANPOWER PLANNING', 8, 32),
  (141, 5, 'MANPOWER PLANNING', 9, 36),
  (142, 5, 'TRAINING & DEVELOPMENT', 10, 40),
  (143, 5, 'TRAINING & DEVELOPMENT', 11, 44),
  (144, 5, 'TRAINING & DEVELOPMENT', 12, 48),
  (145, 5, 'TRAINING & DEVELOPMENT', 13, 52),
  (146, 5, 'PERFORMANCE MANAGEMENT', 14, 56),
  (147, 5, 'PERFORMANCE MANAGEMENT', 15, 60),
  (148, 5, 'PERFORMANCE MANAGEMENT', 16, 64),
  (149, 5, 'PERFORMANCE MANAGEMENT', 17, 68),
  (150, 5, 'COMPENSATION & BENEFITS', 18, 72),
  (151, 5, 'COMPENSATION & BENEFITS', 19, 76),
  (152, 5, 'COMPENSATION & BENEFITS', 20, 80),
  (153, 5, 'TALENT MANAGEMENT & SUCCESSION PLANNING', 21, 84),
  (154, 5, 'TALENT MANAGEMENT & SUCCESSION PLANNING', 22, 88),
  (155, 5, 'TALENT MANAGEMENT & SUCCESSION PLANNING', 23, 92),
  (156, 5, 'ORGANIZATION CULTURE & CORE VALUES', 24, 96),
  (157, 5, 'ORGANIZATION CULTURE & CORE VALUES', 25, 100),
  (158, 5, 'ORGANIZATION CULTURE & CORE VALUES', 26, 104),
  (159, 5, 'EMPLOYEE ENGAGEMENT & COMMUNICATIONS', 27, 108),
  (160, 5, 'EMPLOYEE ENGAGEMENT & COMMUNICATIONS', 28, 112),
  (161, 5, 'EMPLOYEE VALUE PROPOSITION (EVP)', 29, 116),
  (162, 5, 'EMPLOYEE VALUE PROPOSITION (EVP)', 30, 120),
  (163, 5, 'EMPLOYEE VALUE PROPOSITION (EVP)', 31, 124),
  (164, 5, 'INTERNATIONAL MOBILITY', 32, 128),
  (165, 5, 'INTERNATIONAL MOBILITY', 33, 132),
  (166, 5, 'INTERNATIONAL MOBILITY', 34, 136),
  (167, 4, 'INTERNATIONAL MOBILITY', 34, 135),
  (168, 3, 'INTERNATIONAL MOBILITY', 34, 135),
  (169, 2, 'INTERNATIONAL MOBILITY', 34, 133),
  (170, 1, 'INTERNATIONAL MOBILITY', 34, 133);

  TRUNCATE `t_gap_analysis_matrix`;
  REPLACE INTO `t_gap_analysis_matrix` (`ID_CATEGORY`, `ID_QUESTION`, `IN_AS_IS_SCORE`, `IN_TO_BE_SCORE`, `TX_DEFAULT`) VALUES
  ('RECRUITMENT', 1, 1, 1, 'No Activity'),
  ('RECRUITMENT', 1, 1, 2, 'Document in detail the job requirements of the jobs in job descriptions with close matching to actual job responsibilities. '),
  ('RECRUITMENT', 1, 1, 3, 'Document in detail the job requirements of the jobs in job descriptions with close matching to actual job responsibilities. '),
  ('RECRUITMENT', 1, 1, 4, 'Clearly define and document job requirements of vacant jobs in job descriptions aligned to internal career progression and grading structures.  '),
  ('RECRUITMENT', 1, 2, 1, 'No Activity'),
  ('RECRUITMENT', 1, 2, 2, 'No Activity'),
  ('RECRUITMENT', 1, 2, 3, 'Document in detail the job requirements of the jobs in job descriptions with close matching to actual job responsibilities. '),
  ('RECRUITMENT', 1, 2, 4, 'Clearly define and document job requirements of vacant jobs in job descriptions aligned to internal career progression and grading structures.  '),
  ('RECRUITMENT', 1, 3, 1, 'No Activity'),
  ('RECRUITMENT', 1, 3, 2, 'No Activity'),
  ('RECRUITMENT', 1, 3, 3, 'No Activity'),
  ('RECRUITMENT', 1, 3, 4, 'Clearly define and document job requirements of vacant jobs in job descriptions aligned to internal career progression and grading structures.  '),
  ('RECRUITMENT', 1, 4, 1, 'No Activity'),
  ('RECRUITMENT', 1, 4, 2, 'No Activity'),
  ('RECRUITMENT', 1, 4, 3, 'No Activity'),
  ('RECRUITMENT', 1, 4, 4, 'No Activity'),
  ('RECRUITMENT', 2, 1, 1, 'No Activity'),
  ('RECRUITMENT', 2, 1, 2, 'Identify recruitment criteria for specific job requirements with enough detail necessary to guide the recruitment process. \n'),
  ('RECRUITMENT', 2, 1, 3, 'Identify recruitment criteria for specific job requirements with enough detail necessary to guide the recruitment process. \n'),
  ('RECRUITMENT', 2, 1, 4, 'Identify recruitment criteria for specific job requirements and organisation culture fit. '),
  ('RECRUITMENT', 2, 2, 1, 'No Activity'),
  ('RECRUITMENT', 2, 2, 2, 'No Activity'),
  ('RECRUITMENT', 2, 2, 3, 'Identify recruitment criteria for specific job requirements with enough detail necessary to guide the recruitment process. \n'),
  ('RECRUITMENT', 2, 2, 4, 'Identify recruitment criteria for specific job requirements and organisation culture fit. '),
  ('RECRUITMENT', 2, 3, 1, 'No Activity'),
  ('RECRUITMENT', 2, 3, 2, 'No Activity'),
  ('RECRUITMENT', 2, 3, 3, 'No Activity'),
  ('RECRUITMENT', 2, 3, 4, 'Identify recruitment criteria for specific job requirements and organisation culture fit. '),
  ('RECRUITMENT', 2, 4, 1, 'No Activity'),
  ('RECRUITMENT', 2, 4, 2, 'No Activity'),
  ('RECRUITMENT', 2, 4, 3, 'No Activity'),
  ('RECRUITMENT', 2, 4, 4, 'No Activity'),
  ('RECRUITMENT', 3, 1, 1, 'No Activity'),
  ('RECRUITMENT', 3, 1, 2, 'Define recruitment processes supported with the involvement of different stakeholders and the use of advanced selection tools; furthermore, conduct periodic reviews of candidate sources to ensure higher quality candidates. '),
  ('RECRUITMENT', 3, 1, 3, 'Define recruitment processes supported with the involvement of different stakeholders and the use of advanced selection tools; furthermore, conduct periodic reviews of candidate sources to ensure higher quality candidates. '),
  ('RECRUITMENT', 3, 1, 4, 'Define recruitment processes integrated with the organisation\'s broader human capital programmes, such as manpower planning, capability development needs, etc.; furthermore, conduct periodic reviews of the recruited candidates to identify gaps in recruitment processes, criteria, and channels. '),
  ('RECRUITMENT', 3, 2, 1, 'No Activity'),
  ('RECRUITMENT', 3, 2, 2, 'No Activity'),
  ('RECRUITMENT', 3, 2, 3, 'Define recruitment processes supported with the involvement of different stakeholders and the use of advanced selection tools; furthermore, conduct periodic reviews of candidate sources to ensure higher quality candidates. '),
  ('RECRUITMENT', 3, 2, 4, 'Define recruitment processes integrated with the organisation\'s broader human capital programmes, such as manpower planning, capability development needs, etc.; furthermore, conduct periodic reviews of the recruited candidates to identify gaps in recruitment processes, criteria, and channels. '),
  ('RECRUITMENT', 3, 3, 1, 'No Activity'),
  ('RECRUITMENT', 3, 3, 2, 'No Activity'),
  ('RECRUITMENT', 3, 3, 3, 'No Activity'),
  ('RECRUITMENT', 3, 3, 4, 'Define recruitment processes integrated with the organisation\'s broader human capital programmes, such as manpower planning, capability development needs, etc.; furthermore, conduct periodic reviews of the recruited candidates to identify gaps in recruitment processes, criteria, and channels. '),
  ('RECRUITMENT', 3, 4, 1, 'No Activity'),
  ('RECRUITMENT', 3, 4, 2, 'No Activity'),
  ('RECRUITMENT', 3, 4, 3, 'No Activity'),
  ('RECRUITMENT', 3, 4, 4, 'No Activity'),
  ('HR MANAGEMENT', 4, 1, 1, '\nNo Activity'),
  ('HR MANAGEMENT', 4, 1, 2, 'Implement comprehensive HR policies and provide regular reviews/updates required up to the standard of legal compliance requirements. Furthermore, provide  employees with some form of documentation with regards to the HR policies (i.e. Employee handbook).'),
  ('HR MANAGEMENT', 4, 1, 3, 'Implement comprehensive HR policies and provide regular reviews/updates required up to the standard of legal compliance requirements. Furthermore, provide  employees with some form of documentation with regards to the HR policies (i.e. Employee handbook).'),
  ('HR MANAGEMENT', 4, 1, 4, 'Implement comprehensive HR policies and a periodic review processes designed to enhance the effectiveness of HR management in line with market best practices, e.g. updating of entitlements, review of terms&conditions.'),
  ('HR MANAGEMENT', 4, 2, 1, 'No Activity'),
  ('HR MANAGEMENT', 4, 2, 2, 'No Activity'),
  ('HR MANAGEMENT', 4, 2, 3, 'Implement comprehensive HR policies and provide regular reviews/updates required up to the standard of legal compliance requirements. Furthermore, provide  employees with some form of documentation with regards to the HR policies (i.e. Employee handbook).'),
  ('HR MANAGEMENT', 4, 2, 4, 'Implement comprehensive HR policies and a periodic review processes designed to enhance the effectiveness of HR management in line with market best practices, e.g. updating of entitlements, review of terms&conditions.'),
  ('HR MANAGEMENT', 4, 3, 1, 'No Activity'),
  ('HR MANAGEMENT', 4, 3, 2, 'No Activity'),
  ('HR MANAGEMENT', 4, 3, 3, 'No Activity'),
  ('HR MANAGEMENT', 4, 3, 4, 'Implement comprehensive HR policies and a periodic review processes designed to enhance the effectiveness of HR management in line with market best practices, e.g. updating of entitlements, review of terms&conditions.'),
  ('HR MANAGEMENT', 4, 4, 1, 'No Activity'),
  ('HR MANAGEMENT', 4, 4, 2, 'No Activity'),
  ('HR MANAGEMENT', 4, 4, 3, 'No Activity'),
  ('HR MANAGEMENT', 4, 4, 4, 'No Activity'),
  ('HR MANAGEMENT', 5, 1, 1, 'No Activity'),
  ('HR MANAGEMENT', 5, 1, 2, 'Create, document, and communicate the majority or all of the key HR processes. These HR processes can be manually administered.'),
  ('HR MANAGEMENT', 5, 1, 3, 'Create, document, and communicate the majority or all of the key HR processes. These HR processes can be manually administered.'),
  ('HR MANAGEMENT', 5, 1, 4, 'Create, document, and communicate the majority or all of the HR processes. HR processes should be supported with tools such as HRMS.'),
  ('HR MANAGEMENT', 5, 2, 1, 'No Activity'),
  ('HR MANAGEMENT', 5, 2, 2, 'No Activity'),
  ('HR MANAGEMENT', 5, 2, 3, 'Create, document, and communicate the majority or all of the key HR processes. These HR processes can be manually administered.'),
  ('HR MANAGEMENT', 5, 2, 4, 'Create, document, and communicate the majority or all of the HR processes. HR processes should be supported with tools such as HRMS.'),
  ('HR MANAGEMENT', 5, 3, 1, 'No Activity'),
  ('HR MANAGEMENT', 5, 3, 2, 'No Activity'),
  ('HR MANAGEMENT', 5, 3, 3, 'No Activity'),
  ('HR MANAGEMENT', 5, 3, 4, 'Create, document, and communicate the majority or all of the HR processes. HR processes should be supported with tools such as HRMS.'),
  ('HR MANAGEMENT', 5, 4, 1, 'No Activity'),
  ('HR MANAGEMENT', 5, 4, 2, 'No Activity'),
  ('HR MANAGEMENT', 5, 4, 3, 'No Activity'),
  ('HR MANAGEMENT', 5, 4, 4, 'No Activity'),
  ('HR MANAGEMENT', 6, 1, 1, 'No Activity'),
  ('HR MANAGEMENT', 6, 1, 2, 'Set up a comprehensive method of tracking Emplyoyee data using a combination of manual, spreadsheets, and system tools (e.g. HRMS), ensuring that Employee data updates are done timely and accurate. '),
  ('HR MANAGEMENT', 6, 1, 3, 'Set up a comprehensive method of tracking Emplyoyee data using a combination of manual, spreadsheets, and system tools (e.g. HRMS), ensuring that Employee data updates are done timely and accurate. '),
  ('HR MANAGEMENT', 6, 1, 4, 'Create a centralized and current database for Employee data integrating HR operations with non-HR systems and processes.'),
  ('HR MANAGEMENT', 6, 2, 1, 'No Activity'),
  ('HR MANAGEMENT', 6, 2, 2, 'No Activity'),
  ('HR MANAGEMENT', 6, 2, 3, 'Set up a comprehensive method of tracking Emplyoyee data using a combination of manual, spreadsheets, and system tools (e.g. HRMS), ensuring that Employee data updates are done timely and accurate. '),
  ('HR MANAGEMENT', 6, 2, 4, 'Create a centralized and current database for Employee data integrating HR operations with non-HR systems and processes.'),
  ('HR MANAGEMENT', 6, 3, 1, 'No Activity'),
  ('HR MANAGEMENT', 6, 3, 2, 'No Activity'),
  ('HR MANAGEMENT', 6, 3, 3, 'No Activity'),
  ('HR MANAGEMENT', 6, 3, 4, 'Create a centralized and current database for Employee data integrating HR operations with non-HR systems and processes.'),
  ('HR MANAGEMENT', 6, 4, 1, 'No Activity'),
  ('HR MANAGEMENT', 6, 4, 2, 'No Activity'),
  ('HR MANAGEMENT', 6, 4, 3, 'No Activity'),
  ('HR MANAGEMENT', 6, 4, 4, 'No Activity'),
  ('MANPOWER PLANNING', 7, 1, 1, 'No Activity'),
  ('MANPOWER PLANNING', 7, 1, 2, 'Create a detailed organisation chart that adequately reflects the actual working organisation structure; furthermore, conduct regular review of the roles and responsibilities within the various functions. '),
  ('MANPOWER PLANNING', 7, 1, 3, 'Create a detailed organisation chart that adequately reflects the actual working organisation structure; furthermore, conduct regular review of the roles and responsibilities within the various functions. '),
  ('MANPOWER PLANNING', 7, 1, 4, 'Create a detailed organisation chart that adequately reflects the actual working organisation structure; furthermore, conduct regular reviews of the roles and responsibilities within the various functions in consideration of future growth and requirements.  '),
  ('MANPOWER PLANNING', 7, 2, 1, 'No Activity'),
  ('MANPOWER PLANNING', 7, 2, 2, 'No Activity'),
  ('MANPOWER PLANNING', 7, 2, 3, 'Create a detailed organisation chart that adequately reflects the actual working organisation structure; furthermore, conduct regular review of the roles and responsibilities within the various functions. '),
  ('MANPOWER PLANNING', 7, 2, 4, 'Create a detailed organisation chart that adequately reflects the actual working organisation structure; furthermore, conduct regular reviews of the roles and responsibilities within the various functions in consideration of future growth and requirements.  '),
  ('MANPOWER PLANNING', 7, 3, 1, 'No Activity'),
  ('MANPOWER PLANNING', 7, 3, 2, 'No Activity'),
  ('MANPOWER PLANNING', 7, 3, 3, 'No Activity'),
  ('MANPOWER PLANNING', 7, 3, 4, 'Create a detailed organisation chart that adequately reflects the actual working organisation structure; furthermore, conduct regular reviews of the roles and responsibilities within the various functions in consideration of future growth and requirements.  '),
  ('MANPOWER PLANNING', 7, 4, 1, 'No Activity'),
  ('MANPOWER PLANNING', 7, 4, 2, 'No Activity'),
  ('MANPOWER PLANNING', 7, 4, 3, 'No Activity'),
  ('MANPOWER PLANNING', 7, 4, 4, 'No Activity'),
  ('MANPOWER PLANNING', 8, 1, 1, 'No Activity'),
  ('MANPOWER PLANNING', 8, 1, 2, 'Conduct manpower planning and analysis exercises to broadly project future manpower requirements. '),
  ('MANPOWER PLANNING', 8, 1, 3, 'Conduct manpower planning and analysis exercises to broadly project future manpower requirements. '),
  ('MANPOWER PLANNING', 8, 1, 4, 'Conduct Strategic Workforce Planning exercoses to analyze current and future manpower capabilities required for supporting business growth, outlining details such as profile of staff required, skills, knowledge, etc. '),
  ('MANPOWER PLANNING', 8, 2, 1, 'No Activity'),
  ('MANPOWER PLANNING', 8, 2, 2, 'No Activity'),
  ('MANPOWER PLANNING', 8, 2, 3, 'Conduct manpower planning and analysis exercises to broadly project future manpower requirements. '),
  ('MANPOWER PLANNING', 8, 2, 4, 'Conduct Strategic Workforce Planning exercoses to analyze current and future manpower capabilities required for supporting business growth, outlining details such as profile of staff required, skills, knowledge, etc. '),
  ('MANPOWER PLANNING', 8, 3, 1, 'No Activity'),
  ('MANPOWER PLANNING', 8, 3, 2, 'No Activity'),
  ('MANPOWER PLANNING', 8, 3, 3, 'No Activity'),
  ('MANPOWER PLANNING', 8, 3, 4, 'Conduct Strategic Workforce Planning exercoses to analyze current and future manpower capabilities required for supporting business growth, outlining details such as profile of staff required, skills, knowledge, etc. '),
  ('MANPOWER PLANNING', 8, 4, 1, 'No Activity'),
  ('MANPOWER PLANNING', 8, 4, 2, 'No Activity'),
  ('MANPOWER PLANNING', 8, 4, 3, 'No Activity'),
  ('MANPOWER PLANNING', 8, 4, 4, 'No Activity'),
  ('MANPOWER PLANNING', 9, 1, 1, 'No Activity'),
  ('MANPOWER PLANNING', 9, 1, 2, 'Conduct regular manpower planning reviews as part of business review and budgeting. '),
  ('MANPOWER PLANNING', 9, 1, 3, 'Conduct regular manpower planning reviews as part of business review and budgeting. '),
  ('MANPOWER PLANNING', 9, 1, 4, 'Conduct regular manpower planning reviews as part of business review, integrating with other HR initiatives such as training & development, succession planning, etc. '),
  ('MANPOWER PLANNING', 9, 2, 1, 'No Activity'),
  ('MANPOWER PLANNING', 9, 2, 2, 'No Activity'),
  ('MANPOWER PLANNING', 9, 2, 3, 'Conduct regular manpower planning reviews as part of business review and budgeting. '),
  ('MANPOWER PLANNING', 9, 2, 4, 'Conduct regular manpower planning reviews as part of business review, integrating with other HR initiatives such as training & development, succession planning, etc. '),
  ('MANPOWER PLANNING', 9, 3, 1, 'No Activity'),
  ('MANPOWER PLANNING', 9, 3, 2, 'No Activity'),
  ('MANPOWER PLANNING', 9, 3, 3, 'No Activity'),
  ('MANPOWER PLANNING', 9, 3, 4, 'Conduct regular manpower planning reviews as part of business review, integrating with other HR initiatives such as training & development, succession planning, etc. '),
  ('MANPOWER PLANNING', 9, 4, 1, 'No Activity'),
  ('MANPOWER PLANNING', 9, 4, 2, 'No Activity'),
  ('MANPOWER PLANNING', 9, 4, 3, 'No Activity'),
  ('MANPOWER PLANNING', 9, 4, 4, 'No Activity'),
  ('TRAINING AND DEVELOPMENT', 10, 1, 1, 'No Activity'),
  ('TRAINING AND DEVELOPMENT', 10, 1, 2, 'Conduct regular training needs analysis for individual employees with Employees expected to attend trainings relevant to addressing skill gaps.'),
  ('TRAINING AND DEVELOPMENT', 10, 1, 3, 'Conduct regular training needs analysis for individual employees with Employees expected to attend trainings relevant to addressing skill gaps.'),
  ('TRAINING AND DEVELOPMENT', 10, 1, 4, 'Conduct and review regular training needs analysis with the findings analyzed at the company level; subsequently, follow up by developing training and development programmes to address these identified skill gaps. '),
  ('TRAINING AND DEVELOPMENT', 10, 2, 1, 'No Activity'),
  ('TRAINING AND DEVELOPMENT', 10, 2, 2, 'No Activity'),
  ('TRAINING AND DEVELOPMENT', 10, 2, 3, 'Conduct regular training needs analysis for individual employees with Employees expected to attend trainings relevant to addressing skill gaps.'),
  ('TRAINING AND DEVELOPMENT', 10, 2, 4, 'Conduct and review regular training needs analysis with the findings analyzed at the company level; subsequently, follow up by developing training and development programmes to address these identified skill gaps. '),
  ('TRAINING AND DEVELOPMENT', 10, 3, 1, 'No Activity'),
  ('TRAINING AND DEVELOPMENT', 10, 3, 2, 'No Activity'),
  ('TRAINING AND DEVELOPMENT', 10, 3, 3, 'No Activity'),
  ('TRAINING AND DEVELOPMENT', 10, 3, 4, 'Conduct and review regular training needs analysis with the findings analyzed at the company level; subsequently, follow up by developing training and development programmes to address these identified skill gaps. '),
  ('TRAINING AND DEVELOPMENT', 10, 4, 1, 'No Activity'),
  ('TRAINING AND DEVELOPMENT', 10, 4, 2, 'No Activity'),
  ('TRAINING AND DEVELOPMENT', 10, 4, 3, 'No Activity'),
  ('TRAINING AND DEVELOPMENT', 10, 4, 4, 'No Activity'),
  ('TRAINING AND DEVELOPMENT', 11, 1, 1, 'No Activity'),
  ('TRAINING AND DEVELOPMENT', 11, 1, 2, 'Develop a comprehensive training roadmap for the various categories of Employees; the roadmap will then be used for developing Employee technical skills through a combination of training courses and OJT. '),
  ('TRAINING AND DEVELOPMENT', 11, 1, 3, 'Develop a comprehensive training roadmap for the various categories of Employees; the roadmap will then be used for developing Employee technical skills through a combination of training courses and OJT. '),
  ('TRAINING AND DEVELOPMENT', 11, 1, 4, 'Develop a comprehensive training roadmap for various categories of Employees; the roadmap will then be used for developing technical/leadership/management skills using a combination of training and learning platforms which are tied to business objectives. '),
  ('TRAINING AND DEVELOPMENT', 11, 2, 1, 'No Activity'),
  ('TRAINING AND DEVELOPMENT', 11, 2, 2, 'No Activity'),
  ('TRAINING AND DEVELOPMENT', 11, 2, 3, 'Develop a comprehensive training roadmap for the various categories of Employees; the roadmap will then be used for developing Employee technical skills through a combination of training courses and OJT. '),
  ('TRAINING AND DEVELOPMENT', 11, 2, 4, 'Develop a comprehensive training roadmap for various categories of Employees; the roadmap will then be used for developing technical/leadership/management skills using a combination of training and learning platforms which are tied to business objectives. '),
  ('TRAINING AND DEVELOPMENT', 11, 3, 1, 'No Activity'),
  ('TRAINING AND DEVELOPMENT', 11, 3, 2, 'No Activity'),
  ('TRAINING AND DEVELOPMENT', 11, 3, 3, 'No Activity'),
  ('TRAINING AND DEVELOPMENT', 11, 3, 4, 'Develop a comprehensive training roadmap for various categories of Employees; the roadmap will then be used for developing technical/leadership/management skills using a combination of training and learning platforms which are tied to business objectives. '),
  ('TRAINING AND DEVELOPMENT', 11, 4, 1, 'No Activity'),
  ('TRAINING AND DEVELOPMENT', 11, 4, 2, 'No Activity'),
  ('TRAINING AND DEVELOPMENT', 11, 4, 3, 'No Activity'),
  ('TRAINING AND DEVELOPMENT', 11, 4, 4, 'No Activity'),
  ('TRAINING AND DEVELOPMENT', 12, 1, 1, 'No Activity'),
  ('TRAINING AND DEVELOPMENT', 12, 1, 2, 'Set defined training roadmap and company policies to facilitate Employee trainings. '),
  ('TRAINING AND DEVELOPMENT', 12, 1, 3, 'Set defined training roadmap and company policies to facilitate Employee trainings. '),
  ('TRAINING AND DEVELOPMENT', 12, 1, 4, 'Set defined training roadmap and company policy to facilitate Employee trainings, with the effectiveness of the training applied in the workplace analysed and used for fine-tuning future training policies and programmes. '),
  ('TRAINING AND DEVELOPMENT', 12, 2, 1, 'No Activity'),
  ('TRAINING AND DEVELOPMENT', 12, 2, 2, 'No Activity'),
  ('TRAINING AND DEVELOPMENT', 12, 2, 3, 'Set defined training roadmap and company policies to facilitate Employee trainings. '),
  ('TRAINING AND DEVELOPMENT', 12, 2, 4, 'Set defined training roadmap and company policy to facilitate Employee trainings, with the effectiveness of the training applied in the workplace analysed and used for fine-tuning future training policies and programmes. '),
  ('TRAINING AND DEVELOPMENT', 12, 3, 1, 'No Activity'),
  ('TRAINING AND DEVELOPMENT', 12, 3, 2, 'No Activity'),
  ('TRAINING AND DEVELOPMENT', 12, 3, 3, 'No Activity'),
  ('TRAINING AND DEVELOPMENT', 12, 3, 4, 'Set defined training roadmap and company policy to facilitate Employee trainings, with the effectiveness of the training applied in the workplace analysed and used for fine-tuning future training policies and programmes. '),
  ('TRAINING AND DEVELOPMENT', 12, 4, 1, 'No Activity'),
  ('TRAINING AND DEVELOPMENT', 12, 4, 2, 'No Activity'),
  ('TRAINING AND DEVELOPMENT', 12, 4, 3, 'No Activity'),
  ('TRAINING AND DEVELOPMENT', 12, 4, 4, 'No Activity'),
  ('TRAINING AND DEVELOPMENT', 13, 1, 1, 'No Activity'),
  ('TRAINING AND DEVELOPMENT', 13, 1, 2, 'Provide new Employees detailed onboarding instructions, including company familiarisation, culture induction, meeting with leaders, etc., with induction into their jobs through structured training and OJT.'),
  ('TRAINING AND DEVELOPMENT', 13, 1, 3, 'Provide new Employees detailed onboarding instructions, including company familiarisation, culture induction, meeting with leaders, etc., with induction into their jobs through structured training and OJT.'),
  ('TRAINING AND DEVELOPMENT', 13, 1, 4, 'Provide new Employees with detailed onboarding instructions, assigned buddies/mentors to facilitate their settling into the new roles, and have their progress reviewed over an intial period to address nay gaps/issues which may surface. '),
  ('TRAINING AND DEVELOPMENT', 13, 2, 1, 'No Activity'),
  ('TRAINING AND DEVELOPMENT', 13, 2, 2, 'No Activity'),
  ('TRAINING AND DEVELOPMENT', 13, 2, 3, 'Provide new Employees detailed onboarding instructions, including company familiarisation, culture induction, meeting with leaders, etc., with induction into their jobs through structured training and OJT.'),
  ('TRAINING AND DEVELOPMENT', 13, 2, 4, 'Provide new Employees with detailed onboarding instructions, assigned buddies/mentors to facilitate their settling into the new roles, and have their progress reviewed over an intial period to address nay gaps/issues which may surface. '),
  ('TRAINING AND DEVELOPMENT', 13, 3, 1, 'No Activity'),
  ('TRAINING AND DEVELOPMENT', 13, 3, 2, 'No Activity'),
  ('TRAINING AND DEVELOPMENT', 13, 3, 3, 'No Activity'),
  ('TRAINING AND DEVELOPMENT', 13, 3, 4, 'Provide new Employees with detailed onboarding instructions, assigned buddies/mentors to facilitate their settling into the new roles, and have their progress reviewed over an intial period to address nay gaps/issues which may surface. '),
  ('TRAINING AND DEVELOPMENT', 13, 4, 1, 'No Activity'),
  ('TRAINING AND DEVELOPMENT', 13, 4, 2, 'No Activity'),
  ('TRAINING AND DEVELOPMENT', 13, 4, 3, 'No Activity'),
  ('TRAINING AND DEVELOPMENT', 13, 4, 4, 'No Activity'),
  ('PERFORMANCE MANAGEMENT', 14, 1, 1, 'No Activity'),
  ('PERFORMANCE MANAGEMENT', 14, 1, 2, 'Set basic performance goals for the Employee linked to company strategy, normally specific to the Employee\'s position. '),
  ('PERFORMANCE MANAGEMENT', 14, 1, 3, 'Set basic performance goals for the Employee linked to company strategy, normally specific to the Employee\'s position. '),
  ('PERFORMANCE MANAGEMENT', 14, 1, 4, 'Set comprehensive performance goals linked to business strategy. These goals are to be balanced covering both internal development and external growth objectives, long-term/short-term goals, leading & lagging KPIS, etc. '),
  ('PERFORMANCE MANAGEMENT', 14, 2, 1, 'No Activity'),
  ('PERFORMANCE MANAGEMENT', 14, 2, 2, 'No Activity'),
  ('PERFORMANCE MANAGEMENT', 14, 2, 3, 'Set basic performance goals for the Employee linked to company strategy, normally specific to the Employee\'s position. '),
  ('PERFORMANCE MANAGEMENT', 14, 2, 4, 'Set comprehensive performance goals linked to business strategy. These goals are to be balanced covering both internal development and external growth objectives, long-term/short-term goals, leading & lagging KPIS, etc. '),
  ('PERFORMANCE MANAGEMENT', 14, 3, 1, 'No Activity'),
  ('PERFORMANCE MANAGEMENT', 14, 3, 2, 'No Activity'),
  ('PERFORMANCE MANAGEMENT', 14, 3, 3, 'No Activity'),
  ('PERFORMANCE MANAGEMENT', 14, 3, 4, 'Set comprehensive performance goals linked to business strategy. These goals are to be balanced covering both internal development and external growth objectives, long-term/short-term goals, leading & lagging KPIS, etc. '),
  ('PERFORMANCE MANAGEMENT', 14, 4, 1, 'No Activity'),
  ('PERFORMANCE MANAGEMENT', 14, 4, 2, 'No Activity'),
  ('PERFORMANCE MANAGEMENT', 14, 4, 3, 'No Activity'),
  ('PERFORMANCE MANAGEMENT', 14, 4, 4, 'No Activity'),
  ('PERFORMANCE MANAGEMENT', 15, 1, 1, 'No Activity'),
  ('PERFORMANCE MANAGEMENT', 15, 1, 2, 'Conduct regular performance appraisals with clear criterias, i.e. KPIs, competencies, etc. that may be differentiated across various employee levels and types. '),
  ('PERFORMANCE MANAGEMENT', 15, 1, 3, 'Conduct regular performance appraisals with clear criterias, i.e. KPIs, competencies, etc. that may be differentiated across various employee levels and types. '),
  ('PERFORMANCE MANAGEMENT', 15, 1, 4, 'Conduct regular performance appraisals with clear criterias differentiated across various employee levels and types; with the overall performance levels reviewed by top management to identify potential issues (i.e. work processes, job design, accountabilities).'),
  ('PERFORMANCE MANAGEMENT', 15, 2, 1, 'No Activity'),
  ('PERFORMANCE MANAGEMENT', 15, 2, 2, 'No Activity'),
  ('PERFORMANCE MANAGEMENT', 15, 2, 3, 'Conduct regular performance appraisals with clear criterias, i.e. KPIs, competencies, etc. that may be differentiated across various employee levels and types. '),
  ('PERFORMANCE MANAGEMENT', 15, 2, 4, 'Conduct regular performance appraisals with clear criterias differentiated across various employee levels and types; with the overall performance levels reviewed by top management to identify potential issues (i.e. work processes, job design, accountabilities).'),
  ('PERFORMANCE MANAGEMENT', 15, 3, 1, 'No Activity'),
  ('PERFORMANCE MANAGEMENT', 15, 3, 2, 'No Activity'),
  ('PERFORMANCE MANAGEMENT', 15, 3, 3, 'No Activity'),
  ('PERFORMANCE MANAGEMENT', 15, 3, 4, 'Conduct regular performance appraisals with clear criterias differentiated across various employee levels and types; with the overall performance levels reviewed by top management to identify potential issues (i.e. work processes, job design, accountabilities).'),
  ('PERFORMANCE MANAGEMENT', 15, 4, 1, 'No Activity'),
  ('PERFORMANCE MANAGEMENT', 15, 4, 2, 'No Activity'),
  ('PERFORMANCE MANAGEMENT', 15, 4, 3, 'No Activity'),
  ('PERFORMANCE MANAGEMENT', 15, 4, 4, 'No Activity'),
  ('PERFORMANCE MANAGEMENT', 16, 1, 1, 'No Activity'),
  ('PERFORMANCE MANAGEMENT', 16, 1, 2, 'Supervisors are trained on performance coaching, and do so on a formal, regular basis. '),
  ('PERFORMANCE MANAGEMENT', 16, 1, 3, 'Supervisors are trained on performance coaching, and do so on a formal, regular basis. '),
  ('PERFORMANCE MANAGEMENT', 16, 1, 4, 'Supervisors are to conduct performace coaching and to review employee development needs at the organisation level to identify and address gaps. '),
  ('PERFORMANCE MANAGEMENT', 16, 2, 1, 'No Activity'),
  ('PERFORMANCE MANAGEMENT', 16, 2, 2, 'No Activity'),
  ('PERFORMANCE MANAGEMENT', 16, 2, 3, 'Supervisors are trained on performance coaching, and do so on a formal, regular basis. '),
  ('PERFORMANCE MANAGEMENT', 16, 2, 4, 'Supervisors are to conduct performace coaching and to review employee development needs at the organisation level to identify and address gaps. '),
  ('PERFORMANCE MANAGEMENT', 16, 3, 1, 'No Activity'),
  ('PERFORMANCE MANAGEMENT', 16, 3, 2, 'No Activity'),
  ('PERFORMANCE MANAGEMENT', 16, 3, 3, 'No Activity'),
  ('PERFORMANCE MANAGEMENT', 16, 3, 4, 'Supervisors are to conduct performace coaching and to review employee development needs at the organisation level to identify and address gaps. '),
  ('PERFORMANCE MANAGEMENT', 16, 4, 1, 'No Activity'),
  ('PERFORMANCE MANAGEMENT', 16, 4, 2, 'No Activity'),
  ('PERFORMANCE MANAGEMENT', 16, 4, 3, 'No Activity'),
  ('PERFORMANCE MANAGEMENT', 16, 4, 4, 'No Activity'),
  ('PERFORMANCE MANAGEMENT', 17, 1, 1, 'No Activity'),
  ('PERFORMANCE MANAGEMENT', 17, 1, 2, 'Provide performance incentives to employees based on generally defined performance levels. '),
  ('PERFORMANCE MANAGEMENT', 17, 1, 3, 'Provide performance incentives to employees based on generally defined performance levels. '),
  ('PERFORMANCE MANAGEMENT', 17, 1, 4, 'Provide performance incentives to better-performing employees with the criteria for differentiating performance levels well communicated and supported by performance targets (i.e. KPIs, competencies).'),
  ('PERFORMANCE MANAGEMENT', 17, 2, 1, 'No Activity'),
  ('PERFORMANCE MANAGEMENT', 17, 2, 2, 'No Activity'),
  ('PERFORMANCE MANAGEMENT', 17, 2, 3, 'Provide performance incentives to employees based on generally defined performance levels. '),
  ('PERFORMANCE MANAGEMENT', 17, 2, 4, 'Provide performance incentives to better-performing employees with the criteria for differentiating performance levels well communicated and supported by performance targets (i.e. KPIs, competencies).'),
  ('PERFORMANCE MANAGEMENT', 17, 3, 1, 'No Activity'),
  ('PERFORMANCE MANAGEMENT', 17, 3, 2, 'No Activity'),
  ('PERFORMANCE MANAGEMENT', 17, 3, 3, 'No Activity'),
  ('PERFORMANCE MANAGEMENT', 17, 3, 4, 'Provide performance incentives to better-performing employees with the criteria for differentiating performance levels well communicated and supported by performance targets (i.e. KPIs, competencies).'),
  ('PERFORMANCE MANAGEMENT', 17, 4, 1, 'No Activity'),
  ('PERFORMANCE MANAGEMENT', 17, 4, 2, 'No Activity'),
  ('PERFORMANCE MANAGEMENT', 17, 4, 3, 'No Activity'),
  ('PERFORMANCE MANAGEMENT', 17, 4, 4, 'No Activity'),
  ('COMPENSATION AND BENEFITS (C&B)', 18, 1, 1, 'No Activity'),
  ('COMPENSATION AND BENEFITS (C&B)', 18, 1, 2, 'Establish a grading structure and a corresponding salary range scheme that reflect the job sizes generic across all work levels. '),
  ('COMPENSATION AND BENEFITS (C&B)', 18, 1, 3, 'Establish a grading structure and a corresponding salary range scheme that reflect the job sizes generic across all work levels. '),
  ('COMPENSATION AND BENEFITS (C&B)', 18, 1, 4, 'Employ a grading structure and a corresponding salary range scheme that reflects all work levels, as well as different job families, with the ranges matching the respective grades in the various job families. '),
  ('COMPENSATION AND BENEFITS (C&B)', 18, 2, 1, 'No Activity'),
  ('COMPENSATION AND BENEFITS (C&B)', 18, 2, 2, 'No Activity'),
  ('COMPENSATION AND BENEFITS (C&B)', 18, 2, 3, 'Establish a grading structure and a corresponding salary range scheme that reflect the job sizes generic across all work levels. '),
  ('COMPENSATION AND BENEFITS (C&B)', 18, 2, 4, 'Employ a grading structure and a corresponding salary range scheme that reflects all work levels, as well as different job families, with the ranges matching the respective grades in the various job families. '),
  ('COMPENSATION AND BENEFITS (C&B)', 18, 3, 1, 'No Activity'),
  ('COMPENSATION AND BENEFITS (C&B)', 18, 3, 2, 'No Activity'),
  ('COMPENSATION AND BENEFITS (C&B)', 18, 3, 3, 'No Activity'),
  ('COMPENSATION AND BENEFITS (C&B)', 18, 3, 4, 'Employ a grading structure and a corresponding salary range scheme that reflects all work levels, as well as different job families, with the ranges matching the respective grades in the various job families. '),
  ('COMPENSATION AND BENEFITS (C&B)', 18, 4, 1, 'No Activity'),
  ('COMPENSATION AND BENEFITS (C&B)', 18, 4, 2, 'No Activity'),
  ('COMPENSATION AND BENEFITS (C&B)', 18, 4, 3, 'No Activity'),
  ('COMPENSATION AND BENEFITS (C&B)', 18, 4, 4, 'No Activity'),
  ('COMPENSATION AND BENEFITS (C&B)', 19, 1, 1, 'No Activity'),
  ('COMPENSATION AND BENEFITS (C&B)', 19, 1, 2, 'Employ an approximate benchmarking of an Employee\'s total compensation package against market norms. '),
  ('COMPENSATION AND BENEFITS (C&B)', 19, 1, 3, 'Employ an approximate benchmarking of an Employee\'s total compensation package against market norms. '),
  ('COMPENSATION AND BENEFITS (C&B)', 19, 1, 4, 'Employ an  benchmarking of an Employee\'s total compensation package against the market norms, using various basis for comparison and analyses. '),
  ('COMPENSATION AND BENEFITS (C&B)', 19, 2, 1, 'No Activity'),
  ('COMPENSATION AND BENEFITS (C&B)', 19, 2, 2, 'No Activity'),
  ('COMPENSATION AND BENEFITS (C&B)', 19, 2, 3, 'Employ an approximate benchmarking of an Employee\'s total compensation package against market norms. '),
  ('COMPENSATION AND BENEFITS (C&B)', 19, 2, 4, 'Employ an  benchmarking of an Employee\'s total compensation package against the market norms, using various basis for comparison and analyses. '),
  ('COMPENSATION AND BENEFITS (C&B)', 19, 3, 1, 'No Activity'),
  ('COMPENSATION AND BENEFITS (C&B)', 19, 3, 2, 'No Activity'),
  ('COMPENSATION AND BENEFITS (C&B)', 19, 3, 3, 'No Activity'),
  ('COMPENSATION AND BENEFITS (C&B)', 19, 3, 4, 'Employ an  benchmarking of an Employee\'s total compensation package against the market norms, using various basis for comparison and analyses. '),
  ('COMPENSATION AND BENEFITS (C&B)', 19, 4, 1, 'No Activity'),
  ('COMPENSATION AND BENEFITS (C&B)', 19, 4, 2, 'No Activity'),
  ('COMPENSATION AND BENEFITS (C&B)', 19, 4, 3, 'No Activity'),
  ('COMPENSATION AND BENEFITS (C&B)', 19, 4, 4, 'No Activity'),
  ('COMPENSATION AND BENEFITS (C&B)', 20, 1, 1, 'No Activity'),
  ('COMPENSATION AND BENEFITS (C&B)', 20, 1, 2, 'Conduct regular compensation and benefits review to ensure continuous competitiveness with the market. '),
  ('COMPENSATION AND BENEFITS (C&B)', 20, 1, 3, 'Conduct regular compensation and benefits review to ensure continuous competitiveness with the market. '),
  ('COMPENSATION AND BENEFITS (C&B)', 20, 1, 4, 'Conduct regular compensation and benefits reviews to ensure competitiveness with the market as well as to introduce targeted pay practices and components to achieve specific objectives (i.e. attract specific talent, incentive producitivity)'),
  ('COMPENSATION AND BENEFITS (C&B)', 20, 2, 1, 'No Activity'),
  ('COMPENSATION AND BENEFITS (C&B)', 20, 2, 2, 'No Activity'),
  ('COMPENSATION AND BENEFITS (C&B)', 20, 2, 3, 'Conduct regular compensation and benefits review to ensure continuous competitiveness with the market. '),
  ('COMPENSATION AND BENEFITS (C&B)', 20, 2, 4, 'Conduct regular compensation and benefits reviews to ensure competitiveness with the market as well as to introduce targeted pay practices and components to achieve specific objectives (i.e. attract specific talent, incentive producitivity)'),
  ('COMPENSATION AND BENEFITS (C&B)', 20, 3, 1, 'No Activity'),
  ('COMPENSATION AND BENEFITS (C&B)', 20, 3, 2, 'No Activity'),
  ('COMPENSATION AND BENEFITS (C&B)', 20, 3, 3, 'No Activity'),
  ('COMPENSATION AND BENEFITS (C&B)', 20, 3, 4, 'Conduct regular compensation and benefits reviews to ensure competitiveness with the market as well as to introduce targeted pay practices and components to achieve specific objectives (i.e. attract specific talent, incentive producitivity)'),
  ('COMPENSATION AND BENEFITS (C&B)', 20, 4, 1, 'No Activity'),
  ('COMPENSATION AND BENEFITS (C&B)', 20, 4, 2, 'No Activity'),
  ('COMPENSATION AND BENEFITS (C&B)', 20, 4, 3, 'No Activity'),
  ('COMPENSATION AND BENEFITS (C&B)', 20, 4, 4, 'No Activity'),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 21, 1, 1, 'No Activity'),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 21, 1, 2, 'Formally identify mission-critical roles relevant to topmanagement and mid-level roles. '),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 21, 1, 3, 'Formally identify mission-critical roles relevant to topmanagement and mid-level roles. '),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 21, 1, 4, 'Formally identify mission-critical roles across the various job levels in order to provide the required experience/exposure and prepare employees for mission-critical roles. '),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 21, 2, 1, 'No Activity'),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 21, 2, 2, 'No Activity'),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 21, 2, 3, 'Formally identify mission-critical roles relevant to topmanagement and mid-level roles. '),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 21, 2, 4, 'Formally identify mission-critical roles across the various job levels in order to provide the required experience/exposure and prepare employees for mission-critical roles. '),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 21, 3, 1, 'No Activity'),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 21, 3, 2, 'No Activity'),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 21, 3, 3, 'No Activity'),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 21, 3, 4, 'Formally identify mission-critical roles across the various job levels in order to provide the required experience/exposure and prepare employees for mission-critical roles. '),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 21, 4, 1, 'No Activity'),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 21, 4, 2, 'No Activity'),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 21, 4, 3, 'No Activity'),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 21, 4, 4, 'No Activity'),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 22, 1, 1, 'No Activity'),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 22, 1, 2, 'Create talent identification criterias based on operational and/or performance measures. '),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 22, 1, 3, 'Create talent identification criterias based on operational and/or performance measures. '),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 22, 1, 4, 'Create talent identification criterias based on a combination of performance track record as well as leadership/people/skills/potential which are aligned to company\'s needs. '),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 22, 2, 1, 'No Activity'),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 22, 2, 2, 'No Activity'),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 22, 2, 3, 'Create talent identification criterias based on operational and/or performance measures. '),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 22, 2, 4, 'Create talent identification criterias based on a combination of performance track record as well as leadership/people/skills/potential which are aligned to company\'s needs. '),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 22, 3, 1, 'No Activity'),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 22, 3, 2, 'No Activity'),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 22, 3, 3, 'No Activity'),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 22, 3, 4, 'Create talent identification criterias based on a combination of performance track record as well as leadership/people/skills/potential which are aligned to company\'s needs. '),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 22, 4, 1, 'No Activity'),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 22, 4, 2, 'No Activity'),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 22, 4, 3, 'No Activity'),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 22, 4, 4, 'No Activity'),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 23, 1, 1, 'No Activity'),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 23, 1, 2, 'Identify potential successors through a structured process. '),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 23, 1, 3, 'Identify potential successors through a structured process. '),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 23, 1, 4, 'Identify potential successors through a structured process, developed through career planning across all levels, and include targeted programmes and deployment to prepare them for mission-critical roles. '),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 23, 2, 1, 'No Activity'),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 23, 2, 2, 'No Activity'),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 23, 2, 3, 'Identify potential successors through a structured process. '),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 23, 2, 4, 'Identify potential successors through a structured process, developed through career planning across all levels, and include targeted programmes and deployment to prepare them for mission-critical roles. '),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 23, 3, 1, 'No Activity'),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 23, 3, 2, 'No Activity'),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 23, 3, 3, 'No Activity'),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 23, 3, 4, 'Identify potential successors through a structured process, developed through career planning across all levels, and include targeted programmes and deployment to prepare them for mission-critical roles. '),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 23, 4, 1, 'No Activity'),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 23, 4, 2, 'No Activity'),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 23, 4, 3, 'No Activity'),
  ('TALENT MANAGEMENT AND SUCCESSION PLANNING', 23, 4, 4, 'No Activity'),
  ('ORGANISATION CULTURE AND CORE VALUES', 24, 1, 1, 'No Activity'),
  ('ORGANISATION CULTURE AND CORE VALUES', 24, 1, 2, 'Describe the organisation culture and core values in clear statements and translate accordingly how employees can demonstrate the expectations across the various levels. '),
  ('ORGANISATION CULTURE AND CORE VALUES', 24, 1, 3, 'Describe the organisation culture and core values in clear statements and translate accordingly how employees can demonstrate the expectations across the various levels. '),
  ('ORGANISATION CULTURE AND CORE VALUES', 24, 1, 4, 'Describe the organisation culture and core values clearly, with periodic reviews to ensure relevance and alignment to business objectives. '),
  ('ORGANISATION CULTURE AND CORE VALUES', 24, 2, 1, 'No Activity'),
  ('ORGANISATION CULTURE AND CORE VALUES', 24, 2, 2, 'No Activity'),
  ('ORGANISATION CULTURE AND CORE VALUES', 24, 2, 3, 'Describe the organisation culture and core values in clear statements and translate accordingly how employees can demonstrate the expectations across the various levels. '),
  ('ORGANISATION CULTURE AND CORE VALUES', 24, 2, 4, 'Describe the organisation culture and core values clearly, with periodic reviews to ensure relevance and alignment to business objectives. '),
  ('ORGANISATION CULTURE AND CORE VALUES', 24, 3, 1, 'No Activity'),
  ('ORGANISATION CULTURE AND CORE VALUES', 24, 3, 2, 'No Activity'),
  ('ORGANISATION CULTURE AND CORE VALUES', 24, 3, 3, 'No Activity'),
  ('ORGANISATION CULTURE AND CORE VALUES', 24, 3, 4, 'Describe the organisation culture and core values clearly, with periodic reviews to ensure relevance and alignment to business objectives. '),
  ('ORGANISATION CULTURE AND CORE VALUES', 24, 4, 1, 'No Activity'),
  ('ORGANISATION CULTURE AND CORE VALUES', 24, 4, 2, 'No Activity'),
  ('ORGANISATION CULTURE AND CORE VALUES', 24, 4, 3, 'No Activity'),
  ('ORGANISATION CULTURE AND CORE VALUES', 24, 4, 4, 'No Activity'),
  ('ORGANISATION CULTURE AND CORE VALUES', 25, 1, 1, 'No Activity'),
  ('ORGANISATION CULTURE AND CORE VALUES', 25, 1, 2, 'Conduct organisation culture and core value communications and reinforce regularly during regular employee communication sessions. '),
  ('ORGANISATION CULTURE AND CORE VALUES', 25, 1, 3, 'Conduct organisation culture and core value communications and reinforce regularly during regular employee communication sessions. '),
  ('ORGANISATION CULTURE AND CORE VALUES', 25, 1, 4, 'Integrate organisation culture and core values as part of the broader HR practice (i.e. Onboarding process, employee training, performance appraisal). Conduct workshops and/or teambuilding events to strengthen these values. '),
  ('ORGANISATION CULTURE AND CORE VALUES', 25, 2, 1, 'No Activity'),
  ('ORGANISATION CULTURE AND CORE VALUES', 25, 2, 2, 'No Activity'),
  ('ORGANISATION CULTURE AND CORE VALUES', 25, 2, 3, 'Conduct organisation culture and core value communications and reinforce regularly during regular employee communication sessions. '),
  ('ORGANISATION CULTURE AND CORE VALUES', 25, 2, 4, 'Integrate organisation culture and core values as part of the broader HR practice (i.e. Onboarding process, employee training, performance appraisal). Conduct workshops and/or teambuilding events to strengthen these values. '),
  ('ORGANISATION CULTURE AND CORE VALUES', 25, 3, 1, 'No Activity'),
  ('ORGANISATION CULTURE AND CORE VALUES', 25, 3, 2, 'No Activity'),
  ('ORGANISATION CULTURE AND CORE VALUES', 25, 3, 3, 'No Activity'),
  ('ORGANISATION CULTURE AND CORE VALUES', 25, 3, 4, 'Integrate organisation culture and core values as part of the broader HR practice (i.e. Onboarding process, employee training, performance appraisal). Conduct workshops and/or teambuilding events to strengthen these values. '),
  ('ORGANISATION CULTURE AND CORE VALUES', 25, 4, 1, 'No Activity'),
  ('ORGANISATION CULTURE AND CORE VALUES', 25, 4, 2, 'No Activity'),
  ('ORGANISATION CULTURE AND CORE VALUES', 25, 4, 3, 'No Activity'),
  ('ORGANISATION CULTURE AND CORE VALUES', 25, 4, 4, 'No Activity'),
  ('ORGANISATION CULTURE AND CORE VALUES', 26, 1, 1, 'No Activity'),
  ('ORGANISATION CULTURE AND CORE VALUES', 26, 1, 2, 'Instruct HR as well as supervisors to lead organisation & core value development. '),
  ('ORGANISATION CULTURE AND CORE VALUES', 26, 1, 3, 'Instruct HR as well as supervisors to lead organisation & core value development. '),
  ('ORGANISATION CULTURE AND CORE VALUES', 26, 1, 4, 'Ensure organisation & core values are role-modelled across different levels of employees, and are reinforced in day-to-day interactions. '),
  ('ORGANISATION CULTURE AND CORE VALUES', 26, 2, 1, 'No Activity'),
  ('ORGANISATION CULTURE AND CORE VALUES', 26, 2, 2, 'No Activity'),
  ('ORGANISATION CULTURE AND CORE VALUES', 26, 2, 3, 'Instruct HR as well as supervisors to lead organisation & core value development. '),
  ('ORGANISATION CULTURE AND CORE VALUES', 26, 2, 4, 'Ensure organisation & core values are role-modelled across different levels of employees, and are reinforced in day-to-day interactions. '),
  ('ORGANISATION CULTURE AND CORE VALUES', 26, 3, 1, 'No Activity'),
  ('ORGANISATION CULTURE AND CORE VALUES', 26, 3, 2, 'No Activity'),
  ('ORGANISATION CULTURE AND CORE VALUES', 26, 3, 3, 'No Activity'),
  ('ORGANISATION CULTURE AND CORE VALUES', 26, 3, 4, 'Ensure organisation & core values are role-modelled across different levels of employees, and are reinforced in day-to-day interactions. '),
  ('ORGANISATION CULTURE AND CORE VALUES', 26, 4, 1, 'No Activity'),
  ('ORGANISATION CULTURE AND CORE VALUES', 26, 4, 2, 'No Activity'),
  ('ORGANISATION CULTURE AND CORE VALUES', 26, 4, 3, 'No Activity'),
  ('ORGANISATION CULTURE AND CORE VALUES', 26, 4, 4, 'No Activity'),
  ('EMPLOYEE ENGAGEMENT AND COMMUNICATIONS', 27, 1, 1, 'No Activity'),
  ('EMPLOYEE ENGAGEMENT AND COMMUNICATIONS', 27, 1, 2, 'Seek employee opinions on a regular basis, in a structured manner, so as to enable reporting and analysis to identify gaps. '),
  ('EMPLOYEE ENGAGEMENT AND COMMUNICATIONS', 27, 1, 3, 'Seek employee opinions on a regular basis, in a structured manner, so as to enable reporting and analysis to identify gaps. '),
  ('EMPLOYEE ENGAGEMENT AND COMMUNICATIONS', 27, 1, 4, 'Seek employee opinons on a regular and structured basis. Develop follow up activities for management and allow feedback to employees on a regular basis. '),
  ('EMPLOYEE ENGAGEMENT AND COMMUNICATIONS', 27, 2, 1, 'No Activity'),
  ('EMPLOYEE ENGAGEMENT AND COMMUNICATIONS', 27, 2, 2, 'No Activity'),
  ('EMPLOYEE ENGAGEMENT AND COMMUNICATIONS', 27, 2, 3, 'Seek employee opinions on a regular basis, in a structured manner, so as to enable reporting and analysis to identify gaps. '),
  ('EMPLOYEE ENGAGEMENT AND COMMUNICATIONS', 27, 2, 4, 'Seek employee opinons on a regular and structured basis. Develop follow up activities for management and allow feedback to employees on a regular basis. '),
  ('EMPLOYEE ENGAGEMENT AND COMMUNICATIONS', 27, 3, 1, 'No Activity'),
  ('EMPLOYEE ENGAGEMENT AND COMMUNICATIONS', 27, 3, 2, 'No Activity'),
  ('EMPLOYEE ENGAGEMENT AND COMMUNICATIONS', 27, 3, 3, 'No Activity'),
  ('EMPLOYEE ENGAGEMENT AND COMMUNICATIONS', 27, 3, 4, 'Seek employee opinons on a regular and structured basis. Develop follow up activities for management and allow feedback to employees on a regular basis. '),
  ('EMPLOYEE ENGAGEMENT AND COMMUNICATIONS', 27, 4, 1, 'No Activity'),
  ('EMPLOYEE ENGAGEMENT AND COMMUNICATIONS', 27, 4, 2, 'No Activity'),
  ('EMPLOYEE ENGAGEMENT AND COMMUNICATIONS', 27, 4, 3, 'No Activity'),
  ('EMPLOYEE ENGAGEMENT AND COMMUNICATIONS', 27, 4, 4, 'No Activity'),
  ('EMPLOYEE ENGAGEMENT AND COMMUNICATIONS', 28, 1, 1, 'No Activity'),
  ('EMPLOYEE ENGAGEMENT AND COMMUNICATIONS', 28, 1, 2, 'Conduct company-wide communications on a regular basis when required by top management or HR. '),
  ('EMPLOYEE ENGAGEMENT AND COMMUNICATIONS', 28, 1, 3, 'Conduct company-wide communications on a regular basis when required by top management or HR. '),
  ('EMPLOYEE ENGAGEMENT AND COMMUNICATIONS', 28, 1, 4, 'Conduct company-wide communications on a regular and structured basis which involves multiple stakeholders (i.e. change agents, managers, HR, selected staff).'),
  ('EMPLOYEE ENGAGEMENT AND COMMUNICATIONS', 28, 2, 1, 'No Activity'),
  ('EMPLOYEE ENGAGEMENT AND COMMUNICATIONS', 28, 2, 2, 'No Activity'),
  ('EMPLOYEE ENGAGEMENT AND COMMUNICATIONS', 28, 2, 3, 'Conduct company-wide communications on a regular basis when required by top management or HR. '),
  ('EMPLOYEE ENGAGEMENT AND COMMUNICATIONS', 28, 2, 4, 'Conduct company-wide communications on a regular and structured basis which involves multiple stakeholders (i.e. change agents, managers, HR, selected staff).'),
  ('EMPLOYEE ENGAGEMENT AND COMMUNICATIONS', 28, 3, 1, 'No Activity'),
  ('EMPLOYEE ENGAGEMENT AND COMMUNICATIONS', 28, 3, 2, 'No Activity'),
  ('EMPLOYEE ENGAGEMENT AND COMMUNICATIONS', 28, 3, 3, 'No Activity'),
  ('EMPLOYEE ENGAGEMENT AND COMMUNICATIONS', 28, 3, 4, 'Conduct company-wide communications on a regular and structured basis which involves multiple stakeholders (i.e. change agents, managers, HR, selected staff).'),
  ('EMPLOYEE ENGAGEMENT AND COMMUNICATIONS', 28, 4, 1, 'No Activity'),
  ('EMPLOYEE ENGAGEMENT AND COMMUNICATIONS', 28, 4, 2, 'No Activity'),
  ('EMPLOYEE ENGAGEMENT AND COMMUNICATIONS', 28, 4, 3, 'No Activity'),
  ('EMPLOYEE ENGAGEMENT AND COMMUNICATIONS', 28, 4, 4, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 29, 1, 1, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 29, 1, 2, 'Articulate in a specific manner how some aspects of the HR policies and practices are aligned to the Employee\'s career development within the firm. '),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 29, 1, 3, 'Articulate in a specific manner how some aspects of the HR policies and practices are aligned to the Employee\'s career development within the firm. '),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 29, 1, 4, 'Define and explain clearly the company\'s employee value proposition which is differentiated from other employers, and targeted to attract/retain talent by providing meaningful careers within the company. '),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 29, 2, 1, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 29, 2, 2, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 29, 2, 3, 'Articulate in a specific manner how some aspects of the HR policies and practices are aligned to the Employee\'s career development within the firm. '),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 29, 2, 4, 'Define and explain clearly the company\'s employee value proposition which is differentiated from other employers, and targeted to attract/retain talent by providing meaningful careers within the company. '),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 29, 3, 1, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 29, 3, 2, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 29, 3, 3, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 29, 3, 4, 'Define and explain clearly the company\'s employee value proposition which is differentiated from other employers, and targeted to attract/retain talent by providing meaningful careers within the company. '),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 29, 4, 1, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 29, 4, 2, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 29, 4, 3, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 29, 4, 4, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 30, 1, 1, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 30, 1, 2, 'Create a structured process to align some areas of the HR policies and practices to its employee value proposition. '),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 30, 1, 3, 'Create a structured process to align some areas of the HR policies and practices to its employee value proposition. '),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 30, 1, 4, 'Comprehensively integrate HR policies and practices to ensure consistency with the employee value proposition in order to enhance the ability to attract and retain talent as an employer of choice. '),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 30, 2, 1, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 30, 2, 2, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 30, 2, 3, 'Create a structured process to align some areas of the HR policies and practices to its employee value proposition. '),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 30, 2, 4, 'Comprehensively integrate HR policies and practices to ensure consistency with the employee value proposition in order to enhance the ability to attract and retain talent as an employer of choice. '),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 30, 3, 1, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 30, 3, 2, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 30, 3, 3, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 30, 3, 4, 'Comprehensively integrate HR policies and practices to ensure consistency with the employee value proposition in order to enhance the ability to attract and retain talent as an employer of choice. '),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 30, 4, 1, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 30, 4, 2, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 30, 4, 3, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 30, 4, 4, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 31, 1, 1, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 31, 1, 2, 'Implement employer branding initiatives which are in line with the employee value proposition, but target only external or internal audiences. '),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 31, 1, 3, 'Implement employer branding initiatives which are in line with the employee value proposition, but target only external or internal audiences. '),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 31, 1, 4, 'Integrate external employer branding efforts with internal employer branding, aligning both to its employee value proposition, and consequently positioned as an employer of choice amongst perspective, current, and past employees. '),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 31, 2, 1, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 31, 2, 2, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 31, 2, 3, 'Implement employer branding initiatives which are in line with the employee value proposition, but target only external or internal audiences. '),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 31, 2, 4, 'Integrate external employer branding efforts with internal employer branding, aligning both to its employee value proposition, and consequently positioned as an employer of choice amongst perspective, current, and past employees. '),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 31, 3, 1, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 31, 3, 2, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 31, 3, 3, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 31, 3, 4, 'Integrate external employer branding efforts with internal employer branding, aligning both to its employee value proposition, and consequently positioned as an employer of choice amongst perspective, current, and past employees. '),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 31, 4, 1, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 31, 4, 2, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 31, 4, 3, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 31, 4, 4, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 32, 1, 1, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 32, 1, 2, 'Define clearly certain key areas relating to international mobility policies (i.e. expatriate / international assignment compensation & benefits entitlements, relocation, training). The policies should support the company\'s international HR strategy.'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 32, 1, 3, 'Define clearly certain key areas relating to international mobility policies (i.e. expatriate / international assignment compensation & benefits entitlements, relocation, training). The policies should support the company\'s international HR strategy.'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 32, 1, 4, 'Comprehensively define international mobility policies, covering key areas such as expatriate / international assignment programmes, compensation & benefits, relocation, tax treatment, repatriation, training, etc. These policies must be clearly integrated to effectively support the company\'s international HR strategy. '),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 32, 2, 1, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 32, 2, 2, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 32, 2, 3, 'Define clearly certain key areas relating to international mobility policies (i.e. expatriate / international assignment compensation & benefits entitlements, relocation, training). The policies should support the company\'s international HR strategy.'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 32, 2, 4, 'Comprehensively define international mobility policies, covering key areas such as expatriate / international assignment programmes, compensation & benefits, relocation, tax treatment, repatriation, training, etc. These policies must be clearly integrated to effectively support the company\'s international HR strategy. '),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 32, 3, 1, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 32, 3, 2, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 32, 3, 3, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 32, 3, 4, 'Comprehensively define international mobility policies, covering key areas such as expatriate / international assignment programmes, compensation & benefits, relocation, tax treatment, repatriation, training, etc. These policies must be clearly integrated to effectively support the company\'s international HR strategy. '),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 32, 4, 1, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 32, 4, 2, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 32, 4, 3, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 32, 4, 4, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 33, 1, 1, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 33, 1, 2, 'Define key international mobility processes (i.e. international deployment, culture and language training, relocation services); furthermore, employ a resource for the administration of processes and facilitation of international mobility. '),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 33, 1, 3, 'Define key international mobility processes (i.e. international deployment, culture and language training, relocation services); furthermore, employ a resource for the administration of processes and facilitation of international mobility. '),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 33, 1, 4, 'Comprehensively define international mobility policies, such as international manpower planning, assessment/selection, deployment, culture/language training, relocation services, etc.; furthermore, employe a trained resource/team for the adminitration of processes and facilitation of international mobility. '),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 33, 2, 1, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 33, 2, 2, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 33, 2, 3, 'Define key international mobility processes (i.e. international deployment, culture and language training, relocation services); furthermore, employ a resource for the administration of processes and facilitation of international mobility. '),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 33, 2, 4, 'Comprehensively define international mobility policies, such as international manpower planning, assessment/selection, deployment, culture/language training, relocation services, etc.; furthermore, employe a trained resource/team for the adminitration of processes and facilitation of international mobility. '),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 33, 3, 1, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 33, 3, 2, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 33, 3, 3, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 33, 3, 4, 'Comprehensively define international mobility policies, such as international manpower planning, assessment/selection, deployment, culture/language training, relocation services, etc.; furthermore, employe a trained resource/team for the adminitration of processes and facilitation of international mobility. '),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 33, 4, 1, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 33, 4, 2, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 33, 4, 3, 'No Activity'),
  ('EMPLOYEE VALUE PROPOITION (EVP)', 33, 4, 4, 'No Activity'),
  ('INTERNATIONAL ORGANISATION CAPABILITY', 34, 1, 1, 'No Activity'),
  ('INTERNATIONAL ORGANISATION CAPABILITY', 34, 1, 2, 'Create a detailed international growth strategy with basic overseas functions that may be centrally managed at the headquarter country. Roll-out basic operational structures and processes where possible. '),
  ('INTERNATIONAL ORGANISATION CAPABILITY', 34, 1, 3, 'Create a detailed international growth strategy with basic overseas functions that may be centrally managed at the headquarter country. Roll-out basic operational structures and processes where possible. '),
  ('INTERNATIONAL ORGANISATION CAPABILITY', 34, 1, 4, 'Define a clear international growth strategy with the company structured to develop and grow organically in multiple overseas markets, with the management team being well-coordinated and held accountable for international growth. The company is to introduce organisation capabilities and culture which support internationalisation, develop international management competencies, and building an internationally-diversified workforce, itnernational HR structures, etc. '),
  ('INTERNATIONAL ORGANISATION CAPABILITY', 34, 2, 1, 'No Activity'),
  ('INTERNATIONAL ORGANISATION CAPABILITY', 34, 2, 2, 'No Activity'),
  ('INTERNATIONAL ORGANISATION CAPABILITY', 34, 2, 3, 'Create a detailed international growth strategy with basic overseas functions that may be centrally managed at the headquarter country. Roll-out basic operational structures and processes where possible. '),
  ('INTERNATIONAL ORGANISATION CAPABILITY', 34, 2, 4, 'Define a clear international growth strategy with the company structured to develop and grow organically in multiple overseas markets, with the management team being well-coordinated and held accountable for international growth. The company is to introduce organisation capabilities and culture which support internationalisation, develop international management competencies, and building an internationally-diversified workforce, itnernational HR structures, etc. '),
  ('INTERNATIONAL ORGANISATION CAPABILITY', 34, 3, 1, 'No Activity'),
  ('INTERNATIONAL ORGANISATION CAPABILITY', 34, 3, 2, 'No Activity'),
  ('INTERNATIONAL ORGANISATION CAPABILITY', 34, 3, 3, 'No Activity'),
  ('INTERNATIONAL ORGANISATION CAPABILITY', 34, 3, 4, 'Define a clear international growth strategy with the company structured to develop and grow organically in multiple overseas markets, with the management team being well-coordinated and held accountable for international growth. The company is to introduce organisation capabilities and culture which support internationalisation, develop international management competencies, and building an internationally-diversified workforce, itnernational HR structures, etc. '),
  ('INTERNATIONAL ORGANISATION CAPABILITY', 34, 4, 1, 'No Activity'),
  ('INTERNATIONAL ORGANISATION CAPABILITY', 34, 4, 2, 'No Activity'),
  ('INTERNATIONAL ORGANISATION CAPABILITY', 34, 4, 3, 'No Activity'),
  ('INTERNATIONAL ORGANISATION CAPABILITY', 34, 4, 4, 'No Activity');
  -- End

-- linhnx add lock column
ALTER TABLE `t_company_info`
	ADD COLUMN `ID_USER_LOCK` INT(11) NULL AFTER `ID_CONSULTANT_ORG`,
	ADD COLUMN `TIME_LOCK` DATETIME NULL AFTER `ID_USER_LOCK`;
ALTER TABLE `t_company_profile`
	ADD COLUMN `ID_USER_LOCK` INT(11) NULL AFTER `ID_CONSULTANT_ORG`,
	ADD COLUMN `TIME_LOCK` DATETIME NULL AFTER `ID_USER_LOCK`;
-- End
-- ALTER

ALTER TABLE `t_company_info`
	CHANGE COLUMN `ID_USER_LOCK` `ID_SESSION_LOCK` INT(11) NULL DEFAULT NULL AFTER `ID_CONSULTANT_ORG`;
ALTER TABLE `t_company_profile`
	CHANGE COLUMN `ID_USER_LOCK` `ID_SESSION_LOCK` INT(11) NULL DEFAULT NULL;

ALTER TABLE `t_company_info`
	CHANGE COLUMN `ID_SESSION_LOCK` `ID_SESSION_LOCK` VARCHAR(255) NULL DEFAULT NULL AFTER `ID_CONSULTANT_ORG`;
ALTER TABLE `t_company_profile`
	CHANGE COLUMN `ID_USER_LOCK` `ID_SESSION_LOCK` VARCHAR(255) NULL DEFAULT NULL AFTER `ID_CONSULTANT_ORG`;

-- change script 15/5 by huytv
ALTER TABLE `t_company_info`
ADD COLUMN `DATE_CREATION` DATETIME NULL AFTER `ID_CONSULTANT_ORG`;
-- ADD FIELD PHONE NUMBER
ALTER TABLE `t_user`
	ADD COLUMN `PHONE_NUMBER` VARCHAR(16) NULL DEFAULT NULL AFTER `USER_NAME`;

-- linh nx change table
ALTER TABLE `t_company_profile`
	CHANGE COLUMN `ID_SESSION_LOCK` `ID_SESSION_LOCK` VARCHAR(255) NULL DEFAULT NULL AFTER `ID_CONSULTANT_ORG`,
	DROP COLUMN `ID_USER_LOCK`;
ALTER TABLE `t_company_info`
	DROP COLUMN `ID_USER_LOCK`;

-- change dir of image category by huytv
UPDATE t_survey_question
SET url_background = replace(url_background, 'themes/default/images/category_img/', 'img/background/');

-- change script 22/5 by huytv
ALTER TABLE `t_growth_stage`
ADD COLUMN `VALUE_TYPE` VARCHAR(255) NULL AFTER `VALUE`;
UPDATE `t_growth_stage` SET `VALUE_TYPE`='Budding' WHERE  `ID_GS`=1;
UPDATE `t_growth_stage` SET `VALUE_TYPE`='Sustaining' WHERE  `ID_GS`=2;
UPDATE `t_growth_stage` SET `VALUE_TYPE`='Aspiring' WHERE  `ID_GS`=3;
UPDATE `t_growth_stage` SET `VALUE_TYPE`='Expanding' WHERE  `ID_GS`=4;
UPDATE `t_growth_stage` SET `VALUE_TYPE`='Maturing' WHERE  `ID_GS`=5;
UPDATE `t_growth_stage` SET `VALUE_TYPE`='Direct Supervision' WHERE  `ID_GS`=6;
UPDATE `t_growth_stage` SET `VALUE_TYPE`='Supervised Supervision' WHERE  `ID_GS`=7;
UPDATE `t_growth_stage` SET `VALUE_TYPE`='Functional' WHERE  `ID_GS`=8;
UPDATE `t_growth_stage` SET `VALUE_TYPE`='Divisional' WHERE  `ID_GS`=9;
UPDATE `t_growth_stage` SET `VALUE_TYPE`='Decentralized' WHERE  `ID_GS`=10;
UPDATE `t_growth_stage` SET `VALUE_TYPE`='On a Needs Basis' WHERE  `ID_GS`=11;
UPDATE `t_growth_stage` SET `VALUE_TYPE`='Control Constraint' WHERE  `ID_GS`=12;
UPDATE `t_growth_stage` SET `VALUE_TYPE`='Management Responsibility' WHERE  `ID_GS`=13;
UPDATE `t_growth_stage` SET `VALUE_TYPE`='Strategic Resource' WHERE  `ID_GS`=14;
UPDATE `t_growth_stage` SET `VALUE_TYPE`='Integrated into Business' WHERE  `ID_GS`=15;
-- 22/05 QuangDV
INSERT INTO `t_survey_option` (`ID_ANSWER`, `ID_QUESTION`, `NM_ANSWER`, `IN_POINT`) VALUES (137, 32, 'N/A', 0);
INSERT INTO `t_survey_option` (`ID_ANSWER`, `ID_QUESTION`, `NM_ANSWER`, `IN_POINT`) VALUES (138, 33, 'N/A', 0);
INSERT INTO `t_survey_option` (`ID_ANSWER`, `ID_QUESTION`, `NM_ANSWER`, `IN_POINT`) VALUES (139, 34, 'N/A', 0);




-- linhnx update t_dropdown
INSERT INTO `mss`.`t_dropdown` (`NM_TYPE`, `VALUE`) VALUES ('Revenue', '$80M to < $100M');
update t_dropdown set VALUE = '$10M to < $30M' where ID_DROPDOWN = 29;
update t_dropdown set VALUE = '$30M to < $50M' where ID_DROPDOWN = 28;
update t_dropdown set VALUE = '$50M to < $80M' where ID_DROPDOWN = 27;

update t_dropdown set ID_DROPDOWN = '25' where ID_DROPDOWN = '26';
update t_dropdown set ID_DROPDOWN = '26' where VALUE = '$80M to < $100M';

UPDATE `t_dropdown` SET `VALUE`='$5M to < $10M' WHERE  `ID_DROPDOWN`=30;

-- huytv update t_survey_question

UPDATE t_survey_question
SET NM_CATEGORY='EMPLOYEE VALUE PROPOSITION (EVP) or “Employer Unique Selling Point”'
WHERE NM_CATEGORY='EMPLOYEE VALUE PROPOSITION (EVP)';

UPDATE t_survey_question
SET NM_CATEGORY='ORGANISATION CULTURE'
WHERE NM_CATEGORY='OGANISATION CULTURE AND CORE VALUES';

UPDATE t_survey_question
SET NM_CATEGORY='INTERNATIONALIZATION'
WHERE NM_CATEGORY='INTERNATIONAL MOBILITY';


ALTER TABLE `t_gap_analysis_matrix`
CHANGE COLUMN `ID_CATEGORY` `ID_CATEGORY` VARCHAR(250) NOT NULL FIRST;

UPDATE t_gap_analysis_matrix
SET ID_CATEGORY='ORGANISATION CULTURE'
WHERE ID_CATEGORY='ORGANISATION CULTURE AND CORE VALUES';

UPDATE t_gap_analysis_matrix
SET ID_CATEGORY='EMPLOYEE VALUE PROPOSITION (EVP) or “Employer Unique Selling Point”'
WHERE ID_CATEGORY='EMPLOYEE VALUE PROPOSITION (EVP)';

UPDATE t_gap_analysis_matrix
SET ID_CATEGORY='INTERNATIONALIZATION'
WHERE ID_CATEGORY='INTERNATIONAL MOBILITY';

ALTER TABLE `t_gap_analysis_rec`
CHANGE COLUMN `ID_CATEGORY` `ID_CATEGORY` VARCHAR(250) NOT NULL;

UPDATE t_gap_analysis_rec
SET ID_CATEGORY='ORGANISATION CULTURE'
WHERE ID_CATEGORY='ORGANISATION CULTURE AND CORE VALUES';

UPDATE t_gap_analysis_rec
SET ID_CATEGORY='EMPLOYEE VALUE PROPOSITION (EVP) or “Employer Unique Selling Point”'
WHERE ID_CATEGORY='EMPLOYEE VALUE PROPOSITION (EVP)';

UPDATE t_gap_analysis_rec
SET ID_CATEGORY='INTERNATIONALIZATION'
WHERE ID_CATEGORY='INTERNATIONAL MOBILITY';

ALTER TABLE `t_survey_benchmark_dtl`
CHANGE COLUMN `NM_CATEGORY` `NM_CATEGORY` VARCHAR(250) NOT NULL;

UPDATE t_survey_benchmark_dtl
SET NM_CATEGORY='ORGANISATION CULTURE'
WHERE NM_CATEGORY='ORGANISATION CULTURE AND CORE VALUES';

UPDATE t_survey_benchmark_dtl
SET NM_CATEGORY='EMPLOYEE VALUE PROPOSITION (EVP) or “Employer Unique Selling Point”'
WHERE NM_CATEGORY='EMPLOYEE VALUE PROPOSITION (EVP)';

UPDATE t_survey_benchmark_dtl
SET NM_CATEGORY='INTERNATIONALIZATION'
WHERE NM_CATEGORY='INTERNATIONAL MOBILITY';

ALTER TABLE `t_gap_analysis_rec`
ALTER `TX_DEFAULT` DROP DEFAULT,
ALTER `TX_RECOMMENDATION` DROP DEFAULT;

ALTER TABLE `t_gap_analysis_rec`
CHANGE COLUMN `TX_DEFAULT` `TX_DEFAULT` TEXT NOT NULL AFTER `IN_SCORE`,
CHANGE COLUMN `TX_RECOMMENDATION` `TX_RECOMMENDATION` TEXT NOT NULL AFTER `TX_DEFAULT`;

ALTER TABLE `t_company_profile`
CHANGE COLUMN `TX_NOTES_1` `TX_NOTES_1` TEXT NULL DEFAULT NULL AFTER `ID_REPORT_TYPE`,
CHANGE COLUMN `TX_NOTES_2` `TX_NOTES_2` TEXT NULL DEFAULT NULL AFTER `TX_NOTES_1`,
  CHANGE COLUMN `TX_NOTES_3` `TX_NOTES_3` TEXT NULL DEFAULT NULL AFTER `TX_NOTES_2`;