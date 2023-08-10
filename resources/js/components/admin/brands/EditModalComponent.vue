<template>
    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modalEditTitle"></h3>
                    <button type="button" class="close modal-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"> <i class="fa fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="FormEdit" @submit.prevent="Edit" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form__item mb-20">
                                    <label for="modalEditInputTitle">Введите название</label>
                                    <input type="text" id="modalEditInputTitle" name="title" :class="errors.title ? 'is-invalid' : ''">
                                    <div :class="errors.title ? 'invalid-feedback' : ''" v-for="error in errors.title">
                                        {{ error }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form__item mb-20">
                                    <label for="img">Прикрепите логотип</label>
                                    <input type="file" id="img" name="img" :class="errors.img ? 'is-invalid' : ''">
                                    <div :class="errors.img ? 'invalid-feedback' : ''" v-for="error in errors.img">
                                        {{ error }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row flex-lg-row flex-column-reverse">
                                    <div class="col-lg-6 mb-2">
                                        <button class="button button--dark" type="button" id="modalEditClose" data-bs-dismiss="modal" aria-label="Close">Отмена</button>
                                    </div>
                                    <div class="col-lg-6 mb-2">
                                        <button class="button" type="submit">Изменить</button>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- .row -->
                    </form> <!-- form -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "EditModal",

    props: {
        brandId: {
            type: Number,
            required: true
        }
    },

    data() {
        return {
            errors: [],
        }
    },

    methods: {
        async Edit() {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const form = document.getElementById('FormEdit');
            const formData = new FormData(form);
            formData.append('id', this.brandId);
            const response = await fetch('/brand/edit', {
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                body: formData
            })
            if (response.status === 200) {
                document.getElementById('modalEditClose').click();
                form.reset();
                this.errors = [];
                this.$emit('GetBrands');
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
