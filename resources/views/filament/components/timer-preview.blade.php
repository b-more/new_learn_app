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
        </div>
    @else
        <div class="text-center py-8">
            <p class="text-gray-500">Timer is disabled for this lesson.</p>
        </div>
    @endif
</div>
