<template>
    <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modalDeleteTitle"></h3>
                    <button type="button" class="close modal-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"> <i class="fa fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row flex-lg-row flex-column-reverse">
                        <div class="col-lg-6 mb-2">
                            <button class="button button--dark" type="button" id="modalDeleteClose" data-bs-dismiss="modal" aria-label="Close">Отмена</button>
                        </div>
                        <div class="col-lg-6 mb-2">
                            <button class="button" type="submit" @click="Delete">Удалить</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "DeleteModal",

    props: {
        manufacturerId: {
            type: Number,
            required: true
        }
    },

    data() {
        return {
            errors: [],
        }
    },

    methods: {
        async Delete() {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const response = await fetch('/manufacturer/delete', {
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({id:this.manufacturerId})
            });
            if (response.status === 200) {
                document.getElementById('modalDeleteClose').click();
                this.$emit('GetManufacturers');
            };
        },
    }
}
</script>

<style scoped>

</style>
