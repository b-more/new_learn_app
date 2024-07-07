<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>NatSave AML | Learning Portal</title>

        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset("apple-touch-icon.png")}}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{asset("favicon-32x32.png")}}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset("favicon-16x16.png")}}">
        <link rel="manifest" href="{{asset("site.webmanifest")}}">
        <link rel="mask-icon" href="{{asset("safari-pinned-tab.svg")}}" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        @vite('resources/css/app.css')
    </head>
    <body class="font-sans antialiased h-screen">
    <div class="h-screen w-full relative">
        <img src="{{ asset('imgs/bg.svg') }}" class="w-full h-full object-cover">

    </div>
    <div class="h-screen w-full absolute top-0 left-0">
        <div class="w-full h-[90px] flex flex-col md:flex-row items-center md:justify-between px-6 md:px-10 mt-16 md:mt-6 mb-20 md:mb-0">
            <div class="flex flex-row items-center mb-20 md:mb-0">
                <img src="{{ asset('imgs/natsave.png') }}" class="h-[40px] sm:h-[50px] md:h-[70px]">
                <div class="bg-green-800 font-semibold text-sm pl-2 pr-6 py-2 text-white rounded-tr-full rounded-br-full">User Training Platform</div>
            </div>
            <div>
                <a href="/course/login" class="rounded-full border-4 border-green-800 bg-transparent text-green-800 hover:border-yellow-900 hover:text-yellow-900 hover:cursor-pointer px-10 py-2">Get Started | Login</a>
            </div>
        </div>
        <div class="h-full w-full flex flex-col md:flex-row items-center px-6 md:px-20 py-20 md:py-1">
            <div class="w-full md:w-1/2 text-center md:text-start">
                <div class="font-Montserrat text-4xl md:text-5xl lg:text-6xl font-semibold md:font-extrabold mb-10">Empower Your Team with Comprehensive AML Training</div>
                <div class="mb-12 text-yellow-950 font-medium text-2xl h-[140px] md:[100px]"><span class="font-extrabold text-green-800">"</span><span id="quote"></span><span class="font-extrabold text-green-800">"</span></div>
                <div class="font-Montserrat flex flex-row items-start space-x-2 w-full justify-center">
                    <div class="text-xs md:text-sm font-semibold">Powered By</div>
                    <div>
                        <a href="https://ontech.co.zm" target="_blank">
                            <img src="{{ asset('imgs/logo_small.png') }}" class="h-10">
                        </a>
                    </div>

                </div>
            </div>
            <div class="hidden md:block md:w-1/2">

            </div>
        </div>

    </div>
    <script>
        var i = 0;
        var txt = ''; // Initialize an empty string for the quote text
        var speed = 50; /* The speed/duration of the effect in milliseconds */

        function typeWriter() {
            if (i < txt.length) {
                document.getElementById("quote").innerHTML += txt.charAt(i);
                i++;
                setTimeout(typeWriter, speed);
            } else {
                // Reset the index and clear the content to start over
                i = 0;
                setTimeout(() => {
                    document.getElementById("quote").innerHTML = '';
                    typeWriter();
                }, 1000); // 1-second delay before restarting
            }
        }

        function fetchRandomQuote() {
            fetch('/random-quote')
                .then(response => response.json())
                .then(data => {
                    txt = data.quote; // Assuming the JSON structure is an object with a 'quote' property
                    typeWriter(); // Start the typewriter effect with the new quote
                })
                .catch(error => console.error('Error fetching quote:', error));
        }

        // Fetch the first random quote when the page loads
        fetchRandomQuote();
    </script>
    </body>
</html>
