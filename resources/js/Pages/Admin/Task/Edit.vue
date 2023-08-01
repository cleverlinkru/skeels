<script setup>
import AdminLayout from '@/Layouts/Admin.vue';
import TaskForm from "@/Components/Admin/TaskForm.vue";

defineProps(['item']);
</script>

<template>
    <AdminLayout>
        <a-page-header
            title="Task edit"
            :sub-title="'Work day: ' + item.work_day.name"
            @back="$inertia.visit(route('admin.task.index'), { data: { work_day_id: item.work_day.id }})"
        />
        <task-form :item="item"/>
    </AdminLayout>
</template>
