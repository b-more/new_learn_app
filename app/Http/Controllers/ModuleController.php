<?php

namespace App\Http\Controllers;

use App\Models\AttemptAnswer;
use App\Models\Lesson;
use App\Models\Quizz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ModuleController extends Controller
{
    public function module(Request $request)
    {
        $request->validate([
            "module_id" => "required"
        ]);

        $total_lessons = Lesson::where("module_id", $request->module_id)->count();

        $custom_response = [
            "success" => true,
            "message" => "Module meta data fetched",
            "id" => $request->module_id,
            "total_lessons" => $total_lessons
        ];

        return response()->json($custom_response, 200);
    }

    public function quiz(Request $request)
    {
        $request->validate([
            "lesson_id" => "required"
        ]);

        $quiz = Quizz::where("lesson_id",$request->lesson_id)->first();

        $custom_response = [
            "success" => true,
            "message" => "Module meta data fetched",
            "quiz" => $quiz
        ];

        return response()->json($custom_response, 200);
    }

    public function marking(Request $request)
    {
        Log::info("Quiz Answers", $request->all());

        $request->validate([
            'user_id' => 'required',
            'lesson_id' => 'required',
            'module_id' => 'required',
            'answer' => 'required'
        ]);

        //check for the correct answer
        if(Quizz::where("lesson_id", $request->lesson_id)->first()->correct_answer == $request->answer){
            //correct answer
            if(AttemptAnswer::where("user_id", $request->user_id)->where("module_id", $request->module_id)->where("lesson_id",$request->lesson_id)->count() > 0)
            {
                //already exist
                $update_answer = AttemptAnswer::where("user_id", $request->user_id)->where("module_id", $request->module_id)->where("lesson_id",$request->lesson_id)->update([
                    'user_answer' => $request->answer,
                    'auto_mark' => 1 //success
                ]);

                $custom_response = [
                    "success" => true,
                    "message" => "Correct answer",
                    "answer" => "Correct"
                ];

                return response()->json($custom_response);
            }else{
                $new_answer = AttemptAnswer::create([
                    "user_id" => $request->user_id,
                    "module_id" => $request->module_id,
                    "lesson_id" => $request->lesson_id,
                    "user_answer" => $request->answer,
                    "auto_mark" => 1 //success
                ]);

                $custom_response = [
                    "success" => true,
                    "message" => "Correct answer",
                    "answer" => "Correct"
                ];

                return response()->json($custom_response);
            }
        }else{
            //wrong answer
            if(AttemptAnswer::where("user_id", $request->user_id)->where("module_id", $request->module_id)->where("lesson_id",$request->lesson_id)->count() > 0)
            {
                //already exist
                $update_answer = AttemptAnswer::where("user_id", $request->user_id)->where("module_id", $request->module_id)->where("lesson_id",$request->lesson_id)->update([
                    'user_answer' => $request->answer,
                    'auto_mark' => 0 //fail
                ]);

                $custom_response = [
                    "success" => true,
                    "message" => "Wrong answer",
                    "answer" => "Wrong"
                ];

                return response()->json($custom_response);
            }else{
                $new_answer = AttemptAnswer::create([
                    "user_id" => $request->user_id,
                    "module_id" => $request->module_id,
                    "lesson_id" => $request->lesson_id,
                    "user_answer" => $request->answer,
                    "auto_mark" => 0 //fail
                ]);

                $custom_response = [
                    "success" => true,
                    "message" => "Wrong answer",
                    "answer" => "Wrong"
                ];

                return response()->json($custom_response);
            }
        }
    }
}
