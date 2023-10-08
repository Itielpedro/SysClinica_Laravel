<?php

namespace App\Http\Controllers;

use App\Models\Medico;

use App\Http\Controllers\Controller;
use App\Models\Especialidade;
use Illuminate\Http\Request;

class MedicosController extends Controller
{
    public function index()
    {
        $medicos = Medico::all();
        $especialidades = Especialidade::all();
        return view('medicos.index', compact('medicos', 'especialidades'));
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
        $especialidades = Especialidade::all();
        return view('medicos.create', compact('especialidades', 'estados'));
    }

    public function store(Request $request)
    {
        try {

            $request->validate([
                'nome' => 'required',
                'data_nasc' => 'required|date',
                'rg' => 'required|unique:medicos',
                'cpf' => 'required|unique:medicos',
                'crm' => 'required|unique:medicos',
                'rua' => 'required',
                'numero' => 'required',
                'bairro' => 'required',
                'cidade' => 'required',
                'cep' => 'required|string|max:9',
                'estado' => 'required|in:AC,AL,AP,AM,BA,CE,DF,ES,GO,MA,MT,MS,MG,PA,PB,PR,PE,PI,RJ,RN,RS,RO,RR,SC,SP,SE,TO',
                'telefone' => 'required',
                'email' => 'required|email|unique:medicos',
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'especialidade_id' => 'required|exists:especialidades,id',

            ]);


            $fotoPath = $request->file('foto')->store('public/medicos');


            Medico::create([
                'nome' => $request->input('nome'),
                'data_nasc' => $request->input('data_nasc'),
                'rg' => $request->input('rg'),
                'cpf' => $request->input('cpf'),
                'crm' => $request->input('crm'),
                'rua' => $request->input('rua'),
                'numero' => $request->input('numero'),
                'bairro' => $request->input('bairro'),
                'cidade' => $request->input('cidade'),
                'cep' => $request->input('cep'),
                'estado' => $request->input('estado'),
                'telefone' => $request->input('telefone'),
                'email' => $request->input('email'),
                'foto' => $fotoPath,
                'especialidade_id' => $request->input('especialidade_id'),
            ]);


            return redirect()->route('medicos.index')->with('success', 'Médico cadastrado com sucesso.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao cadastrar o médico: ' . $e->getMessage());
        }
    }

    public function edit(Medico $medico)
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
        $especialidades = Especialidade::all();
        return view('medicos.edit', compact('medico', 'especialidades', 'estados'));
    }

    public function update(Request $request, Medico $medico)
    {
        try {
            $request->validate([
                'nome' => 'required',
                'data_nasc' => 'required|date',
                'rg' => 'required|unique:medicos,rg,' . $medico->id,
                'cpf' => 'required|unique:medicos,cpf,' . $medico->id,
                'crm' => 'required|unique:medicos,crm,' .$medico->id,
                'rua' => 'required',
                'numero' => 'required',
                'bairro' => 'required',
                'cidade' => 'required',
                'cep' => 'required|string|max:9',
                'telefone' => 'required',
                'email' => 'required|email|unique:medicos,email,' . $medico->id,
                'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'especialidade_id' => 'required|exists:especialidades,id',
                'estado' => 'required|in:AC,AL,AP,AM,BA,CE,DF,ES,GO,MA,MT,MS,MG,PA,PB,PR,PE,PI,RJ,RN,RS,RO,RR,SC,SP,SE,TO',
            ]);

            $medico->update([
                'nome' => $request->input('nome'),
                'data_nasc' => $request->input('data_nasc'),
                'rg' => $request->input('rg'),
                'cpf' => $request->input('cpf'),
                'crm' => $request->input('crm'),
                'rua' => $request->input('rua'),
                'numero' => $request->input('numero'),
                'bairro' => $request->input('bairro'),
                'cidade' => $request->input('cidade'),
                'cep' => $request->input('cep'),
                'estado' => $request->input('estado'),
                'telefone' => $request->input('telefone'),
                'email' => $request->input('email'),
                'especialidade_id' => $request->input('especialidade_id'),
            ]);

            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('public/medicos');
                $medico->update(['foto' => $fotoPath]);
            }

            return redirect()->route('medicos.index', $medico->id)->with('success', 'Médico atualizado com sucesso.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao atualizar o médico: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $medico = Medico::find($id);

        if (!$medico) {
            return redirect()->route('medicos.index')->with('error', 'Médico não encontrado');
        }

        return view('medicos.show', compact('medico'));
    }

    public function destroy($id)
    {
        try {
            $medicos = Medico::findOrFail($id);
            $medicos->delete();

            return redirect()->route('medicos.index')->with('success', 'Médico excluído com sucesso.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao excluir Médico ' . $e->getMessage());
        }
    }

    public function search(Request $request)
    {
        $termo = $request->input('termo');

        $resultados = Medico::where('nome', 'like', "%$termo%")
            ->orWhere('cpf', 'like', "%$termo%")
            ->orWhere('crm', 'like', "%$termo%")
            ->orWhereHas('especialidade', function ($query) use ($termo) {
                $query->where('nome', 'like', "%$termo%");
            })
            ->get();

        return view('medicos.index', ['medicos' => $resultados, 'termo' => $termo]);
    }
}
