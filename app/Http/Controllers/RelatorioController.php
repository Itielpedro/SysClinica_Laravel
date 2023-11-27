<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Funcionario;
use App\Models\Prontuario;
use TCPDF;
use App\Models\Agendamento;
use App\Models\Consulta;
use App\Models\Atendimento;
use Illuminate\Support\Facades\DB;

class PDF extends TCPDF
{
    public function Header()
    {

        if ($this->page == 1) {
            $imageFile = public_path('images/tcpdf_logo.jpg');
            $this->Image($imageFile, 10, 10, 20, '', 'JPG', '', 'T', false, 100, '', false, false, 0, false, false, false);

            $this->SetFont('helvetica', 'B', 20);
            $this->SetXY(20, 15);
            $this->Cell(0, 10, 'MEDICAL GROUP', 0, 1, 'C');

            $this->SetLineStyle(array('width' => 0.5, 'color' => array(0, 0, 0)));
            $this->Line(10, $this->GetY() + 10, $this->getPageWidth() - 10, $this->GetY() + 10);
        }

        $this->SetY($this->GetY() + 10);
    }

    public function Footer()
    {
        $this->SetY(-25);
        $this->SetLineStyle(array('width' => 0.5, 'color' => array(0, 0, 0)));
        $this->Line(10, $this->GetY(), $this->getPageWidth() - 10, $this->GetY());

        $this->SetFont('helvetica', 'I', 12);
        $this->SetY(-20);
        $this->Cell(0, 0, '© 2023 MEDICAL GROUP. Todos os direitos reservados.', 0, 0, 'C');
    }
}

class RelatorioController extends Controller
{


    public function fichaCadastroPaciente($id)
    {
        $paciente = Paciente::find($id);

        $data = \Carbon\Carbon::parse($paciente->data_nasc)->format('d/m/Y');

        $pdf = new PDF();

        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        $pdf->AddPage();
        $pdf->setFontSize(20);
        $pdf->setFont('', 'B');
        $pdf->Cell(0, 20, 'Ficha de Cadastro do Paciente', 0, 1, 'C');
        $pdf->setFontSize(15);
        $pdf->setFont('', '');

        $html = <<<EOD
        <table border="1" cellspacing="5" cellpadding="2">

        <h3 style="text-align:center;">INFORMAÇÕES PESSOAIS</h3>

        <tr style="background-color:#dfe6e9;">
            <th >NOME</th>
            <td> $paciente->nome</td>
        </tr>
        <tr style="background-color:#dfe6e9;">
            <th>CPF</th>
            <td>$paciente->cpf</td>
        </tr>
        <tr style="background-color:#dfe6e9;">
            <th>RG</th>
            <td>$paciente->rg</td>
        </tr>
        <tr style="background-color:#dfe6e9;">
            <th>Data de Nascimento</th>
            <td> $data</td>
        </tr>

        <h3 style="text-align:center;">ENDEREÇO</h3>

        <tr style="background-color:#dfe6e9;">
            <th>RUA</th>
            <td>$paciente->rua</td>
        </tr>
        <tr style="background-color:#dfe6e9;">
            <th>NUMÉRO</th>
            <td>$paciente->numero</td>
        </tr>
        <tr style="background-color:#dfe6e9;">
            <th>BAIRRO</th>
            <td>$paciente->bairro</td>
        </tr>
        <tr style="background-color:#dfe6e9;">
            <th>CIDADE</th>
            <td> $paciente->cidade - $paciente->estado</td>
        </tr>

        <h3 style="text-align:center;">CONTATO</h3>

        <tr  style="background-color:#dfe6e9;">
            <th>TELEFONE</th>
            <td> $paciente->telefone</td>
        </tr>
        <tr  style="background-color:#dfe6e9;">
            <th>EMAIL</th>
            <td>$paciente->email </td>
        </tr>
</table>
EOD;

        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 0, 0, true, '', true);
        $pdf->Output('ficha_paciente.pdf', 'I');
    }

    public function aniversariantes()
    {
        $aniversariantes = Paciente::whereMonth('data_nasc', '=', date('m'))
            ->orderBy('data_nasc')
            ->get();

        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->SetY(30);
        $pdf->setFontSize(20);
        $pdf->setFont('', 'B');
        $pdf->Cell(0, 35, 'Aniversariantes do Mês', 0, 1, 'C');
        $pdf->setFontSize(15);
        $pdf->setFont('', '');

        $html = '';

        foreach ($aniversariantes as $aniversariante) {
            $data = \Carbon\Carbon::parse($aniversariante->data_nasc)->format('d/m/Y');

            $html .= <<<EOD
            <table border="1" cellspacing="5" cellpadding="2">
                <tr style="background-color:#dfe6e9;">
                    <th>NOME</th>
                    <td> $aniversariante->nome</td>
                </tr>
                <tr style="background-color:#dfe6e9;">
                    <th>TELEFONE</th>
                    <td>$aniversariante->telefone</td>
                </tr>
                <tr style="background-color:#dfe6e9;">
                    <th>EMAIL</th>
                    <td>$aniversariante->email</td>
                </tr>
                <tr style="background-color:#dfe6e9;">
                    <th>Data de Nascimento</th>
                    <td> $data</td>
                </tr>

            </table>
            <br>
            <br>
            EOD;
        }

        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        $pdf->Output('aniversariantes.pdf', 'I');
    }

    public function funcionario($id)
    {
        $funcionario = Funcionario::find($id);

        $data = \Carbon\Carbon::parse($funcionario->data_nasc)->format('d/m/Y');
        $data_admissao = \Carbon\Carbon::parse($funcionario->data_admissao)->format('d/m/Y');

        $pdf = new PDF();

        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        $pdf->AddPage();
        $pdf->setFontSize(20);
        $pdf->setFont('', 'B');
        $pdf->Cell(0, 20, 'Ficha de Cadastro do Funcionário', 0, 1, 'C');
        $pdf->setFontSize(15);
        $pdf->setFont('', '');

        $html = <<<EOD
        <table border="1" cellspacing="5" cellpadding="2" style="">

        <h3 style="text-align:center;">INFORMAÇÕES PESSOAIS</h3>

        <tr style="background-color:#dfe6e9;">
            <th >NOME</th>
            <td> $funcionario->nome</td>
        </tr>
        <tr style="background-color:#dfe6e9;">
            <th>CPF</th>
            <td>$funcionario->cpf</td>
        </tr>
        <tr style="background-color:#dfe6e9;">
            <th>RG</th>
            <td>$funcionario->rg</td>
        </tr>
        <tr style="background-color:#dfe6e9;">
            <th>DATA DE NASCIMENTO</th>
            <td>$data</td>
        </tr>

        <tr style="background-color:#dfe6e9;">
            <th>CARGO</th>
            <td>$funcionario->cargo</td>
        </tr>

        <tr style="background-color:#dfe6e9;">
            <th>DATA DE ADMISSÃO</th>
            <td>$data_admissao</td>
        </tr>

        <h3 style="text-align:center;">ENDEREÇO</h3>

        <tr style="background-color:#dfe6e9;">
            <th>RUA</th>
            <td>$funcionario->rua</td>
        </tr>
        <tr style="background-color:#dfe6e9;">
            <th>NUMÉRO</th>
            <td>$funcionario->numero</td>
        </tr>
        <tr style="background-color:#dfe6e9;">
            <th>BAIRRO</th>
            <td>$funcionario->bairro</td>
        </tr>
        <tr style="background-color:#dfe6e9;">
            <th>CIDADE</th>
            <td> $funcionario->cidade</td>
        </tr>

        <h3 style="text-align:center;">CONTATO</h3>

        <tr style="background-color:#dfe6e9;">
            <th>TELEFONE</th>
            <td> $funcionario->telefone</td>
        </tr>
        <tr style="background-color:#dfe6e9;">
            <th>EMAIL</th>
            <td>$funcionario->email </td>
        </tr>
    </table>
EOD;

        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 0, 0, true, '', true);
        $pdf->Output('ficha_funcionario.pdf', 'I');
    }

    public function prontuario($id)
    {
        $prontuario = Prontuario::with(['consultas' => function ($query) {
            $query->where('status', 'confirmado');
        }])->find($id);

        $data_cadastro = \Carbon\Carbon::parse($prontuario->created_at)->format('d/m/Y');

        $pdf = new PDF();

        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        $pdf->AddPage();
        $pdf->setFontSize(20);
        $pdf->setFont('', 'B');
        $pdf->Cell(0, 20, 'Prontuário', 0, 1, 'C');
        $pdf->setFontSize(14);
        $pdf->setFont('', '');

        $html = <<<EOD
        <table border="1" cellspacing="5" cellpadding="2">
            <h3 style="text-align:center;">INFORMAÇÕES PESSOAIS</h3>
            <tr style="background-color:#dfe6e9;">
                <th>DATA DE CADASTRO</th>
                <td> $data_cadastro </td>
            </tr>
            <tr style="background-color:#dfe6e9;">
                <th>NOME</th>
                <td> {$prontuario->paciente->nome} </td>
            </tr>
            <tr style="background-color:#dfe6e9;">
                <th>CPF</th>
                <td>{$prontuario->paciente->cpf}</td>
            </tr>
            <tr style="background-color:#dfe6e9;">
                <th>RG</th>
                <td>{$prontuario->paciente->rg}</td>
            </tr>
        </table>
        <p></p>
        <h3 style="text-align:center;">LISTA DE CONSULTAS</h3>
        EOD;

        foreach ($prontuario->consultas as $consulta) {
            $data_consulta = \Carbon\Carbon::parse($consulta->data)->format('d/m/Y');
            $hora_consulta = \Carbon\Carbon::parse($consulta->hora)->format('H:i:s');

            $html .= <<<EOD
            <table border="1" cellspacing="5" cellpadding="2">
                <tr style="background-color:#dfe6e9;">
                    <th>DATA DA CONSULTA</th>
                    <td> $data_consulta </td>
                </tr>
                <tr style="background-color:#dfe6e9;">
                    <th>HORA DA CONSULTA</th>
                    <td> $hora_consulta </td>
                </tr>
                <tr style="background-color:#dfe6e9;">
                    <th>MÉDICO</th>
                    <td>{$consulta->medico->nome} </td>
                </tr>
            </table>
            <br>
            <br>
            EOD;
        }

        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 0, 0, true, '', true);
        $pdf->Output('prontuário.pdf', 'I');
    }

    public function agendamentos(Request $request)
    {
        $dataEscolhida = $request->input('data_escolhida');
        $especialidadeId = $request->input('especialidade_id');
        $medicoId = $request->input('medico_id');

        $agendamento = Agendamento::query();

        if (!empty($dataEscolhida)) {
            $agendamento->whereDate('data', $dataEscolhida);
        }

        if (!empty($especialidadeId)) {
            $agendamento->whereHas('medico', function ($query) use ($especialidadeId) {
                $query->where('especialidade_id', $especialidadeId);
            });
        }

        if (!empty($medicoId)) {
            $agendamento->where('medico_id', $medicoId);
        }

        $consultas = $agendamento->with(['paciente', 'medico', 'especialidade'])->get();

        $pdf = new PDF();
        $pdf->SetAutoPageBreak(true, 30);
        $pdf->AddPage();
        $pdf->SetY(30);

        $pdf->setFontSize(20);
        $pdf->setFont('', 'B');
        $pdf->Cell(0, 25, 'Agendamentos', 0, 1, 'C');
        $pdf->setFontSize(14);
        $pdf->setFont('', '');

        if ($consultas->isEmpty()) {
            $html = '<p style="text-align:center">Não há consultas agendadas para o dia, especialidade ou médico escolhidos.</p>';
            $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        } else {
            foreach ($consultas as $consulta) {
                $pdf->SetY($pdf->GetY() + 3);

                $data_consulta = \Carbon\Carbon::parse($consulta->data)->format('d/m/Y');
                $hora_consulta = \Carbon\Carbon::parse($consulta->hora)->format('H:i:s');

                $html = <<<EOD
                <table border="1" cellspacing="5" cellpadding="2">
                    <tr style="background-color:#dfe6e9;">
                        <th >DATA</th>
                        <td> $data_consulta</td>
                    </tr>
                    <tr style="background-color:#dfe6e9;">
                        <th>HORA</th>
                        <td>$hora_consulta</td>
                    </tr>
                    <tr style="background-color:#dfe6e9;">
                        <th>PACIENTE</th>
                        <td>{$consulta->paciente->nome}</td>
                    </tr>
                    <tr style="background-color:#dfe6e9;">
                        <th>TELEFONE DO PACIENTE</th>
                        <td>{$consulta->paciente->telefone}</td>
                    </tr>
                    <tr style="background-color:#dfe6e9;">
                        <th>MÉDICO</th>
                        <td>{$consulta->medico->nome}</td>
                    </tr>
                    <tr style="background-color:#dfe6e9;">
                        <th>ESPECIALIDADE</th>
                        <td>{$consulta->medico->especialidade->nome}</td>
                    </tr>
                    <tr style="background-color:#dfe6e9;">
                        <th>RETORNO</th>
                        <td>$consulta->retorno</td>
                    </tr>
                </table>

                EOD;

                $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
            }
        }

        $pdf->Output('agendamentos.pdf', 'I');
    }

    public function reciboConsulta($id)
    {
        $atendimento = Consulta::with(['atendimentos.procedimento'])->find($id);

        $data_consulta = \Carbon\Carbon::parse($atendimento->data)->format('d/m/Y');
        $hora_consulta = \Carbon\Carbon::parse($atendimento->hora)->format('H:i:s');

        $pdf = new PDF();

        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        $pdf->AddPage();
        $pdf->SetFontSize(20);
        $pdf->SetFont('', 'B');
        $pdf->Cell(0, 20, 'Recibo de Consulta - Boleto', 0, 1, 'C');
        $pdf->SetFontSize(14);
        $pdf->SetFont('', '');

        $html = <<<EOD
        <table border="1" cellspacing="5" cellpadding="2">
            <tr style="background-color:#dfe6e9;">
                <th>COD. DA CONSULTA</th>
                <td>{$atendimento->id}</td>
            </tr>
            <tr style="background-color:#dfe6e9;">
                <th>DATA DA CONSULTA</th>
                <td> $data_consulta </td>
            </tr>
            <tr style="background-color:#dfe6e9;">
                <th>HORA DA CONSULTA</th>
                <td> $hora_consulta </td>
            </tr>
            <tr style="background-color:#dfe6e9;">
                <th>NOME DO PACIENTE</th>
                <td>{$atendimento->paciente->nome}</td>
            </tr>
            <tr style="background-color:#dfe6e9;">
                <th>CPF</th>
                <td>{$atendimento->paciente->cpf}</td>
            </tr>
            <tr style="background-color:#dfe6e9;">
                <th>NOME DO MÉDICO</th>
                <td>{$atendimento->medico->nome}</td>
            </tr>
            <tr style="background-color:#dfe6e9;">
                <th>ESPECIALIDADE</th>
                <td>{$atendimento->medico->especialidade->nome}</td>
            </tr>
            <tr style="background-color:#dfe6e9;">
                <th>VALOR DA CONSULTA</th>
                <td>R$ {$atendimento->atendimentos->first()->procedimento->valor}</td>

            </tr>
        </table>
        EOD;

        $pdf->WriteHTML($html);
        $pdf->Output('recibo_boleto.pdf', 'I');
    }

    public function relatorioFinanceiro(Request $request)
    {
        $dataInicio = $request->input('data_inicial');
        $dataFim = $request->input('data_final');

        $totalConsultas = Atendimento::whereBetween('consultas.data', [$dataInicio, $dataFim])
            ->where('procedimentos.descricao', 'consulta')
            ->join('consultas', 'atendimentos.consulta_id', '=', 'consultas.id')
            ->join('procedimentos', 'atendimentos.procedimento_id', '=', 'procedimentos.id')
            ->sum('procedimentos.valor');

        $totalOutrosProcedimentos = Atendimento::whereBetween('consultas.data', [$dataInicio, $dataFim])
            ->where('procedimentos.descricao', '<>', 'consulta')
            ->join('consultas', 'atendimentos.consulta_id', '=', 'consultas.id')
            ->join('procedimentos', 'atendimentos.procedimento_id', '=', 'procedimentos.id')
            ->sum('procedimentos.valor');

        $totalGeral = $totalConsultas + $totalOutrosProcedimentos;
        $totalGeralFormatado = number_format($totalGeral, 2, '.', '');



        $consultasPorEspecialidade = Atendimento::whereBetween('consultas.data', [$dataInicio, $dataFim])
            ->join('consultas', 'atendimentos.consulta_id', '=', 'consultas.id')
            ->join('medicos', 'consultas.medico_id', '=', 'medicos.id')
            ->join('especialidades', 'medicos.especialidade_id', '=', 'especialidades.id')
            ->join('procedimentos', 'atendimentos.procedimento_id', '=', 'procedimentos.id')
            ->select(
                'especialidades.nome as especialidade',
                DB::raw('count(*) as total_consultas'),
                DB::raw('sum(procedimentos.valor) as total_valor')
            )
            ->groupBy('especialidades.nome')
            ->get();

        $pdf = new PDF();
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->AddPage();
        $pdf->SetFontSize(20);
        $pdf->SetFont('', 'B');
        $pdf->Cell(0, 20, 'Relatório Financeiro', 0, 1, 'C');

        $pdf->SetFontSize(14);
        $pdf->SetFont('', '');

        $data1 = \Carbon\Carbon::parse($dataInicio)->format('d/m/Y');
        $data2 = \Carbon\Carbon::parse($dataFim)->format('d/m/Y');

        $html = <<<EOD
        <p><i>Período de {$data1} - {$data2}</i></p>
        <table border="1" cellspacing="5" cellpadding="2">
        <h3 style="text-align:center;padding-top:;">CONSULTAS</h3>

            <tr style="background-color:#dfe6e9;">
                <th>TOTAL DE CONSULTAS</th>
                <td>R$ $totalConsultas</td>
            </tr>
            <tr style="background-color:#dfe6e9;">
                <th>TOTAL PROCEDIMENTOS</th>
                <td>R$ $totalOutrosProcedimentos</td>
            </tr>
            <tr style="background-color:#dfe6e9;">
                <th>TOTAL GERAL</th>
                <td>R$ $totalGeralFormatado</td>
            </tr>
        </table>
        <p></p>
        <h3 style="text-align:center; margin-top: 20px;">ESPECIALIDADES</h3>
        EOD;


        foreach ($consultasPorEspecialidade as $especialidade) {
            $html .= <<<EOD

            <table border="1" cellspacing="5" cellpadding="2">
                <tr style="background-color:#dfe6e9;">
                    <th>ESPECIALIDADE</th>
                    <td>$especialidade->especialidade</td>
                </tr>
                <tr style="background-color:#dfe6e9;">
                    <th>TOTAL</th>
                    <td>$especialidade->total_consultas</td>
                </tr>
                <tr style="background-color:#dfe6e9;">
                    <th>VALOR</th>
                    <td> R$ $especialidade->total_valor</td>
                </tr>
            </table>
            <br>
            <br>
            EOD;
        }
        $pdf->writeHTMLCell(0, 0, '', '', $html);
        $pdf->Output('relatorio_financeiro.pdf', 'I');
    }
}
