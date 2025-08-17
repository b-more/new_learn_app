{{-- resources/views/filament/modals/activity-details.blade.php --}}

<div class="space-y-6">
    {{-- Header Information --}}
    <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Activity Details</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">ID: {{ $record->id }}</p>
            </div>
            <div class="text-right">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    {{ $record->activity_timestamp->format('M j, Y H:i:s') }}
                </p>
                <p class="text-xs text-gray-500 dark:text-gray-500">
                    {{ $record->activity_timestamp->diffForHumans() }}
                </p>
            </div>
        </div>
    </div>

    {{-- Basic Information --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">User</label>
                <p class="mt-1 text-sm text-gray-900 dark:text-white">
                    {{ $record->user->name ?? 'Unknown User' }}
                </p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Action Type</label>
                <span class="mt-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                    @if(in_array($record->action_type, ['module_accessed', 'lesson_accessed', 'quiz_completed']))
                        bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100
                    @elseif(in_array($record->action_type, ['quiz_attempt_started', 'quiz_accessed']))
                        bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100
                    @elseif($record->action_type === 'quiz_error')
                        bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100
                    @else
                        bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100
                    @endif
                ">
                    {{ ucwords(str_replace('_', ' ', $record->action_type)) }}
                </span>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Module</label>
                <p class="mt-1 text-sm text-gray-900 dark:text-white">
                    {{ $record->module ?? 'N/A' }}
                </p>
            </div>

            @if($record->resource_type)
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Resource Type</label>
                <p class="mt-1 text-sm text-gray-900 dark:text-white">
                    {{ ucwords($record->resource_type) }}
                </p>
            </div>
            @endif

            @if($record->resource_id)
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Resource ID</label>
                <p class="mt-1 text-sm text-gray-900 dark:text-white">
                    {{ $record->resource_id }}
                </p>
            </div>
            @endif
        </div>

        <div class="space-y-4">
            @if($record->progress_percentage !== null)
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Progress</label>
                <div class="mt-1">
                    <div class="flex items-center">
                        <div class="flex-1 bg-gray-200 rounded-full h-2 dark:bg-gray-700">
                            <div class="h-2 rounded-full
                                @if($record->progress_percentage >= 70) bg-green-600
                                @elseif($record->progress_percentage >= 50) bg-yellow-600
                                @else bg-red-600 @endif"
                                style="width: {{ $record->progress_percentage }}%">
                            </div>
                        </div>
                        <span class="ml-2 text-sm font-medium text-gray-900 dark:text-white">
                            {{ $record->progress_percentage }}%
                        </span>
                    </div>
                </div>
            </div>
            @endif

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">IP Address</label>
                <p class="mt-1 text-sm text-gray-900 dark:text-white">
                    {{ $record->ip_address ?? 'N/A' }}
                </p>
            </div>

            @if($record->session_id)
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Session ID</label>
                <p class="mt-1 text-sm text-gray-900 dark:text-white font-mono text-xs">
                    {{ $record->session_id }}
                </p>
            </div>
            @endif
        </div>
    </div>

    {{-- Activity Description --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Activity Description</label>
        <p class="mt-1 text-sm text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-800 p-3 rounded-md">
            {{ $record->activity }}
        </p>
    </div>

    {{-- Activity Data --}}
    @if($record->activity_data && count($record->activity_data) > 0)
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Additional Data</label>
        <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4 max-h-96 overflow-y-auto">
            @foreach($record->activity_data as $key => $value)
                <div class="mb-3 last:mb-0">
                    <dt class="text-sm font-medium text-gray-700 dark:text-gray-300">
                        {{ ucwords(str_replace(['_', '-'], ' ', $key)) }}:
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                        @if(is_array($value))
                            @if($key === 'quiz_details')
                                <div class="space-y-2">
                                    @foreach($value as $quiz)
                                        <div class="bg-white dark:bg-gray-700 p-2 rounded border">
                                            <p class="font-medium">Question: {{ $quiz['question_preview'] ?? 'N/A' }}</p>
                                            <p class="text-xs">
                                                User Answer: <span class="font-mono">{{ $quiz['user_answer'] ?? 'N/A' }}</span> |
                                                Correct: <span class="font-mono {{ ($quiz['is_correct'] ?? false) ? 'text-green-600' : 'text-red-600' }}">
                                                    {{ ($quiz['is_correct'] ?? false) ? 'Yes' : 'No' }}
                                                </span>
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                            @elseif($key === 'progress_details')
                                <div class="grid grid-cols-2 gap-2 text-xs">
                                    @foreach($value as $subKey => $subValue)
                                        <div>
                                            <span class="font-medium">{{ ucwords(str_replace('_', ' ', $subKey)) }}:</span>
                                            {{ $subValue }}
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <pre class="whitespace-pre-wrap text-xs bg-white dark:bg-gray-700 p-2 rounded border font-mono">{{ json_encode($value, JSON_PRETTY_PRINT) }}</pre>
                            @endif
                        @elseif(is_bool($value))
                            <span class="{{ $value ? 'text-green-600' : 'text-red-600' }}">
                                {{ $value ? 'Yes' : 'No' }}
                            </span>
                        @else
                            {{ $value }}
                        @endif
                    </dd>
                </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- User Agent --}}
    @if($record->user_agent)
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">User Agent</label>
        <p class="mt-1 text-xs text-gray-600 dark:text-gray-400 bg-gray-50 dark:bg-gray-800 p-2 rounded font-mono">
            {{ $record->user_agent }}
        </p>
    </div>
    @endif
</div>
