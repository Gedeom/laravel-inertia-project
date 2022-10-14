<script setup>
import { computed } from '@vue/reactivity';

const props = defineProps({
    value: {
        type: String,
        default: ""
    },
    float: {
        type: Boolean,
        default: true,
    }
});

const getClass = () => {
    return props.float ?
            'absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-indigo-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6':
            'text-sm text-gray-500 peer-focus:left-0 peer-focus:text-indigo-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6';
}

</script>

<template>
    <label :class="getClass()">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
