<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm, Link } from '@inertiajs/inertia-vue3';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Address from '@/Components/Address.vue'
import DocumentInput from '@/Components/DocumentInput.vue'
import SecondaryButton from '../../../../vendor/laravel/jetstream/stubs/inertia/resources/js/Components/SecondaryButton.vue';
import { Inertia } from '@inertiajs/inertia';

const form = useForm({
    name: '',
    doc: '',
    email: '',
    birth_date: '',
    opening_date: '',
    phone_number: '',
    mobile_number: '',
    estimated_monthly_purchase_ammount: '',
    cep: '',
    address: '',
    address_number: '',
    complement: '',
    district: '',
    state: '',
    city: '',
});

const createSupplier = () => {
    Inertia.post(route('suppliers.store'),form, {
        errorBag: 'createSupplier',
        preserveScroll: true,
    });
}

</script>

<template>
    <AppLayout title="Cadastrar Fornecedor">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Cadastrar Fornecedor
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <FormSection @submitted="createSupplier">
        <template #title>
            Descrição Formulário
        </template>

        <template #description>
            Criar um novo fornecedor no sistema
        </template>

        <template #form>
            <div class="col-span-12">
                <div class="relative z-0">
                    <TextInput
                    id="name"
                    v-model="form.name"
                    type="text"
                    autofocus
                />
                <InputLabel for="name" value="Nome/Razão Social" />
                
                </div>
                <InputError :message="form.errors.name" class="mt-2" />
            </div>

            <div class="col-span-12 md:col-span-6">
                <DocumentInput v-model="form.doc" />
                <InputError :message="form.errors.doc" class="mt-2" />
            </div>

            <div class="col-span-12 md:col-span-6">
                <div class="relative z-0">
                    <TextInput
                        id="email"
                        v-model="form.email"
                        type="text"
                    />
                    <InputLabel for="email" value="Email" />
                </div>
                <InputError :message="form.errors.email" class="mt-2" />
            </div>

            <div v-show="form.doc.length < 14" class="col-span-12 md:col-span-6">
                <div class="relative z-0">
                    <TextInput
                        id="birth_date"
                        v-model="form.birth_date"
                        type="date"
                    />
                    <InputLabel for="phone_number" value="Data de Aniversário" />
                </div>
                <InputError :message="form.errors.birth_date" class="mt-2" />
            </div>

            <div v-show="form.doc.length >= 14" class="col-span-12 md:col-span-6">
                <div class="relative z-0">
                    <TextInput
                        id="opening_date"
                        v-model="form.opening_date"
                        type="date"
                    />
                    <InputLabel for="opening_date" value="Data de Abertura" />
                </div>
                <InputError :message="form.errors.opening_date" class="mt-2" />
            </div>

            <div class="col-span-12 md:col-span-6">
                <div class="relative z-0">
                    <TextInput
                        id="estimated_monthly_purchase_ammount"
                        v-model="form.estimated_monthly_purchase_ammount"
                        type="text"
                        v-mask-decimal.br="2"
                    />
                    <InputLabel for="phone_number" value="Compra mensal estimada" />
                </div>
                <InputError :message="form.errors.estimated_monthly_purchase_ammount" class="mt-2" />
            </div>

            <div class="col-span-12 md:col-span-6">
                <div class="relative z-0">
                    <TextInput
                        id="phone_number"
                        v-model="form.phone_number"
                        type="text"
                        v-mask="'(00) 0000-0000'"
                    />
                    <InputLabel for="phone_number" value="Telefone" />
                </div>
                <InputError :message="form.errors.phone_number" class="mt-2" />
            </div>

            <div class="col-span-12 md:col-span-6">
                <div class="relative z-0">
                    <TextInput
                        id="mobile_number"
                        v-model="form.mobile_number"
                        type="text"
                        v-mask-phone.br
                    />
                    <InputLabel for="mobile_number" value="Celular" />
                </div>
                <InputError :message="form.errors.mobile_number" class="mt-2" />
            </div>
            <Suspense>
                <Address 
                v-model:cep="form.cep"
                v-model:address="form.address"
                v-model:address_number="form.address_number"
                v-model:complement="form.complement"
                v-model:district="form.district"
                v-model:state="form.state"
                v-model:city="form.city"
                />

            </Suspense>


        </template>

        <template #actions>
            <Link :href="route('suppliers.index')">
                <SecondaryButton type="button" class="mr-1">
                    Voltar
                </SecondaryButton>
            </Link>

            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Salvar
            </PrimaryButton>
        </template>
    </FormSection>
            </div>
        </div>
    </AppLayout>
</template>
