<template>
    <div class="text-center" :class="message ? 'col-12 form__error mb-20' : ''">{{ message }}</div>
    <form id="LoginForm" @submit.prevent="Login">
        <div class="row">
            <div class="col-12" id="InputPhone">
                <div class="form__item mb-20">
                    <label for="phone">Введите номер телефона</label>
                    <input type="text" id="phone" name="phone" :class="errors.phone ? 'is-invalid' : ''">
                    <div :class="errors.phone ? 'invalid-feedback' : ''" v-for="error in errors.phone">
                        {{ error }}
                    </div>
                </div>
            </div>
            <div class="col-lg-6 d-none" id="InputCode">
                <div class="form__item mb-20">
                    <label for="code">Введите код из смс</label>
                    <input type="number" id="code" name="code" @input.prevent="Verify" maxlength="6">
                </div>
            </div>
            <div class="col-lg-12 mb-20" id="SendMessageBtn">
                <button class="button" type="submit">Отправить код</button>
            </div>
        </div> <!-- .row -->
    </form> <!-- form -->

    <div class="form__inner mb-20 d-none" id="formInner">
        <button @click.prevent="Login" id="RepeatBtn">Отправить повторно</button>
        <div id="timer" class="form__timer"></div>
    </div>
</template>

<script>
export default {
    name: "LoginComponent",

    data() {
        return {
            errors: [],
            message: '',
            code: 0,
            phone: '',
            minutes: 1,
        }
    },
    methods: {
        async Login() {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            this.message = null

            const form = document.getElementById('LoginForm');
            const formData = new FormData(form);

            const response = await fetch('/login/send/message', {
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                body: formData
            })

            if (response.status === 400) {
                this.errors = await response.json();
            }

            if (response.status === 200) {
                var InputPhone = document.getElementById('InputPhone');
                var InputCode = document.getElementById('InputCode');
                var Btn = document.getElementById('SendMessageBtn');

                document.getElementById('phone').readOnly = true;
                Btn.classList.add('d-none');

                var duration = 60 * this.minutes;
                var display = document.querySelector('#timer');
                var btnRepeat = document.getElementById('RepeatBtn');
                this.startTimer(duration, display, btnRepeat);
                this.minutes *= 2;

                const data = await response.json();
                this.message = data.message;

                if (this.message === 'Сообщение с кодом подтверждения отправлено на указанный номер телефона') {
                    this.code = data.code;
                    console.log(this.code);

                    InputPhone.classList.remove('col-12');
                    InputPhone.classList.add('col-lg-6');
                    InputCode.classList.remove('d-none');
                } else {
                    setTimeout(()=>{this.message = null}, 10000);
                }
            }
        },

        async Verify() {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const formData = new FormData(document.getElementById('LoginForm'));
            console.log(formData.get('code'), this.phone);
            if (formData.get('code') == this.code) {
                const response = await fetch('/login/entry', {
                    method: 'post',
                    headers: {
                        'X-CSRF-TOKEN': token,
                    },
                    body: formData
                })
                if (response.status === 200) {
                    window.location = await response.json();
                }
            }
        },

        startTimer(duration, display, btnRepeat) {
            var timer = duration, minutes, seconds;
            display.classList.add('active');
            btnRepeat.disabled = true;
            document.getElementById('formInner').classList.remove('d-none');

            var intervalId = setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + ":" + seconds;

                if (timer <= 0) {
                    clearInterval(intervalId);
                    display.classList.remove('active');
                    btnRepeat.disabled = false;
                }

                timer--;
            }, 1000);
        }
    }
}
</script>

<style scoped>

</style>
