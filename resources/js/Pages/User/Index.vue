<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Table } from "@protonemedia/inertiajs-tables-laravel-query-builder";
import { onMounted, watch, useSlots } from 'vue';

defineProps(["users"])

onMounted(() =>{
    document.getElementsByTagName('fieldset')[0]?.getElementsByClassName('order-2 sm:order-1 mr-2 sm:mr-4')[0]?.remove('mr-2 sm:mr-4');
})


</script>

<template>
    <AppLayout title="Users">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Users
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <Table :resource="users" />
            </div>
        </div>
    </AppLayout>
</template>