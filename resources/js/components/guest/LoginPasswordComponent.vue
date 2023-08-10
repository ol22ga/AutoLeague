<template>
    <form id="LoginForm" @submit.prevent="Login">
        <div class="row">
            <div class="text-center" :class="message ? 'col-12 form__error mb-20' : ''">{{message}}</div>
            <div class="col-lg-6">
                <div class="form__item mb-20">
                    <label for="email">Введите email</label>
                    <input type="text" id="email" name="email" :class="errors.email ? 'is-invalid' : ''">
                    <div :class="errors.email ? 'invalid-feedback' : ''" v-for="error in errors.email">
                        {{error}}
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form__item mb-20">
                    <label for="password">Введите пароль</label>
                    <input type="password" id="password" name="password" :class="errors.password ? 'is-invalid' : ''">
                    <div :class="errors.password ? 'invalid-feedback' : ''" v-for="error in errors.password">
                        {{error}}
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mb-20">
                <button class="button" type="submit">Войти</button>
            </div>
        </div> <!-- .row -->
    </form> <!-- form -->
</template>

<script>
export default {
    name: "LoginPasswordComponent",

    data() {
        return {
            errors: [],
            message: '',
        }
    },
    methods: {
        async Login() {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const formData = new FormData(document.getElementById('LoginForm'));
            const response = await fetch('/login/password/entry', {
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                body: formData
            })
            if (response.status === 400) {
                this.errors = await response.json();
            }
            if (response.status === 403) {
                this.message = await response.json();
            }
            if (response.status === 200) {
                window.location = await response.json();
            }
        }
    }
}
</script>

<style scoped>

</style>
