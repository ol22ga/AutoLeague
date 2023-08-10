<template>
    <form action="#" method="post" class="form--search">
        <div class="form--search__item d-flex">
            <input class="form--search__input border-around border-right-none" type="search" placeholder="Введите текст запроса" required>
            <button class="form--search__btn" type="submit"><i class="fa fa-search"></i></button>
        </div>
    </form>
</template>

<script>
export default {
    name: "SearchComponent",

    components: {

    }
}
</script>

<style scoped>

</style>
