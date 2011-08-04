=== Mobile Device Shortcodes ===
Contributors: Chris McCoy
Donate link: http://wp.am
Tags: mobile, iphone, blackberry, ipad, shortcodes
Requires at least: 2.9
Tested up to: 2.9.2
Stable tag: 1.0

Adds the ability to target content to mobile devices, select a dedicated 
theme for mobile devices, and support for mobile video linking.

== Description ==

This plugin adds the ability to target content to different mobile devices with the use of wordpress
shortcodes. You can target specific devices to show certain content, or target all devices.

Also this plugin has the ability to select a dedicated theme to display to 
mobile devices, as well as support for mobile device video linking.

This plugin also is compatible with shortcodes, meaning you can add a shortcode inside the mobile
shortcode, incase you are using a plugin like nextgen gallery or have custom made shortcodes for your 
theme.

Supported Devices:

Android
Blackberry
Iphone
Ipad
Ipod touch
Windows Mobile
PSP
PDA
PALM OS
Opera Mini Devices
Kindle
Generic (any other type of mobile devices)

To target Ipad visitors you would add into your post

[is_ipad]content[/is_ipad]

Content being what you want displayed to only Ipad visitors.

Example using a shortcode within the mobile shortcode

[is_ipad]
[gallery]
[/is_ipad]

This would display images attached to a post to ipad users.

List of Shortcodes Include:

is_iphone
is_ipod
is_ipad
is_kindle
is_android
is_blackberry
is_palm
is_windows
is_opera
is_kindle
is_mobile (all mobile devices)
is_normal (for non mobile devices)

== Installation ==

1. Upload the plugin files to your `wp-plugins/` folder.
2. Go the plugin management page and activate the plugin.

== Frequently Asked Questions ==

= none at this time =

== Changelog ==

= 1.0 =
* First Release
