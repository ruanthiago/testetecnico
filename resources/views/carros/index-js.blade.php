<script>
    /* Metodo responsavel pela exclusão de um item */
    async function deleteItem(id) {
        /* Dados da requisição */
        let headers = new Headers()
        headers.append("X-CSRF-TOKEN", '{{ csrf_token() }}')

        /* Faz a requisição, e espera o seu retorno para só assim prosseguir */
        let resp = await fetch(`{{ url('') }}/carros/${id}/delete`, {method: 'delete', headers: headers})

        /* Pegando a resposta, e transformando em formato json (retorna tbm uma promise) */
        let json = await resp.json();

        /* Configurando o toast */
        document.getElementById('liveToast').setAttribute('class', `toast align-items-center text-white bg-${json.status} border-0`)
        document.getElementById('toast-msg').innerHTML = (json.status == 'success') ? 'Excluido com sucesso' : 'Não foi possivel excluir o item'

        /* Mostrando o toast */
        new bootstrap.Toast(document.getElementById('liveToast')).show()

        /* Removendo a tr */
        document.getElementById(`item-${id}`).remove()
    }
</script>
