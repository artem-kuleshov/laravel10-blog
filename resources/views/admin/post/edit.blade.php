@extends('admin.layouts.main')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Редактиирование поста</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.post.index') }}">Посты</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.post.show', $post->id) }}">{{ $post->title }}</a></li>
                            <li class="breadcrumb-item active">Редактирование</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('admin.post.update', $post->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label>Категория</label>
                                <select name="category_id" class="form-control">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == old('category_id', $post->category_id) ? 'selected' : '' }}>
                                            {{ $category->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Название</label>
                                <input type="text" name="title" class="form-control" value="{{ old('title', $post->title) }}">
                                @error('title')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <textarea id="summernote" name="content" rows="50">{{ old('content', $post->content) }}</textarea>
                                @error('content')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="preview_image">Превью</label>
                                <div>
                                    <img src="{{ Storage::url($post->preview_image) }}" class="w-25 mb-3">
                                </div>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="preview_image" id="preview_image">
                                        <label class="custom-file-label" for="preview_image">Выберите изображение</label>
                                    </div>
                                </div>
                                @error('preview_image')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="main_image">Главное изображение</label>
                                <div>
                                    <img src="{{ Storage::url($post->main_image) }}" class="w-25 mb-3">
                                </div>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="main_image" id="main_image">
                                        <label class="custom-file-label" for="main_image">Выберите изображение</label>
                                    </div>
                                </div>
                                @error('main_image')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Тэги</label>
                                <select class="select2" multiple="multiple" name="tag_ids[]" style="width: 100%;">
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}"
                                            {{ in_array($tag->id, old('tag_ids', $post->tags->pluck('id')->toArray()) ?? []) ? 'selected' : '' }}>
                                            {{ $tag->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('tag_ids')
                                <div class="text-danger">
                                    <p>{{ $message }}</p>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-block btn-success w-25" value="Обновить">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
