=== Image Viewer ===
Contributors: Gabe462
Donate link: https://example.com/
Tags: comments, spam
Requires at least: 6.1
Tested up to: 6.1.1
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Here is a short description of the plugin.  This should be no more than 150 characters.  No markup here.

== Description ==

Implements three types of image viewers for working with sets of images
- gallery
- depth scroll
- image rotation

== Changelog ==
1.0.0
* bundles simplelightbox JS with webpack

0.1.7
* dynamically sizes the image viewer to the aspect ratio of the image
* implements help tooltips for the image viewer
* makes help/tooltip text editable w/ each gallery

0.1.6
* changes all instances of dicom to rad_image
* implement simple-lightbox npm package

0.1.4
* renames plugin to Image viewer, slug to rad-viewer
* adds support for ACF json files in /data folder
* stores CPT backup in /data folder
* dynamically assigns RAD_VERSION to enqueued asset versions
