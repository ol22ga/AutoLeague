<template>
    <div class="container">
        <div class="row justify-content-end mb-20" :class="{ 'justify-content-center' : manufacturers.length === 0 }">
            <div class="col-md-6 col-lg-4">
                <button class="button" data-bs-toggle="modal" data-bs-target="#modalAdd">Новый производитель</button>
            </div>
        </div>

        <table class="table" v-if="manufacturers.length > 0">
            <thead class="table__header">
            <tr>
                <th>#</th>
                <th>Название</th>
                <th class="text-right">Действие</th>
            </tr>
            </thead>
            <tbody class="table__content">
            <tr v-for="(manufacturer, index) in manufacturers">
                <td> {{index + 1}} </td>
                <td> {{manufacturer.title}} </td>
                <td>
                    <div class="table__wrapper-button">
                        <button type="button" class="table__button  table__button--edit" data-bs-toggle="modal" data-bs-target="#modalEdit" @click="OpenModalEdit(manufacturer.id)" title="изменить">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button type="button" class="table__button  table__button--delete" data-bs-toggle="modal" data-bs-target="#modalDelete" @click="OpenModalDelete(manufacturer.id)" title="удалить">
                            <i class="fa fa-close"></i>
                        </button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

        <h4 v-else class="text-center">Ни один производитель пока не добавлен</h4>

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

    <add-modal-component @GetManufacturers="Get(pagination.current_page)"></add-modal-component>
    <edit-modal-component @GetManufacturers="Get(pagination.current_page)" :manufacturerId="activeManufacturerId"></edit-modal-component>
    <delete-modal-component @GetManufacturers="Get(pagination.current_page)" :manufacturerId="activeManufacturerId"></delete-modal-component>
</template>

<script>
import AddModalComponent from "./manufacturers/AddModalComponent.vue";
import EditModalComponent from "./manufacturers/EditModalComponent.vue";
import DeleteModalComponent from "./manufacturers/DeleteModalComponent.vue";

export default {
    name: "ManufacturerComponent",

    components: {
        AddModalComponent,
        EditModalComponent,
        DeleteModalComponent,
    },

    data() {
        return {
            manufacturers: [],
            errors: [],

            activeManufacturerId: 0,

            pagination: {},
        }
    },

    methods: {
        async Get(page) {
            try {
                const response = await fetch(`/manufacturers/get?page=${page}`);
                if (response.ok) {
                    const data = await response.json();
                    this.manufacturers = data.manufacturers;
                    this.pagination = {
                        current_page: data.current_page,
                        last_page: data.last_page,
                    };

                    if (this.manufacturers.length === 0 && this.pagination.current_page > 1) {
                        this.Get(this.pagination.current_page - 1);
                    }
                } else {
                    console.log("Ошибка при выполнении запроса");
                }
            } catch (error) {
                console.log(error);
            }
        },

        OpenModalEdit(id) {
            this.activeManufacturerId = id;
            var activeManufacturer = this.manufacturers.find(manufacturer => manufacturer.id === id);
            document.getElementById('modalEditTitle').innerText = 'Изменение производителя "' + activeManufacturer.title + '"';
            document.getElementById('modalEditInputTitle').value = activeManufacturer.title;
        },

        OpenModalDelete(id) {
            this.activeManufacturerId = id;
            var activeManufacturer = this.manufacturers.find(manufacturer => manufacturer.id === id);
            document.getElementById('modalDeleteTitle').innerText = 'Вы уверены, что хотите удалить производителя "' + activeManufacturer.title + '"?';
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
