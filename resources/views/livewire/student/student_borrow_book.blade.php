<x-app-layout>
    <section class="content">
        <div class="container-fluid">
            {{-- Sidebar --}}
            @include('layouts.student_sidebar')
            {{-- Search --}}
            <div class="content-header">
                <div class="container-fluid">
                    <form method="GET" action="{{ route('student.borrow') }}">
                        <div class="input-group input-group-sm" style="width: 30%;">
                            <input class="form-control search" type="text"
                                placeholder="Tìm kiếm (Tên, Mã, Loại sách, Danh mục)" aria-label="Search" name="search"
                                value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button class="btn btn-info" type="submit">Tìm kiếm</button>
                            </div>
                        </div>
                    </form>
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
                                        <td>{{ $book->book_type === 0 ? 'Sách đọc' : 'Sách mượn' }}</td>
                                        <td>{{ $book->category->category_name }}</td>
                                        <td>{{ $book->publish_year }}</td>
                                        <td>{{ $book->publisher->name }}</td>
                                        <td>{{ $book->stock }}</td>
                                        <td>{{ number_format($book->price) }}</td>
                                        <td class="text-center">
                                            @if ($book->book_type === 1)
                                                <a href="#" class="text-primary" data-toggle="modal"
                                                    data-target="#borrowModal" data-book-id="{{ $book->id }}"
                                                    style="font-size: 1.5em; color: #007bff;">
                                                    <i class="fas fa-book"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <!-- Borrow Modal -->
            <div class="modal fade" id="borrowModal" tabindex="-1" role="dialog" aria-labelledby="borrowModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="borrowModalLabel">Đặt mượn sách</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('student.borrow.submit') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" name="book_id" id="modalBookId">
                                <div class="form-group">
                                    <label for="student_name">Tên sinh viên:</label>
                                    <input type="text" class="form-control" id="student_name" name="student_name"
                                        value="{{ session('student.name') }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="student_code">Mã sinh viên:</label>
                                    <input type="text" class="form-control" id="student_code" name="student_code"
                                        value="{{ session('student.student_id') }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="beginDate">Ngày mượn:</label>
                                    <input type="date" class="form-control" id="beginDate" name="beginDate"
                                        value="{{ now()->toDateString() }}">
                                </div>
                                <div class="form-group">
                                    <label for="endDate">Ngày trả:</label>
                                    <input type="date" class="form-control" id="endDate" name="endDate" required>
                                </div>
                                <div class="form-group">
                                    <label for="quantity">Số lượng:</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity"
                                        value="1" min="1" readonly required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                <button type="submit" class="btn btn-primary">Hoàn thành</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <script>
                $('#borrowModal').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget);
                    var bookId = button.data('book-id');
                    var modal = $(this);
                    modal.find('#modalBookId').val(bookId);
                });

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
        </div>
    </section>
</x-app-layout>
