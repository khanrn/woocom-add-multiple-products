=== WooCom Add Multiple Products ===
Contributors: rnaby
Tags: woocommerce, add-to-cart, ajax, cart, shopping-cart
Requires at least: 3.5.1
Tested up to: 4.8
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A plugin for adding bulk product by SKU or product name to cart when you're in cart.

== Description ==

= Description =

This plugin adds the functionality to add bulk products from one input. It adds an input field at the end of cart page. From this input field you can add multiple products to cart by Ajax request. Enjoy.

And you also can use shortcode to use the plugin other places. Just place the shortcode where you wanna put the input form and it's done !!!

= Features =

*   Add multiple products from one input box.
*   Select product by SKU or name.
*   Product category restriction option.
*   Multiple product categories select option.
*   User auhtentication option.
*   User role based authentication.
*   Shortcode for showing the form elsewhere.
*   Widget for placing the form in any kind of sidebar.
*   Fully translation ready.
*   Ajaxified product adding.
*   Very easy to use.

= Shortcode =

<pre><code>[wamp_product_input]</code></pre>

== Installation ==

1. Upload `woocom-add-multiple-product` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= Is it use ajax for adding product to cart? =

Yes. It use ajax for adding product to cart. But for showing the update it reloads the page.

= Does it has any widget to place the form in sidebar?

Yes. It has a widget.

= Can I use this outside cart? =

Yes. Use the shortcode. Just place the shortcode where you wanna put the input form and it's done.

= Can I add multiple products from the input? =

Yes. You can.

= Any user authentication system for the form ? =

Yes. Visit the plugins settings page.

== Screenshots ==

1. Products input.
2. Settings page. You can change or set the necessary settings form this page.
3. Widget screenshot.

== Changelog ==

= 3.0.0 =
* Heavily refactored
* PHP Codesniffer checked. Almost all the WordPress VIP rules followed.
* Full new structure.
* Modern PHP principle followed.

= 2.0.0 =
* Some bug fixed.
* Full plugin code refactored.
* Widget added.
* Settings page added.
* User authentication added.
* User role based authentication added.
* Support for product category filter added.

= 1.0.9 =
* Some bug fixed.

= 1.0.0 =
* Initial version.