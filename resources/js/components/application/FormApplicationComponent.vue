<template>
    <div class="form section-top-gap-100">
        <h3 class="form__title mb-20">Оставить заявку</h3>
        <form id="ApplicationForm" @submit.prevent="Send">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form__item mb-20">
                        <label for="name">Введите имя</label>
                        <input type="text" id="name" name="name" :class="errors.name ? 'is-invalid' : ''">
                        <div :class="errors.name ? 'invalid-feedback' : ''" v-for="error in errors.name">
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
                <div class="col-lg-12">
                    <div class="form__item mb-20">
                        <label for="text">Введите текст заявки</label>
                        <textarea id="text" name="text" :class="errors.text ? 'is-invalid' : ''"></textarea>
                        <div :class="errors.text ? 'invalid-feedback' : ''" v-for="error in errors.text">
                            {{error}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <button class="button" type="submit">Отправить</button>
                </div>
            </div> <!-- .row -->
        </form> <!-- form -->
    </div> <!-- .form .section-top-gap-100 -->

    <modal-application-component></modal-application-component>
</template>

<script>
import ModalApplicationComponent from "./ModalApplicationComponent.vue";

export default {
    name: "FormApplicationComponent",

    components: {
      ModalApplicationComponent
    },

    data() {
        return {
            errors: [],
        }
    },

    methods: {
        async Send() {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const form = document.getElementById('ApplicationForm');
            const formData = new FormData(form);
            const response = await fetch('/application/send', {
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
                form.reset();
                this.errors = [];
                const modal = new bootstrap.Modal(document.getElementById('modalApplicationSuccess'));
                modal.show();
            }
        }
    }
}
</script>

<style scoped>

</style>
