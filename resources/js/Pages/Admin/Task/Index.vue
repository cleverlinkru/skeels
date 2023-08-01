<script setup>
import AdminLayout from '@/Layouts/Admin.vue';
import {DeleteFilled, EditFilled} from "@ant-design/icons-vue";

defineProps(['items', 'work_day']);
</script>

<template>
    <AdminLayout>
        <a-page-header
            title="Tasks"
            :sub-title="'Work day: ' + work_day.name"
            @back="$inertia.visit(route('admin.work_day.index'), { data: { profession_id: work_day.profession.id }})"
        />
        <a-button type="primary" @click="handleCreate">Create task</a-button>
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
                                <a-descriptions layout="vertical" v-if="item.time">
                                    <a-descriptions-item label="Time">
                                        {{ item.time }}
                                    </a-descriptions-item>
                                </a-descriptions>
                                <a-descriptions layout="vertical" v-if="item.image">
                                    <a-descriptions-item label="Image">
                                        <img :src="item.image.url"/>
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
            </template>
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
            this.$inertia.visit(route('admin.task.create'), {data: {work_day_id: this.work_day.id}});
        },

        handleEdit(item) {
            this.$inertia.visit(route('admin.task.edit', item.id));
        },

        handleDelete(item) {
            this.$inertia.delete(route('admin.task.destroy', item.id));
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
