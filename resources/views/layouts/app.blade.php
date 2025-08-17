<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Video.js CSS if you're using it -->
    <link href="https://vjs.zencdn.net/8.0.4/video-js.css" rel="stylesheet">

    <!-- Additional CSS -->
    @stack('styles')
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <!-- Navigation -->
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    <!-- Activity Tracker JavaScript -->
    <script src="{{ asset('js/activity-tracker.js') }}"></script>

    <!-- Video.js JavaScript if you're using it -->
    <script src="https://vjs.zencdn.net/8.0.4/video.min.js"></script>

    <!-- Initialize Activity Tracking -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Set user context for activity tracking
            @auth
                window.setUserContext({{ auth()->id() }});

                // Track login activity
                window.activityTracker.sendActivity({
                    action: 'login',
                    timestamp: Date.now()
                });
            @endauth

            // Initialize Video.js if present
            if (typeof videojs !== 'undefined') {
                // Initialize all video elements with Video.js
                document.querySelectorAll('video').forEach(function(videoElement) {
                    if (!videoElement.classList.contains('vjs-tech')) {
                        const player = videojs(videoElement);

                        // Initialize activity tracking for this video
                        if (window.activityTracker) {
                            window.activityTracker.initVideoTracking(videoElement.parentElement);
                        }
                    }
                });
            }
        });

        // Track logout when user navigates away (if authenticated)
        @auth
        window.addEventListener('beforeunload', function() {
            if (navigator.sendBeacon) {
                navigator.sendBeacon('/api/activity/track', JSON.stringify({
                    user_id: {{ auth()->id() }},
                    action: 'logout',
                    timestamp: Date.now()
                }));
            }
        });
        @endauth
    </script>

    <!-- Additional JavaScript -->
    @stack('scripts')
</body>
</html>
