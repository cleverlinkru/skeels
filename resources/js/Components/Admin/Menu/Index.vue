<script setup>
import MenuItem from '@/Components/Admin/Menu/Item.vue'
</script>

<template>
    <a-menu
        theme="dark"
        mode="inline"
        v-model:openKeys="openKeys"
        v-model:selectedKeys="selectedKeys"
    >
        <menu-item v-for="item in config" :data="item"/>
    </a-menu>
</template>

<script>
export default {
    props: [
        'config',
    ],
    data() {
        return {
            openKeys: [],
            selectedKeys: [],
        };
    },
    created() {
        var key = route().current();
        this.selectedKeys = [key];
        this.openKeys = this.searchOpenKeys(this.config, key);
    },
    methods: {
        searchOpenKeys(items, key, parents = []) {
            for (var item of items) {
                if (item.key == key) {
                    return parents;
                } else if (item.childs) {
                    parents.push(item.key);
                    var keys = this.searchOpenKeys(item.childs, key, parents);
                    return keys;
                }
            }
            return [];
        },
    },
}
</script>
