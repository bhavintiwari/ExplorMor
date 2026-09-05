fetch('destination.php')
    .then(response => response.json())  // Parse the JSON data
    .then(destinations => {
        const destinationGrid = document.getElementById('destination-grid');
        
        // Loop through each destination and create the HTML dynamically
        destinations.forEach(destination => {
            const card = document.createElement('div');
            card.classList.add('destination-card');
            
            card.innerHTML = `
                <img src="${destination.image}" alt="${destination.name}">
                <h3>${destination.name}</h3>
                <p>${destination.description}</p>
                <a href="${destination.url}" class="destination">View Packages</a>
            `;
            
            destinationGrid.appendChild(card);
        });
    })
    .catch(error => console.error('Error loading destinations:', error));
