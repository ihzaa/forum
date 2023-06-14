@push('styles')
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.1.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('AdminLTE-3.1.0/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('AdminLTE-3.1.0') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script>
        const datatable_ajax_data = (d) => {
            $(`[data-target*='datatable-filter']`).each((i, element) => {
                d[$(element).attr('name')] = $(element).val();
            });
        }

        const init_serverside_datatable = (id, url, columns, options = {}) => {
            $(id).DataTable({
                bSortCellsTop: true,
                processing: true,
                serverSide: true,
                searching: false,
                ajax: {
                    "url": url,
                    "data": datatable_ajax_data
                },
                columns: [{
                    "data": null,
                    "sortable": false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                }, ...columns],
                ...options
            });
        }

        const init_datatable = (el, url, columns, options = {}) => {
            $(el).DataTable({
                bSortCellsTop: true,
                searching: true,
                ...options
            });
        }
    </script>
@endpush
