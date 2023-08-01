<script setup>
import AdminLayout from '@/Layouts/Admin.vue';
import WorkDayForm from "@/Components/Admin/WorkDayForm.vue";

defineProps(['item']);
</script>

<template>
    <AdminLayout>
        <a-page-header
            title="Work day edit"
            :sub-title="'Profession: ' + item.profession.name"
            @back="$inertia.visit(route('admin.work_day.index'), { data: { profession_id: item.profession.id }})"
        />
        <work-day-form :item="item"/>
    </AdminLayout>
</template>
