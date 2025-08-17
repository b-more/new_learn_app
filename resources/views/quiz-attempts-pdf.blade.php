<!DOCTYPE html>
<html>
<head>
    <title>Quiz Attempts Report</title>
    <style>
        @page {
            margin: 2.5cm;
            counter-increment: page;
            @bottom-right {
                content: "Page " counter(page);
                font-family: 'Times New Roman', Times, serif;
                font-size: 12px;
            }
            @bottom-left {
                content: "Generated: {{ $generated_at }}";
                font-family: 'Times New Roman', Times, serif;
                font-size: 12px;
            }
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 14px;
            line-height: 1.4;
            color: #333333;
            margin: 0;
            padding: 0;
        }

        /* Cover page styling */
        .cover-page {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            page-break-after: always;
        }

        .cover-title {
            color: #002D62;
            font-size: 32px;
            margin: 30px 0;
            font-weight: bold;
        }

        .cover-meta {
            color: #555555;
            font-size: 16px;
            margin: 10px 0;
        }

        .confidential-notice {
            margin-top: 50px;
            color: #8B0000;
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
        }

        /* Content styling */
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #002D62;
            padding-bottom: 20px;
        }

        .attempt {
            page-break-before: always;
            margin-bottom: 25px;
            border-bottom: 1px solid #E5E5E5;
            padding-bottom: 20px;
        }

        .question {
            margin: 12px 0;
            padding: 15px 20px;
            page-break-inside: avoid;
            background-color: #F9F9F9;
            border-left: 3px solid #002D62;
        }

        .correct {
            color: #006400;
            font-weight: 500;
        }

        .incorrect {
            color: #8B0000;
            font-weight: 500;
        }

        .score {
            font-weight: bold;
            font-size: 16px;
            color: #002D62;
            margin: 15px 0;
        }

        .meta {
            color: #555555;
            font-size: 13px;
            margin: 8px 0;
        }

        h1 {
            color: #002D62;
            font-size: 24px;
            margin: 15px 0;
            font-weight: bold;
        }

        h3, h4 {
            color: #002D62;
            margin: 12px 0;
            page-break-after: avoid;
        }

        h3 {
            font-size: 18px;
        }

        h4 {
            font-size: 16px;
        }

        p {
            margin: 8px 0;
        }

        /* Prevent orphaned headers */
        h1, h2, h3, h4, h5 {
            page-break-after: avoid;
        }

        /* Prevent orphaned list items */
        li {
            page-break-inside: avoid;
        }

        .doc-info {
            margin-top: 30px;
            font-size: 12px;
            color: #666;
        }

        .summary-box {
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <!-- Cover Page -->
    <div class="cover-page">
        <h1 class="cover-title">Quiz Attempts Report</h1>
        <p class="cover-meta">Student: {{ $user->name }}</p>
        <p class="cover-meta">User ID: {{ $user->id }}</p>
        <p class="cover-meta">Generated: {{ $generated_at }}</p>
        <p class="cover-meta">Document Reference: QAR-{{ date('Ymd') }}-{{ $user->id }}</p>
        <p class="cover-meta">Total Sessions: {{ count($attempts) }}</p>
        <p class="doc-info">Version: 1.0</p>
        <p class="doc-info">Department: E-Learning</p>
        <p class="confidential-notice">Confidential Document</p>
    </div>

    <!-- Summary Page -->
    <div class="header">
        <h1>Quiz Attempts Summary</h1>
        <p class="cover-meta">Student: {{ $user->name }}</p>
    </div>

    @php
        $totalSessions = count($attempts);
        $totalQuestions = 0;
        $totalCorrect = 0;
        $passedSessions = 0;
    @endphp

    <div class="summary-box">
        <h3>Overall Performance Summary</h3>
        @foreach($attempts as $attempt)
            @php
                // Get answers for this session/attempt
                if (isset($attempt->attempt_group_id)) {
                    // Use attempt_group_id if available
                    $answers = \App\Models\AttemptAnswer::where('attempt_group_id', $attempt->attempt_group_id)->get();
                } else {
                    // Fallback to session-based grouping
                    $sessionKey = $attempt->lesson_id . '_' . $attempt->created_at->format('Y-m-d_H-i');
                    $answers = \App\Models\AttemptAnswer::where('user_id', $attempt->user_id)
                        ->where('lesson_id', $attempt->lesson_id)
                        ->whereBetween('created_at', [
                            $attempt->created_at->copy()->startOfHour(),
                            $attempt->created_at->copy()->endOfHour()
                        ])
                        ->get();
                }

                $sessionTotal = $answers->count();
                $sessionCorrect = $answers->where('auto_mark', 1)->count();
                $sessionPercentage = $sessionTotal > 0 ? round(($sessionCorrect / $sessionTotal) * 100, 2) : 0;

                $totalQuestions += $sessionTotal;
                $totalCorrect += $sessionCorrect;
                if ($sessionPercentage >= 70) $passedSessions++;
            @endphp
        @endforeach

        @php
            $overallPercentage = $totalQuestions > 0 ? round(($totalCorrect / $totalQuestions) * 100, 2) : 0;
            $passRate = $totalSessions > 0 ? round(($passedSessions / $totalSessions) * 100, 2) : 0;
        @endphp

        <p><strong>Total Sessions:</strong> {{ $totalSessions }}</p>
        <p><strong>Total Questions Answered:</strong> {{ $totalQuestions }}</p>
        <p><strong>Total Correct Answers:</strong> {{ $totalCorrect }}</p>
        <p><strong>Overall Score:</strong> {{ $overallPercentage }}%</p>
        <p><strong>Sessions Passed:</strong> {{ $passedSessions }}/{{ $totalSessions }} ({{ $passRate }}%)</p>
    </div>

    <!-- Report Content -->
    @foreach($attempts as $attempt)
        @php
            $module = \App\Models\Module::find($attempt->module_id);
            $lesson = \App\Models\Lesson::find($attempt->lesson_id);

            // Get answers for this session/attempt (same logic as above)
            if (isset($attempt->attempt_group_id)) {
                $answers = \App\Models\AttemptAnswer::where('attempt_group_id', $attempt->attempt_group_id)->get();
            } else {
                $answers = \App\Models\AttemptAnswer::where('user_id', $attempt->user_id)
                    ->where('lesson_id', $attempt->lesson_id)
                    ->whereBetween('created_at', [
                        $attempt->created_at->copy()->startOfHour(),
                        $attempt->created_at->copy()->endOfHour()
                    ])
                    ->get();
            }

            $total = $answers->count();
            $correct = $answers->where('auto_mark', 1)->count();
            $percentage = $total > 0 ? round(($correct / $total) * 100, 2) : 0;
        @endphp

        @if($total > 0) {{-- Only show sessions with questions --}}
            <div class="attempt">
                <h3>Module: {{ $module->title ?? 'Unknown Module' }}</h3>
                <h4>Lesson: {{ $lesson->title ?? 'Unknown Lesson' }}</h4>
                <p class="meta">Attempted on: {{ $attempt->created_at->format('F d, Y H:i:s') }}</p>
                <p class="score">Score: {{ $correct }}/{{ $total }} ({{ $percentage }}%) -
                    <span class="{{ $percentage >= 70 ? 'correct' : 'incorrect' }}">
                        {{ $percentage >= 70 ? 'PASSED' : 'FAILED' }}
                    </span>
                </p>

                <h4>Question Details:</h4>
                @foreach($answers as $answer)
                    @php
                        $quiz = \App\Models\Quizz::find($answer->quiz_id);
                    @endphp
                    @if($quiz)
                        <div class="question">
                            <p><strong>Q:</strong> {{ $quiz->question }}</p>

                            @if($quiz->option_a) {{-- Show options if available --}}
                                <p><strong>Options:</strong></p>
                                <p style="margin-left: 20px;">
                                    A. {{ $quiz->option_a }}<br>
                                    B. {{ $quiz->option_b }}<br>
                                    C. {{ $quiz->option_c }}<br>
                                    D. {{ $quiz->option_d }}
                                </p>
                            @endif

                            <p class="{{ $answer->auto_mark ? 'correct' : 'incorrect' }}">
                                <strong>Your Answer:</strong> {{ $answer->user_answer ?? 'Not answered' }}
                                @if(!$answer->auto_mark && $answer->user_answer)
                                    <br><strong>Correct Answer:</strong> {{ $answer->correct_answer ?? $quiz->correct_answer }}
                                @endif
                                <br><strong>Result:</strong> {{ $answer->auto_mark ? 'CORRECT ✓' : 'INCORRECT ✗' }}
                            </p>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif
    @endforeach

    @if($totalSessions == 0)
        <div class="attempt">
            <h3>No Quiz Attempts Found</h3>
            <p>This user has not attempted any quizzes yet.</p>
        </div>
    @endif
</body>
</html>
