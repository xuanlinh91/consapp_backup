##GIAMPQ
##01/05/2014##
## Add table ci_sessions ##

CREATE TABLE IF NOT EXISTS  `ci_sessions` (
	session_id varchar(40) DEFAULT '0' NOT NULL,
	ip_address varchar(45) DEFAULT '0' NOT NULL,
	user_agent varchar(120) NOT NULL,
	last_activity int(10) unsigned DEFAULT 0 NOT NULL,
	user_data text NOT NULL,
	PRIMARY KEY (session_id),
	KEY `last_activity_idx` (`last_activity`)
);

##Change script End##

##GIAMPQ
##31/03/2014##
## Add table email_template  and Dumping data##

CREATE TABLE IF NOT EXISTS `email_template` (
  `ID` smallint(6) NOT NULL AUTO_INCREMENT,
  `TYPE` varchar(100) NOT NULL,
  `TEMPLATE_KEY` varchar(100) NOT NULL,
  `TEMPLATE_SUBJECT` varchar(100),
  `TEMPLATE_BODY` text,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Email templae using active accout, forgot password/id , report....' AUTO_INCREMENT=4 ;

DELETE FROM `email_template`

INSERT INTO `email_template` (`ID`, `TYPE`, `TEMPLATE_KEY`, `TEMPLATE_SUBJECT`, `TEMPLATE_BODY`) VALUES
(1, 'EMAIL', 'ACTIVE_ACCOUNT', 'ACTIVE ACCOUNT', ''),
(2, 'EMAIL', 'FORGOT_ID', 'SUBJECT : GET ID', '<!DOCTYPE html>
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
                        <div class="header-content" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;color:#888888;"><a href="{HOME_PAGE}" style="font-weight:bold;color:#eeeeee;text-decoration:none;">Home Page</a><span class="hide">&nbsp;&nbsp;|&nbsp;</span>
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
                          <p style="color:#000c8f;font-family:HelveticaNeue, sans-serif;font-size:36px;text-align:center;margin-top:0px;margin-bottom:30px;"> <strong><a href="http://vietnam.createsend1.com/t/d-l-fjhkky-l-d/" style="color:#000c8f;text-decoration:none;">Hay Group Company</a></strong> </p>
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
                              <td class="w580" width="580" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><p align="left" class="article-title" style="font-size:18px;line-height:24px;color:#0f0080;font-weight:bold;margin-top:0px;margin-bottom:18px;font-family:HelveticaNeue, sans-serif;">Request  Retrieve Username</p>
                                <div align="left" class="article-content" style="font-size:14px;line-height:14px;color:#444444;margin-top:0px;margin-bottom:18px;font-family:HelveticaNeue, sans-serif;">Hi, 
                                <p>You or someone has sent request reminded username,</p>
                                </br>
                                <p>Username: <strong>{ID_LOGIN}</strong></p>
                                </br>
                                <p>Click<a href="{LINK_LOGIN}"><em> Here </em></a>to login</p>
                                <p>if you are not requirement, please ignore email of this, Thanks you</p>
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
                        <p align="left" class="footer-content-left" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;line-height:15px;color:#888888;margin-top:0px;margin-bottom:15px;"><a href="#">{ALT_BODY}</a> |</p></td>
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
</html>
'),
(3, 'EMAIL', 'FORGOT_PASSWORD', 'SUBJECT : GET PASSWORD', '<!DOCTYPE html>
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
                        <div class="header-content" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;color:#888888;"><a href="{HOME_PAGE}" style="font-weight:bold;color:#eeeeee;text-decoration:none;">Home Page</a><span class="hide">&nbsp;&nbsp;|&nbsp;</span>
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
                          <p style="color:#000c8f;font-family:HelveticaNeue, sans-serif;font-size:36px;text-align:center;margin-top:0px;margin-bottom:30px;"> <strong><a href="http://vietnam.createsend1.com/t/d-l-fjhkky-l-d/" style="color:#000c8f;text-decoration:none;">Hay Group Company</a></strong> </p>
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
                                <p>Click<a href="{LINK_CHANGEPASSWORD}"><em> Here </em></a>to auto login and go to change password</p>
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
                        <p align="left" class="footer-content-left" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;line-height:15px;color:#888888;margin-top:0px;margin-bottom:15px;"><a href="#">{ALT_BODY}</a> |</p></td>
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
</html>
');

##Change script End##


##GIAMPQ##
##01/03/2014##
##Table structure for table `t_survey_response_hdr`##

CREATE TABLE IF NOT EXISTS `t_survey_response_hdr` (
  `ID_SURVEY` int(11) NOT NULL AUTO_INCREMENT,
  `ID_COMPANY` int(11) NOT NULL,
  `DT_SURVEY_START` datetime NOT NULL,
  `DT_SURVEY_COMPLETE` datetime DEFAULT NULL,
  `INT_CAT1` int(11) NOT NULL,
  `INT_CAT2` int(11) NOT NULL,
  `INT_CAT3` int(11) NOT NULL,
  `INT_CAT4` int(11) NOT NULL,
  `INT_CAT5` int(11) NOT NULL,
  `INT_CAT6` int(11) NOT NULL,
  `INT_CAT7` int(11) NOT NULL,
  `INT_CAT8` int(11) NOT NULL,
  `INT_CAT9` int(11) NOT NULL,
  `INT_CAT10` int(11) NOT NULL,
  `INT_CAT11` int(11) NOT NULL,
  `INT_PT` int(11) NOT NULL,
  `TX_STATUS` varchar(250) NOT NULL,
  `CONSULTANT_ID` text NOT NULL,
  PRIMARY KEY (`ID_SURVEY`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

##Change script End##


##GIAMPQ##
##01/05/2014##
##Table structure for table `t_survey_option`##

CREATE TABLE IF NOT EXISTS `t_survey_option` (
  `ID_OPTION` int(11) NOT NULL AUTO_INCREMENT,
  `ID_QUESTION` int(11) NOT NULL,
  `ID_ANSWER` int(11) NOT NULL,
  `NM_ANSWER` varchar(250) NOT NULL,
  PRIMARY KEY (`ID_OPTION`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

##Change script End##


##GIAMPQ##
##01/05/2014##
##Table structure for table `t_survey_response`##

CREATE TABLE IF NOT EXISTS `t_survey_response` (
  `ID_SURVEY` int(11) NOT NULL AUTO_INCREMENT,
  `ID_COMPANY` int(11) NOT NULL,
  `ID_QUESTION` int(11) NOT NULL,
  `ID_ANSWER` int(11) NOT NULL,
  PRIMARY KEY (`ID_SURVEY`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

##Change script End##

##GIAMPQ##
##01/05/2014##
##Table structure for table `t_survey_response_dtl`##

CREATE TABLE IF NOT EXISTS `t_survey_response_dtl` (
  `ID_SURVEY` int(11) NOT NULL AUTO_INCREMENT,
  `ID_CATEGORY` int(11) NOT NULL,
  `ID_QUESTION` int(11) NOT NULL,
  `ID_ANSWER` int(11) NOT NULL,
  PRIMARY KEY (`ID_SURVEY`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

##Change script End##

##GIAMPQ##
##01/05/2014##
##Table structure for table `t_survey_benchmark_hdr`##

CREATE TABLE IF NOT EXISTS `t_survey_benchmark_hdr` (
  `ID_MATURITY` int(11) NOT NULL AUTO_INCREMENT,
  `NM_CATEGORY` varchar(250) NOT NULL,
  `INT_CAT` int(11) NOT NULL,
  PRIMARY KEY (`ID_MATURITY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

##Change script End##

##GIAMPQ##
##01/05/2014##
##Change data for table `t_survey_benchmark_hdr`##
--
-- Delete data for table `t_dropdown`
--

DELETE FROM `t_dropdown`;

--
-- Dumping data for table `t_dropdown`
--

INSERT INTO `t_dropdown` (`ID_DROPDOWN`, `NM_TYPE`, `VALUE`) VALUES
(1, 'Company_Industry', 'Biomedical & Healthcare Services'),
(2, 'Company_Industry', 'Education'),
(3, 'Company_Industry', 'Electronics'),
(4, 'Company_Industry', 'Environmental, Chemical & Engineering Services'),
(5, 'Company_Industry', 'Food and Beverage Services'),
(6, 'Company_Industry', 'Food Manufacturing'),
(7, 'Company_Industry', 'Furniture'),
(8, 'Company_Industry', 'Logistics'),
(9, 'Company_Industry', 'Marine & Offshore Engineering'),
(10, 'Company_Industry', 'Precision Engineering'),
(11, 'Company_Industry', 'Printing'),
(12, 'Company_Industry', 'Retail'),
(13, 'Company_Industry', 'Textile & Apparel'),
(14, 'Company_Industry', 'Other'),
(15, 'Company_Type', 'Corporation'),
(16, 'Company_Type', 'Partnership'),
(17, 'Company_Type', 'Limited Partnership'),
(18, 'Company_Type', 'Limited Liability Partnership'),
(19, 'Company_Type', 'Private Limited Company'),
(20, 'Company_Type', 'Exempt Private Limited Company'),
(21, 'Company_Type', 'Gazetted Private Limited Company'),
(22, 'Company_Type', 'Company Limited by Share'),
(23, 'Company_Type', 'Company Limited by Guarantee'),
(24, 'Company_Type', 'Foreign Companies (Singapore Branch Office)'),
(25, 'Company_Type', 'Representative Office'),
(26, 'Revenue', 'More than $200m'),
(27, 'Revenue', '$150m - $200m'),
(28, 'Revenue', '$100m - $150m'),
(29, 'Revenue', '$50m - $100m'),
(30, 'Revenue', '$25m - $50m'),
(31, 'Revenue', '$10m - $25m'),
(32, 'Revenue', '$5m - $10m'),
(33, 'Revenue', '$1m - $5m'),
(34, 'Revenue', 'Less than $1m'),
(35, 'Total_Staff', 'More than 1300'),
(36, 'Total_Staff', '800 – 1300'),
(37, 'Total_Staff', '400 – 800'),
(38, 'Total_Staff', '201 – 400'),
(39, 'Total_Staff', '101 – 200'),
(40, 'Total_Staff', '51 – 100'),
(41, 'Total_Staff', 'Less than 50'),
(42, 'HR_Staff', 'More than 10'),
(43, 'HR_Staff', '6 – 10'),
(44, 'HR_Staff', '3 – 5'),
(45, 'HR_Staff', '1 – 2'),
(46, 'HR_Staff', 'No dedicated HR team'),
(47, 'HR_Staff', 'HR function is outsourced');

##Change script End##


##GIAMPQ##
##01/05/2014##
##Add data for table `t_user`##

DELETE FROM `t_user`

INSERT INTO `t_user` (`ID_USER`, `ID_LOGIN`, `EN_PASSWORD`, `IN_ADMIN`, `IN_CONSULTANT`, `IN_USER`, `NM_ORGANISATION`, `NM_USER`, `TX_USEREMAIL`, `DT_LAST_LOGIN`, `IN_ACTIVE`, `TX_ACTIVE_CODE`, `TX_SECURITY_CODE`) VALUES
(1, 'ADMINISTRATOR', 'e10adc3949ba59abbe56e057f20f883e', b'1', b'0', b'0', 'HAY GROUP ', 'ADMINISTRATOR', 'phanquocgiam@gmail.com', '2014-05-01 10:35:14', 1, '578646D69', 'b737e210185e346700603865bad905d9'),
(2, 'USERNORMAL', 'e10adc3949ba59abbe56e057f20f883e', b'0', b'0', b'1', 'HAY GROUP', 'USERNORMAL', 'ubuntu.server.sync@gmail.com', '2014-04-28 01:06:22', 1, 'F9BCBB53F', NULL),
(3, 'CONSULTANT', 'e10adc3949ba59abbe56e057f20f883e', b'0', b'1', b'0', 'HAY GROUP', 'CONSULTANT', 'ubuntu.server.amd64@gmail.com', '2014-04-29 10:14:18', 1, '578646D69', 'f752a9858dd6f6919e27bee85d519858');



##Change script End##
##GIAMPQ##
##13/05/2014##
##Add data for table `email_template` - template email wekkly notification##

INSERT INTO `email_template` (`ID`, `TYPE`, `TEMPLATE_KEY`, `TEMPLATE_SUBJECT`, `TEMPLATE_BODY`) VALUES
(4, 'EMAIL', 'WEEKLY_NOTIFICATION', 'SUBJECT : WEEKLY NOTIFICATION', '<!DOCTYPE html>\n<html>\n<head>\n<title>HAY GROUP COMPANY</title>\n<meta http-equiv="Content-Type" content="text/html; charset=utf-8">\n<meta name="viewport" content="width=320, target-densitydpi=device-dpi">\n<style type="text/css">\n@media only screen and (max-width: 660px) {\ntable[class=w0], td[class=w0] {\n  width: 0 !important;\n}\ntable[class=w10], td[class=w10], img[class=w10] {\n  width: 10px !important;\n}\ntable[class=w15], td[class=w15], img[class=w15] {\n  width: 5px !important;\n}\ntable[class=w30], td[class=w30], img[class=w30] {\n  width: 10px !important;\n}\ntable[class=w60], td[class=w60], img[class=w60] {\n  width: 10px !important;\n}\ntable[class=w125], td[class=w125], img[class=w125] {\n  width: 80px !important;\n}\ntable[class=w130], td[class=w130], img[class=w130] {\n  width: 55px !important;\n}\ntable[class=w140], td[class=w140], img[class=w140] {\n  width: 90px !important;\n}\ntable[class=w160], td[class=w160], img[class=w160] {\n  width: 180px !important;\n}\ntable[class=w170], td[class=w170], img[class=w170] {\n  width: 100px !important;\n}\ntable[class=w180], td[class=w180], img[class=w180] {\n  width: 80px !important;\n}\ntable[class=w195], td[class=w195], img[class=w195] {\n  width: 80px !important;\n}\ntable[class=w220], td[class=w220], img[class=w220] {\n  width: 80px !important;\n}\ntable[class=w240], td[class=w240], img[class=w240] {\n  width: 180px !important;\n}\ntable[class=w255], td[class=w255], img[class=w255] {\n  width: 185px !important;\n}\ntable[class=w275], td[class=w275], img[class=w275] {\n  width: 135px !important;\n}\ntable[class=w280], td[class=w280], img[class=w280] {\n  width: 135px !important;\n}\ntable[class=w300], td[class=w300], img[class=w300] {\n  width: 140px !important;\n}\ntable[class=w325], td[class=w325], img[class=w325] {\n  width: 95px !important;\n}\ntable[class=w360], td[class=w360], img[class=w360] {\n  width: 140px !important;\n}\ntable[class=w410], td[class=w410], img[class=w410] {\n  width: 180px !important;\n}\ntable[class=w470], td[class=w470], img[class=w470] {\n  width: 200px !important;\n}\ntable[class=w580], td[class=w580], img[class=w580] {\n  width: 280px !important;\n}\ntable[class=w640], td[class=w640], img[class=w640] {\n  width: 300px !important;\n}\ntable[class*=hide], td[class*=hide], img[class*=hide], p[class*=hide], span[class*=hide] {\n  display: none !important;\n}\ntable[class=h0], td[class=h0] {\n  height: 0 !important;\n}\np[class=footer-content-left] {\n  text-align: center !important;\n}\n#headline p {\n  font-size: 30px !important;\n}\n.article-content, #left-sidebar {\n  -webkit-text-size-adjust: 90% !important;\n  -ms-text-size-adjust: 90% !important;\n}\n.header-content, .footer-content-left {\n  -webkit-text-size-adjust: 80% !important;\n  -ms-text-size-adjust: 80% !important;\n}\nimg {\n  height: auto;\n  line-height: 100%;\n}\n}\n#outlook a {\n  padding: 0;\n}\nbody {\n  width: 100% !important;\n}\n.ReadMsgBody {\n  width: 100%;\n}\n.ExternalClass {\n  width: 100%;\n  display: block !important;\n}\nbody {\n  background-color: #c7c7c7;\n  margin: 0;\n  padding: 0;\n}\nimg {\n  outline: none;\n  text-decoration: none;\n  display: block;\n}\nbr, strong br, b br, em br, i br {\n  line-height: 100%;\n}\nh1, h2, h3, h4, h5, h6 {\n  line-height: 100% !important;\n  -webkit-font-smoothing: antialiased;\n}\nh1 a, h2 a, h3 a, h4 a, h5 a, h6 a {\n  color: blue !important;\n}\nh1 a:active, h2 a:active, h3 a:active, h4 a:active, h5 a:active, h6 a:active {\n  color: red !important;\n}\nh1 a:visited, h2 a:visited, h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited {\n  color: purple !important;\n}\ntable td, table tr {\n  border-collapse: collapse;\n}\n.yshortcuts, .yshortcuts a, .yshortcuts a:link, .yshortcuts a:visited, .yshortcuts a:hover, .yshortcuts a span {\n  color: black;\n  text-decoration: none !important;\n  border-bottom: none !important;\n  background: none !important;\n}\ncode {\n  white-space: normal;\n  word-break: break-all;\n}\n#background-table {\n  background-color: #c7c7c7;\n}\n#top-bar {\n  border-radius: 6px 6px 0px 0px;\n  -moz-border-radius: 6px 6px 0px 0px;\n  -webkit-border-radius: 6px 6px 0px 0px;\n  -webkit-font-smoothing: antialiased;\n  background-color: #2E2E2E;\n  color: #888888;\n}\n#top-bar a {\n  font-weight: bold;\n  color: #eeeeee;\n  text-decoration: none;\n}\n#footer {\n  border-radius: 0px 0px 6px 6px;\n  -moz-border-radius: 0px 0px 6px 6px;\n  -webkit-border-radius: 0px 0px 6px 6px;\n  -webkit-font-smoothing: antialiased;\n}\nbody, td {\n  font-family: HelveticaNeue, sans-serif;\n}\n.header-content, .footer-content-left, .footer-content-right {\n  -webkit-text-size-adjust: none;\n  -ms-text-size-adjust: none;\n}\n.header-content {\n  font-size: 12px;\n  color: #888888;\n}\n.header-content a {\n  font-weight: bold;\n  color: #eeeeee;\n  text-decoration: none;\n}\n#headline p {\n  color: #000c8f;\n  font-family: HelveticaNeue, sans-serif;\n  font-size: 36px;\n  text-align: center;\n  margin-top: 0px;\n  margin-bottom: 30px;\n}\n#headline p a {\n  color: #000c8f;\n  text-decoration: none;\n}\n.article-title {\n  font-size: 18px;\n  line-height: 24px;\n  color: #0f0080;\n  font-weight: bold;\n  margin-top: 0px;\n  margin-bottom: 18px;\n  font-family: HelveticaNeue, sans-serif;\n}\n.article-title a {\n  color: #0f0080;\n  text-decoration: none;\n}\n.article-title.with-meta {\n  margin-bottom: 0;\n}\n.article-meta {\n  font-size: 13px;\n  line-height: 20px;\n  color: #ccc;\n  font-weight: bold;\n  margin-top: 0;\n}\n.article-content {\n  font-size: 13px;\n  line-height: 18px;\n  color: #444444;\n  margin-top: 0px;\n  margin-bottom: 18px;\n  font-family: HelveticaNeue, sans-serif;\n}\n.article-content a {\n  color: #2f82de;\n  font-weight: bold;\n  text-decoration: none;\n}\n.article-content img {\n  max-width: 100%\n}\n.article-content ol, .article-content ul {\n  margin-top: 0px;\n  margin-bottom: 18px;\n  margin-left: 19px;\n  padding: 0;\n}\n.article-content li {\n  font-size: 13px;\n  line-height: 18px;\n  color: #444444;\n}\n.article-content li a {\n  color: #2f82de;\n  text-decoration: underline;\n}\n.article-content p {\n  margin-bottom: 15px;\n}\n.footer-content-left {\n  font-size: 12px;\n  line-height: 15px;\n  color: #888888;\n  margin-top: 0px;\n  margin-bottom: 15px;\n}\n.footer-content-left a {\n  color: #eeeeee;\n  font-weight: bold;\n  text-decoration: none;\n}\n.footer-content-right {\n  font-size: 11px;\n  line-height: 16px;\n  color: #888888;\n  margin-top: 0px;\n  margin-bottom: 15px;\n}\n.footer-content-right a {\n  color: #eeeeee;\n  font-weight: bold;\n  text-decoration: none;\n}\n#footer {\n  background-color: #000000;\n  color: #888888;\n}\n#footer a {\n  color: #eeeeee;\n  text-decoration: none;\n  font-weight: bold;\n}\n#permission-reminder {\n  white-space: normal;\n}\n#street-address {\n  color: #ffffff;\n  white-space: normal;\n}\n#email-footer{\n    width: 1024 px !important;\n}\n</style>\n<!--[if gte mso 9]>\n<style _tmplitem="10222" >\n.article-content ol, .article-content ul {\n   margin: 0 0 0 24px !important;\n   padding: 0 !important;\n   list-style-position: inside !important;\n}\n</style>\n<![endif]-->\n<meta name="robots" content="noindex,nofollow">\n<meta property="og:title" content="Hay Group">\n</head>\n<body style="width:100% !important;background-color:#c7c7c7;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:HelveticaNeue, sans-serif;">\n<table width="100%" cellpadding="0" cellspacing="0" border="0" id="background-table" style="background-color:#c7c7c7;">\n  <tbody>\n    <tr style="border-collapse:collapse;">\n      <td align="center" bgcolor="#c7c7c7" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w640" width="640" cellpadding="0" cellspacing="0" border="0" style="margin-top:0;margin-bottom:0;margin-right:10px;margin-left:10px;">\n          <tbody>\n            <tr style="border-collapse:collapse;">\n              <td class="w640" width="640" height="20" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n            </tr>\n            <tr style="border-collapse:collapse;">\n              <td class="w640" width="640" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table id="top-bar" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" style="border-radius:6px 6px 0px 0px;-moz-border-radius:6px 6px 0px 0px;-webkit-border-radius:6px 6px 0px 0px;-webkit-font-smoothing:antialiased;background-color:#2E2E2E;color:#888888;">\n                  <tbody>\n                    <tr style="border-collapse:collapse;">\n                      <td class="w15" width="15" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w325" width="350" valign="middle" align="left" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">\n                          <tbody>\n                            <tr style="border-collapse:collapse;">\n                              <td class="w325" width="350" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                            </tr>\n                          </tbody>\n                        </table>\n                        <div class="header-content" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;color:#888888;"><a href="{HOME_PAGE}" style="font-weight:bold;color:#eeeeee;text-decoration:none;">Home Page</a><span class="hide">&nbsp;&nbsp;|&nbsp;</span>\n                        </div>\n                        <table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">\n                          <tbody>\n                            <tr style="border-collapse:collapse;">\n                              <td class="w325" width="350" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                            </tr>\n                          </tbody>\n                        </table></td>\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w255" width="255" valign="middle" align="right" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">\n                          <tbody>\n                            <tr style="border-collapse:collapse;">\n                              <td class="w255" width="255" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                            </tr>\n                          </tbody>\n                        </table>\n                        <table cellpadding="0" cellspacing="0" border="0">\n                          <tbody>\n                            <tr style="border-collapse:collapse;"> </tr>\n                          </tbody>\n                        </table>\n                        <table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">\n                          <tbody>\n                            <tr style="border-collapse:collapse;">\n                              <td class="w255" width="255" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                            </tr>\n                          </tbody>\n                        </table></td>\n                      <td class="w15" width="15" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                    </tr>\n                  </tbody>\n                </table></td>\n            </tr>\n            <tr style="border-collapse:collapse;">\n              <td id="header" class="w640" width="640" align="center" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w640" width="640" cellpadding="0" cellspacing="0" border="0">\n                  <tbody>\n                    <tr style="border-collapse:collapse;">\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w580" width="580" height="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                    </tr>\n                    <tr style="border-collapse:collapse;">\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w580" width="580" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><div align="center" id="headline">\n                          <p style="color:#000c8f;font-family:HelveticaNeue, sans-serif;font-size:36px;text-align:center;margin-top:0px;margin-bottom:30px;"> <strong><a href="http://vietnam.createsend1.com/t/d-l-fjhkky-l-d/" style="color:#000c8f;text-decoration:none;">Hay Group Company</a></strong> </p>\n                        </div></td>\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                    </tr>\n                  </tbody>\n                </table></td>\n            </tr>\n            <tr style="border-collapse:collapse;">\n              <td class="w640" width="640" height="30" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n            </tr>\n            <tr id="simple-content-row" style="border-collapse:collapse;">\n              <td class="w640" width="640" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table align="left" class="w640" width="640" cellpadding="0" cellspacing="0" border="0">\n                  <tbody>\n                    <tr style="border-collapse:collapse;">\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w580" width="580" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w580" width="580" cellpadding="0" cellspacing="0" border="0">\n                          <tbody>\n                            <tr style="border-collapse:collapse;">\n                              <td class="w580" width="580" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><p align="left" class="article-title" style="font-size:18px;line-height:24px;color:#0f0080;font-weight:bold;margin-top:0px;margin-bottom:18px;font-family:HelveticaNeue, sans-serif;">Weekly Notification</p>\n                                <div align="left" class="article-content" style="font-size:14px;line-height:14px;color:#444444;margin-top:0px;margin-bottom:18px;font-family:HelveticaNeue, sans-serif;">\n                                <p></p>\n                                </br>\n                                <p>Hi, <strong>{ID_LOGIN}</strong></p>\n                                </br>\n                                <p>Please find attached the weekly report generated on {DT_CREATE} .Thank you. </p>\n                                <p>If you do not be found the file attached! please click <a href="{LINK_DOWN}"><em> here </em></a> to download</p>\n                                </div>\n                              </td>\n                            </tr>\n                            <tr style="border-collapse:collapse;">\n                              <td class="w580" width="580" height="10" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                            </tr>\n                          </tbody>\n                        </table></td>\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                    </tr>\n                  </tbody>\n                </table></td>\n            </tr>\n            <tr style="border-collapse:collapse;">\n              <td class="w640" width="640" height="15" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n            </tr>\n            <tr style="border-collapse:collapse;">\n              <td class="w640" width="640" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table id="footer" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#000000" style="border-radius:0px 0px 6px 6px;-moz-border-radius:0px 0px 6px 6px;-webkit-border-radius:0px 0px 6px 6px;-webkit-font-smoothing:antialiased;background-color:#000000;color:#888888;">\n                  <tbody>\n                    <tr style="border-collapse:collapse;">\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w580 h0" width="360" height="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w0" width="60" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w0" width="160" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                    </tr>\n                    <tr style="border-collapse:collapse;">\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;padding-left: 20px;"></td>\n                      <td class="w580" width="90%" valign="top" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><span class="hide">\n                        <p id="permission-reminder" align="left" class="footer-content-left" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;line-height:15px;color:#888888;margin-top:0px;margin-bottom:15px;white-space:normal;"><span>About Hay Group</span><br style="line-height:100%;">\n                          <span>Hay Group is a global management consulting firm that works with leaders to transform strategy into reality. We develop talent, organize people to be more effective and motivate them to perform at their best.</span></p>\n                        </span>\n                        <p align="left" class="footer-content-left" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;line-height:15px;color:#888888;margin-top:0px;margin-bottom:15px;"><a href="#">{ALT_BODY}</a> |</p></td>\n                    </tr>\n                    <tr style="border-collapse:collapse;">\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w580 h0" width="360" height="15" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                    </tr>\n                  </tbody>\n                </table></td>\n            </tr>\n            <tr style="border-collapse:collapse;">\n              <td class="w640" width="640" height="60" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n            </tr>\n          </tbody>\n        </table></td>\n    </tr>\n  </tbody>\n</table>\n</body>\n</html>\n');

##Change script End##



##Change script End##
##GIAMPQ##
##14/05/2014##
##ALTER TABLE 't_survey_option' fix size of column NM_ANSWER##

ALTER TABLE `t_survey_option` MODIFY `NM_ANSWER` VARCHAR( 500 ) NOT NULL;

##GIAMPQ##
##14/05/2014##
## insert data in `t_user`


INSERT INTO `t_user` (`ID_USER`, `ID_LOGIN`, `EN_PASSWORD`, `IN_ADMIN`, `IN_CONSULTANT`, `IN_USER`, `NM_ORGANISATION`, `NM_USER`, `TX_USEREMAIL`, `DT_LAST_LOGIN`, `IN_ACTIVE`, `TX_ACTIVE_CODE`, `TX_SECURITY_CODE`) VALUES
(4, 'ADMINROLE1', 'e10adc3949ba59abbe56e057f20f883e', b'1', b'0', b'0', 'HAY GROUP ', 'ADMINISTRATOR', 'phamquynh.dhv@gmail.com', '2014-05-01 10:35:14', 1, '578646D69', NULL),
(5, 'USERNORMAL1', 'e10adc3949ba59abbe56e057f20f883e', b'0', b'0', b'1', 'HAY GROUP', 'USERNORMAL', 'phamquynh.dhv123@gmail.com', '2014-04-28 01:06:22', 1, 'F9BCBB53F', NULL),
(6, 'CONSULTANT1', 'e10adc3949ba59abbe56e057f20f883e', b'0', b'1', b'0', 'HAY GROUP', 'CONSULTANT', 'phamquynh.dhv1234@gmail.com', '2014-04-29 10:14:18', 1, '578646D69', NULL),
(7, 'ADMINROLE2', 'e10adc3949ba59abbe56e057f20f883e', b'1', b'0', b'0', 'HAY GROUP ', 'ADMINISTRATOR', 'hoangngocha52@gmail.com', '2014-05-01 10:35:14', 1, '578646D69', NULL),
(8, 'USERNORMAL2', 'e10adc3949ba59abbe56e057f20f883e', b'0', b'0', b'1', 'HAY GROUP', 'USERNORMAL', 'hoangngocha52123@gmail.com', '2014-04-28 01:06:22', 1, 'F9BCBB53F', NULL),
(9, 'CONSULTANT2', 'e10adc3949ba59abbe56e057f20f883e', b'0', b'1', b'0', 'HAY GROUP', 'CONSULTANT', 'hoangngocha521234@gmail.com', '2014-04-29 10:14:18', 1, '578646D69', NULL),
(10, 'ADMINROLE3', 'e10adc3949ba59abbe56e057f20f883e', b'1', b'0', b'0', 'HAY GROUP ', 'ADMINISTRATOR', 'phamthuynhung92@gmail.com', '2014-05-01 10:35:14', 1, '578646D69', NULL),
(11, 'USERNORMAL3', 'e10adc3949ba59abbe56e057f20f883e', b'0', b'0', b'1', 'HAY GROUP', 'USERNORMAL', 'phamthuynhung92123@gmail.com', '2014-04-28 01:06:22', 1, 'F9BCBB53F', NULL),
(12, 'CONSULTANT3', 'e10adc3949ba59abbe56e057f20f883e', b'0', b'1', b'0', 'HAY GROUP', 'CONSULTANT', 'phamthuynhung921234@gmail.com', '2014-04-29 10:14:18', 1, '578646D69', NULL),
(13, 'ADMINROLE4', 'e10adc3949ba59abbe56e057f20f883e', b'1', b'0', b'0', 'HAY GROUP ', 'ADMINISTRATOR','truong.van.phu@bpotech.com.vn', '2014-05-01 10:35:14', 1, '578646D69', NULL),
(14, 'USERNORMAL4', 'e10adc3949ba59abbe56e057f20f883e', b'0', b'0', b'1', 'HAY GROUP', 'USERNORMAL', 'truong.van.phu.123@bpotech.com.vn', '2014-04-28 01:06:22', 1, 'F9BCBB53F', NULL),
(15, 'CONSULTANT4', 'e10adc3949ba59abbe56e057f20f883e', b'0', b'1', b'0', 'HAY GROUP', 'CONSULTANT', 'truong.van.phu.1234@bpotech.com.vn', '2014-04-29 10:14:18', 1, '578646D69', NULL),
(16, 'ADMINROLE5', 'e10adc3949ba59abbe56e057f20f883e', b'1', b'0', b'0', 'HAY GROUP ', 'ADMINISTRATOR', 'tnghuy.it@gmail.com', '2014-05-01 10:35:14', 1, '578646D69', NULL),
(17, 'USERNORMAL5', 'e10adc3949ba59abbe56e057f20f883e', b'0', b'0', b'1', 'HAY GROUP', 'USERNORMAL', 'avensut.it@gmail.com', '2014-04-28 01:06:22', 1, 'F9BCBB53F', NULL),
(18, 'CONSULTANT5', 'e10adc3949ba59abbe56e057f20f883e', b'0', b'1', b'0', 'HAY GROUP', 'CONSULTANT', 'tng.avensut@gmail.com', '2014-04-29 10:14:18', 1, '578646D69', NULL),
(19, 'ADMINROLE6', 'e10adc3949ba59abbe56e057f20f883e', b'1', b'0', b'0', 'HAY GROUP ', 'ADMINISTRATOR', 'phanquocgiam.apple@gmail.com', '2014-05-01 10:35:14', 1, '578646D69', NULL),
(20, 'USERNORMAL6', 'e10adc3949ba59abbe56e057f20f883e', b'0', b'0', b'1', 'HAY GROUP', 'USERNORMAL', 'phanquocgiam.phanquocgiam@yahoo.com', '2014-04-28 01:06:22', 1, 'F9BCBB53F', NULL),
(21, 'CONSULTANT6', 'e10adc3949ba59abbe56e057f20f883e', b'0', b'1', b'0', 'HAY GROUP', 'CONSULTANT', 'phanquocgiam.samsung@gmail.com', '2014-04-29 10:14:18', 1, '578646D69', NULL);


##Change script End##


##Change script End##
##GIAMPQ##
##22/05/2014##

# insert data to TABLE `t_survey_option`

DELETE FROM `t_survey_option`


INSERT INTO `t_survey_option` (`ID_ANSWER`, `ID_QUESTION`, `NM_ANSWER`, `IN_POINT`) VALUES
(1, 1, 'The job requirements of the vacancy, such as required skills, knowledge, qualifications, personal traits, etc are not specified', 1),
(2, 1, 'The job requirements of the vacancy are vaguely documented in some form, e.g. JD or job advertisements, but widely open to interpretation', 2),
(3, 1, 'The job requirements of the vacancy are clearly articulated and documented in JDs, matching the job responsibilities', 3),
(4, 1, 'The job requirements of the vacancy are clearly articulated and documented in JDs, and have been calibrated to match with internal career progression levels and grading structures', 4),
(5, 2, 'Candidate recruitment criteria are undocumented; hiring is mainly based on ‘gut feel’', 1),
(6, 2, 'Generic, broad-based criteria have been outlined but are not necessarily specific to job requirements', 2),
(7, 2, 'Recruitment criteria have been identified for specific job requirements, with sufficient detail to guide recruitment process', 3),
(8, 2, 'Clear recruitment criteria identified for both capability & culture fit', 4),
(9, 3, 'Recruitment process has not been defined or is unstructured', 1),
(10, 3, 'Recruitment process is defined, with a basic interview format/structure, evaluation form, roles & responsibilities;\nOne or very few sources of candidates are used and not being reviewed', 2),
(11, 3, 'Recruitment process is defined, and supported with the involvement of different stakeholders and the use of selection tools;\nTraditional sources of candidates are being reviewed periodically in an effort to identify higher quality candidates\n', 3),
(12, 3, 'Recruitment process is defined and integrated with the organisation''s broader human capital programmes, such as manpower planning, capability development needs, etc; \nThe quality of recruited candidates is evaluated to identify gaps in recruitment process, criteria and channels periodically', 4),
(13, 4, 'HR policies are undocumented, incomplete or loosely-written', 1),
(14, 4, 'Basic HR policies are in place, but not comprehensive nor regularly updated;\nEmployees receive some form of documentation with regards to the HR policies, e.g. employee handbook\n', 2),
(15, 4, 'Comprehensive HR policies are in place and are only reviewed/ updated for legal compliance;\nEmployees receive some form of documentation with regards to the HR policies, e.g. employee handbook', 3),
(16, 4, 'Comprehensive HR policies are in place and are reviewed periodically to enhance the effectiveness of HR management to be in line with market practices, e.g. updating of entitlements, review of terms & conditions, etc', 4),
(17, 5, 'HR processes are undocumented or ad hoc, without clear steps or roles & responsibilities', 1),
(18, 5, 'A few basic HR processes, e.g. recruitment, termination, etc have been documented and communicated', 2),
(19, 5, 'Most or all key HR processes have been documented; \nMost of the HR processes are manually administered\n', 3),
(20, 5, 'Most or all key HR processes have been documented; \nHR processes are essentially standardised and performed with the support of tools such as HRMS\n', 4),
(21, 6, 'Employee data is not captured accurately or updated', 1),
(22, 6, 'Employee data is managed using a combination of paper and spreadsheets;\nEmployee data updates may not be timely or accurate at times\n', 2),
(23, 6, 'Employee data is managed using a combination of paper, spreadsheets and online tools, e.g. HRMS;\nEmployee data updates are generally timely and accurate\n', 3),
(24, 6, 'Employee data is managed closely and provides a single source of employee data to related HR as well as non-HR systems and processes', 4),
(25, 7, 'No organisation chart has been developed', 1),
(26, 7, 'An organisation chart exists, but does not reflect the actual organisation structure and roles', 2),
(27, 7, 'The organisation chart is updated and reflects the current organisation structure; \nThe roles and accountabilities of various functions in the structure have been defined\n', 3),
(28, 7, 'The organisation chart is updated and reflects the current organisation structure, with roles and accountabilities defined; \nThe structure is periodically reviewed and updated to provision for future growth or reorganisation plans\n', 4),
(29, 8, 'No manpower projections are performed', 1),
(30, 8, 'Manpower projections focus on acquiring headcount and capabilities for current job requirements only', 2),
(31, 8, 'Some basic manpower analysis done to broadly project future manpower requirements', 3),
(32, 8, 'Detailed analysis conducted for the purpose of building manpower capabilities to support business growth, outlining the profiles of staff required, skills, knowledge, etc', 4),
(33, 9, 'Review of manpower plan not conducted', 1),
(34, 9, 'Review of manpower plan conducted infrequently, and on an ad hoc basis', 2),
(35, 9, 'Review of manpower conducted regularly, as part of business review and budgeting', 3),
(36, 9, 'Review of manpower conducted regularly, as part of business review and integrates closely with other HR initiatives, e.g. training & development, succession planning, etc', 4),
(37, 10, 'Training needs analysis is not conducted', 1),
(38, 10, 'Training needs analysis has been conducted as a once-off exercise to broadly capture skills gaps', 2),
(39, 10, 'Training needs analysis is conducted for individual employees and updated over time;\nEmployees are then scheduled to attend the required training to address the skills gaps\n', 3),
(40, 10, 'Training needs analysis is conducted for individual staff and updated over time; The findings are analysed at the company-level to analyse skills gaps;\nTraining and development programmes are identified to address skills gaps\n', 4),
(41, 11, 'Training & development roadmap has not been developed', 1),
(42, 11, 'A training roadmap has been developed primarily for basic technical skills training', 2),
(43, 11, 'Training roadmaps have been developed for various categories of employees, for the development of required technical skills using a combination of training courses and OJT', 3),
(44, 11, 'Training roadmaps have been developed for various categories of employees, for the training of required technical skills as well as leadership/ management skills, using a combination of training and learning platforms linked to business objectives', 4),
(45, 12, 'Little or no training provided – new employees are expected to enter the company with relevant skills or to acquire them while on the job', 1),
(46, 12, 'Employees attend \nad hoc training, which does not follow a training roadmap\n', 2),
(47, 12, 'Employees are required to undergo training as a company policy;\nThe training an employee undergoes is in accordance with the relevant training roadmap\n', 3),
(48, 12, 'Employees are required to undergo training as a company policy;\nThe effectiveness of training as applied in the workplace is analysed and the findings are used to fine-tune the training policies and programmes\n', 4),
(49, 13, 'New employees undergo a basic onboarding process, which takes a form of an administrative briefing', 1),
(50, 13, 'New employees are given a broad company overview, and are inducted into their jobs through basic training and OJT', 2),
(51, 13, 'New employees are given detailed onboarding which includes company familiarisation, culture induction, meeting with leaders, etc, and are inducted into their jobs through structured training and OJT', 3),
(52, 13, 'New employees are given a detailed onboarding and are assigned buddies/mentors to facilitate their settling into new roles; \nTheir progress is reviewed over an initial period to address any gaps/issues which may surface\n', 4),
(53, 14, 'Performance goals are not set, documented or clearly articulated', 1),
(54, 14, 'Performance goals are set, but not linkage to the business strategy may not be clear', 2),
(55, 14, 'Performance goals are set and are linked to the business strategy, but may not be balanced, e.g. Mainly focused on financial targets only', 3),
(56, 14, 'Performance goals are set and are linked to the business strategy;\nThe goals are balanced in the sense that they cover both internal development and external growth objectives, long-term and short-term goals, leading & lagging KPIs, etc\n', 4),
(57, 15, 'Performance appraisal is conducted informally on an \nad hoc basis\n', 1),
(58, 15, 'Performance appraisal is conducted regularly (e.g. annually), with the support of basic appraisal forms;\nThe performance appraisal criteria are not meaningfully differentiated across the various employee levels and types\n', 2),
(59, 15, 'Performance appraisal is conducted regularly with the clear criteria e.g. KPIs, competencies, etc, which have been differentiated across the various employee levels and types', 3),
(60, 15, 'Performance appraisal is conducted regularly with the clear criteria which have been differentiated across various employee levels and types; \nOverall performance levels are reviewed by the top management to identify potential issues, e.g. work processes, job design, accountabilities, etc\n', 4),
(61, 16, 'Supervisors do not coach their team members on performance improvements', 1),
(62, 16, 'Supervisors coach their team members on an informal and ad hoc basis', 2),
(63, 16, 'Supervisors are trained on performance coaching, and do so on a formal, regular basis', 3),
(64, 16, 'Supervisors conduct performance coaching and review employee development needs at the organisation level to identify and address gaps', 4),
(65, 17, 'Performance incentives are not provided to employees', 1),
(66, 17, 'Performance incentives are provided to employees, but are not meaningfully differentiated', 2),
(67, 17, 'Performance incentives are provided to better-performing employees, but the criteria for differentiating performance levels may not be clear', 3),
(68, 17, 'Performance incentives are provided to better-performing employees and the criteria for differentiating performance levels are communicated and supported by performance targets e.g. KPIs, competencies, etc', 4),
(69, 18, 'Grading structure and salary ranges not in place', 1),
(70, 18, 'Basic grading structure in place, but may not be consistent with job levels or job design;\nSalary ranges exist but are not documented\n', 2),
(71, 18, 'Grading structure and salary ranges are established, and reflect the job sizes across all work levels, but they do not take differences (in progression and pay levels) between job families into account', 3),
(72, 18, 'Grading structure reflects the job sizes across all work levels, as well as different job families; \nSalary ranges have been developed to match the respective grades in the various job families\n', 4),
(73, 19, 'Employee salaries and salary ranges are not benchmarked against the market', 1),
(74, 19, 'Employee salaries and/or salary ranges are benchmarked against the market, but the basis of comparison is approximated (e.g. using job titles);\nSalary benchmarking may only be for specific salary components, and not for total compensation package\n', 2),
(75, 19, 'Employee salaries and/or benefits are benchmarked against the market on a total compensation basis, but the basis of comparison is approximated (e.g. using job titles)', 3),
(76, 19, 'Employee salaries and benefits are benchmarked against the market on a total rewards basis; \nVarious bases of comparison are used, e.g. job sizes, industry/ sectors, job families, etc\n', 4),
(77, 20, 'Compensation and benefits are reviewed on an ad hoc basis, primarily to address employment legislation requirements', 1),
(78, 20, 'Compensation and benefits are broadly reviewed on an ad hoc basis, as a reaction to catch up with market movement', 2),
(79, 20, 'Compensation and benefits are broadly reviewed on a regular basis, to ensure continuous competitiveness with the market', 3),
(80, 20, 'Compensation and benefits are reviewed on a regular basis, to ensure competitiveness with the market as well as to introduce targeted pay practices and components to achieve specific objectives (e.g. attract specific talent, incentivise productivity, etc)', 4),
(81, 21, 'Mission-critical roles have not been formally identified, based on “gut feel”', 1),
(82, 21, 'Mission-critical roles have been formally identified, and are limited to the top management roles', 2),
(83, 21, 'Mission-critical roles have been formally identified at the top management level, as well as specific mid-level roles', 3),
(84, 21, 'Mission-critical roles have been formally identified across various levels, as well as feeder positions within the company which will provide the required experience/ exposure to prepare employees for mission-critical roles', 4),
(85, 22, 'Talent identification criteria do not exist', 1),
(86, 22, 'Talent identification criteria are based on "gut-feel" and are undocumented or unclear', 2),
(87, 22, 'Talent identification criteria have been developed, and are based on operational and/or performance measures', 3),
(88, 22, 'Talent identification criteria are based on a combination of performance track record as well as leadership/ people skills/ potential  which are aligned to the company''s needs', 4),
(89, 23, 'Succession planning is not practiced', 1),
(90, 23, 'Potential successors have been informally identified, without undergoing a structured process or management discussion', 2),
(91, 23, 'Potential successors have been identified through a structured process, but do not undergo specific development programmes or deployment to prepare them for mission-critical roles', 3),
(92, 23, 'Potential successors have been identified through a structured process, and are developed through career planning across all levels including targeted programmes and deployment to prepare them for mission-critical roles', 4),
(93, 24, 'The organisation culture and core values are undocumented and/or unclear', 1),
(94, 24, 'The organisation culture and core values are described in a few broad statements', 2),
(95, 24, 'The organisation culture and core values are described in clear statements, which are further translated into how they can be demonstrated by employees across various levels', 3),
(96, 24, 'The organisation culture and core values are reviewed periodically to ensure relevance and alignment to business objectives', 4),
(97, 25, 'Organisation culture & core values development is not conducted', 1),
(98, 25, 'The organisation culture & core values are communicated, but infrequently, e.g. during onboarding only', 2),
(99, 25, 'The organisation culture and core values are communicated and reinforced during regular employee communication sessions', 3),
(100, 25, 'The organisation culture and core values are a key part of the broader HR practices, e.g. onboarding process, employee training, performance appraisal, etc;\nWorkshops and/or teambuilding events are conducted to strengthen organisation culture and core values\n', 4),
(101, 26, 'No party is responsible for developing organisation culture and core values', 1),
(102, 26, 'Organisation & core values development is led and performed primarily by HR or the business leader', 2),
(103, 26, 'Organisation & core values development is led by the business leader and supported by HR as well as supervisors', 3),
(104, 26, 'Organisation & core values are role-modelled across different levels of employees, and are reinforced in day-to-day interactions', 4),
(105, 27, 'Employee opinions relating to their level of engagement at work are not sought', 1),
(106, 27, 'Employee opinions are sought in an informal manner and|or irregularly;\nThe findings are unstructured and broad\n', 2),
(107, 27, 'Employee opinions are sought on a regular basis and in a structured manner, so as to enable reporting and analysis to identify gaps', 3),
(108, 27, 'Employee opinions are sought on a regular basis and in a structured manner;\nAction plans are developed and implemented, and the management updates employees on progress on a regular basis\n', 4),
(109, 28, 'Other than job-related matters, there are little or no company-wide communications about the broader developments of the company, updates on policies, etc', 1),
(110, 28, 'Company-wide employee communications are conducted on an irregular basis, and mostly triggered by ad hoc events', 2),
(111, 28, 'Company-wide employee communications are conducted on a regular basis, primarily driven by the top management or HR', 3),
(112, 28, 'Company-wide employee communications are conducted on a regular basis, and are structured to involve various stakeholders and change agents, such as managers, HR, selected staff, etc', 4),
(113, 29, 'No employee value proposition has been defined', 1),
(114, 29, 'The company provides broad-based statements about its commitment to provide meaningful careers to its staff, but does not specify how this will be carried out', 2),
(115, 29, 'The company has articulated, in a limited manner, how some aspects of its HR policies and practices are built with the employee''s interests in mind; \nIt is not clear about how its employee value proposition is differentiated from that of other employers\n', 3),
(116, 29, 'The company has a well-defined employee value proposition which is differentiated from other employers, and targeted to attract/retain talent by providing meaningful careers within the company  ', 4),
(117, 30, 'The company does not refer to its employee value proposition (if there is one) to align and integrate its HR policies & practices', 1),
(118, 30, 'The company makes some effort to align parts of its HR policies and practices against its employee value proposition, but this is carried out on an ad hoc basis and is not conducted in a holistic or integrated manner  ', 2),
(119, 30, 'The company has a structured process to align some areas of its HR policies and practices to its employee value proposition, but other areas of HR have yet to be aligned and integrated', 3),
(120, 30, 'The company takes active steps to align and integrate its HR policies and practices to ensure their consistency with its employee value proposition; \nThis is conducted in a comprehensive manner, covering all major areas of HR polices & practices, to enhance its ability to attract and retain talent as an employer of choice\n', 4),
(121, 31, 'The company has not embarked on employer branding efforts, internally or externally', 1),
(122, 31, 'The company has started some form of employer branding (externally or internally), but its approach to employer branding may be generic and not necessarily reflecting its employee value proposition', 2),
(123, 31, 'The company has implemented employer branding initiatives which are in line with its employee value proposition, but they focus on either external or internal audiences only (not both)', 3),
(124, 31, 'The company has integrated its external employer branding efforts with internal employer branding, aligning both to its employee value proposition;\nThe company is being cohesively positioned as an employer of choice amongst prospective, current and past employees\n', 4),
(125, 32, 'No international mobility policies have been defined', 1),
(126, 32, 'International mobility policies in a few areas, such as international travel and allowance policies, training, etc have been defined in a basic manner, leaving room for interpretation and potentially inconsistent application;\nThe policies tend to be standalone and piecemeal\n', 2),
(127, 32, 'Some key areas relating to international mobility policies have been clearly defined, such as expatriate / international assignment compensation & benefits entitlements, relocation, training, etc; \nThe policies support the company''s international HR strategy; however, there is further scope to develop the remaining policy areas, which are unclear\n', 3),
(128, 32, 'International mobility policies are comprehensive, covering key areas such as expatriate / international assignment programmes, compensation & benefits, relocation, tax treatment, repatriation, training, etc;\nThe policies have clearly been integrated to effectively support the company''s international HR strategy\n', 4),
(129, 33, 'International mobility processes have not been defined', 1),
(130, 33, 'International mobility processes have been loosely defined and tend to focus on basic short-term travel requirements;\nNo specific resource has been identified to administer the international mobility processes\n', 2),
(131, 33, 'Some key international mobility processes have been defined, such as international deployment, culture/ language training, relocation services, etc, but for remaining processes, they tend to be more ad hoc or discretionary;\nA resource has been identified and held accountable for the administration of processes and facilitation of international mobility\n', 3),
(132, 33, 'International mobility processes have been comprehensively defined, such as international manpower planning, assessment/ selection, deployment, culture/ language training, relocation services, etc; \nA trained resource or team has been identified and held accountable for the administration of processes and facilitation of international mobility\n', 4),
(133, 34, 'The company is organised like a purely local company and functions like one, without a clear plan, structure nor culture for internationalisation', 1),
(134, 34, 'The company has a broad plan to grow internationally and has identified resources to support growth/ limited operations in overseas markets; however, these resources are typically deployed on an ad hoc basis;\nThe company has not specifically developed international organisation capabilities nor structure\n', 2),
(135, 34, 'The company has an international growth strategy and has basic overseas functions; however, these functions are led by Singapore-based managers who have other roles in Singapore\nWhile the company has started to adapt its existing  structure in Singapore to support its international efforts, its organisation culture and HR structures have not been fully developed to cater for international growth\n', 3),
(136, 34, 'The company has a clear international growth strategy and has been structured to develop and grow organically in multiple overseas markets, with the management team being well-coordinated and held accountable for international growth;\nThe company has introduced organisation capabilities and culture which support internationalisation, by developing international management competencies, building an internationally-diversified workforce, international HR structures, etc\n', 4);

##Change script End##




##GIAMPQ##
##22/05/2014##

ALTER TABLE `t_user` MODIFY `TX_USEREMAIL` VARCHAR( 50 ) NOT NULL;

ALTER TABLE `t_growth_stage` MODIFY `VALUE` VARCHAR( 500 ) NOT NULL;

DELETE FROM `t_growth_stage`

INSERT INTO `t_growth_stage` (`ID_GS`, `NM_TYPE`, `VALUE`) VALUES
(1, 'QUESTION_1', 'The company has demonstrated a workable business model but is concerned with the ability to generate enough cash to break even (and to cover repair/ replacement of capital assets as they wear out) or scale up to a viable size.'),
(2, 'QUESTION_1', 'The company has healthy profits and the objective is to keep it stable without additional risks or investments. The management is concerned with keeping the status quo for as long as possible.'),
(3, 'QUESTION_1', 'The company has healthy profits and the objective is to consolidate and shore up financial resources (including securing additional funds or loans) so as to be able to expand. There is the decision to take the risk/challenge to “go big”.'),
(4, 'QUESTION_1', 'The company is currently expanding rapidly. It is investing and trying to balance control and the desire to grow. It is concerned with managing its cash and operations prudently to avoid expanding too fast with emphasis on improving its systems.'),
(5, 'QUESTION_1', 'The company has attained substantial size, finances and managerial talent. It is trying to control the financial gains and consolidate by professionalizing its systems and tools. It is concerned with how to preserve its agility, innovation and entrepreneurial spirit.'),
(6, 'QUESTION_2', 'The owner manages everyone and everything.'),
(7, 'QUESTION_2', 'The owner is still synonymous with the business. Sales or general manager carries out well-defined orders of the owner.'),
(8, 'QUESTION_2', 'Functional managers take over certain duties of the owner. \ne.g. Financial Controller taking over financial matters.\n'),
(9, 'QUESTION_2', 'The owner and business are reasonably separate but owner presence & stock control are still strong. There are competent key managers in place.'),
(10, 'QUESTION_2', 'The owner and business are quite separate, both financially and operationally. Experienced and professional staff operates with high degree of autonomy.');




##Change script End##

##GIAMPQ##
##28/05/2014##

UPDATE `t_survey_question` SET `NM_QUESTION` = "Organisation & Role Design" WHERE  `ID_QUESTION` = 7


UPDATE `t_survey_question` SET `NM_QUESTION` = "Training and Development Roadmap" WHERE  `ID_QUESTION` = 11

##Change script End##

##PHUTV##
##28/05/2014 14:05:00##

UPDATE `t_growth_stage` SET `VALUE` = 'The company has demonstrated a workable business model but is <b>concerned with the ability to generate enough cash</b> to break even (and to cover repair/ replacement of capital assets as they wear out) or scale up to a viable size.' WHERE `t_growth_stage`.`ID_GS` =1;

UPDATE `t_growth_stage` SET `VALUE` = 'The company has healthy profits and the <b>objective is to keep it stable without additional risks or investments</b>. The management is concerned with keeping the status quo for as long as possible.' WHERE `t_growth_stage`.`ID_GS` =2;

UPDATE `t_growth_stage` SET `VALUE` = 'The company has healthy profits and <b>the objective is to consolidate and shore up financial resources</b> (including securing additional funds or loans) <b>so as to be able to expand</b>. There is the decision to take the risk/challenge to “go big”.' WHERE `t_growth_stage`.`ID_GS` =3;

UPDATE `t_growth_stage` SET `VALUE` = '<b>The company is currently expanding rapidly</b>. It is investing and trying to balance control and the desire to grow. It is concerned with managing its cash and operations prudently to avoid expanding too fast with emphasis on improving its systems.' WHERE `t_growth_stage`.`ID_GS` =4;

UPDATE `t_growth_stage` SET `VALUE` = '<b>The company has attained substantial size, finances and managerial talent. It is trying to control the financial gains and consolidate by professionalizing</b> its systems and tools. It is concerned with how to preserve its agility, innovation and entrepreneurial spirit.' WHERE `t_growth_stage`.`ID_GS` =5;

##Change script End##


##GIAMPQ##
##28/05/2014##

##GIAMPQ##
##28/05/2014##



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
                        <div class="header-content" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;color:#888888;"><a href="{HOME_PAGE}" style="font-weight:bold;color:#eeeeee;text-decoration:none;">Home Page</a><span class="hide">&nbsp;&nbsp;|&nbsp;</span>
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
                          <p style="color:#000c8f;font-family:HelveticaNeue, sans-serif;font-size:36px;text-align:center;margin-top:0px;margin-bottom:30px;"> <strong><a href="http://vietnam.createsend1.com/t/d-l-fjhkky-l-d/" style="color:#000c8f;text-decoration:none;">Hay Group Company</a></strong> </p>
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
                        <p align="left" class="footer-content-left" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;line-height:15px;color:#888888;margin-top:0px;margin-bottom:15px;"><a href="#">{ALT_BODY}</a> |</p></td>
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
</html>
' WHERE  `TEMPLATE_KEY` = 'FORGOT_PASSWORD'

##Change script End##




##PHUTV##
##29/05/2014 09:09:00##

UPDATE `t_growth_stage` SET `VALUE` = 'The company has healthy profits and the <b>objective is to consolidate and shore up financial resources</b> (including securing additional funds or loans) <b>so as to be able to expand</b>. There is the decision to take the risk/challenge to “go big”.' WHERE `t_growth_stage`.`ID_GS` =3;

##Change script End##
#
###PHUTV##


##30/05/2014 15:40:00##

ALTER TABLE `ci_sessions` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

UPDATE `t_survey_question` SET `NM_QUESTION` = 'Employee Communications' WHERE `t_survey_question`.`ID_QUESTION` =28;

##Change script End##


##GIAMPQ##
##02/06/2014##
# add column url_background and update data into table  t_survey_question

DELETE FROM `t_survey_question`

INSERT INTO `t_survey_question` (`ID_QUESTION`, `NM_QUESTION`, `NM_CATEGORY`, `DT_PRIMARY`, `TX_PRIMARY_STATUS`, `ID_SECONDARY`, `DT_SECONDARY`, `TX_SECONDARY_STATUS`, `url_background`) VALUES
(1, 'Job Requirements', 'RECRUITMENT', '2014-05-28 21:08:19', 'Pending', 0, '0000-00-00 00:00:00', '', 'themes/default/images/category_img/category_01-low.jpg'),
(2, 'Recruitment Criteria', 'RECRUITMENT', '2014-05-28 21:08:22', 'Pending', 0, '0000-00-00 00:00:00', '', 'themes/default/images/category_img/category_01-low.jpg'),
(3, 'Recruitment Process', 'RECRUITMENT', '2014-05-28 21:08:33', 'Pending', 0, '0000-00-00 00:00:00', '', 'themes/default/images/category_img/category_01-low.jpg'),
(4, 'HR Policies', 'HR MANAGEMENT', '2014-05-28 21:11:14', 'Pending', 0, '0000-00-00 00:00:00', '', 'themes/default/images/category_img/category_02-low.jpg'),
(5, 'HR Processes', 'HR MANAGEMENT', '2014-05-28 21:11:15', 'Pending', 0, '0000-00-00 00:00:00', '', 'themes/default/images/category_img/category_02-low.jpg'),
(6, 'Employee Data', 'HR MANAGEMENT', '2014-05-28 21:11:26', 'Pending', 0, '0000-00-00 00:00:00', '', 'themes/default/images/category_img/category_02-low.jpg'),
(7, 'Organisation & Role Design', 'MANPOWER PLANNING', '2014-05-28 21:11:33', 'Pending', 0, '0000-00-00 00:00:00', '', 'themes/default/images/category_img/category_03-low.jpg'),
(8, 'Manpower Projections', 'MANPOWER PLANNING', '2014-05-28 21:11:35', 'Pending', 0, '0000-00-00 00:00:00', '', 'themes/default/images/category_img/category_03-low.jpg'),
(9, 'Manpower Review', 'MANPOWER PLANNING', '2014-05-28 21:11:38', 'Pending', 0, '0000-00-00 00:00:00', '', 'themes/default/images/category_img/category_03-low.jpg'),
(10, 'Training Needs Analysis', 'TRAINING AND DEVELOPMENT', '2014-05-28 21:11:53', 'Pending', 0, '0000-00-00 00:00:00', '', 'themes/default/images/category_img/category_04-low.jpg'),
(11, 'Training and Development Roadmap', 'TRAINING AND DEVELOPMENT', '2014-05-28 21:11:55', 'Pending', 0, '0000-00-00 00:00:00', '', 'themes/default/images/category_img/category_04-low.jpg'),
(12, 'Training Participation', 'TRAINING AND DEVELOPMENT', '2014-05-28 21:11:57', 'Pending', 0, '0000-00-00 00:00:00', '', 'themes/default/images/category_img/category_04-low.jpg'),
(13, 'Employee Onboarding', 'TRAINING AND DEVELOPMENT', '2014-05-28 21:12:03', 'Pending', 0, '0000-00-00 00:00:00', '', 'themes/default/images/category_img/category_04-low.jpg'),
(14, 'Goal-Setting', 'PERFORMANCE MANAGEMENT', '2014-05-28 21:12:31', 'Pending', 0, '0000-00-00 00:00:00', '', 'themes/default/images/category_img/category_05-low.jpg'),
(15, 'Performance Appraisal Process', 'PERFORMANCE MANAGEMENT', '2014-05-28 21:12:34', 'Pending', 0, '0000-00-00 00:00:00', '', 'themes/default/images/category_img/category_05-low.jpg'),
(16, 'Performance Coaching', 'PERFORMANCE MANAGEMENT', '2014-05-28 21:12:42', 'Pending', 0, '0000-00-00 00:00:00', '', 'themes/default/images/category_img/category_05-low.jpg'),
(17, 'Performance Incentives', 'PERFORMANCE MANAGEMENT', '2014-05-28 21:12:53', 'Pending', 0, '0000-00-00 00:00:00', '', 'themes/default/images/category_img/category_05-low.jpg'),
(18, 'C&B Structure ', 'COMPENSATION AND BENEFITS (C&B)', '2014-05-28 21:12:58', 'Pending', 0, '0000-00-00 00:00:00', '', 'themes/default/images/category_img/category_06-low.jpg'),
(19, 'Market Benchmarking', 'COMPENSATION AND BENEFITS (C&B)', '2014-05-28 21:13:00', 'Pending', 0, '0000-00-00 00:00:00', '', 'themes/default/images/category_img/category_06-low.jpg'),
(20, 'C&B Review', 'COMPENSATION AND BENEFITS (C&B)', '2014-05-28 21:13:10', 'Pending', 0, '0000-00-00 00:00:00', '', 'themes/default/images/category_img/category_06-low.jpg'),
(21, 'Mission-Critical Roles', 'TALENT MANAGEMENT AND SUCCESSION PLANNING', '2014-05-28 21:13:31', 'Pending', 0, '0000-00-00 00:00:00', '', 'themes/default/images/category_img/category_07-low.jpg'),
(22, 'Talent Identification Criteria', 'TALENT MANAGEMENT AND SUCCESSION PLANNING', '2014-05-28 21:13:34', 'Pending', 0, '0000-00-00 00:00:00', '', 'themes/default/images/category_img/category_07-low.jpg'),
(23, 'Succession Planning Process', 'TALENT MANAGEMENT AND SUCCESSION PLANNING', '2014-05-28 21:13:42', 'Pending', 0, '0000-00-00 00:00:00', '', 'themes/default/images/category_img/category_07-low.jpg'),
(24, 'Culture Definition', 'ORGANISATION CULTURE AND CORE VALUES', '2014-05-28 21:13:50', 'Pending', 0, '0000-00-00 00:00:00', '', 'themes/default/images/category_img/category_08-low.jpg'),
(25, 'Culture Development', 'ORGANISATION CULTURE AND CORE VALUES', '2014-05-28 21:13:52', 'Pending', 0, '0000-00-00 00:00:00', '', 'themes/default/images/category_img/category_08-low.jpg'),
(26, 'Culture Drivers', 'ORGANISATION CULTURE AND CORE VALUES', '2014-05-28 21:14:01', 'Pending', 0, '0000-00-00 00:00:00', '', 'themes/default/images/category_img/category_08-low.jpg'),
(27, 'Employee Engagement', 'EMPLOYEE ENGAGEMENT AND COMMUNICATIONS', '2014-05-28 21:14:09', 'Pending', 0, '0000-00-00 00:00:00', '', 'themes/default/images/category_img/category_09-low.jpg'),
(28, 'Employee Communications', 'EMPLOYEE ENGAGEMENT AND COMMUNICATIONS', '2014-06-02 01:23:21', 'Pending', 0, '0000-00-00 00:00:00', '', 'themes/default/images/category_img/category_09-low.jpg'),
(29, 'EVP Definition', 'EMPLOYEE VALUE PROPOSITION (EVP)', '2014-05-28 21:14:42', 'Pending', 0, '0000-00-00 00:00:00', '', 'themes/default/images/category_img/category_10-low.jpg'),
(30, 'EVP Execution', 'EMPLOYEE VALUE PROPOSITION (EVP)', '2014-05-28 21:14:48', 'Pending', 0, '0000-00-00 00:00:00', '', 'themes/default/images/category_img/category_10-low.jpg'),
(31, 'EVP Application through Employer Branding', 'EMPLOYEE VALUE PROPOSITION (EVP)', '2014-05-28 21:15:02', 'Pending', 0, '0000-00-00 00:00:00', '', 'themes/default/images/category_img/category_10-low.jpg'),
(32, 'International Mobility Policies', 'INTERNATIONAL MOBILITY', '2014-05-28 21:15:08', 'Pending', 0, '0000-00-00 00:00:00', '', 'themes/default/images/category_img/category_11-low.jpg'),
(33, 'International Mobility Processes and Support Infrastructure', 'INTERNATIONAL MOBILITY', '2014-06-02 01:17:51', 'Pending', 0, '0000-00-00 00:00:00', '', 'themes/default/images/category_img/category_11-low.jpg'),
(34, 'International Organisation Capability', 'INTERNATIONAL MOBILITY', '2014-05-28 21:15:13', 'Pending', 0, '0000-00-00 00:00:00', '', 'themes/default/images/category_img/category_11-low.jpg');


DELETE FROM `email_template`

INSERT INTO `email_template` (`ID`, `TYPE`, `TEMPLATE_KEY`, `TEMPLATE_SUBJECT`, `TEMPLATE_BODY`) VALUES
(1, 'EMAIL', 'ACTIVE_ACCOUNT', 'ACTIVE ACCOUNT', ''),
(2, 'EMAIL', 'FORGOT_ID', 'SUBJECT : GET ID', '<!DOCTYPE html>\n<html>\n<head>\n<title>HAY GROUP COMPANY</title>\n<meta http-equiv="Content-Type" content="text/html; charset=utf-8">\n<meta name="viewport" content="width=320, target-densitydpi=device-dpi">\n<style type="text/css">\n@media only screen and (max-width: 660px) {\ntable[class=w0], td[class=w0] {\n  width: 0 !important;\n}\ntable[class=w10], td[class=w10], img[class=w10] {\n  width: 10px !important;\n}\ntable[class=w15], td[class=w15], img[class=w15] {\n  width: 5px !important;\n}\ntable[class=w30], td[class=w30], img[class=w30] {\n  width: 10px !important;\n}\ntable[class=w60], td[class=w60], img[class=w60] {\n  width: 10px !important;\n}\ntable[class=w125], td[class=w125], img[class=w125] {\n  width: 80px !important;\n}\ntable[class=w130], td[class=w130], img[class=w130] {\n  width: 55px !important;\n}\ntable[class=w140], td[class=w140], img[class=w140] {\n  width: 90px !important;\n}\ntable[class=w160], td[class=w160], img[class=w160] {\n  width: 180px !important;\n}\ntable[class=w170], td[class=w170], img[class=w170] {\n  width: 100px !important;\n}\ntable[class=w180], td[class=w180], img[class=w180] {\n  width: 80px !important;\n}\ntable[class=w195], td[class=w195], img[class=w195] {\n  width: 80px !important;\n}\ntable[class=w220], td[class=w220], img[class=w220] {\n  width: 80px !important;\n}\ntable[class=w240], td[class=w240], img[class=w240] {\n  width: 180px !important;\n}\ntable[class=w255], td[class=w255], img[class=w255] {\n  width: 185px !important;\n}\ntable[class=w275], td[class=w275], img[class=w275] {\n  width: 135px !important;\n}\ntable[class=w280], td[class=w280], img[class=w280] {\n  width: 135px !important;\n}\ntable[class=w300], td[class=w300], img[class=w300] {\n  width: 140px !important;\n}\ntable[class=w325], td[class=w325], img[class=w325] {\n  width: 95px !important;\n}\ntable[class=w360], td[class=w360], img[class=w360] {\n  width: 140px !important;\n}\ntable[class=w410], td[class=w410], img[class=w410] {\n  width: 180px !important;\n}\ntable[class=w470], td[class=w470], img[class=w470] {\n  width: 200px !important;\n}\ntable[class=w580], td[class=w580], img[class=w580] {\n  width: 280px !important;\n}\ntable[class=w640], td[class=w640], img[class=w640] {\n  width: 300px !important;\n}\ntable[class*=hide], td[class*=hide], img[class*=hide], p[class*=hide], span[class*=hide] {\n  display: none !important;\n}\ntable[class=h0], td[class=h0] {\n  height: 0 !important;\n}\np[class=footer-content-left] {\n  text-align: center !important;\n}\n#headline p {\n  font-size: 30px !important;\n}\n.article-content, #left-sidebar {\n  -webkit-text-size-adjust: 90% !important;\n  -ms-text-size-adjust: 90% !important;\n}\n.header-content, .footer-content-left {\n  -webkit-text-size-adjust: 80% !important;\n  -ms-text-size-adjust: 80% !important;\n}\nimg {\n  height: auto;\n  line-height: 100%;\n}\n}\n#outlook a {\n  padding: 0;\n}\nbody {\n  width: 100% !important;\n}\n.ReadMsgBody {\n  width: 100%;\n}\n.ExternalClass {\n  width: 100%;\n  display: block !important;\n}\nbody {\n  background-color: #c7c7c7;\n  margin: 0;\n  padding: 0;\n}\nimg {\n  outline: none;\n  text-decoration: none;\n  display: block;\n}\nbr, strong br, b br, em br, i br {\n  line-height: 100%;\n}\nh1, h2, h3, h4, h5, h6 {\n  line-height: 100% !important;\n  -webkit-font-smoothing: antialiased;\n}\nh1 a, h2 a, h3 a, h4 a, h5 a, h6 a {\n  color: blue !important;\n}\nh1 a:active, h2 a:active, h3 a:active, h4 a:active, h5 a:active, h6 a:active {\n  color: red !important;\n}\nh1 a:visited, h2 a:visited, h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited {\n  color: purple !important;\n}\ntable td, table tr {\n  border-collapse: collapse;\n}\n.yshortcuts, .yshortcuts a, .yshortcuts a:link, .yshortcuts a:visited, .yshortcuts a:hover, .yshortcuts a span {\n  color: black;\n  text-decoration: none !important;\n  border-bottom: none !important;\n  background: none !important;\n}\ncode {\n  white-space: normal;\n  word-break: break-all;\n}\n#background-table {\n  background-color: #c7c7c7;\n}\n#top-bar {\n  border-radius: 6px 6px 0px 0px;\n  -moz-border-radius: 6px 6px 0px 0px;\n  -webkit-border-radius: 6px 6px 0px 0px;\n  -webkit-font-smoothing: antialiased;\n  background-color: #2E2E2E;\n  color: #888888;\n}\n#top-bar a {\n  font-weight: bold;\n  color: #eeeeee;\n  text-decoration: none;\n}\n#footer {\n  border-radius: 0px 0px 6px 6px;\n  -moz-border-radius: 0px 0px 6px 6px;\n  -webkit-border-radius: 0px 0px 6px 6px;\n  -webkit-font-smoothing: antialiased;\n}\nbody, td {\n  font-family: HelveticaNeue, sans-serif;\n}\n.header-content, .footer-content-left, .footer-content-right {\n  -webkit-text-size-adjust: none;\n  -ms-text-size-adjust: none;\n}\n.header-content {\n  font-size: 12px;\n  color: #888888;\n}\n.header-content a {\n  font-weight: bold;\n  color: #eeeeee;\n  text-decoration: none;\n}\n#headline p {\n  color: #000c8f;\n  font-family: HelveticaNeue, sans-serif;\n  font-size: 36px;\n  text-align: center;\n  margin-top: 0px;\n  margin-bottom: 30px;\n}\n#headline p a {\n  color: #000c8f;\n  text-decoration: none;\n}\n.article-title {\n  font-size: 18px;\n  line-height: 24px;\n  color: #0f0080;\n  font-weight: bold;\n  margin-top: 0px;\n  margin-bottom: 18px;\n  font-family: HelveticaNeue, sans-serif;\n}\n.article-title a {\n  color: #0f0080;\n  text-decoration: none;\n}\n.article-title.with-meta {\n  margin-bottom: 0;\n}\n.article-meta {\n  font-size: 13px;\n  line-height: 20px;\n  color: #ccc;\n  font-weight: bold;\n  margin-top: 0;\n}\n.article-content {\n  font-size: 13px;\n  line-height: 18px;\n  color: #444444;\n  margin-top: 0px;\n  margin-bottom: 18px;\n  font-family: HelveticaNeue, sans-serif;\n}\n.article-content a {\n  color: #2f82de;\n  font-weight: bold;\n  text-decoration: none;\n}\n.article-content img {\n  max-width: 100%\n}\n.article-content ol, .article-content ul {\n  margin-top: 0px;\n  margin-bottom: 18px;\n  margin-left: 19px;\n  padding: 0;\n}\n.article-content li {\n  font-size: 13px;\n  line-height: 18px;\n  color: #444444;\n}\n.article-content li a {\n  color: #2f82de;\n  text-decoration: underline;\n}\n.article-content p {\n  margin-bottom: 15px;\n}\n.footer-content-left {\n  font-size: 12px;\n  line-height: 15px;\n  color: #888888;\n  margin-top: 0px;\n  margin-bottom: 15px;\n}\n.footer-content-left a {\n  color: #eeeeee;\n  font-weight: bold;\n  text-decoration: none;\n}\n.footer-content-right {\n  font-size: 11px;\n  line-height: 16px;\n  color: #888888;\n  margin-top: 0px;\n  margin-bottom: 15px;\n}\n.footer-content-right a {\n  color: #eeeeee;\n  font-weight: bold;\n  text-decoration: none;\n}\n#footer {\n  background-color: #000000;\n  color: #888888;\n}\n#footer a {\n  color: #eeeeee;\n  text-decoration: none;\n  font-weight: bold;\n}\n#permission-reminder {\n  white-space: normal;\n}\n#street-address {\n  color: #ffffff;\n  white-space: normal;\n}\n#email-footer{\n    width: 1024 px !important;\n}\n</style>\n<!--[if gte mso 9]>\n<style _tmplitem="10222" >\n.article-content ol, .article-content ul {\n   margin: 0 0 0 24px !important;\n   padding: 0 !important;\n   list-style-position: inside !important;\n}\n</style>\n<![endif]-->\n<meta name="robots" content="noindex,nofollow">\n<meta property="og:title" content="Hay Group">\n</head>\n<body style="width:100% !important;background-color:#c7c7c7;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:HelveticaNeue, sans-serif;">\n<table width="100%" cellpadding="0" cellspacing="0" border="0" id="background-table" style="background-color:#c7c7c7;">\n  <tbody>\n    <tr style="border-collapse:collapse;">\n      <td align="center" bgcolor="#c7c7c7" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w640" width="640" cellpadding="0" cellspacing="0" border="0" style="margin-top:0;margin-bottom:0;margin-right:10px;margin-left:10px;">\n          <tbody>\n            <tr style="border-collapse:collapse;">\n              <td class="w640" width="640" height="20" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n            </tr>\n            <tr style="border-collapse:collapse;">\n              <td class="w640" width="640" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table id="top-bar" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" style="border-radius:6px 6px 0px 0px;-moz-border-radius:6px 6px 0px 0px;-webkit-border-radius:6px 6px 0px 0px;-webkit-font-smoothing:antialiased;background-color:#2E2E2E;color:#888888;">\n                  <tbody>\n                    <tr style="border-collapse:collapse;">\n                      <td class="w15" width="15" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w325" width="350" valign="middle" align="left" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">\n                          <tbody>\n                            <tr style="border-collapse:collapse;">\n                              <td class="w325" width="350" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                            </tr>\n                          </tbody>\n                        </table>\n                        <div class="header-content" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;color:#888888;"><a href="{HOME_PAGE}" style="font-weight:bold;color:#eeeeee;text-decoration:none;">Home Page</a><span class="hide">&nbsp;&nbsp;|&nbsp;</span>\n                        </div>\n                        <table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">\n                          <tbody>\n                            <tr style="border-collapse:collapse;">\n                              <td class="w325" width="350" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                            </tr>\n                          </tbody>\n                        </table></td>\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w255" width="255" valign="middle" align="right" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">\n                          <tbody>\n                            <tr style="border-collapse:collapse;">\n                              <td class="w255" width="255" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                            </tr>\n                          </tbody>\n                        </table>\n                        <table cellpadding="0" cellspacing="0" border="0">\n                          <tbody>\n                            <tr style="border-collapse:collapse;"> </tr>\n                          </tbody>\n                        </table>\n                        <table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">\n                          <tbody>\n                            <tr style="border-collapse:collapse;">\n                              <td class="w255" width="255" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                            </tr>\n                          </tbody>\n                        </table></td>\n                      <td class="w15" width="15" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                    </tr>\n                  </tbody>\n                </table></td>\n            </tr>\n            <tr style="border-collapse:collapse;">\n              <td id="header" class="w640" width="640" align="center" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w640" width="640" cellpadding="0" cellspacing="0" border="0">\n                  <tbody>\n                    <tr style="border-collapse:collapse;">\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w580" width="580" height="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                    </tr>\n                    <tr style="border-collapse:collapse;">\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w580" width="580" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><div align="center" id="headline">\n                          <p style="color:#000c8f;font-family:HelveticaNeue, sans-serif;font-size:36px;text-align:center;margin-top:0px;margin-bottom:30px;"> <strong><a href="http://vietnam.createsend1.com/t/d-l-fjhkky-l-d/" style="color:#000c8f;text-decoration:none;">Hay Group Company</a></strong> </p>\n                        </div></td>\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                    </tr>\n                  </tbody>\n                </table></td>\n            </tr>\n            <tr style="border-collapse:collapse;">\n              <td class="w640" width="640" height="30" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n            </tr>\n            <tr id="simple-content-row" style="border-collapse:collapse;">\n              <td class="w640" width="640" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table align="left" class="w640" width="640" cellpadding="0" cellspacing="0" border="0">\n                  <tbody>\n                    <tr style="border-collapse:collapse;">\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w580" width="580" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w580" width="580" cellpadding="0" cellspacing="0" border="0">\n                          <tbody>\n                            <tr style="border-collapse:collapse;">\n                              <td class="w580" width="580" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><p align="left" class="article-title" style="font-size:18px;line-height:24px;color:#0f0080;font-weight:bold;margin-top:0px;margin-bottom:18px;font-family:HelveticaNeue, sans-serif;">Request  Retrieve Username</p>\n                                <div align="left" class="article-content" style="font-size:14px;line-height:14px;color:#444444;margin-top:0px;margin-bottom:18px;font-family:HelveticaNeue, sans-serif;">Hi, {ID_LOGIN}\n                                <p>You have requested for the your Username. Please take note of your account details below:</p>\n                                </br>\n                                <p>Username: <strong>{ID_LOGIN}</strong></p>\n                                </br>\n                                <!-- <p>Click<a href="{LINK_LOGIN}"><em> Here </em></a>to login</p>\n                                <p>if you are not requirement, please ignore email of this, Thanks you</p> -->\n                                </div>\n                              </td>\n                            </tr>\n                            <tr style="border-collapse:collapse;">\n                              <td class="w580" width="580" height="10" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                            </tr>\n                          </tbody>\n                        </table></td>\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                    </tr>\n                  </tbody>\n                </table></td>\n            </tr>\n            <tr style="border-collapse:collapse;">\n              <td class="w640" width="640" height="15" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n            </tr>\n            <tr style="border-collapse:collapse;">\n              <td class="w640" width="640" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table id="footer" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#000000" style="border-radius:0px 0px 6px 6px;-moz-border-radius:0px 0px 6px 6px;-webkit-border-radius:0px 0px 6px 6px;-webkit-font-smoothing:antialiased;background-color:#000000;color:#888888;">\n                  <tbody>\n                    <tr style="border-collapse:collapse;">\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w580 h0" width="360" height="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w0" width="60" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w0" width="160" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                    </tr>\n                    <tr style="border-collapse:collapse;">\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;padding-left: 20px;"></td>\n                      <td class="w580" width="90%" valign="top" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><span class="hide">\n                        <p id="permission-reminder" align="left" class="footer-content-left" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;line-height:15px;color:#888888;margin-top:0px;margin-bottom:15px;white-space:normal;"><span>About Hay Group</span><br style="line-height:100%;">\n                          <span>Hay Group is a global management consulting firm that works with leaders to transform strategy into reality. We develop talent, organize people to be more effective and motivate them to perform at their best.</span></p>\n                        </span>\n                        <p align="left" class="footer-content-left" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;line-height:15px;color:#888888;margin-top:0px;margin-bottom:15px;"><a href="#">{ALT_BODY}</a> |</p></td>\n                    </tr>\n                    <tr style="border-collapse:collapse;">\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w580 h0" width="360" height="15" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                    </tr>\n                  </tbody>\n                </table></td>\n            </tr>\n            <tr style="border-collapse:collapse;">\n              <td class="w640" width="640" height="60" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n            </tr>\n          </tbody>\n        </table></td>\n    </tr>\n  </tbody>\n</table>\n</body>\n</html>'),
(3, 'EMAIL', 'FORGOT_PASSWORD', 'SUBJECT : GET PASSWORD', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n<title>HAY GROUP COMPANY</title>\r\n<meta http-equiv="Content-Type" content="text/html; charset=utf-8">\r\n<meta name="viewport" content="width=320, target-densitydpi=device-dpi">\r\n<style type="text/css">\r\n@media only screen and (max-width: 660px) {\r\ntable[class=w0], td[class=w0] {\r\n  width: 0 !important;\r\n}\r\ntable[class=w10], td[class=w10], img[class=w10] {\r\n  width: 10px !important;\r\n}\r\ntable[class=w15], td[class=w15], img[class=w15] {\r\n  width: 5px !important;\r\n}\r\ntable[class=w30], td[class=w30], img[class=w30] {\r\n  width: 10px !important;\r\n}\r\ntable[class=w60], td[class=w60], img[class=w60] {\r\n  width: 10px !important;\r\n}\r\ntable[class=w125], td[class=w125], img[class=w125] {\r\n  width: 80px !important;\r\n}\r\ntable[class=w130], td[class=w130], img[class=w130] {\r\n  width: 55px !important;\r\n}\r\ntable[class=w140], td[class=w140], img[class=w140] {\r\n  width: 90px !important;\r\n}\r\ntable[class=w160], td[class=w160], img[class=w160] {\r\n  width: 180px !important;\r\n}\r\ntable[class=w170], td[class=w170], img[class=w170] {\r\n  width: 100px !important;\r\n}\r\ntable[class=w180], td[class=w180], img[class=w180] {\r\n  width: 80px !important;\r\n}\r\ntable[class=w195], td[class=w195], img[class=w195] {\r\n  width: 80px !important;\r\n}\r\ntable[class=w220], td[class=w220], img[class=w220] {\r\n  width: 80px !important;\r\n}\r\ntable[class=w240], td[class=w240], img[class=w240] {\r\n  width: 180px !important;\r\n}\r\ntable[class=w255], td[class=w255], img[class=w255] {\r\n  width: 185px !important;\r\n}\r\ntable[class=w275], td[class=w275], img[class=w275] {\r\n  width: 135px !important;\r\n}\r\ntable[class=w280], td[class=w280], img[class=w280] {\r\n  width: 135px !important;\r\n}\r\ntable[class=w300], td[class=w300], img[class=w300] {\r\n  width: 140px !important;\r\n}\r\ntable[class=w325], td[class=w325], img[class=w325] {\r\n  width: 95px !important;\r\n}\r\ntable[class=w360], td[class=w360], img[class=w360] {\r\n  width: 140px !important;\r\n}\r\ntable[class=w410], td[class=w410], img[class=w410] {\r\n  width: 180px !important;\r\n}\r\ntable[class=w470], td[class=w470], img[class=w470] {\r\n  width: 200px !important;\r\n}\r\ntable[class=w580], td[class=w580], img[class=w580] {\r\n  width: 280px !important;\r\n}\r\ntable[class=w640], td[class=w640], img[class=w640] {\r\n  width: 300px !important;\r\n}\r\ntable[class*=hide], td[class*=hide], img[class*=hide], p[class*=hide], span[class*=hide] {\r\n  display: none !important;\r\n}\r\ntable[class=h0], td[class=h0] {\r\n  height: 0 !important;\r\n}\r\np[class=footer-content-left] {\r\n  text-align: center !important;\r\n}\r\n#headline p {\r\n  font-size: 30px !important;\r\n}\r\n.article-content, #left-sidebar {\r\n  -webkit-text-size-adjust: 90% !important;\r\n  -ms-text-size-adjust: 90% !important;\r\n}\r\n.header-content, .footer-content-left {\r\n  -webkit-text-size-adjust: 80% !important;\r\n  -ms-text-size-adjust: 80% !important;\r\n}\r\nimg {\r\n  height: auto;\r\n  line-height: 100%;\r\n}\r\n}\r\n#outlook a {\r\n  padding: 0;\r\n}\r\nbody {\r\n  width: 100% !important;\r\n}\r\n.ReadMsgBody {\r\n  width: 100%;\r\n}\r\n.ExternalClass {\r\n  width: 100%;\r\n  display: block !important;\r\n}\r\nbody {\r\n  background-color: #c7c7c7;\r\n  margin: 0;\r\n  padding: 0;\r\n}\r\nimg {\r\n  outline: none;\r\n  text-decoration: none;\r\n  display: block;\r\n}\r\nbr, strong br, b br, em br, i br {\r\n  line-height: 100%;\r\n}\r\nh1, h2, h3, h4, h5, h6 {\r\n  line-height: 100% !important;\r\n  -webkit-font-smoothing: antialiased;\r\n}\r\nh1 a, h2 a, h3 a, h4 a, h5 a, h6 a {\r\n  color: blue !important;\r\n}\r\nh1 a:active, h2 a:active, h3 a:active, h4 a:active, h5 a:active, h6 a:active {\r\n  color: red !important;\r\n}\r\nh1 a:visited, h2 a:visited, h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited {\r\n  color: purple !important;\r\n}\r\ntable td, table tr {\r\n  border-collapse: collapse;\r\n}\r\n.yshortcuts, .yshortcuts a, .yshortcuts a:link, .yshortcuts a:visited, .yshortcuts a:hover, .yshortcuts a span {\r\n  color: black;\r\n  text-decoration: none !important;\r\n  border-bottom: none !important;\r\n  background: none !important;\r\n}\r\ncode {\r\n  white-space: normal;\r\n  word-break: break-all;\r\n}\r\n#background-table {\r\n  background-color: #c7c7c7;\r\n}\r\n#top-bar {\r\n  border-radius: 6px 6px 0px 0px;\r\n  -moz-border-radius: 6px 6px 0px 0px;\r\n  -webkit-border-radius: 6px 6px 0px 0px;\r\n  -webkit-font-smoothing: antialiased;\r\n  background-color: #2E2E2E;\r\n  color: #888888;\r\n}\r\n#top-bar a {\r\n  font-weight: bold;\r\n  color: #eeeeee;\r\n  text-decoration: none;\r\n}\r\n#footer {\r\n  border-radius: 0px 0px 6px 6px;\r\n  -moz-border-radius: 0px 0px 6px 6px;\r\n  -webkit-border-radius: 0px 0px 6px 6px;\r\n  -webkit-font-smoothing: antialiased;\r\n}\r\nbody, td {\r\n  font-family: HelveticaNeue, sans-serif;\r\n}\r\n.header-content, .footer-content-left, .footer-content-right {\r\n  -webkit-text-size-adjust: none;\r\n  -ms-text-size-adjust: none;\r\n}\r\n.header-content {\r\n  font-size: 12px;\r\n  color: #888888;\r\n}\r\n.header-content a {\r\n  font-weight: bold;\r\n  color: #eeeeee;\r\n  text-decoration: none;\r\n}\r\n#headline p {\r\n  color: #000c8f;\r\n  font-family: HelveticaNeue, sans-serif;\r\n  font-size: 36px;\r\n  text-align: center;\r\n  margin-top: 0px;\r\n  margin-bottom: 30px;\r\n}\r\n#headline p a {\r\n  color: #000c8f;\r\n  text-decoration: none;\r\n}\r\n.article-title {\r\n  font-size: 18px;\r\n  line-height: 24px;\r\n  color: #0f0080;\r\n  font-weight: bold;\r\n  margin-top: 0px;\r\n  margin-bottom: 18px;\r\n  font-family: HelveticaNeue, sans-serif;\r\n}\r\n.article-title a {\r\n  color: #0f0080;\r\n  text-decoration: none;\r\n}\r\n.article-title.with-meta {\r\n  margin-bottom: 0;\r\n}\r\n.article-meta {\r\n  font-size: 13px;\r\n  line-height: 20px;\r\n  color: #ccc;\r\n  font-weight: bold;\r\n  margin-top: 0;\r\n}\r\n.article-content {\r\n  font-size: 13px;\r\n  line-height: 18px;\r\n  color: #444444;\r\n  margin-top: 0px;\r\n  margin-bottom: 18px;\r\n  font-family: HelveticaNeue, sans-serif;\r\n}\r\n.article-content a {\r\n  color: #2f82de;\r\n  font-weight: bold;\r\n  text-decoration: none;\r\n}\r\n.article-content img {\r\n  max-width: 100%\r\n}\r\n.article-content ol, .article-content ul {\r\n  margin-top: 0px;\r\n  margin-bottom: 18px;\r\n  margin-left: 19px;\r\n  padding: 0;\r\n}\r\n.article-content li {\r\n  font-size: 13px;\r\n  line-height: 18px;\r\n  color: #444444;\r\n}\r\n.article-content li a {\r\n  color: #2f82de;\r\n  text-decoration: underline;\r\n}\r\n.article-content p {\r\n  margin-bottom: 15px;\r\n}\r\n.footer-content-left {\r\n  font-size: 12px;\r\n  line-height: 15px;\r\n  color: #888888;\r\n  margin-top: 0px;\r\n  margin-bottom: 15px;\r\n}\r\n.footer-content-left a {\r\n  color: #eeeeee;\r\n  font-weight: bold;\r\n  text-decoration: none;\r\n}\r\n.footer-content-right {\r\n  font-size: 11px;\r\n  line-height: 16px;\r\n  color: #888888;\r\n  margin-top: 0px;\r\n  margin-bottom: 15px;\r\n}\r\n.footer-content-right a {\r\n  color: #eeeeee;\r\n  font-weight: bold;\r\n  text-decoration: none;\r\n}\r\n#footer {\r\n  background-color: #000000;\r\n  color: #888888;\r\n}\r\n#footer a {\r\n  color: #eeeeee;\r\n  text-decoration: none;\r\n  font-weight: bold;\r\n}\r\n#permission-reminder {\r\n  white-space: normal;\r\n}\r\n#street-address {\r\n  color: #ffffff;\r\n  white-space: normal;\r\n}\r\n#email-footer{\r\n    width: 1024 px !important;\r\n}\r\n</style>\r\n<!--[if gte mso 9]>\r\n<style _tmplitem="10222" >\r\n.article-content ol, .article-content ul {\r\n   margin: 0 0 0 24px !important;\r\n   padding: 0 !important;\r\n   list-style-position: inside !important;\r\n}\r\n</style>\r\n<![endif]-->\r\n<meta name="robots" content="noindex,nofollow">\r\n<meta property="og:title" content="Hay Group">\r\n</head>\r\n<body style="width:100% !important;background-color:#c7c7c7;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:HelveticaNeue, sans-serif;">\r\n<table width="100%" cellpadding="0" cellspacing="0" border="0" id="background-table" style="background-color:#c7c7c7;">\r\n  <tbody>\r\n    <tr style="border-collapse:collapse;">\r\n      <td align="center" bgcolor="#c7c7c7" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w640" width="640" cellpadding="0" cellspacing="0" border="0" style="margin-top:0;margin-bottom:0;margin-right:10px;margin-left:10px;">\r\n          <tbody>\r\n            <tr style="border-collapse:collapse;">\r\n              <td class="w640" width="640" height="20" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\r\n            </tr>\r\n            <tr style="border-collapse:collapse;">\r\n              <td class="w640" width="640" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table id="top-bar" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" style="border-radius:6px 6px 0px 0px;-moz-border-radius:6px 6px 0px 0px;-webkit-border-radius:6px 6px 0px 0px;-webkit-font-smoothing:antialiased;background-color:#2E2E2E;color:#888888;">\r\n                  <tbody>\r\n                    <tr style="border-collapse:collapse;">\r\n                      <td class="w15" width="15" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\r\n                      <td class="w325" width="350" valign="middle" align="left" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">\r\n                          <tbody>\r\n                            <tr style="border-collapse:collapse;">\r\n                              <td class="w325" width="350" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\r\n                            </tr>\r\n                          </tbody>\r\n                        </table>\r\n                        <div class="header-content" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;color:#888888;"><a href="{HOME_PAGE}" style="font-weight:bold;color:#eeeeee;text-decoration:none;">Home Page</a><span class="hide">&nbsp;&nbsp;|&nbsp;</span>\r\n                        </div>\r\n                        <table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">\r\n                          <tbody>\r\n                            <tr style="border-collapse:collapse;">\r\n                              <td class="w325" width="350" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\r\n                            </tr>\r\n                          </tbody>\r\n                        </table></td>\r\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\r\n                      <td class="w255" width="255" valign="middle" align="right" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">\r\n                          <tbody>\r\n                            <tr style="border-collapse:collapse;">\r\n                              <td class="w255" width="255" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\r\n                            </tr>\r\n                          </tbody>\r\n                        </table>\r\n                        <table cellpadding="0" cellspacing="0" border="0">\r\n                          <tbody>\r\n                            <tr style="border-collapse:collapse;"> </tr>\r\n                          </tbody>\r\n                        </table>\r\n                        <table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">\r\n                          <tbody>\r\n                            <tr style="border-collapse:collapse;">\r\n                              <td class="w255" width="255" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\r\n                            </tr>\r\n                          </tbody>\r\n                        </table></td>\r\n                      <td class="w15" width="15" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\r\n                    </tr>\r\n                  </tbody>\r\n                </table></td>\r\n            </tr>\r\n            <tr style="border-collapse:collapse;">\r\n              <td id="header" class="w640" width="640" align="center" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w640" width="640" cellpadding="0" cellspacing="0" border="0">\r\n                  <tbody>\r\n                    <tr style="border-collapse:collapse;">\r\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\r\n                      <td class="w580" width="580" height="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\r\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\r\n                    </tr>\r\n                    <tr style="border-collapse:collapse;">\r\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\r\n                      <td class="w580" width="580" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><div align="center" id="headline">\r\n                          <p style="color:#000c8f;font-family:HelveticaNeue, sans-serif;font-size:36px;text-align:center;margin-top:0px;margin-bottom:30px;"> <strong><a href="http://vietnam.createsend1.com/t/d-l-fjhkky-l-d/" style="color:#000c8f;text-decoration:none;">Hay Group Company</a></strong> </p>\r\n                        </div></td>\r\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\r\n                    </tr>\r\n                  </tbody>\r\n                </table></td>\r\n            </tr>\r\n            <tr style="border-collapse:collapse;">\r\n              <td class="w640" width="640" height="30" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\r\n            </tr>\r\n            <tr id="simple-content-row" style="border-collapse:collapse;">\r\n              <td class="w640" width="640" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table align="left" class="w640" width="640" cellpadding="0" cellspacing="0" border="0">\r\n                  <tbody>\r\n                    <tr style="border-collapse:collapse;">\r\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\r\n                      <td class="w580" width="580" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w580" width="580" cellpadding="0" cellspacing="0" border="0">\r\n                          <tbody>\r\n                            <tr style="border-collapse:collapse;">\r\n                              <td class="w580" width="580" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><p align="left" class="article-title" style="font-size:18px;line-height:24px;color:#0f0080;font-weight:bold;margin-top:0px;margin-bottom:18px;font-family:HelveticaNeue, sans-serif;">Request Retrieve Password</p>\r\n                                <div align="left" class="article-content" style="font-size:14px;line-height:14px;color:#444444;margin-top:0px;margin-bottom:18px;font-family:HelveticaNeue, sans-serif;">Hi <strong>{TX_USERNAME}</strong>, \r\n                                <p>You have requested to reset the password for the following account:</p>\r\n                                </br>\r\n                                <p>Username: <strong>{TX_USERNAME}</strong></p>\r\n                                </br>\r\n                                 <p>Generated Password: <strong>{TX_SECURITY_CODE}</strong></p>\r\n                                <p>Click<a href="{LINK_CHANGEPASSWORD}"><em> Here </em></a>to confirm change password</p>\r\n                                <p>To reset the password, please go to the <a href="{LOGIN_PAGE}"><em> login page </em></a> and login with the given password. Upon login, you will be prompted to reset your password. Thank you.</p>\r\n                                </div>\r\n                              </td>\r\n                            </tr>\r\n                            <tr style="border-collapse:collapse;">\r\n                              <td class="w580" width="580" height="10" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\r\n                            </tr>\r\n                          </tbody>\r\n                        </table></td>\r\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\r\n                    </tr>\r\n                  </tbody>\r\n                </table></td>\r\n            </tr>\r\n            <tr style="border-collapse:collapse;">\r\n              <td class="w640" width="640" height="15" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\r\n            </tr>\r\n            <tr style="border-collapse:collapse;">\r\n              <td class="w640" width="640" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table id="footer" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#000000" style="border-radius:0px 0px 6px 6px;-moz-border-radius:0px 0px 6px 6px;-webkit-border-radius:0px 0px 6px 6px;-webkit-font-smoothing:antialiased;background-color:#000000;color:#888888;">\r\n                  <tbody>\r\n                    <tr style="border-collapse:collapse;">\r\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\r\n                      <td class="w580 h0" width="360" height="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\r\n                      <td class="w0" width="60" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\r\n                      <td class="w0" width="160" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\r\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\r\n                    </tr>\r\n                    <tr style="border-collapse:collapse;">\r\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;padding-left: 20px;"></td>\r\n                      <td class="w580" width="90%" valign="top" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><span class="hide">\r\n                        <p id="permission-reminder" align="left" class="footer-content-left" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;line-height:15px;color:#888888;margin-top:0px;margin-bottom:15px;white-space:normal;"><span>About Hay Group</span><br style="line-height:100%;">\r\n                          <span>Hay Group is a global management consulting firm that works with leaders to transform strategy into reality. We develop talent, organize people to be more effective and motivate them to perform at their best.</span></p>\r\n                        </span>\r\n                        <p align="left" class="footer-content-left" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;line-height:15px;color:#888888;margin-top:0px;margin-bottom:15px;"><a href="#">{ALT_BODY}</a> |</p></td>\r\n                    </tr>\r\n                    <tr style="border-collapse:collapse;">\r\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\r\n                      <td class="w580 h0" width="360" height="15" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\r\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\r\n                    </tr>\r\n                  </tbody>\r\n                </table></td>\r\n            </tr>\r\n            <tr style="border-collapse:collapse;">\r\n              <td class="w640" width="640" height="60" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\r\n            </tr>\r\n          </tbody>\r\n        </table></td>\r\n    </tr>\r\n  </tbody>\r\n</table>\r\n</body>\r\n</html>\r\n');
INSERT INTO `email_template` (`ID`, `TYPE`, `TEMPLATE_KEY`, `TEMPLATE_SUBJECT`, `TEMPLATE_BODY`) VALUES
(4, 'EMAIL', 'WEEKLY_NOTIFICATION', 'SUBJECT : WEEKLY NOTIFICATION', '<!DOCTYPE html>\n<html>\n<head>\n<title>HAY GROUP COMPANY</title>\n<meta http-equiv="Content-Type" content="text/html; charset=utf-8">\n<meta name="viewport" content="width=320, target-densitydpi=device-dpi">\n<style type="text/css">\n@media only screen and (max-width: 660px) {\ntable[class=w0], td[class=w0] {\n  width: 0 !important;\n}\ntable[class=w10], td[class=w10], img[class=w10] {\n  width: 10px !important;\n}\ntable[class=w15], td[class=w15], img[class=w15] {\n  width: 5px !important;\n}\ntable[class=w30], td[class=w30], img[class=w30] {\n  width: 10px !important;\n}\ntable[class=w60], td[class=w60], img[class=w60] {\n  width: 10px !important;\n}\ntable[class=w125], td[class=w125], img[class=w125] {\n  width: 80px !important;\n}\ntable[class=w130], td[class=w130], img[class=w130] {\n  width: 55px !important;\n}\ntable[class=w140], td[class=w140], img[class=w140] {\n  width: 90px !important;\n}\ntable[class=w160], td[class=w160], img[class=w160] {\n  width: 180px !important;\n}\ntable[class=w170], td[class=w170], img[class=w170] {\n  width: 100px !important;\n}\ntable[class=w180], td[class=w180], img[class=w180] {\n  width: 80px !important;\n}\ntable[class=w195], td[class=w195], img[class=w195] {\n  width: 80px !important;\n}\ntable[class=w220], td[class=w220], img[class=w220] {\n  width: 80px !important;\n}\ntable[class=w240], td[class=w240], img[class=w240] {\n  width: 180px !important;\n}\ntable[class=w255], td[class=w255], img[class=w255] {\n  width: 185px !important;\n}\ntable[class=w275], td[class=w275], img[class=w275] {\n  width: 135px !important;\n}\ntable[class=w280], td[class=w280], img[class=w280] {\n  width: 135px !important;\n}\ntable[class=w300], td[class=w300], img[class=w300] {\n  width: 140px !important;\n}\ntable[class=w325], td[class=w325], img[class=w325] {\n  width: 95px !important;\n}\ntable[class=w360], td[class=w360], img[class=w360] {\n  width: 140px !important;\n}\ntable[class=w410], td[class=w410], img[class=w410] {\n  width: 180px !important;\n}\ntable[class=w470], td[class=w470], img[class=w470] {\n  width: 200px !important;\n}\ntable[class=w580], td[class=w580], img[class=w580] {\n  width: 280px !important;\n}\ntable[class=w640], td[class=w640], img[class=w640] {\n  width: 300px !important;\n}\ntable[class*=hide], td[class*=hide], img[class*=hide], p[class*=hide], span[class*=hide] {\n  display: none !important;\n}\ntable[class=h0], td[class=h0] {\n  height: 0 !important;\n}\np[class=footer-content-left] {\n  text-align: center !important;\n}\n#headline p {\n  font-size: 30px !important;\n}\n.article-content, #left-sidebar {\n  -webkit-text-size-adjust: 90% !important;\n  -ms-text-size-adjust: 90% !important;\n}\n.header-content, .footer-content-left {\n  -webkit-text-size-adjust: 80% !important;\n  -ms-text-size-adjust: 80% !important;\n}\nimg {\n  height: auto;\n  line-height: 100%;\n}\n}\n#outlook a {\n  padding: 0;\n}\nbody {\n  width: 100% !important;\n}\n.ReadMsgBody {\n  width: 100%;\n}\n.ExternalClass {\n  width: 100%;\n  display: block !important;\n}\nbody {\n  background-color: #c7c7c7;\n  margin: 0;\n  padding: 0;\n}\nimg {\n  outline: none;\n  text-decoration: none;\n  display: block;\n}\nbr, strong br, b br, em br, i br {\n  line-height: 100%;\n}\nh1, h2, h3, h4, h5, h6 {\n  line-height: 100% !important;\n  -webkit-font-smoothing: antialiased;\n}\nh1 a, h2 a, h3 a, h4 a, h5 a, h6 a {\n  color: blue !important;\n}\nh1 a:active, h2 a:active, h3 a:active, h4 a:active, h5 a:active, h6 a:active {\n  color: red !important;\n}\nh1 a:visited, h2 a:visited, h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited {\n  color: purple !important;\n}\ntable td, table tr {\n  border-collapse: collapse;\n}\n.yshortcuts, .yshortcuts a, .yshortcuts a:link, .yshortcuts a:visited, .yshortcuts a:hover, .yshortcuts a span {\n  color: black;\n  text-decoration: none !important;\n  border-bottom: none !important;\n  background: none !important;\n}\ncode {\n  white-space: normal;\n  word-break: break-all;\n}\n#background-table {\n  background-color: #c7c7c7;\n}\n#top-bar {\n  border-radius: 6px 6px 0px 0px;\n  -moz-border-radius: 6px 6px 0px 0px;\n  -webkit-border-radius: 6px 6px 0px 0px;\n  -webkit-font-smoothing: antialiased;\n  background-color: #2E2E2E;\n  color: #888888;\n}\n#top-bar a {\n  font-weight: bold;\n  color: #eeeeee;\n  text-decoration: none;\n}\n#footer {\n  border-radius: 0px 0px 6px 6px;\n  -moz-border-radius: 0px 0px 6px 6px;\n  -webkit-border-radius: 0px 0px 6px 6px;\n  -webkit-font-smoothing: antialiased;\n}\nbody, td {\n  font-family: HelveticaNeue, sans-serif;\n}\n.header-content, .footer-content-left, .footer-content-right {\n  -webkit-text-size-adjust: none;\n  -ms-text-size-adjust: none;\n}\n.header-content {\n  font-size: 12px;\n  color: #888888;\n}\n.header-content a {\n  font-weight: bold;\n  color: #eeeeee;\n  text-decoration: none;\n}\n#headline p {\n  color: #000c8f;\n  font-family: HelveticaNeue, sans-serif;\n  font-size: 36px;\n  text-align: center;\n  margin-top: 0px;\n  margin-bottom: 30px;\n}\n#headline p a {\n  color: #000c8f;\n  text-decoration: none;\n}\n.article-title {\n  font-size: 18px;\n  line-height: 24px;\n  color: #0f0080;\n  font-weight: bold;\n  margin-top: 0px;\n  margin-bottom: 18px;\n  font-family: HelveticaNeue, sans-serif;\n}\n.article-title a {\n  color: #0f0080;\n  text-decoration: none;\n}\n.article-title.with-meta {\n  margin-bottom: 0;\n}\n.article-meta {\n  font-size: 13px;\n  line-height: 20px;\n  color: #ccc;\n  font-weight: bold;\n  margin-top: 0;\n}\n.article-content {\n  font-size: 13px;\n  line-height: 18px;\n  color: #444444;\n  margin-top: 0px;\n  margin-bottom: 18px;\n  font-family: HelveticaNeue, sans-serif;\n}\n.article-content a {\n  color: #2f82de;\n  font-weight: bold;\n  text-decoration: none;\n}\n.article-content img {\n  max-width: 100%\n}\n.article-content ol, .article-content ul {\n  margin-top: 0px;\n  margin-bottom: 18px;\n  margin-left: 19px;\n  padding: 0;\n}\n.article-content li {\n  font-size: 13px;\n  line-height: 18px;\n  color: #444444;\n}\n.article-content li a {\n  color: #2f82de;\n  text-decoration: underline;\n}\n.article-content p {\n  margin-bottom: 15px;\n}\n.footer-content-left {\n  font-size: 12px;\n  line-height: 15px;\n  color: #888888;\n  margin-top: 0px;\n  margin-bottom: 15px;\n}\n.footer-content-left a {\n  color: #eeeeee;\n  font-weight: bold;\n  text-decoration: none;\n}\n.footer-content-right {\n  font-size: 11px;\n  line-height: 16px;\n  color: #888888;\n  margin-top: 0px;\n  margin-bottom: 15px;\n}\n.footer-content-right a {\n  color: #eeeeee;\n  font-weight: bold;\n  text-decoration: none;\n}\n#footer {\n  background-color: #000000;\n  color: #888888;\n}\n#footer a {\n  color: #eeeeee;\n  text-decoration: none;\n  font-weight: bold;\n}\n#permission-reminder {\n  white-space: normal;\n}\n#street-address {\n  color: #ffffff;\n  white-space: normal;\n}\n#email-footer{\n    width: 1024 px !important;\n}\n</style>\n<!--[if gte mso 9]>\n<style _tmplitem="10222" >\n.article-content ol, .article-content ul {\n   margin: 0 0 0 24px !important;\n   padding: 0 !important;\n   list-style-position: inside !important;\n}\n</style>\n<![endif]-->\n<meta name="robots" content="noindex,nofollow">\n<meta property="og:title" content="Hay Group">\n</head>\n<body style="width:100% !important;background-color:#c7c7c7;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:HelveticaNeue, sans-serif;">\n<table width="100%" cellpadding="0" cellspacing="0" border="0" id="background-table" style="background-color:#c7c7c7;">\n  <tbody>\n    <tr style="border-collapse:collapse;">\n      <td align="center" bgcolor="#c7c7c7" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w640" width="640" cellpadding="0" cellspacing="0" border="0" style="margin-top:0;margin-bottom:0;margin-right:10px;margin-left:10px;">\n          <tbody>\n            <tr style="border-collapse:collapse;">\n              <td class="w640" width="640" height="20" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n            </tr>\n            <tr style="border-collapse:collapse;">\n              <td class="w640" width="640" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table id="top-bar" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" style="border-radius:6px 6px 0px 0px;-moz-border-radius:6px 6px 0px 0px;-webkit-border-radius:6px 6px 0px 0px;-webkit-font-smoothing:antialiased;background-color:#2E2E2E;color:#888888;">\n                  <tbody>\n                    <tr style="border-collapse:collapse;">\n                      <td class="w15" width="15" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w325" width="350" valign="middle" align="left" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">\n                          <tbody>\n                            <tr style="border-collapse:collapse;">\n                              <td class="w325" width="350" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                            </tr>\n                          </tbody>\n                        </table>\n                        <div class="header-content" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;color:#888888;"><a href="{HOME_PAGE}" style="font-weight:bold;color:#eeeeee;text-decoration:none;">Home Page</a><span class="hide">&nbsp;&nbsp;|&nbsp;</span>\n                        </div>\n                        <table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">\n                          <tbody>\n                            <tr style="border-collapse:collapse;">\n                              <td class="w325" width="350" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                            </tr>\n                          </tbody>\n                        </table></td>\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w255" width="255" valign="middle" align="right" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">\n                          <tbody>\n                            <tr style="border-collapse:collapse;">\n                              <td class="w255" width="255" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                            </tr>\n                          </tbody>\n                        </table>\n                        <table cellpadding="0" cellspacing="0" border="0">\n                          <tbody>\n                            <tr style="border-collapse:collapse;"> </tr>\n                          </tbody>\n                        </table>\n                        <table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">\n                          <tbody>\n                            <tr style="border-collapse:collapse;">\n                              <td class="w255" width="255" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                            </tr>\n                          </tbody>\n                        </table></td>\n                      <td class="w15" width="15" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                    </tr>\n                  </tbody>\n                </table></td>\n            </tr>\n            <tr style="border-collapse:collapse;">\n              <td id="header" class="w640" width="640" align="center" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w640" width="640" cellpadding="0" cellspacing="0" border="0">\n                  <tbody>\n                    <tr style="border-collapse:collapse;">\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w580" width="580" height="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                    </tr>\n                    <tr style="border-collapse:collapse;">\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w580" width="580" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><div align="center" id="headline">\n                          <p style="color:#000c8f;font-family:HelveticaNeue, sans-serif;font-size:36px;text-align:center;margin-top:0px;margin-bottom:30px;"> <strong><a href="http://vietnam.createsend1.com/t/d-l-fjhkky-l-d/" style="color:#000c8f;text-decoration:none;">Hay Group Company</a></strong> </p>\n                        </div></td>\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                    </tr>\n                  </tbody>\n                </table></td>\n            </tr>\n            <tr style="border-collapse:collapse;">\n              <td class="w640" width="640" height="30" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n            </tr>\n            <tr id="simple-content-row" style="border-collapse:collapse;">\n              <td class="w640" width="640" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table align="left" class="w640" width="640" cellpadding="0" cellspacing="0" border="0">\n                  <tbody>\n                    <tr style="border-collapse:collapse;">\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w580" width="580" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w580" width="580" cellpadding="0" cellspacing="0" border="0">\n                          <tbody>\n                            <tr style="border-collapse:collapse;">\n                              <td class="w580" width="580" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><p align="left" class="article-title" style="font-size:18px;line-height:24px;color:#0f0080;font-weight:bold;margin-top:0px;margin-bottom:18px;font-family:HelveticaNeue, sans-serif;">Weekly Notification</p>\n                                <div align="left" class="article-content" style="font-size:14px;line-height:14px;color:#444444;margin-top:0px;margin-bottom:18px;font-family:HelveticaNeue, sans-serif;">\n                                <p></p>\n                                </br>\n                                <p>Hi, <strong>{ID_LOGIN}</strong></p>\n                                </br>\n                                <p>Please find attached the weekly report generated on {DT_CREATE} .Thank you. </p>\n                                <p>If you do not be found the file attached! please click <a href="{LINK_DOWN}"><em> here </em></a> to download</p>\n                                </div>\n                              </td>\n                            </tr>\n                            <tr style="border-collapse:collapse;">\n                              <td class="w580" width="580" height="10" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                            </tr>\n                          </tbody>\n                        </table></td>\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                    </tr>\n                  </tbody>\n                </table></td>\n            </tr>\n            <tr style="border-collapse:collapse;">\n              <td class="w640" width="640" height="15" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n            </tr>\n            <tr style="border-collapse:collapse;">\n              <td class="w640" width="640" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table id="footer" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#000000" style="border-radius:0px 0px 6px 6px;-moz-border-radius:0px 0px 6px 6px;-webkit-border-radius:0px 0px 6px 6px;-webkit-font-smoothing:antialiased;background-color:#000000;color:#888888;">\n                  <tbody>\n                    <tr style="border-collapse:collapse;">\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w580 h0" width="360" height="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w0" width="60" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w0" width="160" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                    </tr>\n                    <tr style="border-collapse:collapse;">\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;padding-left: 20px;"></td>\n                      <td class="w580" width="90%" valign="top" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><span class="hide">\n                        <p id="permission-reminder" align="left" class="footer-content-left" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;line-height:15px;color:#888888;margin-top:0px;margin-bottom:15px;white-space:normal;"><span>About Hay Group</span><br style="line-height:100%;">\n                          <span>Hay Group is a global management consulting firm that works with leaders to transform strategy into reality. We develop talent, organize people to be more effective and motivate them to perform at their best.</span></p>\n                        </span>\n                        <p align="left" class="footer-content-left" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;line-height:15px;color:#888888;margin-top:0px;margin-bottom:15px;"><a href="#">{ALT_BODY}</a> |</p></td>\n                    </tr>\n                    <tr style="border-collapse:collapse;">\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w580 h0" width="360" height="15" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                    </tr>\n                  </tbody>\n                </table></td>\n            </tr>\n            <tr style="border-collapse:collapse;">\n              <td class="w640" width="640" height="60" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n            </tr>\n          </tbody>\n        </table></td>\n    </tr>\n  </tbody>\n</table>\n</body>\n</html>\n');



##Change script End##


##GIAMPQ##
##05/06/2014##

DELETE FROM `t_survey_option`

INSERT INTO `t_survey_option` (`ID_ANSWER`, `ID_QUESTION`, `NM_ANSWER`, `IN_POINT`) VALUES
(1, 1, 'The job requirements of the vacancy, such as required skills, knowledge, qualifications, personal traits, etc are not specified', 1),
(2, 1, 'The job requirements of the vacancy are vaguely documented in some form, e.g. JD or job advertisements, but widely open to interpretation', 2),
(3, 1, 'The job requirements of the vacancy are clearly articulated and documented in JDs, matching the job responsibilities', 3),
(4, 1, 'The job requirements of the vacancy are clearly articulated and documented in JDs, and have been calibrated to match with internal career progression levels and grading structures', 4),
(5, 2, 'Candidate recruitment criteria are undocumented; hiring is mainly based on ‘gut feel’', 1),
(6, 2, 'Generic, broad-based criteria have been outlined but are not necessarily specific to job requirements', 2),
(7, 2, 'Recruitment criteria have been identified for specific job requirements, with sufficient detail to guide recruitment process', 3),
(8, 2, 'Clear recruitment criteria identified for both capability & culture fit', 4),
(9, 3, 'Recruitment process has not been defined or is unstructured', 1),
(10, 3, 'Recruitment process is defined, with a basic interview format/structure, evaluation form, roles & responsibilities;</br>One or very few sources of candidates are used and not being reviewed', 2),
(11, 3, 'Recruitment process is defined, and supported with the involvement of different stakeholders and the use of selection tools;</br>Traditional sources of candidates are being reviewed periodically in an effort to identify higher quality candidates\n', 3),
(12, 3, 'Recruitment process is defined and integrated with the organisation''s broader human capital programmes, such as manpower planning, capability development needs, etc;</br>The quality of recruited candidates is evaluated to identify gaps in recruitment process, criteria and channels periodically', 4),
(13, 4, 'HR policies are undocumented, incomplete or loosely-written', 1),
(14, 4, 'Basic HR policies are in place, but not comprehensive nor regularly updated;</br>Employees receive some form of documentation with regards to the HR policies, e.g. employee handbook\n', 2),
(15, 4, 'Comprehensive HR policies are in place and are only reviewed/ updated for legal compliance;</br>Employees receive some form of documentation with regards to the HR policies, e.g. employee handbook', 3),
(16, 4, 'Comprehensive HR policies are in place and are reviewed periodically to enhance the effectiveness of HR management to be in line with market practices, e.g. updating of entitlements, review of terms & conditions, etc', 4),
(17, 5, 'HR processes are undocumented or ad hoc, without clear steps or roles & responsibilities', 1),
(18, 5, 'A few basic HR processes, e.g. recruitment, termination, etc have been documented and communicated', 2),
(19, 5, 'Most or all key HR processes have been documented;</br>Most of the HR processes are manually administered\n', 3),
(20, 5, 'Most or all key HR processes have been documented;</br>HR processes are essentially standardised and performed with the support of tools such as HRMS\n', 4),
(21, 6, 'Employee data is not captured accurately or updated', 1),
(22, 6, 'Employee data is managed using a combination of paper and spreadsheets;</br>Employee data updates may not be timely or accurate at times\n', 2),
(23, 6, 'Employee data is managed using a combination of paper, spreadsheets and online tools, e.g. HRMS;</br>Employee data updates are generally timely and accurate\n', 3),
(24, 6, 'Employee data is managed closely and provides a single source of employee data to related HR as well as non-HR systems and processes', 4),
(25, 7, 'No organisation chart has been developed', 1),
(26, 7, 'An organisation chart exists, but does not reflect the actual organisation structure and roles', 2),
(27, 7, 'The organisation chart is updated and reflects the current organisation structure;</br>The roles and accountabilities of various functions in the structure have been defined\n', 3),
(28, 7, 'The organisation chart is updated and reflects the current organisation structure, with roles and accountabilities defined;</br>The structure is periodically reviewed and updated to provision for future growth or reorganisation plans\n', 4),
(29, 8, 'No manpower projections are performed', 1),
(30, 8, 'Manpower projections focus on acquiring headcount and capabilities for current job requirements only', 2),
(31, 8, 'Some basic manpower analysis done to broadly project future manpower requirements', 3),
(32, 8, 'Detailed analysis conducted for the purpose of building manpower capabilities to support business growth, outlining the profiles of staff required, skills, knowledge, etc', 4),
(33, 9, 'Review of manpower plan not conducted', 1),
(34, 9, 'Review of manpower plan conducted infrequently, and on an ad hoc basis', 2),
(35, 9, 'Review of manpower conducted regularly, as part of business review and budgeting', 3),
(36, 9, 'Review of manpower conducted regularly, as part of business review and integrates closely with other HR initiatives, e.g. training & development, succession planning, etc', 4),
(37, 10, 'Training needs analysis is not conducted', 1),
(38, 10, 'Training needs analysis has been conducted as a once-off exercise to broadly capture skills gaps', 2),
(39, 10, 'Training needs analysis is conducted for individual employees and updated over time;</br>Employees are then scheduled to attend the required training to address the skills gaps\n', 3),
(40, 10, 'Training needs analysis is conducted for individual staff and updated over time; The findings are analysed at the company-level to analyse skills gaps;</br>Training and development programmes are identified to address skills gaps\n', 4),
(41, 11, 'Training & development roadmap has not been developed', 1),
(42, 11, 'A training roadmap has been developed primarily for basic technical skills training', 2),
(43, 11, 'Training roadmaps have been developed for various categories of employees, for the development of required technical skills using a combination of training courses and OJT', 3),
(44, 11, 'Training roadmaps have been developed for various categories of employees, for the training of required technical skills as well as leadership/ management skills, using a combination of training and learning platforms linked to business objectives', 4),
(45, 12, 'Little or no training provided – new employees are expected to enter the company with relevant skills or to acquire them while on the job', 1),
(46, 12, 'Employees attend ad hoc training, which does not follow a training roadmap\n', 2),
(47, 12, 'Employees are required to undergo training as a company policy;</br>The training an employee undergoes is in accordance with the relevant training roadmap\n', 3),
(48, 12, 'Employees are required to undergo training as a company policy;</br>The effectiveness of training as applied in the workplace is analysed and the findings are used to fine-tune the training policies and programmes\n', 4),
(49, 13, 'New employees undergo a basic onboarding process, which takes a form of an administrative briefing', 1),
(50, 13, 'New employees are given a broad company overview, and are inducted into their jobs through basic training and OJT', 2),
(51, 13, 'New employees are given detailed onboarding which includes company familiarisation, culture induction, meeting with leaders, etc, and are inducted into their jobs through structured training and OJT', 3),
(52, 13, 'New employees are given a detailed onboarding and are assigned buddies/mentors to facilitate their settling into new roles;</br>Their progress is reviewed over an initial period to address any gaps/issues which may surface\n', 4),
(53, 14, 'Performance goals are not set, documented or clearly articulated', 1),
(54, 14, 'Performance goals are set, but not linkage to the business strategy may not be clear', 2),
(55, 14, 'Performance goals are set and are linked to the business strategy, but may not be balanced, e.g. Mainly focused on financial targets only', 3),
(56, 14, 'Performance goals are set and are linked to the business strategy;</br>The goals are balanced in the sense that they cover both internal development and external growth objectives, long-term and short-term goals, leading & lagging KPIs, etc\n', 4),
(57, 15, 'Performance appraisal is conducted informally on an \nad hoc basis\n', 1),
(58, 15, 'Performance appraisal is conducted regularly (e.g. annually), with the support of basic appraisal forms;</br>The performance appraisal criteria are not meaningfully differentiated across the various employee levels and types\n', 2),
(59, 15, 'Performance appraisal is conducted regularly with the clear criteria e.g. KPIs, competencies, etc, which have been differentiated across the various employee levels and types', 3),
(60, 15, 'Performance appraisal is conducted regularly with the clear criteria which have been differentiated across various employee levels and types;</br>Overall performance levels are reviewed by the top management to identify potential issues, e.g. work processes, job design, accountabilities, etc\n', 4),
(61, 16, 'Supervisors do not coach their team members on performance improvements', 1),
(62, 16, 'Supervisors coach their team members on an informal and ad hoc basis', 2),
(63, 16, 'Supervisors are trained on performance coaching, and do so on a formal, regular basis', 3),
(64, 16, 'Supervisors conduct performance coaching and review employee development needs at the organisation level to identify and address gaps', 4),
(65, 17, 'Performance incentives are not provided to employees', 1),
(66, 17, 'Performance incentives are provided to employees, but are not meaningfully differentiated', 2),
(67, 17, 'Performance incentives are provided to better-performing employees, but the criteria for differentiating performance levels may not be clear', 3),
(68, 17, 'Performance incentives are provided to better-performing employees and the criteria for differentiating performance levels are communicated and supported by performance targets e.g. KPIs, competencies, etc', 4),
(69, 18, 'Grading structure and salary ranges not in place', 1),
(70, 18, 'Basic grading structure in place, but may not be consistent with job levels or job design;</br>Salary ranges exist but are not documented\n', 2),
(71, 18, 'Grading structure and salary ranges are established, and reflect the job sizes across all work levels, but they do not take differences (in progression and pay levels) between job families into account', 3),
(72, 18, 'Grading structure reflects the job sizes across all work levels, as well as different job families;</br>Salary ranges have been developed to match the respective grades in the various job families\n', 4),
(73, 19, 'Employee salaries and salary ranges are not benchmarked against the market', 1),
(74, 19, 'Employee salaries and/or salary ranges are benchmarked against the market, but the basis of comparison is approximated (e.g. using job titles);</br>Salary benchmarking may only be for specific salary components, and not for total compensation package\n', 2),
(75, 19, 'Employee salaries and/or benefits are benchmarked against the market on a total compensation basis, but the basis of comparison is approximated (e.g. using job titles)', 3),
(76, 19, 'Employee salaries and benefits are benchmarked against the market on a total rewards basis;</br>Various bases of comparison are used, e.g. job sizes, industry/ sectors, job families, etc\n', 4),
(77, 20, 'Compensation and benefits are reviewed on an ad hoc basis, primarily to address employment legislation requirements', 1),
(78, 20, 'Compensation and benefits are broadly reviewed on an ad hoc basis, as a reaction to catch up with market movement', 2),
(79, 20, 'Compensation and benefits are broadly reviewed on a regular basis, to ensure continuous competitiveness with the market', 3),
(80, 20, 'Compensation and benefits are reviewed on a regular basis, to ensure competitiveness with the market as well as to introduce targeted pay practices and components to achieve specific objectives (e.g. attract specific talent, incentivise productivity, etc)', 4),
(81, 21, 'Mission-critical roles have not been formally identified, based on “gut feel”', 1),
(82, 21, 'Mission-critical roles have been formally identified, and are limited to the top management roles', 2),
(83, 21, 'Mission-critical roles have been formally identified at the top management level, as well as specific mid-level roles', 3),
(84, 21, 'Mission-critical roles have been formally identified across various levels, as well as feeder positions within the company which will provide the required experience/ exposure to prepare employees for mission-critical roles', 4),
(85, 22, 'Talent identification criteria do not exist', 1),
(86, 22, 'Talent identification criteria are based on "gut-feel" and are undocumented or unclear', 2),
(87, 22, 'Talent identification criteria have been developed, and are based on operational and/or performance measures', 3),
(88, 22, 'Talent identification criteria are based on a combination of performance track record as well as leadership/ people skills/ potential  which are aligned to the company''s needs', 4),
(89, 23, 'Succession planning is not practiced', 1),
(90, 23, 'Potential successors have been informally identified, without undergoing a structured process or management discussion', 2),
(91, 23, 'Potential successors have been identified through a structured process, but do not undergo specific development programmes or deployment to prepare them for mission-critical roles', 3),
(92, 23, 'Potential successors have been identified through a structured process, and are developed through career planning across all levels including targeted programmes and deployment to prepare them for mission-critical roles', 4),
(93, 24, 'The organisation culture and core values are undocumented and/or unclear', 1),
(94, 24, 'The organisation culture and core values are described in a few broad statements', 2),
(95, 24, 'The organisation culture and core values are described in clear statements, which are further translated into how they can be demonstrated by employees across various levels', 3),
(96, 24, 'The organisation culture and core values are reviewed periodically to ensure relevance and alignment to business objectives', 4),
(97, 25, 'Organisation culture & core values development is not conducted', 1),
(98, 25, 'The organisation culture & core values are communicated, but infrequently, e.g. during onboarding only', 2),
(99, 25, 'The organisation culture and core values are communicated and reinforced during regular employee communication sessions', 3),
(100, 25, 'The organisation culture and core values are a key part of the broader HR practices, e.g. onboarding process, employee training, performance appraisal, etc;</br>Workshops and/or teambuilding events are conducted to strengthen organisation culture and core values\n', 4),
(101, 26, 'No party is responsible for developing organisation culture and core values', 1),
(102, 26, 'Organisation & core values development is led and performed primarily by HR or the business leader', 2),
(103, 26, 'Organisation & core values development is led by the business leader and supported by HR as well as supervisors', 3),
(104, 26, 'Organisation & core values are role-modelled across different levels of employees, and are reinforced in day-to-day interactions', 4),
(105, 27, 'Employee opinions relating to their level of engagement at work are not sought', 1),
(106, 27, 'Employee opinions are sought in an informal manner and|or irregularly;\nThe findings are unstructured and broad\n', 2),
(107, 27, 'Employee opinions are sought on a regular basis and in a structured manner, so as to enable reporting and analysis to identify gaps', 3),
(108, 27, 'Employee opinions are sought on a regular basis and in a structured manner;</br>Action plans are developed and implemented, and the management updates employees on progress on a regular basis\n', 4),
(109, 28, 'Other than job-related matters, there are little or no company-wide communications about the broader developments of the company, updates on policies, etc', 1),
(110, 28, 'Company-wide employee communications are conducted on an irregular basis, and mostly triggered by ad hoc events', 2),
(111, 28, 'Company-wide employee communications are conducted on a regular basis, primarily driven by the top management or HR', 3),
(112, 28, 'Company-wide employee communications are conducted on a regular basis, and are structured to involve various stakeholders and change agents, such as managers, HR, selected staff, etc', 4),
(113, 29, 'No employee value proposition has been defined', 1),
(114, 29, 'The company provides broad-based statements about its commitment to provide meaningful careers to its staff, but does not specify how this will be carried out', 2),
(115, 29, 'The company has articulated, in a limited manner, how some aspects of its HR policies and practices are built with the employee''s interests in mind;</br>It is not clear about how its employee value proposition is differentiated from that of other employers\n', 3),
(116, 29, 'The company has a well-defined employee value proposition which is differentiated from other employers, and targeted to attract/retain talent by providing meaningful careers within the company  ', 4),
(117, 30, 'The company does not refer to its employee value proposition (if there is one) to align and integrate its HR policies & practices', 1),
(118, 30, 'The company makes some effort to align parts of its HR policies and practices against its employee value proposition, but this is carried out on an ad hoc basis and is not conducted in a holistic or integrated manner  ', 2),
(119, 30, 'The company has a structured process to align some areas of its HR policies and practices to its employee value proposition, but other areas of HR have yet to be aligned and integrated', 3),
(120, 30, 'The company takes active steps to align and integrate its HR policies and practices to ensure their consistency with its employee value proposition;</br>This is conducted in a comprehensive manner, covering all major areas of HR polices & practices, to enhance its ability to attract and retain talent as an employer of choice\n', 4),
(121, 31, 'The company has not embarked on employer branding efforts, internally or externally', 1),
(122, 31, 'The company has started some form of employer branding (externally or internally), but its approach to employer branding may be generic and not necessarily reflecting its employee value proposition', 2),
(123, 31, 'The company has implemented employer branding initiatives which are in line with its employee value proposition, but they focus on either external or internal audiences only (not both)', 3),
(124, 31, 'The company has integrated its external employer branding efforts with internal employer branding, aligning both to its employee value proposition;</br>The company is being cohesively positioned as an employer of choice amongst prospective, current and past employees\n', 4),
(125, 32, 'No international mobility policies have been defined', 1),
(126, 32, 'International mobility policies in a few areas, such as international travel and allowance policies, training, etc have been defined in a basic manner, leaving room for interpretation and potentially inconsistent application;</br>The policies tend to be standalone and piecemeal\n', 2),
(127, 32, 'Some key areas relating to international mobility policies have been clearly defined, such as expatriate / international assignment compensation & benefits entitlements, relocation, training, etc;</br>The policies support the company''s international HR strategy; however, there is further scope to develop the remaining policy areas, which are unclear\n', 3),
(128, 32, 'International mobility policies are comprehensive, covering key areas such as expatriate / international assignment programmes, compensation & benefits, relocation, tax treatment, repatriation, training, etc;</br>The policies have clearly been integrated to effectively support the company''s international HR strategy\n', 4),
(129, 33, 'International mobility processes have not been defined', 1),
(130, 33, 'International mobility processes have been loosely defined and tend to focus on basic short-term travel requirements;</br>No specific resource has been identified to administer the international mobility processes\n', 2),
(131, 33, 'Some key international mobility processes have been defined, such as international deployment, culture/ language training, relocation services, etc, but for remaining processes, they tend to be more ad hoc or discretionary;</br>A resource has been identified and held accountable for the administration of processes and facilitation of international mobility\n', 3),
(132, 33, 'International mobility processes have been comprehensively defined, such as international manpower planning, assessment/ selection, deployment, culture/ language training, relocation services, etc;</br>A trained resource or team has been identified and held accountable for the administration of processes and facilitation of international mobility\n', 4),
(133, 34, 'The company is organised like a purely local company and functions like one, without a clear plan, structure nor culture for internationalisation', 1),
(134, 34, 'The company has a broad plan to grow internationally and has identified resources to support growth/ limited operations in overseas markets; however, these resources are typically deployed on an ad hoc basis;</br>The company has not specifically developed international organisation capabilities nor structure\n', 2),
(135, 34, 'The company has an international growth strategy and has basic overseas functions; however, these functions are led by Singapore-based managers who have other roles in Singapore</br>While the company has started to adapt its existing  structure in Singapore to support its international efforts, its organisation culture and HR structures have not been fully developed to cater for international growth\n', 3),
(136, 34, 'The company has a clear international growth strategy and has been structured to develop and grow organically in multiple overseas markets, with the management team being well-coordinated and held accountable for international growth;</br>The company has introduced organisation capabilities and culture which support internationalisation, by developing international management competencies, building an internationally-diversified workforce, international HR structures, etc\n', 4);

##Change script End##

##PHUOCHO##
##05/06/2014##
## GET USERNAME ##
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
                      <td class="w580" width="580" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;">
                      </td>
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
                              <td class="w580" width="580" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><p align="left" class="article-title" style="font-size:18px;line-height:24px;color:#0f0080;font-weight:bold;margin-top:0px;margin-bottom:18px;font-family:HelveticaNeue, sans-serif;">Request  Retrieve Username</p>
                                <div align="left" class="article-content" style="font-size:14px;line-height:14px;color:#444444;margin-top:0px;margin-bottom:18px;font-family:HelveticaNeue, sans-serif;">Hi, {ID_LOGIN}
                                <p>You have requested for the your Username. Please take note of your account details below:</p>
                                </br>
                                <p>Username: <strong>{ID_LOGIN}</strong></p>
                                </br>
                                <!-- <p>Click<a href="{LINK_LOGIN}"><em> Here </em></a>to login</p>
                                <p>if you are not requirement, please ignore email of this, Thanks you</p> -->
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
                        </td>
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
</html>' WHERE `email_template`.`ID` = 2;

## GET PASSWORD ##

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
                      <td class="w580" width="580" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
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
                        </span></td>
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
</html>
' WHERE `email_template`.`ID` = 3;
##Change script End##

##PHUOCHO##
##06/06/2014##
## GET USERNAME ##
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
                              <td class="w580" width="580" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><p align="left" class="article-title" style="font-size:18px;line-height:24px;color:#0f0080;font-weight:bold;margin-top:0px;margin-bottom:18px;font-family:HelveticaNeue, sans-serif;">Request  Retrieve Username</p>
                                <div align="left" class="article-content" style="font-size:14px;line-height:14px;color:#444444;margin-top:0px;margin-bottom:18px;font-family:HelveticaNeue, sans-serif;">Hi, 
                                <p>You or someone has sent request reminded username,</p>
                                </br>
                                <p>Username: <strong>{ID_LOGIN}</strong></p>
                                </br>
                                <p>Click<a href="{LINK_LOGIN}"><em> Here </em></a>to login</p>
                                <p>if you are not requirement, please ignore email of this, Thanks you</p>
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
                        <p align="left" class="footer-content-left" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;line-height:15px;color:#888888;margin-top:0px;margin-bottom:15px;"><a  href="#" onclick="return false;" style="color: #15c;">{ALT_BODY}</a> |</p></td>
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
</html>
' WHERE `email_template`.`ID` = 2;

## GET PASSWORD ##

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
                        <p align="left" class="footer-content-left" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;line-height:15px;color:#888888;margin-top:0px;margin-bottom:15px;"><a  href="#" onclick="return false;"style="color: #15c;">{ALT_BODY}</a> |</p></td>
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
</html>
' WHERE `email_template`.`ID` = 3;
##Change script End##



##GIAMPQ##
##07/06/2014##



DELETE FROM `email_template`

INSERT INTO `email_template` (`ID`, `TYPE`, `TEMPLATE_KEY`, `TEMPLATE_SUBJECT`, `TEMPLATE_BODY`) VALUES
(1, 'EMAIL', 'ACTIVE_ACCOUNT', 'ACTIVE ACCOUNT', ''),
(2, 'EMAIL', 'FORGOT_ID', 'SUBJECT : GET ID', '<!DOCTYPE html>\n<html>\n<head>\n<title>HAY GROUP COMPANY</title>\n<meta http-equiv="Content-Type" content="text/html; charset=utf-8">\n<meta name="viewport" content="width=320, target-densitydpi=device-dpi">\n<style type="text/css">\n@media only screen and (max-width: 660px) {\ntable[class=w0], td[class=w0] {\n  width: 0 !important;\n}\ntable[class=w10], td[class=w10], img[class=w10] {\n  width: 10px !important;\n}\ntable[class=w15], td[class=w15], img[class=w15] {\n  width: 5px !important;\n}\ntable[class=w30], td[class=w30], img[class=w30] {\n  width: 10px !important;\n}\ntable[class=w60], td[class=w60], img[class=w60] {\n  width: 10px !important;\n}\ntable[class=w125], td[class=w125], img[class=w125] {\n  width: 80px !important;\n}\ntable[class=w130], td[class=w130], img[class=w130] {\n  width: 55px !important;\n}\ntable[class=w140], td[class=w140], img[class=w140] {\n  width: 90px !important;\n}\ntable[class=w160], td[class=w160], img[class=w160] {\n  width: 180px !important;\n}\ntable[class=w170], td[class=w170], img[class=w170] {\n  width: 100px !important;\n}\ntable[class=w180], td[class=w180], img[class=w180] {\n  width: 80px !important;\n}\ntable[class=w195], td[class=w195], img[class=w195] {\n  width: 80px !important;\n}\ntable[class=w220], td[class=w220], img[class=w220] {\n  width: 80px !important;\n}\ntable[class=w240], td[class=w240], img[class=w240] {\n  width: 180px !important;\n}\ntable[class=w255], td[class=w255], img[class=w255] {\n  width: 185px !important;\n}\ntable[class=w275], td[class=w275], img[class=w275] {\n  width: 135px !important;\n}\ntable[class=w280], td[class=w280], img[class=w280] {\n  width: 135px !important;\n}\ntable[class=w300], td[class=w300], img[class=w300] {\n  width: 140px !important;\n}\ntable[class=w325], td[class=w325], img[class=w325] {\n  width: 95px !important;\n}\ntable[class=w360], td[class=w360], img[class=w360] {\n  width: 140px !important;\n}\ntable[class=w410], td[class=w410], img[class=w410] {\n  width: 180px !important;\n}\ntable[class=w470], td[class=w470], img[class=w470] {\n  width: 200px !important;\n}\ntable[class=w580], td[class=w580], img[class=w580] {\n  width: 280px !important;\n}\ntable[class=w640], td[class=w640], img[class=w640] {\n  width: 300px !important;\n}\ntable[class*=hide], td[class*=hide], img[class*=hide], p[class*=hide], span[class*=hide] {\n  display: none !important;\n}\ntable[class=h0], td[class=h0] {\n  height: 0 !important;\n}\np[class=footer-content-left] {\n  text-align: center !important;\n}\n#headline p {\n  font-size: 30px !important;\n}\n.article-content, #left-sidebar {\n  -webkit-text-size-adjust: 90% !important;\n  -ms-text-size-adjust: 90% !important;\n}\n.header-content, .footer-content-left {\n  -webkit-text-size-adjust: 80% !important;\n  -ms-text-size-adjust: 80% !important;\n}\nimg {\n  height: auto;\n  line-height: 100%;\n}\n}\n#outlook a {\n  padding: 0;\n}\nbody {\n  width: 100% !important;\n}\n.ReadMsgBody {\n  width: 100%;\n}\n.ExternalClass {\n  width: 100%;\n  display: block !important;\n}\nbody {\n  background-color: #c7c7c7;\n  margin: 0;\n  padding: 0;\n}\nimg {\n  outline: none;\n  text-decoration: none;\n  display: block;\n}\nbr, strong br, b br, em br, i br {\n  line-height: 100%;\n}\nh1, h2, h3, h4, h5, h6 {\n  line-height: 100% !important;\n  -webkit-font-smoothing: antialiased;\n}\nh1 a, h2 a, h3 a, h4 a, h5 a, h6 a {\n  color: blue !important;\n}\nh1 a:active, h2 a:active, h3 a:active, h4 a:active, h5 a:active, h6 a:active {\n  color: red !important;\n}\nh1 a:visited, h2 a:visited, h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited {\n  color: purple !important;\n}\ntable td, table tr {\n  border-collapse: collapse;\n}\n.yshortcuts, .yshortcuts a, .yshortcuts a:link, .yshortcuts a:visited, .yshortcuts a:hover, .yshortcuts a span {\n  color: black;\n  text-decoration: none !important;\n  border-bottom: none !important;\n  background: none !important;\n}\ncode {\n  white-space: normal;\n  word-break: break-all;\n}\n#background-table {\n  background-color: #c7c7c7;\n}\n#top-bar {\n  border-radius: 6px 6px 0px 0px;\n  -moz-border-radius: 6px 6px 0px 0px;\n  -webkit-border-radius: 6px 6px 0px 0px;\n  -webkit-font-smoothing: antialiased;\n  background-color: #2E2E2E;\n  color: #888888;\n}\n#top-bar a {\n  font-weight: bold;\n  color: #eeeeee;\n  text-decoration: none;\n}\n#footer {\n  border-radius: 0px 0px 6px 6px;\n  -moz-border-radius: 0px 0px 6px 6px;\n  -webkit-border-radius: 0px 0px 6px 6px;\n  -webkit-font-smoothing: antialiased;\n}\nbody, td {\n  font-family: HelveticaNeue, sans-serif;\n}\n.header-content, .footer-content-left, .footer-content-right {\n  -webkit-text-size-adjust: none;\n  -ms-text-size-adjust: none;\n}\n.header-content {\n  font-size: 12px;\n  color: #888888;\n}\n.header-content a {\n  font-weight: bold;\n  color: #eeeeee;\n  text-decoration: none;\n}\n#headline p {\n  color: #000c8f;\n  font-family: HelveticaNeue, sans-serif;\n  font-size: 36px;\n  text-align: center;\n  margin-top: 0px;\n  margin-bottom: 30px;\n}\n#headline p a {\n  color: #000c8f;\n  text-decoration: none;\n}\n.article-title {\n  font-size: 18px;\n  line-height: 24px;\n  color: #0f0080;\n  font-weight: bold;\n  margin-top: 0px;\n  margin-bottom: 18px;\n  font-family: HelveticaNeue, sans-serif;\n}\n.article-title a {\n  color: #0f0080;\n  text-decoration: none;\n}\n.article-title.with-meta {\n  margin-bottom: 0;\n}\n.article-meta {\n  font-size: 13px;\n  line-height: 20px;\n  color: #ccc;\n  font-weight: bold;\n  margin-top: 0;\n}\n.article-content {\n  font-size: 13px;\n  line-height: 18px;\n  color: #444444;\n  margin-top: 0px;\n  margin-bottom: 18px;\n  font-family: HelveticaNeue, sans-serif;\n}\n.article-content a {\n  color: #2f82de;\n  font-weight: bold;\n  text-decoration: none;\n}\n.article-content img {\n  max-width: 100%\n}\n.article-content ol, .article-content ul {\n  margin-top: 0px;\n  margin-bottom: 18px;\n  margin-left: 19px;\n  padding: 0;\n}\n.article-content li {\n  font-size: 13px;\n  line-height: 18px;\n  color: #444444;\n}\n.article-content li a {\n  color: #2f82de;\n  text-decoration: underline;\n}\n.article-content p {\n  margin-bottom: 15px;\n}\n.footer-content-left {\n  font-size: 12px;\n  line-height: 15px;\n  color: #888888;\n  margin-top: 0px;\n  margin-bottom: 15px;\n}\n.footer-content-left a {\n  color: #eeeeee;\n  font-weight: bold;\n  text-decoration: none;\n}\n.footer-content-right {\n  font-size: 11px;\n  line-height: 16px;\n  color: #888888;\n  margin-top: 0px;\n  margin-bottom: 15px;\n}\n.footer-content-right a {\n  color: #eeeeee;\n  font-weight: bold;\n  text-decoration: none;\n}\n#footer {\n  background-color: #000000;\n  color: #888888;\n}\n#footer a {\n  color: #eeeeee;\n  text-decoration: none;\n  font-weight: bold;\n}\n#permission-reminder {\n  white-space: normal;\n}\n#street-address {\n  color: #ffffff;\n  white-space: normal;\n}\n#email-footer{\n    width: 1024 px !important;\n}\n</style>\n<!--[if gte mso 9]>\n<style _tmplitem="10222" >\n.article-content ol, .article-content ul {\n   margin: 0 0 0 24px !important;\n   padding: 0 !important;\n   list-style-position: inside !important;\n}\n</style>\n<![endif]-->\n<meta name="robots" content="noindex,nofollow">\n<meta property="og:title" content="Hay Group">\n</head>\n<body style="width:100% !important;background-color:#c7c7c7;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:HelveticaNeue, sans-serif;">\n<table width="100%" cellpadding="0" cellspacing="0" border="0" id="background-table" style="background-color:#c7c7c7;">\n  <tbody>\n    <tr style="border-collapse:collapse;">\n      <td align="center" bgcolor="#c7c7c7" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w640" width="640" cellpadding="0" cellspacing="0" border="0" style="margin-top:0;margin-bottom:0;margin-right:10px;margin-left:10px;">\n          <tbody>\n            <tr style="border-collapse:collapse;">\n              <td class="w640" width="640" height="20" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n            </tr>\n            <tr style="border-collapse:collapse;">\n              <td class="w640" width="640" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table id="top-bar" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" style="border-radius:6px 6px 0px 0px;-moz-border-radius:6px 6px 0px 0px;-webkit-border-radius:6px 6px 0px 0px;-webkit-font-smoothing:antialiased;background-color:#2E2E2E;color:#888888;">\n                  <tbody>\n                    <tr style="border-collapse:collapse;">\n                      <td class="w15" width="15" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w325" width="350" valign="middle" align="left" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">\n                          <tbody>\n                            <tr style="border-collapse:collapse;">\n                              <td class="w325" width="350" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                            </tr>\n                          </tbody>\n                        </table>\n                        <div class="header-content" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;color:#888888;"><a href="{HOME_PAGE}" style="font-weight:bold;color:#eeeeee;text-decoration:none;">Home Page</a><span class="hide">&nbsp;&nbsp;|&nbsp;</span>\n                        </div>\n                        <table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">\n                          <tbody>\n                            <tr style="border-collapse:collapse;">\n                              <td class="w325" width="350" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                            </tr>\n                          </tbody>\n                        </table></td>\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w255" width="255" valign="middle" align="right" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">\n                          <tbody>\n                            <tr style="border-collapse:collapse;">\n                              <td class="w255" width="255" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                            </tr>\n                          </tbody>\n                        </table>\n                        <table cellpadding="0" cellspacing="0" border="0">\n                          <tbody>\n                            <tr style="border-collapse:collapse;"> </tr>\n                          </tbody>\n                        </table>\n                        <table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">\n                          <tbody>\n                            <tr style="border-collapse:collapse;">\n                              <td class="w255" width="255" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                            </tr>\n                          </tbody>\n                        </table></td>\n                      <td class="w15" width="15" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                    </tr>\n                  </tbody>\n                </table></td>\n            </tr>\n            <tr style="border-collapse:collapse;">\n              <td id="header" class="w640" width="640" align="center" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w640" width="640" cellpadding="0" cellspacing="0" border="0">\n                  <tbody>\n                    <tr style="border-collapse:collapse;">\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w580" width="580" height="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                    </tr>\n                    <tr style="border-collapse:collapse;">\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w580" width="580" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><div align="center" id="headline">\n                          <p style="color:#000c8f;font-family:HelveticaNeue, sans-serif;font-size:36px;text-align:center;margin-top:0px;margin-bottom:30px;"> <strong><a href="#" style="color:#000c8f;text-decoration:none;">Hay Group Company</a></strong> </p>\n                        </div></td>\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                    </tr>\n                  </tbody>\n                </table></td>\n            </tr>\n            <tr style="border-collapse:collapse;">\n              <td class="w640" width="640" height="30" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n            </tr>\n            <tr id="simple-content-row" style="border-collapse:collapse;">\n              <td class="w640" width="640" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table align="left" class="w640" width="640" cellpadding="0" cellspacing="0" border="0">\n                  <tbody>\n                    <tr style="border-collapse:collapse;">\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w580" width="580" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w580" width="580" cellpadding="0" cellspacing="0" border="0">\n                          <tbody>\n                            <tr style="border-collapse:collapse;">\n                              <td class="w580" width="580" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><p align="left" class="article-title" style="font-size:18px;line-height:24px;color:#0f0080;font-weight:bold;margin-top:0px;margin-bottom:18px;font-family:HelveticaNeue, sans-serif;">Request  Retrieve Username</p>\n                                <div align="left" class="article-content" style="font-size:14px;line-height:14px;color:#444444;margin-top:0px;margin-bottom:18px;font-family:HelveticaNeue, sans-serif;">Hi, {ID_LOGIN}\n                                <p>You have requested for the your Username. Please take note of your account details below:</p>\n                                </br>\n                                <p>Username: <strong>{ID_LOGIN}</strong></p>\n                                </br>\n                                <!-- <p>Click<a href="{LINK_LOGIN}"><em> Here </em></a>to login</p>\n                                <p>if you are not requirement, please ignore email of this, Thanks you</p> -->\n                                </div>\n                              </td>\n                            </tr>\n                            <tr style="border-collapse:collapse;">\n                              <td class="w580" width="580" height="10" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                            </tr>\n                          </tbody>\n                        </table></td>\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                    </tr>\n                  </tbody>\n                </table></td>\n            </tr>\n            <tr style="border-collapse:collapse;">\n              <td class="w640" width="640" height="15" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n            </tr>\n            <tr style="border-collapse:collapse;">\n              <td class="w640" width="640" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table id="footer" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#000000" style="border-radius:0px 0px 6px 6px;-moz-border-radius:0px 0px 6px 6px;-webkit-border-radius:0px 0px 6px 6px;-webkit-font-smoothing:antialiased;background-color:#000000;color:#888888;">\n                  <tbody>\n                    <tr style="border-collapse:collapse;">\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w580 h0" width="360" height="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w0" width="60" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w0" width="160" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                    </tr>\n                    <tr style="border-collapse:collapse;">\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;padding-left: 20px;"></td>\n                      <td class="w580" width="90%" valign="top" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><span class="hide">\n                        <p id="permission-reminder" align="left" class="footer-content-left" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;line-height:15px;color:#888888;margin-top:0px;margin-bottom:15px;white-space:normal;"><span>About Hay Group</span><br style="line-height:100%;">\n                          <span>Hay Group is a global management consulting firm that works with leaders to transform strategy into reality. We develop talent, organize people to be more effective and motivate them to perform at their best.</span></p>\n                        </span>\n                        <p align="left" class="footer-content-left" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;line-height:15px;color:#888888;margin-top:0px;margin-bottom:15px;"><a href="#">{ALT_BODY}</a> |</p></td>\n                    </tr>\n                    <tr style="border-collapse:collapse;">\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w580 h0" width="360" height="15" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                    </tr>\n                  </tbody>\n                </table></td>\n            </tr>\n            <tr style="border-collapse:collapse;">\n              <td class="w640" width="640" height="60" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n            </tr>\n          </tbody>\n        </table></td>\n    </tr>\n  </tbody>\n</table>\n</body>\n</html>'),
(3, 'EMAIL', 'FORGOT_PASSWORD', 'SUBJECT : GET PASSWORD', '<!DOCTYPE html>\n<html>\n<head>\n<title>HAY GROUP COMPANY</title>\n<meta http-equiv="Content-Type" content="text/html; charset=utf-8">\n<meta name="viewport" content="width=320, target-densitydpi=device-dpi">\n<style type="text/css">\n@media only screen and (max-width: 660px) {\ntable[class=w0], td[class=w0] {\n  width: 0 !important;\n}\ntable[class=w10], td[class=w10], img[class=w10] {\n  width: 10px !important;\n}\ntable[class=w15], td[class=w15], img[class=w15] {\n  width: 5px !important;\n}\ntable[class=w30], td[class=w30], img[class=w30] {\n  width: 10px !important;\n}\ntable[class=w60], td[class=w60], img[class=w60] {\n  width: 10px !important;\n}\ntable[class=w125], td[class=w125], img[class=w125] {\n  width: 80px !important;\n}\ntable[class=w130], td[class=w130], img[class=w130] {\n  width: 55px !important;\n}\ntable[class=w140], td[class=w140], img[class=w140] {\n  width: 90px !important;\n}\ntable[class=w160], td[class=w160], img[class=w160] {\n  width: 180px !important;\n}\ntable[class=w170], td[class=w170], img[class=w170] {\n  width: 100px !important;\n}\ntable[class=w180], td[class=w180], img[class=w180] {\n  width: 80px !important;\n}\ntable[class=w195], td[class=w195], img[class=w195] {\n  width: 80px !important;\n}\ntable[class=w220], td[class=w220], img[class=w220] {\n  width: 80px !important;\n}\ntable[class=w240], td[class=w240], img[class=w240] {\n  width: 180px !important;\n}\ntable[class=w255], td[class=w255], img[class=w255] {\n  width: 185px !important;\n}\ntable[class=w275], td[class=w275], img[class=w275] {\n  width: 135px !important;\n}\ntable[class=w280], td[class=w280], img[class=w280] {\n  width: 135px !important;\n}\ntable[class=w300], td[class=w300], img[class=w300] {\n  width: 140px !important;\n}\ntable[class=w325], td[class=w325], img[class=w325] {\n  width: 95px !important;\n}\ntable[class=w360], td[class=w360], img[class=w360] {\n  width: 140px !important;\n}\ntable[class=w410], td[class=w410], img[class=w410] {\n  width: 180px !important;\n}\ntable[class=w470], td[class=w470], img[class=w470] {\n  width: 200px !important;\n}\ntable[class=w580], td[class=w580], img[class=w580] {\n  width: 280px !important;\n}\ntable[class=w640], td[class=w640], img[class=w640] {\n  width: 300px !important;\n}\ntable[class*=hide], td[class*=hide], img[class*=hide], p[class*=hide], span[class*=hide] {\n  display: none !important;\n}\ntable[class=h0], td[class=h0] {\n  height: 0 !important;\n}\np[class=footer-content-left] {\n  text-align: center !important;\n}\n#headline p {\n  font-size: 30px !important;\n}\n.article-content, #left-sidebar {\n  -webkit-text-size-adjust: 90% !important;\n  -ms-text-size-adjust: 90% !important;\n}\n.header-content, .footer-content-left {\n  -webkit-text-size-adjust: 80% !important;\n  -ms-text-size-adjust: 80% !important;\n}\nimg {\n  height: auto;\n  line-height: 100%;\n}\n}\n#outlook a {\n  padding: 0;\n}\nbody {\n  width: 100% !important;\n}\n.ReadMsgBody {\n  width: 100%;\n}\n.ExternalClass {\n  width: 100%;\n  display: block !important;\n}\nbody {\n  background-color: #c7c7c7;\n  margin: 0;\n  padding: 0;\n}\nimg {\n  outline: none;\n  text-decoration: none;\n  display: block;\n}\nbr, strong br, b br, em br, i br {\n  line-height: 100%;\n}\nh1, h2, h3, h4, h5, h6 {\n  line-height: 100% !important;\n  -webkit-font-smoothing: antialiased;\n}\nh1 a, h2 a, h3 a, h4 a, h5 a, h6 a {\n  color: blue !important;\n}\nh1 a:active, h2 a:active, h3 a:active, h4 a:active, h5 a:active, h6 a:active {\n  color: red !important;\n}\nh1 a:visited, h2 a:visited, h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited {\n  color: purple !important;\n}\ntable td, table tr {\n  border-collapse: collapse;\n}\n.yshortcuts, .yshortcuts a, .yshortcuts a:link, .yshortcuts a:visited, .yshortcuts a:hover, .yshortcuts a span {\n  color: black;\n  text-decoration: none !important;\n  border-bottom: none !important;\n  background: none !important;\n}\ncode {\n  white-space: normal;\n  word-break: break-all;\n}\n#background-table {\n  background-color: #c7c7c7;\n}\n#top-bar {\n  border-radius: 6px 6px 0px 0px;\n  -moz-border-radius: 6px 6px 0px 0px;\n  -webkit-border-radius: 6px 6px 0px 0px;\n  -webkit-font-smoothing: antialiased;\n  background-color: #2E2E2E;\n  color: #888888;\n}\n#top-bar a {\n  font-weight: bold;\n  color: #eeeeee;\n  text-decoration: none;\n}\n#footer {\n  border-radius: 0px 0px 6px 6px;\n  -moz-border-radius: 0px 0px 6px 6px;\n  -webkit-border-radius: 0px 0px 6px 6px;\n  -webkit-font-smoothing: antialiased;\n}\nbody, td {\n  font-family: HelveticaNeue, sans-serif;\n}\n.header-content, .footer-content-left, .footer-content-right {\n  -webkit-text-size-adjust: none;\n  -ms-text-size-adjust: none;\n}\n.header-content {\n  font-size: 12px;\n  color: #888888;\n}\n.header-content a {\n  font-weight: bold;\n  color: #eeeeee;\n  text-decoration: none;\n}\n#headline p {\n  color: #000c8f;\n  font-family: HelveticaNeue, sans-serif;\n  font-size: 36px;\n  text-align: center;\n  margin-top: 0px;\n  margin-bottom: 30px;\n}\n#headline p a {\n  color: #000c8f;\n  text-decoration: none;\n}\n.article-title {\n  font-size: 18px;\n  line-height: 24px;\n  color: #0f0080;\n  font-weight: bold;\n  margin-top: 0px;\n  margin-bottom: 18px;\n  font-family: HelveticaNeue, sans-serif;\n}\n.article-title a {\n  color: #0f0080;\n  text-decoration: none;\n}\n.article-title.with-meta {\n  margin-bottom: 0;\n}\n.article-meta {\n  font-size: 13px;\n  line-height: 20px;\n  color: #ccc;\n  font-weight: bold;\n  margin-top: 0;\n}\n.article-content {\n  font-size: 13px;\n  line-height: 18px;\n  color: #444444;\n  margin-top: 0px;\n  margin-bottom: 18px;\n  font-family: HelveticaNeue, sans-serif;\n}\n.article-content a {\n  color: #2f82de;\n  font-weight: bold;\n  text-decoration: none;\n}\n.article-content img {\n  max-width: 100%\n}\n.article-content ol, .article-content ul {\n  margin-top: 0px;\n  margin-bottom: 18px;\n  margin-left: 19px;\n  padding: 0;\n}\n.article-content li {\n  font-size: 13px;\n  line-height: 18px;\n  color: #444444;\n}\n.article-content li a {\n  color: #2f82de;\n  text-decoration: underline;\n}\n.article-content p {\n  margin-bottom: 15px;\n}\n.footer-content-left {\n  font-size: 12px;\n  line-height: 15px;\n  color: #888888;\n  margin-top: 0px;\n  margin-bottom: 15px;\n}\n.footer-content-left a {\n  color: #eeeeee;\n  font-weight: bold;\n  text-decoration: none;\n}\n.footer-content-right {\n  font-size: 11px;\n  line-height: 16px;\n  color: #888888;\n  margin-top: 0px;\n  margin-bottom: 15px;\n}\n.footer-content-right a {\n  color: #eeeeee;\n  font-weight: bold;\n  text-decoration: none;\n}\n#footer {\n  background-color: #000000;\n  color: #888888;\n}\n#footer a {\n  color: #eeeeee;\n  text-decoration: none;\n  font-weight: bold;\n}\n#permission-reminder {\n  white-space: normal;\n}\n#street-address {\n  color: #ffffff;\n  white-space: normal;\n}\n#email-footer{\n    width: 1024 px !important;\n}\n</style>\n<!--[if gte mso 9]>\n<style _tmplitem="10222" >\n.article-content ol, .article-content ul {\n   margin: 0 0 0 24px !important;\n   padding: 0 !important;\n   list-style-position: inside !important;\n}\n</style>\n<![endif]-->\n<meta name="robots" content="noindex,nofollow">\n<meta property="og:title" content="Hay Group">\n</head>\n<body style="width:100% !important;background-color:#c7c7c7;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:HelveticaNeue, sans-serif;">\n<table width="100%" cellpadding="0" cellspacing="0" border="0" id="background-table" style="background-color:#c7c7c7;">\n  <tbody>\n    <tr style="border-collapse:collapse;">\n      <td align="center" bgcolor="#c7c7c7" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w640" width="640" cellpadding="0" cellspacing="0" border="0" style="margin-top:0;margin-bottom:0;margin-right:10px;margin-left:10px;">\n          <tbody>\n            <tr style="border-collapse:collapse;">\n              <td class="w640" width="640" height="20" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n            </tr>\n            <tr style="border-collapse:collapse;">\n              <td class="w640" width="640" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table id="top-bar" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" style="border-radius:6px 6px 0px 0px;-moz-border-radius:6px 6px 0px 0px;-webkit-border-radius:6px 6px 0px 0px;-webkit-font-smoothing:antialiased;background-color:#2E2E2E;color:#888888;">\n                  <tbody>\n                    <tr style="border-collapse:collapse;">\n                      <td class="w15" width="15" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w325" width="350" valign="middle" align="left" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">\n                          <tbody>\n                            <tr style="border-collapse:collapse;">\n                              <td class="w325" width="350" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                            </tr>\n                          </tbody>\n                        </table>\n                        <div class="header-content" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;color:#888888;"><a href="{HOME_PAGE}" style="font-weight:bold;color:#eeeeee;text-decoration:none;">Home Page</a><span class="hide">&nbsp;&nbsp;|&nbsp;</span>\n                        </div>\n                        <table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">\n                          <tbody>\n                            <tr style="border-collapse:collapse;">\n                              <td class="w325" width="350" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                            </tr>\n                          </tbody>\n                        </table></td>\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w255" width="255" valign="middle" align="right" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">\n                          <tbody>\n                            <tr style="border-collapse:collapse;">\n                              <td class="w255" width="255" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                            </tr>\n                          </tbody>\n                        </table>\n                        <table cellpadding="0" cellspacing="0" border="0">\n                          <tbody>\n                            <tr style="border-collapse:collapse;"> </tr>\n                          </tbody>\n                        </table>\n                        <table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">\n                          <tbody>\n                            <tr style="border-collapse:collapse;">\n                              <td class="w255" width="255" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                            </tr>\n                          </tbody>\n                        </table></td>\n                      <td class="w15" width="15" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                    </tr>\n                  </tbody>\n                </table></td>\n            </tr>\n            <tr style="border-collapse:collapse;">\n              <td id="header" class="w640" width="640" align="center" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w640" width="640" cellpadding="0" cellspacing="0" border="0">\n                  <tbody>\n                    <tr style="border-collapse:collapse;">\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w580" width="580" height="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                    </tr>\n                    <tr style="border-collapse:collapse;">\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w580" width="580" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><div align="center" id="headline">\n                          <p style="color:#000c8f;font-family:HelveticaNeue, sans-serif;font-size:36px;text-align:center;margin-top:0px;margin-bottom:30px;"> <strong><a href="#" style="color:#000c8f;text-decoration:none;">Hay Group Company</a></strong> </p>\n                        </div></td>\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                    </tr>\n                  </tbody>\n                </table></td>\n            </tr>\n            <tr style="border-collapse:collapse;">\n              <td class="w640" width="640" height="30" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n            </tr>\n            <tr id="simple-content-row" style="border-collapse:collapse;">\n              <td class="w640" width="640" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table align="left" class="w640" width="640" cellpadding="0" cellspacing="0" border="0">\n                  <tbody>\n                    <tr style="border-collapse:collapse;">\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w580" width="580" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w580" width="580" cellpadding="0" cellspacing="0" border="0">\n                          <tbody>\n                            <tr style="border-collapse:collapse;">\n                              <td class="w580" width="580" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><p align="left" class="article-title" style="font-size:18px;line-height:24px;color:#0f0080;font-weight:bold;margin-top:0px;margin-bottom:18px;font-family:HelveticaNeue, sans-serif;">Request Retrieve Password</p>\n                                <div align="left" class="article-content" style="font-size:14px;line-height:14px;color:#444444;margin-top:0px;margin-bottom:18px;font-family:HelveticaNeue, sans-serif;">Hi <strong>{TX_USERNAME}</strong>, \n                                <p>You have requested to reset the password for the following account:</p>\n                                </br>\n                                <p>Username: <strong>{TX_USERNAME}</strong></p>\n                                </br>\n                                 <p>Generated Password: <strong>{TX_SECURITY_CODE}</strong></p>\n                                <p>Click<a href="{LINK_CHANGEPASSWORD}"><em> Here </em></a>to confirm change password</p>\n                                <p>To reset the password, please go to the <a href="{LOGIN_PAGE}"><em> login page </em></a> and login with the given password. Upon login, you will be prompted to reset your password. Thank you.</p>\n                                </div>\n                              </td>\n                            </tr>\n                            <tr style="border-collapse:collapse;">\n                              <td class="w580" width="580" height="10" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                            </tr>\n                          </tbody>\n                        </table></td>\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                    </tr>\n                  </tbody>\n                </table></td>\n            </tr>\n            <tr style="border-collapse:collapse;">\n              <td class="w640" width="640" height="15" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n            </tr>\n            <tr style="border-collapse:collapse;">\n              <td class="w640" width="640" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table id="footer" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#000000" style="border-radius:0px 0px 6px 6px;-moz-border-radius:0px 0px 6px 6px;-webkit-border-radius:0px 0px 6px 6px;-webkit-font-smoothing:antialiased;background-color:#000000;color:#888888;">\n                  <tbody>\n                    <tr style="border-collapse:collapse;">\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w580 h0" width="360" height="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w0" width="60" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w0" width="160" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                    </tr>\n                    <tr style="border-collapse:collapse;">\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;padding-left: 20px;"></td>\n                      <td class="w580" width="90%" valign="top" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><span class="hide">\n                        <p id="permission-reminder" align="left" class="footer-content-left" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;line-height:15px;color:#888888;margin-top:0px;margin-bottom:15px;white-space:normal;"><span>About Hay Group</span><br style="line-height:100%;">\n                          <span>Hay Group is a global management consulting firm that works with leaders to transform strategy into reality. We develop talent, organize people to be more effective and motivate them to perform at their best.</span></p>\n                        </span>\n                        <p align="left" class="footer-content-left" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;line-height:15px;color:#888888;margin-top:0px;margin-bottom:15px;"><a href="#">{ALT_BODY}</a> |</p></td>\n                    </tr>\n                    <tr style="border-collapse:collapse;">\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w580 h0" width="360" height="15" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                    </tr>\n                  </tbody>\n                </table></td>\n            </tr>\n            <tr style="border-collapse:collapse;">\n              <td class="w640" width="640" height="60" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n            </tr>\n          </tbody>\n        </table></td>\n    </tr>\n  </tbody>\n</table>\n</body>\n</html>\n');
INSERT INTO `email_template` (`ID`, `TYPE`, `TEMPLATE_KEY`, `TEMPLATE_SUBJECT`, `TEMPLATE_BODY`) VALUES
(4, 'EMAIL', 'WEEKLY_NOTIFICATION', 'SUBJECT : WEEKLY NOTIFICATION', '<!DOCTYPE html>\n<html>\n<head>\n<title>HAY GROUP COMPANY</title>\n<meta http-equiv="Content-Type" content="text/html; charset=utf-8">\n<meta name="viewport" content="width=320, target-densitydpi=device-dpi">\n<style type="text/css">\n@media only screen and (max-width: 660px) {\ntable[class=w0], td[class=w0] {\n  width: 0 !important;\n}\ntable[class=w10], td[class=w10], img[class=w10] {\n  width: 10px !important;\n}\ntable[class=w15], td[class=w15], img[class=w15] {\n  width: 5px !important;\n}\ntable[class=w30], td[class=w30], img[class=w30] {\n  width: 10px !important;\n}\ntable[class=w60], td[class=w60], img[class=w60] {\n  width: 10px !important;\n}\ntable[class=w125], td[class=w125], img[class=w125] {\n  width: 80px !important;\n}\ntable[class=w130], td[class=w130], img[class=w130] {\n  width: 55px !important;\n}\ntable[class=w140], td[class=w140], img[class=w140] {\n  width: 90px !important;\n}\ntable[class=w160], td[class=w160], img[class=w160] {\n  width: 180px !important;\n}\ntable[class=w170], td[class=w170], img[class=w170] {\n  width: 100px !important;\n}\ntable[class=w180], td[class=w180], img[class=w180] {\n  width: 80px !important;\n}\ntable[class=w195], td[class=w195], img[class=w195] {\n  width: 80px !important;\n}\ntable[class=w220], td[class=w220], img[class=w220] {\n  width: 80px !important;\n}\ntable[class=w240], td[class=w240], img[class=w240] {\n  width: 180px !important;\n}\ntable[class=w255], td[class=w255], img[class=w255] {\n  width: 185px !important;\n}\ntable[class=w275], td[class=w275], img[class=w275] {\n  width: 135px !important;\n}\ntable[class=w280], td[class=w280], img[class=w280] {\n  width: 135px !important;\n}\ntable[class=w300], td[class=w300], img[class=w300] {\n  width: 140px !important;\n}\ntable[class=w325], td[class=w325], img[class=w325] {\n  width: 95px !important;\n}\ntable[class=w360], td[class=w360], img[class=w360] {\n  width: 140px !important;\n}\ntable[class=w410], td[class=w410], img[class=w410] {\n  width: 180px !important;\n}\ntable[class=w470], td[class=w470], img[class=w470] {\n  width: 200px !important;\n}\ntable[class=w580], td[class=w580], img[class=w580] {\n  width: 280px !important;\n}\ntable[class=w640], td[class=w640], img[class=w640] {\n  width: 300px !important;\n}\ntable[class*=hide], td[class*=hide], img[class*=hide], p[class*=hide], span[class*=hide] {\n  display: none !important;\n}\ntable[class=h0], td[class=h0] {\n  height: 0 !important;\n}\np[class=footer-content-left] {\n  text-align: center !important;\n}\n#headline p {\n  font-size: 30px !important;\n}\n.article-content, #left-sidebar {\n  -webkit-text-size-adjust: 90% !important;\n  -ms-text-size-adjust: 90% !important;\n}\n.header-content, .footer-content-left {\n  -webkit-text-size-adjust: 80% !important;\n  -ms-text-size-adjust: 80% !important;\n}\nimg {\n  height: auto;\n  line-height: 100%;\n}\n}\n#outlook a {\n  padding: 0;\n}\nbody {\n  width: 100% !important;\n}\n.ReadMsgBody {\n  width: 100%;\n}\n.ExternalClass {\n  width: 100%;\n  display: block !important;\n}\nbody {\n  background-color: #c7c7c7;\n  margin: 0;\n  padding: 0;\n}\nimg {\n  outline: none;\n  text-decoration: none;\n  display: block;\n}\nbr, strong br, b br, em br, i br {\n  line-height: 100%;\n}\nh1, h2, h3, h4, h5, h6 {\n  line-height: 100% !important;\n  -webkit-font-smoothing: antialiased;\n}\nh1 a, h2 a, h3 a, h4 a, h5 a, h6 a {\n  color: blue !important;\n}\nh1 a:active, h2 a:active, h3 a:active, h4 a:active, h5 a:active, h6 a:active {\n  color: red !important;\n}\nh1 a:visited, h2 a:visited, h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited {\n  color: purple !important;\n}\ntable td, table tr {\n  border-collapse: collapse;\n}\n.yshortcuts, .yshortcuts a, .yshortcuts a:link, .yshortcuts a:visited, .yshortcuts a:hover, .yshortcuts a span {\n  color: black;\n  text-decoration: none !important;\n  border-bottom: none !important;\n  background: none !important;\n}\ncode {\n  white-space: normal;\n  word-break: break-all;\n}\n#background-table {\n  background-color: #c7c7c7;\n}\n#top-bar {\n  border-radius: 6px 6px 0px 0px;\n  -moz-border-radius: 6px 6px 0px 0px;\n  -webkit-border-radius: 6px 6px 0px 0px;\n  -webkit-font-smoothing: antialiased;\n  background-color: #2E2E2E;\n  color: #888888;\n}\n#top-bar a {\n  font-weight: bold;\n  color: #eeeeee;\n  text-decoration: none;\n}\n#footer {\n  border-radius: 0px 0px 6px 6px;\n  -moz-border-radius: 0px 0px 6px 6px;\n  -webkit-border-radius: 0px 0px 6px 6px;\n  -webkit-font-smoothing: antialiased;\n}\nbody, td {\n  font-family: HelveticaNeue, sans-serif;\n}\n.header-content, .footer-content-left, .footer-content-right {\n  -webkit-text-size-adjust: none;\n  -ms-text-size-adjust: none;\n}\n.header-content {\n  font-size: 12px;\n  color: #888888;\n}\n.header-content a {\n  font-weight: bold;\n  color: #eeeeee;\n  text-decoration: none;\n}\n#headline p {\n  color: #000c8f;\n  font-family: HelveticaNeue, sans-serif;\n  font-size: 36px;\n  text-align: center;\n  margin-top: 0px;\n  margin-bottom: 30px;\n}\n#headline p a {\n  color: #000c8f;\n  text-decoration: none;\n}\n.article-title {\n  font-size: 18px;\n  line-height: 24px;\n  color: #0f0080;\n  font-weight: bold;\n  margin-top: 0px;\n  margin-bottom: 18px;\n  font-family: HelveticaNeue, sans-serif;\n}\n.article-title a {\n  color: #0f0080;\n  text-decoration: none;\n}\n.article-title.with-meta {\n  margin-bottom: 0;\n}\n.article-meta {\n  font-size: 13px;\n  line-height: 20px;\n  color: #ccc;\n  font-weight: bold;\n  margin-top: 0;\n}\n.article-content {\n  font-size: 13px;\n  line-height: 18px;\n  color: #444444;\n  margin-top: 0px;\n  margin-bottom: 18px;\n  font-family: HelveticaNeue, sans-serif;\n}\n.article-content a {\n  color: #2f82de;\n  font-weight: bold;\n  text-decoration: none;\n}\n.article-content img {\n  max-width: 100%\n}\n.article-content ol, .article-content ul {\n  margin-top: 0px;\n  margin-bottom: 18px;\n  margin-left: 19px;\n  padding: 0;\n}\n.article-content li {\n  font-size: 13px;\n  line-height: 18px;\n  color: #444444;\n}\n.article-content li a {\n  color: #2f82de;\n  text-decoration: underline;\n}\n.article-content p {\n  margin-bottom: 15px;\n}\n.footer-content-left {\n  font-size: 12px;\n  line-height: 15px;\n  color: #888888;\n  margin-top: 0px;\n  margin-bottom: 15px;\n}\n.footer-content-left a {\n  color: #eeeeee;\n  font-weight: bold;\n  text-decoration: none;\n}\n.footer-content-right {\n  font-size: 11px;\n  line-height: 16px;\n  color: #888888;\n  margin-top: 0px;\n  margin-bottom: 15px;\n}\n.footer-content-right a {\n  color: #eeeeee;\n  font-weight: bold;\n  text-decoration: none;\n}\n#footer {\n  background-color: #000000;\n  color: #888888;\n}\n#footer a {\n  color: #eeeeee;\n  text-decoration: none;\n  font-weight: bold;\n}\n#permission-reminder {\n  white-space: normal;\n}\n#street-address {\n  color: #ffffff;\n  white-space: normal;\n}\n#email-footer{\n    width: 1024 px !important;\n}\n</style>\n<!--[if gte mso 9]>\n<style _tmplitem="10222" >\n.article-content ol, .article-content ul {\n   margin: 0 0 0 24px !important;\n   padding: 0 !important;\n   list-style-position: inside !important;\n}\n</style>\n<![endif]-->\n<meta name="robots" content="noindex,nofollow">\n<meta property="og:title" content="Hay Group">\n</head>\n<body style="width:100% !important;background-color:#c7c7c7;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:HelveticaNeue, sans-serif;">\n<table width="100%" cellpadding="0" cellspacing="0" border="0" id="background-table" style="background-color:#c7c7c7;">\n  <tbody>\n    <tr style="border-collapse:collapse;">\n      <td align="center" bgcolor="#c7c7c7" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w640" width="640" cellpadding="0" cellspacing="0" border="0" style="margin-top:0;margin-bottom:0;margin-right:10px;margin-left:10px;">\n          <tbody>\n            <tr style="border-collapse:collapse;">\n              <td class="w640" width="640" height="20" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n            </tr>\n            <tr style="border-collapse:collapse;">\n              <td class="w640" width="640" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table id="top-bar" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" style="border-radius:6px 6px 0px 0px;-moz-border-radius:6px 6px 0px 0px;-webkit-border-radius:6px 6px 0px 0px;-webkit-font-smoothing:antialiased;background-color:#2E2E2E;color:#888888;">\n                  <tbody>\n                    <tr style="border-collapse:collapse;">\n                      <td class="w15" width="15" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w325" width="350" valign="middle" align="left" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">\n                          <tbody>\n                            <tr style="border-collapse:collapse;">\n                              <td class="w325" width="350" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                            </tr>\n                          </tbody>\n                        </table>\n                        <div class="header-content" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;color:#888888;"><a href="{HOME_PAGE}" style="font-weight:bold;color:#eeeeee;text-decoration:none;">Home Page</a><span class="hide">&nbsp;&nbsp;|&nbsp;</span>\n                        </div>\n                        <table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">\n                          <tbody>\n                            <tr style="border-collapse:collapse;">\n                              <td class="w325" width="350" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                            </tr>\n                          </tbody>\n                        </table></td>\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w255" width="255" valign="middle" align="right" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">\n                          <tbody>\n                            <tr style="border-collapse:collapse;">\n                              <td class="w255" width="255" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                            </tr>\n                          </tbody>\n                        </table>\n                        <table cellpadding="0" cellspacing="0" border="0">\n                          <tbody>\n                            <tr style="border-collapse:collapse;"> </tr>\n                          </tbody>\n                        </table>\n                        <table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">\n                          <tbody>\n                            <tr style="border-collapse:collapse;">\n                              <td class="w255" width="255" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                            </tr>\n                          </tbody>\n                        </table></td>\n                      <td class="w15" width="15" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                    </tr>\n                  </tbody>\n                </table></td>\n            </tr>\n            <tr style="border-collapse:collapse;">\n              <td id="header" class="w640" width="640" align="center" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w640" width="640" cellpadding="0" cellspacing="0" border="0">\n                  <tbody>\n                    <tr style="border-collapse:collapse;">\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w580" width="580" height="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                    </tr>\n                    <tr style="border-collapse:collapse;">\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w580" width="580" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><div align="center" id="headline">\n                          <p style="color:#000c8f;font-family:HelveticaNeue, sans-serif;font-size:36px;text-align:center;margin-top:0px;margin-bottom:30px;"> <strong><a href="#" style="color:#000c8f;text-decoration:none;">Hay Group Company</a></strong> </p>\n                        </div></td>\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                    </tr>\n                  </tbody>\n                </table></td>\n            </tr>\n            <tr style="border-collapse:collapse;">\n              <td class="w640" width="640" height="30" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n            </tr>\n            <tr id="simple-content-row" style="border-collapse:collapse;">\n              <td class="w640" width="640" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table align="left" class="w640" width="640" cellpadding="0" cellspacing="0" border="0">\n                  <tbody>\n                    <tr style="border-collapse:collapse;">\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w580" width="580" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w580" width="580" cellpadding="0" cellspacing="0" border="0">\n                          <tbody>\n                            <tr style="border-collapse:collapse;">\n                              <td class="w580" width="580" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><p align="left" class="article-title" style="font-size:18px;line-height:24px;color:#0f0080;font-weight:bold;margin-top:0px;margin-bottom:18px;font-family:HelveticaNeue, sans-serif;">Weekly Notification</p>\n                                <div align="left" class="article-content" style="font-size:14px;line-height:14px;color:#444444;margin-top:0px;margin-bottom:18px;font-family:HelveticaNeue, sans-serif;">\n                                <p></p>\n                                </br>\n                                <p>Hi, <strong>{ID_LOGIN}</strong></p>\n                                </br>\n                                <p>Please find attached the weekly report generated on {DT_CREATE} .Thank you. </p>\n                                <p>If you do not be found the file attached! please click <a href="{LINK_DOWN}"><em> here </em></a> to download</p>\n                                </div>\n                              </td>\n                            </tr>\n                            <tr style="border-collapse:collapse;">\n                              <td class="w580" width="580" height="10" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                            </tr>\n                          </tbody>\n                        </table></td>\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                    </tr>\n                  </tbody>\n                </table></td>\n            </tr>\n            <tr style="border-collapse:collapse;">\n              <td class="w640" width="640" height="15" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n            </tr>\n            <tr style="border-collapse:collapse;">\n              <td class="w640" width="640" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table id="footer" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#000000" style="border-radius:0px 0px 6px 6px;-moz-border-radius:0px 0px 6px 6px;-webkit-border-radius:0px 0px 6px 6px;-webkit-font-smoothing:antialiased;background-color:#000000;color:#888888;">\n                  <tbody>\n                    <tr style="border-collapse:collapse;">\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w580 h0" width="360" height="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w0" width="60" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w0" width="160" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                    </tr>\n                    <tr style="border-collapse:collapse;">\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;padding-left: 20px;"></td>\n                      <td class="w580" width="90%" valign="top" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><span class="hide">\n                        <p id="permission-reminder" align="left" class="footer-content-left" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;line-height:15px;color:#888888;margin-top:0px;margin-bottom:15px;white-space:normal;"><span>About Hay Group</span><br style="line-height:100%;">\n                          <span>Hay Group is a global management consulting firm that works with leaders to transform strategy into reality. We develop talent, organize people to be more effective and motivate them to perform at their best.</span></p>\n                        </span>\n                        <p align="left" class="footer-content-left" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;line-height:15px;color:#888888;margin-top:0px;margin-bottom:15px;"><a href="#">{ALT_BODY}</a> |</p></td>\n                    </tr>\n                    <tr style="border-collapse:collapse;">\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w580 h0" width="360" height="15" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n                    </tr>\n                  </tbody>\n                </table></td>\n            </tr>\n            <tr style="border-collapse:collapse;">\n              <td class="w640" width="640" height="60" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>\n            </tr>\n          </tbody>\n        </table></td>\n    </tr>\n  </tbody>\n</table>\n</body>\n</html>\n');


##HIEPNT##
##01/04/2015##
ALTER TABLE t_user ADD USER_ORG INT AFTER NM_ORGANISATION, ADD USER_ROLE INT AFTER IN_USER, ADD DT_CREATED TIMESTAMP AFTER DT_LAST_LOGIN, ADD DT_DELETED TIMESTAMP AFTER DT_LAST_LOGIN;
UPDATE t_user SET USER_ROLE = 2
WHERE IN_ADMIN = 1;

UPDATE t_user SET USER_ROLE = 3
WHERE IN_USER = 1;

CREATE TABLE IF NOT EXISTS t_role (
ID INT AUTO_INCREMENT PRIMARY KEY,
NM_ROLE VARCHAR(50) NOT NULL
);

INSERT INTO `t_role` (`NM_ROLE`) VALUES
('SUPER USER'),
('AGENCY ADMIN'),
('NORMAL USER'),
('RESTRICTED USER');

##2/4/2015 ADD column user_name ##
ALTER TABLE t_user ADD USER_NAME VARCHAR(128);
#UPDATE t_user SET USER_NAME = 'VSII';


## add table t_organisation ##
CREATE TABLE IF NOT EXISTS `t_organisation` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `NM_ORG` VARCHAR(255) NOT NULL, PRIMARY KEY (`id`)
);

INSERT INTO `t_organisation` (`id`, `NM_ORG`) VALUES (NULL, 'HAY GROUP 1');
INSERT INTO `t_organisation` (`id`, `NM_ORG`) VALUES (NULL, 'HAY GROUP 2');
INSERT INTO `t_organisation` (`id`, `NM_ORG`) VALUES (NULL, 'HAY GROUP 3');
INSERT INTO `t_organisation` (`id`, `NM_ORG`) VALUES (NULL, 'HAY GROUP 4');
INSERT INTO `t_organisation` (`id`, `NM_ORG`) VALUES (NULL, 'HAY GROUP 5'); 

ALTER TABLE t_user ADD FOREIGN KEY (`USER_ORG`) REFERENCES t_organisation(`ID`);
UPDATE t_user SET USER_ORG = '1'; 

##Change script End##