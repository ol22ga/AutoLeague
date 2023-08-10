<template>
    <div id="OffcanvasCart" class="offcanvas offcanvas__right">
        <div class="offcanvas__header text-right">
            <button class="offcanvas__close"><i class="fa fa-close"></i></button>
        </div>
        <div class="offcanvas__wrapper">
            <h4 class="offcanvas__title">Корзина</h4>
            <p class="offcanvas__error">{{message}}</p>
            <ul class="offcanvas__list">
                <li class="offcanvas__item" v-for="cart in carts">
                    <div class="offcanvas__product">
                        <a href="#" class="offcanvas__img-wrapper">
                            <img :src="cart.product.product_images[0].img" alt="" class="offcanvas__img">
                        </a>
                        <div class="offcanvas__content">
                            <a href="#" class="offcanvas__name">{{cart.product.title}}</a>
                            <div class="count-product">
                                <button class="count-product__button"><i class="fa fa-minus" @click="RunDecrementToCart(cart.product.id)"></i></button>
                                <span class="count-product__count">{{cart.count}}</span>
                                <button class="count-product__button"><i class="fa fa-plus" @click="RunAddToCart(cart.product.id)"></i></button>
                                <span class="count-product__price">{{cart.price}} ₽</span>
                            </div>
                        </div>
                    </div>
                    <div class="offcanvas__btn-delete text-right">
                        <button @click="RunDeleteCart(cart.product.id)"><i class="fa fa-close"></i></button>
                    </div>
                </li> <!-- .offcanvas__item -->
            </ul> <!-- .offcanvas__list -->
            <div class="offcanvas__price-wrapper" v-if="carts.length > 0">
                <span class="offcanvas__text">Итог:</span>
                <span class="offcanvas__value">{{order.price}} ₽</span>
            </div> <!-- .offcanvas__price -->
            <div class="offcanvas__price-wrapper" v-else>
                <span class="offcanvas__text">Корзина пуста</span>
            </div> <!-- .offcanvas__price -->
            <div class="offcanvas__list-btn" v-if="carts.length > 0">
                <a href="/cart" class="button  button--dark">Перейти в корзину</a>
                <a href="/checkout" class="button  button--dark">Перейти к оформлению</a>
            </div> <!-- .offcanvas__list-btn -->
            <div class="offcanvas__list-btn" v-else>
                <a href="/catalog" class="button  button--dark">Начать покупки</a>
            </div> <!-- .offcanvas__list-btn -->
        </div> <!-- .offcanvas__wrapper -->
    </div> <!-- .offcanvas .offcanvas__right -->

    <edit-cart-component :productId="activeProductId" ref="editCartRef" :settingGet="true" @GetCarts="Get" @errorMessage="HandleErrorMessage"></edit-cart-component>
</template>

<script>
import EditCartComponent from "./EditCartComponent.vue";
import {ref} from "vue";

export default {
    name: "OffcavasCartComponent",

    components: {
        EditCartComponent
    },

    data() {
        return {
            carts: [],
            order: {},

            message: '',

            activeProductId: 0,
            activeCartId: 0,

            editCartRef: null,
        }
    },

    methods: {
        async Get() {
            try {
                const response = await fetch(`/cart/get`);
                if (response.ok) {
                    const data = await response.json();
                    this.carts = data.carts;
                    this.order = data.order;
                    // console.log(this.carts);
                } else {
                    console.log("Ошибка при выполнении запроса");
                }
            } catch (error) {
                console.log(error);
            }
        },

        RunAddToCart(id) {
            this.activeProductId = id;
            this.$nextTick(() => {
                this.editCartRef.Add();
            });
        },

        RunDecrementToCart(id) {
            this.activeProductId = id;
            this.$nextTick(() => {
                this.editCartRef.Decrement();
            });
        },

        RunDeleteCart(id) {
            this.activeProductId = id;
            this.$nextTick(() => {
                this.editCartRef.Delete();
            });
        },

        HandleErrorMessage(message) {
            this.message = message;
            setTimeout(()=>{
                this.message =''
            }, 3000);
        }
    },

    mounted() {
        this.Get();
        this.editCartRef = ref(this.$refs.editCartRef);
    }
}
</script>

<style scoped>

</style>
