<template>
    <div class="border mr-4 rounded p-4">
        <label v-for="category in categories_" class="block">
            <input type="checkbox" name="categories[]" :value="category.id" v-model="checked"> {{category.title}}
        </label>
    </div>
    <!-- <div class="previews flex flex-wrap gap-20">
        <div class="preview flex" v-for="category in checked_categories">
            <patronageCategoryPreview v-for="image in category.images" :image="image" />
        </div>
    </div> -->
</template>
<script>
    import patronageCategoryPreview from './partials/patronage-category-preview.vue'
    import axios from 'axios'
    export default{
        components: {
            patronageCategoryPreview
        },
        data(){
            return {
                categories_: [],
                checked: [],
            }
        },
        props: {
            categories: {
                type: Array
            },
            selected: {
                type: Array,
                default: ()=>[]
            }
        },
        mounted(){
            this.categories_ = this.categories
            this.checked = this.selected.map(item=>parseInt(item))
            axios.get('/json/categories?ids='+this.categories_.map(i=>i.id).join(',')).then(response=>{
                response.data.forEach(cat=>{
                    this.categories_.find(c=>c.id==cat.id).images = cat.images
                })
            })
        },
        computed: {
            checked_categories(){
                return this.categories_.filter(item=>this.checked.includes(item.id)).map(item=>{
                    if(typeof item.images == 'string')
                        item.images = JSON.parse(item.images)
                    return item
                })
            }
        }
    }
</script>