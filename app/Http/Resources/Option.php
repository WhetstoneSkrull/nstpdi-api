<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Option extends JsonResource
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
      'question_id' => $this->question_id,
      'option_body' => $this->option_body,
      'is_correct' => $this->is_correct,

      ];
    }
}
