<script setup>
import {Link} from '@inertiajs/inertia-vue3';
</script>

<template>
    <div class="menu">
        <Link class="menu__item menu__item__icon-1" :href="route('home')">Дашборд</Link>
        <Link class="menu__item menu__item__icon-2" :href="route('home')">Профессии</Link>
        <Link class="menu__item menu__item__icon-3" :href="route('home')">Стажировки</Link>
        <Link class="menu__item menu__item__icon-4" :href="route('home')">Задачи</Link>
        <Link class="menu__item menu__item__icon-5" :href="route('home')">Тесты</Link>
        <Link class="menu__item menu__item__icon-6" :href="route('home')">Профиль</Link>
    </div>
</template>

<style lang="scss" scoped>
.menu {
    &__item {
        display: block;
        position: relative;
        color: #A9ACB1;
        font-size: 14px;
        line-height: 24px;
        font-weight: 600;
        text-decoration: none;
        height: 44px;
        padding: 10px 20px 10px 56px;
        margin-bottom: 28px;
        cursor: pointer;

        &:hover {
            color: #141522;
        }

        &:before {
            content: '';
            display: block;
            position: absolute;
            left: 22px;
            top: 10px;
            background-repeat: no-repeat;
            background-size: contain;
            background-position: center;
            width: 24px;
            height: 24px;
        }

        &__icon-1 {
            &:before {
                background-image: url("/img/menu/icon-1.png");
            }

            &:hover:before {
                background-image: url("/img/menu/icon-1-hover.png");
            }
        }

        &__icon-2 {
            &:before {
                background-image: url("/img/menu/icon-2.png");
            }

            &:hover:before {
                background-image: url("/img/menu/icon-2-hover.png");
            }
        }

        &__icon-3 {
            &:before {
                background-image: url("/img/menu/icon-3.png");
            }

            &:hover:before {
                background-image: url("/img/menu/icon-3-hover.png");
            }
        }

        &__icon-4 {
            &:before {
                background-image: url("/img/menu/icon-4.png");
            }

            &:hover:before {
                background-image: url("/img/menu/icon-4-hover.png");
            }
        }

        &__icon-5 {
            &:before {
                background-image: url("/img/menu/icon-5.png");
            }

            &:hover:before {
                background-image: url("/img/menu/icon-5-hover.png");
            }
        }

        &__icon-6 {
            &:before {
                background-image: url("/img/menu/icon-6.png");
            }

            &:hover:before {
                background-image: url("/img/menu/icon-6-hover.png");
            }
        }
    }
}
</style>
