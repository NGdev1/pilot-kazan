/**
 * Created by apple on 11.05.2018.
 */

var contentContainer;
var loadingIndicator;

$(document).ready(function () {
    contentContainer = $('#content');
    loadingIndicator = $('#circleG');

    $('.menu-item-dropdown').on('click', function () {
        var dropdownMenu = $(this).find('.dropdown-menu');

        if (dropdownMenu.is(":visible")) {
            dropdownMenu.slideUp(100);
        } else {
            var topOffset;

            if ($(document).width() > 750) {
                topOffset = 25;
            } else {
                topOffset = 68;
            }

            dropdownMenu.slideDown(100);
            dropdownMenu.css('left', (this.offsetLeft - 7) + 'px');
            dropdownMenu.css('top', this.offsetTop + topOffset + 'px');
        }
    });
});

function loadContent(url, title, addToHistory) {
    if (url !== undefined && contentContainer !== undefined) {

        loadingIndicator.show();
        contentContainer.hide();

        $.ajax({
            url: url,
            type: "GET"
        }).done(function (data) {
            document.title = title;

            loadingIndicator.hide();

            contentContainer.fadeTo(200, 1);
            contentContainer.html(data);

            if (addToHistory) {
                window.history.pushState({"html": data, "pageTitle": title}, title, url);
            }
        });
    }
}

function showDialog(title, message) {
    var dialogMessage = $("<div/>");
    var messageContainer = $('<p/>', {
        html: message
    });
    dialogMessage.append(messageContainer);

    dialogMessage.dialog({
        title: title,
        modal: true,
        buttons: {
            "Закрыть": function () {
                $(this).dialog("close");
            }
        }
    });
}

function setSelected(selected) {
    $('.selected').removeClass('selected');
    $('#' + selected).addClass('selected', 100);
}