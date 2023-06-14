<input class="th-datatable-input form-control" data-column="{{ $col }}" placeholder="cari...">
@once
    @push('scripts')
        <script>
            $(document).ready(() => {
                $('.th-datatable-input').on('propertychange input', function() {
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
