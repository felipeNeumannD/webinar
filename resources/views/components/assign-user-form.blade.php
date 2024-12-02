<style>
    #user_results {
        max-height: 200px;
        overflow-y: auto;
        border: 1px solid #ddd;
        border-radius: 5px;
        background: #fff;
        position: absolute;
        z-index: 1000;
        width: 100%;
        list-style: none;
        padding: 0;
        margin: 0;
        width: 680px;
    }

    .list-group-item {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        cursor: pointer;
    }

    .list-group-item:last-child {
        border-bottom: none;
    }

    .list-group-item:hover {
        background-color: #f0f0f0;
    }
</style>

<div class="container">
    <h4>Adicionar Usuários à Máquina: {{ $machineModel->name }}</h4>
    <form action="{{ route('assign.machine.store') }}" method="POST">
        @csrf
        <input type="hidden" name="machine_id" value="{{ $machineModel->id }}">
        <div class="mb-3">
            <label for="user_id" class="form-label">Usuário</label>
            <select name="user_id" id="user_id" class="form-select" required>
                <option value="" selected disabled>Selecione um usuário</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="is_admin" name="is_admin" value="1">
            <label for="is_admin" class="form-check-label">Tornar Administrador</label>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('user_search');
        const resultsList = document.getElementById('user_results');
        const userIdInput = document.getElementById('user_id');

        searchInput.addEventListener('input', function () {
            const query = searchInput.value.trim();

            if (query.length >= 2) {
                fetch(`{{ route('searchUser') }}?query=${encodeURIComponent(query)}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Erro na requisição');
                        }
                        return response.json();
                    })
                    .then(users => {
                        resultsList.style.display = 'block';
                        resultsList.innerHTML = ''; // Limpa os resultados anteriores

                        if (users.length === 0) {
                            resultsList.innerHTML = '<li class="list-group-item text-muted">Nenhum usuário encontrado</li>';
                            return;
                        }

                        users.forEach(user => {
                            const li = document.createElement('li');
                            li.className = 'list-group-item';
                            li.textContent = user.name;

                            // Adiciona o evento de clique para cada item
                            li.addEventListener('click', function () {
                                // Atualiza o campo de texto e o input hidden
                                searchInput.value = user.name;
                                userIdInput.value = user.id;

                                // Esconde a lista
                                resultsList.style.display = 'none';
                            });

                            resultsList.appendChild(li);
                        });
                    })
                    .catch(error => {
                        console.error('Erro ao buscar usuários:', error);
                    });
            } else {
                resultsList.style.display = 'none';
            }
        });

        // Fecha a lista ao clicar fora dela
        document.addEventListener('click', function (event) {
            if (!searchInput.contains(event.target) && !resultsList.contains(event.target)) {
                resultsList.style.display = 'none';
            }
        });
    });
</script>