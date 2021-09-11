@component('mail::message')
<!-- # Introduction -->
#your post was liked

<!-- The body of your message. -->
{{ $liker->name }} liked one of your post
@component('mail::button', ['url' => route('posts.show', $post)]) 
<!-- laravel contruct the url to go through our post -->
<!-- we need two dependencies user who made the like and the post itself -->
    View post
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
