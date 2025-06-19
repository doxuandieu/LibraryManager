<div class="container-fluid">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <div class="input-group input-group-sm" style="width: 50%;">
                        <input class="form-control search" type="text"
                            placeholder="Tìm kiếm (Tên, Mã, Loại (sách đọc, sách mượn))" aria-label="Search"
                            wire:model.debounce.200ms="searchInput">
                    </div>
                </div>
                <div class="col-sm-6">
                    <button type="button" class="btn btn-outline-primary float-right" wire:click.prevent="addBook">
                        <i class="fa fa-plus-circle pr-1"></i>
                        Thêm sách
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
                            <th scope="col">Tên sách</th>
                            <th scope="col">Tác giả</th>
                            <th scope="col">Vị trí</th>
                            <th scope="col">Loại sách</th>
                            <th scope="col">Danh mục</th>
                            <th scope="col">Năm xuất bản</th>
                            <th scope="col">Nhà xuất bản</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Giá bìa</th>
                            <th scope="col">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $book)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $book->book_name }}</td>
                                <td>
                                    @foreach ($book->authors as $author)
                                        @if ($author->author->code)
                                            {{ $author->author->code }} -
                                        @endif {{ $author->author->name }}
                                        @if (!$loop->last)
                                            ,</br>
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{ $book->address }}</td>
                                <td><?= $book->book_type === 0 ? 'Sách đọc' : 'Sách mượn' ?></td>
                                <td>{{ $book->category->category_name }}</td>
                                <td>{{ $book->publish_year }}</td>
                                <td>{{ $book->publisher->name }}</td>
                                <td>{{ $book->stock }}</td>
                                <td>{{ number_format($book->price) }}</td>
                                <td>
                                    <a class="mr-2" href=""
                                        wire:click.prevent="editBook({{ $book }})">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <a class="text-danger" href=""
                                        wire:click.prevent="confirmBookRemoval({{ $book->id }})">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-flex justify-content-end">
                {{ $books->links() }}
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog modal-xl">
            <form autocomplete="off" wire:submit.prevent="<?= $showEditModal ? 'updateBook' : 'createBook' ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><?= $showEditModal ? 'Chỉnh sửa' : 'Thêm' ?>
                            sách
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="book_code">Mã sách<span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('book_code') is-invalid @enderror"
                                                id="book_code" wire:model.defer="state.book_code">
                                            @error('book_code')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="book_name">Tên sách<span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('book_name') is-invalid @enderror"
                                                id="book_name" wire:model.defer="state.book_name"
                                                placeholder="Nhập tên sách...">
                                            @error('book_name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="publish_year">Năm xuất bản<span
                                                    class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('publish_year') is-invalid @enderror"
                                                id="publish_year" wire:model.defer="state.publish_year"
                                                placeholder="Nhập năm xuất bản...">
                                            @error('publish_year')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="total_pages">Số trang<span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('total_pages') is-invalid @enderror"
                                                id="tottal_pages" wire:model.defer="state.total_pages"
                                                placeholder="Nhập số trang...">
                                            @error('total_pages')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="address">Vị trí<span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('address') is-invalid @enderror"
                                                id="address" wire:model.defer="state.address"
                                                placeholder="Nhập vị trí sách...">
                                            @error('address')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="price">Giá bìa<span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('price') is-invalid @enderror"
                                                id="price" wire:model.defer="state.price"
                                                placeholder="Nhập giá...">
                                            @error('price')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="book_type">Loại sách<span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <div class="form-check form-check">
                                                <input class="form-check-input" type="radio" name="book_type"
                                                    value="0" wire:model.defer="state.book_type" checked>
                                                <label class="form-check-label" for="inlineRadio1">Sách
                                                    đọc</label>
                                            </div>
                                            <div class="form-check form-check">
                                                <input class="form-check-input" type="radio" name="book_type"
                                                    value="1" wire:model.defer="state.book_type">
                                                <label class="form-check-label" for="inlineRadio2">Sách
                                                    mượn</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Danh mục<span class="text-danger">*</span></label>
                                    <select class="form-control" wire:model.defer="state.category_id">
                                        <option value="" selected>Lựa chọn ...</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tác giả<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Tìm kiếm tác giả..."
                                        wire:model="authorSearch">
                                    <div class="mt-2">
                                        <select id="author-1" class="form-control"
                                            wire:model.defer="state.authors.0">
                                            <option value="" hidden>Lựa chọn ...</option>
                                            @foreach ($authors as $author)
                                                <option value="{{ $author->id }}">{{ $author->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <select id="author-2" class="form-control mt-2"
                                        wire:model.defer="state.authors.1"
                                        @if (!isset($state['authors'][0])) style="display: none;" @endif>
                                        <option value="" hidden>Lựa chọn ...</option>
                                        @foreach ($authors as $author)
                                            <option value="{{ $author->id }}">{{ $author->name }}</option>
                                        @endforeach
                                    </select>
                                    <select id="author-3" class="form-control mt-2"
                                        wire:model.defer="state.authors.2"
                                        @if (!isset($state['authors'][1])) style="display: none;" @endif>
                                        <option value="" hidden>Lựa chọn ...</option>
                                        @foreach ($authors as $author)
                                            <option value="{{ $author->id }}">{{ $author->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Nhà xuất bản<span class="text-danger">*</span></label>
                                    <select class="form-control" wire:model.defer="state.publisher_id">
                                        <option value="" selected>Lựa chọn ...</option>
                                        @foreach ($publishers as $publisher)
                                            <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
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

    <div class="modal fade" id="delete-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xóa sách?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắn muốn xóa sách này?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-danger" wire:click.prevent="removeBook">Xóa</button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        $('#author-1').change(function() {
            $('#author-2').css('display', 'block');
        });
        $('#author-2').change(function() {
            $('#author-3').css('display', 'block');
        });

        document.addEventListener('DOMContentLoaded', function() {
            const authorInputs = [$('#author-1'), $('#author-2'), $('#author-3')];

            authorInputs.forEach((input, index) => {
                input.change(function() {
                    if (index < authorInputs.length - 1) {
                        authorInputs[index + 1].css('display', 'block');
                    }
                });
            });
        });
    </script>
</div>
