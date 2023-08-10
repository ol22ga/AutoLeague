<template>
    <div class="container">
        <div class="row justify-content-end mb-20" :class="products.length === 0 ? 'justify-content-center' : ''">
            <div class="col-md-6 col-lg-4" @mouseenter="SettingSelect">
                <form id="FormSorting">
                    <div class="form__item">
                        <select class="nice-select wide form__select" name="sort" id="sort">
                            <option value="newest"> Сначала новые </option>
                            <option value="cheapest"> Сначала дешевые </option>
                            <option value="expensive"> Сначала дорогие </option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="col-md-6 col-lg-4">
                <button class="button" data-bs-toggle="modal" data-bs-target="#modalAdd" @click="SettingSelect">Новый товар</button>
            </div>
        </div>

        <table class="table" v-if="products.length > 0">
            <thead class="table__header">
            <tr>
                <th>#</th>
                <th>Артикул</th>
                <th>Название</th>
                <th>На складе</th>
                <th class="text-right">Действие</th>
            </tr>
            </thead>
            <tbody class="table__content">
            <tr v-for="product in sortingProducts">
                <td> {{product.id}} </td>
                <td> {{product.article}} </td>
                <td> {{product.title}} </td>
                <td> {{product.count}} </td>
                <td>
                    <div class="table__wrapper-button">
                        <button type="button" class="table__button  table__button--info" data-bs-toggle="modal" data-bs-target="#modalInfo" @click="OpenModalInfo(product.id)" title="подробная информация">
                            <i class="fa fa-info"></i>
                        </button>
                        <button type="button" class="table__button  table__button--image" data-bs-toggle="modal" data-bs-target="#modalAddImage" @click="OpenModalImages(product.id)" title="изображения">
                            <i class="fa fa-image"></i>
                        </button>
                        <button type="button" class="table__button  table__button--edit" data-bs-toggle="modal" data-bs-target="#modalEdit" @click="OpenModalEdit(product.id)" title="изменить">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button type="button" class="table__button  table__button--delete" data-bs-toggle="modal" data-bs-target="#modalDelete" @click="OpenModalDelete(product.id)" title="удалить">
                            <i class="fa fa-close"></i>
                        </button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

        <h4 v-else class="text-center">Ни один товар пока не добавлен</h4>

        <div @mouseenter="SettingSelect">
            <form class="form" id="FormFilter" @submit.prevent="Get">
                <div class="row">
                    <div class="col-md-6 col-lg-3">
                        <div class="form__item">
                            <select class="nice-select wide form__select" name="category">
                                <option value="0"> Все категории </option>
                                <option v-for="category in categories" :value="category.id"> {{category.title}} </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="form__item">
                            <select class="nice-select wide form__select" name="brand">
                                <option value="0"> Все марки </option>
                                <option v-for="brand in brands" :value="brand.id"> {{brand.title}} </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="form__item">
                            <select class="nice-select wide form__select" name="manufacturer">
                                <option value="0"> Все производители </option>
                                <option v-for="manufacturer in manufacturers" :value="manufacturer.id"> {{manufacturer.title}} </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 mb-2">
                        <button class="button" type="submit">Применить фильтры</button>
                    </div>
                </div>
            </form>
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

    <add-modal-component @GetProducts="Get(pagination.current_page)" :categories="categories" :brands="brands" :manufacturers="manufacturers"></add-modal-component>
    <info-modal-component :product="product"></info-modal-component>
    <images-modal-component @GetProducts="Get(pagination.current_page)" :images="productImages" :productId="activeProductId"></images-modal-component>
    <edit-modal-component @GetProducts="Get(pagination.current_page)" :productId="activeProductId" :categories="categories" :brands="brands" :manufacturers="manufacturers"></edit-modal-component>
    <delete-modal-component @GetProducts="Get(pagination.current_page)" :productId="activeProductId"></delete-modal-component>
</template>

<script>
import AddModalComponent from "./products/AddModalComponent.vue";
import InfoModalComponent from "./products/InfoModalComponent.vue";
import ImagesModalComponent from "./products/ImagesModalComponent.vue";
import EditModalComponent from "./products/EditModalComponent.vue";
import DeleteModalComponent from "./products/DeleteModalComponent.vue";

export default {
    name: "ProductComponent",

    components: {
        AddModalComponent,
        InfoModalComponent,
        ImagesModalComponent,
        EditModalComponent,
        DeleteModalComponent,
    },

    data() {
        return {
            products: [],
            categories: [],
            brands: [],
            manufacturers: [],
            errors: [],

            product: {},
            activeProductId: 0,
            productImages: [],

            pagination: {},
            sort: 'newest'
        }
    },

    methods: {
        async Get(page) {
            try {
                const form = document.getElementById('FormFilter');
                const formData = new FormData(form);

                const selectCategory = formData.get('category');
                const selectBrand = formData.get('brand');
                const selectManufacturer = formData.get('manufacturer');

                let url = '/products/get?page=${page}';
                url += `&paginate=${5}`;

                if (selectCategory !== '0') {
                    url += `&category=${selectCategory}`;
                }
                if (selectBrand !== '0') {
                    url += `&brand=${selectBrand}`;
                }
                if (selectManufacturer !== '0') {
                    url += `&manufacturer=${selectManufacturer}`;
                }

                const response = await fetch(url);
                if (response.ok) {
                    const data = await response.json();
                    this.products = data.products;
                    this.pagination = {
                        current_page: data.current_page,
                        last_page: data.last_page,
                    };

                    if (this.products.length === 0 && this.pagination.current_page > 1) {
                        this.Get(this.pagination.current_page - 1);
                    }
                } else {
                    console.log("Ошибка при выполнении запроса");
                }
            } catch (error) {
                console.log(error);
            }
        },

        async GetSettings() {
            const response = await fetch('/products/settings/get');
            const data = await response.json();
            this.categories = data.categories;
            this.brands = data.brands;
            this.manufacturers = data.manufacturers;
        },

        OpenModalInfo(id) {
            this.product = this.products.find(product => product.id === id);
            document.getElementById('modalInfoTitle').innerText = this.product.title;
        },

        OpenModalImages(id) {
            this.activeProductId = id;
            var activeProduct = this.products.find(product => product.id === id);
            this.productImages = activeProduct.product_images;
            document.getElementById('modalAddImageTitle').innerText = 'Фото товара "' + activeProduct.title + '"';
        },

        OpenModalEdit(id) {
            this.activeProductId = id;
            var activeProduct = this.products.find(product => product.id === id);
            document.getElementById('modalEditTitle').innerText = 'Изменение товара "' + activeProduct.title + '"';
            document.getElementById('modalEditInputArticle').value = activeProduct.article;
            document.getElementById('modalEditInputCount').value = activeProduct.count;
            document.getElementById('modalEditInputTitle').value = activeProduct.title;
            document.getElementById('modalEditSelectCategory').value = activeProduct.category_id;
            document.getElementById('modalEditSelectBrand').value = activeProduct.brand_id;
            document.getElementById('modalEditInputDescription').value = activeProduct.description;
            document.getElementById('modalEditInputComplete').value = activeProduct.complete_set;
            document.getElementById('modalEditSelectManufacturer').value = activeProduct.manufacturer_id;
            document.getElementById('modalEditInputMaterial').value = activeProduct.material;
            document.getElementById('modalEditInputWeight').value = activeProduct.weight;
            document.getElementById('modalEditInputOld').value = activeProduct.old_price;
            document.getElementById('modalEditInputNew').value = activeProduct.new_price;
            this.SettingSelect();
        },

        OpenModalDelete(id) {
            this.activeProductId = id;
            var activeProduct = this.products.find(product => product.id === id);
            document.getElementById('modalDeleteTitle').innerText = 'Вы уверены, что хотите удалить товар "' + activeProduct.title + '"?';
        },

        SettingSelect() {
            $('select').niceSelect();

            const sortSelect = document.getElementById('sort');

            const customSelect = sortSelect.nextSibling;
            const listCustomSelect = customSelect.lastChild;
            const childCustomSelect = Array.from(listCustomSelect.childNodes);

            for (let child of childCustomSelect) {
                child.addEventListener('click', () => {
                    this.sort = child.dataset.value;
                });
            };
        },
    },

    mounted() {
        this.Get(1);
        this.GetSettings();
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

        sortingProducts() {
            if (this.sort === "cheapest") {
                return this.products.sort((a, b) => a.new_price - b.new_price);
            } else if (this.sort === "expensive") {
                return this.products.sort((a, b) => b.new_price - a.new_price);
            } else if (this.sort === "newest") {
                return this.products.sort((a, b) => new Date(a.created_at) - new Date(b.created_at));
            }
        }
    }
}
</script>

<style scoped>

</style>
