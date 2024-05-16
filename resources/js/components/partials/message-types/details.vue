<template>
    <div class="w-full">
        <div class="mt-4 mb-1 font-bold">
            Details
        </div>
        <table cellpadding="0" cellspacing="0" width="100%">
            <thead>
                <th class="text-center border">Size</th>
                <th class="text-center border">Quantity</th>
                <th class="text-center border">Number</th>
                <th class="text-center border">Nickname</th>
                <th class="text-center border" v-for="caption in columns">{{ caption.title }}</th>
            </thead>
            <tr v-for="det in details">
                <td class="text-center border">
                    {{ det.size }}
                </td>
                <td class="text-center border">
                    {{ det.quantity }}
                </td>
                <td class="text-center border">
                    {{ det.number }}
                </td>
                <td class="text-center border">
                    {{ det.nickname }}
                </td>
                <td v-for="(col, i) in det.columns" class="text-center border">
                    {{ col.value }}
                </td>
            </tr>
        </table>
    </div>
</template>
<script>
    export default{
        props: {
            details: {
                type: Object
            },
            columns: {
                type: Object
            }
        }
    }
</script>