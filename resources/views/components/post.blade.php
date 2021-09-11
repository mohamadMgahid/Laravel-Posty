@props('post' => $post)
<!-- post we actually want to pass thats why used @props directive 'post' => $post that mean assign $post var to key post -->

<!-- they are post models we can access like we did in the user-->
<div class="mb-4">
    <a href="{{ route('users.posts', $post->user) }}" class="font-bold" >{{ $post->user->name }}</a> <span class="text-gray-600
    text-sm">{{ $post->created_at->toTimeString() }}</span>

    <p class="mb-2">{{ $post->body }}</p>

    @can
        <form action="{{ route('posts.destroy', $post) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-blue-500">Delete</button>
        </form>
    @endcan

    <div class="flex items-center" >
        @auth
            @if(!$post->likedBy(auth()->user()))
                <form action="{{ route('posts.likes', $post) }}" method="post" class="mr-1">
                    @csrf
                    <button type="submit" class="text-blue-500">Like</button>
                </form>
            @else
                <form action="{{ route('posts.likes', $post) }}" method="post" class="mr-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-blue-500">UnLike</button>
                </form>
            @endif
        @endauth
        <span>{{ $post->likes->count() }} {{ Str::plural('like', 
            $post->likes->co unt()) }}</span>
    </div>
</div>