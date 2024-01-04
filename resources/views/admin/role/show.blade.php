@extends('admin.layouts.main')
@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            {{-- <h4 class="mb-3 mb-md-0">{{ $title }}</h4> --}}
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-xl-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                        <h6 class="card-title mb-0">{{ $title }}</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="dataTableExample">
                            <thead>
                                <tr>
                                    <th class="pt-0">#</th>
                                    <th class="pt-0">Menu</th>
                                    <th class="pt-0">Akses</th>
                                    <th class="pt-0">Dapat Melihat</th>
                                    <th class="pt-0">Dapat Mengedit</th>
                                    <th class="pt-0">Dapat Menghapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($menus as $menu)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $menu->menu }}</td>
                                        <td>
                                            <!-- Add hidden input fields to store menu_id and role_id -->
                                            <input type="hidden" name="menu_id[]" value="{{ $menu->id }}">
                                            <input type="hidden" name="role_id[]" value="{{ $role->id }}">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="can-view" name="can_view[]"
                                                value="{{ $menu->id }}" @checked($menu->menuRoles()->where(['role_id' => $role->id, 'can_view' => 1])->exists())
                                                data-name="can_view">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="can-edit" name="can_edit[]"
                                                value="{{ $menu->id }}" @checked($menu->menuRoles()->where(['role_id' => $role->id, 'can_edit' => 1])->exists())
                                                data-name="can_edit">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="can-delete" name="can_delete[]"
                                                value="{{ $menu->id }}" @checked($menu->menuRoles()->where(['role_id' => $role->id, 'can_delete' => 1])->exists())
                                                data-name="can_delete">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Add a form for submitting the checkboxes -->
                        {{-- <form action="{{ route('menu_roles.store') }}" method="post">
                            @csrf
                            <button type="submit">Save Permissions</button>
                        </form> --}}
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- row -->
@endsection
@section('script')
    <!-- JavaScript to handle checkbox changes -->
    <script>
        $(document).ready(function() {
            $('input[type="checkbox"]').on('change', function() {
                var checkbox = $(this);
                var isChecked = checkbox.prop('checked');
                var checkboxName = checkbox.data('name');
                var parentRow = checkbox.closest('tr');
                var menuId = checkbox.val();
                var roleId = parentRow.find('input[name="role_id[]"]').val();

                // Update the 'Akses' column based on checkbox state
                if (isChecked) {
                    parentRow.find('.pt-0').eq(2).text('Allowed');
                } else {
                    parentRow.find('.pt-0').eq(2).text('Denied');
                }

                // Send data to the server using Ajax
                var dataToSend = {
                    _token: '{{ csrf_token() }}',
                    menu_id: menuId,
                    role_id: roleId,
                };

                // Menggunakan if statement di luar objek untuk menentukan properti mana yang perlu disertakan
                if (checkboxName == 'can_view') {
                    dataToSend.can_view = isChecked ? 1 : 0;
                }
                if (checkboxName == 'can_edit') {
                    dataToSend.can_edit = isChecked ? 1 : 0;
                }
                if (checkboxName == 'can_delete') {
                    dataToSend.can_delete = isChecked ? 1 : 0;
                }
                console.log(dataToSend);
                $.ajax({
                    url: '{{ route('menu_roles.store') }}',
                    type: 'POST',
                    data: dataToSend, // Menggunakan variabel dataToSend
                    success: function(response) {
                        Swal.fire({
                            title: 'Berhasil',
                            text: response.success,
                            icon: 'success'
                        });
                    },
                    error: function(xhr) {
                        console.error('Error saving permissions.');
                    }
                });
            });
        });
    </script>
@endsection
