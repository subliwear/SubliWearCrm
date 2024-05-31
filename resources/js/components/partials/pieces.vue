<template>
    <div class="flex">
        <table cellpadding="0" cellspacing="0">
            <thead>
                <th></th>
                <th class="text-left">Size</th>
                <th class="text-left">Quantity</th>
                <th class="text-left">Number</th>
                <th class="text-left">Nickname</th>
                <th v-for="(col, cio) in custom_columns">
                    <div class="flex">
                        <input type="text" v-model="col.title" />
                        <button @click="removeColumn(cio)">&times;</button>
                    </div>
                </th>
            </thead>
            <tr v-for="(row, ri) in details">
                <th>
                    <button  class="px-1" @click="removeRow(ri)" v-if="ri>0">&times;</button>
                    <span v-else class="px-1">&nbsp;&nbsp;</span>
                </th>
                <td>
                    <input type="text" v-model="row.size"  placeholder="Size" class=" text-center focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none border border-r-0 border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:outline-none focus:transition-shadow" :class="[ri==0?'rounded-tl':'', ri==details.length-1?'rounded-bl':'', ri<details.length-1?'border-b-0':'']"/>
                </td>
                <td>
                    <input type="number" v-model="row.quantity" placeholder="Quantity" class="text-center focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none border border-r-0 border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:outline-none focus:transition-shadow" :class="ri<details.length-1?'border-b-0':''"/>
                </td>
                <td>
                    <input type="text" v-model="row.number" placeholder="Number" class="text-center focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none border border-r-0 border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:outline-none focus:transition-shadow" :class="ri<details.length-1?'border-b-0':''"/>
                </td>
                <td>
                    <input type="text" v-model="row.nickname" placeholder="Nickname" class="text-center focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:outline-none focus:transition-shadow" :class="[custom_columns.length==0?'border-r ':'border-r-0', ri<details.length-1?'border-b-0':'', custom_columns.length==0&&ri==0?'rounded-tr':'', custom_columns.length==0&&ri==details.length-1?'rounded-br':'']"/>
                </td>
                <td v-for="(col, ci) in row.columns">
                    <input type="text" v-model="col.value" :placeholder="custom_columns[ci].title" class="text-center focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:outline-none focus:transition-shadow" :class="[ci==custom_columns.length-1?'border-r':'border-r-0', ri<details.length-1?'border-b-0':'', custom_columns.length-1==ci&&ri==0?'rounded-tr':'', custom_columns.length-1==ci&&ri==details.length-1?'rounded-br':'']"/>
                </td>
            </tr>
        </table>
        <button @click="addColumn()" class="ml-2 px-8 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro ease-soft-in text-xs hover:scale-102 active:shadow-soft-xs tracking-tight-soft border-slate-500 text-slate-500 hover:border-slate-700 hover:bg-transparent hover:text-slate-700 hover:opacity-75 hover:shadow-none active:bg-slate-700 active:text-white active:hover:bg-transparent active:hover:text-fuchsia-500">Add column</button>
    </div>
    
    <button @click="addRow()" class="mt-2 px-8 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro ease-soft-in text-xs hover:scale-102 active:shadow-soft-xs tracking-tight-soft border-slate-500 text-slate-500 hover:border-slate-700 hover:bg-transparent hover:text-slate-700 hover:opacity-75 hover:shadow-none active:bg-slate-700 active:text-white active:hover:bg-transparent active:hover:text-fuchsia-500 px-8 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro ease-soft-in text-xs hover:scale-102 active:shadow-soft-xs tracking-tight-soft border-slate-500 text-slate-500 hover:border-slate-700 hover:bg-transparent hover:text-slate-700 hover:opacity-75 hover:shadow-none active:bg-slate-700 active:text-white active:hover:bg-transparent active:hover:text-fuchsia-500">Add row</button>
    
</template>
<script>
    export default {
        data(){
            return {
                rows: 0,
                cols: 0,
                custom_columns: [],
                details: [
                    {
                        size: '',
                        quantity: 1,
                        number: '',
                        nickname: '',
                        columns: [
                            
                        ]
                    }
                ],
            }
        },
        watch: {
            details: {
                deep: true,
                handler(){
                    this.$emit('change', {details: this.details, columns: this.custom_columns})
                }
            },
            custom_columns: {
                deep: true,
                handler(){
                    this.$emit('change', {details: this.details, columns: this.custom_columns})
                }
            }
        },
        methods: {
            removeRow(index){
                this.details.splice(index, 1)
            },
            removeColumn(index){
                this.details.forEach(item=>{
                    item.columns.splice(index, 1)
                })
                this.custom_columns.splice(index, 1)
            },
            addRow(){
                let cc = []
                this.custom_columns.forEach(()=>{
                    cc.push({value: ''})
                })
                this.details.push({
                    size: '',
                        quantity: 1,
                        number: '',
                        nickname: '',
                        columns: cc
                })
            },
            addColumn(){
                this.custom_columns.push({title: 'New column'})
                this.details.forEach(row=>{
                    row.columns.push({value: ''})
                })
            }
        }
    }
</script>
<style>
    .rounded-tl{
        border-top-left-radius: 4px;
    }
    .rounded-tr{
        border-top-right-radius: 4px;
    }
    .rounded-bl{
        border-bottom-left-radius: 4px;
    }
    .rounded-br{
        border-bottom-right-radius: 4px;
    }
</style>