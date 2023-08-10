<template>
    <div class="modal fade" id="modalQuickview" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col text-right">
                                <button type="button" class="close modal-close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"> <i class="fa fa-times"></i></span>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="product-gallery__wrapper" v-if="product.product_images">
                                    <img class="img-fluid" :src="product.product_images[0].img" alt="">
                                </div> <!-- .product-gallery__wrapper -->
                            </div> <!-- .col-md-6 -->
                            <div class="col-md-6">
                                <div class="product-description">
                                    <div class="product-description__text">
                                        <h4 class="product-description__text--title">{{product.title}}</h4>
                                        <div class="d-flex align-items-center">
                                            <div class="product-description__review">
                                                <span class="product-description__star product-description__star--fill"><i class="fa fa-star"></i></span>
                                                <span class="product-description__star"><i class="fa fa-star"></i></span>
                                                <span class="product-description__star"><i class="fa fa-star"></i></span>
                                                <span class="product-description__star"><i class="fa fa-star"></i></span>
                                                <span class="product-description__star"><i class="fa fa-star"></i></span>
                                            </div>
                                            <a href="" class="product-description__text--link">(отзывы)</a>
                                        </div>
                                        <div class="product-description__text--price"><del>{{product.old_price}} ₽</del>{{product.new_price}} ₽</div>
                                        <p>{{product.description}}</p>
                                    </div>
                                    <div class="row align-items-center mb-20">
                                        <div class="col-lg-6">
                                            <button data-bs-toggle="modal" data-bs-target="#modalAddcart" class="button">В корзину</button>
                                        </div>
                                    </div>
                                    <div class="product-meta mb-20">
                                        <ul>
                                            <li><a href=""><i class="fa fa-heart-o"></i>Добавить в избранное</a></li>
                                            <li><a href=""><i class="fa fa-repeat"></i>Сравнить</a></li>
                                        </ul>
                                    </div>
                                </div> <!-- .product-details-content-area -->
                            </div> <!-- .col-md-6 -->
                        </div> <!-- .row -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import jQuery from 'jquery';

import 'slick-carousel';

import 'vue-slick-carousel/dist/vue-slick-carousel.css';
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css';

export default {
    name: "ProductModalComponent",

    props: {
        product: {
            type: Object,
            required: true
        },
        // settingGet: {
        //     type: Boolean,
        //     required: false
        // }
    },

    methods: {

    },
}
</script>

<style scoped>

</style>
