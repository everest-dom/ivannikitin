function redirectUser(config, formName, formId, name, email, phone)
{
	var country = ymaps.geolocation.country,
        region = ymaps.geolocation.region;

    var url;

    if (country == 'Россия')
    {
        var defined = false;
        // Перебираем временные регионы России
        for(var key in config['regions']['rus']) {
            // Проверяем, входит ли регион пользователя
            if (config['regions']['rus'][key].indexOf(region) != -1) {
                url = getUrl(config['common']['url'], config['forms'][key], formName, formId, name, email, phone);
                defined = true;
                goToPage(url);
            }
        }
        if(!defined) {
            url = getUrl(config['common']['url'], config['forms']['msk'], formName, formId, name, email, phone);
            goToPage(url);
        }

    }
    else 
    {
        if(country == 'Казахстан') {
            url = getUrl(config['common']['url'], config['forms']['ekb'], formName, formId, name, email, phone);
            goToPage(url);
        } else {
            url = getUrl(config['common']['url'], config['forms']['eu'], formName, formId, name, email, phone);
            goToPage(url);
        }
    }
}

function getUrl(url, regionData, formName, formId, name, email, phone)
{
	// Определяем Ид списка подписки
	var listId = regionData['list'][formName][ getCurrentFormPrefix(regionData['hour']) ];

	// Добавляем Ид списка в ссылку
	url = url.replace('#LIST#', listId);

	// Добавляем Ид формы в ссылку
	url = url.replace('#REF#', formId);

    // Добавляем спец метку в форму
    url = url.replace('#MARK#', 'traf_' + getCurrentFormPrefixOther(regionData['hour']) + '_' + regionData['hour']);

	// Добавляем данные о пользователе в ссылку
	url = url.replace('#NAME#', name).replace('#EMAIL#', email).replace('#PHONE#', phone);

	// Добавляем УТМ-метки в форму
	$.urlParam = function(name){
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
        if (results==null) {
            return null;
        }
        else {
            return results[1] || 0;
        }
    };
    var utms = ['utm_campaign', 'utm_content', 'utm_term', 'utm_medium', 'utm_source'];
    $.each(utms, function(i, val){
        url = url.replace('#' + val.toUpperCase() + '#', $.urlParam(val));
    });

    // Добавляем ссылку подписки
    url = url.replace('#HTTP_REFERER#', encodeURIComponent(window.location));

    // Добавляем время подписки (от 00:00:00 текущего дня, в секундах)
    var h = parseInt(moment().tz("Europe/Moscow").format('H'));
    var m = parseInt(moment().tz("Europe/Moscow").format('m'));
    var s = parseInt(moment().tz("Europe/Moscow").format('s'));

    var time = h * 3600 + m * 60 + s;
    url = url.replace('#TIME#', time);

	// Итоговая ссылка
	return url;
}

function goToPage(url)
{
    window.location.href = url;
	return true;
}

function showText()
{
    var country = ymaps.geolocation.country,
        region = ymaps.geolocation.region;

    console.log(country, region);

    if (country == 'Россия')
    {
        var defined = false;
        // Перебираем временные регионы России
        for(var key in config['regions']['rus']) {
            // Проверяем, входит ли регион пользователя
            if (config['regions']['rus'][key].indexOf(region) != -1) {
                $('#text_' + key + '_' + getCurrentFormPrefix(config['forms'][key]['hour'])).removeClass('hide');
                defined = true;
            }
        }
        if(!defined)
            $('#text_msk_' + getCurrentFormPrefix(config['forms']['msk']['hour'])).removeClass('hide');
    }
    else
    {
        $('#text_eu_' + getCurrentFormPrefix(config['forms']['eu']['hour'])).removeClass('hide');
    }
}

function getCurrentFormPrefix(hour)
{
    // Определяем текущий час (по МСК)
    var currentMoscowHour = moment().tz("Europe/Moscow").format('H');
    return hour > currentMoscowHour ? 'd' : 'e';
}

function getCurrentFormPrefixOther(hour)
{
    // Определяем текущий час (по МСК)
    var currentMoscowHour = moment().tz("Europe/Moscow").format('H');
    return hour > currentMoscowHour ? 'd' : 'n';
}