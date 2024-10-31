<x-filament-panels::page>
    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
    <div>
        <div class="flex flex-row items-start w-full h-screen">
            <div class="w-2/3 h-full px-6 overflow-y-scroll">
                <div id="selected_lesson"  class="hidden">
                    <div class="w-full step" id="step1">
                        <div class="flex flex-row items-center justify-start w-full">
                            <div>
                                <button type="button" onclick="nextStep()" class="px-8 py-2 text-center text-white bg-green-800 rounded-full hover:bg-green-700 hover:cursor-pointer">Next</button>
                            </div>
                        </div>
                        <div id="video_show" class="mt-8">
                        </div>

                        <div id="video_title" class="mt-6 font-semibold text-md">
                        </div>
                        <div id="video_description" class="mb-4 text-xs font-medium">
                        </div>
                        <hr class="mb-10">

                        <div class="mb-4 text-xs font-medium">
                            <div class="font-bold text-md">Downloadable Files</div>
                            <a id="lessonDownloadLink0" download class="text-green-800 underline"></a><br/>
                            <a id="lessonDownloadLink1" download class="text-green-800 underline"></a><br/>
                            <a id="lessonDownloadLink2" download class="text-green-800 underline"></a><br/>
                            <a id="lessonDownloadLink3" download class="text-green-800 underline"></a><br/>
                            <a id="lessonDownloadLink4" download class="text-green-800 underline"></a><br/>
                            <a id="lessonDownloadLink5" download class="text-green-800 underline"></a><br/>
                            <a id="lessonDownloadLink6" download class="text-green-800 underline"></a><br/>
                            <a id="lessonDownloadLink7" download class="text-green-800 underline"></a><br/>
                            <a id="lessonDownloadLink8" download class="text-green-800 underline"></a><br/>
                            <a id="lessonDownloadLink9" download class="text-green-800 underline"></a><br/>
                            <a id="lessonDownloadLink10" download class="text-green-800 underline"></a><br/>
                            <a id="lessonDownloadLink11" download class="text-green-800 underline"></a><br/>
                            <a id="lessonDownloadLink12" download class="text-green-800 underline"></a><br/>
                            <a id="lessonDownloadLink13" download class="text-green-800 underline"></a><br/>
                        </div>

                    </div>
                    <div class="w-full step" id="step2">
                        <form id="quiz_form" method="POST">
                            <div class="flex flex-row items-center justify-between w-full mb-8">
                                <div>
                                    <button type="button" onclick="prevStep()" class="px-8 py-2 text-center text-white bg-green-800 rounded-full hover:bg-green-700 hover:cursor-pointer">Previous</button>
                                </div>
                                <div>
                                    <button type="submit" class="px-8 py-2 text-center text-white bg-green-800 rounded-full hover:bg-green-700 hover:cursor-pointer">Submit</button>
                                </div>
                            </div>
                            <div id="loading" class="hidden">
                                <div class="flex flex-col items-center justify-center">
                                    <dotlottie-player src="{{ asset('anims/shimmer.json') }}" background="transparent" speed="1" class="w-full h-[300px]" loop autoplay></dotlottie-player>
                                </div>
                            </div>
                            <div id="selected_quiz" class="">
                                <div class="mb-8 font-bold text-md">{{ \App\Models\Quizz::where('lesson_id',$lessons->first()->id ?? 0)->count() }} MULTIPLE CHOICE QUESTION</div>
                                @foreach(\App\Models\Quizz::where('lesson_id',$lessons->first()->id ?? 0)->get() as $quiz)
                                    <div id="question_asked" class="p-6 mb-10 text-sm font-semibold bg-green-800 bg-opacity-10">{{ $quiz->question }}</div>
                                    <fieldset>
                                        <legend class="sr-only">Multiple Choice Question</legend>
                                        <input hidden name="user_id" value="{{ Auth::user()->id }}">
                                        <input hidden name="quiz_id" value="{{ $quiz->id }}">
                                        <input hidden name="quiz_total" value="{{ \App\Models\Quizz::where('lesson_id',$lessons->first()->id)->count() }}">
                                        <input hidden id="module_id" name="module_id" value="{{ $lessons->first()->module_id }}">
                                        <input hidden id="lesson_id" name="lesson_id" value="{{ $lessons->first()->id }}">

                                        <div class="flex items-center mb-4">
                                            <input id="a_{{ $quiz->id }}" type="radio" name="options_{{ $quiz->id }}" value="A" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" required>
                                            <label id="answer_option_a" for="a" class="block text-sm font-medium text-gray-900 ms-2 dark:text-gray-300">
                                                A. {{ $quiz->answer_option_a }}
                                            </label>
                                        </div>

                                        <div class="flex items-center mb-4">
                                            <input id="b_{{ $quiz->id }}" type="radio" name="options_{{ $quiz->id }}" value="B" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" required>
                                            <label id="answer_option_b" for="b" class="block text-sm font-medium text-gray-900 ms-2 dark:text-gray-300">
                                                B. {{ $quiz->answer_option_b }}
                                            </label>
                                        </div>

                                        <div class="flex items-center mb-4">
                                            <input id="c_{{ $quiz->id }}" type="radio" name="options_{{ $quiz->id }}" value="C" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:bg-gray-700 dark:border-gray-600" required>
                                            <label id="answer_option_c" for="c" class="block text-sm font-medium text-gray-900 ms-2 dark:text-gray-300">
                                                C. {{ $quiz->answer_option_c }}
                                            </label>
                                        </div>

                                        <div class="flex items-center mb-4">
                                            <input id="d_{{ $quiz->id }}" type="radio" name="options_{{ $quiz->id }}" value="D" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-green-800 dark:focus-ring-green-600 dark:bg-gray-700 dark:border-gray-600" required>
                                            <label id="answer_option_d" for="d" class="block text-sm font-medium text-gray-900 ms-2 dark:text-gray-300">
                                                D. {{ $quiz->answer_option_d }}
                                            </label>
                                        </div>
                                    </fieldset>
                                @endforeach

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
                    <div class="flex flex-col items-center justify-start w-full py-5 bg-white rounded-lg shadow-md">
                        <table class="table-auto">
                            <thead>
                            <tr>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Score (percentage)</td>
                                <td id="percentage"></td>
                            </tr>
                            <tr>
                                <td>Total Questions</td>
                                <td id="questions"></td>
                            </tr>
                            <tr>
                                <td>Total Passed</td>
                                <td id="passed"></td>
                            </tr>
                            <tr>
                                <td>Total Failed</td>
                                <td id="failed"></td>
                            </tr>

                            </tbody>
                        </table>
                    </div>

                </div>
                <div id="wrong" class="hidden">
                    <div class="flex flex-col items-center justify-center w-full py-10 bg-white rounded-lg shadow-md">
                        <div class="flex flex-col items-center justify-center">
                            <dotlottie-player src="{{ asset('anims/wrong.json') }}" background="transparent" speed="1" class="w-full h-[50px]" loop autoplay></dotlottie-player>
                        </div>
                        <div class="mt-10 mb-16 font-bold text-center text-red-600 text-md">Wrong Answer</div>
                        <button type="button" onclick="reTake()" class="px-6 py-2 text-sm text-center text-white bg-green-800 rounded-full hover:bg-green-700">Re-Take</button>
                    </div>

                </div>
            </div>
            <div id="current_lessons" class="w-1/3 h-full p-6 overflow-y-scroll bg-green-800 rounded bg-opacity-5">
                <div class="mb-4 font-bold text-md">LESSONS</div>
                @foreach($lessons as $lesson)
                    <div id="{{ $lesson->id }}" class="bg-green-800 rounded-md lesson-button bg-opacity-30"
                         data-id="{{ $lesson->id }}"
                         data-module-id="{{ $lesson->module_id }}"
                         data-title="{{ $lesson->title }}"
                         data-description="{{ $lesson->description }}"
                         data-video-url="{{ $lesson->video_url }}"
                         data-video-length="{{ $lesson->video_length }}"
                         data-video-thumbnail="{{ $lesson->video_thumbnail }}"
                         data-lesson-documents="{{ json_encode($lesson->documents) }}"
                    >

                        <div class="relative grid items-center w-full grid-cols-4 p-1 mb-3">
                            <div class="w-[50px] h-[50px] col-span-1">
                                <img src="{{ '/storage/'.$lesson->video_thumbnail }}" class="w-[50px] h-[50px] object-cover">
                            </div>
                            <div class="col-span-3 text-xs">{{ $lesson->title }}</div>
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

            // Create a link element for each document

            const videoShow = document.getElementById("video_show");
            const lessonDownloads = document.getElementById("lesson_downloads");
            const form = document.getElementById("quiz_form");

            const lessonDownloadLink0 = document.getElementById('lessonDownloadLink0');
            const lessonDownloadLink1 = document.getElementById('lessonDownloadLink1');
            const lessonDownloadLink2 = document.getElementById('lessonDownloadLink2');
            const lessonDownloadLink3 = document.getElementById('lessonDownloadLink3');
            const lessonDownloadLink4 = document.getElementById('lessonDownloadLink4');
            const lessonDownloadLink5 = document.getElementById('lessonDownloadLink5');
            const lessonDownloadLink6 = document.getElementById('lessonDownloadLink6');
            const lessonDownloadLink7 = document.getElementById('lessonDownloadLink7');
            const lessonDownloadLink8 = document.getElementById('lessonDownloadLink8');
            const lessonDownloadLink9 = document.getElementById('lessonDownloadLink9');
            const lessonDownloadLink10 = document.getElementById('lessonDownloadLink10');
            const lessonDownloadLink11 = document.getElementById('lessonDownloadLink11');
            const lessonDownloadLink12 = document.getElementById('lessonDownloadLink12');
            const lessonDownloadLink13 = document.getElementById('lessonDownloadLink13');

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
                    const selectedLesson = document.getElementById("selected_lesson");
                    selectedLesson.classList.remove("hidden");

                    const lessonId = this.id;
                    const lessonTitle = this.getAttribute('data-title');
                    const lessonDescription = this.getAttribute('data-description');
                    const lessonVideoUrl = this.getAttribute('data-video-url');
                    const lessonVideoLength = this.getAttribute('data-video-length');
                    const lessonVideoThumbnail = this.getAttribute('data-video-thumbnail');
                    const lessonDocumentsString = this.getAttribute('data-lesson-documents');


                    const currentURL = window.location.href;
                    const urlObject = new URL(currentURL);
                    const baseURL = `${urlObject.protocol}//${urlObject.host}`;


                    if(lessonVideoUrl !== "" || lessonVideoUrl !== null) {
                        videoShow.insertAdjacentHTML("afterbegin", `
                        <video
                                id="my-video"
                                class="video-js"
                                controls
                                preload="auto"
                                width="640"
                                height="264"
                                data-setup="{}"
                                poster="${baseURL + '/storage/' + lessonVideoThumbnail}"
                                class="border-2 border-green-800"
                            >
                                <source id="source" type="video/mp4"  src="${lessonVideoUrl}"/>
                                <p class="vjs-no-js">
                                    To view this video please enable JavaScript, and consider upgrading to a
                                    web browser that
                                    <a href="https://videojs.com/html5-video-support/" target="_blank"
                                    >supports HTML5 video</a
                                    >
                                </p>
                            </video>
                    `)
                    }

                    document.getElementById("video_title").innerText = this.getAttribute('data-title');
                    document.getElementById("video_description").innerText = this.getAttribute('data-description');
                    document.getElementById("module_id").value = this.getAttribute('data-module-id');
                    document.getElementById("lesson_id").value = this.getAttribute('data-id');


                    selectedLesson.classList.remove("hidden");

                    // Convert the string to an array
                    const lessonDocumentsArray = JSON.parse(lessonDocumentsString);

                    // Convert the array of paths to an array of objects
                    const lessonDocuments = lessonDocumentsArray.map(documentPath => {
                        return {
                            path: documentPath,
                            name: documentPath.split('/').pop() // Get the file name
                        };
                    });

                    // Now your existing code can be modified to work with lessonDocuments
                    const lessonDownloads = document.getElementById("lesson_downloads");

                    if (Array.isArray(lessonDocuments) && lessonDocuments.length > 0) {
                        console.log(lessonDocuments.length);
                        lessonDocuments.forEach((document,index) => {
                            // Create a unique ID for each download link using the index
                            const fileUrl = `${baseURL}/storage/${document.path}`;
                            const fileName = document.name;

                            if(index === 0) {
                                lessonDownloadLink0.href = fileUrl;
                                lessonDownloadLink0.download = fileName;
                                lessonDownloadLink0.innerText = fileName;
                            }else if(index === 1)
                            {
                                lessonDownloadLink1.href = fileUrl;
                                lessonDownloadLink1.download = fileName;
                                lessonDownloadLink1.innerText = fileName;
                            }else if(index === 2)
                            {
                                lessonDownloadLink2.href = fileUrl;
                                lessonDownloadLink2.download = fileName;
                                lessonDownloadLink2.innerText = fileName;
                            }else if(index === 3)
                            {
                                lessonDownloadLink3.href = fileUrl;
                                lessonDownloadLink3.download = fileName;
                                lessonDownloadLink3.innerText = fileName;
                            }else if(index === 4)
                            {
                                lessonDownloadLink4.href = fileUrl;
                                lessonDownloadLink4.download = fileName;
                                lessonDownloadLink4.innerText = fileName;
                            }else if(index === 5)
                            {
                                lessonDownloadLink5.href = fileUrl;
                                lessonDownloadLink5.download = fileName;
                                lessonDownloadLink5.innerText = fileName;
                            }else if(index === 6)
                            {
                                lessonDownloadLink6.href = fileUrl;
                                lessonDownloadLink6.download = fileName;
                                lessonDownloadLink6.innerText = fileName;
                            }else if(index === 7)
                            {
                                lessonDownloadLink7.href = fileUrl;
                                lessonDownloadLink7.download = fileName;
                                lessonDownloadLink7.innerText = fileName;
                            }else if(index === 8)
                            {
                                lessonDownloadLink8.href = fileUrl;
                                lessonDownloadLink8.download = fileName;
                                lessonDownloadLink8.innerText = fileName;
                            }else if(index === 9)
                            {
                                lessonDownloadLink9.href = fileUrl;
                                lessonDownloadLink9.download = fileName;
                                lessonDownloadLink9.innerText = fileName;
                            }else if(index === 10)
                            {
                                lessonDownloadLink10.href = fileUrl;
                                lessonDownloadLink10.download = fileName;
                                lessonDownloadLink10.innerText = fileName;
                            }


                            //
                        });
                    }

                    // List downloadable documents

                    // if (Array.isArray(lessonDocuments) && lessonDocuments.length > 0 ){
                    //     lessonDocuments.forEach(document => {
                    //         const fileUrl = `${baseURL}/storage/${document.path}`;
                    //         const fileName = document.name;
                    //
                    //         //lessonDownloads.href = fileUrl;
                    //         lessonDownloads.innerText = fileName;
                    //
                    //     });
                    // }

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
                            // document.getElementById('question_asked').innerText = data.quiz.question
                            // document.getElementById('answer_option_a').innerText = data.quiz.answer_option_a;
                            // document.getElementById('answer_option_b').innerText = data.quiz.answer_option_b;
                            // document.getElementById('answer_option_c').innerText = data.quiz.answer_option_c;
                            // document.getElementById('answer_option_d').innerText = data.quiz.answer_option_d;
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

                const percentage = document.getElementById('percentage');
                const questions = document.getElementById('questions');
                const passed = document.getElementById('passed');
                const failed = document.getElementById('failed');

                // Custom form submission logic
                const formData = new FormData(form);
                const formObject = Object.fromEntries(formData.entries()); // Convert FormData to a plain object

                //send for marking
                //code to query module summaries
                const apiUrl = '/api/mark';

                fetch(apiUrl, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(formObject) // Send as JSON
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
                        percentage.innerText = "";
                        questions.innerText = "";
                        passed.innerText = "";
                        failed.innerText = "";

                        // Handle success (status code 200 and success flag is true)
                        //document.getElementById('lessons_details').classList.remove("hidden");
                        document.getElementById("correct").classList.remove("hidden");
                        document.getElementById("wrong").classList.add("hidden");
                        document.getElementById("loading").classList.add("hidden");

                        console.log(data)

                        percentage.innerText = data.pass_percentage + '%';
                        questions.innerText = data.total_questions;
                        passed.innerText = data.total_correct;
                        failed.innerText = data.total_wrong;
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
