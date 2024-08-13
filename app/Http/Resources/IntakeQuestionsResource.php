<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IntakeQuestionsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [];
        foreach(parent::toArray($request) as $key => $result)
        {
            if (!array_key_exists($result['code'], $data)) {
                $data[$result['code']] = [
                    'id' => $result['id'],
                    'code' => $result['code'],
                    'question' => $result['question'],
                    'sort_order' => $result['sort_order'],
                    'is_multiple_choice' => $result['is_multiple_choice'],
                    'status' => $result['status'],
                ];
            }

            $data[$result['code']]['answers'][] = [
                'id' => $result['answer_id'],
                'answer' => $result['answer'],
                'order' => $result['answer_order'],
                'next_question_code' => $result['next_question_code'],
                'status' => $result['answer_status'],
            ];
        }

        return $data;
    }
}
