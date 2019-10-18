<?php

namespace App\Http\Validators;

use App\Agendamento;
use App\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Http\Exceptions\HttpResponseException;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class AgendamentoAgendarValidate
{
    use ProvidesConvenienceMethods;

    private function rules(Request $request)
    {
        return [
            'descricao' => 'required|string',
            'solicitante_email' => 'required|email',
            'inicio' => "required|date_format:d/m/Y H:i|after:date('d/m/Y H:i')",
            'fim' => "required|date_format:d/m/Y H:i|after:inicio",
            'sala_id' => [
                'required',
                Rule::exists("salas", "id")
            ]
        ];
    }
    private function horarioEstaLivre(Request $request)
    {
        $inicio = Carbon::createFromFormat('d/m/Y H:i', $request->input("inicio"));
        $fim = Carbon::createFromFormat('d/m/Y H:i', $request->input("fim"));

        return !Agendamento::where(function ($query) use ($inicio) {
            $query->where("inicio", "<=", $inicio)
                ->where("fim", ">", $inicio);
            })
            ->orWhere(function ($query) use ($fim) {
                $query->where("inicio", "<=", $fim)
                    ->where("fim", ">", $fim);
            })
            ->where("sala_id", $request->input("sala_id"))
            ->where("status_id", Status::Ativo)
            ->exists();

    }
    private function messages()
    {
        return [
            "descricao.required" => "Por favor preencher a descrição.",
            "descricao.string" => "A descrição deve ser um texto.",
            "sala_id.required" => "Por favor informar o id da sala.",
            "sala_id.exists" => "A sala informada não esta disponível.",
            "solicitante_email.required" => "Por favor informe o e-mail do solicitante",
            "solicitante_email.solicitante_email" => "E-mail inválido",
            "solicitante_email.solicitante_email" => "E-mail inválido",
            "inicio.required" => "O inicio da reunião deve ser informado",
            "inicio.date_format" => "O inicio da reunião deve esta no formato data e hora (25/12/2019 13:00)",
            "inicio.after" => "A reunião não pode ser agendada para uma data retroativa.",
            "fim.required" => "O fim da reunião deve ser informado",
            "fim.date_format" => "O dim da reunião deve esta no formato data e hora (25/12/2019 14:00)",
            "fim.after" => "O fim da reunião não pode ser agendada para antes do início.",
        ];
    }
    public function validar(Request $request)
    {
        $this->validate(
            $request,
            $this->rules($request),
            $this->messages()
        );
        if (!$this->horarioEstaLivre($request)) {
            $messages = [
                "disponibilidade" => ["O horário solicitado não esta disponível."]
            ];
            throw new HttpResponseException(response()->json($messages, 422));
        };
    }
}