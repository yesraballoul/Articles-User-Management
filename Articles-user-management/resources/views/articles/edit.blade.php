@extends('adminlte::page')

@section('title', 'Edit Article')

@section('content_header')
    <h1></h1>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex flex-row justify-content-between align-items-center">
                        <div>{{ __('Edit Article') }}</div>
                        <div><a class="btn btn-primary" href="{{ route('home') }}">back</a></div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('articles.update', ['article' => $article->id]) }}">
                        @csrf
                        @method("PUT")
                        
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text"
                                    class="form-control @error('title') is-invalid @enderror" name="title"
                                    value="{{ $article->title ?? old('title') }}" autocomplete="title" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-end">{{ __('Body') }}</label>

                            <div class="col-md-6">
                                <input id="body" type="text"
                                    class="form-control @error('body') is-invalid @enderror" name="body"
                                    value="{{ $articler->body ?? old('body') }}" autocomplete="body">

                                @error('body')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {

            setTimeout(function() {
                $(".alert").alert('close');
            }, 3000);
        });
    </script>
@stop
