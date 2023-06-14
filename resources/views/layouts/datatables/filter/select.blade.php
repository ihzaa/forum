<select class="datatable-filter-select form-control" name="{{ $name }}"
    data-target="datatable-filter" style="width: 100%">
    <option value="" selected>-- Semua --</option>
    @foreach ($options as $k => $v)
        <option value="{{ $k }}">{{ $v }}
        </option>
    @endforeach
</select>
@once
    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endpush
@endonce
@once
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @endpush
@endonce

@once
    @push('scripts')
        <script>
            $(document).ready(() => {
                $('.datatable-filter-select').select2();
                $('.datatable-filter-select').on('change', function() {
                    let tableId = "#{{ isset($table_id) ? $table_id : '' }}";
                    if (tableId == '#') {
                        tableId = "#main-table"
                    }
                    $(tableId).DataTable().draw();
                });
            })
        </script>
    @endpush
@endonce
