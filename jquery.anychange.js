(function ($) {
    $.fn.anyChange = function (cb) {
        return this.each(function () {
            if (typeof cb == 'function')
            {
                new AnyChange(this, cb);
            }
        });
    }
	alert('pppo');

    function AnyChange(inputElement, callback) {
        var eventsRemoved  = false;
        if (inputElement.addEventListener) {
            inputElement.addEventListener("input", oninput, false);  // all browsers except IE before version 9
            inputElement.addEventListener("textInput", textInput, false);  // Google Chrome and Safari
            inputElement.addEventListener("textinput", textinput, false);  // Internet Explorer from version 9
        }
        else {
            if (inputElement.attachEvent) {
                inputElement.attachEvent("onpropertychange", propertyChangeEvent);   // Internet Explorer and Opera
            }
        }

        function oninput(event) {
            if (eventsRemoved===false) {
                inputElement.removeEventListener("textInput", textInput, false);   // Google Chrome and Safari
                inputElement.removeEventListener("textinput", textinput, false);   // Internet Explorer from version 9
                eventsRemoved = true;
            }

            callback.call(inputElement, event.target.value);
        }

        function textInput(event) {
            if (eventsRemoved===false) {
                inputElement.addEventListener("input", oninput, false);  // all browsers except IE before version 9
                inputElement.addEventListener("textinput", textinput, false);  // Internet Explorer from version 9
                eventsRemoved = true;
            }

            callback.call(inputElement, event.data);
        }

        function textinput(event) {
            if (eventsRemoved===false) {
                inputElement.addEventListener("input", oninput, false);  // all browsers except IE before version 9
                inputElement.addEventListener("textInput", textInput, false);  // Google Chrome and Safari
                eventsRemoved = true;
            }

            callback.call(inputElement, event.data);
        }

        function propertyChangeEvent(event) {
            if (event.propertyName.toLowerCase() == "value") {
                callback.call(inputElement, event.srcElement.value);
            }
        }
    }
})(jQuery);