<x-app-layout>
    <!-- Formulario ultilizado para buscar os registros -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form id="form" class="p-3 m-3" method="post" action="{{ route('carros-capturar') }}">
                    @csrf
                    <div class="row">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="O que deseja capturar?">
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Capturar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Tabela de carros -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <table class="table m-0">
                    <thead>
                        <tr>
                            <th scope="col">Nome do veiculo</th>
                            <th scope="col">Ano</th>
                            <th scope="col">Quil.</th>
                            <th scope="col">Combustivel</th>
                            <th scope="col">Cambio</th>
                            <th scope="col">Portas</th>
                            <th scope="col">Cor</th>
                            <th scope="col">Preco</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Listagem dos registros -->
                        @forelse($cars as $car)
                            <tr id="item-{{ $car['id'] }}">
                                <td>{{ $car['nome_veiculo'] }}</td>
                                <td>{{ $car['ano'] }}</td>
                                <td>{{ $car['quilometragem'] }}</td>
                                <td>{{ $car['combustivel'] }}</td>
                                <td>{{ $car['cambio'] }}</td>
                                <td>{{ $car['portas'] }}</td>
                                <td>{{ $car['cor'] }}</td>
                                <td>{{ $car['preco'] }}</td>
                                <td style="display: flex;">
                                    <!-- Visualizar -->
                                    <a href="{{ $car['link'] }}" target="_blanck" class="pr-1" style="margin-right:10px;"><img src="{{ asset('imgs/link.png') }}" width="20"></a>

                                    <!-- Excluir registro -->
                                    <a href="javascript:deleteItem({{ $car['id'] }});"><img src="{{ asset('imgs/trash.png') }}" width="20"></a>
                                </td>
                            </th>
                        @empty
                            <tr>
                                <th class="table-warning m-0" style="text-align:center;" colspan="9">Não existe nenhum regisro salvo. Para capturar basta pesquisar pelo termo e clicar no botão "<strong>Capturar</strong>"</th>
                            </th>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Importando o toast -->
    @include('carros.toast')

    <!-- Importando o js -->
    @include('carros.index-js')
</x-app-layout>
