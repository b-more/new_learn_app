<x-filament-panels::page>
    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
    <div>
        <div class="flex flex-row items-start h-screen w-full">
            <div class="w-2/3 h-full overflow-y-scroll px-6">
                <div id="selected_lesson"  class="hidden">
                    <div class="step w-full" id="step1">
                        <div class="w-full flex flex-row items-center justify-start">
                            <div>
                                <button type="button" onclick="nextStep()" class="bg-green-800 px-8 py-2 rounded-full text-center text-white hover:bg-green-700 hover:cursor-pointer">Next</button>
                            </div>
                        </div>
                        <div id="video_show" class="mt-8">
                        </div>

                        <div id="video_title" class="mt-6 text-sm font-semibold">
                        </div>
                        <div id="video_description" class="mb-4 text-xs font-medium">
                        </div>
                    </div>
                    <div class="step w-full" id="step2">
                        <form id="quiz_form" method="POST">
                            <div class="w-full flex flex-row items-center justify-between mb-8">
                                <div>
                                    <button type="button" onclick="prevStep()" class="bg-green-800 px-8 py-2 rounded-full text-center text-white hover:bg-green-700 hover:cursor-pointer">Previous</button>
                                </div>
                                <div>
                                    <button type="submit" class="bg-green-800 px-8 py-2 rounded-full text-center text-white hover:bg-green-700 hover:cursor-pointer">Submit</button>
                                </div>
                            </div>
                            <div id="loading" class="hidden">
                                <div class="flex flex-col items-center justify-center">
                                    <dotlottie-player src="{{ asset('anims/shimmer.json') }}" background="transparent" speed="1" class="w-full h-[300px]" loop autoplay></dotlottie-player>
                                </div>
                            </div>
                            <div id="selected_quiz" class="">
                                <div class="text-md font-bold mb-8">MULTIPLE CHOICE QUESTION</div>
                                <div id="question_asked" class="text-sm font-semibold mb-10 p-6 bg-green-800 bg-opacity-10"></div>
                                <fieldset>
                                    <legend class="sr-only">Multiple Choice Question</legend>
                                    <input hidden name="user_id" value="{{ Auth::user()->id }}">
                                    <input hidden id="module_id" name="module_id">
                                    <input hidden id="lesson_id" name="lesson_id">

                                    <div class="flex items-center mb-4">
                                        <input id="a" type="radio" name="options" value="A" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" checked>
                                        <label id="answer_option_a" for="a" class="block ms-2  text-sm font-medium text-gray-900 dark:text-gray-300">
                                        </label>
                                    </div>

                                    <div class="flex items-center mb-4">
                                        <input id="b" type="radio" name="options" value="B" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                                        <label id="answer_option_b" for="b" class="block ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">

                                        </label>
                                    </div>

                                    <div class="flex items-center mb-4">
                                        <input id="c" type="radio" name="options" value="C" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:bg-gray-700 dark:border-gray-600">
                                        <label id="answer_option_c" for="c" class="block ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">

                                        </label>
                                    </div>

                                    <div class="flex items-center mb-4">
                                        <input id="d" type="radio" name="options" value="D" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-green-800 dark:focus-ring-green-600 dark:bg-gray-700 dark:border-gray-600">
                                        <label id="answer_option_d" for="d" class="block ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">

                                        </label>
                                    </div>
                                </fieldset>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="quiz_loading" class="hidden">
                    <div class="flex flex-col items-center justify-center">
                        <dotlottie-player src="{{ asset('anims/loading.json') }}" background="transparent" speed="1" class="w-full h-[200px]" loop autoplay></dotlottie-player>
                    </div>

                </div>
                <div id="correct" class="hidden">
                    <div class="w-full py-5 flex flex-col items-center justify-center bg-white shadow-md rounded-lg">
                        <div class="flex flex-col items-center justify-center">
                            <dotlottie-player src="{{ asset('anims/correct.json') }}" background="transparent" speed="1" class="w-full h-[200px]" loop autoplay></dotlottie-player>
                        </div>
                        <div class="text-green-800 font-bold text-lg text-center">100%</div>
                        <div class="text-green-800 font-bold text-md text-center">Correct Answer</div>
                        <div class="text-green-800 text-sm text-center">Choose your next lesson</div>
                    </div>

                </div>
                <div id="wrong" class="hidden">
                    <div class="w-full py-10 flex flex-col items-center justify-center bg-white shadow-md rounded-lg">
                        <div class="flex flex-col items-center justify-center">
                            <dotlottie-player src="{{ asset('anims/wrong.json') }}" background="transparent" speed="1" class="w-full h-[50px]" loop autoplay></dotlottie-player>
                        </div>
                        <div class="text-red-600 font-bold text-md text-center mt-10 mb-16">Wrong Answer</div>
                        <button type="button" onclick="reTake()" class="bg-green-800 hover:bg-green-700 text-sm text-center px-6 py-2 text-white rounded-full">Re-Take</button>
                    </div>

                </div>
            </div>
            <div id="current_lessons" class="w-1/3 h-full bg-green-800 bg-opacity-5 rounded overflow-y-scroll p-6">
                <div class="text-md font-bold mb-4">LESSONS</div>
                @foreach($lessons as $lesson)
                    <div id="{{ $lesson->id }}" class="lesson-button rounded-md bg-green-800 bg-opacity-30"
                         data-id="{{ $lesson->id }}"
                         data-module-id="{{ $lesson->module_id }}"
                         data-title="{{ $lesson->title }}"
                         data-description="{{ $lesson->description }}"
                         data-video-url="{{ $lesson->video_url }}"
                         data-video-length="{{ $lesson->video_length }}"
                         data-video-thumbnail="{{ $lesson->video_thumbnail }}"
                    >

                        <div class="w-full grid grid-cols-4 items-center p-1 relative mb-3">
                            <div class="w-[50px] h-[50px] col-span-1">
                                <img src="{{ '/storage/'.$lesson->video_thumbnail }}" class="w-[50px] h-[50px] object-cover">
                            </div>
                            <div class="text-xs col-span-3">{{ $lesson->title }}</div>
                            <div class="absolute -top-4 -left-4">
                                <img src="{{ asset('imgs/success.png') }}" class="h-10">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script>

        document.addEventListener('DOMContentLoaded', function() {
            const lessons = document.querySelectorAll('.lesson-button');
            const videoShow = document.getElementById("video_show");
            const form = document.getElementById("quiz_form");

            document.querySelectorAll('.lesson-button').forEach(lesson => {
                lesson.addEventListener('click', function() {
                    videoShow.innerHTML = "";
                    // Remove the class from all buttons
                    lessons.forEach(btn => btn.classList.remove('border-r-8', 'border-green-800'));
                    document.getElementById("correct").classList.add("hidden");
                    document.getElementById("wrong").classList.add("hidden");

                    prevStep();

                    // Add the class to the clicked button
                    this.classList.add('border-r-8', 'border-green-800','border-opacity-80');

                    const lessonId = this.id;
                    const lessonTitle = this.getAttribute('data-title');
                    const lessonDescription = this.getAttribute('data-description');
                    const lessonVideoUrl = this.getAttribute('data-video-url');
                    const lessonVideoLength = this.getAttribute('data-video-length');
                    const lessonVideoThumbnail = this.getAttribute('data-video-thumbnail');

                    const currentURL = window.location.href;
                    const urlObject = new URL(currentURL);
                    const baseURL = `${urlObject.protocol}//${urlObject.host}`;

                    console.log(lessonVideoThumbnail);
                    console.log(lessonVideoUrl);
                    console.log(baseURL)

                    videoShow.insertAdjacentHTML("afterbegin", `
                        <video
                                id="my-video"
                                class="video-js"
                                controls
                                preload="auto"
                                width="640"
                                height="264"
                                data-setup="{}"
                                poster="${baseURL +'/storage/'+ lessonVideoThumbnail}"
                                class="border-2 border-green-800"
                            >
                                <source id="source" type="video/mp4"  src="${baseURL+'/storage/'+lessonVideoUrl}"/>
                                <p class="vjs-no-js">
                                    To view this video please enable JavaScript, and consider upgrading to a
                                    web browser that
                                    <a href="https://videojs.com/html5-video-support/" target="_blank"
                                    >supports HTML5 video</a
                                    >
                                </p>
                            </video>
                    `)

                    document.getElementById("video_title").innerText = this.getAttribute('data-title');
                    document.getElementById("video_description").innerText = this.getAttribute('data-description');
                    document.getElementById("module_id").value = this.getAttribute('data-module-id');
                    document.getElementById("lesson_id").value = this.getAttribute('data-id');

                    const selectedLesson = document.getElementById("selected_lesson");
                    selectedLesson.classList.remove("hidden");

                    //query the quiz
                    //code to query module summaries
                    const apiUrl = '/api/quiz';

                    const postId = {
                        lesson_id: lessonId
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
                            //document.getElementById('lessons_details').classList.remove("hidden");
                            document.getElementById('question_asked').innerText = data.quiz.question
                            document.getElementById('answer_option_a').innerText = data.quiz.answer_option_a;
                            document.getElementById('answer_option_b').innerText = data.quiz.answer_option_b;
                            document.getElementById('answer_option_c').innerText = data.quiz.answer_option_c;
                            document.getElementById('answer_option_d').innerText = data.quiz.answer_option_d;
                        } else {
                            throw new Error('Response success flag is false');
                        }
                    }).catch(error => {
                        console.error('Error:', error);
                    });

                });
            });

            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission
                document.getElementById('selected_lesson').classList.add('hidden');
                document.getElementById('loading').classList.remove("hidden");

                // Custom form submission logic
                const formData = new FormData(form);
                const user_id = formData.get('user_id');
                const lesson_id = formData.get('lesson_id');
                const module_id = formData.get('module_id');
                const answer = formData.get('options');


                //send for marking
                //code to query module summaries
                const apiUrl = '/api/mark';

                const postId = {
                    user_id: user_id,
                    lesson_id: lesson_id,
                    module_id: module_id,
                    answer: answer
                };

                fetch(apiUrl, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(postId)
                }).then(response => {

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
                        console.log(data.answer);
                        // Handle success (status code 200 and success flag is true)
                        //document.getElementById('lessons_details').classList.remove("hidden");
                        if(data.answer === "Correct")
                        {
                            document.getElementById("correct").classList.remove("hidden");
                            document.getElementById("wrong").classList.add("hidden");
                            document.getElementById("loading").classList.add("hidden");
                        }else if(data.answer === "Wrong"){
                            document.getElementById("correct").classList.add("hidden");
                            document.getElementById("wrong").classList.remove("hidden");
                            document.getElementById("loading").classList.add("hidden");
                        }else{
                            document.getElementById("correct").classList.add("hidden");
                            document.getElementById("wrong").classList.remove("hidden");
                            document.getElementById("loading").classList.add("hidden");
                        }
                    } else {
                        throw new Error('Response success flag is false');
                    }
                }).catch(error => {
                    console.error('Error:', error);
                });

            });


        });

        let currentStep = 0;
        const steps = document.querySelectorAll('.step');

        function showStep(step) {
            steps.forEach((element, index) => {
                element.classList.toggle('active', index === step);
            });
        }

        function nextStep() {
            if (currentStep < steps.length - 1) {
                currentStep++;
                showStep(currentStep);
            }
        }

        function prevStep() {
            if (currentStep > 0) {
                currentStep--;
                showStep(currentStep);
            }
        }

        function submitWizard() {
            alert('Wizard submitted!');
            // Add form submission logic here if needed
            const answer = document.getElementById("option").value;
            const user_id = document.getElementById("user_id").value;
        }

        // Initialize the wizard
        showStep(currentStep);

        function reTake()
        {
            document.getElementById("wrong").classList.add("hidden");
            document.getElementById('selected_lesson').classList.remove('hidden');
            prevStep();
        }
    </script>
</x-filament-panels::page>
