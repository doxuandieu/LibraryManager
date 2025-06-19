<div class="container-fluid">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <div class="input-group input-group-sm" style="width: 50%;">
                        <input class="form-control" type="text" placeholder="Tìm kiếm (Mã, Tên)" aria-label="Search"
                            wire:model.debounce.200ms="searchInput">
                    </div>
                </div>
                <div class="col-sm-6">
                    <button type="button" class="btn btn-outline-primary float-right" wire:click.prevent="addAuthor">
                        <i class="fa fa-plus-circle pr-1"></i>
                        Thêm mới
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <table class="table table-hover p-0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Họ và Tên</th>
                            <th scope="col">Ngày sinh</th>
                            <th scope="col">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($authors as $author)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $author->name }}</td>
                                <td>{{ $author->birthday }}</td>
                                <td>
                                    <a class="mr-2" href=""
                                        wire:click.prevent="editAuthor({{ $author }})">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a class="text-danger" href=""
                                        wire:click.prevent="confirmAuthorRemoval({{ $author->id }})">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-flex justify-content-end">
                {{ $authors->links() }}
            </div>
        </div>
    </section>
    
    <!-- Modal -->
    <div class="modal fade" id="form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog">
            <form autocomplete="off" wire:submit.prevent="<?= $showEditModal ? 'updateAuthor' : 'createAuthor' ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><?= $showEditModal ? 'Chỉnh sửa' : 'Thêm' ?> tác
                            giả</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="author_name">Họ và Tên<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="author_name" wire:model.defer="state.name"
                                placeholder="Nhập họ và tên của tác giả...">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="author_birthday">Ngày sinh</label>
                            <input type="date" max="<?= date('Y-m-d') ?>" class="form-control" id="author_birthday"
                                wire:model.defer="state.birthday">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="submit"
                            class="btn btn-primary"><?= $showEditModal ? 'Cập nhật' : 'Lưu' ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="delete-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xóa tác giả?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắn muốn xóa tác giả này?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-danger" wire:click.prevent="removeAuthor">Xóa</button>
                </div>
            </div>
        </div>
    </div>
</div>
