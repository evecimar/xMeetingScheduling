<?php

namespace App\Http\Validators;

use App\Status;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class AgendamentoCancelarValidate
{
    use ProvidesConvenienceMethods;

    private function rules()
    {
        return [
            'id' => [
                'required',
                Rule::exists("agendamentos", "id")->where("status_id", Status::Ativo)
            ]
        ];
    }
    
    private function messages()
    {
        return [
            "id.required" => "Por favor informar o id do agendamento.",
            "id.exists" => "O agendamento informado não ativo no sistema.",
        ];
    }
    public function validar(Request $request)
    {
        $this->validate(
            $request,
            $this->rules(),
            $this->messages()
        );
    }
}