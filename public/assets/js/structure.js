// Script pour générer des flocons de neige
document.addEventListener('DOMContentLoaded', () => {
    const snowflakesContainer = document.querySelector('.snowflakes'); // Récupère le conteneur des flocons
    const numberOfSnowflakes = 100; // Nombre de flocons à générer

    for (let i = 0; i < numberOfSnowflakes; i++) {
        const snowflake = document.createElement('div');
        snowflake.classList.add('snowflake');
        snowflake.textContent = ['❄', '❅', '❆'][Math.floor(Math.random() * 3)]; // Choisir un flocon aléatoire
        snowflake.style.left = Math.random() * 100 + 'vw'; // Position aléatoire sur l'axe X
        snowflake.style.fontSize = Math.random() * 1.5 + 1 + 'em'; // Taille aléatoire
        snowflake.style.animationDuration = Math.random() * 5 + 5 + 's'; // Durée aléatoire de la chute
        snowflake.style.animationDelay = Math.random() * 5 + 's'; // Retard de démarrage de l'animation
        snowflake.style.opacity = Math.random(); // Opacité aléatoire

        // Ajouter le flocon au conteneur
        snowflakesContainer.appendChild(snowflake);
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const addEmailButton = document.getElementById('add-email');
    const container = document.getElementById('emails-container');
    let index = container.children.length; // Pour suivre le nombre de champs ajoutés

    addEmailButton.addEventListener('click', function () {
        const prototype = container.dataset.prototype; // Récupère le prototype défini
        const newField = prototype.replace(/__name__/g, index); // Remplace __name__ par l'index
        container.insertAdjacentHTML('beforeend', newField); // Ajoute le nouveau champ
        index++; // Incrémente l'index
    });
});

