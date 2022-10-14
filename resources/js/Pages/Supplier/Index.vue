<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Table } from "@protonemedia/inertiajs-tables-laravel-query-builder";
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { onMounted, watch, useSlots } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';


defineProps({
    suppliers:{
        type: Object
    },
});

const emit = defineEmits(['close']);

const close = () => {
    emit('close');
};

onMounted(() => {
    document.getElementsByTagName('fieldset')[0]?.getElementsByClassName('order-2 sm:order-1 mr-2 sm:mr-4')[0]?.remove('mr-2 sm:mr-4');
});


</script>

<template>
    <AppLayout title="Fornecedores">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Fornecedores
            </h2>
        </template>

    

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-5">
            <Link :href="route('suppliers.create')">
                <PrimaryButton type="button" class="mb-5" :href="route('suppliers.create')">Adicionar Fornecedor</PrimaryButton>
            </Link>

            <Table :resource="suppliers" />
        </div>
    </AppLayout>
</template>