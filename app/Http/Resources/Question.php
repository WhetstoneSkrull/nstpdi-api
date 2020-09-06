<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Question extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      return[
    'id' => $this->id,
    'user_id' => $this->user_id,
    'thematic_areas_id' => $this->thematic_areas_id,
    'question_type' => $this->question_type,
    'question_type' => $this->question_type,
    'is_graded' => $this->is_graded,
    'body' => $this->body,
    'answer' => $this->answer,
    'options' => Option::collection($this->options),
    'subjectarea' => new ThematicAreas($this->subjectarea),

    ];
    }
}
