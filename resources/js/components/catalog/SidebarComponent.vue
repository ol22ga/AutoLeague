<template>
    <form id="FormFilter" class="siderbar" @mouseover.capture="SettingSelect('manufacturer')">
        <div class="sidebar__widget">
            <h6 class="sidebar__title">Укажите диапазон цены</h6>
            <div class="sidebar__content">
                <div class="filter-price">
                    <div class="filter-price__wrapper mb-4">
                        <input type="number" class="filter-price__input input-min" id="input-min" name="price-min" v-model="filterMinPrice" @change="updateSlider('min')" :max="maxPrice" :min="minPrice">
                        <label class="filter-price__separator">-</label>
                        <input type="number" class="filter-price__input input-max" id="input-max" name="price-max" v-model="filterMaxPrice" @change="updateSlider('max')" :max="maxPrice" :min="minPrice">
                    </div>
                    <div class="filter-price__slider">
                        <div class="filter-price__progress"></div>
                    </div>
                    <div class="filter-price__inner">
                        <input type="range" class="filter-price__range range-min" id="range-min" @input="updateInput('min')" @mouseup="NewValuesPrice" :max="maxPrice" :min="minPrice" step="1">
                    </div>
                    <div class="filter-price__inner">
                        <input type="range" class="filter-price__range range-max" id="range-max" @input="updateInput('max')" @mouseup="NewValuesPrice" :max="maxPrice" :min="minPrice" step="1">
                    </div>
                </div>
            </div>
        </div> <!-- .sidebar__widget -->
        <div class="sidebar__widget">
            <h6 class="sidebar__title">Выберите категорию</h6>
            <div class="sidebar__content">
                <div class="form__item pb-4" @mousedown.capture="NewValuesSelect('category')">
                    <select class="nice-select wide form__select" name="category_id" id="category_id">
                        <option value="0"> Все категории </option>
                        <option v-for="category in categories" :value="category.id"> {{category.title}} </option>
                    </select>
                </div>
            </div> <!-- .sidebar-content -->
        </div>
        <div class="sidebar__widget">
            <h6 class="sidebar__title">Выберите марку</h6>
            <div class="sidebar__content">
                <div class="form__item pb-4" @mousedown.capture="NewValuesSelect('brand')">
                    <select class="nice-select wide form__select" name="brand_id" id="brand_id">
                        <option value="0"> Все марки </option>
                        <option v-for="brand in brands" :value="brand.id"> {{brand.title}} </option>
                    </select>
                </div>
            </div> <!-- .sidebar-content -->
        </div>
        <div class="sidebar__widget">
            <h6 class="sidebar__title">Выберите производителя</h6>
            <div class="sidebar__content">
                <div class="form__item pb-4" @mousedown.capture="NewValuesSelect('manufacturer')">
                    <select class="nice-select wide form__select" name="manufacturer_id" id="manufacturer_id">
                        <option value="0"> Все производители </option>
                        <option v-for="manufacturer in manufacturers" :value="manufacturer.id"> {{manufacturer.title}} </option>
                    </select>
                </div>
            </div> <!-- .sidebar-content -->
        </div>
    </form> <!-- .siderbar -->
</template>

<script>
export default {
    name: "SidebarComponent",

    props: {
        minPrice: {
            type: Number,
            required: true
        },
        maxPrice: {
            type: Number,
            required: true
        },
    },

    data() {
        return {
            filterMinPrice: 0,
            filterMaxPrice: 0,
            distance: 0,

            categories: [],
            brands: [],
            manufacturers: [],

            category_id: 0,
            brand_id: 0,
            manufacturer_id: 0,

            array: {
                category_id: 0,
                brand_id: 0,
                manufacturer_id: 0,
                min: 0,
                max: 0
            },
        }
    },

    methods: {
        async GetSettings() {
            const response = await fetch('/products/settings/get');
            const data = await response.json();
            this.categories = data.categories;
            this.brands = data.brands;
            this.manufacturers = data.manufacturers;
        },

        updateSlider(change) {
            const rangeMin = document.getElementById('range-min');
            const rangeMax = document.getElementById('range-max');

            const progress = document.querySelector('.filter-price__progress');

            if (this.filterMinPrice < this.minPrice) {
                this.filterMinPrice = this.minPrice;
            }
            if (this.filterMaxPrice > this.maxPrice) {
                this.filterMaxPrice = this.maxPrice;
            }

            if (change === 'min') {
                if (this.filterMinPrice >= this.filterMaxPrice) {
                    this.filterMinPrice = this.filterMaxPrice - this.distance;
                }
            }
            if (change === 'max') {
                if (this.filterMaxPrice <= this.filterMinPrice) {
                    this.filterMaxPrice = this.maxPrice;
                }
            }

            const difference = this.filterMaxPrice - this.filterMinPrice;

            if (difference < this.distance) {
                if (change === 'min') {
                    this.filterMinPrice = this.filterMaxPrice - this.distance;
                    rangeMin.value = this.filterMinPrice;
                }
                if (change === 'max') {
                    this.filterMaxPrice = this.filterMinPrice + this.distance;
                    rangeMax.value = this.filterMaxPrice;
                }
            } else {
                if (change === 'min') {
                    rangeMin.value = this.filterMinPrice;
                }
                if (change === 'max') {
                    rangeMax.value = this.filterMaxPrice;
                }
            }

            progress.style.left = (((rangeMin.value - this.minPrice) / (this.maxPrice - this.minPrice)) * 100) + '%';
            progress.style.right = (((this.maxPrice - rangeMax.value) / (this.maxPrice - this.minPrice)) * 100) + '%';
            progress.style.width = (((rangeMax.value - rangeMin.value) / (this.maxPrice - this.minPrice)) * 100) + '%';
        },

        updateInput(change) {
            const rangeMin = document.getElementById('range-min');
            const rangeMax = document.getElementById('range-max');
            const difference = rangeMax.value - rangeMin.value;

            const progress = document.querySelector('.filter-price__progress');

            if (difference <= this.distance) {
                if (change === 'min') {
                    if (this.filterMaxPrice < this.maxPrice) {
                        this.filterMaxPrice = Number(rangeMin.value) + this.distance;
                        rangeMax.value = this.filterMaxPrice;
                    } else {
                        this.filterMaxPrice = this.maxPrice;
                        rangeMax.value = this.filterMaxPrice;
                        this.filterMinPrice = Number(rangeMax.value) - this.distance;
                        rangeMin.value = this.filterMinPrice;
                    }
                }
                if (change === 'max') {
                    if (this.filterMinPrice > this.minPrice) {
                        this.filterMinPrice = Number(rangeMax.value) - this.distance;
                        rangeMin.value = this.filterMinPrice;
                    } else {
                        this.filterMinPrice = this.minPrice;
                        rangeMin.value = this.filterMinPrice;
                        this.filterMaxPrice = Number(rangeMin.value) + this.distance;
                        rangeMax.value = this.filterMaxPrice;
                    }
                }
            } else {
                if (change === 'min') {
                    this.filterMinPrice = Number(rangeMin.value);
                }
                if (change === 'max') {
                    this.filterMaxPrice = Number(rangeMax.value);
                }
            }

            progress.style.left = (((rangeMin.value - this.minPrice) / (this.maxPrice - this.minPrice)) * 100) + '%';
            progress.style.right = (((this.maxPrice - rangeMax.value) / (this.maxPrice - this.minPrice)) * 100) + '%';
            progress.style.width = (((rangeMax.value - rangeMin.value) / (this.maxPrice - this.minPrice)) * 100) + '%';
        },

        SettingSelect() {
            $('select').niceSelect();
        },

        NewValuesSelect(elem) {
            if (elem == 'category') {
                var select = document.getElementById('category_id');
            }
            if (elem == 'brand') {
                var select = document.getElementById('brand_id');
            }
            if (elem == 'manufacturer') {
                var select = document.getElementById('manufacturer_id');
            }

            const customSelect = select.nextSibling;
            const listCustomSelect = customSelect.lastChild;
            const childCustomSelect = Array.from(listCustomSelect.childNodes);
            for (let child of childCustomSelect) {
                child.addEventListener('click', () => {
                    if (elem == 'category') {
                        this.category_id = child.dataset.value;
                    }
                    if (elem == 'brand') {
                        this.brand_id = child.dataset.value;
                    }
                    if (elem == 'manufacturer') {
                        this.manufacturer_id = child.dataset.value;
                    }
                });
            };
        },

        NewValuesPrice() {
            this.array.min = this.filterMinPrice;
            this.array.max = this.filterMaxPrice;
            this.$emit('filterUpdate', this.array);
        }
    },

    watch: {
        maxPrice() {
            this.filterMinPrice = this.minPrice;
            this.filterMaxPrice = this.maxPrice;

            this.array.min = this.minPrice;
            this.array.max = this.maxPrice;

            this.$nextTick(() => {
                document.getElementById('range-min').value = this.minPrice;
                document.getElementById('range-max').value = this.maxPrice;

                let countZeros = (String(this.maxPrice).length - String(this.minPrice).length) + 1;
                this.distance = Number(5 + "0".repeat(countZeros));

                const progress = document.querySelector('.filter-price__progress');
                progress.style.left = 0 + '%';
                progress.style.right = 0 + '% !important';
                progress.style.width = 100 + '%';
            });
        },

        category_id() {
            this.array.category_id = this.category_id;
            this.$emit('filterUpdate', this.array);
        },

        brand_id() {
            this.array.brand_id = this.brand_id;
            this.$emit('filterUpdate', this.array);
        },

        manufacturer_id() {
            this.array.manufacturer_id = this.manufacturer_id;
            this.$emit('filterUpdate', this.array);
        },
    },

    mounted() {
        this.GetSettings();
        this.$emit('filterUpdate', this.array);
    }
}
</script>

<style scoped>

</style>
