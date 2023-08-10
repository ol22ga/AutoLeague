<template>
    <div class="modal fade" id="modalComment" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-fluid">
                        <h3 class="modal-title mb-20" id="modalCommentTitle"></h3>
                        <form id="FormComment" @submit.prevent="Comment">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form__item">
                                        <select class="nice-select wide form__select" name="status_order">
                                            <option value="Новый"> Новый </option>
                                            <option value="В обработке"> В обработке </option>
                                            <option value="Принят в работу"> Принят в работу </option>
                                            <option value="Передан в доставку"> Передан в доставку </option>
                                            <option value="Завершен"> Завершен </option>
                                            <option value="Отклонен"> Отклонен </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form__item mb-20">
                                        <label for="comment">Введите текст комментария</label>
                                        <textarea id="comment" name="comment" :class="errors.comment ? 'is-invalid' : ''"></textarea>
                                        <div :class="errors.comment ? 'invalid-feedback' : ''" v-for="error in errors.comment">
                                            {{error}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row flex-lg-row flex-column-reverse">
                                        <div class="col-lg-6 mb-2">
                                            <button class="button button--dark" type="button" id="modalCommentClose" data-bs-dismiss="modal" aria-label="Close">Отмена</button>
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
    name: "CommentModalComponent",

    props: {
        orderId: {
            type: Number,
            required: true
        },
    },

    data() {
        return {
            errors: [],
        }
    },

    methods: {
        async Comment() {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const form = document.getElementById('FormComment');
            const formData = new FormData(form);
            formData.append('id', this.orderId);
            const response = await fetch('/order/edit', {
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                body: formData
            })
            if (response.status === 200) {
                document.getElementById('modalCommentClose').click();
                form.reset();
                this.errors = [];
                this.$emit('GetOrders');
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
