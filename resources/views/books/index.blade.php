@extends("layouts.app")
@section("title","عرض الكتب")
@section("content")
<h1>قائمة الكتب</h1>
@if(session("success"))
<div class="modal fade show" id="successModal" tabindex="-1" style="display:block; background:rgba(0,0,0,0.5);">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center">

            <div class="modal-header bg-success text-white">
                <h5 class="modal-title w-100">✔️ نجاح</h5>
            </div>

            <div class="modal-body">
                <p class="fs-5">{{ session("success") }}</p>
            </div>

            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-success" onclick="closeModal()">
                    OK
                </button>
            </div>

        </div>
    </div>
</div>
@endif

@if($books->isEmpty())
<p>لا توجد كتب متاحة.</p>
@else
<div class="card shadow-sm border-0">
    <div class="card-header bg-dark text-white">
        <h5 class="mb-0">📚 قائمة الكتب</h5>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0 text-center align-middle">

                <thead class="table-dark">
                    <tr>
                        <th>العنوان</th>
                        <th>المؤلف</th>
                        <th>سنة النشر</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($books as $book)
                    <tr>
                        <td class="fw-bold">{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>
                            <span class="badge bg-primary">
                                {{ $book->year_published }}
                            </span>
                        </td>

                        <td>
                            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-warning text-white">
                                ✏️ تعديل
                            </a>

                            <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                    🗑️ حذف
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>
@endif
{{ $books->links() }}
<script>
    function closeModal() {
        document.getElementById('successModal').style.display = 'none';
    }
</script>
@endsection