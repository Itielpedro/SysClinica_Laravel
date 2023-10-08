<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Funcionario;

class FuncionarioController extends Controller
{
    public function index()
    {
        $funcionarios = Funcionario::all();
        return view('funcionarios.index', compact('funcionarios'));
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
        return view('funcionarios.create', compact('estados'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nome' => 'required|string|max:255',
                'data_nasc' => 'required|date',
                'rg' => 'required|string|unique:funcionarios,rg',
                'cpf' => 'required|string|unique:funcionarios,cpf',
                'rua' => 'required|string|max:255',
                'numero' => 'required|string|max:10',
                'bairro' => 'required|string|max:255',
                'cidade' => 'required|string|max:255',
                'cep' => 'required|string|max:9',
                'telefone' => 'required|string|max:15',
                'email' => 'required|email|max:255|unique:funcionarios,email',
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'cargo' => 'required|in:admin,atendente,secretaria, medico,outros',
                'data_admissao' => 'required|date',
                'data_demissao' => 'nullable|date',
                'estado' => 'required|in:AC,AL,AP,AM,BA,CE,DF,ES,GO,MA,MT,MS,MG,PA,PB,PR,PE,PI,RJ,RN,RS,RO,RR,SC,SP,SE,TO',
            ]);

            $fotoPath = $request->file('foto')->store('public/funcionarios');

            Funcionario::create([
                'nome' => $request->input('nome'),
                'data_nasc' => $request->input('data_nasc'),
                'rg' => $request->input('rg'),
                'cpf' => $request->input('cpf'),
                'rua' => $request->input('rua'),
                'numero' => $request->input('numero'),
                'bairro' => $request->input('bairro'),
                'cidade' => $request->input('cidade'),
                'cep' => $request->input('cep'),
                'telefone' => $request->input('telefone'),
                'email' => $request->input('email'),
                'foto' => $fotoPath,
                'data_admissao' => $request->input('data_admissao'),
                'data_demissao' => $request->input('data_demissao'),
                'cargo' => $request->input('cargo'),
                'estado' => $request->input('estado'),
            ]);

            return redirect()->route('funcionarios.index')->with('success', 'Funcionário cadastrado com sucesso.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao cadastrar o funcionário: ' . $e->getMessage());
        }
    }


    public function edit($id)
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

        $funcionario = Funcionario::find($id);
        return view('funcionarios.edit', compact('estados', 'funcionario'));
    }

    public function update(Request $request, $id)
    {
        try {
            $funcionario = Funcionario::findOrFail($id);

            $request->validate([
                'nome' => 'required',
                'data_nasc' => 'required|date',
                'rg' => 'required|unique:funcionarios,rg,' . $funcionario->id,
                'cpf' => 'required|unique:funcionarios,cpf,' . $funcionario->id,
                'rua' => 'required',
                'numero' => 'required',
                'bairro' => 'required',
                'cidade' => 'required',
                'cep' => 'required|string|max:9',
                'telefone' => 'required',
                'email' => 'required|email|unique:funcionarios,email,' . $funcionario->id,
                'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'cargo' => 'required|in:admin,atendente,secretaria, medico,outros' .$funcionario->id,
                'data_admissao' => 'required|date',
                'data_demissao' => 'nullable|date',
                'estado' => 'required|in:AC,AL,AP,AM,BA,CE,DF,ES,GO,MA,MT,MS,MG,PA,PB,PR,PE,PI,RJ,RN,RS,RO,RR,SC,SP,SE,TO',
            ]);

            $funcionario->update([
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
                'data_admissao' => $request->input('data_admissao'),
                'data_demissao' => $request->input('data_demissao'),
                'cargo' => $request->input('cargo'),
            ]);

            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('public/funcionarios');
                $funcionario->update(['foto' => $fotoPath]);
            }
         

            return redirect()->route('funcionarios.index')->with('success', 'Funcionário atualizado com sucesso.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao atualizar o funcionário: ' . $e->getMessage());
        }
    }

    public function destroy(Funcionario $funcionario)
    {
        try {
            $funcionario->delete();

            return redirect()->route('funcionarios.index')
                ->with('success', 'Funcionário excluído com sucesso.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Ocorreu um erro ao excluir o funcionário: ' . $e->getMessage());
        }
    }


    public function show($id)
    {
        try {
            $funcionario = Funcionario::findOrFail($id);
            return view('funcionarios.show', compact('funcionario'));
        } catch (\Exception $e) {
            return redirect()->route('funcionarios.index')->with('error', 'Ocorreu um erro ao exibir os detalhes do funcionário: ' . $e->getMessage());
        }
    }

    public function search(Request $request)
    {
        $termo = $request->input('termo');

        $funcionarios = Funcionario::where('nome', 'LIKE', "%$termo%")
            ->orWhere('cpf', 'LIKE', "%$termo%")
            ->orWhere('tipo', 'LIKE', "%$termo%")
            ->get();

        return view('funcionarios.index', compact('funcionarios', 'termo'));
    }
}
