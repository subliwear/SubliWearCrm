<template>
    <div class="p-2 border rounded shadow relative" :class="selected?'bg-gray-200':''">
        <div class="absolute right-4 text-white top-3.5 cursor-pointer" @click="show_modal=true"><svg xmlns="http://www.w3.org/2000/svg" height="1em" fill="#fff" stroke="#000" stroke-width="4" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM184 296c0 13.3 10.7 24 24 24s24-10.7 24-24V232h64c13.3 0 24-10.7 24-24s-10.7-24-24-24H232V120c0-13.3-10.7-24-24-24s-24 10.7-24 24v64H120c-13.3 0-24 10.7-24 24s10.7 24 24 24h64v64z"/></svg></div>
        <div class="w-32 h-32 flex">
            <img :src="patronage.preview" :alt="patronage.title" class="w-full object-fit-cover rounded">
        </div>
        <div class="price absolute bg-gradient-to-tl from-green-600 p-2 price rounded rounded-bl-none rounded-tl-none shadow-soft-3xl text-sm text-white to-lime-400 top-31/100">{{ patronage.price }}€</div>
        <div class="font-bold">
            {{ patronage.title }}
        </div>
        <div class="flex my-4">
            <div v-for="product in patronage.products" class="text-xs rounded px-1 border">
                {{ product.title }}
            </div>
        </div>
        <button @click="doSelect" class="inline-block px-8 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro ease-soft-in text-xs hover:scale-102 active:shadow-soft-xs tracking-tight-soft border-slate-500 text-slate-500 hover:border-slate-700 hover:bg-transparent hover:text-slate-700 hover:opacity-75 hover:shadow-none active:bg-slate-700 active:text-white active:hover:bg-transparent active:hover:text-fuchsia-500">Select this one</button>
    </div>

<!-- Modal toggle -->

<!-- Main modal -->
<div v-if="show_modal" tabindex="-1" aria-hidden="true" class="fixed h-full left-0 max-h-full md:inset-0 overflow-x-hidden overflow-y-auto p-4 right-0 shadow-soft-xl top-0 w-full z-50" style="z-index: 12312;">
    <div class="mx-auto my-auto relative rounded-10 shadow-soft-3xl w-7/12">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    {{ patronage.title }}
                </h3>
                <button type="button" @click="show_modal=false" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <img :src="patronage.preview" class="w-full">
                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                    {{patronage.description}}
                </p>
            </div>
        </div>
    </div>
</div>

</template>
<script>
    export default {
        props: {
            patronage: {
                type: Object
            },
            selected: {
                type: Boolean
            }
        },
        data(){
            return {
                show_modal: false
            }
        },  
        methods: {
            doSelect(){
                this.$emit('select')
            }
        }
    }
</script>
<style>
    .w-32{
        width: 10.5rem;
    }
    .h-32{
        height: 10.5rem;
    }
    .object-fit-cover{
        object-fit: cover;
    }
</style>