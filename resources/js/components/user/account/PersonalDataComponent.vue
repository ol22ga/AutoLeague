<template>
    <div class="row">
        <div class="col-12">
            <div class="form">
                <form id="FormPersonalData" @submit.prevent="Save">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form__item mb-20">
                                <label for="firstname">Имя</label>
                                <input type="text" id="firstname" name="firstname" :class="errors.firstname ? 'is-invalid' : ''" :value="user.firstname">
                                <div :class="errors.firstname ? 'invalid-feedback' : ''" v-for="error in errors.firstname">
                                    {{error}}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form__item mb-20">
                                <label for="lastname">Фамилия</label>
                                <input type="text" id="lastname" name="lastname" :class="errors.lastname ? 'is-invalid' : ''" :value="user.lastname">
                                <div :class="errors.lastname ? 'invalid-feedback' : ''" v-for="error in errors.lastname">
                                    {{error}}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form__item mb-20">
                                <label for="patronymic">Отчество</label>
                                <input type="text" id="patronymic" name="patronymic" :class="errors.patronymic ? 'is-invalid' : ''" :value="user.patronymic">
                                <div :class="errors.patronymic ? 'invalid-feedback' : ''" v-for="error in errors.patronymic">
                                    {{error}}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form__item mb-20">
                                <label for="birthdate">Дата рождения</label>
                                <input type="date" id="birthdate" name="birthdate" :class="errors.birthdate ? 'is-invalid' : ''" :value="user.birthdate">
                                <div :class="errors.birthdate ? 'invalid-feedback' : ''" v-for="error in errors.birthdate">
                                    {{error}}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form__item mb-20">
                                <label for="email">Email</label>
                                <input type="text" id="email" name="email" :class="errors.email ? 'is-invalid' : ''" :value="user.email">
                                <div :class="errors.email ? 'invalid-feedback' : ''" v-for="error in errors.email">
                                    {{error}}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form__item mb-20">
                                <label for="phone">Телефон</label>
                                <input type="text" id="phone" name="phone" :class="errors.phone ? 'is-invalid' : ''" :value="user.phone">
                                <div :class="errors.phone ? 'invalid-feedback' : ''" v-for="error in errors.phone">
                                    {{error}}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button class="button button--dark" type="submit">Сохранить</button>
                        </div>
                    </div> <!-- .row -->
                </form> <!-- form -->
            </div> <!-- .form .section-top-gap-100 -->
        </div>
    </div>
</template>

<script>
export default {
    name: "PersonalDataComponent.vue",

    data() {
        return {
            user: {},
            errors: []
        }
    },

    methods: {
        async Get() {
            try {
                const response = await fetch('/user/get');
                if (response.ok) {
                    const data = await response.json();
                    this.user = data.user;
                } else {
                    console.log("Ошибка при выполнении запроса");
                }
            } catch (error) {
                console.log(error);
            }
        },

        async Save() {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const form = document.getElementById('FormPersonalData');
            const formData = new FormData(form);
            const response = await fetch('/user/edit', {
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                body: formData
            })
            if (response.status === 200) {
                this.errors = [];
                this.Get();
            }
            if (response.status === 400) {
                this.errors = await response.json();
            }
        }
    },

    mounted() {
        this.Get();
    }
}
</script>

<style scoped>

</style>
