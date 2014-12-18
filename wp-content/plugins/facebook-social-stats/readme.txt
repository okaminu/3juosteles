=== Facebook Social Stats ===
Contributors: ninanet
Donate link: http://ninanet.com/dev_fbsocialstats.php
Tags: facebook, share, like, count, admin
Requires at least: 2.9.0
Tested up to: 3.0.4
Stable tag: 1.1

== Description ==

If you have both the facebook Like social plugin and the facebook Share button installed, you might have noticed that the counters show a combined count of Shares and Likes.
Chances are you would like to know exactly how many people have shared OR liked your article not just the combinded count. Without having to check the API for every single URL or looking at your articles one at a time.

Additionally, if you have the Like button installed (either manually or as a plugin) and the appropriate tags in your wordpress header, as soon as the "owner" (admin) of the post/page clicks the Like button, facebook generates an actual page for it. You can tell because next to the Like button (if you chose "standard" as your  layout option you now see a link to your secret "Admin page". 
This plugin also provides a link to the facebook page's "Insights" (if all prerequisites are fulfilled) - conveniently located next to your post's other facebook numbers.
Direct link to insights is now part of the plugin.

Knowledge is power :)


#### Functionality

The plugin queries the facebook API for a list of like_count, share_count, comment_count, total_count and click_count for your article's link and displays its findings as an addition in the Dashboard. It also shows a link to your post's Insights on facebook (if available) via another API call.

== Installation ==

Follow the steps below to install the plugin.

1. Upload the fb-social-stats directory to the '/wp-content/plugins/' directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to FB Social Stats in the Dashboard to see a list of all counts for all your articles.

== Screenshots ==

1. List of counts for a list of articles

== Frequently Asked Questions ==

= Why is sometimes so slow? =

Good question. Seems to have to do with facebook's API connectivity.

== Changelog ==

= 1.1 =
* updated URL to Admin Page
* Added direct link to insights

= 0.9.1 =
* Screenshot not showing correctly

= 0.9 =
* Consolidated API call to query the restserver only once
* Switched to SimpleXML

== Upgrade Notice ==
= 1.1 =
New, fixed link to Admin Page URL

= 0.9 =
Fixed API timeout by consolidating query


== Help ==

For help and support please contact us at nina [at] ninanet.com



