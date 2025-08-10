{{-- resources/views/pdf/user-dashboard.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Quiz Performance Dashboard - {{ $user->name }}</title>
    <style>
        @page {
            margin: 2cm;
            @bottom-center {
                content: "Page " counter(page) " of " counter(pages);
                font-size: 12px;
                color: #666;
            }
            @bottom-left {
                content: "Generated: {{ $generated_at }}";
                font-size: 10px;
                color: #666;
            }
            @bottom-right {
                content: "NatSave E-Learning Platform";
                font-size: 10px;
                color: #666;
            }
        }

        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #002D62;
        }

        .logo-section {
            margin-bottom: 20px;
        }

        .title {
            color: #002D62;
            font-size: 28px;
            font-weight: bold;
            margin: 15px 0;
        }

        .user-info {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 25px;
            border: 1px solid #e9ecef;
        }

        .user-name {
            font-size: 20px;
            font-weight: bold;
            color: #002D62;
            margin-bottom: 5px;
        }

        .user-details {
            color: #666;
            font-size: 14px;
        }

        .overall-score {
            float: right;
            text-align: center;
        }

        .score-big {
            font-size: 48px;
            font-weight: bold;
            color: #002D62;
            line-height: 1;
        }

        .score-label {
            font-size: 14px;
            color: #666;
            margin-top: 5px;
        }

        .stats-grid {
            display: table;
            width: 100%;
            margin-bottom: 25px;
        }

        .stats-row {
            display: table-row;
        }

        .stat-cell {
            display: table-cell;
            width: 16.66%;
            padding: 15px;
            text-align: center;
            border: 1px solid #e9ecef;
            background-color: #fff;
        }

        .stat-value {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .stat-value.green { color: #28a745; }
        .stat-value.red { color: #dc3545; }
        .stat-value.blue { color: #007bff; }
        .stat-value.orange { color: #fd7e14; }

        .stat-label {
            font-size: 11px;
            color: #666;
            text-transform: uppercase;
            font-weight: 500;
        }

        .section-title {
            font-size: 18px;
            font-weight: bold;
            color: #002D62;
            margin: 25px 0 15px 0;
            padding-bottom: 8px;
            border-bottom: 2px solid #e9ecef;
        }

        .analytics-grid {
            display: table;
            width: 100%;
            margin-bottom: 25px;
        }

        .analytics-cell {
            display: table-cell;
            width: 25%;
            padding: 20px;
            text-align: center;
            border: 1px solid #e9ecef;
            background-color: #f8f9fa;
        }

        .session-item {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #e9ecef;
            border-radius: 6px;
            background-color: #fff;
            page-break-inside: avoid;
        }

        .session-header {
            display: table;
            width: 100%;
            margin-bottom: 10px;
        }

        .session-info {
            display: table-cell;
            vertical-align: top;
        }

        .session-score {
            display: table-cell;
            text-align: right;
            vertical-align: top;
            width: 120px;
        }

        .session-title {
            font-size: 16px;
            font-weight: bold;
            color: #333;
            margin-bottom: 3px;
        }

        .session-lesson {
            font-size: 14px;
            color: #666;
            margin-bottom: 8px;
        }

        .session-meta {
            font-size: 11px;
            color: #888;
        }

        .score-circle {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: bold;
            color: white;
        }

        .score-circle.passed {
            background-color: #28a745;
        }

        .score-circle.failed {
            background-color: #dc3545;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 5px;
        }

        .status-badge.passed {
            background-color: #d4edda;
            color: #155724;
        }

        .status-badge.failed {
            background-color: #f8d7da;
            color: #721c24;
        }

        .status-badge.manual {
            background-color: #d1ecf1;
            color: #0c5460;
        }

        .status-badge.timeout {
            background-color: #fff3cd;
            color: #856404;
        }

        .summary-box {
            background-color: #f8f9fa;
            border: 2px solid #e9ecef;
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
        }

        .summary-title {
            font-size: 16px;
            font-weight: bold;
            color: #002D62;
            margin-bottom: 15px;
        }

        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }

        .no-sessions {
            text-align: center;
            padding: 40px;
            color: #666;
            font-style: italic;
        }

        /* Print optimizations */
        @media print {
            .page-break { page-break-before: always; }
            .no-break { page-break-inside: avoid; }
        }
    </style>
</head>
<body>
    {{-- Header --}}
    <div class="header">
        <div class="title">Quiz Performance Dashboard</div>
        <div style="color: #666; font-size: 14px;">Comprehensive Learning Analytics Report</div>
    </div>

    {{-- User Information --}}
    <div class="user-info clearfix">
        <div class="overall-score">
            <div class="score-big">{{ $dashboardData['overall_score'] }}%</div>
            <div class="score-label">Overall Score</div>
        </div>
        <div>
            <div class="user-name">{{ $user->name }}</div>
            <div class="user-details">
                <strong>Email:</strong> {{ $user->email }}<br>
                <strong>Member Since:</strong> {{ $user->created_at->format('F Y') }}<br>
                <strong>Report Generated:</strong> {{ $generated_at }}<br>
                <strong>Generated By:</strong> {{ $generated_by }}
            </div>
        </div>
    </div>

    {{-- Overall Statistics --}}
    <div class="section-title">Performance Overview</div>
    <div class="stats-grid">
        <div class="stats-row">
            <div class="stat-cell">
                <div class="stat-value">{{ $dashboardData['total_sessions'] }}</div>
                <div class="stat-label">Total Sessions</div>
            </div>
            <div class="stat-cell">
                <div class="stat-value">{{ $dashboardData['total_questions'] }}</div>
                <div class="stat-label">Questions</div>
            </div>
            <div class="stat-cell">
                <div class="stat-value green">{{ $dashboardData['total_correct'] }}</div>
                <div class="stat-label">Correct</div>
            </div>
            <div class="stat-cell">
                <div class="stat-value orange">{{ $dashboardData['unanswered'] }}</div>
                <div class="stat-label">Unanswered</div>
            </div>
            <div class="stat-cell">
                <div class="stat-value green">{{ $dashboardData['passed_sessions'] }}</div>
                <div class="stat-label">Passed</div>
            </div>
            <div class="stat-cell">
                <div class="stat-value red">{{ $dashboardData['failed_sessions'] }}</div>
                <div class="stat-label">Failed</div>
            </div>
        </div>
    </div>

    {{-- Session Analytics --}}
    <div class="section-title">Session Analytics</div>
    <div class="analytics-grid">
        <div class="analytics-cell">
            <div class="stat-value green">{{ $dashboardData['pass_rate'] }}%</div>
            <div class="stat-label">Pass Rate</div>
        </div>
        <div class="analytics-cell">
            <div class="stat-value blue">{{ $dashboardData['avg_duration_formatted'] }}</div>
            <div class="stat-label">Avg Duration</div>
        </div>
        <div class="analytics-cell">
            <div class="stat-value">{{ $dashboardData['manual_submissions'] }}</div>
            <div class="stat-label">Manual</div>
        </div>
        <div class="analytics-cell">
            <div class="stat-value orange">{{ $dashboardData['timeout_submissions'] }}</div>
            <div class="stat-label">Timeout</div>
        </div>
    </div>

    {{-- Summary Box --}}
    <div class="summary-box">
        <div class="summary-title">Performance Summary</div>
        <p><strong>Overall Achievement:</strong>
            @if($dashboardData['overall_score'] >= 80)
                Excellent performance with {{ $dashboardData['overall_score'] }}% overall score
            @elseif($dashboardData['overall_score'] >= 70)
                Good performance with {{ $dashboardData['overall_score'] }}% overall score
            @elseif($dashboardData['overall_score'] >= 60)
                Satisfactory performance with {{ $dashboardData['overall_score'] }}% overall score
            @else
                Needs improvement - {{ $dashboardData['overall_score'] }}% overall score
            @endif
        </p>
        <p><strong>Session Success Rate:</strong> {{ $dashboardData['passed_sessions'] }} out of {{ $dashboardData['total_sessions'] }} sessions passed ({{ $dashboardData['pass_rate'] }}%)</p>
        <p><strong>Engagement:</strong> {{ $dashboardData['manual_submissions'] }} manual submissions, {{ $dashboardData['timeout_submissions'] }} timeout submissions</p>
    </div>

    {{-- Recent Quiz Sessions --}}
    <div class="section-title page-break">Recent Quiz Sessions</div>

    @if($dashboardData['recent_sessions']->count() > 0)
        @foreach($dashboardData['recent_sessions'] as $session)
            <div class="session-item no-break">
                <div class="session-header">
                    <div class="session-info">
                        <div class="session-title">{{ $session['module_title'] }}</div>
                        <div class="session-lesson">{{ $session['lesson_title'] }}</div>
                        <div class="session-meta">
                            📅 {{ $session['attempted_at'] }} •
                            ⏱️ {{ $session['duration_formatted'] }} •
                            {{ $session['correct_answers'] }}/{{ $session['total_questions'] }} questions
                        </div>
                        <div>
                            <span class="status-badge {{ $session['status'] === 'PASSED' ? 'passed' : 'failed' }}">
                                {{ $session['status'] }}
                            </span>
                            <span class="status-badge {{ $session['submission_type'] === 'Manual' ? 'manual' : 'timeout' }}">
                                {{ $session['submission_type'] === 'Manual' ? '✅ Manual' : '⏰ Timeout' }}
                            </span>
                        </div>
                    </div>
                    <div class="session-score">
                        <div class="score-circle {{ $session['status'] === 'PASSED' ? 'passed' : 'failed' }}">
                            {{ $session['score_percentage'] }}%
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="no-sessions">
            <strong>No quiz sessions found</strong><br>
            This user has not attempted any quizzes yet.
        </div>
    @endif

    {{-- Footer Info --}}
    <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #e9ecef; font-size: 10px; color: #666; text-align: center;">
        <p><strong>NatSave E-Learning Platform</strong> - Comprehensive Learning Analytics</p>
        <p>This report contains confidential information. Please handle with appropriate care.</p>
    </div>
</body>
</html>
