<script setup>
import AdminLayout from '@/Layouts/Admin.vue';
import {DeleteFilled, EditFilled} from "@ant-design/icons-vue";
import {Link} from '@inertiajs/inertia-vue3';

defineProps(['items', 'categories']);
</script>

<template>
    <AdminLayout>
        <a-page-header title="Professions"/>
        <a-button type="primary" @click="handleCreate">Create profession</a-button>
        <a-spin :spinning="loading">
            <template v-if="items.data.length">
                <a-row>
                    <a-col :span="8" v-for="item in items.data">
                        <div class="gutter-box">
                            <a-card :title="item.name">
                                <a-descriptions layout="vertical">
                                    <a-descriptions-item label="Description">
                                        <div class="text">{{ item.description }}</div>
                                    </a-descriptions-item>
                                </a-descriptions>
                                <a-descriptions layout="vertical">
                                    <a-descriptions-item label="Salary">
                                        {{ item.salary }}
                                    </a-descriptions-item>
                                </a-descriptions>
                                <a-descriptions layout="vertical" v-if="item.categories.length">
                                    <a-descriptions-item label="Categories">
                                        <a-tag v-for="category in item.categories">{{ category.name }}</a-tag>
                                    </a-descriptions-item>
                                </a-descriptions>
                                <a-descriptions layout="vertical" v-if="item.tags.length">
                                    <a-descriptions-item label="Tags">
                                        <a-tag v-for="tag in item.tags">{{ tag.name }}</a-tag>
                                    </a-descriptions-item>
                                </a-descriptions>
                                <a-descriptions layout="vertical">
                                    <a-descriptions-item>
                                        <Link :href="route('admin.work_day.index')" :data="{ profession_id: item.id }">
                                            Work days
                                        </Link>
                                    </a-descriptions-item>
                                </a-descriptions>
                                <template #actions>
                                    <edit-filled key="edit" @click="handleEdit(item)"/>
                                    <a-popconfirm
                                        title="Are you sure?"
                                        ok-text="Yes"
                                        cancel-text="No"
                                        key="delete"
                                        @confirm="handleDelete(item)"
                                    >
                                        <delete-filled/>
                                    </a-popconfirm>
                                </template>
                            </a-card>
                        </div>
                    </a-col>
                </a-row>
                <a-pagination
                    v-model:current="items.current_page"
                    v-model:pageSize="items.per_page"
                    :total="items.total"
                    @change="$inertia.visit(route('admin.profession.index'), { data: { page: items.current_page }})"
                />
            </template>
            <p v-else>Empty</p>
        </a-spin>
    </AdminLayout>
</template>

<script>
export default {
    data() {
        return {
            loading: false,
        };
    },
    created() {
        this.$inertia.on('start', () => this.loading = true);
        this.$inertia.on('finish', () => this.loading = false);
    },
    methods: {
        handleCreate() {
            this.$inertia.visit(route('admin.profession.create'));
        },

        handleEdit(item) {
            this.$inertia.visit(route('admin.profession.edit', item.id));
        },

        handleDelete(item) {
            this.$inertia.delete(route('admin.profession.destroy', item.id));
        },
    },
}
</script>

<style lang="scss" scoped>
.gutter-box {
    padding: 5px;
}

.text {
    white-space: break-spaces;
}
</style>
