function showLocationInfo(locationId) {
    const locationInfo = document.getElementById('location-info');
    if (!locationInfo) return;

    // Создаем объект с описаниями на обоих языках
    const locations = {
        'kaer-morhen': {
            name: document.querySelector(".location-card[onclick*='kaer-morhen'] h4").textContent,
            ru: 'Древняя крепость ведьмаков Школы Волка, расположенная в горах. Здесь Геральт проходил обучение.',
            en: 'Ancient fortress of the Wolf School witchers, located in the mountains. Geralt trained here.'
        },
        'novigrad': {
            name: document.querySelector(".location-card[onclick*='novigrad'] h4").textContent,
            ru: 'Самый большой город Севера, центр торговли и религии. Также известен как "Город Вечного Огня".',
            en: 'The largest city in the North, a center of trade and religion. Also known as the "City of Eternal Fire".'
        },
        'skellige': {
            name: document.querySelector(".location-card[onclick*='skellige'] h4").textContent,
            ru: 'Архипелаг воинственных островитян, чтящих традиции предков и поклоняющихся скандинавским богам.',
            en: 'Archipelago of warlike islanders who honor ancestral traditions and worship Norse gods.'
        }
    };

    // Определяем текущий язык
    const currentLang = document.documentElement.lang;
    
    // Отображаем информацию
    locationInfo.innerHTML = `
        <h4>${locations[locationId].name}</h4>
        <p>${locations[locationId][currentLang]}</p>
    `;
    locationInfo.style.display = 'block';
}
// Функция для переключения между фракциями
function openFaction(factionId) {
    // Скрываем все вкладки
    const tabContents = document.getElementsByClassName('tab-content');
    for (let i = 0; i < tabContents.length; i++) {
        tabContents[i].style.display = 'none';
    }

    // Убираем активный класс у всех кнопок
    const tabButtons = document.getElementsByClassName('tab-button');
    for (let i = 0; i < tabButtons.length; i++) {
        tabButtons[i].classList.remove('active');
    }

    // Показываем выбранную вкладку и делаем кнопку активной
    document.getElementById(factionId).style.display = 'block';
    event.currentTarget.classList.add('active');
}

// Анимация появления элементов при прокрутке
document.addEventListener('DOMContentLoaded', function() {
    const animateElements = document.querySelectorAll('.location-card, .faction-tabs, .monster-card');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = 1;
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.1 });
    
    animateElements.forEach(element => {
        element.style.opacity = 0;
        element.style.transform = 'translateY(20px)';
        element.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        observer.observe(element);
    });

    // Показываем информацию о первой локации при загрузке
    showLocationInfo('kaer-morhen');
});

// Обработчик для кнопки "Смотреть больше" в бестиарии
document.querySelector('.see-more')?.addEventListener('click', function() {
    const message = document.documentElement.lang === 'ru' 
        ? 'Полный бестиарий будет добавлен в следующем обновлении!'
        : 'Full bestiary will be added in the next update!';
    alert(message);
});