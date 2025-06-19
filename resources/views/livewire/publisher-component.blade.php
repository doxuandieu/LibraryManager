<div class="container-fluid">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Nhà xuất bản</h1>
                </div>
                <div class="col-sm-6">
                    <button type="button" class="btn btn-outline-primary float-right" wire:click.prevent="addPublisher">
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
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên nhà xuất bản</th>
                            <th scope="col">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($publishers as $publisher)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $publisher->name }}</td>
                                <td>
                                    <a class="mr-2" href=""
                                        wire:click.prevent="editPublisher({{ $publisher }})">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a class="text-danger" href=""
                                        wire:click.prevent="confirmPublisherRemoval({{ $publisher->id }})">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-flex justify-content-end">
                {{ $publishers->links() }}
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog">
            <form autocomplete="off"
                wire:submit.prevent="<?= $showEditModal ? 'updatePublisher' : 'createPublisher' ?>">
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
                            <label for="publisher_name">Tên nhà xuất bản</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="publisher_name" wire:model.defer="state.name"
                                placeholder="Nhập tên nhà xuất bản...">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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
                    <h5 class="modal-title" id="exampleModalLabel">Xóa nhà xuất bản?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắn muốn xóa tác giả này?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-danger" wire:click.prevent="removePublisher">Xóa</button>
                </div>
            </div>
        </div>
    </div>
</div>
