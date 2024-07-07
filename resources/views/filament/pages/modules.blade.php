<x-filament-panels::page>
    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
    <div>
        <div class="flex flex-row items-start h-screen w-full">
            <div id="modules" class="w-2/3 h-full overflow-y-scroll px-6">
                @foreach(App\Models\Module::all() as $index => $module)
                    <button id="{{ $module->id }}" class="module-button px-6 py-3 bg-green-800 bg-opacity-5 rounded-lg flex flex-row items-center space-x-3 w-full mb-4"
                            data-title="{{ $module->title }}"
                            data-image-url="{{ $module->icon }}"
                            data-description="{{ $module->description }}">
                        <div class="w-2/8 text-4xl font-extrabold text-green-800">
                            {{ $index+1 }}
                        </div>
                        <div class="w-6/8">
                            <div class="text-sm text-start">{{ $module->title }}</div>
                            <div class="text-gray-500 text-xs text-start">{{ $module->description }}</div>
                        </div>

                    </button>
                @endforeach
            </div>
            <div class="w-1/3 h-full bg-green-800 bg-opacity-5 rounded overflow-y-scroll p-6">
                <div id="content">
                    <div>
                        <a id="lessons_link">
                            <img id="thumbnail" style="max-width: 100%; height: auto;">
                        </a>
                    </div>
                    <div id="title" class="mt-4 text-sm font-semibold">
                    </div>
                    <div id="description" class="text-xs text-gray-600 mt-2">
                    </div>
                    <div id="loading" class="hidden">
                        <div class="flex flex-col items-center justify-center">
                            <dotlottie-player src="{{ asset('anims/shimmer.json') }}" background="transparent" speed="1" class="w-full h-[300px]" loop autoplay></dotlottie-player>
                        </div>
                    </div>
                    <div id="lessons_details" class="hidden mt-6">
                        <div class="flex flex-row items-center justify-between mb-4">
                            <div class="font-bold text-sm">Total Lessons</div>
                            <div id="total_lessons" class="text-md font-extrabold"></div>
                        </div>
                        <a id="lesson_btn" class="rounded-full px-6 py-2 text-white font-semibold text-sm items-center bg-green-800 flex flex-row space-x-3 justify-end hover:bg-green-700">
                            <div>Proceed</div>
                            <div>></div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.module-button');

            document.querySelectorAll('.module-button').forEach(button => {
                button.addEventListener('click', function() {
                    // Remove the class from all buttons
                    buttons.forEach(btn => btn.classList.remove('border-r-8', 'border-green-800'));

                    // Add the class to the clicked button
                    this.classList.add('border-r-8', 'border-green-800','border-opacity-80');

                    const buttonId = this.id;
                    const buttonTitle = this.getAttribute('data-title');
                    const buttonImageUrl = this.getAttribute('data-image-url');
                    const buttonDescription = this.getAttribute('data-description');
                    document.getElementById('loading').classList.remove("hidden");

                    document.getElementById('thumbnail').innerHTML = "";
                    document.getElementById('title').innerText = `${buttonTitle}`;
                    document.getElementById('thumbnail').src = `${buttonImageUrl}`;
                    document.getElementById('lessons_link').href = '/course/lessons?b='+`${buttonId}`;
                    document.getElementById('description').innerText = `${buttonDescription}`;

                    //code to query module summaries
                    const apiUrl = '/api/module/lessons';

                    const postId = {
                        module_id: buttonId
                    };

                    fetch(apiUrl, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(postId)
                    }).then(response => {
                        document.getElementById('loading').classList.add("hidden");

                        if (response.status === 200) {
                            // Parse the JSON response
                            return response.json();
                        } else if (response.status === 400) {
                            // Handle client error (status code 400)
                            throw new Error('Bad request');
                        } else {
                            // Handle other status codes
                            throw new Error('Unexpected error');
                        }
                    }).then(data => {
                        if (data.success) {
                            // Handle success (status code 200 and success flag is true)
                            document.getElementById('lessons_details').classList.remove("hidden");
                            document.getElementById('total_lessons').innerText = data.total_lessons;
                            document.getElementById('lesson_btn').href = '/coursenpm run/lessons?b='+`${buttonId}`;
                        } else {
                            throw new Error('Response success flag is false');
                        }
                    }).catch(error => {
                        console.error('Error:', error);
                    });


                });
            });
        });
    </script>

</x-filament-panels::page>
