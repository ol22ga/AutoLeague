<template>

</template>

<script>
export default {
    name: "GetComponent",

    props: {
        url: {
            type: String,
            required: true
        },
        target: {
            type: String,
            required: true
        },
        data: {
            type: String,
            required: true
        }
    },

    async mounted() {
        const response = await fetch(this.url);
        const data = await response.json();
        this.$emit("data-fetched", { target: this.target, data: data[this.data] });
    }
}
</script>

<style scoped>

</style>
