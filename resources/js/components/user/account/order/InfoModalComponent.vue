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
                        <table class="table" v-if="order.carts">
                            <tbody class="table__content">
                            <tr v-for="cart in order.carts">
                                <td>
                                    {{cart.product.title}} x {{cart.count}} ({{cart.price}} ₽)
                                </td>
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

</style>
