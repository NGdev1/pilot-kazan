/**
 * Created by Михаил on 01.12.2016.
 */

ymaps.ready(function () {
    latLng1 = [55.788282, 49.132995];
    latLng2 = [55.789097, 49.120185];

    var myMap = new ymaps.Map('map', {
        center: [55.788500, 49.126195],
        zoom: 15
    }, {
        searchControlProvider: 'yandex#search'
    });

    myPlacemark1 = new ymaps.Placemark(latLng1, {
        hintContent: 'Автошкола Пилот-М',
        balloonContent: 'г. Казань, ул, Бутлерова, дом 30'
    });

    myPlacemark2 = new ymaps.Placemark(latLng2, {
        hintContent: 'Автошкола Пилот-М',
        balloonContent: 'г. Казань, ул. Профсоюзная, дом 40-42'
    });

    myMap.geoObjects.add(myPlacemark1);
    myMap.geoObjects.add(myPlacemark2);
    myMap.behaviors.disable(['scrollZoom', 'multiTouch']);
});






