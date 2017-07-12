=== HeadJS Plus ===
Contributors: ramoonus
Donate link: http://www.ramoonus.nl/donate/
Tags: javascript, js, css, headjs, head.js, asynch, adopt-me
Requires at least: 3.0
Tested up to: 4.3
Stable tag: 0.96.1

A plugin to load your Javascript files via Head JS.  

== Description ==
This plugin reformats your page to utilize <a href="http://headjs.com" title="HeadJS">Head JS</a> in your WordPress site.
6
Based on the initial plugin by <a href="http://ilinea.com/">Durin</a>

It strips out all your old javascript declarations and puts them into head.js calls so that they are loaded in parallel (see the Head JS website for more details).

For example, this:

<pre><code>
<script type='text/javascript' src='http://yoururl.com/wp-includes/js/prototype.js?ver=1.6.1'></script> 
<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js?ver=3.0.4'></script> 
<script type='text/javascript' src='http://yoururl.com/wp-includes/js/scriptaculous/wp-scriptaculous.js?ver=1.8.3'></script> 
<script type='text/javascript' src='http://yoururl.com/wp-includes/js/scriptaculous/builder.js?ver=1.8.3'></script> 
<script type='text/javascript' src='http://yoururl.com/wp-includes/js/scriptaculous/effects.js?ver=1.8.3'></script> 
<script type='text/javascript' src='http://yoururl.com/wp-includes/js/scriptaculous/dragdrop.js?ver=1.8.3'></script> 
<script type='text/javascript' src='http://yoururl.com/wp-includes/js/scriptaculous/slider.js?ver=1.8.3'></script> 
<script type='text/javascript' src='http://yoururl.com/wp-includes/js/scriptaculous/controls.js?ver=1.8.3'></script> 
</code></pre>

Becomes:

<pre><code>
<script type="text/javascript" src="http://yoururl.com/wp-content/plugins/headjs-loader/head.min.js"></script> 
<script> 
head.js("http://yoururl.com/wp-includes/js/prototype.js?ver=1.6.1")
    .js("http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js?ver=3.0.4")
    .js("http://yoururl.com/wp-includes/js/scriptaculous/wp-scriptaculous.js?ver=1.8.3")
    .js("http://yoururl.com/wp-includes/js/scriptaculous/builder.js?ver=1.8.3")
    .js("http://yoururl.com/wp-includes/js/scriptaculous/effects.js?ver=1.8.3")
    .js("http://yoururl.com/wp-includes/js/scriptaculous/dragdrop.js?ver=1.8.3")
    .js("http://yoururl.com/wp-includes/js/scriptaculous/slider.js?ver=1.8.3")
    .js("http://yoururl.com/wp-includes/js/scriptaculous/controls.js?ver=1.8.3");
</script> 
</code></pre>


== Installation ==
1. Upload `headjs-plus` directory to `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Changelog ==
= 0.96.1 =
* Fixed a major bug. 

= 0.96 =
* Updated the Javascript library to version 0.96

= 0.1.1 =
* Initial release.
