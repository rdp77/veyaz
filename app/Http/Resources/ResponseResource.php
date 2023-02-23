<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ResponseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = $this->resource;
        $data->encryptId = encrypt($this->id);
        $data->deletedAt = $this->deleted_at ? $this->deleted_at->isoFormat('DD MMM Y H:m:s') : null;
        $data->createdAt = $this->created_at->isoFormat('DD MMM Y H:m:s');
        $data->updatedAt = $this->updated_at->isoFormat('DD MMM Y H:m:s');
        return $data;
    }
}
