# Accelerated Mobile Pages
Automatically add Accelerated Mobile Pages (AMP Project) functionality on your WordPress.
https://wordpress.org/plugins/accelerated-mobile-pages/

=== AMP - Accelerated Mobile Pages ===
Contributors: mohammed_kaludi, ahmedkaludi
Tags: accelerated mobile pages, amp, mobile, amp project, google amp, amp wp
Requires at least: 3.0
Tested up to: 4.5.2
Stable tag: 0.7
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Automatically add Accelerated Mobile Pages (Google AMP Project) functionality on your WordPress site.

== Description ==

Automatically add Accelerated Mobile Pages (Google AMP Project) functionality on your WordPress site. AMP WP is a plugin that needs to no configuration, just activate it and you are done.

[View Demo and Screenshot of the plugin](http://ahmedkaludi.com/accelerated-mobile-pages/)

**Features:**

* Automatically integrate AMP to your website
* Supports Posts and Pages
* Proper rel canonical tags which means that Google know the original page.
* Overlay Navigation Menu bar
* Social Sharing in the Single
* Sexy Design
* Separate WordPress Menu for AMP version


**NOTE: Next Update of this plugin will be released on 4 August 2016.** [Here is the list of things](https://goo.gl/jDTPyg) that will be updated in the next update


**How to test if AMP is working or not?** 

After you install the plugin, Google will automatically index the amp pages using the amp tag and then show you the updates in the search console.


**How can I view the AMP version of my site**

To view the AMP version, add /?amp at the end of your url. An example would be http://Website.com/?amp .... and No, you don't have to worry about duplication of the content because that has been taken care of the canonical tag as suggested by Google.


**How do I Report Bugs and Suggest New Features**

<i>You</i> can report the bugs at https://github.com/ahmedkaludi/Accelerated-Mobile-Pages/issues


**Will you Add New features upon my request?**

Yes, Absolutely! I would suggest you to send your feature request by creating an issue in Github at https://github.com/ahmedkaludi/Accelerated-Mobile-Pages/issues/new/ . It helps us organize the feedback easily.


**How do I get in touch?**

You can contact me using this url: http://ahmedkaludi.com/contact-me/


== Installation ==

1. Upload the folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. You can access your amp enabled website by adding ?amp at the end of the url.


== Frequently Asked Questions ==

= How do I know that my site is AMP enabled? =

Add /?amp at the end of your website url and you will get amp version of your website.

= I have addded /?amp at the end of the url and still I'm not able to see the AMP version of my site? =

Please check if you have "Pretty Permalinks" enabled. If not then activate it. For more details about Pretty Permalinks check out this wonderful article https://codex.wordpress.org/Using_Permalinks 


== Screenshots ==
1. AMP Homepage 
2. AMP Single Post
3. Post Navigation in Single
4. Sticky Social sharing icons
5. Overlay Navigation menu sidebar. 


== Changelog ==

= 0.1 =
* Initial version

= 0.2 =
* White Screen of death issue fixed
* Plugin URI updated

= 0.2.5 =
* Minor bugs fixed
* ?mobile & ?nomobile is now ?amp & ?noamp

= 0.3 =
* Support of amp-img added in single posts 
* minor css bug fixed

= 0.4 =
* Support of Custom menu added for AMP enabled sites

= 0.5 =
* Added AMP Markup for Google Structured data. This will fix the issues in Webmaster tools.

= 0.6 =
* Improved Navigation Menu, Search Console errors fixed, Social Sharing option, Pages support, Force redirection for mobile users removed and many other bug fixes

= 0.7 =
* Canonical Improved, Navigation Validation bug fixed, Two more validation bugs fixed ('role' and 'tabindex' attribute), Featured image automatically hides if it is not present, Validation issues in the images of the post's the_content