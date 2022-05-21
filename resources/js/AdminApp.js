window.AdminApp = {

  $body: $('body'),

  initEvents: function () {
    /* --------------------------------------------------------------
     *  DataTable Column Visibility Toggle
     * --------------------------------------------------------------
     */
    this.$body.on('')

    /* --------------------------------------------------------------
     *  Reset DataTable
     * --------------------------------------------------------------
     */
    this.$body.on('click', '.buttons-reset', function () {
      AdminApp._getDataTableId($(this)).state.clear()
      location.reload()
    })

    /* --------------------------------------------------------------
     *  Prevent ColVis DropDown Auto Hide
     * --------------------------------------------------------------
     */
    this.$body.on('click', '.btnColToggle .dropdown-item', function (e) {
      e.stopPropagation()
    })

    this.$body.on('click', '[data-dt]', function () {
      let i = $(this).attr('data-dt')
      let v = $(this).prop('checked')
      AdminApp._getDataTableId($(this)).column(i).visible(v)
    })

    this.$body.on('blur', 'input,select,textarea', function () {
      let $el = $(this)
      if ($el.val() === '') {
        return
      }
      $el.removeClass('is-invalid')
      $el.closest('div.form-group').find('.invalid-feedback').remove()
    })// blur

    /* --------------------------------------------------------------
     *  Auto Expand Textarea
     * --------------------------------------------------------------
     */
    let $textAreas = $('[data-auto-expand]')
    $textAreas.each(function () {
      let scrollHeight = this.scrollHeight;
      let innerHeight = this.scrollHeight;
      if(scrollHeight<innerHeight){
        scrollHeight = innerHeight
      }
      this.setAttribute('style', 'height:' + scrollHeight + 'px;overflow-y:hidden;')
    }).on('input', function () {
      this.style.height = 'auto'
      this.style.height = (this.scrollHeight) + 'px'
    })
  },

  toggleSection: function (open, close) {
    $('#' + close).hide()
    $('#' + open).show()
  },

  /* --------------------------------------------------------------
   *  Alerts
   * --------------------------------------------------------------
   */
  success: function (message) {
    toastr.options.progressBar = true
    toastr.options.closeButton = true
    toastr.options.positionClass = 'toast-top-center'
    toastr.success(message, 'Success')
  },

  error: function (message) {
    toastr.options.progressBar = true
    toastr.options.closeButton = true
    toastr.options.positionClass = 'toast-top-center'
    toastr.error(message, 'Error')
  },

  ajaxError: function (res) {
    if (res.responseJSON !== '' && res.responseJSON !== null && res.responseJSON !== undefined) {
      let msg = res.responseJSON.message
      let errorBag = $('<ul></ul>')
      $.each(res.responseJSON.errors, function (v, k) {
        console.log(k)
        errorBag.append('<li>' + k.toString() + '</li>')
        /* --------------------------------------------------------------
         *  Add Validation errors
         * --------------------------------------------------------------
         */
        let field = $('[name="' + v + '"]')
        field.addClass('is-invalid')
        let $wrapper = field.closest('div.form-group')
        //let inputType = field.attr('type');
        //if (inputType !== 'checkbox' || inputType !== 'radio') {
        let $help = $wrapper.find('.invalid-feedback')
        if (!$help.length) {
          $wrapper.append('<div class="invalid-feedback"></div>')
          $help = $wrapper.find('.invalid-feedback')
        }
        $help.html(k.toString())
        //}
      })
      AdminApp.error(msg + errorBag.html())
      return true
    }
    AdminApp.error(res.statusText)
  },

  warning: function (message) {
    toastr.options.progressBar = true
    toastr.options.closeButton = true
    toastr.options.positionClass = 'toast-top-center'
    toastr.warning(message, 'Warning')
  },

  info: function (message) {
    toastr.options.progressBar = true
    toastr.options.closeButton = true
    toastr.options.positionClass = 'toast-top-center'
    toastr.info(message, 'Info')
  },

  blockCard: function ($el) {
    $el.closest('.card').block({
      message: feather.icons['refresh-cw'].toSvg({ class: 'font-large-3 spinner text-primary' }),
      css: {
        backgroundColor: 'transparent',
        border: 'none'
      },
      overlayCSS: {
        backgroundColor: '#fff',
      },
    })
  },
  unblockCard: function ($el) {
    $el.closest('.card').unblock()
  },

  blockElement: function ($el) {
    $($el).block({
      message: feather.icons['refresh-cw'].toSvg({ class: 'font-large-3 spinner text-primary' }),
      css: {
        backgroundColor: 'transparent',
        border: 'none'
      },
      overlayCSS: {
        backgroundColor: '#fff',
      },
    })
  },
  unblockElement: function ($el) {
    $($el).unblock()
  },

  /**
   *
   * @param table
   */
  adjustDataTables: function (table) {
    let $tag
    /* --------------------------------------------------------------
     *  Arrange the Buttons and UI
     * --------------------------------------------------------------
     */
    let $filter_wrapper = $('.dataTables_filter')
    /* --------------------------------------------------------------
     *  Arrange Search
     * --------------------------------------------------------------
     */
    let $actionButtons = $('.dt-action-buttons')
    if (!$filter_wrapper.find('.btnColToggle').length) {
      $filter_wrapper.append('<div class="btn-group btnColToggle"><button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="colVisBtn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Column Visibility </button></div>')
    }
    if (!tableDecorated) {
      let $btnDt = $actionButtons.find('.dt-buttons')
      $btnDt.addClass('btn-group-sm')
      let $exportBtn = '<button class="btn btn-outline-secondary" type="button" disabled="">Export</button>'
      $btnDt.prepend($exportBtn)
      $tag = $('<div class="btn-group btn-group-sm"></div>')
      $tag.append($('.buttons-reload'))
      $tag.append($('.buttons-reset'))
      $filter_wrapper.prepend($tag)
    }

    let options = $('<ul class="dropdown-menu col-vis-menu" aria-labelledby="colVisBtn"></ul>')
    table.columns().every(function () {
      let index = this.index()
      let title = $(this.header()).text()
      let visible = this.visible() ? 'checked' : ''
      options.append('<li><label class="dropdown-item"><input type="checkbox" data-dt="' + index + '" ' + visible + '> <span>' + title + '</span></label></li>')
    })
    $('.btnColToggle .dropdown-menu').remove()
    $('.btnColToggle').append(options)

    tableDecorated = true
  },

  /**
   *
   * @param $el
   * @returns DataTable.Api
   * @private
   */
  _getDataTableId: function ($el) {
    let id = $el.closest('.dataTables_wrapper').attr('id')
    id = id.replace('_wrapper', '')
    return window.LaravelDataTables[id]
  },// _getDataTableId

}// AdminApp
