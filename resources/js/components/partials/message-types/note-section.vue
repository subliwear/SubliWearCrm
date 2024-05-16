<template>
    <div class="flex w-7/12">
        <div class="p-4 rounded-xl w-full mb-4" :class="'bg-green'">
            <div class="text-md">{{message.note}}</div>

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