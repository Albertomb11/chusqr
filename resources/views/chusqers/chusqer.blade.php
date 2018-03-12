<div class="card @isset($user) @if($user->id == $chusqer->user_id) mine @endif @endisset">
    <div class="card-divider">
        <p>Añadido por <a href="/{{ $chusqer->user->slug }}">{{ $chusqer->user->name }}</a> - <a href="{{ url('/') }}/chusqers/{{ $chusqer['id'] }}">Leer más</a></p>
    </div>
    <p class="chusqer-content">
        <img src="{{ $chusqer->image }}" alt="">{{ $chusqer->content }}
    </p>
    <p class="chusqer-hashtags text-right">
        @foreach($chusqer->hashtags as $hashtag)
            <a href="/hashtag/{{ $hashtag->slug }}"><span class="label label-primary">{{ $hashtag->slug }}</span></a>
        @endforeach
    </p>
    @if(Auth::user() && Auth::user()->amI())
    <div class="card-section">
        @can('update', $chusqer)
            <a href="{{ Route('chusqers.edit', $chusqer) }}" class="button warning">Editar</a>
        @endcan
        @can('delete', $chusqer)
        <form action="{{ Route('chusqers.delete', $chusqer->id) }}" method="POST" id="chusqer-actions-buttons">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}

            <button type="submit" class="button alert">Borrar</button>

        </form>
        @endcan
    </div>
    @endif

    @if(Auth::user()->isLike($user))
        <form action="/{{ $chusqer->id }}/noLikes" method="POST">
            {{ csrf_field() }}

            <button type="submit" class="alert button">No Like</button>
        </form>
    @else
        <form action="/{{ $chusqer->id }}/likes" method="POST">
            {{ csrf_field() }}

            <button type="submit" class="button">Like</button>
        </form>
    @endif
        @if($user->likes->count() == 0)
            <p>No tiene likes</p>
        @else
        <p>{{ $user->likes->count() }}</p>
        @endif
</div>