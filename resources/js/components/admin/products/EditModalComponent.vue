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
                            <div class="col-sm-6">
                                <div class="form__item mb-20">
                                    <label for="modalEditInputArticle">Введите артикул</label>
                                    <input type="number" id="modalEditInputArticle" name="article" :class="errors.article ? 'is-invalid' : ''" maxlength="12">
                                    <div :class="errors.article ? 'invalid-feedback' : ''" v-for="error in errors.article">
                                        {{error}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form__item mb-20">
                                    <label for="modalEditInputCount">Введите кол-во на складе</label>
                                    <input type="number" id="modalEditInputCount" name="count" :class="errors.count ? 'is-invalid' : ''">
                                    <div :class="errors.count ? 'invalid-feedback' : ''" v-for="error in errors.count">
                                        {{error}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form__item mb-20">
                                    <label for="modalEditInputTitle">Введите название</label>
                                    <input type="text" id="modalEditInputTitle" name="title" :class="errors.title ? 'is-invalid' : ''">
                                    <div :class="errors.title ? 'invalid-feedback' : ''" v-for="error in errors.title">
                                        {{error}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-20">
                                <div class="form__item">
                                    <label for="modalEditSelectCategory">Выберите категорию</label>
                                    <select class="nice-select wide form__select" name="category_id" id="modalEditSelectCategory">
                                        <option v-for="category in categories" :value="category.id"> {{category.title}} </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-20">
                                <div class="form__item">
                                    <label for="modalEditSelectBrand">Выберите марку</label>
                                    <select class="nice-select wide form__select" name="brand_id" id="modalEditSelectBrand">
                                        <option v-for="brand in brands" :value="brand.id"> {{brand.title}} </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form__item mb-20">
                                    <label for="modalEditInputDescription">Введите описание</label>
                                    <textarea id="modalEditInputDescription" name="description" :class="errors.description ? 'is-invalid' : ''"></textarea>
                                    <div :class="errors.description ? 'invalid-feedback' : ''" v-for="error in errors.description">
                                        {{error}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form__item mb-20">
                                    <label for="modalEditInputComplete">Введите комплектацию</label>
                                    <input type="text" id="modalEditInputComplete" name="complete_set" :class="errors.complete_set ? 'is-invalid' : ''">
                                    <div :class="errors.complete_set ? 'invalid-feedback' : ''" v-for="error in errors.complete_set">
                                        {{error}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-20">
                                <div class="form__item">
                                    <label for="modalEditSelectManufacturer">Выберите производителя</label>
                                    <select class="nice-select wide form__select" name="manufacturer_id" id="modalEditSelectManufacturer">
                                        <option v-for="manufacturer in manufacturers" :value="manufacturer.id"> {{manufacturer.title}} </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form__item mb-20">
                                    <label for="modalEditInputMaterial">Введите материал</label>
                                    <input type="text" id="modalEditInputMaterial" name="material" :class="errors.material ? 'is-invalid' : ''">
                                    <div :class="errors.material ? 'invalid-feedback' : ''" v-for="error in errors.material">
                                        {{error}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form__item mb-20">
                                    <label for="modalEditInputWeight">Введите вес</label>
                                    <input type="text" id="modalEditInputWeight" name="weight" :class="errors.weight ? 'is-invalid' : ''">
                                    <div :class="errors.weight ? 'invalid-feedback' : ''" v-for="error in errors.weight">
                                        {{error}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form__item mb-20">
                                    <label for="modalEditInputOld">Введите старую цену</label>
                                    <input type="text" id="modalEditInputOld" name="old_price" :class="errors.old_price ? 'is-invalid' : ''">
                                    <div :class="errors.old_price ? 'invalid-feedback' : ''" v-for="error in errors.old_price">
                                        {{error}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form__item mb-20">
                                    <label for="modalEditInputNew">Введите актуальную цену</label>
                                    <input type="text" id="modalEditInputNew" name="new_price" :class="errors.new_price ? 'is-invalid' : ''">
                                    <div :class="errors.new_price ? 'invalid-feedback' : ''" v-for="error in errors.new_price">
                                        {{error}}
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
        productId: {
            type: Number,
            required: true
        },
        categories: {
            type: Array,
            required: true
        },
        brands: {
            type: Array,
            required: true
        },
        manufacturers: {
            type: Array,
            required: true
        },
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
            formData.append('id', this.productId);
            const response = await fetch('/product/edit', {
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
                this.$emit('GetProducts');
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
