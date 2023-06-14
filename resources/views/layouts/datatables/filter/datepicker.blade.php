<div class="input-group">
    <input name="{{ $name }}" class="form-control datatable-filter-date-picker" data-target="datatable-filter"
        placeholder="{{ isset($placeholder) ? $placeholder : 'cari...' }}" autocomplete="off"
        data-date-format="{{ isset($date_format) ? $date_format : 'dd-mm-yyyy' }}">
</div>
@once
    @push('styles')
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
            integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
    @endpush
@endonce
@once
    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
            integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/luxon/3.2.1/luxon.min.js"
            integrity="sha512-pyR2hpC7bLig9Ub4eUIOC/BAO4anpdt7jhpF4dfrPv+qIg+KWztdVjFPCRCsRaWVfUylUCvrrxqMFNrJBdQIjQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            $(document).ready(() => {
                @include('layouts.datatables.filter.js_datepicker')

                $('.datatable-filter-date-picker').datepicker({
                    autoclose: true,
                    todayHighlight: true
                });
            })
        </script>
    @endpush
@endonce
