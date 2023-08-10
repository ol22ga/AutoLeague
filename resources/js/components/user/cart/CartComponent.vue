<template>
    <p class="cart__error">{{message}}</p>
    <div class="row" v-if="carts.length > 0">
        <div class="col-lg-6">
            <div class="row">
                <div class="col-12" v-for="cart in carts">
                    <div class="cart__product mb-6">
                        <div class="row">
                            <div class="cart__img col-4">
                                <img :src="cart.product.product_images[0].img" alt="">
                            </div>
                            <div class="cart__info col-8">
                                <div class="cart__wrapper">
                                    <div class="cart__inner">
                                        <p class="cart__title-product">{{cart.product.title}}</p>
                                        <button @click="RunDeleteCart(cart.product.id)"><i class="fa fa-close"></i></button>
                                    </div>
                                    <span class="product__price"><del class="product__price--off">{{cart.product.old_price}} ₽</del> {{cart.product.new_price}} ₽</span>
                                    <p class="cart__text-product">{{cart.product.description}}</p>
                                </div>
                                <div class="count-product">
                                    <button class="count-product__button" @click="RunDecrementToCart(cart.product.id)"><i class="fa fa-minus"></i></button>
                                    <span class="count-product__count">{{cart.count}}</span>
                                    <button class="count-product__button" @click="RunAddToCart(cart.product.id)"><i class="fa fa-plus"></i></button>
                                    <span class="count-product__price">{{cart.price}} ₽</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- .col-6 -->
        <div class="col-lg-6">
            <div class="cart-result right">
                <h3>Ваша корзина</h3>
                <div class="cart-result__inner">
                    <div class="cart-result__subtotal">
                        <p>Товары</p>
                        <p class="cart-result__amount">{{order.price + order.discount}} ₽</p>
                    </div>
                    <div class="cart-result__subtotal">
                        <p>Скидка</p>
                        <p class="cart-result__amount"> {{order.discount}} ₽</p>
                    </div>
                    <div class="cart-result__subtotal">
                        <p>Итоговая стоимость</p>
                        <p class="cart-result__amount">{{order.price}} ₽</p>
                    </div>
                    <a href="/checkout" class="button">Перейти к оформлению</a>
                </div> <!-- .coupon_inner -->
            </div> <!-- .coupon_code .right -->
        </div> <!-- .col-lg-6 .col-md-6 -->
    </div> <!-- .row -->
    <div v-else class="row justify-content-center">
        <h4 class="col-12 text-center mb-4">Корзина пуста</h4>
        <div class="col-12 col-sm-6">
            <a href="/catalog" class="button">Начать покупки</a>
        </div>
    </div>

    <edit-cart-component :productId="activeProductId" ref="editCartRef" :settingGet="true" @GetCarts="Get" @errorMessage="HandleErrorMessage"></edit-cart-component>
</template>

<script>
import {ref} from "vue";
import EditCartComponent from "./EditCartComponent.vue";

export default {
    name: "CartComponent",

    components: {
        EditCartComponent,
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
