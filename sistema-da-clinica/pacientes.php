<?php
include 'components/sidebar.php';
include 'db/db_connect.php';

$sql = "SELECT * FROM paciente";
$result = $conn->query($sql);

// if ($result->num_rows > 0) {
//     echo "<table border='1'>";
//     echo "<tr>";
//     echo "<th>Nome</th>";
//     echo "<th>CPF</th>";
//     echo "<th>Telefone</th>";
//     echo "<th>Email</th>";
//     echo "<th>Endereço</th>";
//     echo "<th>Sexo</th>";
//     echo "<th>Data de Nascimento</th>";
//     echo "<th>Editar</th>";
//     echo "<th>Excluir</th>";
//     echo "</tr>";

//     while($row = $result->fetch_assoc()) {
//         echo "<tr>";
//         echo "<td>" . $row['nome'] . "</td>";
//         echo "<td>" . $row['cpf'] . "</td>";
//         echo "<td>" . $row['telefone'] . "</td>";
//         echo "<td>" . $row['email'] . "</td>";
//         echo "<td>" . $row['endereco'] . "</td>";
//         echo "<td>" . $row['sexo'] . "</td>";
//         echo "<td>" . $row['data_nascimento'] . "</td>";
//         echo "<td><a href='editar_paciente.php?id=" . $row['id'] . "'>Editar</a></td>";
//         echo "<td><a href='excluir_paciente.php?id=" . $row['id'] . "'>Excluir</a></td>";
//         echo "</tr>";
//     }

//     echo "</table>";
// } else {
//     echo "0 resultados";
// }
?>


<div class="bg-white aa-bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
    <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
        <div class="w-full md:w-1/2">
            <form class="flex items-center">
                <label for="simple-search" class="sr-only">Search</label>
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 aa-text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 aa-bg-gray-700 aa-border-gray-600 aa-placeholder-gray-400 aa-text-white aa-focus:ring-primary-500 aa-focus:border-primary-500" placeholder="Search" required="">
                </div>
            </form>
        </div>
        <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
            <button type="button" class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 aa-bg-primary-600 aa-hover:bg-primary-700 focus:outline-none aa-focus:ring-primary-800">
                <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                </svg>
                Add product
            </button>
            <div class="flex items-center space-x-3 w-full md:w-auto">
                <a href="#" class="w-full md:w-auto flex items-center text-white font-bold justify-center bg-blue-500 py-2 px-2 text-sm rounded-lg hover:bg-blue-600 gap-1 transition" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus">
                        <path d="M5 12h14" />
                        <path d="M12 5v14" />
                    </svg>
                    Cadastrar Paciente
                </a>
                <div id="actionsDropdown" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow aa-bg-gray-700 aa-divide-gray-600">
                    <ul class="py-1 text-sm text-gray-700 aa-text-gray-200" aria-labelledby="actionsDropdownButton">
                        <li>
                            <a href="#" class="block py-2 px-4 hover:bg-gray-100 aa-hover:bg-gray-600 aa-hover:text-white">Mass Edit</a>
                        </li>
                    </ul>
                    <div class="py-1">
                        <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 aa-hover:bg-gray-600 aa-text-gray-200 aa-hover:text-white">Delete all</a>
                    </div>
                </div>

                <div id="filterDropdown" class="z-10 hidden w-48 p-3 bg-white rounded-lg shadow aa-bg-gray-700">
                    <h6 class="mb-3 text-sm font-medium text-gray-900 aa-text-white">Choose brand</h6>
                    <ul class="space-y-2 text-sm" aria-labelledby="filterDropdownButton">
                        <li class="flex items-center">
                            <input id="apple" type="checkbox" value="" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 aa-focus:ring-primary-600 aa-ring-offset-gray-700 focus:ring-2 aa-bg-gray-600 aa-border-gray-500">
                            <label for="apple" class="ml-2 text-sm font-medium text-gray-900 aa-text-gray-100">Apple (56)</label>
                        </li>
                        <li class="flex items-center">
                            <input id="fitbit" type="checkbox" value="" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 aa-focus:ring-primary-600 aa-ring-offset-gray-700 focus:ring-2 aa-bg-gray-600 aa-border-gray-500">
                            <label for="fitbit" class="ml-2 text-sm font-medium text-gray-900 aa-text-gray-100">Microsoft (16)</label>
                        </li>
                        <li class="flex items-center">
                            <input id="razor" type="checkbox" value="" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 aa-focus:ring-primary-600 aa-ring-offset-gray-700 focus:ring-2 aa-bg-gray-600 aa-border-gray-500">
                            <label for="razor" class="ml-2 text-sm font-medium text-gray-900 aa-text-gray-100">Razor (49)</label>
                        </li>
                        <li class="flex items-center">
                            <input id="nikon" type="checkbox" value="" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 aa-focus:ring-primary-600 aa-ring-offset-gray-700 focus:ring-2 aa-bg-gray-600 aa-border-gray-500">
                            <label for="nikon" class="ml-2 text-sm font-medium text-gray-900 aa-text-gray-100">Nikon (12)</label>
                        </li>
                        <li class="flex items-center">
                            <input id="benq" type="checkbox" value="" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 aa-focus:ring-primary-600 aa-ring-offset-gray-700 focus:ring-2 aa-bg-gray-600 aa-border-gray-500">
                            <label for="benq" class="ml-2 text-sm font-medium text-gray-900 aa-text-gray-100">BenQ (74)</label>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 aa-text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 aa-bg-gray-700 aa-text-gray-400">
                <tr>
                    <th scope="col" class="px-4 py-3">Nome</th>
                    <th scope="col" class="px-4 py-3">Cpf</th>
                    <th scope="col" class="px-4 py-3">Data de Nascimento</th>
                    <th scope="col" class="px-4 py-3">Telefone</th>
                    <th scope="col" class="px-4 py-3">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr class='border-b aa-border-gray-700'>";
                        echo "<td class='px-4 py-3 font-medium text-gray-900 whitespace-nowrap aa-text-white'>" . $row['nome'] . "</td>";
                        echo "<td class='px-4 py-3'>" . $row['cpf'] . "</td>";
                        echo "<td class='px-4 py-3'>" . $row['data_nascimento'] . "</td>";
                        echo "<td class='px-4 py-3'>" . $row['telefone'] . "</td>";
                        echo "<td class='px-4 py-3'> <a href='/clinixhealth/prontuario.php?id=".$row['id']."' class='hover:underline text-blue-500'>Ver prontuário</a> </td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Table navigation">
        <span class="text-sm font-normal text-gray-500 aa-text-gray-400">
            Pacientes Cadastrados:
            <span class="font-semibold text-gray-900 aa-text-white">
                <?php echo "$result->num_rows"; ?>
            </span>
        </span>
    </nav>
</div>

<script>
    document.getElementById('simple-search').addEventListener('input', function() {
        var filter = this.value.toLowerCase();
        var rows = document.querySelectorAll('tbody tr');

        rows.forEach(function(row) {
            var cells = row.getElementsByTagName('td');
            var matched = false;

            // Percorre as células da linha e verifica se algum valor contém o filtro
            for (var i = 0; i < cells.length; i++) {
                if (cells[i].textContent.toLowerCase().includes(filter)) {
                    matched = true;
                    break;
                }
            }

            // Mostra ou esconde a linha conforme o filtro
            if (matched) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
