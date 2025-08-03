<div class="p-6 bg-gray-50 rounded-lg">
    <h3 class="text-lg font-semibold mb-4 text-gray-900">Timer Configuration Preview</h3>

    @if($settings['enabled'])
        <div class="space-y-4">
            <div class="flex items-center justify-between p-3 bg-white rounded border">
                <span class="font-medium text-gray-700">Timer Duration:</span>
                <span class="text-lg font-bold text-blue-600">{{ $lesson->getFormattedTimerDuration() }}</span>
            </div>

            <div class="flex items-center justify-between p-3 bg-white rounded border">
                <span class="font-medium text-gray-700">Auto-submit on timeout:</span>
                <span class="px-2 py-1 text-xs rounded {{ $settings['auto_submit'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ $settings['auto_submit'] ? 'Enabled' : 'Disabled' }}
                </span>
            </div>

            @if($settings['show_warning'])
                <div class="flex items-center justify-between p-3 bg-white rounded border">
                    <span class="font-medium text-gray-700">Warning shown at:</span>
                    <span class="text-orange-600 font-semibold">{{ $settings['warning_time_minutes'] }} minutes remaining</span>
                </div>
            @endif

            <div class="p-4 bg-blue-50 rounded-lg border border-blue-200">
                <h4 class="font-semibold text-blue-900 mb-2">What students will see:</h4>
                <div class="text-sm text-blue-800">
                    <ul class="list-disc list-inside space-y-1">
                        <li>A countdown timer showing remaining time</li>
                        @if($settings['show_warning'])
                            <li>A warning notification when {{ $settings['warning_time_minutes'] }} minutes remain</li>
                        @endif
                        @if($settings['auto_submit'])
                            <li>Automatic submission when time expires</li>
                        @else
                            <li>Quiz will become inactive when time expires (manual submission required before timeout)</li>
                        @endif
                    </ul>
                </div>
            </div>

            <div class="p-3 bg-yellow-50 rounded border border-yellow-200">
                <p class="text-xs text-yellow-800">
                    <strong>Note:</strong> Timer starts when student begins the quiz and applies to all {{ $lesson->quizzes->count() }} questions in this lesson.
                </p>
            </div>
        </div>
    @else
        <div class="text-center py-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-200 rounded-full mb-4">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h4 class="text-lg font-semibold text-gray-600 mb-2">Timer Disabled</h4>
            <p class="text-gray-500">Students can take unlimited time to complete this quiz.</p>
        </div>
    @endif
</div>
