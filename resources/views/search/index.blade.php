<div class="col-md-3">
    <div class="head-seach">
        <form action="{{ route('search.results') }}" method="POST" id="searchForm">
            @csrf
            <div class="head-input-g" style="position: relative;">
                <input type="text"
                       name="keyword"
                       placeholder="Nhập từ khoá tìm kiếm"
                       class="cl-input-seach"
                       value="{{ request('keyword', '') }}"
                       required />

                <!-- Icon đóng vai trò như button -->
                <button type="submit"
                        id="searchIconBtn"
                        class="fa fa-search search-submit-btn"
                        aria-label="Tìm kiếm"
                        style="
                            position: absolute;
                            right: 10px;
                            top: 50%;
                            transform: translateY(-50%);
                            background: none;
                            border: none;
                            color: #fff;
                            cursor: pointer;
                            font-size: 18px;
                            transition: color 0.2s ease;
                        ">
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.getElementById('searchForm');
    const searchInput = document.querySelector('.cl-input-seach');
    const searchIcon = document.getElementById('searchIconBtn');

    if (!searchForm || !searchInput || !searchIcon) return;

    // Hover effect
    searchIcon.addEventListener('mouseenter', function() {
        this.style.color = '#667eea';
    });
    searchIcon.addEventListener('mouseleave', function() {
        this.style.color = '#fff';
    });

    // Submit khi click icon
    searchIcon.addEventListener('click', function(e) {
        e.preventDefault();
        const keyword = searchInput.value.trim();

        if (!keyword) {
            searchInput.focus();
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Vui lòng nhập từ khóa',
                    text: 'Nhập từ khóa tìm kiếm để tiếp tục',
                    timer: 2000,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
            } else {
                alert('Vui lòng nhập từ khóa tìm kiếm');
            }
            return;
        }

        // Loading effect
        this.classList.add('fa-spin');
        this.style.color = '#667eea';
        searchForm.submit();
    });

    // Enter => submit
    searchForm.addEventListener('submit', function(e) {
        const keyword = searchInput.value.trim();
        if (!keyword) {
            e.preventDefault();
            searchInput.focus();
            return false;
        }
        searchIcon.classList.add('fa-spin');
        searchInput.disabled = true;
        searchForm.style.opacity = '0.7';
    });

    // Ctrl+K để focus nhanh
    document.addEventListener('keydown', function(e) {
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
            e.preventDefault();
            searchInput.focus();
        }
    });

    // Auto focus khi có keyword
    @if (request('keyword'))
        searchInput.focus();
        searchInput.setSelectionRange(searchInput.value.length, searchInput.value.length);
    @endif
});
</script>
@endpush
