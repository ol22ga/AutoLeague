<template>
    <div class="modal fade" id="modalQuestionSuccess" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col text-right">
                                <button type="button" class="close modal-close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"> <i class="fa fa-times"></i></span>
                                </button>
                            </div>
                        </div>
                        <div class="modal-add-cart">
                            <div class="row justify-content-center">
                                <div class="modal-add-cart__info text-center"><i class="fa fa-check-square"></i>Вопрос успешно отправлен. В ближайшее время администратор ответит.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ModalApplicationComponent"
}
</script>

<style scoped>

</style>
