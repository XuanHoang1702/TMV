/**
 * Admin Panel JavaScript
 * Handles admin panel interactions and AJAX operations
 */

$(document).ready(function() {
    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();

    // Initialize popovers
    $('[data-toggle="popover"]').popover();

    // Handle delete confirmations
    $('.delete-btn').on('click', function(e) {
        e.preventDefault();
        const url = $(this).attr('href');
        const message = $(this).data('message') || 'Bạn có chắc chắn muốn xóa mục này?';

        if (confirm(message)) {
            window.location.href = url;
        }
    });

    // Handle bulk actions
    $('#bulk-action-btn').on('click', function() {
        const action = $('#bulk-action').val();
        const selectedItems = $('input[name="selected[]"]:checked');

        if (selectedItems.length === 0) {
            alert('Vui lòng chọn ít nhất một mục');
            return;
        }

        if (action === '') {
            alert('Vui lòng chọn hành động');
            return;
        }

        if (confirm(`Bạn có chắc chắn muốn ${action} ${selectedItems.length} mục đã chọn?`)) {
            $('#bulk-action-form').submit();
        }
    });

    // Handle status toggle
    $('.status-toggle').on('change', function() {
        const id = $(this).data('id');
        const type = $(this).data('type');
        const status = $(this).is(':checked') ? 1 : 0;
        const url = $(this).data('url');

        $.ajax({
            url: url,
            method: 'POST',
            data: {
                id: id,
                status: status,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    toastr.success(response.message || 'Cập nhật trạng thái thành công');
                } else {
                    toastr.error(response.message || 'Có lỗi xảy ra');
                }
            },
            error: function(xhr) {
                toastr.error('Có lỗi xảy ra khi cập nhật trạng thái');
                // Revert the toggle
                $(this).prop('checked', !$(this).is(':checked'));
            }
        });
    });

    // Handle image preview
    $('.image-input').on('change', function() {
        const file = this.files[0];
        const preview = $(this).data('preview');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $(preview).attr('src', e.target.result);
            };
            reader.readAsDataURL(file);
        }
    });

    // Handle form submissions with AJAX
    $('.ajax-form').on('submit', function(e) {
        e.preventDefault();
        const form = $(this);
        const url = form.attr('action');
        const method = form.attr('method') || 'POST';
        const data = new FormData(form[0]);

        // Show loading
        const submitBtn = form.find('button[type="submit"]');
        const originalText = submitBtn.text();
        submitBtn.prop('disabled', true).text('Đang xử lý...');

        $.ajax({
            url: url,
            method: method,
            data: data,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    toastr.success(response.message || 'Thao tác thành công');
                    if (response.redirect) {
                        window.location.href = response.redirect;
                    } else {
                        location.reload();
                    }
                } else {
                    toastr.error(response.message || 'Có lỗi xảy ra');
                }
            },
            error: function(xhr) {
                const response = xhr.responseJSON;
                if (response && response.errors) {
                    let errorMessage = '';
                    for (let field in response.errors) {
                        errorMessage += response.errors[field][0] + '\n';
                    }
                    toastr.error(errorMessage);
                } else {
                    toastr.error('Có lỗi xảy ra');
                }
            },
            complete: function() {
                submitBtn.prop('disabled', false).text(originalText);
            }
        });
    });

    // Handle category tree interactions
    $('.category-toggle').on('click', function() {
        const categoryId = $(this).data('category-id');
        const children = $(`.category-children[data-parent-id="${categoryId}"]`);

        if (children.is(':visible')) {
            children.slideUp();
            $(this).removeClass('fa-minus').addClass('fa-plus');
        } else {
            children.slideDown();
            $(this).removeClass('fa-plus').addClass('fa-minus');
        }
    });

    // Handle search functionality
    $('.search-input').on('keyup', function() {
        const searchTerm = $(this).val().toLowerCase();
        const tableRows = $(this).closest('.card').find('tbody tr');

        tableRows.each(function() {
            const rowText = $(this).text().toLowerCase();
            if (rowText.indexOf(searchTerm) > -1) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

    // Handle pagination
    $('.pagination a').on('click', function(e) {
        e.preventDefault();
        const url = $(this).attr('href');

        // Show loading
        $('.table-responsive').addClass('loading');

        $.ajax({
            url: url,
            method: 'GET',
            success: function(response) {
                $('.table-responsive').html($(response).find('.table-responsive').html());
                $('.pagination').html($(response).find('.pagination').html());
                window.history.pushState(null, null, url);
            },
            error: function() {
                toastr.error('Có lỗi xảy ra khi tải dữ liệu');
            },
            complete: function() {
                $('.table-responsive').removeClass('loading');
            }
        });
    });

    // Handle modal forms
    $('.modal-form').on('submit', function(e) {
        e.preventDefault();
        const form = $(this);
        const modal = form.closest('.modal');
        const url = form.attr('action');
        const method = form.attr('method') || 'POST';
        const data = new FormData(form[0]);

        $.ajax({
            url: url,
            method: method,
            data: data,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    toastr.success(response.message || 'Thao tác thành công');
                    modal.modal('hide');
                    if (response.redirect) {
                        window.location.href = response.redirect;
                    } else {
                        location.reload();
                    }
                } else {
                    toastr.error(response.message || 'Có lỗi xảy ra');
                }
            },
            error: function(xhr) {
                const response = xhr.responseJSON;
                if (response && response.errors) {
                    let errorMessage = '';
                    for (let field in response.errors) {
                        errorMessage += response.errors[field][0] + '\n';
                    }
                    toastr.error(errorMessage);
                } else {
                    toastr.error('Có lỗi xảy ra');
                }
            }
        });
    });

    // Handle date picker initialization (if using date picker library)
    if ($.fn.datepicker) {
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            language: 'vi',
            autoclose: true,
            todayHighlight: true
        });
    }

    // Handle select2 initialization (if using select2)
    if ($.fn.select2) {
        $('.select2').select2({
            placeholder: 'Chọn một tùy chọn',
            allowClear: true
        });
    }

    // Handle data tables (if using DataTables)
    if ($.fn.DataTable) {
        $('.data-table').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Vietnamese.json'
            },
            responsive: true,
            pageLength: 25,
            order: [[0, 'desc']]
        });
    }

    // Handle file upload progress
    $('.file-upload').on('change', function() {
        const file = this.files[0];
        if (file) {
            const fileSize = (file.size / 1024 / 1024).toFixed(2);
            const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

            if (!allowedTypes.includes(file.type)) {
                toastr.error('Chỉ chấp nhận file ảnh (JPEG, PNG, GIF, WebP)');
                $(this).val('');
                return;
            }

            if (fileSize > 5) {
                toastr.error('Kích thước file không được vượt quá 5MB');
                $(this).val('');
                return;
            }

            // Show file info
            const fileInfo = $(this).data('file-info');
            if (fileInfo) {
                $(fileInfo).text(`File: ${file.name} (${fileSize}MB)`);
            }
        }
    });

    // Handle sidebar toggle
    $('.sidebar-toggle').on('click', function() {
        $('body').toggleClass('sidebar-collapse');
    });

    // Handle notification dismiss
    $('.notification-dismiss').on('click', function() {
        $(this).closest('.notification').fadeOut();
    });

    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);

    // Handle print functionality
    $('.print-btn').on('click', function() {
        window.print();
    });

    // Handle export functionality
    $('.export-btn').on('click', function() {
        const type = $(this).data('type');
        const url = $(this).data('url');

        window.open(url, '_blank');
    });

    // Handle category order update
    $('.category-order').on('change', function() {
        const categoryId = $(this).data('category-id');
        const order = $(this).val();
        const url = $(this).data('url');

        $.ajax({
            url: url,
            method: 'POST',
            data: {
                category_id: categoryId,
                order: order,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    toastr.success('Cập nhật thứ tự thành công');
                } else {
                    toastr.error('Có lỗi xảy ra');
                }
            },
            error: function() {
                toastr.error('Có lỗi xảy ra khi cập nhật thứ tự');
            }
        });
    });

    // Handle slug generation
    $('.slug-source').on('keyup', function() {
        const source = $(this).val();
        const target = $(this).data('target');
        const slug = source.toLowerCase()
            .replace(/[^a-z0-9 -]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-')
            .trim('-');

        $(target).val(slug);
    });

    // Handle color picker (if using color picker library)
    if ($.fn.colorpicker) {
        $('.color-picker').colorpicker();
    }

    // Handle rich text editor (if using CKEditor)
    if (typeof CKEDITOR !== 'undefined') {
        $('.rich-editor').each(function() {
            CKEDITOR.replace(this);
        });
    }

    // Handle rich text editor (if using TinyMCE)
    if (typeof tinymce !== 'undefined') {
        tinymce.init({
            selector: '.rich-editor',
            height: 300,
            menubar: false,
            plugins: 'lists link image code',
            toolbar: 'bold italic underline | bullist numlist | link image | code'
        });
    }

    console.log('Admin JavaScript loaded successfully');
});

// Global functions for admin panel
function confirmDelete(id, name) {
    if (confirm(`Bạn có chắc chắn muốn xóa "${name}"?`)) {
        document.getElementById(`delete-form-${id}`).submit();
    }
}

function toggleStatus(id, url) {
    $.ajax({
        url: url,
        method: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                toastr.success(response.message || 'Cập nhật trạng thái thành công');
                location.reload();
            } else {
                toastr.error(response.message || 'Có lỗi xảy ra');
            }
        },
        error: function(xhr) {
            toastr.error('Có lỗi xảy ra khi cập nhật trạng thái');
        }
    });
}

function bulkAction(action, formId) {
    if (action === 'delete') {
        if (!confirm('Bạn có chắc chắn muốn xóa các mục đã chọn?')) {
            return;
        }
    }

    document.getElementById(formId).submit();
}
