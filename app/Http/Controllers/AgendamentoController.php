<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agendamento;
use App\Models\Paciente;
use App\Models\Medico;

class AgendamentoController extends Controller
{
    public function index()
    {
        try {
            $agendamentos = Agendamento::with(['paciente', 'medico'])
                ->orderBy('data', 'asc')->orderBy('hora', 'asc')
                ->get();

            return view('agendamentos.index', compact('agendamentos'));
        } catch (\Exception $e) {
            return redirect()->route('agendamentos.index')->with('error', 'Erro ao obter os agendamentos.');
        }
    }

    public function create()
    {

        $horarios = ['08:00', '08:30', '09:00', '09:30', '10:00', '10:30', '11:00', '11:30', '12:00', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00'];
        try {
            $pacientes = Paciente::all();
            $medicos = Medico::all();
            return view('agendamentos.create', compact('pacientes', 'medicos', 'horarios'));
        } catch (\Exception $e) {
            return redirect()->route('agendamentos.index')->with('error', 'Erro ao carregar a página de criação do agendamento.');
        }
    }

    public function store(Request $request)
    {
        $horarioSelecionado = $request->input('hora');

        if ($this->horarioIndisponivel($request->input('data'), $request->input('medico_id'), $request->input('paciente_id'), $horarioSelecionado)) {
            return redirect()->back()->with('error', 'Horário já agendado. Escolha outro horário.');
        }
        try {

            $request->validate([
                'data' => [
                    'required',
                    'date',
                    'date_format:Y-m-d',
                    'after_or_equal:' . now()->format('Y-m-d'),
                    function ($attribute, $value, $fail) {
                        $dayOfWeek = \Carbon\Carbon::parse($value)->dayOfWeek;
                        if ($dayOfWeek == 0 || $dayOfWeek == 6) {
                            $fail('Os agendamentos só são permitidos de segunda a sexta-feira.');
                        }
                    },
                ],
                'hora' => [
                    'required_if:data,' . now()->format('Y-m-d'),
                    'in:08:00,08:30,09:00,09:30,10:00,10:30,11:00,11:30,12:00,14:00,14:30,15:00,15:30,16:00,16:30,17:00',
                ],
                'paciente_id' => 'required|exists:pacientes,id',
                'medico_id' => 'required|exists:medicos,id',
                'tipo_consulta' => 'required',
                'retorno' => 'required',
            ]);

            Agendamento::create($request->all());

            return redirect()->route('agendamentos.index')->with('success', 'Agendamento criado com sucesso.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao criar o agendamento: ' . $e->getMessage());
        }
    }

    public function edit(Agendamento $agendamento)
    {
        $horarios = ['08:00', '08:30', '09:00', '09:30', '10:00', '10:30', '11:00', '11:30', '12:00', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00'];
        try {
            $agendamento->data = \Carbon\Carbon::parse($agendamento->data)->format('d-m-Y');
            $pacientes = Paciente::all();
            $medicos = Medico::all();
            return view('agendamentos.edit', compact('agendamento', 'pacientes', 'medicos', 'horarios'));
        } catch (\Exception $e) {
            return redirect()->route('agendamentos.index')->with('error', 'Erro ao carregar a página de edição do agendamento.');
        }
    }

    public function update(Request $request, Agendamento $agendamento)
    {
        try {
            $horarioSelecionado = $request->input('hora');

            // Verifica se o novo horário está disponível para agendamento
            if ($this->horarioIndisponivel($request->input('data'), $request->input('medico_id'), $request->input('paciente_id'), $horarioSelecionado)) {
                return redirect()->back()->with('error', 'Horário já agendado. Escolha outro horário.');
            }

            $request->validate([
                'data' => 'required|date|date_format:Y-m-d|after_or_equal:' . now()->format('Y-m-d'),
                'hora' => [
                    'required_if:data,' . now()->format('Y-m-d'),
                    'in:08:00,08:30,09:00,09:30,10:00,10:30,11:00,11:30,12:00,14:00,14:30,15:00,15:30,16:00,16:30,17:00',
                    'after_or_equal:' . now()->format('H:i'),
                ],
                'paciente_id' => 'required|exists:pacientes,id',
                'medico_id' => 'required|exists:medicos,id',
                'tipo_consulta' => 'required',
                'retorno' => 'required',
            ]);

            $agendamento->update($request->all());

            return redirect()->route('agendamentos.index')->with('success', 'Agendamento atualizado com sucesso.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao atualizar o agendamento: ' . $e->getMessage());
        }
    }


    public function destroy(Agendamento $agendamento)
    {
        try {
            $agendamento->delete();
            return redirect()->route('agendamentos.index')->with('success', 'Agendamento excluído com sucesso.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao excluir o agendamento: ' . $e->getMessage());
        }
    }
    public function search(Request $request)
{
    try {
        $termo = $request->input('termo');

        $resultados = Agendamento::where(function ($query) use ($termo) {
            $query->where('data', 'like', "%$termo%")
                ->orWhereHas('paciente', function ($query) use ($termo) {
                    $query->where('nome', 'like', "%$termo%");
                })
                ->orWhereHas('medico', function ($query) use ($termo) {
                    $query->where('nome', 'like', "%$termo%")
                    ->orWhereHas('especialidade', function ($query) use ($termo) {
                        $query->where('nome', 'like', "%$termo%");
                    });
                })->orWhere('tipo_consulta', 'like', "%$termo%")
                ->orWhere('retorno', 'like', "%$termo%");
        })->orderBy('data')->orderBy('hora')->get();

        return view('agendamentos.index', ['agendamentos' => $resultados, 'termo' => $termo]);
    } catch (\Exception $e) {
        return redirect()->route('agendamentos.index')->with('error', 'Erro ao realizar a pesquisa de agendamentos: ' . $e->getMessage());
    }
}

    private function horarioIndisponivel($data, $medicoId, $pacienteId, $horario)
    {
        // Verifica se o horário selecionado está dentro dos horários disponíveis
        $horariosDisponiveis = ['08:00', '08:30', '09:00', '09:30', '10:00', '10:30', '11:00', '11:30', '12:00', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00'];

        if (!in_array($horario, $horariosDisponiveis)) {
            return true; // Horário não permitido
        }

        // Verifica se já existe agendamento para o médico e horário na data especificada
        $agendamentoExistente = Agendamento::where('data', $data)
            ->where('medico_id', $medicoId)
            ->where('hora', $horario)
            ->exists();

        // Verifica se já existe agendamento para o paciente na mesma data, independente do médico
        $agendamentoPacienteExistente = Agendamento::where('data', $data)
            ->where('paciente_id', $pacienteId)
            ->where('hora', $horario)
            ->exists();

        return $agendamentoExistente || $agendamentoPacienteExistente;
    }
}
