<template>
    <div class="container">
        <div class="row justify-content-end mb-20" :class="{ 'justify-content-center' : categories.length === 0 }">
            <div class="col-md-6 col-lg-4">
                <button class="button" data-bs-toggle="modal" data-bs-target="#modalAdd">Новая категория</button>
            </div>
        </div>

        <table class="table" v-if="categories.length > 0">
            <thead class="table__header">
            <tr>
                <th>#</th>
                <th>Название</th>
                <th class="text-right">Действие</th>
            </tr>
            </thead>
            <tbody class="table__content">
            <tr v-for="(category, index) in categories">
                <td> {{category.id}} </td>
                <td> {{category.title}} </td>
                <td>
                    <div class="table__wrapper-button">
                        <button type="button" class="table__button  table__button--image" data-bs-toggle="modal" data-bs-target="#modalInfo" @click="OpenModalInfo(category.id)" title="просмотр изображения">
                            <i class="fa fa-image"></i>
                        </button>
                        <button type="button" class="table__button  table__button--edit" data-bs-toggle="modal" data-bs-target="#modalEdit" @click="OpenModalEdit(category.id)" title="изменить">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button type="button" class="table__button  table__button--delete" data-bs-toggle="modal" data-bs-target="#modalDelete" @click="OpenModalDelete(category.id)" title="удалить">
                            <i class="fa fa-close"></i>
                        </button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

        <h4 v-else class="text-center">Ни одна категория пока не добавлена</h4>

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

    <add-modal-component @GetCategories="Get(pagination.current_page)"></add-modal-component>
    <info-modal-component></info-modal-component>
    <edit-modal-component @GetCategories="Get(pagination.current_page)" :categoryId="activeCategoryId"></edit-modal-component>
    <delete-modal-component @GetCategories="Get(pagination.current_page)" :categoryId="activeCategoryId"></delete-modal-component>
</template>

<script>
import AddModalComponent from "./categories/AddModalComponent.vue";
import InfoModalComponent from "./categories/InfoModalComponent.vue";
import EditModalComponent from "./categories/EditModalComponent.vue";
import DeleteModalComponent from "./categories/DeleteModalComponent.vue";

export default {
    name: "CategoryComponent",

    components: {
        AddModalComponent,
        InfoModalComponent,
        EditModalComponent,
        DeleteModalComponent,
    },

    data() {
        return {
            categories: [],
            errors: [],

            activeCategoryId: 0,

            pagination: {},
        }
    },

    methods: {
        async Get(page) {
            try {
                const response = await fetch(`/categories/get?page=${page}`);
                if (response.ok) {
                    const data = await response.json();
                    this.categories = data.categories;
                    this.pagination = {
                        current_page: data.current_page,
                        last_page: data.last_page,
                    };

                    if (this.categories.length === 0 && this.pagination.current_page > 1) {
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
            var activeCategory = this.categories.find(category => category.id === id);
            document.getElementById('modalInfoTitle').innerText = activeCategory.title;
            document.getElementById('modalInfoImg').src = activeCategory.img;
        },

        OpenModalEdit(id) {
            this.activeCategoryId = id;
            var activeCategory = this.categories.find(category => category.id === id);
            document.getElementById('modalEditTitle').innerText = 'Изменение категории "' + activeCategory.title + '"';
            document.getElementById('modalEditInputTitle').value = activeCategory.title;
        },

        OpenModalDelete(id) {
            this.activeCategoryId = id;
            var activeCategory = this.categories.find(category => category.id === id);
            document.getElementById('modalDeleteTitle').innerText = 'Вы уверены, что хотите удалить категорию "' + activeCategory.title + '"?';
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
