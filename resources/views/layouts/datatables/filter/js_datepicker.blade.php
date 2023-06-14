var DateTime = luxon.DateTime;
let timer;
$('.datatable-filter-date-picker').on('change', function() {
if ($(this).val() == "") {
let tableId = "#{{ isset($table_id) ? $table_id : '' }}";
if (tableId == '#') {
tableId = "#main-table"
}
$(tableId).DataTable().draw();
}
if (DateTime.fromFormat($(this).val(), "dd-mm-yyyy").isValid) {
let tableId = "#{{ isset($table_id) ? $table_id : '' }}";
if (tableId == '#') {
tableId = "#main-table"
}
$(tableId).DataTable().draw();
}
});
