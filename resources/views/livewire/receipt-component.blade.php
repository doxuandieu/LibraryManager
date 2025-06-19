<div class="container-fluid">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Phiếu nhập kho</h1>
                </div>
                <div class="col-sm-6">
                    <button type="button" class="btn btn-outline-primary float-right" wire:click.prevent="addReceipt">
                        <i class="fa fa-plus-circle pr-1"></i>
                        Thêm phiếu nhập
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
                            <th scope="col">Thời gian</th>
                            <th scope="col">Người nhập</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($receipts as $receipt)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ date('d/m/Y H:i:s', strtotime($receipt->date)) }}</td>

                                <td>{{ $receipt->receiver }}</td>
                                <td>
                                    <?php
                                    $sum = 0;
                                    $details = $receipt->receiptDetails;
                                    foreach ($details as $detail) {
                                        $sum += $detail->quantity;
                                    }
                                    echo $sum;
                                    ?>
                                </td>
                                <td>
                                    <a class="mr-2" href=""
                                        wire:click.prevent="showReceiptDetail({{ $receipt->id }})">
                                        <i class="fa fa-circle-info"></i>
                                    </a>
                                    <a class="text-danger" href=""
                                        wire:click.prevent="confirmReceiptRemoval({{ $receipt->id }})">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-flex justify-content-end">
                {{ $receipts->links() }}
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog modal-xl">
            <form autocomplete="off" wire:submit.prevent="<?= $showEditModal ? 'updateReceipt' : 'createReceipt' ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><?= $showEditModal ? 'Chỉnh sửa' : 'Thêm' ?>
                            phiếu nhập
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
                                    <div class="col-md-2">
                                        <label for="book_id">Số lượng</label>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="book_id">Đơn giá</label>
                                    </div>
                                    <div class="col-md-1">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <select class="form-control"
                                            wire:model.defer="state.books.{{ $i }}.book_id">
                                            <option value="" selected hidden>Lựa chọn ...</option>
                                            @foreach ($books as $book)
                                                <option value="{{ $book->id }}">{{ $book->book_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('book_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="number"
                                                class="form-control @error('quantity') is-invalid @enderror"
                                                id="quantity"
                                                wire:model.defer="state.books.{{ $i }}.quantity">
                                            @error('quantity')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text"
                                                class="form-control @error('importPrice') is-invalid @enderror"
                                                id="importPrice"
                                                wire:model.defer="state.books.{{ $i }}.importPrice">
                                            @error('importPrice')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
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
                                                    <th scope="col">Đơn giá</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($state['books'] as $key => $item)
                                                    <tr>
                                                        <th scope="row">{{ $loop->iteration }}</th>
                                                        <td>{{ $item['book_name'] }}</td>
                                                        <td>{{ $item['quantity'] }}</td>
                                                        <td>{{ $item['importPrice'] }}</td>
                                                        <td>
                                                            <a class="text-danger" href=""
                                                                wire:click.prevent="removeRow({{ $key }})">
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
                                    <label>Người nhận</label>
                                    <input type="text" class="form-control @error('receiver') is-invalid @enderror"
                                        id="receiver" wire:model="state.receiver">
                                    @error('receiver')
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

    <div class="modal fade" id="delete-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampzaleModalLabel">Xóa sách?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắn muốn xóa phiếu này?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-danger" wire:click.prevent="removeReceipt">Xóa</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="detail-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        CHI TIẾT PHIẾU NHẬP KHO
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
                                <th scope="col">Số lượng</th>
                                <th scope="col">Giá nhập</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($receiptDetail))
                                @foreach ($receiptDetail->receiptDetails as $detail)
                                    <tr>
                                        <td scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $detail->book->book_name }}</td>
                                        <td>{{ $detail->quantity }}</td>
                                        <td>{{ $detail->importPrice }}</td>
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
</div>
