<template>
    <div class="patro-cat-preview">
        <div class="rounded-lg mx-2" :style="{
            width: image.width/2+'px',
            height: image.height/2+'px',
            backgroundImage: 'url('+image.preview+')',
            backgroundSize: 'contain',
            position: 'relative'
        }">
            <div v-for="block in image.blocks" class="prblock" :style="{
                left: Math.min(block.startx/2, block.endx/2)+'px', 
                top: Math.min(block.starty/2, block.endy/2)+'px', 
                width: Math.abs(block.endx/2-block.startx/2)+'px', 
                height: Math.abs(block.endy/2-block.starty/2)+'px'
            }">
                {{ block.title }}
            </div>
        </div>
    </div>
</template>
<script>
    export default{
        props: {
            image: {
                type: Object
            }
        }
    }
</script>
<style scoped>
    .prblock{
        position: absolute;
        background: rgba(255,255,255,.3);
        border: 1px dotted white;
        color: #fff;
        font-size: 12px;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>