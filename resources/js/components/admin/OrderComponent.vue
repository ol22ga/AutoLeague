<template>
    <div class="container">
        <table class="table" v-if="orders.length > 0">
            <thead class="table__header">
            <tr>
                <th>#</th>
                <th>Дата создания</th>
                <th>Статус</th>
                <th class="text-right">Действие</th>
            </tr>
            </thead>
            <tbody class="table__content">
            <tr v-for="order in orders">
                <td> {{order.id}} </td>
                <td>{{(new Date(order.created_at)).toLocaleString()}}</td>
                <td> {{order.status}} </td>
                <td>
                    <div class="table__wrapper-button">
                        <button type="button" class="table__button  table__button--info" data-bs-toggle="modal" data-bs-target="#modalInfo" @click="OpenModalInfo(order.id)" title="подробная информация">
                            <i class="fa fa-info"></i>
                        </button>
                        <button type="button" class="table__button  table__button--edit" data-bs-toggle="modal" data-bs-target="#modalComment" @click="OpenModalEdit(order.id)" title="изменить статус">
                            <i class="fa fa-edit"></i>
                        </button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

        <h4 v-else class="text-center">Заказы не найдены</h4>

        <div class="row justify-content-end" @mouseenter="SettingSelect">
            <div class=" col-lg-6 col-12">
                <form class="form" id="FormFilter" @submit.prevent="Get">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form__item">
                                <select class="nice-select wide form__select" name="status_order">
                                    <option value="0"> Все </option>
                                    <option value="В обработке"> В обработке </option>
                                    <option value="Принят в работу"> Приняты в работу </option>
                                    <option value="Передан в доставку"> Переданы в доставку </option>
                                    <option value="Завершен"> Завершенные </option>
                                    <option value="Отклонен"> Отклоненные </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <button class="button" type="submit">Применить фильтры</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="page-pagination text-center">
            <ul v-if="pagination.last_page > 1">
                <li>
                    <button @click="Get(pagination.current_page - 1)" :disabled="pagination.current_page === 1">
                        <i class="fa fa-chevron-left"></i>
                    </button>
                </li>
                <li v-for="page in visiblePages" :key="page">
                    <template v-if="typeof page === 'number'">
                        <button @click="Get(page)" :class="{ active: page === pagination.current_page }">
                            {{ page }}
                        </button>
                    </template>
                    <template v-else>
                        <span>{{ page }}</span>
                    </template>
                </li>
                <li>
                    <button @click="Get(pagination.current_page + 1)" :disabled="pagination.current_page === pagination.last_page">
                        <i class="fa fa-chevron-right"></i>
                    </button>
                </li>
            </ul>
        </div> <!-- .page-pagination .text-center -->
    </div>

    <info-modal-component :order="order"></info-modal-component>
    <comment-modal-component @GetOrders="Get(pagination.current_page)" :orderId="activeOrderID"></comment-modal-component>
</template>

<script>
import CommentModalComponent from "./orders/CommentModalComponent.vue";
import InfoModalComponent from "./orders/InfoModalComponent.vue";

export default {
    name: "OrderComponent",

    components: {
        CommentModalComponent,
        InfoModalComponent
    },

    data() {
        return {
            orders: [],

            pagination: {},

            order: {},
            activeOrderID: 0,
        }
    },

    methods: {
        async Get(page) {
            try {
                const form = document.getElementById('FormFilter');
                const formData = new FormData(form);
                const selectStatus = formData.get('status_order');

                let url = '/orders/get?page=${page}';
                url += `&paginate=${5}`;

                if (selectStatus !== '0') {
                    url += `&status_order=${selectStatus}`;
                }

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
            this.order = this.orders.find(order => order.id === id);
            document.getElementById('modalInfoTitle').innerText = 'Заказ №' + this.order.id;
        },

        OpenModalEdit(id) {
            this.activeOrderID = this.orders.find(order => order.id === id).id;
            document.getElementById('modalCommentTitle').innerText = 'Комментарий к заказу №' + this.activeOrderID;
        },

        SettingSelect() {
            $('select').niceSelect();
        },
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
