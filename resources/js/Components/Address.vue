<script setup>
import { computed, onMounted, onBeforeMount, watch, ref, reactive } from 'vue';
import TextInput from './TextInput.vue';
import InputLabel from './InputLabel.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import InputError from '@/Components/InputError.vue';
import axios from 'axios';

const props = defineProps({
    cep: String,
    address: String,
    address_number: String,
    complement: String,
    district: String,
    state: String,
    city: [Number, String]
});

const emits = defineEmits(['update:cep', 'update:address', 'update:address_number', 'update:complement', 'update:district', 'update:state', 'update:city']);

const form = useForm({
    cep: '',
    address: '',
    address_number: '',
    complement: '',
    district: '',
    state: '',
    city: '',
    aux:{
        cities: [],
        ibge: ''
    }
});

const states = await axios.get(route('states.index')).then(response => response.data.map((state) => {return {code: state.id, label: state.description}}));
const loadCities = state => {
    form.city = '';

    axios.get(route('cities.getByState', {state: state}))
    .then(response => {
       form.aux.cities =  response.data.map((city) => {return {code: city.id, label: city.description, cod_ibge: city.cod_ibge}});

       if(form.aux.ibge){
            form.city = form.aux.cities.find(item => item.cod_ibge == form.aux.ibge);
       }
    });
}

const loadCep = () => {
    const cep = form.cep.replace(/\D/g, "");

        if(cep) {
            axios.get(`https://viacep.com.br/ws/${cep}/json/`).then(response => {
                form.address = response.data.logradouro;
                form.district = response.data.bairro;
                form.state = states.find(item => item.code == response.data.uf);
                form.aux.ibge = response.data.ibge
            });
        }
}


// watch cep
watch(form, (newValue, oldValue) => {
    emits('update:cep', newValue.cep);
    emits('update:address', newValue.address);
    emits('update:address_number', newValue.address_number);
    emits('update:complement', newValue.complement);
    emits('update:district', newValue.district);
    emits('update:state', newValue.state?.['code'] || '');
    emits('update:city', newValue.city?.['code'] || '');
});


watch(() => form.state, (newValue, oldValue) => {
    if(newValue){
        loadCities(newValue.code);
    }
    else{
        form.city = '';
        form.aux.cities = [];
    }
});


</script>


<template>

<div class="col-span-12">
    <div class="block rounded-lg shadow-lg bg-white">
        <div class="py-3 px-6 border-b border-gray-300 text-xl font-medium">
            Endereço
        </div>
        
        <div class="p-6 grid grid-cols-12 gap-6">
            <div class="col-span-12 md:col-span-3">
                <div class="relative z-0">
                    <TextInput
                        id="cep"
                        v-model="form.cep"
                        type="text"
                        @change="loadCep"
                        v-mask-cep
                        @input="$emit('update:cep', $event.target.value)"
                    />
                    <InputLabel for="cep" value="Cep*" />
                </div>
                <InputError :message="form.errors.cep" class="mt-2" />
            </div>

            <div class="col-span-12 md:col-span-9">
                <div class="relative z-0">
                    <TextInput
                        id="address"
                        v-model="form.address"
                        type="text"
                        @input="$emit('update:address', $event.target.value)"
                        @change="$emit('update:address', $event.target.value)"
                    />
                    <InputLabel for="address" value="Logradouro*" />
                </div>
                <InputError :message="form.errors.address" class="mt-2" />
            </div>

            <div class="col-span-12 md:col-span-2">
                <div class="relative z-0">
                    <TextInput
                        id="address_number"
                        v-model="form.address_number"
                        type="text"
                    />
                    <InputLabel for="address_number" value="Número*" />
                </div>
                <InputError :message="form.errors.address_number" class="mt-2" />
            </div>

            <div class="col-span-12 md:col-span-3">
                <div class="relative z-0">
                    <TextInput
                        id="complement"
                        v-model="form.complement"
                        type="text"
                    />
                    <InputLabel for="complement" value="Complemento" />
                </div>
                <InputError :message="form.errors.complement" class="mt-2" />
            </div>


            <div class="col-span-12 md:col-span-7">
                <div class="relative z-0">
                    <TextInput
                        id="district"
                        v-model="form.district"
                        type="text"
                    />
                    <InputLabel for="district" value="Bairro*" />
                </div>
                <InputError :message="form.errors.district" class="mt-2" />
            </div>

            <div class="col-span-12 md:col-span-6">
                <InputLabel for="state" value="Estado*" :float="false" />
                <v-select v-model="form.state" :options="states" />
                <InputError :message="form.errors.state" class="mt-2" />
            </div>

            <div class="col-span-12 md:col-span-6">
                <InputLabel for="city" value="Cidade*" :float="false" />
                <v-select v-model="form.city" :options="form.aux.cities"> </v-select>
                <InputError :message="form.errors.city" class="mt-2" />
            </div>

        </div>
    </div>
</div>
</template>
