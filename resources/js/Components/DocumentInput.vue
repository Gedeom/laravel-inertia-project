<script setup>
import { onMounted, ref, computed, watch} from 'vue';
import TextInput from './TextInput.vue';
import InputLabel from './InputLabel.vue';
import { useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    modelValue: String,
    showCpf: {
        type: Boolean,
        default: true
    },
    showCnpj: {
        type: Boolean,
        default: true
    },
});

const emits = defineEmits(['update:modelValue']);

const form = useForm({
    cpf: '',
    cnpj: '',
    showCpf: props.showCpf,
    showCnpj: !props.showCpf ? true : false,
});

const inputCpf = ref(null);
const inputCnpj = ref(null);


const changeCpf = () => {
    emits('update:modelValue', form.cpf);
    changeDocState('CPF');
}

const changeCnpj = () => {
    emits('update:modelValue', form.cnpj);
    changeDocState('CNPJ');
}

const changeDocState = (type) => {
    if(props.showCnpj && props.showCpf){
        if((props.modelValue.length) >= 14 && type == 'CPF'){
            form.showCpf = false;
            form.showCnpj = true;
            form.cnpj = props.modelValue;
            setTimeout(() => {inputCnpj.value.focus()}, 0);
            return;
        }

        if(props.modelValue.length <= 13 && type == 'CNPJ'){
            form.showCpf = true;
            form.showCnpj = false;
            form.cpf = props.modelValue;
            setTimeout(() => {inputCpf.value.focus()}, 0);
        }
    
    }
}



watch(() => form.cpf, (newValue, oldValue) => {
    changeCpf();
});

watch(() => form.cnpj, (newValue, oldValue) => {
    changeCnpj();
});

</script>

<template>
   <div v-show="form.showCpf">
        <div class="relative z-0">
            <TextInput 
                ref="inputCpf"
                id="cpf"
                name="cpf"
                v-model="form.cpf"
                type="text"
                v-mask-cpf
            />
            <InputLabel for="cpf" value="CPF" />
        </div>
    </div>

    <div v-show="!form.showCpf && form.showCnpj">
        <div class="relative z-0">
            <TextInput 
                ref="inputCnpj"
                id="cnpj"
                name="cnpj"
                v-model="form.cnpj"
                type="text"
                v-mask-cnpj
            />
            <InputLabel for="cnpj" value="CNPJ" />
        </div>
    </div>
</template>
