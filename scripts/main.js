// Отримуємо посилання на елементи кнопок та спливаючих вікон
const openProfileBtn = document.getElementById('open_pop_up');
const closeProfileBtn = document.getElementById('pop_up_close');
const profilePopUp = document.getElementById('pop_up');

// Функція, яка відкриває спливаюче вікно
function openPopUp(popUpElement) {
    popUpElement.classList.add('active');
}

// Функція, яка закриває спливаюче вікно
function closePopUp(popUpElement) {
    popUpElement.classList.remove('active');
}

// Додаємо обробники подій для кнопок
openProfileBtn.addEventListener('click', () => openPopUp(profilePopUp));
closeProfileBtn.addEventListener('click', () => closePopUp(profilePopUp));
