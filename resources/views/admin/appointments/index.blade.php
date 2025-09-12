@extends('layouts.admin')

@section('title', 'Quản lý Lịch hẹn')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Danh sách Lịch hẹn</h1>
    <a href="{{ route('admin.appointments.create') }}" class="btn btn-primary">Thêm mới</a>
</div>


@include('admin.appointments._table')
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Đảm bảo CSRF token được gửi cùng yêu cầu AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Bắt sự kiện click cho các liên kết phân trang
    $(document).on('click', '#appointments-pagination-links .page-link', function(e) {
        e.preventDefault();
        let url = $(this).attr('href');

        if (!url) return;

        $('#appointments-table-body').html('<tr><td colspan="6" class="text-center">Đang tải...</td></tr>');

        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                try {
                    let $response = $(response);
                    let newTableBody = $response.find('#appointments-table-body').html();
                    let newPagination = $response.find('#appointments-pagination-links').html();

                    if (newTableBody && newPagination) {
                        $('#appointments-table-body').html(newTableBody);
                        $('#appointments-pagination-links').html(newPagination);
                        history.pushState(null, '', url);
                    } else {
                        alert('Dữ liệu không hợp lệ từ server.');
                    }
                } catch (error) {
                    alert('Đã xảy ra lỗi khi xử lý dữ liệu.');
                }
            },
            error: function(xhr) {
                alert('Đã xảy ra lỗi khi tải dữ liệu: ' + xhr.statusText);
            }
        });
    });

    // Xử lý nút back/forward của trình duyệt
    window.onpopstate = function() {
        location.reload();
    };
});
</script>
@endsection
