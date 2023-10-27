=== Image Viewer ===
Contributors: Gabe462
Tags: gallery, lightbox, image
Requires at least: 6.1
Tested up to: 6.3.2
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

== Description ==

Implements three types of image viewers for working with sets of images
- gallery
- depth scroll
- image rotation

== Changelog ==
2.0.0
* improves HTML support for captions
* adds single-image viewer support
* supports multiple viewers per page
* choose start frame for depth viewer
* embed viewer by slug instead of/in addition to id, for easier recognition
* make viewer title an anchor link
* click “view” to view viewer in post edit list
* add a column for selected viewer type in post editor list
* many design tweaks & fixes

1.1.0
* adds support for multiple galleries on a single page
* slightly reduces max size of images in lightbox
* updates simple-lightbox library to 2.14.1
* many styling tweaks

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
