<template>
    <file-pond
        name="test"
        :ref="'pond'+id"
        class-name="my-pond"
        label-idle="Drop files here..."
        allow-multiple="true"
        server="/json/upload"
        v-on:processfiles="handleFiles"
        v-on:removefile="handleFiles" 
        credits="" 
    />
</template>
<script>
    import axios from 'axios';
    import { v4 as uuidv4 } from 'uuid';
    import vueFilePond from 'vue-filepond';
    import 'filepond/dist/filepond.min.css';
    const FilePond = vueFilePond();
    export default {
        components: {
            FilePond
        },
        data(){
            return {
                files: [],
                id: ''
            }
        },
        mounted(){
            this.id = uuidv4()
        },
        methods: {
            clearList(){
                this.$refs['pond'+this.id].removeFiles()
            },
            handleFiles(){
                this.files = this.$refs['pond'+this.id].getFiles().map(file=>{
                    let response = JSON.parse(file.serverId)
                    return {...response, filetype: file.fileType}
                })
            }
        },
        watch: {
            files: {
                deep: true,
                handler(){
                    this.$emit('change', this.files)
                }
            }
        }
    }

</script>