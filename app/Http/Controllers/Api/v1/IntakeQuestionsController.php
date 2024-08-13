<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\IntakeQuestionsResource;
use App\Models\IntakeQuestions;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class IntakeQuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = QueryBuilder::for(IntakeQuestions::class)
        ->select(
            'intake_questions.*', 
            'intake_answers.id as answer_id','intake_answers.question_code',
            'intake_answers.answer', 'intake_answers.sort_order as answer_order',
            'intake_answers.next_question_code', 'intake_answers.status as answer_status')
        ->join('intake_answers', 'intake_answers.question_code', '=', 'intake_questions.code')
        ->defaultSort('intake_questions.sort_order')
        ->get();

        return new IntakeQuestionsResource($questions);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(IntakeQuestions $intakeQuestions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IntakeQuestions $intakeQuestions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IntakeQuestions $intakeQuestions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IntakeQuestions $intakeQuestions)
    {
        //
    }
}
