{{-- resources/views/admin/user-dashboard.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header with User Selection --}}
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-8">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-900">Quiz Performance Dashboard</h1>

                    {{-- Download PDF Button --}}
                    <a href="{{ route('admin.user-dashboard.pdf', $user->id) }}"
                       class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Download PDF Report
                    </a>
                </div>

                {{-- User Selection Dropdown (for admins) --}}
                @if($users->count() > 0)
                <div class="mt-4">
                    <label for="user-select" class="block text-sm font-medium text-gray-700 mb-2">Select User to View Dashboard</label>
                    <select id="user-select" onchange="changeUser(this.value)"
                            class="block w-full max-w-xs px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        @foreach($users as $u)
                            <option value="{{ $u->id }}" {{ $u->id == $user->id ? 'selected' : '' }}>
                                {{ $u->name }} ({{ $u->email }})
                            </option>
                        @endforeach
                    </select>
                </div>
                @endif
            </div>

            {{-- Current User Info --}}
            <div class="px-6 py-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">User: {{ $user->name }}</h2>
                        <p class="text-sm text-gray-600">Member since {{ $user->created_at->format('M Y') }}</p>
                    </div>
                    <div class="text-right">
                        <div class="text-3xl font-bold text-blue-600">{{ $dashboardData['overall_score'] }}%</div>
                        <div class="text-sm text-gray-500">Overall Score</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Statistics Grid --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
            {{-- Total Sessions --}}
            <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
                <div class="text-3xl font-bold text-gray-900 mb-2">{{ $dashboardData['total_sessions'] }}</div>
                <div class="text-sm text-gray-600">Total Sessions</div>
            </div>

            {{-- Questions --}}
            <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
                <div class="text-3xl font-bold text-gray-900 mb-2">{{ $dashboardData['total_questions'] }}</div>
                <div class="text-sm text-gray-600">Questions</div>
            </div>

            {{-- Correct --}}
            <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
                <div class="text-3xl font-bold text-green-600 mb-2">{{ $dashboardData['total_correct'] }}</div>
                <div class="text-sm text-gray-600">Correct</div>
            </div>

            {{-- Unanswered --}}
            <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
                <div class="text-3xl font-bold text-orange-600 mb-2">{{ $dashboardData['unanswered'] }}</div>
                <div class="text-sm text-gray-600">Unanswered</div>
            </div>

            {{-- Passed --}}
            <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
                <div class="text-3xl font-bold text-green-600 mb-2">{{ $dashboardData['passed_sessions'] }}</div>
                <div class="text-sm text-gray-600">Passed</div>
            </div>

            {{-- Failed --}}
            <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
                <div class="text-3xl font-bold text-red-600 mb-2">{{ $dashboardData['failed_sessions'] }}</div>
                <div class="text-sm text-gray-600">Failed</div>
            </div>
        </div>

        {{-- Session Analytics --}}
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-8">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Session Analytics</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    {{-- Pass Rate --}}
                    <div class="text-center">
                        <div class="text-3xl font-bold text-green-600 mb-2">{{ $dashboardData['pass_rate'] }}%</div>
                        <div class="text-sm text-gray-600">Pass Rate</div>
                    </div>

                    {{-- Avg Duration --}}
                    <div class="text-center">
                        <div class="text-3xl font-bold text-blue-600 mb-2">{{ $dashboardData['avg_duration_formatted'] }}</div>
                        <div class="text-sm text-gray-600">Avg Duration</div>
                    </div>

                    {{-- Manual Submissions --}}
                    <div class="text-center">
                        <div class="text-3xl font-bold text-gray-900 mb-2">{{ $dashboardData['manual_submissions'] }}</div>
                        <div class="text-sm text-gray-600">Manual</div>
                    </div>

                    {{-- Timeout Submissions --}}
                    <div class="text-center">
                        <div class="text-3xl font-bold text-orange-600 mb-2">{{ $dashboardData['timeout_submissions'] }}</div>
                        <div class="text-sm text-gray-600">Timeout</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Recent Quiz Sessions --}}
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Recent Quiz Sessions</h3>
            </div>
            <div class="divide-y divide-gray-200">
                @forelse($dashboardData['recent_sessions'] as $session)
                    <div class="p-6 hover:bg-gray-50 transition-colors duration-200">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <h4 class="text-lg font-medium text-gray-900 mb-1">
                                    {{ $session['module_title'] }}
                                </h4>
                                <p class="text-sm text-gray-600 mb-2">
                                    {{ $session['lesson_title'] }}
                                </p>
                                <div class="flex items-center text-sm text-gray-500 space-x-4">
                                    <span>{{ $session['attempted_at'] }}</span>
                                    <span>{{ $session['duration_formatted'] }}</span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        {{ $session['submission_type'] === 'Manual' ? 'bg-green-100 text-green-800' : 'bg-orange-100 text-orange-800' }}">
                                        {{ $session['submission_type'] === 'Manual' ? '✅ Manual Submission' : '⏰ Auto-submitted (Timeout)' }}
                                    </span>
                                </div>
                            </div>
                            <div class="text-right ml-6">
                                <div class="text-3xl font-bold
                                    {{ $session['status'] === 'PASSED' ? 'text-green-600' : 'text-red-600' }} mb-1">
                                    {{ $session['score_percentage'] }}%
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $session['correct_answers'] }}/{{ $session['total_questions'] }}
                                </div>
                                <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium mt-2
                                    {{ $session['status'] === 'PASSED' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $session['status'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center text-gray-500">
                        <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <h3 class="text-sm font-medium text-gray-900 mb-1">No quiz attempts found</h3>
                        <p class="text-sm text-gray-500">This user hasn't attempted any quizzes yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script>
function changeUser(userId) {
    if (userId) {
        window.location.href = "{{ route('admin.user-dashboard', '') }}/" + userId;
    }
}
</script>
@endsection
