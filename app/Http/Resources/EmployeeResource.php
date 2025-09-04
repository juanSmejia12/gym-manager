<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'    => $this->id,
            'document' => $this->document,
            'name'  => $this->name,
            'email' => $this->email,
            'role'  => [
                'id'   => $this->role->id,
                'rol' => $this->role->rol,
            ],
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
