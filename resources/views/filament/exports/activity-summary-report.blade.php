{{-- resources/views/filament/exports/activity-summary-report.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>User Activity Summary Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #2563eb;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #2563eb;
            margin: 0 0 10px 0;
            font-size: 26px;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        .summary-grid {
            display: table;
            width: 100%;
            margin-bottom: 30px;
        }
        .summary-row {
            display: table-row;
        }
        .summary-cell {
            display: table-cell;
            width: 25%;
            text-align: center;
            padding: 20px;
            background-color: #f8fafc;
            border: 1px solid #e5e7eb;
        }
        .summary-number {
            font-size: 32px;
            font-weight: bold;
            color: #2563eb;
            line-height: 1;
        }
        .summary-label {
            font-size: 11px;
            color: #666;
            text-transform: uppercase;
            margin-top: 5px;
        }
        .section {
            margin-bottom: 30px;
            page-break-inside: avoid;
        }
        .section-title {
            background-color: #2563eb;
            color: white;
            padding: 10px 15px;
            font-weight: bold;
            margin-bottom: 15px;
            font-size: 16px;
        }
        .chart-table {
            width: 100%;
            border-collapse: collapse;
        }
        .chart-table th {
            background-color: #374151;
            color: white;
            padding: 10px;
            text-align: left;
            font-weight: bold;
        }
        .chart-table td {
            padding: 8px 10px;
            border-bottom: 1px solid #e5e7eb;
        }
        .chart-table tr:nth-child(even) {
            background-color: #f9fafb;
        }
        .bar-chart {
            width: 100%;
            height: 20px;
            background-color: #e5e7eb;
            border-radius: 10px;
            overflow: hidden;
            margin: 5px 0;
        }
        .bar-fill {
            height: 100%;
            background-color: #2563eb;
            border-radius: 10px;
        }
        .percentage {
            font-weight: bold;
            color: #2563eb;
        }
        .activity-list {
            background-color: #f9fafb;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
        }
        .activity-item {
            margin-bottom: 8px;
            padding: 8px;
            background-color: white;
            border-radius: 4px;
            border-left: 3px solid #2563eb;
        }
        .activity-time {
            font-size: 10px;
            color: #666;
            float: right;
        }
        .footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 2px solid #e5e7eb;
            text-align: center;
            color: #666;
            font-size: 10px;
        }
        .two-column {
            display: table;
            width: 100%;
        }
        .column {
            display: table-cell;
            width: 50%;
            padding-right: 15px;
            vertical-align: top;
        }
        .column:last-child {
            padding-right: 0;
            padding-left: 15px;
        }
    </style>
</head>
<body>
    {{-- Header --}}
    <div class="header">
        <h1>User Activity Summary Report</h1>
        <p><strong>Report Generated:</strong> {{ $exportDate }}</p>
        <p>Comprehensive overview of user activities and engagement</p>
    </div>

    {{-- Key Metrics --}}
    <div class="summary-grid">
        <div class="summary-row">
            <div class="summary-cell">
                <div class="summary-number">{{ $summary['total_activities'] }}</div>
                <div class="summary-label">Total Activities</div>
            </div>
            <div class="summary-cell">
                <div class="summary-number">{{ $summary['unique_users'] }}</div>
                <div class="summary-label">Active Users</div>
            </div>
            <div class="summary-cell">
                <div class="summary-number">{{ $summary['activity_types']->count() }}</div>
                <div class="summary-label">Activity Types</div>
            </div>
            <div class="summary-cell">
                <div class="summary-number">{{ $summary['module_activities']->count() }}</div>
                <div class="summary-label">Modules Accessed</div>
            </div>
        </div>
    </div>

    {{-- Activity Types Breakdown --}}
    <div class="section">
        <div class="section-title">Activity Types Distribution</div>
        <table class="chart-table">
            <thead>
                <tr>
                    <th>Activity Type</th>
                    <th>Count</th>
                    <th>Percentage</th>
                    <th>Visual Distribution</th>
                </tr>
            </thead>
            <tbody>
                @foreach($summary['activity_types']->sortDesc() as $actionType => $count)
                @php
                    $percentage = round(($count / $summary['total_activities']) * 100, 1);
                @endphp
                <tr>
                    <td>{{ ucwords(str_replace('_', ' ', $actionType)) }}</td>
                    <td>{{ $count }}</td>
                    <td><span class="percentage">{{ $percentage }}%</span></td>
                    <td>
                        <div class="bar-chart">
                            <div class="bar-fill" style="width: {{ $percentage }}%;"></div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Two Column Layout for Module Activities and Top Users --}}
    <div class="two-column">
        <div class="column">
            {{-- Module Activities --}}
            <div class="section">
                <div class="section-title">Module Activities</div>
                <table class="chart-table">
                    <thead>
                        <tr>
                            <th>Module</th>
                            <th>Activities</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($summary['module_activities']->sortDesc()->take(10) as $module => $count)
                        <tr>
                            <td>{{ $module }}</td>
                            <td>{{ $count }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="column">
            {{-- Top Active Users --}}
            <div class="section">
                <div class="section-title">Most Active Users</div>
                <table class="chart-table">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Activities</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($summary['top_users']->take(10) as $user => $count)
                        <tr>
                            <td>{{ $user }}</td>
                            <td>{{ $count }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Daily Activity Trend --}}
    <div class="section">
        <div class="section-title">Daily Activity Trend (Last 10 Days)</div>
        <table class="chart-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Activities</th>
                    <th>Activity Level</th>
                </tr>
            </thead>
            <tbody>
                @foreach($summary['daily_activities']->sortKeysDesc()->take(10) as $date => $count)
                @php
                    $maxDaily = $summary['daily_activities']->max();
                    $percentage = $maxDaily > 0 ? ($count / $maxDaily) * 100 : 0;
                @endphp
                <tr>
                    <td>{{ \Carbon\Carbon::parse($date)->format('M j, Y') }}</td>
                    <td>{{ $count }}</td>
                    <td>
                        <div class="bar-chart">
                            <div class="bar-fill" style="width: {{ $percentage }}%;"></div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Recent Activities Sample --}}
    <div class="section">
        <div class="section-title">Recent Activities Sample</div>
        <div class="activity-list">
            @foreach($summary['recent_activities'] as $activity)
            <div class="activity-item">
                <div class="activity-time">{{ $activity->activity_timestamp->format('M j, H:i') }}</div>
                <strong>{{ $activity->user->name ?? 'Unknown User' }}</strong>
                <span style="color: #666;">{{ $activity->activity }}</span>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Insights and Recommendations --}}
    <div class="section">
        <div class="section-title">Key Insights</div>
        <div class="activity-list">
            <div class="activity-item">
                <strong>Most Active Period:</strong>
                {{ $summary['daily_activities']->sortDesc()->keys()->first() ? \Carbon\Carbon::parse($summary['daily_activities']->sortDesc()->keys()->first())->format('M j, Y') : 'N/A' }}
                ({{ $summary['daily_activities']->sortDesc()->first() }} activities)
            </div>
            <div class="activity-item">
                <strong>Average Activities per User:</strong>
                {{ $summary['unique_users'] > 0 ? round($summary['total_activities'] / $summary['unique_users'], 1) : 0 }}
            </div>
            <div class="activity-item">
                <strong>Most Popular Activity:</strong>
                {{ ucwords(str_replace('_', ' ', $summary['activity_types']->sortDesc()->keys()->first())) }}
                ({{ round(($summary['activity_types']->sortDesc()->first() / $summary['total_activities']) * 100, 1) }}% of all activities)
            </div>
            <div class="activity-item">
                <strong>User Engagement Level:</strong>
                @php
                    $avgActivitiesPerUser = $summary['unique_users'] > 0 ? $summary['total_activities'] / $summary['unique_users'] : 0;
                @endphp
                @if($avgActivitiesPerUser > 50)
                    <span style="color: #059669;">High</span> - Users are highly engaged
                @elseif($avgActivitiesPerUser > 20)
                    <span style="color: #d97706;">Medium</span> - Good user engagement
                @else
                    <span style="color: #dc2626;">Low</span> - Consider engagement strategies
                @endif
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <div class="footer">
        <p>This summary report was generated on {{ $exportDate }}</p>
        <p>User Activity Tracking System - Business Intelligence Report</p>
        <p>Data covers {{ $summary['total_activities'] }} activities from {{ $summary['unique_users'] }} users</p>
    </div>
</body>
</html>
