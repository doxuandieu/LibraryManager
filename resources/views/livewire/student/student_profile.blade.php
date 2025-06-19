<x-app-layout>
    <section class="content">
        <div class="container-fluid">
            {{-- Sidebar --}}
            @include('layouts.student_sidebar')
            {{-- Heading --}}
            <div class="content-header">
                <div class="container-fluid">
                    <h1>Quản lý thông tin cá nhân</h1>
                </div>
            </div>
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Họ và tên</th>
                                        <td>{{ $student->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Lớp</th>
                                        <td>{{ $student->class }}</td>
                                    </tr>
                                    <tr>
                                        <th>Mã sinh viên</th>
                                        <td>{{ $student->student_id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Chuyên ngành</th>
                                        <td>{{ $student->major }}</td>
                                    </tr>
                                    <tr>
                                        <th>Số điện thoại</th>
                                        <td>{{ $student->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th>Ngày sinh</th>
                                        <td>{{ date('d/m/Y', strtotime($student->birthday)) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tên đăng nhập</th>
                                        <td>{{ $student->username }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#editModal"
                                style="width: 30%; margin: 0 auto;">Chỉnh sửa</button>
                        </div>
                    </div>

                    <!-- Modal edit info -->
                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog"
                        aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Chỉnh sửa thông tin cá nhân</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('student.profile.update') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name">Họ và tên</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ $student->name }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="class">Lớp</label>
                                            <input type="text" class="form-control" id="class" name="class"
                                                value="{{ $student->class }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="student_id">Mã sinh viên</label>
                                            <input type="text" class="form-control" id="student_id" name="student_id"
                                                value="{{ $student->student_id }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="major">Chuyên ngành</label>
                                            <input type="text" class="form-control" id="major" name="major"
                                                value="{{ $student->major }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Số điện thoại</label>
                                            <input type="text" class="form-control" id="phone" name="phone"
                                                value="{{ $student->phone }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="birthday">Ngày sinh</label>
                                            <input type="date" class="form-control" id="birthday" name="birthday"
                                                value="{{ $student->birthday }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Tên đăng nhập</label>
                                            <input type="text" class="form-control" id="username" name="username"
                                                value="{{ $student->username }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Mật khẩu (để trống nếu không thay đổi)</label>
                                            <input type="password" class="form-control" id="password" name="password">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "timeOut": "3000",
                };
                toastr.success("{{ session('success') }}");
            @endif
        });
    </script>
</x-app-layout>
