@push('head')
    <link rel="stylesheet" href="{{asset('plugins/flatpickr/flatpickr.min.css')}}">
@endpush

@push('footer')
    <script src="{{asset('plugins/flatpickr/flatpickr.min.js')}}"></script>
    <script>
      $(document).ready(function () {
        $('.date-picker').flatpickr({
          altInput: true,
          altFormat: 'F j, Y',
          dateFormat: 'Y-m-d',
          onReady: function (selectedDates, dateStr, instance) {
            if (instance.isMobile) {
              $(instance.mobileInput).attr('step', null)
            }
          },
        })

      })
    </script>
@endpush
