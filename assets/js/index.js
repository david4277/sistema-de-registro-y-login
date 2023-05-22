/**
 * IIFE (Immediately Invoked Function Expression) para evitar la contaminación del ámbito global
 * y para mantener las funciones y variables definidas en el script contenidas dentro de la función.
 */
(() => {
    /**
     * Constantes para las expresiones regulares utilizadas para la validación
     */
    const NAME_REGEX = /^[A-Z][a-z]+(\s[A-Z][a-z]+)*$/;
    const EMAIL_REGEX = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    const PASSWORD_REGEX = /^.{8,}$/;

    /**
     * Capitaliza el primer carácter de cada palabra en la cadena de entrada
     * @param {string} inputValue - La cadena de entrada a capitalizar
     * @returns {string} - La cadena de entrada con el primer carácter de cada palabra capitalizado
     */
    const capitalizeName = (inputValue) => inputValue
        .trim()
        .toLowerCase()
        .split('')
        .map((char, index) => index === 0 ? char.toUpperCase() : char)
        .join('');

    /**
     * Valida el nombre de usuario
     * @param {object} input - El elemento de entrada del nombre de usuario
     * @returns {boolean} - True si el nombre de usuario es válido, false de lo contrario
     */
    const validateName = (input) => {
        const inputValue = capitalizeName(input.value);

        if (inputValue === '') {
            showErrorInput(input, 'Ingrese un nombre');
            return false;
        }

        if (!NAME_REGEX.test(inputValue)) {
            showErrorInput(input, 'El nombre no es valido');
            return false;
        }

        hideErrorInput(input);
        return true;
    }

    /**
     * Valida el correo electrónico del usuario
     * @param {object} input - El elemento de entrada del correo electrónico
     * @returns {boolean} - True si el correo electrónico es válido, false de lo contrario
     */
    const validateEmail = (input) => {
        const inputValue = input.value.trim();

        if (inputValue === '') {
            showErrorInput(input, 'Ingrese un email');
            return false;
        }

        if (!EMAIL_REGEX.test(inputValue)) {
            showErrorInput(input, 'El email no es valido');
            return false;
        }

        hideErrorInput(input);
        return true;
    }

    /**
     * Valida la contraseña del usuario al registrarse
     * @param {object} input - El elemento de entrada de la contraseña
     * @returns {boolean} - True si la contraseña es válida, false de lo contrario
     */
    const validatePasswordRegister = (input) => {
        const inputValue = input.value.trim();

        if (inputValue === '') {
            showErrorInput(input, 'Ingrese una contraseña');
            return false;
        }
        if (!PASSWORD_REGEX.test(inputValue)) {
            showErrorInput(input, 'La contraseña debe tener al menos 8 caracteres');
            return false;
        }

        hideErrorInput(input);
        return true;
    }

    /**
     * Valida la contraseña del usuario al iniciar sesion
     * @param {object} input - El elemento de entrada de la contraseña
     * @returns {boolean} - True si la contraseña es válida, false de lo contrario
     */
    const validatePasswordLogin = (input) => {
        const inputValue = input.value.trim();

        if (inputValue === '') {
            showErrorInput(input, 'Ingrese una contraseña');
            return false;
        }

        hideErrorInput(input);
        return true;
    }

    /**
     * Muestra un error en la entrada
     * @param {object} input - El elemento de entrada en el que se muestra el error
     * @param {string} message - El mensaje de error a mostrar
     * @returns {void}
     */
    const showErrorInput = (input, message) => {
        let errorInput = input.parentElement.querySelector('.invalid-feedback');

        if (!errorInput) {
            errorInput = document.createElement('div');
            errorInput.classList.add('invalid-feedback');
            input.parentElement.append(errorInput);
        }

        errorInput.textContent = message;
        input.classList.remove('is-valid');
        input.classList.add('is-invalid');
    }

    /**
     * Oculta el error en la entrada
     * @param {object} input - El elemento de entrada en el que se oculta el error
     * @returns {void}
     */
    const hideErrorInput = (input) => {
        let errorInput = input.parentElement.querySelector('.invalid-feedback');

        if (errorInput) {
            errorInput.remove();
        }

        input.classList.remove('is-invalid');
        input.classList.add('is-valid');
    }

    /**
     * Controlador para el formulario de registro
     * @returns {void}
     */
    const register = () => {
        const formRegister = document.querySelector('#form-register');
        const fields = {
            name: document.querySelector('#name'),
            email: document.querySelector('#email'),
            password: document.querySelector('#password')
        };

        const validators = {
            name: validateName,
            email: validateEmail,
            password: validatePasswordRegister
        };

        if (formRegister) {
            Object.keys(fields).forEach(fieldName => {
                fields[fieldName].addEventListener('blur', () => validators[fieldName](fields[fieldName]));
            });

            formRegister.addEventListener('submit', event => {
                event.preventDefault();

                const isFormValid = Object.keys(fields)
                    .map(fieldName => validators[fieldName](fields[fieldName]))
                    .every(result => result);

                if (isFormValid) {
                    event.target.submit();
                }
            });
        }
    }

    /**
     * Controlador para el formulario de inicio de sesión
     * @returns {void}
     */
    const login = () => {
        const formLogin = document.querySelector('#form-login');
        const fields = {
            email: document.querySelector('#email'),
            password: document.querySelector('#password')
        };

        const validators = {
            email: validateEmail,
            password: validatePasswordLogin
        };

        if (formLogin) {

            Object.keys(fields).forEach(fieldName => {
                fields[fieldName].addEventListener('blur', () => validators[fieldName](fields[fieldName]));
            })

            formLogin.addEventListener('submit', event => {
                event.preventDefault();

                const isFormValid = Object.keys(fields)
                    .map(fieldName => validators[fieldName](fields[fieldName]))
                    .every(result => result);

                if (isFormValid) {
                    event.target.submit();
                }
            });
        }
    }

    /**
     * Inicia el script
     */
    register();
    login();
})();
