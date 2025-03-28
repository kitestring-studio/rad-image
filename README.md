# Image Viewer WordPress Plugin
![WordPress Version](https://img.shields.io/badge/WordPress-6.5.2-blue)
![PHP Version](https://img.shields.io/badge/PHP-7.4-red)
![License](https://img.shields.io/badge/License-GPLv2-green)

## Table of Contents
1. [Description](#description)
3. [Installation](#installation)
2. [Custom Post Type](#custom-post-type)
4. [Usage](#usage)
5. [Building Assets](#building-assets)
6. [Changelog](#changelog)
7. [License](#license)

## Description

The plugin implements three types of image viewers for working with sets of images:
- Gallery
- Depth scroll
- Image rotation

## Installation

1. Download the latest release from the GitHub repository.
2. Upload the `image-viewer.zip` file to your WordPress site.
3. Activate the plugin through the WordPress Dashboard.

## Custom Post Type

This plugin introduces a custom post type named "Image Viewer". Each Image Viewer post generates its own shortcode, which can be found on the individual edit page for that post. These shortcodes are used to embed the Image Viewer in various parts of your WordPress site.

## Usage

Here's how to embed an image viewer into your post or page:

```php
// Using a shortcode
[rad-image slug="image-viewer-slug"]
// or
[rad-image id="image-viewer-id"]
```

## Building Assets

After making plugin code changes, you need to build the assets by running the following command:

```bash
npm run build
```
Crete a zip file
```bash
npm run zip
```

## Changelog
### 2.1.2
- disable image_viewer post type visibility for anonymous visitors
- `npm run build` now creates a zip filename with the version number
- node package updates

### 2.1.1
- fix a broken hardcoded image path

### 2.1.0
- switches simplelight to fancybox
- removes asset bundle in favor of fancybox via cdn

### 2.0.4
- allows full HTML in captions & tooltips
- fixes single viewer help section
- fixes npm zip script to continue if the zip file doesn't exist

### 2.0.3
- fix forced width for rotation and depth types

### 2.0.2
- fix gap around viewer on larger screens
- fix missing tooltip on single viewer

### 2.0.1
- adds packaging script

### 2.0.0
- Improves HTML support for captions
- Adds single-image viewer support
- Supports multiple viewers per page
- Choose start frame for depth viewer
- Embed viewer by slug or to id, for easier recognition

### 1.1.0
- Adds support for multiple galleries on a single page
- Slightly reduces max size of images in lightbox

### 1.0.0
- Bundles simplelightbox JS with webpack

### 0.1.7
- Dynamically sizes the image viewer to the aspect ratio of the image

## License

This project is licensed under [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html).
