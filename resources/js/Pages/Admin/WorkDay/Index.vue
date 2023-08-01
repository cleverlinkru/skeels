<script setup>
import AdminLayout from '@/Layouts/Admin.vue';
import {DeleteFilled, EditFilled} from "@ant-design/icons-vue";
import {Link} from '@inertiajs/inertia-vue3';

defineProps(['items', 'profession']);
</script>

<template>
    <AdminLayout>
        <a-page-header
            title="Work days"
            :sub-title="'Profession: ' + profession.name"
            @back="$inertia.visit(route('admin.profession.index'))"
        />
        <a-button type="primary" @click="handleCreate">Create work day</a-button>
        <a-spin :spinning="loading">
            <template v-if="items.data.length">
                <a-row>
                    <a-col :span="8" v-for="item in items.data">
                        <div class="gutter-box">
                            <a-card :title="item.name">
                                <a-descriptions layout="vertical">
                                    <a-descriptions-item>
                                        <Link :href="route('admin.task.index')" :data="{ work_day_id: item.id }">Tasks</Link>
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
                    @change="$inertia.visit(route('admin.work_day.index'), { data: { page: items.current_page }})"
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
            this.$inertia.visit(route('admin.work_day.create'), {data: {profession_id: this.profession.id}});
        },

        handleEdit(item) {
            this.$inertia.visit(route('admin.work_day.edit', item.id));
        },

        handleDelete(item) {
            this.$inertia.delete(route('admin.work_day.destroy', item.id));
        },
    },
}
</script>

<style lang="scss" scoped>
.gutter-box {
    padding: 5px;
}
</style>
