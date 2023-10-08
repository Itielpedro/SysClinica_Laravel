<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paciente;

class PacienteController extends Controller
{
    public function index()
    {
        $pacientes = Paciente::all();
        return view('pacientes.index', compact('pacientes'));
    }

    public function create()
    {
        $estados = [
            'AC' => 'Acre',
            'AL' => 'Alagoas',
            'AP' => 'Amapá',
            'AM' => 'Amazonas',
            'BA' => 'Bahia',
            'CE' => 'Ceará',
            'DF' => 'Distrito Federal',
            'ES' => 'Espírito Santo',
            'GO' => 'Goiás',
            'MA' => 'Maranhão',
            'MT' => 'Mato Grosso',
            'MS' => 'Mato Grosso do Sul',
            'MG' => 'Minas Gerais',
            'PA' => 'Pará',
            'PB' => 'Paraíba',
            'PR' => 'Paraná',
            'PE' => 'Pernambuco',
            'PI' => 'Piauí',
            'RJ' => 'Rio de Janeiro',
            'RN' => 'Rio Grande do Norte',
            'RS' => 'Rio Grande do Sul',
            'RO' => 'Rondônia',
            'RR' => 'Roraima',
            'SC' => 'Santa Catarina',
            'SP' => 'São Paulo',
            'SE' => 'Sergipe',
            'TO' => 'Tocantins',
        ];
        return view('pacientes.create', compact('estados'));
    }

    public function store(Request $request)
    {
        try {

            $request->validate([
                'nome' => 'required',
                'data_nasc' => 'required|date',
                'rg' => 'required|unique:pacientes',
                'cpf' => 'required|unique:pacientes',
                'rua' => 'required',
                'numero' => 'required',
                'bairro' => 'required',
                'cidade' => 'required',
                'cep' => 'required|string|max:9',
                'estado' => 'required|in:AC,AL,AP,AM,BA,CE,DF,ES,GO,MA,MT,MS,MG,PA,PB,PR,PE,PI,RJ,RN,RS,RO,RR,SC,SP,SE,TO',
                'telefone' => 'required',
                'email' => 'required|email|unique:pacientes',
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'info_medica',
            ]);


            $fotoPath = $request->file('foto')->store('public/pacientes');


            Paciente::create([
                'nome' => $request->input('nome'),
                'data_nasc' => $request->input('data_nasc'),
                'rg' => $request->input('rg'),
                'cpf' => $request->input('cpf'),
                'rua' => $request->input('rua'),
                'numero' => $request->input('numero'),
                'bairro' => $request->input('bairro'),
                'cidade' => $request->input('cidade'),
                'cep' => $request->input('cep'),
                'estado' => $request->input('estado'),
                'telefone' => $request->input('telefone'),
                'email' => $request->input('email'),
                'foto' => $fotoPath,
                'info_medica' => $request->input('info_medica'),
            ]);


            return redirect()->route('pacientes.index')->with('success', 'Paciente cadastrado com sucesso.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao cadastrar o Paciente: ' . $e->getMessage());
        }
    }

    public function edit(Paciente $paciente)
    {
        $estados = [
            'AC' => 'Acre',
            'AL' => 'Alagoas',
            'AP' => 'Amapá',
            'AM' => 'Amazonas',
            'BA' => 'Bahia',
            'CE' => 'Ceará',
            'DF' => 'Distrito Federal',
            'ES' => 'Espírito Santo',
            'GO' => 'Goiás',
            'MA' => 'Maranhão',
            'MT' => 'Mato Grosso',
            'MS' => 'Mato Grosso do Sul',
            'MG' => 'Minas Gerais',
            'PA' => 'Pará',
            'PB' => 'Paraíba',
            'PR' => 'Paraná',
            'PE' => 'Pernambuco',
            'PI' => 'Piauí',
            'RJ' => 'Rio de Janeiro',
            'RN' => 'Rio Grande do Norte',
            'RS' => 'Rio Grande do Sul',
            'RO' => 'Rondônia',
            'RR' => 'Roraima',
            'SC' => 'Santa Catarina',
            'SP' => 'São Paulo',
            'SE' => 'Sergipe',
            'TO' => 'Tocantins',
        ];
        return view('pacientes.edit', compact('paciente', 'estados'));
    }

    public function update(Request $request, Paciente $paciente)
    {
        try {
            $request->validate([
                'nome' => 'required',
                'data_nasc' => 'required|date',
                'rg' => 'required|unique:pacientes,rg,' . $paciente->id,
                'cpf' => 'required|unique:pacientes,cpf,' . $paciente->id,
                'rua' => 'required',
                'numero' => 'required',
                'bairro' => 'required',
                'cidade' => 'required',
                'cep' => 'required|string|max:9',
                'estado' => 'required|in:AC,AL,AP,AM,BA,CE,DF,ES,GO,MA,MT,MS,MG,PA,PB,PR,PE,PI,RJ,RN,RS,RO,RR,SC,SP,SE,TO',
                'telefone' => 'required',
                'email' => 'required|email|unique:pacientes,email,' . $paciente->id,
                'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'info_medica',
            ]);

            $paciente->update([
                'nome' => $request->input('nome'),
                'data_nasc' => $request->input('data_nasc'),
                'rg' => $request->input('rg'),
                'cpf' => $request->input('cpf'),
                'rua' => $request->input('rua'),
                'numero' => $request->input('numero'),
                'bairro' => $request->input('bairro'),
                'cidade' => $request->input('cidade'),
                'cep' => $request->input('cep'),
                'estado' => $request->input('estado'),
                'telefone' => $request->input('telefone'),
                'email' => $request->input('email'),
                'info_medica' => $request->input('info_medica'),
            ]);

            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('public/pacientes');
                $paciente->update(['foto' => $fotoPath]);
            }

            return redirect()->route('pacientes.index', $paciente->id)->with('success', 'Paciente atualizado com sucesso.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao atualizar o Paciente: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $paciente = Paciente::find($id);

        if (!$paciente) {
            return redirect()->route('paciente.index')->with('error', 'Paciente não encontrado');
        }

        return view('pacientes.show', compact('paciente'));
    }

    public function destroy($id)
    {
        try {
            $pacientes = Paciente::findOrFail($id);
            $pacientes->delete();

            return redirect()->route('pacientes.index')->with('success', 'Paciente excluído com sucesso.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao excluir Paciente ' . $e->getMessage());
        }
    }

    public function search(Request $request)
    {
        $termo = $request->input('termo');

        if ($termo) {
            $resultados = Paciente::where('nome', 'like', "%$termo%")
                ->orWhere('cpf', 'like', "%$termo%")
                ->orWhere('email', 'like', "%$termo%")
                ->get();
        } else {
            $resultados = Paciente::all();
        }

        return view('pacientes.index', ['pacientes' => $resultados, 'termo' => $termo]);
    }



}
