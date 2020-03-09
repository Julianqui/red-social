@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @include('include.message');


                    <div class="card pub_image">
                        <div class="card-header">

                            @if($image->user->image)
                                <div class="container-avatar">
                                    <img src="{{ route('user.avatar',['filename'=>$image->user->image  ]) }}" class="avatar" />
                                </div>
                            @endif
                            <div class="data-user">
                                {{ $image->user->name.' '.$image->user->surname }}

                                <span class="nickname">
                                {{ ' | @'.$image->user->nick }}
                            </span>
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

                                <hr>

                                <h4>Comentarios</h4>
                                @foreach($image->comments as $comment)
                                    <div class="comment">
                                        <hr class="bg-primary">
                                        <span class="nickname">@.{{ $comment->user->nick }}</span>
                                        <p>{{$comment->content}}</p>
                                    </div>
                                @endforeach
                            </div>



                        </div>
                    </div>



            </div>


        </div>
    </div>
@endsection
