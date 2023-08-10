<template>
    <div class="modal fade" id="modalInfo" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modalInfoTitle"></h3>
                    <button type="button" class="close modal-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"> <i class="fa fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-wrapper">
                        <table class="table">
                            <tbody class="table__content">
                            <tr>
                                <td class="table__title">#</td>
                                <td> {{order.id}} </td>
                            </tr>
                            <tr v-if="order.user">
                                <td class="table__title">Заказчик</td>
                                <td> {{order.user.firstname}} {{order.user.lastname}} ({{order.user.phone}})</td>
                            </tr>
                            <tr>
                                <td class="table__title">Адрес</td>
                                <td> {{order.address}} </td>
                            </tr>
                            <tr v-if="order.carts">
                                <td class="table__title">Товары</td>
                                <td>
                                    <table class="w-100">
                                        <tbody>
                                        <tr class="text-right" v-for="cart in order.carts">
                                            {{cart.product.title}} ({{cart.product.article}}) x {{cart.count}}
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="table__title">Итоговая стоимость</td>
                                <td> {{order.price}} ₽</td>
                            </tr>
                            <tr>
                                <td class="table__title">Скидка</td>
                                <td> {{order.discount}} ₽</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "InfoModal",

    props: {
        order: {
            type: Object,
            required: true
        }
    }
}
</script>

<style scoped>
td {
    width: 50% !important;
    text-align: left !important;
}

td:nth-child(2n) {
    text-align: right !important;
}
</style>
