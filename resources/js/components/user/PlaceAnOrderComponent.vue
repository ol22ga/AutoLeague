<template>
    <div class="">
        <div class="row flex-column-reverse flex-md-row">
            <div class="col-lg-6 col-md-6 mt-6 mt-md-0">
                <div class="cart-result right">
                    <h3>Оформление заказа</h3>
                    <form class="form" id="FormOrder" @submit.prevent="PlaceAnOrder(order.id)">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form__item mb-20">
                                    <label for="firstname">Введите имя</label>
                                    <input type="text" id="firstname" name="firstname" :class="errors.firstname ? 'is-invalid' : ''">
                                    <div :class="errors.firstname ? 'invalid-feedback' : ''" v-for="error in errors.firstname">
                                        {{error}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form__item mb-20">
                                    <label for="lastname">Введите фамилию</label>
                                    <input type="text" id="lastname" name="lastname" :class="errors.lastname ? 'is-invalid' : ''">
                                    <div :class="errors.lastname ? 'invalid-feedback' : ''" v-for="error in errors.lastname">
                                        {{error}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form__item mb-20">
                                    <label for="address">Введите адрес</label>
                                    <input type="text" id="address" name="address" :class="errors.address ? 'is-invalid' : ''">
                                    <div :class="errors.address ? 'invalid-feedback' : ''" v-for="error in errors.address">
                                        {{error}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form__item mb-20">
                                    <label for="phone">Введите номер телефона</label>
                                    <input type="text" id="phone" name="phone" :class="errors.phone ? 'is-invalid' : ''">
                                    <div :class="errors.phone ? 'invalid-feedback' : ''" v-for="error in errors.phone">
                                        {{error}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form__item mb-20">
                                    <label for="email">Введите email</label>
                                    <input type="text" id="email" name="email" :class="errors.email ? 'is-invalid' : ''">
                                    <div :class="errors.email ? 'invalid-feedback' : ''" v-for="error in errors.email">
                                        {{error}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button class="button button--dark" type="submit">Оформить</button>
                            </div>
                        </div> <!-- .row -->
                    </form> <!-- form -->
                </div> <!-- .coupon_code .right -->
            </div> <!-- .col-lg-6 .col-md-6 -->
            <div class="col-lg-6 col-md-6">
                <div class="cart-result right">
                    <h3>Ваш заказ</h3>
                    <table class="table">
                        <thead class="table__header">
                        <tr>
                            <th class="order__th--left">Список товаров</th>
                            <th class="order__th--right">Цена</th>
                        </tr>
                        </thead>
                        <tbody class="table__content">
                        <tr v-for="cart in carts">
                            <td class="order__td--left">{{cart.product.title}} х {{cart.count}}</td>
                            <td class="order__td--right">{{cart.price}} ₽</td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="cart-result__inner">
                        <div class="cart-result__subtotal">
                            <p>Товары</p>
                            <p class="cart-result__amount">{{order.price + order.discount}} ₽</p>
                        </div>
                        <div class="cart-result__subtotal">
                            <p>Скидка</p>
                            <p class="cart-result__amount">- {{order.discount}} ₽</p>
                        </div>
                        <div class="cart-result__subtotal">
                            <p>Итоговая стоимость</p>
                            <p class="cart-result__amount">{{order.price}} ₽</p>
                        </div>
                    </div> <!-- .coupon_inner -->
                </div> <!-- .coupon_code .right -->
            </div> <!-- .col-lg-6 .col-md-6 -->
        </div> <!-- .row -->
    </div> <!-- .checkout_form -->
</template>

<script>
export default {
    name: "PlaceAnOrderComponent",

    data() {
        return {
            carts: [],
            order: {},

            errors: [],
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

        async GetUserInfo() {
            try {
                const response = await fetch(`/user/get`);
                if (response.ok) {
                    const data = await response.json();
                    this.user = data.user;


                    this.$nextTick(() => {
                        if (this.user.firstname) {
                            const inputName = document.getElementById('firstname');
                            inputName.value = this.user.firstname;
                            inputName.readOnly = true
                        }
                        if (this.user.lastname) {
                            const inputName = document.getElementById('lastname');
                            inputName.value = this.user.lastname;
                            inputName.readOnly = true
                        }
                        if (this.user.phone) {
                            const inputName = document.getElementById('phone');
                            inputName.value = this.user.phone;
                            inputName.readOnly = true
                        }
                        if (this.user.email) {
                            const inputName = document.getElementById('email');
                            inputName.value = this.user.email;
                            inputName.readOnly = true
                        }
                    });
                } else {
                    console.log("Ошибка при выполнении запроса");
                }
            } catch (error) {
                console.log(error);
            }
        },

        async PlaceAnOrder(id) {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const form = document.getElementById('FormOrder');
            const formData = new FormData(form);
            formData.append('id', id);
            const response = await fetch('/order/place', {
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': token,
                },
                body: formData
            });
            if (response.status === 200) {
                window.location = response.url;
            }
            if (response.status === 400) {
                this.errors = await response.json();
            }
        },

    },

    mounted() {
        this.Get();
        this.GetUserInfo();
    }
}
</script>

<style scoped>

</style>
