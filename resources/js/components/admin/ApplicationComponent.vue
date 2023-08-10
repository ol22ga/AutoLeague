<template>
    <div class="container">
        <table class="table" v-if="applications.length > 0">
            <thead class="table__header">
            <tr>
                <th>#</th>
                <th>Отправитель</th>
                <th>Заявка</th>
                <th class="text-right">Действие</th>
            </tr>
            </thead>
            <tbody class="table__content">
            <tr v-for="application in applications">
                <td> {{application.id}} </td>
                <td> {{application.name}} ({{application.phone}}) </td>
                <td> {{application.text}} </td>
                <td>
                    <div class="table__wrapper-button">
                        <button type="button" class="table__button  table__button--edit" @click="Complete(application.id)" title="завершить">
                            <i class="fa fa-check"></i>
                        </button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

        <h4 v-else class="text-center">Заявки не найдены</h4>

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
</template>

<script>
export default {
    name: "ApplicationComponent",

    data() {
        return {
            applications: [],

            pagination: {},
        }
    },

    methods: {
        async Get(page) {
            try {
                const response = await fetch(`/applications/get?page=${page}`);
                if (response.ok) {
                    const data = await response.json();
                    this.applications = data.applications;
                    this.pagination = {
                        current_page: data.current_page,
                        last_page: data.last_page,
                    };

                    if (this.applications.length === 0 && this.pagination.current_page > 1) {
                        this.Get(this.pagination.current_page - 1);
                    }
                } else {
                    console.log("Ошибка при выполнении запроса");
                }
            } catch (error) {
                console.log(error);
            }
        },

        async Complete(id) {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const response = await fetch('/applications/complete', {
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id: id
                })
            })
            if (response.status === 200) {
                this.Get(1);
            }
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
