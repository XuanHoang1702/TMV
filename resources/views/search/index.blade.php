<div class="col-md-3">
    <div class="head-seach">
        <form action="{{ route('search.results') }}" method="POST" id="searchForm">
            @csrf
            <div class="head-input-g">
                <input
                    type="text"
                    name="keyword"
                    placeholder="Nhập từ khoá tìm kiếm"
                    class="cl-input-seach"
                    value="{{ request('keyword', '') }}"
                    required
                />
                <!-- GIỮ NGUYÊN icon, chỉ thêm class để làm button -->
                <i class="fa fa-search search-submit-btn" aria-hidden="true"></i>
            </div>
        </form>
    </div>
</div>
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.getElementById('searchForm');
    const searchInput = document.querySelector('.cl-input-seach');
    const searchIcon = document.querySelector('.search-submit-btn');

    if (!searchForm || !searchInput) return;

    // Làm icon hoạt động như submit button
    if (searchIcon) {
        searchIcon.style.cursor = 'pointer';
        searchIcon.style.transition = 'color 0.2s ease';

        // Click event cho icon
        searchIcon.addEventListener('click', function(e) {
            e.preventDefault();
            const keyword = searchInput.value.trim();

            if (!keyword) {
                searchInput.focus();
                return;
            }

            // Thêm loading animation
            this.classList.add('fa-spin');
            this.style.color = '#667eea';

            // Submit form
            searchForm.submit();
        });

        // Hover effect
        searchIcon.addEventListener('mouseenter', function() {
            this.style.color = '#667eea';
        });

        searchIcon.addEventListener('mouseleave', function() {
            this.style.color = '#fff';
        });
    }

    // Form submit validation
    searchForm.addEventListener('submit', function(e) {
        const keyword = searchInput.value.trim();

        if (!keyword) {
            e.preventDefault();
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
            return false;
        }

        // Loading state
        if (searchIcon) {
            searchIcon.classList.add('fa-spin');
        }
        searchInput.disabled = true;
        searchForm.style.opacity = '0.7';
    });

    // Auto focus khi có keyword
    @if(request('keyword'))
    searchInput.focus();
    searchInput.setSelectionRange(searchInput.value.length, searchInput.value.length);
    @endif

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Ctrl+K để focus search
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
            e.preventDefault();
            searchInput.focus();
        }

        // Enter để submit khi focus search
        if (e.key === 'Enter' && document.activeElement === searchInput && searchInput.value.trim()) {
            searchForm.submit();
        }
    });
});
</script>
@endsection
