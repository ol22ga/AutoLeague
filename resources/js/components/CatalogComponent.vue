<template>
    <div class="row flex-column-reverse flex-lg-row-reverse">
        <div class="col-lg-3">
            <sidebar-component :minPrice="minPrice" :maxPrice="maxPrice" @filterUpdate="filterValueUpdate"></sidebar-component>
        </div> <!-- .col-lg-3 -->

        <div class="col-lg-9">
            <div class="shop-sort-section">
                <div class="container">
                    <div class="row">
                        <div class="d-flex justify-content-center justify-content-lg-start align-items-center flex-row">
                            <div class="col-md-1 mr-10 d-sm-flex d-none">
                                <ul class="nav tab__list-btn tab__list-btn--view">
                                    <li>
                                        <a href="#products-grid" id="products-grid-btn" class="nav-link active">
                                            <img src="/public/images/icon/bkg_grid.png" alt="">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#products-list" id="products-list-btn" class="nav-link">
                                            <img src="/public/images/icon/bkg_list.png" alt="">
                                        </a>
                                    </li>
                                </ul>
                            </div> <!-- .sort-tablist .sort-tablist-display mr-10 -->
                            <form class="col-md-8 col-lg-4 col-xl-3" id="FormSorting" @mouseenter="SettingSelect">
                                <div class="form__item">
                                    <select class="nice-select wide form__select" name="sort" id="sort">
                                        <option value="newest"> Сначала новые </option>
                                        <option value="cheapest"> Сначала дешевые </option>
                                        <option value="expensive"> Сначала дорогие </option>
                                    </select>
                                </div>
                            </form>
                        </div> <!-- .sort-box .d-flex .justify-content-start .align-items-md-center .align-items-start .flex-md-row .flex-column -->
                    </div> <!-- .row -->
                </div> <!-- .container -->
            </div> <!-- .shop-sort-section -->

            <div class="sort-product-tab-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="tab-content tab-animate--zoom">
                                <div class="sort-layout-single tab__content active show" id="products-grid">
                                    <div class="row">
                                        <div class="col-xl-4 col-sm-6 col-12" v-for="product in sortingProducts">
                                            <div class="product border-around">
                                                <div class="product__wrapper">
                                                    <a :href="`/product?id=${product.id}`" class="product__img-link">
                                                        <img :src="product.product_images[0].img" alt="" class="product__img img-fluid">
                                                    </a>
                                                    <div class="product__list-icon">
                                                        <ul>
                                                            <li><a href="#"><i class="fa fa-heart-o"></i></a></li>
                                                            <li><a href="#"><i class="fa fa-repeat"></i></a></li>
                                                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#modalQuickview" @click="OpenModalProduct(product.id)"><i class="fa fa-eye"></i></a></li>
                                                            <li><a href="#" @click="OpenOffcanvasCart(product.id)"><i class="fa fa-shopping-cart"></i></a></li>
                                                        </ul>
                                                    </div> <!-- .product-action-icon-link -->
                                                </div> <!-- .product-img-warp -->
                                                <div class="product__content">
                                                    <h6 class="product__link"><a href="#">{{ product.title }} ({{product.id}})</a></h6>
                                                    <span class="product__price"><del class="product__price--off">{{ product.old_price }} ₽</del> {{ product.new_price }} ₽</span>
                                                </div> <!-- .product__content -->
                                            </div> <!-- .product .border-around -->
                                        </div> <!-- .col-xl-4 .col-sm-6 .col-12 -->
                                    </div> <!-- .row -->
                                </div> <!-- .tab-pane .active show .sort-layout-single -->
                                <div class="sort-layout-single tab__content" id="products-list">
                                    <div class="row">
                                        <div class="col-12" v-for="product in sortingProducts">
                                            <div class="product--list border-around">
                                                <a href="#" class="product--list__img-link">
                                                    <img :src="product.product_images[0].img" alt="" class="img-fluid">
                                                </a>
                                                <div class="product--list__content">
                                                    <h5 class="product--list__link"><a href="#">{{ product.title }}</a></h5>
                                                    <span class="product--list__price"><del class="product--list__price--off">{{ product.old_price }} ₽</del> {{ product.new_price }} ₽</span>
                                                    <p> {{ product.description }} </p>
                                                    <div class="product--list__list-icon">
                                                        <ul>
                                                            <li><a href="#"><i class="fa fa-heart-o"></i></a></li>
                                                            <li><a href="#"><i class="fa fa-repeat"></i></a></li>
                                                            <li><a href="#" data-toggle="modal" data-target="#modalQuickview"><i class="fa fa-eye"></i></a></li>
                                                            <li><a href="#" data-toggle="modal" data-target="#modalAddcart"><i class="fa fa-shopping-cart"></i></a></li>
                                                        </ul>
                                                    </div> <!-- .product--list__list-icon -->
                                                </div> <!-- .product--list__content -->
                                            </div> <!-- .product--list -->
                                        </div> <!-- .col-12 -->
                                    </div> <!-- .row -->
                                </div> <!-- .tab-pane .sort-layout-single -->
                            </div> <!-- .tab-content tab-animate-zoom -->
                        </div> <!-- .col-12 -->
                    </div> <!-- .row -->
                </div> <!-- .container -->
            </div> <!-- .sort-product-tab-wrapper -->

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
        </div> <!-- .col-lg-9 -->
    </div> <!-- .row .flex-column-reverse .flex-lg-row-reverse -->

    <product-modal-component :product="activeProduct"></product-modal-component>
    <offcavas-cart-component ref="addCartRef"></offcavas-cart-component>
</template>

<script>
import {ref} from "vue";
import SidebarComponent from "./catalog/SidebarComponent.vue";
import ProductModalComponent from "./ProductModalComponent.vue";
import OffcavasCartComponent from "./user/cart/OffcavasCartComponent.vue";

export default {
    name: "CatalogComponent",

    components: {
        SidebarComponent,
        ProductModalComponent,
        OffcavasCartComponent,
    },

    data() {
        return {
            products: [],
            minPrice: 0,
            maxPrice:0,

            filter: [],
            sort: 'newest',

            countPage: 2,
            pagination: {},

            addCartRef: null,

            activeProduct: {},
        }
    },

    methods: {
        async Get(page) {
            try {
                let url = `/products/get?page=${page}`;
                url += `&paginate=${this.countPage}`;

                const response = await fetch(url);
                if (response.ok) {
                    const data = await response.json();
                    this.products = data.products;
                    this.pagination = {
                        current_page: data.current_page,
                        last_page: data.last_page,
                    };

                    this.minPrice = data.min_price;
                    this.maxPrice = data.max_price;

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

        OpenOffcanvasCart(id) {
            document.getElementById('OffcanvasCartOpen').click();
            this.$nextTick(() => {
                this.addCartRef.RunAddToCart(id);
            });
        },

        async OpenModalProduct(id) {
            this.activeProduct = this.products.find(product => product.id == id);
            console.log(this.activeProduct);
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
            console.log(this.sort);
        },

        filterValueUpdate(array) {
            this.filter = array;
            console.log(this.filter);
        }
    },

    mounted() {
        this.Get(1);
        this.addCartRef = ref(this.$refs.addCartRef);
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
            return this.products
                .filter(product => {
                    return this.filter.category_id == 0 || product.category_id == this.filter.category_id;
                })
                .filter(product => {
                    return this.filter.brand_id == 0 || product.brand_id == this.filter.brand_id;
                })
                .filter(product => {
                    return this.filter.manufacturer_id == 0 || product.manufacturer_id == this.filter.manufacturer_id;
                })
                .filter(product => {
                    return Number(product.new_price) >= this.filter.min && Number(product.new_price) <= this.filter.max;
                })
            // if (this.sort === "cheapest") {
            //     return this.products.sort((a, b) => a.new_price - b.new_price);
            // } else if (this.sort === "expensive") {
            //     return this.products.sort((a, b) => b.new_price - a.new_price);
            // } else if (this.sort === "newest") {
            //     return this.products.sort((a, b) => new Date(a.created_at) - new Date(b.created_at));
            // }
        },
    }
}
</script>

<style scoped>
.filter-price__progress {
    width: 100%;
    left: 0;
    right: 0;
}
</style>
