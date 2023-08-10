<template>
    <div class="form section-top-gap-100">
        <h3 class="form__title mb-20">Задать вопрос</h3>
        <form id="QuestionForm" @submit.prevent="Ask">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form__item mb-20">
                        <label for="text">Введите текст вопроса</label>
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

    <modal-question-component></modal-question-component>
</template>

<script>
import ModalQuestionComponent from "./ModalQuestionComponent.vue";

export default {
    name: "FormQuestionComponent",

    components: {
        ModalQuestionComponent
    },

    data() {
        return {
            errors: [],
        }
    },

    methods: {
        async Ask() {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const form = document.getElementById('QuestionForm');
            const formData = new FormData(form);
            const response = await fetch('/ask', {
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
                const modal = new bootstrap.Modal(document.getElementById('modalQuestionSuccess'));
                modal.show();
            }
        }
    }
}
</script>

<style scoped>

</style>
