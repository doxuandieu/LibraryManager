<div class="container-fluid">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <div class="input-group input-group-sm" style="width: 50%;">
                        <input class="form-control" type="text" placeholder="Tìm kiếm (Học kỳ, MSSV, Mã lớp)"
                            aria-label="Search" wire:model.debounce.200ms="searchInput">
                    </div>
                </div>
                <div class="col-sm-6">
                    <form class="import-file float-right" wire:submit.prevent="import">
                        <input type="file" wire:model="excelFile">
                        <button class="btn btn-outline-primary" type="submit">Thêm file</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <table class="table table-hover" style="font-size: 80%;">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Năm học</th>
                            <th scope="col">Học kỳ</th>
                            <th scope="col">MSSV</th>
                            <th scope="col">Mã lớp</th>
                            <th scope="col">Họ và Tên</th>
                            <th scope="col">Giới tính</th>
                            <th scope="col">Năm sinh</th>
                            <th scope="col">Ngành</th>
                            <th scope="col">Tên đề tài TV</th>
                            <th scope="col">Tên đề tài TA</th>
                            <th scope="col">GVHD</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dissertations as $dissertation)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $dissertation->year }}</td>
                                <td>{{ $dissertation->semester }}</td>
                                <td>{{ $dissertation->student_id }}</td>
                                <td>{{ $dissertation->class_id }}</td>
                                <td>{{ $dissertation->student_name }}</td>
                                <td>{{ $dissertation->gender }}</td>
                                <td>{{ $dissertation->yearOfBirth }}</td>
                                <td>{{ $dissertation->major }}</td>
                                <td>{{ $dissertation->titleInVietnamese }}</td>
                                <td>{{ $dissertation->titleInEnglish }}</td>
                                <td>{{ $dissertation->lecturer_name }}</td>
                                <td>{{ $dissertation->status == true ? 'Đã nộp' : 'Chưa nộp' }}</td>
                                <td class="text-end">
                                    @if ($dissertation->status == false)
                                        <a class="mr-2" href=""
                                            wire:click.prevent="confirmSubmitted({{ $dissertation->id }})">
                                            <i class="fa fa-check-square"></i>
                                        </a>
                                    @endif
                                    <a class="text-danger" href=""
                                        wire:click.prevent="confirmDissertationRemoval({{ $dissertation->id }})">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-flex justify-content-end">
                {{ $dissertations->links() }}
            </div>
        </div>
    </section>

    <div class="modal fade" id="delete-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xóa luận văn?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắn muốn xóa luận văn này?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-danger" wire:click.prevent="removeDissertation">Xóa</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirm-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xác nhận nộp luận văn?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Cập nhật trạng thái?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-success" wire:click.prevent="submittedDissertation">Xác
                        nhận</button>
                </div>
            </div>
        </div>
    </div>
</div>
