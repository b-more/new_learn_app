{{-- resources/views/filament/exports/single-activity-pdf.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Activity Details Report</title>
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
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #2563eb;
            margin: 0 0 10px 0;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        .section {
            margin-bottom: 25px;
            page-break-inside: avoid;
        }
        .section-title {
            background-color: #f8fafc;
            padding: 8px 12px;
            border-left: 4px solid #2563eb;
            font-weight: bold;
            margin-bottom: 15px;
            font-size: 14px;
        }
        .info-grid {
            display: table;
            width: 100%;
            border-collapse: collapse;
        }
        .info-row {
            display: table-row;
        }
        .info-label {
            display: table-cell;
            width: 30%;
            padding: 8px;
            font-weight: bold;
            background-color: #f8fafc;
            border: 1px solid #e5e7eb;
            vertical-align: top;
        }
        .info-value {
            display: table-cell;
            padding: 8px;
            border: 1px solid #e5e7eb;
            vertical-align: top;
        }
        .progress-bar {
            width: 100%;
            height: 20px;
            background-color: #e5e7eb;
            border-radius: 10px;
            overflow: hidden;
            position: relative;
        }
        .progress-fill {
            height: 100%;
            border-radius: 10px;
        }
        .progress-text {
            position: absolute;
            width: 100%;
            text-align: center;
            line-height: 20px;
            font-weight: bold;
            font-size: 11px;
        }
        .badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .badge-success { background-color: #dcfce7; color: #166534; }
        .badge-warning { background-color: #fef3c7; color: #92400e; }
        .badge-danger { background-color: #fecaca; color: #991b1b; }
        .badge-primary { background-color: #dbeafe; color: #1e40af; }
        .data-section {
            background-color: #f9fafb;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
        }
        .quiz-details {
            margin-top: 10px;
        }
        .quiz-item {
            background-color: white;
            padding: 10px;
            margin-bottom: 8px;
            border-radius: 4px;
            border: 1px solid #d1d5db;
        }
        .correct { color: #059669; font-weight: bold; }
        .incorrect { color: #dc2626; font-weight: bold; }
        .footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            color: #666;
            font-size: 10px;
        }
        pre {
            background-color: #f3f4f6;
            padding: 10px;
            border-radius: 4px;
            font-size: 10px;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
    </style>
</head>
<body>
    {{-- Header --}}
    <div class="header">
        <h1>User Activity Details Report</h1>
        <p><strong>Activity ID:</strong> {{ $activity->id }}</p>
        <p><strong>Generated:</strong> {{ $exportDate }}</p>
    </div>

    {{-- Basic Information --}}
    <div class="section">
        <div class="section-title">Basic Information</div>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">User</div>
                <div class="info-value">{{ $activity->user->name ?? 'Unknown User' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Action Type</div>
                <div class="info-value">
                    <span class="badge
                        @if(in_array($activity->action_type, ['module_accessed', 'lesson_accessed', 'quiz_completed'])) badge-success
                        @elseif(in_array($activity->action_type, ['quiz_attempt_started', 'quiz_accessed'])) badge-warning
                        @elseif($activity->action_type === 'quiz_error') badge-danger
                        @else badge-primary @endif
                    ">
                        {{ ucwords(str_replace('_', ' ', $activity->action_type)) }}
                    </span>
                </div>
            </div>
            <div class="info-row">
                <div class="info-label">Module</div>
                <div class="info-value">{{ $activity->module ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Date & Time</div>
                <div class="info-value">{{ $activity->activity_timestamp->format('M j, Y H:i:s') }}</div>
            </div>
            @if($activity->resource_type)
            <div class="info-row">
                <div class="info-label">Resource Type</div>
                <div class="info-value">{{ ucwords($activity->resource_type) }}</div>
            </div>
            @endif
            @if($activity->resource_id)
            <div class="info-row">
                <div class="info-label">Resource ID</div>
                <div class="info-value">{{ $activity->resource_id }}</div>
            </div>
            @endif
            @if($activity->progress_percentage !== null)
            <div class="info-row">
                <div class="info-label">Progress</div>
                <div class="info-value">
                    <div class="progress-bar">
                        <div class="progress-fill" style="
                            width: {{ $activity->progress_percentage }}%;
                            background-color:
                                @if($activity->progress_percentage >= 70) #059669
                                @elseif($activity->progress_percentage >= 50) #d97706
                                @else #dc2626 @endif;
                        "></div>
                        <div class="progress-text">{{ $activity->progress_percentage }}%</div>
                    </div>
                </div>
            </div>
            @endif
            <div class="info-row">
                <div class="info-label">IP Address</div>
                <div class="info-value">{{ $activity->ip_address ?? 'N/A' }}</div>
            </div>
        </div>
    </div>

    {{-- Activity Description --}}
    <div class="section">
        <div class="section-title">Activity Description</div>
        <div class="data-section">
            {{ $activity->activity }}
        </div>
    </div>

    {{-- Additional Data --}}
    @if($activity->activity_data && count($activity->activity_data) > 0)
    <div class="section">
        <div class="section-title">Additional Details</div>
        <div class="data-section">
            @foreach($activity->activity_data as $key => $value)
                <div style="margin-bottom: 15px;">
                    <strong>{{ ucwords(str_replace(['_', '-'], ' ', $key)) }}:</strong><br>
                    @if(is_array($value))
                        @if($key === 'quiz_details' && isset($value[0]['quiz_id']))
                            <div class="quiz-details">
                                @foreach($value as $index => $quiz)
                                    <div class="quiz-item">
                                        <strong>Question {{ $index + 1 }}:</strong> {{ $quiz['question_preview'] ?? 'N/A' }}<br>
                                        <strong>User Answer:</strong> {{ $quiz['user_answer'] ?? 'N/A' }}<br>
                                        <strong>Result:</strong>
                                        <span class="{{ ($quiz['is_correct'] ?? false) ? 'correct' : 'incorrect' }}">
                                            {{ ($quiz['is_correct'] ?? false) ? 'Correct' : 'Incorrect' }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @elseif($key === 'progress_details')
                            @foreach($value as $subKey => $subValue)
                                <div><strong>{{ ucwords(str_replace('_', ' ', $subKey)) }}:</strong> {{ $subValue }}</div>
                            @endforeach
                        @else
                            <pre>{{ json_encode($value, JSON_PRETTY_PRINT) }}</pre>
                        @endif
                    @elseif(is_bool($value))
                        <span class="{{ $value ? 'correct' : 'incorrect' }}">{{ $value ? 'Yes' : 'No' }}</span>
                    @else
                        {{ $value }}
                    @endif
                </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Session Information --}}
    @if($activity->session_id || $activity->user_agent)
    <div class="section">
        <div class="section-title">Session Information</div>
        <div class="info-grid">
            @if($activity->session_id)
            <div class="info-row">
                <div class="info-label">Session ID</div>
                <div class="info-value" style="font-family: monospace; font-size: 10px;">{{ $activity->session_id }}</div>
            </div>
            @endif
            @if($activity->user_agent)
            <div class="info-row">
                <div class="info-label">User Agent</div>
                <div class="info-value" style="font-family: monospace; font-size: 10px; word-break: break-all;">{{ $activity->user_agent }}</div>
            </div>
            @endif
        </div>
    </div>
    @endif

    {{-- Footer --}}
    <div class="footer">
        <p>This report was generated on {{ $exportDate }}</p>
        <p>User Activity Tracking System - Confidential</p>
    </div>
</body>
</html>
