document.getElementById('username').addEventListener('input', validateUsername);
function validateUsername() {
    const username = document.getElementById('username').value;
    let isValid = true;
    let errorMessages = [];

    document.getElementById('usernameError').style.display = 'none';
    document.getElementById('usernameOk').style.display = 'none';

    if (!username) {
        errorMessages.push('Username can\'t be empty');
        isValid = false;
    }

    if (username.length < 3) {
        errorMessages.push('Username must be at least 3 characters long');
        isValid = false;
    }

    if (!isValid) {
        document.getElementById('usernameError').innerHTML = errorMessages.join('<br>');
        document.getElementById('usernameError').style.display = 'block';
    } else {
        document.getElementById('usernameOk').textContent = '✔ Valid username!';
        document.getElementById('usernameOk').style.display = 'block';
    }
    return isValid;
}


document.getElementById('password').addEventListener('input', validatePassword);
function validatePassword() {
    const password = document.getElementById('password').value;

    let isValid = true;
    let errorMessages = [];

    document.getElementById('passwordError').style.display = 'none';
    document.getElementById('passwordOk').style.display = 'none';

    if (!password) {
        errorMessages.push('Password can\'t be empty');
        isValid = false;
    }

    if (password.length < 8) {
        errorMessages.push('Password must be at least 8 characters long');
        isValid = false;
    }

    if (!/[A-Z]/.test(password)) {
        errorMessages.push('Password must contain at least 1 uppercase letter');
        isValid = false;
    }

    if (!/[a-z]/.test(password)) {
        errorMessages.push('Password must contain at least 1 lowercase letter');
        isValid = false;
    }

    if (!/\d/.test(password)) {
        errorMessages.push('Password must contain at least 1 digit');
        isValid = false;
    }

    if (!/[!@#$%^&*]/.test(password)) {
        errorMessages.push('Password must contain at least 1 special character');
        isValid = false;
    }

    if (!isValid) {
        document.getElementById('passwordError').innerHTML = errorMessages.join('<br>');
        document.getElementById('passwordError').style.display = 'block';
    } else {
        document.getElementById('passwordOk').textContent = '✔ Valid password!';
        document.getElementById('passwordOk').style.display = 'block';
    }
    return isValid;
}


document.getElementById('licensePlate').addEventListener('input', validateLicensePlate);
function validateLicensePlate() {
    const licensePlate = document.getElementById('licensePlate').value;
    const licensePlateRegex = /^[A-Z]{3}-[A-Z]{1}-[0-9]{2}-[0-9]{4}$/;

    let isValid = true;

    document.getElementById('licensePlateError').style.display = 'none';
    document.getElementById('licensePlateOk').style.display = 'none';

    if (!licensePlate) {
        document.getElementById('licensePlateError').textContent = 'License plate can\'t be empty';
        document.getElementById('licensePlateError').style.display = 'block';
        isValid = false;
    } 
    else if (!licensePlateRegex.test(licensePlate)) {
        document.getElementById('licensePlateError').textContent = 'Invalid license plate. Correct format: AAA-L-99-9999';
        document.getElementById('licensePlateError').style.display = 'block';
        isValid = false;
    } else {
        document.getElementById('licensePlateOk').textContent = '✔ Valid license plate!';
        document.getElementById('licensePlateOk').style.display = 'block';
    }

    return isValid;
}


document.getElementById('ipaddress').addEventListener('input', validateIpAddress);
function validateIpAddress() {
    const ipaddress = document.getElementById('ipaddress').value;
    const ipRegex = /^((25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/;

    let isValid = true;

    document.getElementById('ipaddressError').style.display = 'none';
    document.getElementById('ipaddressOk').style.display = 'none';

    if (!ipaddress) {
        document.getElementById('ipaddressError').textContent = 'IP Address can\'t be empty';
        document.getElementById('ipaddressError').style.display = 'block';
        isValid = false;
    } 
    else if (!ipRegex.test(ipaddress)) {
        document.getElementById('ipaddressError').textContent = 'Invalid IP address. Correct format: 192.100.10.1';
        document.getElementById('ipaddressError').style.display = 'block';
        isValid = false;
    } else {
        document.getElementById('ipaddressOk').textContent = '✔ Valid IP address!';
        document.getElementById('ipaddressOk').style.display = 'block';
    }

    return isValid;
}


document.getElementById('hexcode').addEventListener('input', validateHexCode);
document.getElementById('hexcode').addEventListener('input', validateHexCode);

function validateHexCode() {
    const hexcode = document.getElementById('hexcode').value;
    const hexcodeRegex = /^#([A-Fa-f0-9]{3}){1,2}$/i;
    const hexcodeShorthandRegex = /^#([A-Fa-f0-9]{1}){3}$/i;

    let isValid = true;

    document.getElementById('hexcodeError').style.display = 'none';
    document.getElementById('hexcodeOk').style.display = 'none';

    if (!hexcode) {
        document.getElementById('hexcodeError').textContent = 'HexCode can\'t be empty';
        document.getElementById('hexcodeError').style.display = 'block';
        isValid = false;
    } 
    else if (!(hexcodeRegex.test(hexcode) || hexcodeShorthandRegex.test(hexcode))) {
        document.getElementById('hexcodeError').textContent = 'Invalid hex code. Correct format: #rgb or #rrggbb';
        document.getElementById('hexcodeError').style.display = 'block';
        isValid = false;
    } else {
        document.getElementById('hexcodeOk').textContent = '✔ Valid hex code!';
        document.getElementById('hexcodeOk').style.display = 'block';
    }

    return isValid;
}


document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const isUsernameValid = validateUsername();
    const isPasswordValid = validatePassword();
    const isAddressValid = validateAddress();

    if (isUsernameValid && isPasswordValid && isAddressValid) {
        alert('Form submitted successfully!');
    }
});

