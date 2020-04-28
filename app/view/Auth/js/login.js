export class Login {
    username = document.querySelector('#email');
    password = document.querySelector('#password');
    signInButton = document.querySelector('#login-button');
    forgotPasswordButton = document.querySelector('#forgot-password');

    constructor() {
        console.log('%c Login constructor...', 'color: blue');
    }
    
    async signIn() {
        console.log('%c Sign In start...', 'color: blue');

        const result = {
            success: false,
            message: '',
            errorList: []
        };

        try {
            const request = await fetch(`${BASE_URL}login`, {
                method: 'POST',
                body: JSON.stringify({
                    username: this.username.value,
                    password: this.password.value
                })
            });
            const data = await request.json();
            console.log('%c Response login: ', 'color: green', data);

            result.success = data.success;
            result.message = data.message;
            result.errorList = data.errorList;
        } 
        catch (error) {
            if(typeof error == 'object') {
                result.message = error.message;
            }
            else {
                result.message = error;
            }
        }

        return result;
    }

    reset() {
        this.username.value = '';
        this.password.value = '';
    }
}