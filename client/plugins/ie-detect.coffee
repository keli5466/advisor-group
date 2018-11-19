# Add a Modernizr test to check for IE
window.Modernizr.addTest 'ie', /MSIE|Trident/.test window.navigator.userAgent