<script setup>
import AdminLayout from '@/Layouts/Admin.vue';
import ProfessionForm from "@/Components/Admin/ProfessionForm.vue";
</script>

<template>
    <AdminLayout>
        <a-page-header title="Profession create" @back="$inertia.visit(route('admin.profession.index'))"/>
        <profession-form/>
    </AdminLayout>
</template>
