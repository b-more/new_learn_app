{{-- resources/views/filament/exports/activities-pdf.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>User Activities Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            line-height: 1.3;
            color: #333;
            margin: 0;
            padding: 15px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        .header h1 {
            color: #2563eb;
            margin: 0 0 8px 0;
            font-size: 22px;
        }
        .header p {
            margin: 3px 0;
            color: #666;
            font-size: 12px;
        }
        .summary-box {
            background-color: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 25px;
        }
        .summary-grid {
            display: table;
            width: 100%;
        }
        .summary-row {
            display: table-row;
        }
        .summary-cell {
            display: table-cell;
            width: 25%;
            text-align: center;
            padding: 8px;
        }
        .summary-number {
            font-size: 20px;
            font-weight: bold;
            color: #2563eb;
        }
        .summary-label {
            font-size: 10px;
            color: #666;
            text-transform: uppercase;
        }
        .section {
            margin-bottom: 20px;
            page-break-inside: avoid;
        }
        .section-title {
            background-color: #f8fafc;
            padding: 6px 10px;
            border-left: 3px solid #2563eb;
            font-weight: bold;
            margin-bottom: 12px;
            font-size: 13px;
        }
        .activities-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
        }
        .activities-table th {
            background-color: #374151;
            color: white;
            padding: 8px 6px;
            text-align: left;
            font-weight: bold;
            font-size: 9px;
        }
        .activities-table td {
            padding: 6px;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: top;
        }
        .activities-table tr:nth-child(even) {
            background-color: #f9fafb;
        }
        .badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 8px;
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .badge-success { background-color: #dcfce7; color: #166534; }
        .badge-warning { background-color: #fef3c7; color: #92400e; }
        .badge-danger { background-color: #fecaca; color: #991b1b; }
        .badge-primary { background-color: #dbeafe; color: #1e40af; }
        .user-section {
            margin-bottom: 25px;
            page-break-inside: avoid;
        }
        .user-header {
            background-color: #2563eb;
            color: white;
            padding: 8px 12px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .progress-indicator {
            width: 40px;
            height: 8px;
            background-color: #e5e7eb;
            border-radius: 4px;
            overflow: hidden;
            display: inline-block;
            vertical-align: middle;
        }
        .progress-fill {
            height: 100%;
            border-radius: 4px;
        }
        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            color: #666;
            font-size: 9px;
        }
        .page-break {
            page-break-before: always;
        }
        .activity-description {
            max-width: 200px;
            word-wrap: break-word;
        }
    </style>
</head>
<body>
    {{-- Header --}}
    <div class="header">
        <h1>User Activities Report</h1>
        <p><strong>Total Activities:</strong> {{ $totalActivities }}</p>
        @if(isset($dateRange['from']) && isset($dateRange['to']))
        <p><strong>Date Range:</strong> {{ $dateRange['from'] }} - {{ $dateRange['to'] }}</p>
        @endif
        <p><strong>Generated:</strong> {{ $exportDate }}</p>
    </div>

    {{-- Summary Statistics --}}
    <div class="summary-box">
        <div class="summary-grid">
            <div class="summary-row">
                <div class="summary-cell">
                    <div class="summary-number">{{ $totalActivities }}</div>
                    <div class="summary-label">Total Activities</div>
                </div>
                <div class="summary-cell">
                    <div class="summary-number">{{ $activities->unique('user_id')->count() }}</div>
                    <div class="summary-label">Unique Users</div>
                </div>
                <div class="summary-cell">
                    <div class="summary-number">{{ $activities->unique('action_type')->count() }}</div>
                    <div class="summary-label">Activity Types</div>
                </div>
                <div class="summary-cell">
                    <div class="summary-number">{{ $activities->whereNotNull('module')->unique('module')->count() }}</div>
                    <div class="summary-label">Modules Accessed</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Activity Type Breakdown --}}
    <div class="section">
        <div class="section-title">Activity Type Breakdown</div>
        <table class="activities-table">
            <thead>
                <tr>
                    <th>Activity Type</th>
                    <th>Count</th>
                    <th>Percentage</th>
                </tr>
            </thead>
            <tbody>
                @foreach($activities->groupBy('action_type') as $actionType => $typeActivities)
                <tr>
                    <td>{{ ucwords(str_replace('_', ' ', $actionType)) }}</td>
                    <td>{{ $typeActivities->count() }}</td>
                    <td>{{ round(($typeActivities->count() / $totalActivities) * 100, 1) }}%</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Activities by User (if grouped) --}}
    @if(isset($groupedActivities) && $groupedActivities->count() > 0)
    @foreach($groupedActivities as $userName => $userActivities)
    <div class="user-section">
        <div class="user-header">
            {{ $userName }} ({{ $userActivities->count() }} activities)
        </div>
        <table class="activities-table">
            <thead>
                <tr>
                    <th>Date/Time</th>
                    <th>Action</th>
                    <th>Module</th>
                    <th>Description</th>
                    <th>Progress</th>
                </tr>
            </thead>
            <tbody>
                @foreach($userActivities->sortByDesc('activity_timestamp')->take(20) as $activity)
                <tr>
                    <td style="white-space: nowrap;">{{ $activity->activity_timestamp->format('m/d H:i') }}</td>
                    <td>
                        <span class="badge
                            @if(in_array($activity->action_type, ['module_accessed', 'lesson_accessed', 'quiz_completed'])) badge-success
                            @elseif(in_array($activity->action_type, ['quiz_attempt_started', 'quiz_accessed'])) badge-warning
                            @elseif($activity->action_type === 'quiz_error') badge-danger
                            @else badge-primary @endif
                        ">
                            {{ ucwords(str_replace('_', ' ', $activity->action_type)) }}
                        </span>
                    </td>
                    <td>{{ $activity->module ?? '-' }}</td>
                    <td class="activity-description">{{ Str::limit($activity->activity, 80) }}</td>
                    <td>
                        @if($activity->progress_percentage !== null)
                            <div class="progress-indicator">
                                <div class="progress-fill" style="
                                    width: {{ $activity->progress_percentage }}%;
                                    background-color:
                                        @if($activity->progress_percentage >= 70) #059669
                                        @elseif($activity->progress_percentage >= 50) #d97706
                                        @else #dc2626 @endif;
                                "></div>
                            </div>
                            {{ $activity->progress_percentage }}%
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @endforeach
                @if($userActivities->count() > 20)
                <tr>
                    <td colspan="5" style="text-align: center; font-style: italic; color: #666;">
                        ... and {{ $userActivities->count() - 20 }} more activities
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
    @if(!$loop->last)
    <div class="page-break"></div>
    @endif
    @endforeach
    @else
    {{-- All Activities Table (if not grouped) --}}
    <div class="section">
        <div class="section-title">All Activities</div>
        <table class="activities-table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Date/Time</th>
                    <th>Action</th>
                    <th>Module</th>
                    <th>Description</th>
                    <th>Progress</th>
                </tr>
            </thead>
            <tbody>
                @foreach($activities->take(100) as $activity)
                <tr>
                    <td>{{ $activity->user->name ?? 'Unknown' }}</td>
                    <td style="white-space: nowrap;">{{ $activity->activity_timestamp->format('m/d H:i') }}</td>
                    <td>
                        <span class="badge
                            @if(in_array($activity->action_type, ['module_accessed', 'lesson_accessed', 'quiz_completed'])) badge-success
                            @elseif(in_array($activity->action_type, ['quiz_attempt_started', 'quiz_accessed'])) badge-warning
                            @elseif($activity->action_type === 'quiz_error') badge-danger
                            @else badge-primary @endif
                        ">
                            {{ ucwords(str_replace('_', ' ', $activity->action_type)) }}
                        </span>
                    </td>
                    <td>{{ $activity->module ?? '-' }}</td>
                    <td class="activity-description">{{ Str::limit($activity->activity, 60) }}</td>
                    <td>
                        @if($activity->progress_percentage !== null)
                            <div class="progress-indicator">
                                <div class="progress-fill" style="
                                    width: {{ $activity->progress_percentage }}%;
                                    background-color:
                                        @if($activity->progress_percentage >= 70) #059669
                                        @elseif($activity->progress_percentage >= 50) #d97706
                                        @else #dc2626 @endif;
                                "></div>
                            </div>
                            {{ $activity->progress_percentage }}%
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @endforeach
                @if($activities->count() > 100)
                <tr>
                    <td colspan="6" style="text-align: center; font-style: italic; color: #666; padding: 15px;">
                        ... and {{ $activities->count() - 100 }} more activities (showing first 100)
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
    @endif

    {{-- Footer --}}
    <div class="footer">
        <p>This report was generated on {{ $exportDate }}</p>
        <p>User Activity Tracking System - Confidential</p>
    </div>
</body>
</html>
