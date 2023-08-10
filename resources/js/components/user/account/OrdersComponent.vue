<template>
    <table class="table">
        <thead class="table__header">
        <tr>
            <th>#</th>
            <th>Дата</th>
            <th>Статус</th>
            <th>Итог</th>
            <th>Детали</th>
        </tr>
        </thead>
        <tbody class="table__content">
        <tr v-for="order in orders">
            <td>{{order.id}}</td>
            <td>{{(new Date(order.created_at)).toLocaleString()}}</td>
            <td><span class="success">{{order.status}}</span></td>
            <td>{{order.price}} ₽</td>
            <td>
                <div class="table__wrapper-button">
                    <button type="button" class="table__button  table__button--info" data-bs-toggle="modal" data-bs-target="#modalInfo" @click="OpenModalInfo(order.id)" title="детали">
                        <i class="fa fa-info"></i>
                    </button>
                    <button v-if="order.status == 'В обработке'" type="button" class="table__button  table__button--delete" data-bs-toggle="modal" data-bs-target="#modalDelete" @click="OpenModalDelete(order.id)" title="отменить">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
            </td>
        </tr>
        </tbody>
    </table>

    <info-modal-component :order="activeOrder"></info-modal-component>
    <reject-modal-component :orderId="activeOrderId" @GetOrders="Get(pagination.current_page)"></reject-modal-component>
</template>

<script>
import InfoModalComponent from "./order/InfoModalComponent.vue";
import RejectModalComponent from "./order/RejectModalComponent.vue";

export default {
    name: "OrdersComponent",

    components: {
        InfoModalComponent,
        RejectModalComponent
    },

    data() {
        return {
            orders: [],

            pagination: {},

            activeOrder: {},
            activeOrderId: 0,
        }
    },

    methods: {
        async Get(page) {
            try {
                let url = '/orders/user/get?page=${page}';
                url += `&paginate=${10}`;


                const response = await fetch(url);
                if (response.ok) {
                    const data = await response.json();
                    this.orders = data.orders;
                    this.pagination = {
                        current_page: data.current_page,
                        last_page: data.last_page,
                    };

                    if (this.orders.length === 0 && this.pagination.current_page > 1) {
                        this.Get(this.pagination.current_page - 1);
                    }
                } else {
                    console.log("Ошибка при выполнении запроса");
                }
            } catch (error) {
                console.log(error);
            }
        },

        OpenModalInfo(id) {
            this.activeOrder = this.orders.find(order => order.id === id);
            console.log(this.activeOrder.carts);
            document.getElementById('modalInfoTitle').innerText = 'Детали заказа';
        },

        OpenModalDelete(id) {
            this.activeOrderId = id;
            document.getElementById('modalDeleteTitle').innerText = 'Вы уверены, что хотите отменить заказ?';
        }
    },

    mounted() {
        this.Get(1);
    },

    computed: {
        visiblePages() {
            const currentPage = this.pagination.current_page;
            const lastPage = this.pagination.last_page;
            const delta = 1;
            const range = [];
            let left = currentPage - delta;
            let right = currentPage + delta + 1;
            let prev;

            for (let page = 1; page <= lastPage; page++) {
                if (page === 1 || page === lastPage || (page >= left && page < right)) {
                    if (prev && page - prev !== 1) {
                        range.push('...');
                    }
                    range.push(page);
                    prev = page;
                }
            }

            return range;
        },
    }
}
</script>

<style scoped>

</style>
