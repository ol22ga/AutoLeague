<template>
    <div class="container">
        <div class="row justify-content-end mb-20" :class="{ 'justify-content-center' : brands.length === 0 }">
            <div class="col-md-6 col-lg-4">
                <button class="button" data-bs-toggle="modal" data-bs-target="#modalAdd">Новая марка</button>
            </div>
        </div>

        <table class="table" v-if="brands.length > 0">
            <thead class="table__header">
            <tr>
                <th>#</th>
                <th>Название</th>
                <th class="text-right">Действие</th>
            </tr>
            </thead>
            <tbody class="table__content">
            <tr v-for="(brand, index) in brands">
                <td> {{brand.id}} </td>
                <td> {{brand.title}} </td>
                <td>
                    <div class="table__wrapper-button">
                        <button type="button" class="table__button  table__button--image" data-bs-toggle="modal" data-bs-target="#modalInfo" @click="OpenModalInfo(brand.id)" title="просмотр изображения">
                            <i class="fa fa-image"></i>
                        </button>
                        <button type="button" class="table__button  table__button--edit" data-bs-toggle="modal" data-bs-target="#modalEdit" @click="OpenModalEdit(brand.id)" title="изменить">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button type="button" class="table__button  table__button--delete" data-bs-toggle="modal" data-bs-target="#modalDelete" @click="OpenModalDelete(brand.id)" title="удалить">
                            <i class="fa fa-close"></i>
                        </button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

        <h4 v-else class="text-center">Ни одна марка пока не добавлена</h4>

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

    <add-modal-component @GetBrands="Get(pagination.current_page)"></add-modal-component>
    <info-modal-component></info-modal-component>
    <edit-modal-component @GetBrands="Get(pagination.current_page)" :brandId="activeBrandId"></edit-modal-component>
    <delete-modal-component @GetBrands="Get(pagination.current_page)" :brandId="activeBrandId"></delete-modal-component>
</template>

<script>
import AddModalComponent from "./brands/AddModalComponent.vue";
import InfoModalComponent from "./brands/InfoModalComponent.vue";
import EditModalComponent from "./brands/EditModalComponent.vue";
import DeleteModalComponent from "./brands/DeleteModalComponent.vue";

export default {
    name: "BrandComponent",

    components: {
        AddModalComponent,
        InfoModalComponent,
        EditModalComponent,
        DeleteModalComponent,
    },

    data() {
        return {
            brands: [],
            errors: [],

            activeBrandId: 0,

            pagination: {},
        }
    },

    methods: {
        async Get(page) {
            try {
                const response = await fetch(`/brands/get?page=${page}`);
                if (response.ok) {
                    const data = await response.json();
                    this.brands = data.brands;
                    this.pagination = {
                        current_page: data.current_page,
                        last_page: data.last_page,
                    };

                    if (this.brands.length === 0 && this.pagination.current_page > 1) {
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
            var activeBrand = this.brands.find(brand => brand.id === id);
            document.getElementById('modalInfoTitle').innerText = activeBrand.title;
            document.getElementById('modalInfoImg').src = activeBrand.img;
        },

        OpenModalEdit(id) {
            this.activeBrandId = id;
            var activeBrand = this.brands.find(brand => brand.id === id);
            document.getElementById('modalEditTitle').innerText = 'Изменение марки "' + activeBrand.title + '"';
            document.getElementById('modalEditInputTitle').value = activeBrand.title;
        },

        OpenModalDelete(id) {
            this.activeBrandId = id;
            var activeBrand = this.brands.find(brand => brand.id === id);
            document.getElementById('modalDeleteTitle').innerText = 'Вы уверены, что хотите удалить марку "' + activeBrand.title + '"?';
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
