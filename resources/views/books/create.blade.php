@extends("layouts.app")
@section('title', "اضافة كتاب")
@section("content")
@if(isset($book))
<h1>تعديل كتاب</h1>
        @if(session("success"))
            <div class="alert alert-success">
                {{ session("success") }}
            </div>
        @endif
<form action="{{ route('books.update', $book->id) }}" method="POST">
    @method("PUT")
    @else
    <h1>إضافة كتاب جديد</h1>
    <form action="{{ route('books.store') }}" method="POST">
        @endif
        @csrf
        <div class="card-body">

            <div class="form-group">
                <label>عنوان  الكتاب</label>
                <input name="title" type="text" class="form-control" placeholder="ادخل عنوان الكتاب" id="title" value="{{ old('title', isset($book) ? $book->title : '') }}">
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Field 2 -->
            <div class="form-group">
                <label>الكاتب</label>
                <input name="author" type="text" class="form-control" placeholder="ادخل اسم الكاتب" id="author" value="{{ old('author', isset($book) ? $book->author : '') }}">
                @error('author')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>سنة النشر</label>
                <input name="year_published" type="number" class="form-control" placeholder="ادخل سنة النشر" id="year_published" value="{{ old('year_published', isset($book) ? $book->year_published : '') }}">
                @error('year_published')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    @if(isset($book))
                    تحديث
                    @else
                    إضافة
                    @endif
                </button>
            </div>
        </div>
    </form>
    @endsection
