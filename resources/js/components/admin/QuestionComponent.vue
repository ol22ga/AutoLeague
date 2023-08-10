<template>
    <div class="container">
        <table class="table" v-if="questions.length > 0">
            <thead class="table__header">
            <tr>
                <th>#</th>
                <th>Вопрос</th>
                <th>Ответ</th>
                <th class="text-right">Действие</th>
            </tr>
            </thead>
            <tbody class="table__content">
            <tr v-for="question in questions">
                <td> {{question.id}} </td>
                <td> {{question.text}} </td>
                <td> <span v-if="question.answer !== null">{{question.answer}}</span> </td>
                <td>
                    <div class="table__wrapper-button">
                        <button type="button" class="table__button  table__button--edit" data-bs-toggle="modal" data-bs-target="#modalAnswer" @click="OpenModalEdit(question.id)" title="изменить ответ">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button type="button" class="table__button  table__button--delete" data-bs-toggle="modal" data-bs-target="#modalDelete" @click="OpenModalDelete(question.id)" title="удалить вопрос">
                            <i class="fa fa-close"></i>
                        </button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

        <h4 v-else class="text-center">Вопросы не найдены</h4>

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

    <answer-component @GetQuestions="Get(pagination.current_page)" :question="activeQuestion"></answer-component>
    <delete-modal-component :questionId="activeQuestionId" @GetQuestions="Get(pagination.current_page)"></delete-modal-component>
</template>

<script>
import AnswerComponent from "./questions/AnswerComponent.vue";
import DeleteModalComponent from "./questions/DeleteModalComponent.vue";

export default {
    name: "QuestionComponent",

    components: {
        AnswerComponent,
        DeleteModalComponent
    },

    data() {
        return {
            questions: [],

            pagination: {},

            activeQuestion: {},
            activeQuestionId: 0,
        }
    },

    methods: {
        async Get(page) {
            try {
                let url = '/questions/get?page=${page}';
                url += `&paginate=${10}`;

                const response = await fetch(url);
                if (response.ok) {
                    const data = await response.json();
                    this.questions = data.questions;
                    this.pagination = {
                        current_page: data.current_page,
                        last_page: data.last_page,
                    };

                    if (this.questions.length === 0 && this.pagination.current_page > 1) {
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
            this.activeQuestion = this.questions.find(question => question.id === id);
            document.getElementById('modalAnswerTitle').innerText = 'Ответ на вопрос "' + this.activeQuestion.text + '"';
        },

        OpenModalDelete(id) {
            this.activeQuestion = this.questions.find(question => question.id === id);
            this.activeQuestionId = this.activeQuestion.id;
            document.getElementById('modalDeleteTitle').innerText = 'Вы уверены, что хотите удалить вопрос "' + this.activeQuestion.text + '" и ответ на него?';
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
