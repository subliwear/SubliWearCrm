<template>
    <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Search existing patronages</label>
    <div class="mb-4">
        <input type="text" v-model="keyword" required class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Type a keyword" aria-label="Name">
    </div>
    <div class="flex gap-10">
        <patronage v-for="(patron, index) in patronages" :patronage="patron" @select="selected(patron, index)" :selected="selected_index==index"/>
    </div>
    <div class="flex mt-2" v-if="total>10">
        <button v-for="p in pages" @click="setPage(p)" class="border p-4 py-2 rounded mr-1" :class="p==page?'bg-gray-200':''">{{ p+1 }}</button>
    </div>
</template>
<script>
    import axios from 'axios'
    import patronage from './patronage.vue';
    export default {
        components: {
            patronage
        },
        data(){
            return {
                keyword: '',
                patronages: [],
                total: 0,
                selected_index: -1,
                page: 0,
            }
        },
        mounted() {
            this.load()
        },
        computed: {
            pages(){
                let r = []
                for(let i = 0;i<Math.ceil(this.total/1); i++)
                    r.push(i)
                return r
            }
        },
        methods: {
            setPage(page){
                this.page = page
            },
            load(){
                axios.get('/json/patronages?keyword='+this.keyword+'&page='+this.page).then(response=>{
                    this.patronages = response.data.patronages
                    this.total = response.data.total
                })
            },
            selected(patronage, index){
                this.selected_index = index
                this.$emit('selected', patronage)
            }
        },
        watch: {
            keyword(){
                this.load()
            },
            page(){
                this.load()
            }
        }
    }
</script>
<style scoped>
    .gap-10{
        gap: 10px;
    }
</style>