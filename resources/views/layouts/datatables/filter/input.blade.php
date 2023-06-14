<input class="datatable-filter form-control" name="{{ $name }}"
    placeholder="{{ isset($placeholder) ? $placeholder : 'cari...' }}" data-target="datatable-filter">
@once
    @push('scripts')
        <script>
            $(document).ready(() => {
                let timer;
                $('.datatable-filter').on('propertychange input', function() {
                    clearTimeout(timer);
                    timer = setTimeout(() => {
                        let tableId = "#{{ isset($table_id) ? $table_id : '' }}";
                        if (tableId == '#') {
                            tableId = "#main-table"
                        }
                        $(tableId).DataTable().draw();
                    }, 1000);
                });
            })
        </script>
    @endpush
@endonce
