document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchUser');
    const suggestionsContainer = document.getElementById('userSuggestions');
    const selectedUserMail = document.getElementById('selectedUserMail'); // Corrigido para pegar o elemento correto

    searchInput.addEventListener('input', function() {
        const query = this.value;

        if (query.length > 0) {
            fetch(`${searchUserUrl}?query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    suggestionsContainer.innerHTML = '';

                    data.forEach(user => {
                        const suggestionItem = document.createElement('a');
                        suggestionItem.href = '#'; // Pode ajustar conforme necessário
                        suggestionItem.className = 'list-group-item list-group-item-action';
                        suggestionItem.textContent = user.name; // Supondo que o usuário tenha uma propriedade 'name'

                        suggestionItem.addEventListener('click', function() {
                            searchInput.value = user.name; // Preenche o campo de entrada com a sugestão
                            selectedUserMail.value = user.email; // Preenche o campo oculto com o e-mail do usuário
                            suggestionsContainer.innerHTML = ''; // Limpa as sugestões após selecionar
                        });

                        suggestionsContainer.appendChild(suggestionItem);
                    });
                })
                .catch(error => console.error('Erro ao buscar usuários:', error));
        } else {
            suggestionsContainer.innerHTML = ''; // Limpa sugestões se o campo estiver vazio
        }
    });
});