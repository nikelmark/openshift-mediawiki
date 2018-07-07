<?php
# This file was automatically generated by the MediaWiki 1.25.2
# installer. If you make manual changes, please keep track in case you
# need to recreate them later.
#
# See includes/DefaultSettings.php for all configurable settings
# and their default values, but don't forget to make changes in _this_
# file, not there.
#
# Further documentation for configuration settings may be found at:
# https://www.mediawiki.org/wiki/Manual:Configuration_settings

# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
    exit;
}

if ( defined( 'MW_DB' ) ) {
    // Command-line mode and maintenance scripts (e.g. update.php)
    $wikiname = MW_DB;
} else {
    // Web server
    $resource = strtolower($_SERVER['REQUEST_URI']);
    if ( preg_match( '/^\/([^\/]*)\//', $resource, $matches ) ) {
        $wikiname = $matches[1];
    }

    if ( strlen($wikiname) === 0 ) {
        $wikiname = 'meta';
    }
}

## The URL base path to the directory containing the wiki;
## defaults for all runtime URL paths are based off of this.
## For more information on customizing the URLs
## (like /w/index.php/Page_title to /wiki/Page_title) please see:
## https://www.mediawiki.org/wiki/Manual:Short_URL
if ( $wikiname === 'meta' ) {
    $wgDBname = getenv('OPENSHIFT_APP_NAME');
} else {
    $wgDBname = $wikiname . "_wiki";
}

$wgScriptPath = '/' . $wikiname;
$wikiname = strtoupper($wikiname);
$wgSitename = getenv($wikiname . '_SITE_NAME');
$admin_email = getenv($wikiname . '_ADMIN_EMAIL');
$google_analytics = getenv($wikiname . '_GOOGLE_ANALYTICS_ACCOUNT');
$wgGLSecret = getenv($wikiname . '_GOOGLE_LOGIN_SECRET');
$wgGLAppId = getenv($wikiname . '_GOOGLE_LOGIN_APP_ID');
$allowed_domain = getenv($wikiname . '_GOOGLE_LOGIN_DOMAIN');

## Uncomment this to disable output compression
# $wgDisableOutputCompression = true;

if (! $wgSitename) $wgSitename = "MediaWiki";
$wgMetaNamespace = getenv('OPENSHIFT_APP_NAME');

$wgScriptExtension = ".php";

## The protocol and server name to use in fully-qualified URLs
#$wgServer = "http://vtuwiki.negative..test";

## The relative URL path to the skins directory
$wgStylePath = "$wgScriptPath/skins";
$wgResourceBasePath = $wgScriptPath;
$wgArticlePath = $wgScriptPath . '/$1';

## The relative URL path to the logo.  Make sure you change this from the default,
## or else you'll overwrite your logo when you upgrade!
$wgLogo = "$wgResourceBasePath/resources/assets/images/logo.png";

## UPO means: this is also a user preference option

$wgEnableEmail = true;
$wgEnableUserEmail = true; # UPO

if (! $admin_email) $admin_email = 'admin@example.com';
$wgEmergencyContact = $admin_email;
$wgPasswordSender = $admin_email;
$wgSMTP = array(
    'host' => 'ssl://' . getenv('SMTP_SERVER'),
    'IDHost' =>  getenv('SMTP_DOMAIN'),
    'port' =>  getenv('SMTP_PORT'),
    'auth' => true,
    'username' =>  getenv('SMTP_USER_NAME'),
    'password' => getenv('SMTP_PASSWORD')
);

$wgEnotifUserTalk = true; # UPO
$wgEnotifWatchlist = true; # UPO
$wgEmailAuthentication = false;

## Database settings
$wgDBtype           = "mysql";
$db_host = getenv('OPENSHIFT_MYSQL_DB_HOST');
if (! $db_host) $db_host = getenv(strtoupper(getenv('OPENSHIFT_MYSQL_SERVICE_NAME')) . '_SERVICE_HOST');
$db_port = getenv('OPENSHIFT_MYSQL_DB_PORT');
if (! $db_port) $db_port = getenv(strtoupper(getenv('OPENSHIFT_MYSQL_SERVICE_NAME')) . '_SERVICE_PORT');
$wgDBserver         = $db_host.":".$db_port;
$wgDBuser           = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
$wgDBpassword       = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');

# MySQL specific settings
$wgDBprefix = "";

# MySQL table options to use during installation or update
$wgDBTableOptions = "ENGINE=InnoDB, DEFAULT CHARSET=binary";

# Experimental charset support for MySQL 5.0.
$wgDBmysql5 = false;

## Shared memory settings
$wgMainCacheType = CACHE_ACCEL;
$wgMemCachedServers = array();

## To enable image uploads, make sure the 'images' directory
## is writable, then set this to true:
$wgEnableUploads = true;
#$wgUseImageMagick = true;
#$wgImageMagickConvertCommand = "/usr/bin/convert";

# InstantCommons allows wiki to use images from http://commons.wikimedia.org
$wgUseInstantCommons = false;

## If you use ImageMagick (or any other shell command) on a
## Linux server, this will need to be set to the name of an
## available UTF-8 locale
$wgShellLocale = "en_US.UTF-8";

## If you want to use image uploads under safe mode,
## create the directories images/archive, images/thumb and
## images/temp, and make them all writable. Then uncomment
## this, if it's not already uncommented:
#$wgHashedUploadDirectory = false;

## If you have the appropriate support software installed
## you can enable inline LaTeX equations:
#$wgUseTeX           = true;

# The following permissions were set based on your choice in the installer
$wgGroupPermissions['*']['createaccount'] = false;
$wgGroupPermissions['*']['edit'] = false;
$wgGroupPermissions['*']['read'] = false;

## Set $wgCacheDirectory to a writable directory on the web server
## to make your wiki go slightly faster. The directory should not
## be publically accessible from the web.
#$wgCacheDirectory = "$IP/cache";

# Site language code, should be one of the list in ./languages/Names.php
$wgLanguageCode = "en";

$wgSecretKey = "MEDIAWIKI_SECRET_KEY";

# Site upgrade key. Must be set to a string (default provided) to turn on the
# web installer while LocalSettings.php is in place
$wgUpgradeKey = "MEDIAWIKI_UPGRADE_KEY";

## For attaching licensing metadata to pages, and displaying an
## appropriate copyright notice / icon. GNU Free Documentation
## License and Creative Commons licenses are supported so far.
$wgEnableCreativeCommonsRdf = true;
$wgRightsPage = ""; # Set to the title of a wiki page that describes your license/copyright
$wgRightsUrl = "http://creativecommons.org/licenses/by-sa/3.0/";
$wgRightsText = "Creative Commons Attribution Share Alike";
$wgRightsIcon = "{$wgStylePath}/common/images/cc-by-sa.png";

# Path to the GNU diff3 utility. Used for conflict resolution.
$wgDiff3 = "/usr/bin/diff3";

## Default skin: you can change the default skin. Use the internal symbolic
## names, ie 'vector', 'monobook':
$wgDefaultSkin = "vector";

# Enabled skins.
# The following skins were automatically enabled:
wfLoadSkin( 'CologneBlue' );
wfLoadSkin( 'Modern' );
wfLoadSkin( 'MonoBook' );
wfLoadSkin( 'Vector' );


# Enabled Extensions. Most extensions are enabled by including the base extension file here
# but check specific extension documentation for more details
# The following extensions were automatically enabled:
require_once "$IP/extensions/Scribunto/Scribunto.php";
$wgScribuntoDefaultEngine = 'luastandalone';
require_once "$IP/extensions/MobileFrontend/MobileFrontend.php";
$wgMFAutodetectMobileView = true;
wfLoadExtension( 'Cite' );
wfLoadExtension( 'CiteThisPage' );
require_once "$IP/extensions/ConfirmEdit/ConfirmEdit.php";
wfLoadExtension( 'Gadgets' );
wfLoadExtension( 'ImageMap' );
wfLoadExtension( 'InputBox' );
wfLoadExtension( 'Interwiki' );
wfLoadExtension( 'LocalisationUpdate' );
wfLoadExtension( 'Nuke' );
wfLoadExtension( 'ParserFunctions' );
wfLoadExtension( 'PdfHandler' );
wfLoadExtension( 'Poem' );
wfLoadExtension( 'Renameuser' );
wfLoadExtension( 'SpamBlacklist' );
wfLoadExtension( 'SyntaxHighlight_GeSHi' );
wfLoadExtension( 'TitleBlacklist' );
wfLoadExtension( 'WikiEditor' );


# End of automatically generated settings.
# Add more configuration options below.

##Clients real ip address
##known issue : multiple ips if you are behind cloudflare or similar. will fix soon.
require_once "$IP/extensions/OpenshiftMediawikiIpFix/OpenshiftMediawikiIpFix.php";
##

#analytics
if ($google_analytics) {
    require_once "$IP/extensions/googleAnalytics/googleAnalytics.php";
    $wgGoogleAnalyticsAccount = $google_analytics;
}
// Add HTML code for any additional web analytics (can be used alone or with $wgGoogleAnalyticsAccount)
//$wgGoogleAnalyticsOtherCode = '<script type="text/javascript" src="https://analytics.example.com/tracking.js"></script>';

// Optional configuration (for defaults see googleAnalytics.php)
// Store full IP address in Google Universal Analytics (see https://support.google.com/analytics/answer/2763052?hl=en for details)
$wgGoogleAnalyticsAnonymizeIP = false;
// Array with NUMERIC namespace IDs where web analytics code should NOT be included.
$wgGoogleAnalyticsIgnoreNsIDs = array(500);
// Array with page names (see magic word Extension:Google Analytics Integration) where web analytics code should NOT be included.
$wgGoogleAnalyticsIgnorePages = array('ArticleX', 'Foo:Bar');
// Array with special pages where web analytics code should NOT be included.
//$wgGoogleAnalyticsIgnoreSpecials = array( 'Userlogin', 'Userlogout', 'Preferences', 'ChangePassword', 'OATH');
// Use 'noanalytics' permission to exclude specific user groups from web analytics, e.g.
$wgGroupPermissions['sysop']['noanalytics'] = true;
$wgGroupPermissions['bot']['noanalytics'] = true;
// To exclude all logged in users give 'noanalytics' permission to 'user' group, i.e.

# ConfirmAccount
require_once "$IP/extensions/ConfirmAccount/ConfirmAccount.php";
$wgConfirmAccountContact = $admin_email;
$wgMakeUserPageFromBio = false;
$wgAutoWelcomeNewUsers = false;
$wgConfirmAccountRequestFormItems = array(
  'UserName'        => array( 'enabled' => true ),
  'RealName'        => array( 'enabled' => true ),
  'Biography'       => array( 'enabled' => false, 'minWords' => 10 ),
  'AreasOfInterest' => array( 'enabled' => false ),
  'CV'              => array( 'enabled' => false ),
  'Notes'           => array( 'enabled' => false ),
  'Links'           => array( 'enabled' => false ),
  'TermsOfService'  => array( 'enabled' => false ),
);

# Google Login
if ($wgGLSecret && $wgGLAppId) {
    require_once "$IP/extensions/GoogleLogin/GoogleLogin.php";
}
#$wgGLReplaceMWLogin = true;
if ($allowed_domain) {
    $wgGLAllowedDomains = array( $allowed_domain );
}
$wgGLShowRight = true;

$wgWhitelistRead = array( 'Special:RequestAccount', 'Special:GoogleLoginReturn' );

# UserMerge
wfLoadExtension( 'UserMerge' );
// By default nobody can use this function, enable for bureaucrat?
$wgGroupPermissions['bureaucrat']['usermerge'] = true;

#Add filetypes uploadable
$wgFileExtensions = array_merge($wgFileExtensions, array('svg','tar','gz','tar.gz','tgz','bz2','tar.bz2','tbz','Z','tar.Z','txt','tex','pdf','pptx','ppt','docx','doc','xlsx','xls','f','F','for','FOR','fpp','FPP','f90','F90','f95','F95','c','cpp','cxx','cc','agr','gpl'));
$wgVerifyMimeType = false;

# Showing more detailed debug information
$wgShowExceptionDetails = true;
