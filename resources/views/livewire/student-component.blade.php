<div class="container-fluid">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <div class="input-group input-group-sm" style="width: 50%;">
                        <input class="form-control search" type="text" placeholder="Tìm kiếm (Mã, Tên, Lớp)"
                            aria-label="Search" wire:model.debounce.200ms="searchInput">
                    </div>
                </div>
                <div class="col-sm-6">
                    <button type="button" class="btn btn-outline-primary float-right" wire:click="create">
                        <i class="fa fa-plus-circle pr-1"></i>
                        Thêm sinh viên
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-muted text-sm text-uppercase">
                            <th scope="col">#</th>
                            <th scope="col">Tên SV</th>
                            <th scope="col">Lớp</th>
                            <th scope="col">MSSV</th>
                            <th scope="col">Ngành</th>
                            <th scope="col">SĐT</th>
                            <th scope="col">Ngày sinh</th>
                            <th scope="col">Tài khoản</th>
                            <th scope="col">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->class }}</td>
                                <td>{{ $student->student_id }}</td>
                                <td>{{ $student->major }}</td>
                                <td>{{ $student->phone }}</td>
                                <td>{{ date('d/m/Y', strtotime($student->birthday)) }}</td>
                                <td>{{ $student->username }}</td>
                                <td>
                                    <a class="mr-2" href="" wire:click.prevent="edit({{ $student->id }})">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a class="text-danger" href=""
                                        wire:click.prevent="confirmStudentDeletion({{ $student->id }})">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-flex justify-content-end">
                {{ $students->links() }}
            </div>
        </div>
    </section>

    <!-- Modal -->
    @if ($isOpen)
        <div class="modal fade show" style="display: block;" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-lg">
                <form autocomplete="off" wire:submit.prevent="store">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                {{ $studentIdBeingUpdated ? 'Chỉnh sửa' : 'Thêm' }} sinh viên</h5>
                            <button type="button" class="close" wire:click="closeModal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Họ tên<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" wire:model.defer="name">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="class">Lớp<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('class') is-invalid @enderror"
                                            id="class" wire:model.defer="class">
                                        @error('class')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="student_id">MSSV<span class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @error('student_id') is-invalid @enderror"
                                            id="student_id" wire:model.defer="student_id">
                                        @error('student_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="major">Ngành<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('major') is-invalid @enderror"
                                            id="major" wire:model.defer="major">
                                        @error('major')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Số điện thoại<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                            id="phone" wire:model.defer="phone">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="birthday">Ngày sinh<span class="text-danger">*</span></label>
                                        <input type="date"
                                            class="form-control @error('birthday') is-invalid @enderror"
                                            id="birthday" wire:model.defer="birthday">
                                        @error('birthday')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Tài khoản<span class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @error('username') is-invalid @enderror"
                                            id="username" wire:model.defer="username">
                                        @error('username')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Mật
                                            khẩu{{ $studentIdBeingUpdated ? '' : '*' }}</label>
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            id="password" wire:model.defer="password">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" wire:click="closeModal">Hủy</button>
                            <button type="submit"
                                class="btn btn-primary">{{ $studentIdBeingUpdated ? 'Cập nhật' : 'Lưu' }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- Modal -->
    @if ($studentIdBeingDeleted)
        <div class="modal fade show" style="display: block;" tabindex="-1" aria-labelledby="deleteModalLabel"
            aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete Student?</h5>
                        <button type="button" class="close" wire:click="$set('studentIdBeingDeleted', null)"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Bạn có chắc muốn xóa sinh viên này?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            wire:click="$set('studentIdBeingDeleted', null)">Cancel</button>
                        <button type="button" class="btn btn-danger"
                            wire:click.prevent="deleteStudent">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
