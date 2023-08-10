import {createApp} from "vue/dist/vue.esm-bundler";

import GetComponent from "./components/GetComponent.vue";
//общее
import CatalogComponent from "./components/CatalogComponent.vue";
import ProductModalComponent from "./components/ProductModalComponent.vue";
import FormApplicationComponent from "./components/application/FormApplicationComponent.vue";
import FormQuestionComponent from "./components/user/question/FormQuestionComponent.vue";
// import SearchComponent from "./components/SearchComponent.vue";
// import HeaderComponent from "./components/HeaderComponent.vue";
//гость
import LoginComponent from "./components/guest/LoginComponent.vue";
import LoginPasswordComponent from "./components/guest/LoginPasswordComponent.vue";
import RegistrationComponent from "./components/guest/RegistrationComponent.vue";
//пользователь
import CartComponent from "./components/user/cart/CartComponent.vue";
import OffcavasCartComponent from "./components/user/cart/OffcavasCartComponent.vue";
import PlaceAnOrderComponent from "./components/user/PlaceAnOrderComponent.vue";
import OrdersComponent from "./components/user/account/OrdersComponent.vue";
import PersonalDataComponent from "./components/user/account/PersonalDataComponent.vue";
//администратор
import CategoryComponent from "./components/admin/CategoryComponent.vue";
import BrandComponent from "./components/admin/BrandComponent.vue";
import ManufacturerComponent from "./components/admin/ManufacturerComponent.vue";
import ProductComponent from "./components/admin/ProductComponent.vue";
import OrderComponent from "./components/admin/OrderComponent.vue";
import ApplicationComponent from "./components/admin/ApplicationComponent.vue";
import QuestionComponent from "./components/admin/QuestionComponent.vue";

const app = createApp({
    components: {
        GetComponent,

        CatalogComponent,
        ProductModalComponent,
        FormApplicationComponent,
        FormQuestionComponent,
        // SearchComponent,
        // HeaderComponent,

        LoginComponent,
        LoginPasswordComponent,
        RegistrationComponent,

        CartComponent,
        OffcavasCartComponent,
        PlaceAnOrderComponent,
        OrdersComponent,
        PersonalDataComponent,

        CategoryComponent,
        BrandComponent,
        ManufacturerComponent,
        ProductComponent,
        OrderComponent,
        ApplicationComponent,
        QuestionComponent
    }
});

app.mount('#app');
