<template>
    <div class="modal fade" id="modalAnswer" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-fluid">
                        <h3 class="modal-title mb-20" id="modalAnswerTitle"></h3>
                        <form id="FormAnswer" @submit.prevent="Answer">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form__item mb-20">
                                        <label for="answer">Введите ответ на вопрос</label>
                                        <textarea id="answer" name="answer" :class="errors.answer ? 'is-invalid' : ''" :value="question.answer ? question.answer : ''"></textarea>
                                        <div :class="errors.answer ? 'invalid-feedback' : ''" v-for="error in errors.answer">
                                            {{error}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row flex-lg-row flex-column-reverse">
                                        <div class="col-lg-6 mb-2">
                                            <button class="button button--dark" type="button" id="modalAnswerClose" data-bs-dismiss="modal" aria-label="Close">Отмена</button>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <button class="button" type="submit">Сохранить</button>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- .row -->
                        </form> <!-- form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "AnswerComponent",

    props: {
        question: {
            type: Object,
            required: true
        },
    },

    data() {
        return {
            errors: [],
        }
    },

    methods: {
        async Answer() {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const form = document.getElementById('FormAnswer');
            const formData = new FormData(form);
            formData.append('id', this.question.id);
            const response = await fetch('/question/edit', {
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                body: formData
            })
            if (response.status === 200) {
                document.getElementById('modalAnswerClose').click();
                form.reset();
                this.errors = [];
                this.$emit('GetQuestions');
            }
            if (response.status === 400) {
                this.errors = await response.json();
            }
        },
    }
}
</script>

<style scoped>

</style>
