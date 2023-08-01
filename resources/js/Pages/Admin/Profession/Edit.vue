<script setup>
import AdminLayout from '@/Layouts/Admin.vue';
import ProfessionForm from "@/Components/Admin/ProfessionForm.vue";

defineProps(['item']);
</script>

<template>
    <AdminLayout>
        <a-page-header title="Profession edit" @back="$inertia.visit(route('admin.profession.index'))"/>
        <profession-form :item="item"/>
    </AdminLayout>
</template>
