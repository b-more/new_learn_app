<x-filament-panels::page>
    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
    <div>
        <div class="mb-10">
            @livewire(\App\Livewire\StatsOverview::class)
        </div>
        <div class="flex flex-row items-start w-full h-screen">

            <div id="modules" class="w-2/3 h-full px-6 overflow-y-scroll">
                @forelse(auth()->user()->modules as $index => $module)
                    <button id="{{ $module->id }}"
                            class="flex flex-row items-center w-full px-6 py-3 mb-4 space-x-3 bg-green-800 rounded-lg module-button bg-opacity-5 hover:bg-opacity-10 transition-all duration-200"
                            data-title="{{ $module->title }}"
                            data-image-url="{{ $module->icon }}"
                            data-description="{{ $module->description }}">
                        <div class="text-4xl font-extrabold text-green-800 w-2/8">
                            {{ $index+1 }}
                        </div>
                        <div class="w-6/8">
                            <div class="text-sm text-start font-semibold">{{ $module->title }}</div>
                            <div class="text-xs text-gray-500 text-start">{{ $module->description }}</div>
                        </div>
                    </button>
                @empty
                    <div class="text-center py-8">
                        <div class="text-gray-500 text-lg">No modules assigned yet</div>
                        <div class="text-gray-400 text-sm">Contact your administrator to get modules assigned</div>
                    </div>
                @endforelse
            </div>

            <div class="w-1/3 h-full p-6 overflow-y-scroll bg-green-800 rounded bg-opacity-5">
                <div id="content">
                    <!-- Default state -->
                    <div id="default-state" class="text-center py-8">
                        <div class="text-gray-500 text-lg">Select a Module</div>
                        <div class="text-gray-400 text-sm">Click on a module to see its details</div>
                    </div>

                    <!-- Module content -->
                    <div id="module-content" class="hidden">
                        <div>
                            <a id="lessons_link" href="#">
                                <img id="thumbnail"
                                     src=""
                                     alt="Module Image"
                                     class="w-full h-48 object-cover rounded-lg"
                                     style="max-width: 100%; height: auto;"
                                     onerror="this.src='/images/default-module.png'">
                            </a>
                        </div>
                        <div id="title" class="mt-4 text-lg font-semibold text-gray-800"></div>
                        <div id="description" class="mt-2 text-sm text-gray-600"></div>

                        <!-- Loading state -->
                        <div id="loading" class="hidden py-8">
                            <div class="flex flex-col items-center justify-center">
                                <dotlottie-player src="{{ asset('anims/shimmer.json') }}"
                                                background="transparent"
                                                speed="1"
                                                class="w-full h-[300px]"
                                                loop autoplay>
                                </dotlottie-player>
                                <div class="text-gray-500 text-sm mt-2">Loading module details...</div>
                            </div>
                        </div>

                        <!-- Error state -->
                        <div id="error-state" class="hidden py-8 text-center">
                            <div class="text-red-500 text-lg mb-2">Error Loading Module</div>
                            <div id="error-message" class="text-red-400 text-sm mb-4">Failed to load module details</div>
                            <button id="retry-button"
                                    class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition-colors text-sm">
                                Try Again
                            </button>
                        </div>

                        <!-- Module details -->
                        <div id="lessons_details" class="hidden mt-6">
                            <div class="bg-white rounded-lg p-4 mb-4 shadow-sm">
                                <div class="flex flex-row items-center justify-between mb-2">
                                    <div class="text-sm font-bold text-gray-700">Total Lessons</div>
                                    <div id="total_lessons" class="font-extrabold text-lg text-green-600"></div>
                                </div>

                                <!-- Progress bar (if available) -->
                                <div id="progress-container" class="hidden mt-3">
                                    <div class="flex items-center justify-between text-xs text-gray-600 mb-1">
                                        <span>Progress</span>
                                        <span id="progress-percentage">0%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div id="progress-bar" class="bg-green-600 h-2 rounded-full" style="width: 0%"></div>
                                    </div>
                                    <div class="text-xs text-gray-500 mt-1">
                                        <span id="completed-lessons">0</span> of <span id="total-lessons-progress">0</span> lessons completed
                                    </div>
                                </div>
                            </div>

                            <a id="lesson_btn"
                               href="#"
                               class="flex flex-row items-center justify-center px-6 py-3 space-x-3 text-sm font-semibold text-white bg-green-800 rounded-lg hover:bg-green-700 transition-colors">
                                <span>Start Learning</span>
                                <span>→</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.module-button');
            const defaultState = document.getElementById('default-state');
            const moduleContent = document.getElementById('module-content');
            const loadingState = document.getElementById('loading');
            const errorState = document.getElementById('error-state');
            const lessonsDetails = document.getElementById('lessons_details');
            const errorMessage = document.getElementById('error-message');
            const retryButton = document.getElementById('retry-button');

            let currentModuleId = null;

            // Function to show specific state
            function showState(state) {
                [defaultState, loadingState, errorState, lessonsDetails].forEach(el => {
                    if (el) el.classList.add('hidden');
                });

                if (state) {
                    state.classList.remove('hidden');
                }

                if (state !== defaultState) {
                    moduleContent.classList.remove('hidden');
                } else {
                    moduleContent.classList.add('hidden');
                }
            }

            // Function to handle module selection
            function selectModule(button) {
                const moduleId = button.id;
                currentModuleId = moduleId;

                // Update button states
                buttons.forEach(btn => {
                    btn.classList.remove('border-r-8', 'border-green-800', 'border-opacity-80');
                });
                button.classList.add('border-r-8', 'border-green-800', 'border-opacity-80');

                // Get module data
                const title = button.getAttribute('data-title');
                const imageUrl = button.getAttribute('data-image-url');
                const description = button.getAttribute('data-description');

                // Update basic info immediately
                document.getElementById('title').textContent = title;
                document.getElementById('description').textContent = description;
                document.getElementById('lessons_link').href = '/course/assigned-lessons?b=' + moduleId;
                document.getElementById('lesson_btn').href = '/course/assigned-lessons?b=' + moduleId;

                // Set image with fallback
                const thumbnail = document.getElementById('thumbnail');
                if (imageUrl) {
                    thumbnail.src = '/storage/' + imageUrl;
                } else {
                    thumbnail.src = '/images/default-module.png';
                }

                // Show loading state
                showState(loadingState);

                // Fetch module details
                fetchModuleDetails(moduleId);
            }

            // Function to fetch module details from API
            function fetchModuleDetails(moduleId) {
                const apiUrl = '/api/module/lessons';
                const postData = { module_id: moduleId };

                fetch(apiUrl, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                    },
                    body: JSON.stringify(postData)
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        updateModuleDetails(data);
                        showState(lessonsDetails);
                    } else {
                        throw new Error(data.message || 'Failed to load module details');
                    }
                })
                .catch(error => {
                    console.error('Error loading module details:', error);
                    errorMessage.textContent = error.message || 'Failed to load module details. Please try again.';
                    showState(errorState);
                });
            }

            // Function to update module details
            function updateModuleDetails(data) {
                // Update lessons count
                document.getElementById('total_lessons').textContent = data.total_lessons || 0;

                // Update progress if available
                const progressContainer = document.getElementById('progress-container');
                if (data.progress && data.progress.overall_progress !== undefined) {
                    const progress = data.progress.overall_progress;
                    const completedLessons = data.progress.completed_lessons || 0;
                    const totalLessons = data.total_lessons || 0;

                    document.getElementById('progress-percentage').textContent = Math.round(progress) + '%';
                    document.getElementById('progress-bar').style.width = progress + '%';
                    document.getElementById('completed-lessons').textContent = completedLessons;
                    document.getElementById('total-lessons-progress').textContent = totalLessons;

                    progressContainer.classList.remove('hidden');
                } else {
                    progressContainer.classList.add('hidden');
                }
            }

            // Add click listeners to module buttons
            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    selectModule(this);
                });
            });

            // Retry button functionality
            if (retryButton) {
                retryButton.addEventListener('click', function() {
                    if (currentModuleId) {
                        const currentButton = document.getElementById(currentModuleId);
                        if (currentButton) {
                            selectModule(currentButton);
                        }
                    }
                });
            }

            // Auto-select first module if available
            if (buttons.length > 0) {
                selectModule(buttons[0]);
            } else {
                showState(defaultState);
            }
        });
    </script>

    <style>
        /* Custom scrollbar styles */
        #modules::-webkit-scrollbar,
        .overflow-y-scroll::-webkit-scrollbar {
            width: 6px;
        }

        #modules::-webkit-scrollbar-track,
        .overflow-y-scroll::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        #modules::-webkit-scrollbar-thumb,
        .overflow-y-scroll::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 3px;
        }

        #modules::-webkit-scrollbar-thumb:hover,
        .overflow-y-scroll::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        /* Smooth transitions */
        .module-button {
            transition: all 0.2s ease-in-out;
        }

        .module-button:hover {
            transform: translateX(2px);
        }
    </style>
</x-filament-panels::page>
