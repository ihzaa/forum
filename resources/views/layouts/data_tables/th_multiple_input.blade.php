<input class="th-datatable-input-multiple form-control" data-column="{{ $col }}" placeholder="cari...">
@once
    @push('scripts')
        <script>
            $(document).ready(() => {
                $('.th-datatable-input-multiple').on('propertychange input', function() {
                    let tableId = "#{{ isset($table_id) ? $table_id : '' }}";
                    // let i = $(this).attr('data-column');
                    // let v = $(this).val();
                    if (tableId == '#') {
                        tableId = $(this).closest('table')[0]
                    }
                    // $(tableId).DataTable().columns(5).search(v).columns(6).search(v).draw();

                    var searchTerm = this.value.toLowerCase();
                    console.log(searchTerm);
                    $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                        console.log(~data[5].toLowerCase().indexOf(searchTerm));
                        //search only in column 1 and 2
                        if (~data[5].toLowerCase().indexOf(searchTerm)) return true;
                        if (~data[6].toLowerCase().indexOf(searchTerm)) return true;
                        return false;
                    })
                    $(tableId).DataTable().draw();
                    $.fn.dataTable.ext.search.pop();
                });

            })
        </script>
    @endpush
@endonce
