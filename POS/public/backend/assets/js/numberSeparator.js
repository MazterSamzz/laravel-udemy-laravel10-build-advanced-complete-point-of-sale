/**
 * Formats the input value with thousands separators and a specified number of decimal places.
 *
 * @param {HTMLInputElement} inputId - The input element to format.
 * @param {number} [decimalCount=2] - The number of decimal places to show. Defaults to 2.
 * @return {void} This function does not return anything.
 */
function numberSeparator(inputId, decimalCount = 2) {
    let input = document.getElementById(inputId);
    if (!input) {
        console.error(`Input with ID ${inputId} not found.`);
        return;
    }

    input.addEventListener("input", function () {
        let value = input.value;

        if (value.endsWith(".")) {
            return;
        }

        let parts = value.split(".");
        let integerPart = parts[0].replace(/[^0-9]/g, "");
        let decimalPart = parts[1] ? parts[1].replace(/[^0-9]/g, "") : "";

        integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        decimalPart = decimalPart ? decimalPart.substring(0, decimalCount) : "";

        input.value = decimalPart
            ? `${integerPart}.${decimalPart}`
            : `${integerPart}`;
    });
}

/**
 * Adds an event listener to the form's submit event to parse and format the value of the input with the specified inputId as a float with the specified decimalCount.
 *
 * @param {string} inputId - The ID of the input element. ex: 'price'
 * @param {number} [decimalCount=2] - The number of decimal places to round the parsed value to. Defaults to 2.
 * @return {void} This function does not return anything.
 */
function parseFloatOnSubmit(inputId, decimalCount = 2) {
    document.querySelector("form").addEventListener("submit", function (event) {
        let number = document.getElementById(inputId);
        let value = number.value.replace(/[^0-9.]/g, ""); // Delete all non-digit characters except decimal point
        number.value = parseFloat(value).toFixed(decimalCount); // Round to the specified decimal count
    });
}

/**
 * Adds an event listener to the form's submit event to parse and format the value of the input with the specified inputId as an integer.
 *
 * @param {string} inputId - The ID of the input element. ex: 'price'
 * @return {void} This function does not return anything.
 */
function parseIntOnSubmit(input) {
    document.querySelector("form").addEventListener("submit", function (event) {
        let number = document.getElementByName(input);
        console.log("Form submitted");
        console.log("Input value before processing:", number.value);
        let value = number.value.replace(/\D/g, ""); // Delete all non-digit characters
        console.log("Processed value:", value);
        number.value = parseInt(value, 10); // Parse as an integer
        console.log("Value after parsing as integer:", number.value);
    });
}
