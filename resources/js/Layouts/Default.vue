<script setup>
import Logo from '@/Components/Logo.vue';
import MainMenu from '@/Components/MainMenu.vue'
</script>

<template>
    <div class="page">
        <div class="page__sidebar-left">

            <div class="page__logo-container">
                <logo/>
            </div>

            <main-menu/>

        </div>
        <div class="page__content">
            <slot/>
        </div>
        <div class="page__sidebar-right"></div>
    </div>
</template>

<style lang="scss" scoped>
.page {
    display: flex;
    background: #eee;

    &__sidebar-left {
        flex-grow: 252;
        padding: 2.2%;
        background: #fff;
    }

    &__content {
        flex-grow: 832;
        padding: 2.2% 1.7% 2.2% 2.2%;
    }

    &__sidebar-right {
        flex-grow: 356;
        padding: 2.2% 2.2% 2.2% 0;
    }

    &__logo-container {
        margin-bottom: 30%;
    }
}
</style>
