window.$ = window.jQuery = jQuery
window.toastr = require('./../admin/vendors/js/extensions/toastr.min')
/**
 * Admin temp
 */
window.ApexCharts = require('./../admin/vendors/js/charts/apexcharts')

require('./../admin/js/core/app-menu')
require('./../admin/js/core/app')
//require('./../admin/js/scripts/pages/dashboard-ecommerce')
require('./../admin/vendors/js/tables/datatable/jquery.dataTables.min')
window.Swal = require('./../admin/vendors/js/extensions/sweetalert2.all.min')
require('./AdminApp')
require('./ResponsiveElement')

ResponsiveElement.init()
