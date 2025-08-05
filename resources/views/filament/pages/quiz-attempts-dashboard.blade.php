<x-filament-panels::page>
    <div class="space-y-6">
        {{-- User Selection Dropdown --}}
        <div class="bg-white rounded-lg border p-4">
            <label for="user-select" class="block text-sm font-medium text-gray-700 mb-2">
                Select User to View Dashboard
            </label>
            <select wire:model.live="selectedUserId" id="user-select"
                    class="block w-full md:w-96 rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>

        {{-- Dashboard Content --}}
        @if($selectedUserId && $selectedUser)
            @php
                $userId = $selectedUserId;

                // Get all attempts grouped by session
                $allAttempts = \App\Models\AttemptAnswer::where('user_id', $userId)
                    ->with(['quiz', 'lesson', 'module'])
                    ->orderBy('created_at', 'desc')
                    ->get();

                // Group by sessions (lesson + date)
                $sessions = $allAttempts->groupBy(function($item) {
                    return $item->lesson_id . '_' . $item->created_at->format('Y-m-d_H');
                });

                // Calculate overall statistics
                $totalSessions = $sessions->count();
                $totalQuestions = $allAttempts->count();
                $totalCorrect = $allAttempts->where('auto_mark', 1)->count();
                $totalAnswered = $allAttempts->where('was_answered', true)->count() ?? $totalQuestions;
                $totalUnanswered = $totalQuestions - $totalAnswered;
                $overallPercentage = $totalQuestions > 0 ? round(($totalCorrect / $totalQuestions) * 100, 2) : 0;

                // Session statistics
                $passedSessions = 0;
                $failedSessions = 0;
                $timeoutSessions = 0;
                $manualSessions = 0;
                $totalDuration = 0;

                foreach($sessions as $sessionAnswers) {
                    $sessionTotal = $sessionAnswers->count();
                    $sessionCorrect = $sessionAnswers->where('auto_mark', 1)->count();
                    $sessionPercentage = $sessionTotal > 0 ? round(($sessionCorrect / $sessionTotal) * 100, 2) : 0;

                    if($sessionPercentage >= 70) $passedSessions++;
                    else $failedSessions++;

                    $isTimeout = in_array($sessionAnswers->first()->attempt_status, ['timed_out', 'expired']);
                    if($isTimeout) $timeoutSessions++;
                    else $manualSessions++;

                    $startTime = $sessionAnswers->min('created_at');
                    $endTime = $sessionAnswers->max('updated_at');
                    $totalDuration += $startTime->diffInSeconds($endTime);
                }

                $avgDuration = $totalSessions > 0 ? $totalDuration / $totalSessions : 0;

                // Recent activity (last 7 days)
                $recentAttempts = $allAttempts->where('created_at', '>=', now()->subDays(7));
                $recentSessions = $recentAttempts->groupBy(function($item) {
                    return $item->lesson_id . '_' . $item->created_at->format('Y-m-d_H');
                })->count();

                // Module performance
                $moduleStats = $allAttempts->groupBy('module_id')->map(function($moduleAttempts) {
                    $total = $moduleAttempts->count();
                    $correct = $moduleAttempts->where('auto_mark', 1)->count();
                    $percentage = $total > 0 ? round(($correct / $total) * 100, 2) : 0;
                    $module = $moduleAttempts->first()->module;
                    return [
                        'module' => $module,
                        'total' => $total,
                        'correct' => $correct,
                        'percentage' => $percentage
                    ];
                })->sortByDesc('percentage');
            @endphp

            {{-- Header with User Info --}}
            <div class="bg-gradient-to-r from-gray-50 to-blue-50 rounded-lg p-6 border border-blue-200">
                <div class="flex justify-between items-start">
                    <div>
                        <h2 class="text-2xl font-bold mb-2 text-gray-900">Quiz Performance Dashboard</h2>
                        <p class="text-gray-700">User: {{ $selectedUser->name ?? 'Unknown User' }}</p>
                        <p class="text-gray-600 text-sm">Member since {{ $selectedUser->created_at->format('M Y') }}</p>
                    </div>
                    <div class="text-right">
                        <div class="text-3xl font-bold text-blue-600">{{ $overallPercentage }}%</div>
                        <div class="text-gray-700">Overall Score</div>
                    </div>
                </div>
            </div>

            {{-- Quick Stats Grid --}}
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                <div class="bg-white rounded-lg border p-4 text-center">
                    <div class="text-2xl font-bold text-blue-600">{{ $totalSessions }}</div>
                    <div class="text-sm text-gray-600">Total Sessions</div>
                </div>

                <div class="bg-white rounded-lg border p-4 text-center">
                    <div class="text-2xl font-bold text-gray-800">{{ $totalQuestions }}</div>
                    <div class="text-sm text-gray-600">Questions</div>
                </div>

                <div class="bg-white rounded-lg border p-4 text-center">
                    <div class="text-2xl font-bold text-green-600">{{ $totalCorrect }}</div>
                    <div class="text-sm text-gray-600">Correct</div>
                </div>

                <div class="bg-white rounded-lg border p-4 text-center">
                    <div class="text-2xl font-bold text-orange-600">{{ $totalUnanswered }}</div>
                    <div class="text-sm text-gray-600">Unanswered</div>
                </div>

                <div class="bg-white rounded-lg border p-4 text-center">
                    <div class="text-2xl font-bold text-green-600">{{ $passedSessions }}</div>
                    <div class="text-sm text-gray-600">Passed</div>
                </div>

                <div class="bg-white rounded-lg border p-4 text-center">
                    <div class="text-2xl font-bold text-red-600">{{ $failedSessions }}</div>
                    <div class="text-sm text-gray-600">Failed</div>
                </div>
            </div>

            {{-- Session Performance Section --}}
            <div class="bg-white rounded-lg border p-6">
                <h3 class="text-lg font-semibold mb-4">Session Analytics</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="text-center p-4 bg-gray-50 rounded">
                        <div class="text-xl font-bold text-green-600">
                            {{ $totalSessions > 0 ? round(($passedSessions / $totalSessions) * 100, 1) : 0 }}%
                        </div>
                        <div class="text-sm text-gray-600">Pass Rate</div>
                    </div>

                    <div class="text-center p-4 bg-gray-50 rounded">
                        <div class="text-xl font-bold">{{ gmdate('i:s', $avgDuration) }}</div>
                        <div class="text-sm text-gray-600">Avg Duration</div>
                    </div>

                    <div class="text-center p-4 bg-gray-50 rounded">
                        <div class="text-xl font-bold text-blue-600">{{ $manualSessions }}</div>
                        <div class="text-sm text-gray-600">Manual</div>
                    </div>

                    <div class="text-center p-4 bg-gray-50 rounded">
                        <div class="text-xl font-bold text-orange-600">{{ $timeoutSessions }}</div>
                        <div class="text-sm text-gray-600">Timeout</div>
                    </div>
                </div>
            </div>

            {{-- Recent Sessions --}}
            <div class="bg-white rounded-lg border p-6">
                <h3 class="text-lg font-semibold mb-4">Recent Quiz Sessions</h3>

                <div class="space-y-3">
                    @forelse($sessions->take(5) as $sessionId => $sessionAnswers)
                        @php
                            $firstAnswer = $sessionAnswers->first();
                            $module = $firstAnswer->module;
                            $lesson = $firstAnswer->lesson;
                            $sessionTotal = $sessionAnswers->count();
                            $sessionCorrect = $sessionAnswers->where('auto_mark', 1)->count();
                            $sessionPercentage = $sessionTotal > 0 ? round(($sessionCorrect / $sessionTotal) * 100, 2) : 0;
                            $submissionType = $firstAnswer->attempt_status ?? 'completed';
                        @endphp

                        <div class="flex items-center justify-between p-4 border rounded-lg hover:bg-gray-50 transition-colors">
                            <div class="flex items-center gap-4">
                                <div class="w-2 h-2 rounded-full {{ $sessionPercentage >= 70 ? 'bg-green-500' : 'bg-red-500' }}"></div>
                                <div>
                                    <div class="font-medium">{{ $module->title ?? 'Unknown Module' }}</div>
                                    <div class="text-sm text-gray-600">{{ $lesson->title ?? 'Unknown Lesson' }}</div>
                                    <div class="text-xs text-gray-500">{{ $firstAnswer->created_at->format('M j, Y g:i A') }}</div>
                                </div>
                            </div>

                            <div class="text-right">
                                <div class="font-bold {{ $sessionPercentage >= 70 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $sessionPercentage }}%
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ $sessionCorrect }}/{{ $sessionTotal }}
                                </div>
                                @if(in_array($submissionType, ['timed_out', 'expired']))
                                    <div class="text-xs text-orange-600">Auto-submitted</div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-gray-500 text-center py-8">No quiz sessions found</div>
                    @endforelse
                </div>

                @if($sessions->count() > 5)
                    <div class="mt-4 text-center">
                        <span class="text-gray-500 text-sm">
                            Showing 5 of {{ $sessions->count() }} total sessions
                        </span>
                    </div>
                @endif
            </div>
        @else
            <div class="text-center py-12 bg-gray-50 rounded-lg">
                <h3 class="mt-2 text-sm font-medium text-gray-900">No user selected</h3>
                <p class="mt-1 text-sm text-gray-500">Select a user from the dropdown above to view their quiz dashboard.</p>
            </div>
        @endif
    </div>
</x-filament-panels::page>
