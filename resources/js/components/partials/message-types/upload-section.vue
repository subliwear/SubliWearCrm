<template>
    <div class="flex w-7/12" :class="[message.is_uploaded_by_customer?'':' ml-auto']">
        <div>
            <img v-if="message.is_uploaded_by_customer" :src="'https://api.dicebear.com/6.x/notionists-neutral/svg?seed='+customer.email" class="inline-flex items-center justify-center mr-4 text-sm text-white transition-all duration-200 ease-soft-in-out h-9 w-9 rounded-circle border" alt="user1" />
            <img v-else :src="'https://api.dicebear.com/6.x/notionists-neutral/svg?seed='+manager.email" class="inline-flex items-center justify-center mr-4 text-sm text-white transition-all duration-200 ease-soft-in-out h-9 w-9 rounded-circle border" alt="user1" />
        </div>
        <div class="p-4 rounded-xl w-full mb-4" :class="[message.is_uploaded_by_customer?'bg-green':'bg-gray']">
            <div v-if="message.is_uploaded_by_customer" class="mb-1 font-semibold leading-normal text-sm text-slate-700">{{ customer.name }}</div>
            <div v-else class="mb-1 font-semibold leading-normal text-sm text-slate-700">{{ manager.name }}</div>

            <div class="bg-white/80 border border-slate-200 mb-4 mt-4 p-4 rounded flex flex-wrap flex-grow-0 flex-shrink-0 gap-10">
                <div class="border rounded p-4">
                    <div class="w-32 h-32 rounded border flex">
                        <img :src="message.preview" alt="" class="w-full object-fit" >
                    </div>
                    <div>
                        <a :href="message.download" target="_blank" class="text-blue-800 text-sm"><svg fill="currentcolor" xmlns="http://www.w3.org/2000/svg" height="12px" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V274.7l-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7V32zM64 352c-35.3 0-64 28.7-64 64v32c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V416c0-35.3-28.7-64-64-64H346.5l-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352H64zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/></svg> <span class="underline">Download</span></a>
                    </div>
                    
                </div>
            </div>

            <div class="date text-sm .leading-tight text-right">
                {{ message.date }}
            </div>
        </div>
    </div>
</template>
<script>

    export default{
        props: {
            customer: {
                type: Object
            },
            manager: {
                type: Object
            },
            message: {
                type: Object
            }
        },

    }
</script>