<template>
    <form id="RegistrationForm" @submit.prevent="Registration">
        <div class="row">
            <div class="col-lg-6">
                <div class="form__item mb-20">
                    <label for="firstname">Введите имя</label>
                    <input type="text" id="firstname" name="firstname" :class="errors.firstname ? 'is-invalid' : ''">
                    <div :class="errors.firstname ? 'invalid-feedback' : ''" v-for="error in errors.firstname">
                        {{error}}
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form__item mb-20">
                    <label for="lastname">Введите фамилию</label>
                    <input type="text" id="lastname" name="lastname" :class="errors.lastname ? 'is-invalid' : ''">
                    <div :class="errors.lastname ? 'invalid-feedback' : ''" v-for="error in errors.lastname">
                        {{error}}
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form__item mb-20">
                    <label for="patronymic">Введите отчество</label>
                    <input type="text" id="patronymic" name="patronymic" :class="errors.patronymic ? 'is-invalid' : ''">
                    <div :class="errors.patronymic ? 'invalid-feedback' : ''" v-for="error in errors.patronymic">
                        {{error}}
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form__item mb-20">
                    <label for="birthdate">Введите дату рождения</label>
                    <input type="date" id="birthdate" name="birthdate" :class="errors.birthdate ? 'is-invalid' : ''">
                    <div :class="errors.birthdate ? 'invalid-feedback' : ''" v-for="error in errors.birthdate">
                        {{error}}
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form__item mb-20">
                    <label for="phone">Введите номер телефона</label>
                    <input type="text" id="phone" name="phone" :class="errors.phone ? 'is-invalid' : ''">
                    <div :class="errors.phone ? 'invalid-feedback' : ''" v-for="error in errors.phone">
                        {{error}}
                    </div>
                </div>
            </div>
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
            <div class="col-lg-6">
                <div class="form__item mb-20">
                    <label for="password_confirmation">Повторите пароль</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" :class="errors.password ? 'is-invalid' : ''">
                    <div :class="errors.password ? 'invalid-feedback' : ''" v-for="error in errors.password">
                        <template  v-if="error == 'Пароли не совпадают'">
                            {{error}}
                        </template>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <label class="form__item--checkbox mb-20" for="approval">
                    <input type="checkbox" id="approval" name="approval" :class="errors.approval ? 'is-invalid' : ''">
                    <span>Я согласен с <a href="/privacy">политикой конфиденциальности</a></span>
                    <div :class="errors.approval ? 'invalid-feedback' : ''" v-for="error in errors.approval">
                        {{error}}
                    </div>
                </label>
            </div>
            <div class="col-lg-12">
                <button class="button" type="submit">Зарегистрироваться</button>
            </div>
        </div> <!-- .row -->
    </form> <!-- form -->
</template>

<script>
export default {
    name: "RegistrationComponent",

    data() {
        return {
            errors: []
        }
    },

    methods: {
        async Registration() {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const formData = new FormData(document.getElementById('RegistrationForm'));
            const response = await fetch('/registration/save', {
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                body: formData
            })
            if (response.status === 200) {
                window.location = await response.json();
            }
            if (response.status === 400) {
                this.errors = await response.json();
            }
        }
    }
}
</script>

<style scoped>

</style>
