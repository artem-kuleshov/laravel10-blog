@extends('admin.layouts.main')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Редактиирование тэга</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.tag.index') }}">Категории</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.tag.show', $tag->id) }}">{{ $tag->title }}</a></li>
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
                        <form action="{{ route('admin.tag.update', $tag->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label>Название</label>
                                <input type="text" name="title" value="{{ $tag->title }}" class="form-control">
                                @error('title')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <input type="submit" class="btn btn-block btn-success w-25" value="Обновить">
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
