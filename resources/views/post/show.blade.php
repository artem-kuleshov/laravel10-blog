@extends('layouts.main')

@section('content')
    <main class="blog-post">
        <div class="container">
            <h1 class="edica-page-title" data-aos="fade-up">{{ $post->title }}</h1>
            <p class="edica-blog-post-meta" data-aos="fade-up" data-aos-delay="200">{{ $date_created->translatedFormat('F') }} {{ $date_created->day }}, {{ $date_created->year }} • {{ $date_created->format('H:i') }}</p>
            <section class="blog-post-featured-img" data-aos="fade-up" data-aos-delay="300">
                <img src="{{ asset('storage/' . $post->preview_image) }}" alt="{{ $post->title }}" class="w-100">
            </section>
            <section class="post-content">
                <div class="row">
                    <div class="col-lg-9 mx-auto" data-aos="fade-up">
                        {!! $post->content !!}
                    </div>
                </div>
            </section>
            @if($related_posts->count() > 0)
                <div class="row">
                    <div class="col-lg-9 mx-auto">
                        <section class="related-posts">
                            <h2 class="section-title mb-4" data-aos="fade-up">Схожие посты</h2>
                            <div class="row">
                                @foreach($related_posts as $p)
                                    <div class="col-md-4" data-aos="fade-left" data-aos-delay="100">
                                        <img src="{{ asset('storage/' . $p->preview_image) }}" alt="{{ $p->title }}" class="post-thumbnail">
                                        <p class="post-category">{{ $p->category->tiitle }}</p>
                                        <a href="{{ route('post.show', $p->id) }}"><h5 class="post-title">{{ $p->title }}</h5></a>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    </div>
                </div>
            @endif
            @if($post->comments()->count() > 0)
                <div class="row mb-5">
                    <div class="col-lg-9 mx-auto">
                        <h2 class="section-title mb-2" data-aos="fade-up">Комментарии ({{ $post->comments()->count() }})</h2>
                        @foreach($post->comments as $comment)
                            <div class="card-comment mb-2">
                                <div class="comment-text">
                                <span class="username">
                                    <div><strong>{{ $comment->user->name }}</strong></div>
                                  <span class="text-muted float-right">{{ $comment->createdDate->diffForHumans() }}</span>
                                </span>
                                    {{ $comment->comment }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @auth()
                <div class="row">
                    <div class="col-lg-9 mx-auto">
                        <section class="comment-section">
                            <h2 class="section-title mb-5" data-aos="fade-up">Оставить комментарий</h2>
                            <form action="{{ route('post.comment.store', $post->id) }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-12" data-aos="fade-up">
                                        <label for="comment" class="sr-only">Комментарий</label>
                                        <textarea name="comment" id="comment" class="form-control" placeholder="Комментарий" rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12" data-aos="fade-up">
                                        <input type="submit" value="Добавить" class="btn btn-warning">
                                    </div>
                                </div>
                            </form>
                        </section>
                    </div>
                </div>
            @endauth
        </div>
    </main>
@endsection
