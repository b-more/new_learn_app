@if($getState())
    @php
        // Extract video ID from YouTube URL
        $videoId = \Illuminate\Support\Str::after($getState(), 'v=');
        // Handle other YouTube URL formats as necessary (e.g., youtu.be)
    @endphp
    <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $videoId }}" 
        frameborder="0" allowfullscreen></iframe>
@endif
