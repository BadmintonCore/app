/**
 * This file is part of the vestis. webshop ecosystem
 *
 * © 2025 Mathis Burger, Lasse Hoffmann, Lennart Moog
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */
const track = document.querySelector('.carousel-track');
const images = document.querySelectorAll('.carousel-image');
const prevButton = document.querySelector('.prev');
const nextButton = document.querySelector('.next');

let currentIndex = 0;

function updateCarousel() {
    const offset = -currentIndex * track.clientWidth;
    track.style.transform = `translateX(${offset}px)`;
}

if (prevButton && nextButton && track) {

    prevButton.addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        updateCarousel();
    });

    nextButton.addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % images.length;
        updateCarousel();
    });
}