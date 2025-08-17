<div class="space-y-6">
    <!-- User Summary -->
    <div class="bg-gray-50 rounded-lg p-4">
        <h3 class="font-semibold text-gray-900 mb-2">{{ $user->name }}</h3>
        <p class="text-sm text-gray-600">{{ $user->email }} • {{ $user->role->name ?? 'No role' }}</p>
    </div>

    <!-- Statistics Grid -->
    <div class="grid grid-cols-2 gap-4">
        <!-- Quiz Stats -->
        <div class="bg-blue-50 rounded-lg p-4 text-center">
            <div class="text-2xl font-bold text-blue-600">{{ $totalSessions }}</div>
            <div class="text-sm text-blue-700">Quiz Sessions</div>
        </div>

        <div class="bg-green-50 rounded-lg p-4 text-center">
            <div class="text-2xl font-bold text-green-600">{{ $avgPercentage }}%</div>
            <div class="text-sm text-green-700">Average Score</div>
        </div>

        <!-- Module Stats -->
        <div class="bg-purple-50 rounded-lg p-4 text-center">
            <div class="text-2xl font-bold text-purple-600">{{ $completedModules }}/{{ $totalModules }}</div>
            <div class="text-sm text-purple-700">Modules Completed</div>
        </div>

        <div class="bg-orange-50 rounded-lg p-4 text-center">
            <div class="text-2xl font-bold text-orange-600">{{ $moduleProgress }}%</div>
            <div class="text-sm text-orange-700">Overall Progress</div>
        </div>
    </div>

    <!-- Activity Info -->
    <div class="bg-yellow-50 rounded-lg p-4">
        <h4 class="font-medium text-yellow-900 mb-1">Last Activity</h4>
        <p class="text-sm text-yellow-700">{{ $lastActivity }}</p>
    </div>

    <!-- Call to Action -->
    <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg p-4 text-white text-center">
        <h4 class="font-semibold mb-2">Ready for detailed analytics?</h4>
        <p class="text-sm opacity-90">Close this modal and click "Performance Dashboard" for comprehensive insights</p>
    </div>
</div>
