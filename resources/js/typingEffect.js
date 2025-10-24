document.addEventListener('DOMContentLoaded', function() {
    const typedTextSpan = document.getElementById('typed-text');

    if (typedTextSpan) {
        const phrases = [
            "Jersey Basket Kustom Terbaik",
            "PDL & PDH Desain Sesuai Keinginan",
            "Jersey Futsal & Esport Berkualitas Tinggi",
            "Hoodie dan Jaket Gaya Kekinian"
        ];
        let phraseIndex = 0;
        let charIndex = 0;
        let isDeleting = false;
        const typingSpeed = 100; // milliseconds
        const deletingSpeed = 50; // milliseconds
        const pauseBeforeDelete = 1500; // milliseconds
        const pauseBeforeType = 500; // milliseconds

        function type() {
            const currentPhrase = phrases[phraseIndex];
            if (isDeleting) {
                typedTextSpan.textContent = currentPhrase.substring(0, charIndex - 1);
                charIndex--;
            } else {
                typedTextSpan.textContent = currentPhrase.substring(0, charIndex + 1);
                charIndex++;
            }

            if (!isDeleting && charIndex === currentPhrase.length) {
                setTimeout(() => isDeleting = true, pauseBeforeDelete);
            } else if (isDeleting && charIndex === 0) {
                isDeleting = false;
                phraseIndex = (phraseIndex + 1) % phrases.length;
                setTimeout(type, pauseBeforeType);
                return;
            }

            const speed = isDeleting ? deletingSpeed : typingSpeed;
            setTimeout(type, speed);
        }

        type();
    }
});