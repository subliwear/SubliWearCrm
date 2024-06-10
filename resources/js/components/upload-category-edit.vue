<template>
    <div @mouseup="mouseup">
        <div class="pb-2 mb-2 border-b" v-for="(image, img) in images">
            <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Select image</label>
            <div class="mb-4 flex">
                <input type="file" @change="$event=>handleFile($event, image)" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                <button v-if="img>0" @click.prevent="removeImage(img)" class="border border-red-600 ml-4 p-2 px-4 rounded-lg text-red-600 text-xs whitespace-nowrap">&times; Remove image</button>
            </div>
            <label v-if="preview!==''" class="mb-2 ml-1 font-bold text-xs text-slate-700">Define upload regions (just draw with mouse)</label>
            <div class="designer">
                <div class="preview rounded-lg" @mousedown="$event=>mousedown($event, image)" @mousemove="$event=>mousemove($event, image)" id="image-preview" :style="{height: image.height+'px', backgroundImage: 'url('+image.preview+')', backgroundSize: 'contain'}">
                    <div v-for="block in image.blocks" class="block" :style="{
                        left: Math.min(block.startx, block.endx)+'px', 
                        top: Math.min(block.starty, block.endy)+'px', 
                        width: Math.abs(block.endx-block.startx)+'px', 
                        height: Math.abs(block.endy-block.starty)+'px',
                        textShadow: '2px 2px 4px #000000',
                        border: '1px solid black',
                    }">
                        {{ block.title }}
                    </div>
                </div>
                <div class="blocks-lines">
                    <div v-for="(block, i) in image.blocks" class="block-line mb-2" >
                        <div>{{ i+1 }}.</div>
                        <input type="text" v-model="block.title" class="mx-2 w-90 focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                        <button @click.prevent="removeBlock(i, image)" class="border border-red-600 p-2 px-4 rounded-lg text-red-600">&times;</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button @click.prevent="addImage" class="border border-slate-200 px-4 py-2 rounded-lg text-slate-500 text-xs">Add image</button>
    <input type="hidden" name="blocks" :value="jsoned" />
</template>
<style>
    .designer{
        display: flex;
    }
    .designer .preview, 
    .designer .blocks{
        flex-basis: 48%;
        position: relative;
    }
    .designer .preview img{
        width: 100%;
        pointer-events: none;
    }
    .designer .preview{
        height: 300px;
    }
    .designer .preview .block{
        position: absolute;
        border: 1px dotted white;
        background-color: rgba(255,255,255,.3);
        z-index: 41341;
        pointer-events: none;
        color: #fff;
        font-size: 16px;
        font-weight: bold;
        align-items: center;
        justify-content: center;
        display: flex;
        text-shadow: 0 0 5px rgba(0,0,0,.1);
    }
    .blocks-lines{
        padding-left: 20px;
        
    }
    .blocks-lines .block-line{
        display: flex;
        align-items: center;
    }
</style>
<script>
    export default {
        props: {
            input:{
                type: Object
            }
        },
        data(){
            return {
                file: null,
                preview: '',
                blocks: [],

                flag: false,
                x: 0,
                y: 0,
                current_block: {},

                zerox: 0,
                zeroy: 0,

                width: 0,
                height: 0,

                alphabet: 'ABCDEFGHIJKLMNOPRSTUVWXYZ',

                images: [
                    {
                        preview: '',
                        blocks: [],
                        height: 0,
                        width: 0
                    }
                ]
            }
        },
        computed: {
            jsoned(){
                return JSON.stringify(this.images)
            }
        },
        mounted(){
            this.images = this.input
        },
        methods: {
            removeImage(image){
                this.images.splice(image, 1)
            },
            addImage(){
                this.images.push({
                    preview: '',
                    blocks: [],
                    height: 0,
                    widht: 0
                })
            },
            removeBlock(index, image){
                image.blocks.splice(index, 1)
            },
            mouseup(){
                this.flag = false
            },
            mousemove(event, image){
                if(this.flag){
                    this.current_block.endx = event.clientX - this.x
                    this.current_block.endy = event.clientY - this.y
                }
            },
            mousedown(event, image){
                console.log(event)
                this.flag = true
                var rect = event.target.getBoundingClientRect();
                this.x = rect.left
                this.y = rect.top

                let block = {
                    title: this.alphabet[image.blocks.length],
                    startx: event.clientX - this.x,
                    starty: event.clientY - this.y,
                    endx: event.clientX - this.x,
                    endy: event.clientY - this.y,
                }
                image.blocks.push(block)
                this.current_block = image.blocks[image.blocks.length-1]
                
            },
            handleFile(event, image){
                let [file] = event.target.files
                if(file){
                    var reader = new FileReader();
                    reader.onload = () => {
                        image.preview = reader.result;
                        let img = new Image
                        img.onload = ()=>{
                            image.width = img.width
                            image.height = img.height

                            let relativity = document.querySelector('#image-preview').offsetWidth/image.width


                            image.height *= relativity
                            image.width = document.querySelector('#image-preview').offsetWidth
                            
                        }
                        img.src = image.preview
                    };
                    reader.readAsDataURL(file);
                }
            }
        }
    }
</script>