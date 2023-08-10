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
                                <td class="table__title">Артикул</td>
                                <td> {{product.article}} </td>
                            </tr>
                            <tr>
                                <td class="table__title">Название</td>
                                <td> {{product.title}} </td>
                            </tr>
                            <tr>
                                <td class="table__title">Описание</td>
                                <td> {{product.description}} </td>
                            </tr>
                            <tr>
                                <td class="table__title">Категория</td>
                                <td v-if="product.category_id"> {{product.category.title}} </td>
                            </tr>
                            <tr>
                                <td class="table__title">Производитель</td>
                                <td v-if="product.manufacturer_id"> {{product.manufacturer.title}} </td>
                            </tr>
                            <tr>
                                <td class="table__title">Комплектация</td>
                                <td> {{product.complete_set}} </td>
                            </tr>
                            <tr>
                                <td class="table__title">Марка</td>
                                <td v-if="product.brand_id"> {{product.brand.title}} </td>
                            </tr>
                            <tr>
                                <td class="table__title">Материал</td>
                                <td> {{product.material}} </td>
                            </tr>
                            <tr>
                                <td class="table__title">Вес</td>
                                <td> {{product.weight}} </td>
                            </tr>
                            <tr>
                                <td class="table__title">На складе</td>
                                <td> {{product.count}} штук(и)</td>
                            </tr>
                            <tr>
                                <td class="table__title">Цена</td>
                                <td> <s>{{product.old_price}} ₽</s> {{product.new_price}} ₽ </td>
                            </tr>
                            <tr>
                                <td class="table__title">Купили</td>
                                <td> {{product.buy}} раз(а)</td>
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
        product: {
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
