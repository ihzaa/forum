@extends('layouts.master')

@section('page_title', 'Perizinan')

@section('breadcrumb')
    @php
        $breadcrumbs = ['Pengaturan User', ['Perizinan', route('admin.user_config.permission.index')], 'Tambah'];
    @endphp
    @include('layouts.parts.breadcrumb', ['breadcrumbs' => $breadcrumbs])
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.1.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush

@section('content')
    <form action="{{ route('admin.user_config.permission.createPost') }}" method="POST">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Tambah Perizinan
                        <div class="card-tools">

                        </div>
                        <!-- /.card-tools -->
                    </div>
                    @csrf
                    <div class="card-body">
                        <div class="form-group mb-2">
                            <label for="name">Nama Peran<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" placeholder="Nama Peran"
                                name="name" value="{{ old('name') }}">
                        </div>
                        <hr>
                        <h3>Perizinan Spesial</h3>
                        <table class="table table-bordered can-hover">
                            <tbody>

                                <tr class="bg-gray-50">
                                    <th colspan="3" class="text-right">
                                        Select/Unselect Section
                                    </th>
                                    <th class="text-center">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input toggle-section"
                                                data-section="specials" id="select-all-spesial-permission" />
                                            <label class="custom-control-label" for="select-all-spesial-permission">
                                            </label>
                                        </div>
                                    </th>
                                </tr>

                                <tr class="bg-gray-50">
                                    <th>#</th>
                                    <th>Permission</th>
                                    <th>Deskripsi</th>
                                    <th class="text-center">Enable</th>
                                </tr>

                                <?php $index = 0; ?>
                                @foreach (\App\Utils\PermissionHelper::SPECIAL_PERMISSIONS as $perm => $description)
                                    <tr data-section="specials">
                                        <td>{{ ++$index }}</td>
                                        <td>{{ ucwords(str_replace('_', ' ', $perm)) }}</td>
                                        <td>{{ $description }}</td>
                                        <td class="text-center">
                                            <div class="custom-control custom-switch">
                                                <input name="permissions[]" type="checkbox" value="{{ $perm }}"
                                                    class="custom-control-input toggle-row"
                                                    id="select-{{ $perm }}" />
                                                <label class="custom-control-label"
                                                    for="select-{{ $perm }}"></label>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

                @foreach (App\Utils\PermissionHelper::PERMISSIONS as $section => $perms)
                    <div class="card my-3">
                        <div class="card-header">
                            {{ str_replace('_', ' ', $section) }}
                        </div>
                        <div class="card-body">

                            <table class="js-table-sections table table-hover table-vcenter">
                                <thead>
                                    <tr>
                                        <th style="width: 30px;"></th>
                                        <th>Nama</th>
                                        <th>Deskripsi</th>
                                        <th style="width: 15%">Jumlah Aksi</th>
                                        <th style="width: 15%">Jumlah Aksi Aktif</th>
                                        <th>Pilih Semua</th>
                                    </tr>
                                </thead>
                                @foreach ($perms as $item)
                                    @php
                                        $actions = gettype($item) !== 'string' ? $item['actions'] ?? App\Utils\PermissionHelper::ACTIONS : App\Utils\PermissionHelper::ACTIONS;
                                        $name = gettype($item) !== 'string' ? $item['name'] : $item;
                                        $aliases = gettype($item) !== 'string' ? $item['alias'] ?? $item['name'] : $item;
                                        $description = gettype($item) !== 'string' ? $item['description'] ?? '-' : '-';
                                    @endphp
                                    <tbody class="js-table-sections-header">
                                        <tr>
                                            <td class="text-center">
                                                <i class="fa fa-angle-right text-muted"></i>
                                            </td>
                                            <td>{{ str_replace('_', ' ', $aliases) }}</td>
                                            <td>{{ $description }}</td>
                                            <td class="text-center"> {{ count($actions) }}</td>
                                            <td class="text-center" id="action-active-counter-{{ $name }}">0</td>
                                            <td class="text-center">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input toggle-row"
                                                        id="select-all-{{ $name }}-{{ $loop->iteration }}"
                                                        data-permission-name="{{ $name }}"
                                                        data-actions-count="{{ count($actions) }}" />
                                                    <label class="custom-control-label"
                                                        for="select-all-{{ $name }}-{{ $loop->iteration }}"></label>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tbody class="font-size-sm">
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Aksi</th>
                                        </tr>
                                        @foreach ($actions as $action)
                                            <tr>
                                                <th>{{ $loop->iteration }}</th>
                                                <th>
                                                    <div class="custom-control custom-switch">
                                                        <input name="permissions[]"
                                                            value="{{ $action }} {{ $name }}"
                                                            type="checkbox" class="custom-control-input action-switch"
                                                            data-permission-name="{{ $name }}"
                                                            id="select-{{ $name }}-{{ $loop->iteration }}" />
                                                        <label class="custom-control-label"
                                                            for="select-{{ $name }}-{{ $loop->iteration }}">{{ $action }}</label>
                                                    </div>
                                                </th>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-md-12 text-center">
                <button class="btn btn-primary" type="submit"><i class="fa fa-check" aria-hidden="true"></i>
                    Tambah</button>
            </div>
        </div>
    </form>

@endsection

@push('scripts')
    <script src="{{ asset('AdminLTE-3.1.0/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('AdminLTE-3.1.0') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
@endpush

@push('scripts')
    <script>
        jQuery(function() {
            One.helpers(['table-tools-sections']);
        });
    </script>

    <script>
        $(function() {
            function getActionActiveCounterElement(el) {
                let permission_name = $(el).data('permission-name');
                let $action_active_counter = $("#action-active-counter-" + permission_name);
                return $action_active_counter;
            }
            $(".action-switch").change(function() {
                let $action_active_counter = getActionActiveCounterElement(this);
                let current_count = parseInt($action_active_counter.html());
                if (this.checked) {
                    current_count++;
                } else {
                    current_count--;
                }
                $action_active_counter.html(current_count)
            })
            $(".full").change(function() {
                var $this = $(this);
                var tr = $this.closest('tr');
                tr.find('input[type="checkbox"].full').prop('checked', true);
                tr.find('input[type="checkbox"].advanced').prop('checked', true);
                tr.find('input[type="checkbox"].basic').prop('checked', true);
            });

            $(".advanced").change(function() {
                var $this = $(this);
                var tr = $this.closest('tr');
                tr.find('input[type="checkbox"].full').prop('checked', false);
                tr.find('input[type="checkbox"].advanced').prop('checked', true);
                tr.find('input[type="checkbox"].basic').prop('checked', true);
            });

            $(".basic").change(function() {
                var $this = $(this);
                var tr = $this.closest('tr');
                var next = tr.find('input[type="checkbox"].advanced');

                if (next.prop('checked')) {
                    tr.find('input[type="checkbox"].full').prop('checked', false);
                    tr.find('input[type="checkbox"].advanced').prop('checked', false);
                    tr.find('input[type="checkbox"].basic').prop('checked', true);
                }
            });

            $(".toggle-section").change(function() {
                var $this = $(this);
                var section = $this.attr('data-section');
                var tr = $('tr[data-section="' + section + '"]');
                if (this.checked) {
                    tr.find('input[type="checkbox"]').prop('checked', true);
                } else {
                    tr.find('input[type="checkbox"]').prop('checked', false);
                }
            });

            $(".toggle-column").change(function() {
                var $this = $(this);
                var section = $this.attr('data-section');
                var column = $this.attr('data-column');
                var tr = $('tr[data-section="' + section + '"]');
                if (this.checked) {
                    tr.find('input[type="checkbox"].' + column).prop('checked', true);
                } else {
                    tr.find('input[type="checkbox"].' + column).prop('checked', false);
                }
            });

            $(".toggle-row").change(function() {
                let $action_active_counter = getActionActiveCounterElement(this);
                var $this = $(this);
                var $nextTbody = $this.closest('tbody').next();
                if (this.checked) {
                    $action_active_counter.html($(this).data('actions-count'));
                    $nextTbody.find('input[type="checkbox"]').prop('checked', true);
                } else {
                    $action_active_counter.html(0);
                    $nextTbody.find('input[type="checkbox"]').prop('checked', false);
                }
            });

            $(".toggle-all").change(function() {
                var body = $('body');
                if (this.checked) {
                    body.find('input[type="checkbox"]').prop('checked', true);
                } else {
                    body.find('input[type="checkbox"]').prop('checked', false);
                }
            });
        });
    </script>
@endpush
