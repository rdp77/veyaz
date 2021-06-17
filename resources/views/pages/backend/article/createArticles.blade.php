@extends('layouts.backend.default')
@section('title', __('pages.title') . __(' | Tambah Artikel'))
@section('titleContent', __('Tambah Artikel'))
@section('breadcrumb', __('Menu Utama'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Artikel') }}</div>
<div class="breadcrumb-item active">{{ __('Tambah Artikel') }}</div>
@endsection

@section('content')
<div class="card">
    <form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label>{{ __('Judul') }}<code>*</code></label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" required
                    autofocus>
                @error('title')
                <span class="text-danger" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label>{{ __('Kategori') }}<code>*</code></label>
                <select class="form-control select2 @error('category') is-invalid @enderror" name="category"
                    style="width: 50%" required>
                    @foreach ($category as $c)
                    <option value="{{ $c->id }}">
                        {{ $c->name }}
                    </option>
                    @endforeach
                </select>
                @error('category')
                <span class="text-danger" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Content</label>
                <textarea name="desc" class="summernote"></textarea>
                @error('desc')
                <span class="text-danger" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Thumbnail</label>
                <div id="image-preview" class="image-preview">
                    <label for="image-upload" id="image-label">Choose File</label>
                    <input type="file" name="img" id="image-upload" accept="image/*" />
                </div>
                @error('img')
                <span class="text-danger" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
        </div>
        <div class="card-footer text-right">
            <button class="btn btn-primary mr-1" type="submit">{{ __('Tambah') }}</button>
        </div>
    </form>
</div>
@endsection
@section('script')
<script>
    $.uploadPreview({
            input_field: "#image-upload", // Default: .image-upload
            preview_box: "#image-preview", // Default: .image-preview
            label_field: "#image-label", // Default: .image-label
            label_default: "Choose File", // Default: Choose File
            label_selected: "Change File", // Default: Change File
            no_label: false, // Default: false
            success_callback: null // Default: null
        });

</script>
@endsection