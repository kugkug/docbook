<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\IntakeQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class IntakeQuestionsController extends Controller
{
    public function index() {
        $intakes = [];
        $questions = QueryBuilder::for(IntakeQuestion::class)
        ->select(
            'intake_questions.*', 
            'intake_answers.id as answer_id','intake_answers.question_code',
            'intake_answers.answer', 'intake_answers.sort_order as answer_order',
            'intake_answers.next_question_code', 'intake_answers.status as answer_status')
        ->join('intake_answers', 'intake_answers.question_code', '=', 'intake_questions.code')
        ->defaultSort('intake_questions.sort_order')
        ->get();
        
        foreach($questions as $key => $result)
        {
            if (!array_key_exists($result['code'], $intakes)) {
                $intakes[$result['code']] = [
                    'id' => $result['id'],
                    'code' => $result['code'],
                    'question' => $result['question'],
                    'sort_order' => $result['sort_order'],
                    'is_multiple_choice' => $result['is_multiple_choice'],
                    'status' => $result['status'],
                ];
            }

            $intakes[$result['code']]['answers'][] = [
                'id' => $result['answer_id'],
                'answer' => $result['answer'],
                'order' => $result['answer_order'],
                'next_question_code' => $result['next_question_code'],
                'status' => $result['answer_status'],
            ];
        }
        
        $data = [
            'title' => 'Intakes',
            'header' => 'Intakes',
            'intakes' => $intakes
        ];
        return view("admin.maintenance.intakes.index", $data);
    }
}
