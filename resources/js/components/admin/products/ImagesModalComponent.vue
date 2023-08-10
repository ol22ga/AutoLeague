<template>
    <div class="modal fade" id="modalAddImage" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modalAddImageTitle"></h3>
                    <button type="button" class="close modal-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"> <i class="fa fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-wrapper">
                        <div class="row align-items-stretch">
                            <div class="col-lg-4 col-sm-6 col-12 mb-20" v-for="item in images">
                                <div class="image__container">
                                    <img class="img-fluid" :src="item.img" alt="">
                                    <div class="image__back">
                                        <button class="button" type="button" @click="Delete(item.id)">Удалить</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form id="FormAddImage" @submit.prevent="Add" enctype="multipart/form-data">
                        <div class="row">
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
                                        <button class="button button--dark" type="button" id="modalAddImageClose" data-bs-dismiss="modal" aria-label="Close">Закрыть</button>
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
</template>

<script>
export default {
    name: "ImagesModalComponent",

    props: {
        productId: {
            type: Number,
            required: true
        },
        images: {
            type: Array,
            required: true
        }
    },

    data() {
        return {
            errors: [],
        }
    },

    methods: {
        async Delete(id) {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const response = await fetch('/product/image/delete', {
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({id:id})
            });
            if (response.status === 200) {
                document.getElementById('modalAddImageClose').click();
                this.$emit('GetProducts');
            };
        },

        async Add() {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const form = document.getElementById('FormAddImage');
            const formData = new FormData(form);
            formData.append('product_id', this.productId);
            const response = await fetch('/product/image/add', {
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                body: formData
            })
            if (response.status === 200) {
                document.getElementById('modalAddImageClose').click();
                form.reset();
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
.modal-wrapper {
    margin-bottom: 20px;
    border-bottom: 1px solid #f2f2f2;
}

.image__container {
    height: 200px;
    overflow: hidden;
    position: relative;
    cursor: pointer;
}

.image__back {
    width: 100%;
    height: 100%;
    backdrop-filter: brightness(0.3);

    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    opacity: 0;

    padding: 10px;

    transition: all 0.5s ease 0s;
}

.image__container:hover .image__back {
    opacity: 1;
}

.image__container .img-fluid {
    object-fit: cover;
    height: 100%;
}

@media (max-width: 575px) {
    .image__container {
        width: 100%;
        height: auto;
        overflow: hidden;
    }
}
</style>
