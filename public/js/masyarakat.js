document.addEventListener('DOMContentLoaded', () => {
        try {
            lucide.createIcons();
        } catch (e) {}

        // Dynamic Search Box Handler
        const searchInput = document.querySelector('.header-search-form input[name="search"]');
        const searchForm = document.querySelector('.header-search-form');
        
        if (searchInput && searchForm) {
            const currentPath = window.location.pathname.toLowerCase();
            
            // Check if we are on the Layanan page
            if (currentPath.includes('/layanan')) {
                // Prevent form submission on enter
                searchForm.addEventListener('submit', (e) => e.preventDefault());
                
                searchInput.addEventListener('input', (e) => {
                    const query = e.target.value.toLowerCase().trim();
                    document.querySelectorAll('.premium-service-card').forEach(card => {
                        const name = card.querySelector('h3').textContent.toLowerCase();
                        const desc = card.querySelector('p').textContent.toLowerCase();
                        if (name.includes(query) || desc.includes(query)) {
                            card.style.display = 'flex';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            }
            // Check if we are on the Bantuan (Help Center) page
            else if (currentPath.includes('/bantuan')) {
                // Prevent form submission on enter
                searchForm.addEventListener('submit', (e) => e.preventDefault());
                
                searchInput.addEventListener('input', (e) => {
                    const query = e.target.value.toLowerCase().trim();
                    
                    // Filter FAQ items
                    document.querySelectorAll('.faq-item').forEach(item => {
                        const question = item.querySelector('.faq-question span').textContent.toLowerCase();
                        const answer = item.querySelector('.faq-answer').textContent.toLowerCase();
                        if (question.includes(query) || answer.includes(query)) {
                            item.style.display = 'block';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                    
                    // Filter category cards
                    document.querySelectorAll('.cat-card').forEach(card => {
                        const title = card.querySelector('h3').textContent.toLowerCase();
                        const desc = card.querySelector('p').textContent.toLowerCase();
                        if (title.includes(query) || desc.includes(query)) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            }
        }
    });