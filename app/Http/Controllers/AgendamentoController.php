<?php

namespace App\Http\Controllers;

use App\Agendamento;
use App\Http\Validators\AgendamentoAgendarValidate;
use App\Http\Validators\AgendamentoCancelarValidate;
use App\Status;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AgendamentoController extends Controller
{
    public function agendar(AgendamentoAgendarValidate $validator, Request $request)
    {   
        $validator->validar($request);
        Agendamento::create($request->all());
        return response()->setStatusCode(201);
    }
    public function cancelar(AgendamentoCancelarValidate $validator, Request $request)
    {
        $validator->validar($request);
        $agendamento = Agendamento::findOrFail($request->input("id"));
        $agendamento->status_id = Status::Cancelado;
        $agendamento->save();
        
        return response()->json([], 200);
    }
    public function agendamentosDoDia()
    {
       return Agendamento::with("sala")
            ->with("status")
            ->where("status_id", Status::Ativo)
            ->whereDate('inicio', Carbon::now()->format("Y-m-d"))
            ->orderBy("inicio", "asc")
            ->get(); 
    }
}