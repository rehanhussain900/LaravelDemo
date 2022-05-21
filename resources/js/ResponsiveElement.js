window.ResponsiveElement = {

  screenHeight: 0,

  screenWidth: 0,

  _callback: [],

  init: function () {
    this._resizeEvent()
  },

  setFunction: function (func) {
    this._callback.push(func)
  },

  _resizeEvent: function () {
    $(window).on('resize', function () {
      ResponsiveElement._calculateScreenSize()
      clearTimeout(window.responsiveElemenetTimer)
      ResponsiveElement._callback.forEach(function (func) {
        if (typeof func === 'function') {
          func(ResponsiveElement)
        }
      })
    })
  },

  _calculateScreenSize: function () {
    this.screenWidth = window.outerWidth
    this.screenHeight = window.outerHeight
  }
}
