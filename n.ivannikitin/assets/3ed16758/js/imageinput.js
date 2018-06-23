var imageInputClass = '.image-input';
var removeBlockClass = '.remove-block';
var imageInputRemoveClass = '.image-input__remove';

$(function () {
    $(document).on('change', fileInputClass, function() {
        var oFReader = new FileReader();
        var $imageInputBlock = $(this).closest(imageInputClass);
        var $previewBlock = $imageInputBlock.find(previewClass);
        oFReader.readAsDataURL($(this).get(0).files[0]);

        oFReader.onload = function(oFREvent) {
            $previewBlock.attr('src', oFREvent.target.result).show();
            $previewBlock.parent().find(addBlockClass).hide();
        };
    });

    // Обработчик нажатия кнопки добавления изображения.
    $(addBlockClass).click( function() {
        var $imageInputBlock = $(this).closest(imageInputClass);
        var $imageInputFile = $imageInputBlock.find(fileInputClass);
        // Эмитация нажатия на блок-загрузки файла.
        $imageInputFile.click();

        $(this).parent().append($imageInputBlock.show());
    });

    $(previewClass).click( function() {
        var $imageInputBlock = $(this).closest(imageInputClass);
        $imageInputBlock.find(fileInputClass).click();
    });

    $(imageInputRemoveClass).click( function() {
        var $imageInputBlock = $(imageInputClass);
        switchHiddenInput($imageInputBlock, 'text');
        $imageInputBlock.find(removeBlockClass).show();
    });

    $(removeBlockClass).click( function() {
        var $imageInputBlock = $(this).closest(imageInputClass);
        switchHiddenInput($imageInputBlock, 'file');
        $(this).hide();
    });
});

function switchHiddenInput($block, type)
{
    var $fileInput = $block.find(fileInputClass);

    if (type === 'text') {
        $fileInput.attr('type', 'text');
        $fileInput.attr('value', 'remove');
    } else {
        $fileInput.attr('type', 'file');
        $fileInput.removeAttr('value');
    }
}