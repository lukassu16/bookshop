<?php

namespace App\Http\Resources\V1;

use App\Services\AttributesValuesService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $attributesService = new AttributesValuesService();

        return array_merge(
            $attributesService->getAttributesDescription($this->attributesValues),
            [
                "title" => $this->title,
                "price" => $this->price,
                "author_fullname" => $this->author->getFullName()
            ]
        );
    }
}
