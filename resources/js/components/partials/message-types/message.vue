<template>
    <div class="flex w-7/12" :class="[message.is_from_customer?'':' ml-auto']">
        <div>
            <img v-if="message.is_from_customer" :src="'https://api.dicebear.com/6.x/notionists-neutral/svg?seed='+customer.email" class="inline-flex items-center justify-center mr-4 text-sm text-white transition-all duration-200 ease-soft-in-out h-9 w-9 rounded-circle border" alt="user1" />
            <img v-else :src="'https://api.dicebear.com/6.x/notionists-neutral/svg?seed='+manager.email" class="inline-flex items-center justify-center mr-4 text-sm text-white transition-all duration-200 ease-soft-in-out h-9 w-9 rounded-circle border" alt="user1" />
        </div>
        <div class="p-4 rounded-xl w-full mb-4" :class="[message.is_from_customer?'bg-green':'bg-gray']">
            <div v-if="message.is_from_customer" class="mb-1 font-semibold leading-normal text-sm text-slate-700">{{ customer.name }}</div>
            <div v-else class="mb-1 font-semibold leading-normal text-sm text-slate-700">{{ manager.name }}</div>
            <div class="text-md">{{message.text}}</div>

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