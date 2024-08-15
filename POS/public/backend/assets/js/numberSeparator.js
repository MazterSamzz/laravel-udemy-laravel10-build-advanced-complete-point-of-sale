/**
 * Formats the input value with thousands separators and a specified number of decimal places.
 *
 * @param {HTMLInputElement} inputId - The input element to format.
 * @param {number} [decimalCount=2] - The number of decimal places to show. Defaults to 2.
 * @return {void} This function does not return anything.
 */
function numberSeparatorById(inputId, decimalCount = 2) {
    let input = document.getElementById(inputId);
    if (!input) {
        console.error(`Input with ID ${inputId} not found.`);
        return;
    }

    function formatValue(value) {
        if (value.endsWith(".")) {
            return value;
        }

        let parts = value.split(".");
        let integerPart = parts[0].replace(/[^0-9]/g, "");
        let decimalPart = parts[1] ? parts[1].replace(/[^0-9]/g, "") : "";

        integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        decimalPart = decimalPart ? decimalPart.substring(0, decimalCount) : "";

        return decimalPart ? `${integerPart}.${decimalPart}` : `${integerPart}`;
    }

    // Format the initial value
    input.value = formatValue(input.value);

    // Format the value when the input value changes
    input.addEventListener("input", function () {
        input.value = formatValue(input.value);
    });
}

function numberSeparatorByName(name, decimalCount = 2) {
    // Ambil elemen berdasarkan nama
    let inputs = document.getElementsByName(name);

    // Periksa apakah elemen ditemukan
    if (inputs.length === 0) {
        console.error(`Input with name ${name} not found.`);
        return;
    }

    // Fungsi untuk memformat nilai
    function formatValue(value) {
        if (value.endsWith(".")) {
            return value;
        }

        let parts = value.split(".");
        let integerPart = parts[0].replace(/[^0-9]/g, "");
        let decimalPart = parts[1] ? parts[1].replace(/[^0-9]/g, "") : "";

        integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        decimalPart = decimalPart ? decimalPart.substring(0, decimalCount) : "";

        return decimalPart ? `${integerPart}.${decimalPart}` : `${integerPart}`;
    }

    // Terapkan format ke semua elemen dengan nama yang diberikan
    inputs.forEach((input) => {
        if (input.tagName === "INPUT") {
            input.addEventListener("input", function () {
                let value = input.value;

                // Format dan atur nilai input
                input.value = formatValue(value);
            });

            // Terapkan format awal
            input.value = formatValue(input.value);
        }
    });
}

function numberSeparatorDataTable(name, decimalCount = 2) {
    // Ambil elemen berdasarkan atribut name
    let cells = document.querySelectorAll(`[name="${name}"]`);

    // Fungsi untuk memformat nilai
    function formatValue(value) {
        if (value.endsWith(".")) {
            return value;
        }

        let parts = value.split(".");
        let integerPart = parts[0].replace(/[^0-9]/g, "");
        let decimalPart = parts[1] ? parts[1].replace(/[^0-9]/g, "") : "";

        integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        decimalPart = decimalPart ? decimalPart.substring(0, decimalCount) : "";

        return decimalPart ? `${integerPart}.${decimalPart}` : `${integerPart}`;
    }

    // Terapkan format ke semua elemen dengan nama yang diberikan
    cells.forEach((cell) => {
        // Ambil nilai teks dari elemen
        let value = cell.textContent.trim();

        // Format dan atur nilai elemen
        cell.textContent = formatValue(value);
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
        let number = document.getElementsByName(input);
        console.log("Form submitted");
        console.log("Input value before processing:", number.value);
        let value = number.value.replace(/\D/g, ""); // Delete all non-digit characters
        console.log("Processed value:", value);
        number.value = parseInt(value, 10); // Parse as an integer
        console.log("Value after parsing as integer:", number.value);
    });
}
