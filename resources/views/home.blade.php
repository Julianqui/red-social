@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('include.message');

            @foreach($images as $image)
            <div class="card pub_image pub_image_detail">
                <div class="card-header">

                    @if($image->user->image)
                    <div class="container-avatar">
                        <img src="{{ route('user.avatar',['filename'=>$image->user->image  ]) }}" class="avatar" />
                    </div>
                    @endif
                        <div class="data-user">
                            <a href="{{ route('image.detail', ['id' => $image->id]) }}">
                            {{ $image->user->name.' '.$image->user->surname }}

                            <span class="nickname">
                                {{ ' | @'.$image->user->nick }}
                            </span>
                            </a>
                        </div>
                        </div>
                <div class="card-body">
                    <div class="image-container">
                        <img src=" {{ route('image.file', ['filename' => $image->image_path]) }}"/>
                    </div>

                    <div class="decription p-2 ml-2">
                        <span class="nickname">@.{{ $image->user->nick }}</span>
                        <p>{{ $image->description }}</p>
                    </div>

                    <div class="like">
                        <img src="{{ asset('image/corazonazul.png') }}">


                    </div>


                    <div class="clearfix"></div>
                    <div class="comments">
{{--                    <a href="" class="btn btn-warning btn-sm btn-coments">--}}
                        <h2>Comentarios({{ count($image->comments) }})</h2>
                    <hr>

                        <form method="POST" action="{{ route('comment.save') }}">
                            @csrf

                            <input type="hidden" name="image_id" value="{{ $image->id }}">
                            <p>
                                <textarea class="form-control {{ $errors->has("content") ? 'is-invalid' : '' }}" name="content"></textarea>
                                @if($errors->has('content'))
                                    <span class="invalid-feedback" role="alert">
                                             <strong>{{ $errors->first("content") }}</strong>
                                        </span>
                                @endif
                            </p>
                            <button type="submit" class="btn btn-success">Enviar</button>


                        </form>
                    </div>

                </div>
            </div>
            @endforeach

            <div class="clearfix"></div>
            {{ $images->links() }}
        </div>


    </div>
</div>
@endsection
