# Genesis Layout Extras

**General Info**

* [Plugin page on WordPress.org: wordpress.org/plugins/genesis-layout-extras/](https://wordpress.org/plugins/genesis-layout-extras/)
* [Translate the plugin](https://translate.wordpress.org/projects/wp-plugins/genesis-layout-extras)
* [**Join plugin's newsletter for insider info, tutorials and more**](https://eepurl.com/gbAUUn)
* [**Donate** for the further development & support of the plugin](https://www.paypal.me/deckerweb)
* [Plugin's documentation & FAQ](https://wordpress.org/plugins/genesis-layout-extras/#faq)
* [Facebook Community User Group](https://www.facebook.com/groups/deckerweb.wordpress.plugins/)
* [Facebook Info Page for Deckerweb Plugins](https://www.facebook.com/deckerweb.wordpress.plugins/)


## Changelog of the Plugin

### ⚡️ 2.1.2 - 2019-05-03

* *New: Successfully tested with WordPress 5.2*
* New: Integrated with WordPress 5.2+ new Site Health feature: Genesis Layout Extras now has an extra section on the Debug Info tab - this is especially helpful for support requests
* Tweak: Updated bundled library DDWlib Plugin Installer Recommendations to latest version (v1.4.0) - feature updates
* Tweak: Updated `.pot` file plus all German translations (formal, informal) and language packs
* New: [Join my newsletter for DECKERWEB WordPress Plugins](https://eepurl.com/gbAUUn) - insider info, plus tutorials and more useful stuff


### 🔧 2.1.1 - 2018-12-19

* Tweak: Fixed Fatal error caused from setting field creation function - thanks to user Pete for reporting it!
* Tweak: Fixed Admin styling glitches with Ninja Forms builder (and most likely other plugins) - Thanks to user feedback ([Topic](https://wordpress.org/support/topic/css-error-when-combined-with-ninja-forms/))


### 🎉 2.1.0 - 2018-12-18

* ***New: Brought the plugin back to life after more than five years, yeah! :)***
* New: Added plugin support for "Genesis Portfolio Pro" (free, by StudioPress)
* New: Added plugin support for "Genesis Author Pro" (free, by StudioPress)
* New: Added plugin support for "Simple Listings for Genesis" (free, by Robin Cornett)
* New: Release on GitHub.com as well (for issues, development etc.), see here: [https://github.com/deckerweb/genesis-layout-extras](https://github.com/deckerweb/genesis-layout-extras)
* New: Added `composer.json` file to the plugin's root folder - this is great for developers using Composer
* New: Added `README.md` file for plugin's GitHub.com repository to make it more readable there
* New: Added plugin update message also to Plugins page (overview table)
* New: Added plugins recommendations library by deckerweb to add plugin installer tips
* New: Added plugin recommendations meta box on settings page
* New: Added setting option to optionally unload the plugin's translations
* Tweak: Updated all internal plugin links to current state, deleted the ones that were dead or no longer needed
* Tweak: Refactored uninstall routine, added option to only delete data if enabled
* Tweak: Improved registered layout logic, especially for the select drop-down field
* Tweak: Lots of Dashicons, plus styling improvements for the admin settings page
* Tweak: Enhanced security
* Tweak: General code improvements and internal documentation updates
* Tweak: Added inline translator comments for Gettext functions wherever possible
* Tweak: Updated `.pot` file plus all German translations (formal, informal) and German language packs
* Tweak: Removed all non-German translations from the plugin package, as those are already [powered by WordPress.org language packs](https://translate.wordpress.org/projects/wp-plugins/genesis-layout-extras) - the German translation files now serve as an example for community translators
* Tweak: Overhauled and corrected Readme.txt file here
* Tweak: All new screenshots - plus some more ;-)
* Tweak: Added new plugin icon and banner on WordPress.org
* *Trivia fact: this plugin is already 7 (seven!) years old. Whoa, that's a lot. ;-)*


### 2.0.0 - 2013-08-05

* *The long-awaited, super-polished 2.0 plugin release with some new features also :)*
* NEW: Plugin now registers up to 9 (nine!) additional layout options! Requirement for this feature: Primary Sidebar (ID `sidebar`) and/or Secondary Sidebar (Sidebar-Alt, ID `sidebar-alt`) may *not* have been unregistered!
* NEW: Additional post type support, so you can add Genesis Layout support (plus SEO, plus Scripts) to all public custom post types; as well as the new "Archive Settings" pages (since Genesis 2.0+) for all public custom post types with archive support!
* NEW: Plugin detects the registered (official) layout options (from the child theme, or other plugins) and *displays only those* in the layout select drop-down!
* NEW: Added even more hooks & filters within the plugin. So for example, developers can now easily add more layout options to the select drop-down if needed! (see [FAQ here](https://wordpress.org/plugins/genesis-layout-extras/faq/) for more info)
* NEW: Plugin now leverages the Genesis Admin Class for improved security, performance, maintenance.
* CODE: Major code/ documentation updates & improvements.
* INFO: Where needed, the plugin now supports HTML5 markup/CSS styles with Genesis 2.0+. For example, all optional frontend CSS style sheets load automatically their HTML5 version if HTML5 is supported by your child theme.
* NEW: Added plugin support for "Genesis Prose Extras" for the layout select drop-down.
* NEW: Added support for regular uninstall routine with WordPress standard. (So, if you delete the plugin via the button on the plugin listing page, then the plugin's settings will be deletet from the options table!)
* UPDATE: Improved translation loading, now only within the admin area, also improved for custom translations!
* UPDATE: Reworked, improved and updated wording, help texts and overall user guidance.
* UPDATE: Updated and improved readme.txt file here, especially with new FAQ entries and better installation instructions.
* UPDATE: Updated all existing screenshots, added lots of new screenshots! :)
* NEW: Added new - partly - Swedish (sv_SE) translation - user-submitted.
* UPDATE: Updated all existing translations plus the .pot file for all translators! --> *Please [**help updating all translations for version 2.0.0**](https://translate.wordpress.org/projects/wp-plugins/genesis-layout-extras) too - THANKS!*


### 1.7.0 - 2013-03-22

* NEW: Added settings export (and therefore also import) to the Genesis Exporter/ Importer feature.
* NEW: Added support for "Portfolio" Custom Post Type in these child themes by ZigZagPress brand: Bijou, Eshop, Single, Solo, Tequila.
* NEW: Added new setting for all "Topics" for bbPress 2.x powered forums. Sometimes there are setups needed where a special layout for topics needs to be set. -- *Thanks to plugin user Romain for bringing this up! :)*
* UPDATE: Improved Genesis check on plugin activation and also added a version check to make sure, users run the latest versions of Genesis Framework and WordPress. -- *This just prepares for next major update of Genesis Layout Extras which will be a refactoring and make use of the 'Genesis Admin' class. I'll just will make sure as many users as possible have updated their Genesis install :).*
* UPDATE: Improved check for single posts and page to improve custom post type support at the same time. -- *Thanks to plugin user Romain for bringing my attention to this issue! :)*
* CODE: Minor code/documentation updates & improvements.
* UPDATE: Updated all existing translations plus the .pot file for all translators!
* UPDATE: Moved screenshots to 'assets' folder in WP.org SVN to reduce plugin package size.


### 1.6.0 - 2012-11-15

* *Maintenance release*
* NEW: Added support for "Portfolio" Custom Post Type in "Minimum 2.0" and "Executive 2.0" child themes by StudioPress.
* NEW: Added support for "Portfolio" Custom Post Type in child themes by ZigZagPress brand, "Megalithe", "Engrave" and "Vanilla".
* CODE: Minor code/documentation updates & improvements.
* UPDATE: Updated readme.txt file here.
* UPDATE: Updated all existing translations plus the .pot file for all translators!
* UPDATE: Initiated new three digits versioning, starting with this version.


### 1.5.0 - 2012-09-05

* *Maintenance release*
* NEW: Added plugin support for "Sugar Events Calendar" (premium, by Pippin Williamson).
* CODE: Minor code/documentation updates & improvements.
* UPDATE: Updated all existing translations plus the .pot file for all translators!


### 1.4.0 - 2012-06-16

* *Maintenance release*
* BUGFIX: Syntax errors - fixed option for general taxonomies layout option.
* CODE: Minor code/documentation updates & improvements.
* NEW: Added new Hindi translation by Love Chandel.
* UPDATE: Updated all existing translations plus the .pot file for all translators!


### 1.3.0 - 2012-05-01

* *New plugin features:*
* NEW: Performance optimization - restructuring and splitting of code into several files, loading only where and if needed. Plugin support stuff only appears now if one of the supported plugins is active!
* NEW: Added new option for 'Search not found' page - when there are NO search results (for example very handy to set a full-width layout for this case...).
* NEW: Added support for custom post type by child themes: "Clip Cart" and "Stage" both by Themedy Themes brand.
* NEW: Added support for "Features" taxonomy of the already supported AgentPress Listings plugin.
* NEW: Up to three meta boxes on options page - draggable and settings via "Screen options"
* NEW: Added "Save" button to each section in a meta box for easier handling - I guess this is much more user friendly :).
* UPDATE: Simplified Genesis detection on installation, making it much more future-proof and user-friendly.
* UPDATE: Improved the language files a lot, by optimizing and re-using a lot of strings and especially by removing almost all markup from the strings!
* UPDATE: Completely deprecated old contextual help system (from prior WordPress 3.3) - in favor of supporting the help tabs system, in a more extended form :)
* CODE: Beside new features, minor code/documentation tweaks and improvements.
* CODE: Successfully tested against Genesis 1.8+ plus WordPress 3.3 branch and new 3.4 branch. Also successfully tested in WP_DEBUG mode (no notices or warnings).
* UPDATE: Updated and optimized all screenshots, plus added some new ones.
* UPDATE: Updated, corrected and improved readme.txt file, especially the FAQ section.
* NEW: Added new French translation by [Grégoire Noyelle](https://www.gregoirenoyelle.com/)
* UPDATE: Updated German and Italian translations and also the .pot file for all translators!
* UPDATE: Extended GPL License info in readme.txt as well as main plugin file.
* NEW: Easy plugin translation platform with GlotPress tool: [Translate "Genesis Layout Extras"...](https://translate.wordpress.org/projects/wp-plugins/genesis-layout-extras)

NEW: Added support for more custom post type by plugins:

* --> "Genesis Media Project" by Nick Croft (free)
* --> "Easy Digital Downloads" by Pippins Williamson at PippinsPlugins.com (free)
* --> "WooCommerce" by WooThemes (free)
* --> "Jigoshop" by Jigowatt Ltd. (free)


### 1.2.0 - 2011-12-22

* Added new help tab system for WordPress 3.3 -- this time the plugin is also still compatible with old contextual help prior WP 3.3 but PLEASE NOT that I will remove this soon and then the plugin will require WordPress 3.3+ so please update now your WordPress installation!
* Bugfix: Wrapped conditional around `genesis_get_option` function to allow error-free theme changing (from Genesis to a non-Genesis theme) -- Please note: this also fixes the Multisite errors when plugin is network activated! -- Props to WP.org user "greghile" for reporting the Multisite issue!
* Minor code and code documentation improvements
* Wording: Changed strings "bbPress 2.0" to "bbPress 2.x" to reflect ongoing development & releases of that forum plugin
* Added new Italian translation by Marco Rosselli
* Updated German translation files
* Updated included .pot file (`genesis-layout-extras.pot`) for translators
* Added banner image on WordPress.org for better plugin branding :)


### 1.1.0 - 2011-10-06

* Improved homepage layout setting with adding the conditional statement `is_front_page()` so also static pages set as homepage (in WordPress: Settings > Reading) are now supported!
* Added new specific date layout options for Year, Month, Day - please note, that the general date setting will overwrite the other three settings (these have lower priority) - so, when in doubt, only use the general setting or leave on default
* Updated help texts where needed
* Added new user questions to FAQ section here
* Updated German translation files
* Updated included .pot file (`genesis-layout-extras.pot`) for translators
* Some more minor code tweaks and cosmetic changes :)


### 1.0.0 - 2011-10-01

* New and forked version of the plugin under new name and authorship by David Decker of deckerweb.de and GenesisThemes
* Updated, improved and documented code
* Added separate options page under the Genesis menu - no longer hooking in to regular Genesis settings - this is more user friendly and less confusing (See Genesis > Layout Extras)
* Added new layout options for attachment page, bbPress Forum and AgentPress Listing custom post type
* Added contextual help - tab on the top right corner of the options page
* Added settings link to the plugin page section
* Fully localized the plugin, working out of the box!
* Added German translations (English included by default)
* Improved and documented plugin code
* Tested & proved compatibility with WordPress 3.3-aortic-dissection :-)
