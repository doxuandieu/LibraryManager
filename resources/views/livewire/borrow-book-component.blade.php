<div class="container-fluid">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 d-flex justify-content-between">
                <div class="col-sm-4">
                    <div class="input-group input-group-sm w-50">
                        <input class="form-control" type="text" placeholder="Tìm kiếm (MSSV, Tên)" aria-label="Search"
                            wire:model.debounce.200ms="searchInput">
                    </div>
                </div>

                <div class="col-sm-4 text-center">
                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="notificationDropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bell pr-1"></i>
                            Thông báo trễ hạn
                            <span class="badge badge-danger">{{ $lateReturnsCount }}</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationDropdown">
                            @forelse ($lateReturns->take(4) as $lateReturn)
                                <div class="dropdown-item">
                                    <i class="fa fa-user-circle fa-2x text-primary"></i>
                                    <div class="user-info">
                                        <strong>Sinh viên:</strong> {{ $lateReturn->student_name }}
                                        <p style="margin: 0; font-size: 1rem;">
                                            <strong>MSSV:</strong> {{ $lateReturn->student_code }} - <strong>Hạn
                                                trả:</strong>
                                            {{ date_format(new DateTime($lateReturn->endDate), 'd/m/Y') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>
                            @empty
                                <span class="dropdown-item text-muted">Không có thông báo trễ hẹn</span>
                            @endforelse

                            @if ($lateReturnsCount > 4)
                                <button class="dropdown-item text-center" wire:click.prevent="showAllLateReturns">
                                    Xem thêm...
                                </button>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <button type="button" class="btn btn-outline-primary float-right" wire:click.prevent="borrowBook">
                        <i class="fa fa-plus-circle pr-1"></i>
                        Mượn sách
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
                            <th scope="col">MSSV</th>
                            <th scope="col">Sinh viên</th>
                            <th scope="col">Ngày lập phiếu</th>
                            <th scope="col">Ngày trả</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($borrowBooks as $borrowBook)
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{ $borrowBook->student_code }}</td>
                                <td>{{ $borrowBook->student_name }}</td>
                                <td>{{ date('d/m/Y', strtotime($borrowBook->beginDate)) }}</td>
                                <td>{{ date('d/m/Y', strtotime($borrowBook->endDate)) }}</td>
                                <td>{{ $borrowBook->status == 0 ? 'Chưa trả' : 'Đã trả' }}</td>
                                <td style="font-size: 1.2rem">
                                    @if ($borrowBook->status != 1)
                                        <a class="mr-2" href=""
                                            wire:click.prevent="confirmReturnedBook({{ $borrowBook->id }})">
                                            <i class="fa fa-check-square text-success"></i>
                                        </a>
                                    @endif
                                    <a class="mr-2" href=""
                                        wire:click.prevent="showBorrowBookDetail({{ $borrowBook->id }})">
                                        <i class="fa fa-circle-info"></i>
                                    </a>
                                    <a class="text-danger" href=""
                                        wire:click.prevent="confirmRemoveBorrowBook({{ $borrowBook->id }})">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-flex justify-content-end">
                {{ $borrowBooks->links() }}
            </div>
        </div>
    </section>

    <!-- Modal tạo phiếu mượn sách -->
    <div class="modal fade" id="form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog modal-xl">
            <form autocomplete="off"
                wire:submit.prevent="<?= $showEditModal ? 'updateBorrowBook' : 'createBorrowBook' ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><?= $showEditModal ? 'CHỈNH SỬA' : 'LẬP' ?>
                            PHIẾU MƯỢN SÁCH
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="book_id">Tên sách</label>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="book_id">Thêm sách trước khi nhập thông tin</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <select class="form-control"
                                            wire:model.defer="state.books.{{ $i }}.book_id">
                                            <option value="" selected hidden>Lựa chọn ...</option>
                                            @foreach ($books as $book)
                                                <option value="{{ $book->id }}">{{ $book->book_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('book_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-1 align-bottom">
                                        <button type="button" class="btn btn-sm btn-success" wire:click="addBookRow">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="row">
                                    @if (!empty($state['books']))
                                        <table class="table table-hover">
                                            <thead>
                                                <tr class="text-muted text-sm text-uppercase">
                                                    <th scope="col">#</th>
                                                    <th scope="col">Tên sách</th>
                                                    <th scope="col">Số lượng</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($state['books'] as $key => $item)
                                                    <tr>
                                                        <th scope="row">{{ $loop->iteration }}</th>
                                                        <td>{{ $item['book_name'] }}</td>
                                                        <td>
                                                            <span>1</span>
                                                        </td>
                                                        <td>
                                                            <a class="text-danger" href=""
                                                                wire:click.prevent="removeBookRow({{ $key }})">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Ngày mượn</label>
                                    <input type="date"
                                        class="form-control @error('beginDate') is-invalid @enderror" id="beginDate"
                                        wire:model="state.beginDate" onchange="updateEndDate()">
                                    @error('beginDate')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Ngày trả</label>
                                    <input type="date" class="form-control @error('endDate') is-invalid @enderror"
                                        id="endDate" wire:model="state.endDate" readonly>
                                    @error('endDate')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>MSSV</label>
                                    <input type="text"
                                        class="form-control @error('student_code') is-invalid @enderror"
                                        id="student_code" wire:model="state.student_code">
                                    @error('student_code')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Sinh viên</label>
                                    <input type="text"
                                        class="form-control @error('student_name') is-invalid @enderror"
                                        id="student_name" wire:model="state.student_name">
                                    @error('student_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Ghi chú</label>
                                    <input type="text" class="form-control @error('note') is-invalid @enderror"
                                        id="note" wire:model="state.note">
                                    @error('note')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
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

    <!-- Modal chi tiết phiếu mượn sách -->
    <div class="modal fade" id="detail-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        CHI TIẾT PHIẾU MƯỢN SÁCH
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover">
                        <thead>
                            <tr class="text-muted text-sm text-uppercase">
                                <th scope="col">#</th>
                                <th scope="col">Tên sách</th>
                                <th scope="col">Tác giả</th>
                                <th scope="col">Danh mục</th>
                                <th scope="col">Số lượng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($borrowBookDetails))
                                @foreach ($borrowBookDetails as $detail)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $detail->book->book_name }}</td>
                                        <td>
                                            @foreach ($detail->book->authors as $author)
                                                @if ($author->author->code)
                                                    {{ $author->author->code }} -
                                                @endif {{ $author->author->name }}
                                                @if (!$loop->last)
                                                    ,</br>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{ $detail->book->category->category_name }}</td>
                                        <td>{{ $detail->quantity }} </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal xác nhận trả sách -->
    <div class="modal fade" id="confirm-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xác nhận trả sách?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắn sách này đã được trả?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-success" wire:click.prevent="returnedBook">Xác
                        nhận</button>
                </div>
            </div>
        </div>
    </div>

    <!--Modal xác nhận xóa sách -->
    <div class="modal fade" id="delete-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xác nhận xóa?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắn muốn xóa phiếu mượn sách này không?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-danger" wire:click.prevent="removeBorrowBook">Xóa</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal danh sách tất cả sinh viên trả trễ hạn -->
    <div class="modal fade" id="all-late-returns-modal" tabindex="-1" aria-labelledby="allLateReturnsLabel"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="allLateReturnsLabel">Danh sách sinh viên trả trễ hạn</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Sinh viên</th>
                                <th>MSSV</th>
                                <th>Hạn trả</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lateReturns as $index => $lateReturn)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $lateReturn->student_name }}</td>
                                    <td>{{ $lateReturn->student_code }}</td>
                                    <td>{{ date_format(new DateTime($lateReturn->endDate), 'd/m/Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.addEventListener('show-all-late-returns-modal', event => {
            $('#all-late-returns-modal').modal('show');
        });
    });

    function updateEndDate() {
        const beginDateInput = document.getElementById('beginDate');
        const endDateInput = document.getElementById('endDate');

        if (beginDateInput.value) {
            const beginDate = new Date(beginDateInput.value);
            const endDate = new Date(beginDate);
            endDate.setDate(beginDate.getDate() + 14); // Add 14 days

            // Format the date to YYYY-MM-DD
            const formattedEndDate = endDate.toISOString().split('T')[0];
            endDateInput.value = formattedEndDate;

            // Trigger Livewire update
            @this.set('state.endDate', formattedEndDate);
        }
    }
</script>
