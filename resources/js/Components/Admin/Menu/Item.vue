<script setup>
import AdminMenuItem from '@/Components/Admin/Menu/Item.vue'
import {Link} from '@inertiajs/inertia-vue3';
</script>

<template>
    <a-sub-menu v-if="data.childs" :key="data.key">
        <template #title>
            <Link v-if="data.link" :href="data.link">
                <span>{{ data.title }}</span>
            </Link>
            <span v-else>{{ data.title }}</span>
        </template>
        <admin-menu-item v-for="item in data.childs" :data="item"/>
    </a-sub-menu>
    <a-menu-item v-else :key="data.key">
        <Link v-if="data.link" :href="data.link">
            <span>{{ data.title }}</span>
        </Link>
        <span v-else>{{ data.title }}</span>
    </a-menu-item>
</template>

<script>
export default {
    props: [
        'data',
    ],
}
</script>
