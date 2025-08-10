<?php

/**
 * PHPMaker constants
 */

namespace PHPMaker2025\project1;

/**
 * Constants
 */
define(__NAMESPACE__ . "\PROJECT_NAMESPACE", __NAMESPACE__ . "\\");

// System
define(PROJECT_NAMESPACE . "IS_WINDOWS", strtolower(substr(PHP_OS, 0, 3)) === "win"); // Is Windows OS
define(PROJECT_NAMESPACE . "PATH_DELIMITER", IS_WINDOWS ? "\\" : "/"); // Physical path delimiter

// Product version
define(PROJECT_NAMESPACE . "PRODUCT_VERSION", "25.12.0");

// Project
define(PROJECT_NAMESPACE . "PROJECT_NAME", "project1"); // Project name
define(PROJECT_NAMESPACE . "PROJECT_ID", "{DE8D5E86-44E5-4B2C-9D69-3206442E37A6}"); // Project ID

// Character encoding (utf-8)
define(PROJECT_NAMESPACE . "PROJECT_CHARSET", "utf-8"); // Charset
define(PROJECT_NAMESPACE . "EMAIL_CHARSET", "utf-8"); // Charset
define(PROJECT_NAMESPACE . "PROJECT_ENCODING", "UTF-8"); // Character encoding (uppercase)

// Cookie
define(PROJECT_NAMESPACE . "COOKIE_USER_PROFILE", "UserProfile_"); // User profile

// Session
define(PROJECT_NAMESPACE . "SESSION_STATUS", PROJECT_NAME . "_Status"); // Login status
define(PROJECT_NAMESPACE . "SESSION_USER_PROFILE", SESSION_STATUS . "_UserProfile"); // User profile
define(PROJECT_NAMESPACE . "SESSION_USER_NAME", SESSION_STATUS . "_UserName"); // User name
define(PROJECT_NAMESPACE . "SESSION_USER_ID", SESSION_STATUS . "_UserID"); // User ID
define(PROJECT_NAMESPACE . "SESSION_USER_PRIMARY_KEY", SESSION_STATUS . "_UserPrimaryKey"); // User primary key
define(PROJECT_NAMESPACE . "SESSION_USER_PROFILE_USER_NAME", SESSION_USER_PROFILE . "_UserName");
// define(PROJECT_NAMESPACE . "SESSION_USER_PROFILE_PASSWORD", SESSION_USER_PROFILE . "_Password");
define(PROJECT_NAMESPACE . "SESSION_USER_PROFILE_REMEMBER_ME", SESSION_USER_PROFILE . "_RememberMe");
define(PROJECT_NAMESPACE . "SESSION_USER_PROFILE_SECRET", SESSION_USER_PROFILE . "_Secret");
define(PROJECT_NAMESPACE . "SESSION_USER_PROFILE_SECURITY_CODE", SESSION_USER_PROFILE . "_SecurityCode");
define(PROJECT_NAMESPACE . "SESSION_TWO_FACTOR_AUTHENTICATION_TYPE", PROJECT_NAME . "_TwoFactorAuthenticationType");
define(PROJECT_NAMESPACE . "SESSION_USER_LEVEL_ID", SESSION_STATUS . "_UserLevel"); // User Level ID
define(PROJECT_NAMESPACE . "SESSION_USER_LEVEL_LIST", SESSION_STATUS . "_UserLevelList"); // User Level List
define(PROJECT_NAMESPACE . "SESSION_USER_LEVEL_LIST_LOADED", SESSION_STATUS . "_UserLevelListLoaded"); // User Level List Loaded
define(PROJECT_NAMESPACE . "SESSION_USER_LEVEL", SESSION_STATUS . "_UserLevelValue"); // User Level
define(PROJECT_NAMESPACE . "SESSION_PARENT_USER_ID", SESSION_STATUS . "_ParentUserId"); // Parent User ID
define(PROJECT_NAMESPACE . "SESSION_SYS_ADMIN", PROJECT_NAME . "_SysAdmin"); // System admin
define(PROJECT_NAMESPACE . "SESSION_PROJECT_ID", PROJECT_NAME . "_ProjectId"); // User Level project ID
define(PROJECT_NAMESPACE . "SESSION_USER_LEVELS", PROJECT_NAME . "_UserLevels"); // User Levels (array)
define(PROJECT_NAMESPACE . "SESSION_USER_LEVEL_PRIVS", PROJECT_NAME . "_UserLevelPrivs"); // User Level privileges (array)
define(PROJECT_NAMESPACE . "SESSION_USER_LEVEL_MSG", PROJECT_NAME . "_UserLevelMessage"); // User Level Message
define(PROJECT_NAMESPACE . "SESSION_INLINE_MODE", PROJECT_NAME . "_InlineMode"); // Inline mode
define(PROJECT_NAMESPACE . "SESSION_BREADCRUMB", PROJECT_NAME . "_Breadcrumb"); // Breadcrumb
define(PROJECT_NAMESPACE . "SESSION_HISTORY", PROJECT_NAME . "_History"); // History (Breadcrumb)
define(PROJECT_NAMESPACE . "SESSION_TEMP_IMAGES", PROJECT_NAME . "_TempImages"); // Temp images
define(PROJECT_NAMESPACE . "SESSION_CAPTCHA_CODE", PROJECT_NAME . "_Captcha"); // Captcha code
define(PROJECT_NAMESPACE . "SESSION_LANGUAGE_ID", PROJECT_NAME . "_LanguageId"); // Language ID
define(PROJECT_NAMESPACE . "SESSION_MYSQL_ENGINES", PROJECT_NAME . "_MySqlEngines"); // MySQL table engines
define(PROJECT_NAMESPACE . "SESSION_ACTIVE_USERS", PROJECT_NAME . "_ActiveUsers"); // Active users
