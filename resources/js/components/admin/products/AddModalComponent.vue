<template>
    <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-fluid">
                        <h3 class="modal-title mb-20">Новый товар</h3>
                        <form id="FormAdd" @submit.prevent="Add" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form__item mb-20">
                                        <label for="article">Введите артикул</label>
                                        <input type="number" id="article" name="article" :class="errors.article ? 'is-invalid' : ''" maxlength="12">
                                        <div :class="errors.article ? 'invalid-feedback' : ''" v-for="error in errors.article">
                                            {{error}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form__item mb-20">
                                        <label for="count">Введите кол-во на складе</label>
                                        <input type="number" id="count" name="count" :class="errors.count ? 'is-invalid' : ''">
                                        <div :class="errors.count ? 'invalid-feedback' : ''" v-for="error in errors.count">
                                            {{error}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form__item mb-20">
                                        <label for="title">Введите название</label>
                                        <input type="text" id="title" name="title" :class="errors.title ? 'is-invalid' : ''">
                                        <div :class="errors.title ? 'invalid-feedback' : ''" v-for="error in errors.title">
                                            {{error}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-20">
                                    <div class="form__item">
                                        <label for="category_id">Выберите категорию</label>
                                        <select class="nice-select wide form__select" name="category_id" id="category_id" :class="errors.category_id ? 'is-invalid' : ''">
                                            <option v-for="category in categories" :value="category.id"> {{category.title}} </option>
                                        </select>
                                        <div :class="errors.category_id ? 'invalid-feedback' : ''" v-for="error in errors.category_id">
                                            {{error}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-20">
                                    <div class="form__item">
                                        <label for="brand_id">Выберите марку</label>
                                        <select class="nice-select wide form__select" name="brand_id" id="brand_id" :class="errors.brand_id ? 'is-invalid' : ''">
                                            <option v-for="brand in brands" :value="brand.id"> {{brand.title}} </option>
                                        </select>
                                        <div :class="errors.brand_id ? 'invalid-feedback' : ''" v-for="error in errors.brand_id">
                                            {{error}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form__item mb-20">
                                        <label for="description">Введите описание</label>
                                        <textarea id="description" name="description" :class="errors.description ? 'is-invalid' : ''"></textarea>
                                        <div :class="errors.description ? 'invalid-feedback' : ''" v-for="error in errors.description">
                                            {{error}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form__item mb-20">
                                        <label for="complete_set">Введите комплектацию</label>
                                        <input type="text" id="complete_set" name="complete_set" :class="errors.complete_set ? 'is-invalid' : ''">
                                        <div :class="errors.complete_set ? 'invalid-feedback' : ''" v-for="error in errors.complete_set">
                                            {{error}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-20">
                                    <div class="form__item">
                                        <label for="manufacturer_id">Выберите производителя</label>
                                        <select class="nice-select wide form__select" name="manufacturer_id" id="manufacturer_id" :class="errors.manufacturer_id ? 'is-invalid' : ''">
                                            <option v-for="manufacturer in manufacturers" :value="manufacturer.id"> {{manufacturer.title}} </option>
                                        </select>
                                        <div :class="errors.manufacturer_id ? 'invalid-feedback' : ''" v-for="error in errors.manufacturer_id">
                                            {{error}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form__item mb-20">
                                        <label for="material">Введите материал</label>
                                        <input type="text" id="material" name="material" :class="errors.material ? 'is-invalid' : ''">
                                        <div :class="errors.material ? 'invalid-feedback' : ''" v-for="error in errors.material">
                                            {{error}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form__item mb-20">
                                        <label for="weight">Введите вес</label>
                                        <input type="text" id="weight" name="weight" :class="errors.weight ? 'is-invalid' : ''">
                                        <div :class="errors.weight ? 'invalid-feedback' : ''" v-for="error in errors.weight">
                                            {{error}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form__item mb-20">
                                        <label for="old_price">Введите старую цену</label>
                                        <input type="text" id="old_price" name="old_price" :class="errors.old_price ? 'is-invalid' : ''">
                                        <div :class="errors.old_price ? 'invalid-feedback' : ''" v-for="error in errors.old_price">
                                            {{error}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form__item mb-20">
                                        <label for="new_price">Введите актуальную цену</label>
                                        <input type="text" id="new_price" name="new_price" :class="errors.new_price ? 'is-invalid' : ''">
                                        <div :class="errors.new_price ? 'invalid-feedback' : ''" v-for="error in errors.new_price">
                                            {{error}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form__item mb-20">
                                        <label for="images">Прикрепите изображения</label>
                                        <input type="file" id="images" name="images[]" multiple :class="errors.images ? 'is-invalid' : ''">
                                        <div :class="errors.images ? 'invalid-feedback' : ''" v-for="error in errors.images">
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

    props: {
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
        async Add() {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const form = document.getElementById('FormAdd');
            const formData = new FormData(form);
            const response = await fetch('/product/add', {
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
