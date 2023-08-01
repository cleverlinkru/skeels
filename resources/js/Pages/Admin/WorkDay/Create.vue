<script setup>
import AdminLayout from '@/Layouts/Admin.vue';
import WorkDayForm from "@/Components/Admin/WorkDayForm.vue";

defineProps(['profession']);
</script>

<template>
    <AdminLayout>
        <a-page-header
            title="Work day create"
            :sub-title="'Profession: ' + profession.name"
            @back="$inertia.visit(route('admin.work_day.index'), { data: { profession_id: profession.id }})"
        />
        <work-day-form :profession="profession"/>
    </AdminLayout>
</template>
