<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImcResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $result = parent::toArray($request);
        $result['result'] = $this->getImcResult($this->weight, $this->height);
        return $result;
    }

    private function getImcResult($weight, $height) {
        $imc = $weight / pow($height, 2);

        if ($imc < 18.5) {
            $result = 'Magreza';
            $obesityLevel = 0;
        } else if ($imc < 25) {
            $result = 'Normal';
            $obesityLevel = 0;
        } else if ($imc < 30) {
            $result = 'Sobrepeso';
            $obesityLevel = 1;
        } else if ($imc < 40) {
            $result = 'Obesidade';
            $obesityLevel = 2;
        } else {
            $result = 'Obesidade Grave';
            $obesityLevel = 3;
        }

        return [
            'imc' => $imc,
            'result' => $result,
            'obesityLeval' => $obesityLevel
        ];
    }
}