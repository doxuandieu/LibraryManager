<x-app-layout>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h2>Tổng quan</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-book"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Số sách</span>
                            <span class="info-box-number">
                                {{ $countBook }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-bookmark"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Luận văn</span>
                            <span class="info-box-number">
                                {{ $countSubmittedDissertation }}/{{ $countDissertation }}
                                <small>(đã nộp/tổng số)</small>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="clearfix hidden-md-up"></div>

            </div>
        </div>
    </section>
</x-app-layout>
