<select class="datatable-filter-select-ajax form-control" name="{{ $name }}"
    data-target="datatable-filter" style="width: 100%">
</select>
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
                $(".datatable-filter-select-ajax").select2({
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
                $('.datatable-filter-select-ajax').on('change', function() {
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
