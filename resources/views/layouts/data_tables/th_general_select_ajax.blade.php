<select class="th-datatable-select-ajax form-control"
    @isset($id) id="{{ $id }}" @endisset data-url="{{ $url }}"
    data-column="{{ $col }}">
</select>
@push('scripts')
    <script>
        $(document).ready(() => {
            $(".th-datatable-select-ajax").select2({
                theme: 'bootstrap4',
                placeholder: 'Cari',
                closeOnSelect: true,
                ajax: {
                    url: "{{ $url }}",
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    data: function(params) {
                        return {
                            keyword: params.term,
                        }
                    },
                    processResults: function(response) {
                        return {
                            results: response
                        };
                    },
                    delay: 250
                }
            });
        })
    </script>
@endpush
@once
    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endpush
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @endpush
    @push('scripts')
        <script>
            $(document).ready(() => {
                $('.th-datatable-select-ajax').on('change', function() {
                    let tableId = "#{{ isset($table_id) ? $table_id : '' }}";
                    let i = $(this).attr('data-column');
                    let v = $(this).val();
                    if (tableId == '#') {
                        tableId = $(this).closest('table')[0]
                    }
                    $(tableId).DataTable().columns(i).search(v).draw();
                });
            })
        </script>
    @endpush
@endonce
