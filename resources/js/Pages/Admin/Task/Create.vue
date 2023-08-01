<script setup>
import AdminLayout from '@/Layouts/Admin.vue';
import TaskForm from "@/Components/Admin/TaskForm.vue";

defineProps(['work_day']);
</script>

<template>
    <AdminLayout>
        <a-page-header
            title="Task create"
            :sub-title="'Work day: ' + work_day.name"
            @back="$inertia.visit(route('admin.task.index'), { data: { work_day_id: work_day.id }})"
        />
        <task-form :work_day="work_day"/>
    </AdminLayout>
</template>
