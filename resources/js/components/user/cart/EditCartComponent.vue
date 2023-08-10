<template>

</template>

<script>
export default {
    name: "EditCartComponent",

    data() {
        return {
            message: '',
        }
    },

    props: {
        productId: {
            type: Number,
            required: true
        },
        settingGet: {
            type: Boolean,
            required: false
        }
    },

    methods: {
        async Add() {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const response = await fetch('/cart/add', {
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id: this.productId
                })
            });
            if (response.status === 200) {
                if (this.settingGet === true) {
                    this.$emit('GetCarts');
                }
            }
            if (response.status === 400) {
                this.message = 'На складе нет такого количества товара';
                this.$emit('errorMessage', this.message);
            }
        },

        async Decrement(id) {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const response = await fetch('/cart/decrement', {
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id: this.productId
                })
            });
            if (response.status === 200) {
                this.$emit('GetCarts');
            }
        },

        async Delete(id) {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const response = await fetch('/cart/delete', {
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id: this.productId
                })
            });
            if (response.status === 200) {
                this.$emit('GetCarts');
            }
        },
    }
}
</script>

<style scoped>

</style>
