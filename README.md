Parameter-Images
================
This is a working draft and I am grateful for any kind of participation.

It is about creating an feature loaded solution for handling responsive images on the serverside and the clientside.
Inspired by [Picturefill.js](https://github.com/scottjehl/picturefill) from Scott Jehl and [Adaptive-Images](https://github.com/MattWilcox/Adaptive-Images) from Matt Wilcox.

Features
--------

serverside cached breakpointbased image variants

* cropping 
  * advanced rules
  * focal-point
* sharpen
* image-filters
* device-pixel-ratio

clientside

* serving and updating just one image via javascript and `<noscript`> fallback
* changing image src via javascript if necessary based on breakpoints after window resized or device orientation changed

The serverside part provides cached variants of images called by an id parameter `<img src="image.jpg?id=banner&bp=480">` or an array of parameters `<img src="image.jpg?param=test%5Bres%5D%5B0%5D%5Bw%5D=300">`.
