@extends('admin.layouts.admin')

@section('title','Edit Contract')
@section('heading','Edit Contract')

@section('breadcrumb')
    <li class="breadcrumb-item active">Edit Contract</li>
@endsection

@section('content')
    <section class="horizontal-wizard">
        <div class="bs-stepper horizontal-wizard-example">
            <div class="bs-stepper-header">
                <div class="step" data-target="#customer-info">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-box">1</span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Customer Info</span>
                            <span class="bs-stepper-subtitle">Add Customer Info</span>
                        </span>
                    </button>
                </div>
                <div class="line">
                    <i data-feather="chevron-right" class="font-medium-2"></i>
                </div>
                <div class="step" data-target="#services-offered">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-box">2</span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Species Selection</span>
                            <span class="bs-stepper-subtitle">Species &amp; Services</span>
                        </span>
                    </button>
                </div>
                <div class="line">
                    <i data-feather="chevron-right" class="font-medium-2"></i>
                </div>
                <div class="step" data-target="#confirm">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-box">3</span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Confirmation</span>
                            <span class="bs-stepper-subtitle">Confirm Selection</span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="bs-stepper-content">
                @include('admin.contracts.edit-parts.customer-info')
                @include('admin.contracts.edit-parts.services')
                <div id="confirm" class="content">
                    <div id="confirm-wrapper">
                        
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <button class="btn btn-primary btn-prev">
                            <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                        </button>
                        <button class="btn btn-success btn-submit">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@include('components.alerts')
@include('components.form-wizard')
@include('components.ajax')
@include('components.input-mask')
@include('components.date-picker')

@push('head')
    <style>
        .collapse-title-specie {
            width: 100%;
        }

        .collapse-checkbox-label {
            width: calc(100% - 20px);
            float: right;
        }
        .account-number-wrap{
          display: none;
        }
    </style>
@endpush

@push('footer')
    <script>
      let horizontalWizard = document.querySelector('.horizontal-wizard-example')
      // Horizontal Wizard
      // --------------------------------------------------------------------
      //if (typeof horizontalWizard !== undefined && horizontalWizard !== null) {
      let numberedStepper = new Stepper(horizontalWizard, { linear: false })
      //numberedStepper.to(3)

      let $form = $(horizontalWizard).find('form')
      $form.each(function () {
        let $this = $(this)
        $this.validate({
          rules: {
            'contract[]': {
              required: true
            },
            billing_business: {
              required: true
            },
            address: {
              required: true
            },
            billing_address: {
              required: true
            },
            phone1: {
              required: true
            },
            phone2: {
              required: true
            },
            billing_phone1: {
              required: true
            },
            billing_phone2: {
              required: true
            },
            email: {
              required: true
            },
            business_email: {
              required: true
            },
            date: {
              required: true
            },
            attention_line: {
              required: true
            },
            proposed: {
              required: true
            },
            billing_email: {
              required: true
            },
          }// rules
        })
      })

      $(horizontalWizard)
        .find('.btn-next')
        .each(function () {
          let $el = $(this)
          $el.on('click', function (e) {
            let $el = $(this)
            /* --------------------------------------------------------------
             *  Validate Form
             * --------------------------------------------------------------
             */
            let form = $el.parent().siblings('form')
            let isValid = form.valid()
            if (isValid) {
              /* --------------------------------------------------------------
               *  Submit Form
               * --------------------------------------------------------------
               */
              AdminApp.blockElement(form)
              $.ajax({
                url: form.attr('action'),
                type: 'post',
                dataType: 'json',
                data: form.serialize(),
                success: function () {
                  if ($el.attr('data-action') === 'confirm') {
                    /* --------------------------------------------------------------
                     *  Show Confirm
                     * --------------------------------------------------------------
                     */
                    $.ajax({
                      url: "{{route('admin.contracts.confirm')}}",
                      type: 'post',
                      dataType: 'json',
                      success: function (res) {
                        $('#confirm-wrapper').html(res.view)
                      },
                      error: function (err) {
                      }
                    })
                  }

                  numberedStepper.next()
                },
                error: function (err) {AdminApp.ajaxError(err)},
                complete: function () {AdminApp.unblockElement(form)}
              })
            } else {
              e.preventDefault()
            }
          })
        })

      $(horizontalWizard)
        .find('.btn-prev')
        .on('click', function () {
          numberedStepper.previous()
        })

      $(horizontalWizard)
        .find('.btn-submit')
        .on('click', function (e) {
          e.preventDefault()
          AdminApp.blockElement('#confirm')
          $.ajax({
            url: "{{route('admin.contracts.sign')}}",
            type: 'post',
            dataType: 'json',
            success: function (res) {
              window.location.href = res.url
            },
            error: function (err) {
              AdminApp.ajaxError(err)
            },
            complete: function () {
              AdminApp.unblockElement('#confirm')
            }
          })
        })// .btn-submit

      $(document).ready(function () {
        $('#phone_home').inputmask({ mask: '1-999-999-9999', greedy: false })
        $('#phone_cell').inputmask({ mask: '1-999-999-9999', greedy: false })
        $('#billing_zip').inputmask({ mask: '9{5}', greedy: false, 'placeholder': '' })
        $('#service_zip').inputmask({ mask: '9{5}', greedy: false, 'placeholder': '' })

        /* --------------------------------------------------------------
         *  Service State Select2
         * --------------------------------------------------------------
         */
        $('#service_state').select2({
          ajax: {
            url: "{{route('select2.states')}}",
            dataType: 'json',
            type: 'patch',
          },
          placeholder: 'Select State',
          allowClear: true,
        });
        $('#billing_state').select2({
          ajax: {
            url: "{{route('select2.states')}}",
            dataType: 'json',
            type: 'patch',
          },
          placeholder: 'Select State',
          allowClear: true,
        })

        AdminApp.$body.on('change', '#chkSameAddress', function () {
          let billingAddress = $('#billing_address')
          let $businessCity = $('#billing_city')
          let $businessState = $('#billing_state')
          let $businessZip = $('#billing_zip')
          let status = $(this).prop('checked')
          if (status) {
            billingAddress.val($('#service_address').val())
            $businessCity.val($('#service_city').val())
            $businessZip.val($('#service_zip').val())

            let $serviceState = $('#service_state').select2('data')[0]
            if ($serviceState !== undefined) {
              let opt = new Option($serviceState.text, $serviceState.id, true, true)
              $businessState.append(opt).trigger('change')
            }
            return
          }
          billingAddress.val('')
          $businessCity.val('')
          $businessState.val('')
          $businessZip.val('')
          $businessState.empty().trigger('change')
        })// #copy-info

        /* --------------------------------------------------------------
         *  Checkbox Control for Species
         * --------------------------------------------------------------
         */
        $('[name="species[]"]').on('change', function (e) {
          let $el = $(this)
          let target = $($el.attr('data-target'))

          if ($el.prop('checked')) {
            target.collapse('show')
          } else {
            target.collapse('hide')
          }
          target.find(':checkbox').each(function(){
                jQuery(this).attr('checked', $el.prop('checked'));
            });  
        })
        /* --------------------------------------------------------------
         *  Collapse Event
         * --------------------------------------------------------------
         */
        $('.collapse').on('shown.bs.collapse', function () {
          $('[data-auto-expand]').trigger('input')
        })
         /* --------------------------------------------------------------
         *  Checkbox for New Customer
         * --------------------------------------------------------------
         */
         AdminApp.$body.on('change', '#chkNewCustomer', function () {
          let $el = $(this)
          if($el.prop('checked')){
            $('#account-number-wrap').show();
          }
          else{
            $('#account-number-wrap').hide();
          }
         })
        /* --------------------------------------------------------------
         *  Manage Total
         * --------------------------------------------------------------
         */
         AdminApp.$body.on('keypress', 'input[type=number]', function () {

         })
         AdminApp.$body.on('keyup', 'input[type=number]', function () {
          let $el = $(this)
          let name = $($el).attr('name')
          var parts = name.split(/[[\]]{1,2}/);
          getTotals(parts);
         })
         AdminApp.$body.on('change', 'input[type=checkbox]', function () {
          let $el = $(this)
          let name = $($el).attr('name')
          var parts = name.split(/[[\]]{1,2}/);
          getTotals(parts);
         })
         AdminApp.$body.on('change', '.specie-checkbox', function () {
          let $el = $(this)
          
          if($el.prop('checked') == false){
            
            let specie = $el.val();
            console.log(specie);
            if(specie != ''){
              //$('#'+specie+'-fyp').val(0); 
              $('#'+specie+'-content :input[type=number]').val('');
              calculateServiceTotal(specie)
            }
          }
         
         })

      })
      //}


      function getTotals(parts){
        if(parts.length >= 3){
            let enable_checkbox = parts[0]+'-'+parts[1]+'-enabled'
            //check if service is enabled
            if($('#'+enable_checkbox).prop('checked')){
              let price = getFieldValueByID(parts[0]+'-'+parts[1]+'-price')
              let tax = getFieldValueByID(parts[0]+'-'+parts[1]+'-tax')
              let discount = getFieldValueByID(parts[0]+'-'+parts[1]+'-discount')

              if(discount > (price+tax)){
                $('#'+parts[0]+'-'+parts[1]+'-discount').val((price+tax))
                $('#'+parts[0]+'-'+parts[1]+'-total').val(0)
              }
              else{
              //set this specie total
                let total = (price + tax) - discount; 
                $('#'+parts[0]+'-'+parts[1]+'-total').val(total)

              }
              //set total for this service 

              calculateServiceTotal(parts[0])
              // let service_total = total + getFieldValueByID(parts[0]+'-fyp')
              // $('#'+parts[0]+'-fyp').val(service_total)
            }
            else{
              removeServiceTotal(parts)
            }
          }
      }

      function getFieldValueByID(id){
        return parseFloat($('#'+id).val() != '' ? $('#'+id).val() : 0)
      }

      function setFieldValueByID(id , value = ''){
        $('#'+id).val(value);
      }

      function calculateServiceTotal(specie){
        //this specie total 
        let total = 0;
          $("." + specie + '-classtotal' ).each(function(){
            if($(this).val() != ''){
              total += parseFloat($(this).val());
            } 
          })
          $('#'+specie+'-fyp').val(total);

          //contarct total 
          let contract_total = 0;
          $(".specie-total" ).each(function(){
            contract_total += parseFloat($(this).val());
          })
          $('#total-all-programs').val(parseFloat(contract_total));

      }

      function removeServiceTotal(parts){
        let service_total = $('#'+parts[0]+'-'+parts[1]+'-total').val();
        //set specie total 
        if(service_total > 0){
          let specie_total = $('#'+parts[0]+'-fyp').val();
          specie_total = parseFloat(specie_total - service_total);
          $('#'+parts[0]+'-fyp').val(specie_total);
        }
        //set all values to zero 
        setFieldValueByID(parts[0]+'-'+parts[1]+'-price')
        setFieldValueByID(parts[0]+'-'+parts[1]+'-tax')
        setFieldValueByID(parts[0]+'-'+parts[1]+'-discount')
        setFieldValueByID(parts[0]+'-'+parts[1]+'-total')

        calculateServiceTotal(parts[0])

      }

      function removeSpecieTotal(){

      }
    </script>
@endpush
