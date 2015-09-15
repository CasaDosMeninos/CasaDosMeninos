<div class="widget">
    <div class="title"><img src="{{ asset('images/icons/dark/books.png') }}" alt="" class="titleIcon" />
        <h6>Histórico</h6>
    </div>

    <table cellpadding="0" cellspacing="0" border="0" class="display dTable">
        <thead>
        <tr>
            <th>Título</th>
            <th>Data do pedido</th>
            <th>Data da devolução</th>
            @if($modo == 'solicitacao')
                <th>Solicitante</th>
            @elseif($modo == 'pedido')
                <th>Dono</th>
            @elseif($modo == 'todos')
                <th>Solicitante</th>
                <th>Dono</th>
            @endif

            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($emprestimos as $emprestimo)
            <tr>
                @if($modo == 'solicitacao')
                    <td>/emprestimo/solicitacao/ver/{{ $emprestimo->id }};{{ $emprestimo->livro->titulo }}</td>
                    <td>{{ $emprestimo->created_at->format('d/m/Y') }}</td>
                    <td>{{ $emprestimo->data->format('d/m/Y') }}</td>
                    <td>{{ $emprestimo->solicitante->name }}</td>
                @elseif($modo == 'pedido')
                    <td>/emprestimo/meu/ver/{{ $emprestimo->id }};{{ $emprestimo->livro->titulo }}</td>
                    <td>{{ $emprestimo->created_at->format('d/m/Y') }}</td>
                    <td>{{ $emprestimo->data->format('d/m/Y') }}</td>
                    <td>{{ $emprestimo->dono->name }}</td>
                @elseif($modo == 'todos')
                    <td>/emprestimo/solicitacao/ver/{{ $emprestimo->id }};{{ $emprestimo->livro->titulo }}</td>
                    <td>{{ $emprestimo->created_at->format('d/m/Y') }}</td>
                    <td>{{ $emprestimo->data->format('d/m/Y') }}</td>
                    <td>{{ $emprestimo->solicitante->name }}</td>
                    <td>{{ $emprestimo->dono->name }}</td>
                @endif

                <td>{{ $emprestimo->status->nome }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>