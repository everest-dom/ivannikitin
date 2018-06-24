<!-- Начало скрипта обработки email поля -->
$('[data-type="email"] input').change(function() {
    var i,j;
// Получаем значение поля email
    var emailtext = $(this).val();
// Удаляем пробелы
    var email = emailtext.replace(/\s/g, '');
// Удаляем лишние символы
    email = email.replace(/\//g, '');
// Удаляем/заменяем русские буквы
    var rualphabet = new Array({'А' : 'a'},{'а' : 'a'},{'Б' : ''},{'б' : ''},{'В' : 'b'},{'в' : 'b'},{'Г' : ''},{'г' : ''},{'Д' : ''},{'д' : ''},{'Е' : 'e'},{'е' : 'e'},{'Ё' : 'e'},{'ё' : 'e'},{'Ж' : ''},{'ж' : ''},{'З' : ''},{'з' : ''},{'И' : ''},{'и' : ''},{'Й' : ''},{'й' : ''},{'К' : 'k'},{'к' : 'k'},{'Л' : ''},{'л' : ''},{'М' : 'm'},{'м' : 'm'},{'Н' : 'h'},{'н' : 'h'},{'О' : 'o'},{'о' : 'o'},{'П' : ''},{'п' : ''},{'Р' : 'p'},{'р' : 'p'},{'С' : 'c'},{'с' : 'c'},{'Т' : 't'},{'т' : 't'},{'У' : 'y'},{'у' : 'y'},{'Ф' : ''},{'ф' : ''},{'Х' : 'x'},{'х' : 'x'},{'Ц' : ''},{'ц' : ''},{'Ч' : ''},{'ч' : ''},{'Щ' : ''},{'щ' : ''},{'Ш' : ''},{'ш' : ''},{'Ъ' : ''},{'ъ' : ''},{'Ы' : ''},{'ы' : ''},{'Ь' : ''},{'ь' : ''},{'Э' : ''},{'э' : ''},{'Ю' : ''},{'ю' : ''},{'Я' : ''},{'я' : ''});
    for(i=0; i < rualphabet.length; i++) {
        var regEx = new RegExp(Object.keys(rualphabet[i])[0], "g");
        email = email.replace(regEx, rualphabet[i][Object.keys(rualphabet[i])[0]]);
    }
// Проверяем на правильное окончание почтовой системы
    var emailParts = email.split('@');
    if(emailParts.length == 2 && emailParts[1].length > 0) {
        emailParts[1] = emailParts[1].replace(/[^0-9a-zA-Z.*]/g, "");
        var emailPlatforms = [{'mail.ru' : [
                'mai.ru',
                'mai.ru',
                'mali.ru',
                'mail.ry',
                'mail.li',
                'vail.ru',
                'mail.',
                'maail.ru',
                'maii.ru',
                'mail..ru',
                'mail..ua',
                'mail.com',
                'mail.r',
                'mail.ku',
                'mail.fu',
                'mal.ru',
                'majl.ru',
                'maul.ru',
                'mail.u',
                'mil.ru',
                '.mail.ru',
                'mail.ru.',
                'mail.xn--c1an'
            ]},
            {'yandex.ru' : [
                'ayndex.ru',
                'yande.ru',
                'yadnex.ru',
                'yadex.ru',
                'yandex.ry',
                'yandex.ri',
                'andex.ru',
                'eandex.ru',
                'yandex.',
                'jandex.ru',
                'tandex.ru',
                'uandex.ru',
                'yandx.ru',
                'yndex.ru',
                'yandeks.ru',
                'yndeks.ru',
                'yanex.ru',
                'yandex.u',
                'yandex.r',
                '.yandex.ru',
                'yandex.ru.'
            ]},
            {'gmail.com' : [
                'gamil.com',
                'gmial.com',
                'gmai.com',
                'google.ru',
                'google.com',
                'gmail.ru',
                'gmail.ry',
                'gmail.ri',
                'cmail.com',
                'ggmail.com',
                'gmaik.com',
                'gmail.c',
                'gmail.co',
                'gmail.cm',
                'gmail.kom',
                'gmail.cmp',
                'gmail.cov',
                'gmail.con',
                'gmail.',
                'gmil.com',
                'gmal.com',
                'gnail.com',
                'googlemail.com',
                'gvail.com',
                'gmailc.com',
                'jmail.com',
                'qmail.com',
                '.gmail.com',
                'gmail.com.'
            ]},
            {'list.ru' : [
                'ilst.ru',
                'lits.ru',
                'lis.tru',
                'list.ry',
                'list.ri',
                'ist.ru',
                'list.',
                'lirt.ru',
                'lisn.ru',
                'lisr.ru',
                'list.u',
                'list.r',
                '.list.ru',
                'list.ru.'
            ]},
            {'bk.ru' : [
                'kb.ru',
                'bk.ry',
                'bk.ri',
                'bkk.ru',
                'bk.',
                'bk.u',
                'bk.r',
                '.bk.ru',
                'bk.ru.'
            ]},
            {'yahoo.com' : [
                'ayhoo.com',
                'yahoo.ru',
                'yaho.com',
                'yahoo.',
                '.yahoo.com',
                'yahoo.com.'
            ]},
            {'hotmail.com' : [
                'hotmail.',
                '.hotmail.com',
                'hotmail.com.'
            ]},
            {'rambler.ru' : [
                'rambler.ry',
                'rambler.ru',
                'rambler.com',
                'rable.ru',
                'ambler.ru',
                'rambler.',
                'ramber.ru',
                'rambker.ru',
                'rabler.ru',
                'ramble.ru',
                'ramblere.ru',
                'rambller.ru',
                'rambltr.ru',
                'ramdler.ru',
                'tabler.ru',
                'rambler.u',
                'rambler.r',
                '.rambler.ru',
                'rambler.ru.'
            ]},
            {'inbox.ru' : [
                'ibnox.ru',
                'inbox.com',
                'inbo.ru',
                'inbox.u',
                'inbox.r',
                '.inbox.ru',
                'inbox.ru.'
            ]}];
        var trueDomain,
            failDomain;
        for(i=0; i < emailPlatforms.length; i++) {
            trueDomain = Object.keys(emailPlatforms[i])[0];
            for(j=0; j < emailPlatforms[i][trueDomain].length; j++) {
                failDomain = emailPlatforms[i][trueDomain][j];

                if(emailParts[1] == failDomain)
                    emailParts[1] = emailParts[1].replace(failDomain, trueDomain);
                if(emailParts[1] == "." + failDomain)
                    emailParts[1] = emailParts[1].replace("." + failDomain, trueDomain);
                if(emailParts[1] == failDomain + ".")
                    emailParts[1] = emailParts[1].replace(failDomain + ".", trueDomain);
            }
        }
        email = emailParts[0] + "@" + emailParts[1];
    }

// Сохраняем обработанное значение
    $(this).val(email);
});
<!-- Конец скрипта обработки email поля -->