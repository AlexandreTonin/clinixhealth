<div class="border w-full rounded-lg p-4 bg-white text-red-700">
        <h2 class="font-bold text-lg flex items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-hospital">
                <path d="M12 6v4" />
                <path d="M14 14h-4" />
                <path d="M14 18h-4" />
                <path d="M14 8h-4" />
                <path d="M18 12h2a2 2 0 0 1 2 2v6a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-9a2 2 0 0 1 2-2h2" />
                <path d="M18 22V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v18" />
            </svg>

            Dados da API externa
        </h2>

        <hr class="my-2">
        <div class="border w-full rounded-lg p-4 bg-white">
            <h2 class="font-bold text-lg flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pill">
                    <path d="m10.5 20.5 10-10a4.95 4.95 0 1 0-7-7l-10 10a4.95 4.95 0 1 0 7 7Z" />
                    <path d="m8.5 8.5 7 7" />
                </svg>
                Dados da Paciente
            </h2>
            <hr class="my-2">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 aa-text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 aa-bg-gray-700 aa-text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">Campo</th>
                            <th scope="col" class="px-4 py-3">Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b aa-border-gray-700">
                            <td class="px-4 py-3">ID do Paciente</td>
                            <td class="px-4 py-3"><?php echo $id_paciente; ?></td>
                        </tr>
                        <tr class="border-b aa-border-gray-700">
                            <td class="px-4 py-3">Nome</td>
                            <td class="px-4 py-3"><?php echo $nome; ?></td>
                        </tr>
                        <tr class="border-b aa-border-gray-700">
                            <td class="px-4 py-3">Data de Nascimento</td>
                            <td class="px-4 py-3"><?php echo $data_nascimento; ?></td>
                        </tr>
                        <tr class="border-b aa-border-gray-700">
                            <td class="px-4 py-3">CPF</td>
                            <td class="px-4 py-3"><?php echo $cpf; ?></td>
                        </tr>
                        <tr class="border-b aa-border-gray-700">
                            <td class="px-4 py-3">Email</td>
                            <td class="px-4 py-3"><?php echo $email; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="border w-full rounded-lg p-4 bg-white mt-4">
            <h2 class="font-bold text-lg flex items-center gap-1">
                Exames
            </h2>
            <hr class="my-2">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 aa-text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 aa-bg-gray-700 aa-text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">Tipo de Exame</th>
                            <th scope="col" class="px-4 py-3">Resultado</th>
                            <th scope="col" class="px-4 py-3">Data</th>
                            <th scope="col" class="px-4 py-3">Médico</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($exames as $exame): ?>
                            <tr class="border-b aa-border-gray-700">
                                <td class="px-4 py-3"><?php echo exibir_dados($exame->object[0]); ?></td>
                                <td class="px-4 py-3"><?php echo exibir_dados($exame->object[1]); ?></td>
                                <td class="px-4 py-3"><?php echo exibir_dados($exame->object[2]); ?></td>
                                <td class="px-4 py-3"><?php echo exibir_dados($exame->object[4]); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="border w-full rounded-lg p-4 bg-white mt-4">
            <h2 class="font-bold text-lg flex items-center gap-1">
                Prescrições
            </h2>
            <hr class="my-2">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 aa-text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 aa-bg-gray-700 aa-text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">Descrição</th>
                            <th scope="col" class="px-4 py-3">Data</th>
                            <th scope="col" class="px-4 py-3">Médico</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($prescricoes as $prescricao): ?>
                            <tr class="border-b aa-border-gray-700">
                                <td class="px-4 py-3"><?php echo exibir_dados($prescricao->object[0]); ?></td>
                                <td class="px-4 py-3"><?php echo exibir_dados($prescricao->object[1]); ?></td>
                                <td class="px-4 py-3"><?php echo exibir_dados($prescricao->object[3]); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="border w-full rounded-lg p-4 bg-white mt-4">
            <h2 class="font-bold text-lg flex items-center gap-1">
                Diagnósticos
            </h2>
            <hr class="my-2">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 aa-text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 aa-bg-gray-700 aa-text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">Descrição</th>
                            <th scope="col" class="px-4 py-3">Data</th>
                            <th scope="col" class="px-4 py-3">Médico</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($diagnosticos as $diagnostico): ?>
                            <tr class="border-b aa-border-gray-700">
                                <td class="px-4 py-3"><?php echo exibir_dados($diagnostico->object[0]); ?></td>
                                <td class="px-4 py-3"><?php echo exibir_dados($diagnostico->object[1]); ?></td>
                                <td class="px-4 py-3"><?php echo exibir_dados($diagnostico->object[3]); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>