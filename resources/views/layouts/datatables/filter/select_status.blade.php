<select class="datatable-filter-select form-control" name="deleted_at[is]" data-target="datatable-filter" style="width: 100%">
    <option value="NULL" selected>Aktif</option>
    <option value="NOT NULL">Dihapus</option>
</select>
@once
    @push('scripts')
        <script>
            $(document).ready(() => {
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
