document.addEventListener('DOMContentLoaded', () => {
    const stepItems = document.querySelectorAll('.step-item');
    const stepRulerItems = document.querySelectorAll('.step-ruler__item');

    if (stepItems.length === stepRulerItems.length && stepItems.length > 0) {
        stepRulerItems.forEach((rulerItem, index) => {
            rulerItem.addEventListener('mouseenter', () => {
                stepItems[index].classList.add('is-highlighted');
                rulerItem.classList.add('is-hovered'); // Keep ruler item hovered effect
            });

            rulerItem.addEventListener('mouseleave', () => {
                stepItems[index].classList.remove('is-highlighted');
                rulerItem.classList.remove('is-hovered'); // Remove ruler item hovered effect
            });
        });
    }
});