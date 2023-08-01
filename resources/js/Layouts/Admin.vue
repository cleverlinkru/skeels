<script setup>
import Logo from '@/Components/Logo.vue';
import AdminMenu from '@/Components/Admin/Menu/Index.vue';
import UserAuth from '@/Components/UserAuth.vue';
</script>

<template>
    <a-layout>
        <a-layout-sider collapsible>
            <div class="logo-container">
                <logo/>
            </div>
            <admin-menu :config="menu_config"/>
        </a-layout-sider>
        <a-layout>
            <a-layout-header class="header">
                <user-auth/>
            </a-layout-header>
            <a-layout-content class="content">
                <div class="inner">
                    <slot/>
                </div>
            </a-layout-content>
            <a-layout-footer class="footer">Skeels ©2022</a-layout-footer>
        </a-layout>
    </a-layout>
</template>

<script>
import {Inertia} from '@inertiajs/inertia';
import {message} from 'ant-design-vue';

Inertia.on('success', (event) => {
    if (Inertia.page.props.flash.message) {
        if (Inertia.page.props.flash.message.status) {
            message.success(Inertia.page.props.flash.message.text);
        } else {
            message.error(Inertia.page.props.flash.message.text);
        }
    }
});

const menu_config = [
    {
        key: 'profession',
        title: 'Professions',
        childs: [
            {
                key: 'admin.profession.index',
                title: 'List',
                link: route('admin.profession.index'),
            },
            {
                key: 'admin.profession_category.index',
                title: 'Categories',
                link: route('admin.profession_category.index'),
            },
            {
                key: 'admin.tag.index',
                title: 'Tags',
                link: route('admin.tag.index'),
            },
        ],
    },
];

export default {
    data() {
        return {
            menu_config,
        };
    },
}
</script>

<style lang="scss" scoped>
.header {
    background: #fff;
}

.content {
    padding: 10px;
}

.inner {
    background: #fff;
    min-height: 500px;
    padding: 15px;
}

.footer {
    text-align: center;
}

.logo-container {
    padding: 10px 0 20px;
}
</style>
