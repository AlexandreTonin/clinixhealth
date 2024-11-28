<?php
include 'components/sidebar.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    include 'db/db_connect.php';

    $sql = "SELECT * FROM paciente WHERE id = $id";
    $resultPaciente = $conn->query($sql);

    if ($resultPaciente->num_rows > 0) {
        // Buscar os dados da primeira linha
        $rowPaciente = $resultPaciente->fetch_assoc();  // fetch_assoc() retorna um array associativo
    }

    $sqlDiagnostico = "SELECT d.*, m.nome FROM diagnostico d JOIN medico m ON d.id_medico = m.id WHERE id_paciente = $id";
    $resultDiagnostico = $conn->query($sqlDiagnostico);

    $sqlExames = "SELECT e.*, m.nome FROM exame e JOIN medico m ON e.id_medico = m.id WHERE e.id_paciente = $id";
    $resultExames = $conn->query($sqlExames);

    $sqlPrescricao = "SELECT p.*, m.nome FROM prescricao p JOIN medico m ON p.id_medico = m.id WHERE p.id_paciente = $id";
    $resultPrescricao = $conn->query($sqlPrescricao);
} else {
    echo "ID não fornecido.";
    exit;
}


// URL do serviço SOAP
$url = "http://localhost:8080/soap-paciente";

// Corpo da requisição SOAP (XML)
$xml = <<<XML
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:web="http://www.example.com/soap">
    <soapenv:Header/>
    <soapenv:Body>
        <web:getMedicalRecord>
            <patientCpf>{$rowPaciente['cpf']}</patientCpf>
        </web:getMedicalRecord>
    </soapenv:Body>
</soapenv:Envelope>
XML;

// Inicializando o cURL
$ch = curl_init();

// Configurando a requisição cURL
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Retorna a resposta ao invés de exibir
curl_setopt($ch, CURLOPT_POST, true); // Método POST
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: text/xml', // Tipo de conteúdo é XML
    'SOAPAction: "http://www.example.com/soap/getMedicalRecord"' // Definindo a SOAPAction, se necessário
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xml); // Enviando o XML no corpo da requisição

// Executando a requisição e obtendo a resposta
$response = curl_exec($ch);

// Verificando se houve erro
if (curl_errno($ch)) {
    echo "Erro cURL: " . curl_error($ch);
} else if ($response) {
    // Supondo que o XML foi carregado corretamente na variável $response
    $xml = simplexml_load_string($response);

    // Função para exibir valores de objetos do XML
    function exibir_dados($object)
    {
        return (string) $object;
    }

    // Extraindo os dados do XML
    $id_paciente = exibir_dados($xml->object->object[0]); // id_paciente
    $nome = exibir_dados($xml->object->object[1]); // nome
    $data_nascimento = exibir_dados($xml->object->object[2]); // data_nascimento
    $cpf = exibir_dados($xml->object->object[3]); // cpf
    $email = exibir_dados($xml->object->object[4]); // email

    // Extraindo exames
    $exames = $xml->object->object[5]->object;
    $prescricoes = $xml->object->object[6]->object;
    $diagnosticos = $xml->object->object[7]->object;
}

// Fechando a conexão cURL
curl_close($ch);
?>

<h1 class="font-bold text-xl">Prontuário de <span class="underline text-blue-800"><?php echo $rowPaciente['nome']; ?></span></h1>

<div class="mt-4 flex flex-col gap-4">
    <div class="border w-full rounded-lg p-4 bg-white">
        <h2 class="font-bold text-lg flex items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-user">
                <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                <path d="M15 18a3 3 0 1 0-6 0" />
                <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7z" />
                <circle cx="12" cy="13" r="2" />
            </svg>

            Informações Pessoais
        </h2>

        <hr class="my-2">

        <p><span class="font-bold">Nome:</span> <?php echo $rowPaciente['nome']; ?></p>
        <p><span class="font-bold">Data de Nascimento:</span> <?php echo $rowPaciente['data_nascimento']; ?></p>
        <p><span class="font-bold">CPF:</span> <?php echo $rowPaciente['cpf']; ?></p>
        <p><span class="font-bold">Telefone:</span> <?php echo $rowPaciente['telefone']; ?></p>
    </div>


    <div class="border w-full rounded-lg p-4 bg-white">
        <h2 class="font-bold text-lg flex items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clipboard-plus">
                <rect width="8" height="4" x="8" y="2" rx="1" ry="1" />
                <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2" />
                <path d="M9 14h6" />
                <path d="M12 17v-6" />
            </svg>

            Diagnósticos
        </h2>

        <hr class="my-2">

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 aa-text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 aa-bg-gray-700 aa-text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-3">Descrição</th>
                        <th scope="col" class="px-4 py-3">Data</th>
                        <th scope="col" class="px-4 py-3">Observações</th>
                        <th scope="col" class="px-4 py-3">Atendimento</th>
                        <th scope="col" class="px-4 py-3">Médico</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($resultDiagnostico->num_rows > 0) {
                        while ($rowDiagnostico = $resultDiagnostico->fetch_assoc()) {
                            echo "<tr class='border-b aa-border-gray-700'>";
                            echo "<td class='px-4 py-3 font-medium text-gray-900 whitespace-nowrap aa-text-white'>" . $rowDiagnostico['diagnostico'] . "</td>";
                            echo "<td class='px-4 py-3'>" . $rowDiagnostico['data_diagnostico'] . "</td>";
                            echo "<td class='px-4 py-3'>" . $rowDiagnostico['observacoes'] . "</td>";
                            echo "<td class='px-4 py-3'>" . $rowDiagnostico['id_atendimento'] . "</td>";
                            echo "<td class='px-4 py-3'>" . $rowDiagnostico['nome'] . "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="border w-full rounded-lg p-4 bg-white">
        <h2 class="font-bold text-lg flex items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-test-tube-diagonal">
                <path d="M21 7 6.82 21.18a2.83 2.83 0 0 1-3.99-.01a2.83 2.83 0 0 1 0-4L17 3" />
                <path d="m16 2 6 6" />
                <path d="M12 16H4" />
            </svg>

            Exames
        </h2>

        <hr class="my-2">

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 aa-text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 aa-bg-gray-700 aa-text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-3">Descrição</th>
                        <th scope="col" class="px-4 py-3">Data</th>
                        <th scope="col" class="px-4 py-3">Resultado</th>
                        <th scope="col" class="px-4 py-3">Médico</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($resultExames->num_rows > 0) {
                        while ($rowExame = $resultExames->fetch_assoc()) {
                            echo "<tr class='border-b aa-border-gray-700'>";
                            echo "<td class='px-4 py-3 font-medium text-gray-900 whitespace-nowrap aa-text-white'>" . $rowExame['tipo_exame'] . "</td>";
                            echo "<td class='px-4 py-3'>" . $rowExame['data_solicitacao'] . "</td>";
                            echo "<td class='px-4 py-3'>" . $rowExame['resultado'] . "</td>";
                            echo "<td class='px-4 py-3'>" . $rowExame['nome'] . "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="border w-full rounded-lg p-4 bg-white">
        <h2 class="font-bold text-lg flex items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pill">
                <path d="m10.5 20.5 10-10a4.95 4.95 0 1 0-7-7l-10 10a4.95 4.95 0 1 0 7 7Z" />
                <path d="m8.5 8.5 7 7" />
            </svg>

            Prescrições
        </h2>

        <hr class="my-2">

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 aa-text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 aa-bg-gray-700 aa-text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-3">Medicamento</th>
                        <th scope="col" class="px-4 py-3">Dosagem</th>
                        <th scope="col" class="px-4 py-3">Observacoes</th>
                        <th scope="col" class="px-4 py-3">Data</th>
                        <th scope="col" class="px-4 py-3">Médico</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($resultPrescricao->num_rows > 0) {
                        while ($rowPrescricao = $resultPrescricao->fetch_assoc()) {
                            echo "<tr class='border-b aa-border-gray-700'>";
                            echo "<td class='px-4 py-3 font-medium text-gray-900 whitespace-nowrap aa-text-white'>" . $rowPrescricao['medicamento'] . "</td>";
                            echo "<td class='px-4 py-3'>" . $rowPrescricao['dosagem'] . "</td>";
                            echo "<td class='px-4 py-3'>" . $rowPrescricao['observacoes'] . "</td>";
                            echo "<td class='px-4 py-3'>" . $rowPrescricao['data_prescricao'] . "</td>";
                            echo "<td class='px-4 py-3'>" . $rowPrescricao['nome'] . "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php 
        if($response) {
            include 'components/dadosApi.php';
        }
    ?>