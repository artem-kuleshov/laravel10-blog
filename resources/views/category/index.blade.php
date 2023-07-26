@extends('layouts.main')

@section('content')
    <main class="blog">
        <div class="container">
            <h1 class="edica-page-title" data-aos="fade-up">Категории</h1>
            <section class="featured-posts-section mb-4">
                <div class="row">
                    @foreach($categories as $category)
                        <div class="col-md-4 fetured-post blog-post text-center" data-aos="fade-up">
                            <a href="{{ route('category.post.index', $category->id) }}" class="blog-post-permalink">
                                <h6 class="blog-post-title">{{ $category->title }}</h6>
                            </a>
                        </div>
                    @endforeach
                    <div class="m-auto">
                        {{ $categories->links() }}
                    </div>
                </div>
            </section>
        </div>

    </main>
@endsection
