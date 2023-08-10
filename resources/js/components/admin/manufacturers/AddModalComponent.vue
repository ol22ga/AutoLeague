<template>
    <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-fluid">
                        <h3 class="modal-title mb-20">Новый производитель</h3>
                        <form id="FormAdd" @submit.prevent="Add" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form__item mb-20">
                                        <label for="title">Введите название</label>
                                        <input type="text" id="title" name="title" :class="errors.title ? 'is-invalid' : ''">
                                        <div :class="errors.title ? 'invalid-feedback' : ''" v-for="error in errors.title">
                                            {{error}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row flex-lg-row flex-column-reverse">
                                        <div class="col-lg-6 mb-2">
                                            <button class="button button--dark" type="button" id="modalAddClose" data-bs-dismiss="modal" aria-label="Close">Отмена</button>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <button class="button" type="submit">Добавить</button>
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
    name: "AddModal",

    data() {
        return {
            errors: [],
        }
    },

    methods: {
        async Add() {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const form = document.getElementById('FormAdd');
            const formData = new FormData(form);
            const response = await fetch('/manufacturer/add', {
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                body: formData
            })
            if (response.status === 200) {
                document.getElementById('modalAddClose').click();
                form.reset();
                this.errors = [];
                this.$emit('GetManufacturers');
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
