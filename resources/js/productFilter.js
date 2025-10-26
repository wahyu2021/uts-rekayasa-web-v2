
document.addEventListener('DOMContentLoaded', function() {
    // Product Filtering Logic for Checkboxes with a Trigger Button
    const filterCheckboxes = document.querySelectorAll('.filter-checkbox');
    const productCards = document.querySelectorAll('.product-card');
    const applyFilterBtn = document.getElementById('applyFilterBtn');

    function filterProducts() {
        const selectedFilters = Array.from(filterCheckboxes)
            .filter(checkbox => checkbox.checked && checkbox.value !== 'all')
            .map(checkbox => checkbox.value);

        const showAll = document.getElementById('filterAll').checked || selectedFilters.length === 0;

        productCards.forEach(card => {
            const category = card.dataset.category;
            let shouldShow = false;

            if (showAll) {
                shouldShow = true;
            } else {
                shouldShow = selectedFilters.includes(category);
            }

            if (shouldShow) {
                card.style.display = 'flex'; // Show product
            } else {
                card.style.display = 'none'; // Hide product
            }
        });
    }

    filterCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (this.value === 'all') {
                // If 'All' is checked, uncheck others and check 'All'
                filterCheckboxes.forEach(cb => {
                    if (cb !== this) cb.checked = false;
                });
                this.checked = true; // Ensure 'All' remains checked
            } else {
                // If any other filter is checked, uncheck 'All'
                document.getElementById('filterAll').checked = false;
                // If all other filters are unchecked, check 'All'
                const anyOtherChecked = Array.from(filterCheckboxes).some(cb => cb.checked && cb.value !== 'all');
                if (!anyOtherChecked) {
                    document.getElementById('filterAll').checked = true;
                }
            }
            // Do NOT call filterProducts() here
        });
    });

    // Add event listener to the new apply filter button
    if (applyFilterBtn) {
        applyFilterBtn.addEventListener('click', filterProducts);
    }

    // Initial filter on page load
    filterProducts();
});
