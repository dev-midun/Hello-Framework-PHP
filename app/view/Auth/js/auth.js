import * as _Login from './login.js';
import * as _ForgotPassword from './forgot_password.js';
import * as _Layout from '../../_Layout/js/layout.js';

const Login = new _Login.Login();

document.addEventListener('DOMContentLoaded', () => {
    Login.signInButton.addEventListener('click', async () => {
        console.log('%c Sign In Button Clicked...', 'color: blue');

        let success = false;

        _Layout.loadingButton(Login.signInButton);
        try {
            const signIn = await Login.signIn();
            console.log('%c Response signIn: ', 'color: green', signIn);

            if(!signIn.success) {
                throw signIn.message;
            }

            // document.location = SITE_URL;
            _Layout.toast('success', 'Login Sukses');
            success = signIn.success;
        } 
        catch (error) {
            Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: `Something went wrong: ${error}`,
            });
        }
        finally {
            _Layout.loadingButton(Login.signInButton, false);

            if(success) {
                document.location = SITE_URL;
            }
        }
    });
});