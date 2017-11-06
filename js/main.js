// menu

;(function ($) {
  var toggle = $('.menu-toggle')
  var menu = $('.menu')

  toggle.on('click', function () {
    menu.slideToggle()
  })
})(jQuery)
