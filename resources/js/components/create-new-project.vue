<template>
    <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Title of the project <small class="text-slate-400">(for your identification)</small></label>
    <div class="mb-4">
        <input type="text" v-model="project.title" required class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Project title" aria-label="Name">
    </div>
    <div class="p-0 border overflow-hidden rounded-xl patronage mb-2" v-for="(patronage, index) in project.patronages">
        <div class="bg-gray-50 border-b border-bottom p-4 patronage-header py-2.375 rounded-t-lg flex justify-between">
            <div>Patronage #{{ index+1 }}</div>
            <div>
                <button @click="toggleFolded(patronage)" class="px-2">
                    <svg fill="currentcolor" v-if="patronage.is_folded==false" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M233.4 105.4c12.5-12.5 32.8-12.5 45.3 0l192 192c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L256 173.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l192-192z"/></svg>
                    <svg fill="currentcolor" v-if="patronage.is_folded==true" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/></svg>
                </button>
                <button class="text-red-600 px-2" @click="removePatronage(index)">
                    <svg fill="currentcolor" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
                </button>
            </div>
        </div>
        <div class="patronage-body p-4" v-if="!patronage.is_folded">
            <div class="step-title">Choose type of patronage</div>
            <div class="choose-variant flex flex-row mb-2">
                <label class="relative text-center p-6 mr-2" :class="patronage.patronage_type=='existing'?'shadow-soft-2xl border-2 rounded-2xl border-slate-700 bg-center stroke-0 text-slate-700':'cursor-pointer border-2 rounded-2xl border-slate-400 bg-center stroke-0 text-slate-400'">
                    <input type="radio" value="existing" class="absolute opacity-0" v-model="patronage.patronage_type" name="patronage_type">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" fill="currentcolor" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"/></svg>
                        <div>Use existing patronage</div>
                    </div>
                </label>
                <label class="relative text-center p-6" :class="patronage.patronage_type=='upload'?'shadow-soft-2xl border-2 rounded-2xl border-slate-700 bg-center stroke-0 text-slate-700':'cursor-pointer border-2 rounded-2xl border-slate-400 bg-center stroke-0 text-slate-400'">
                    <input type="radio" value="upload" class="absolute opacity-0" v-model="patronage.patronage_type" name="patronage_type">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentcolor" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M296 384h-80c-13.3 0-24-10.7-24-24V192h-87.7c-17.8 0-26.7-21.5-14.1-34.1L242.3 5.7c7.5-7.5 19.8-7.5 27.3 0l152.2 152.2c12.6 12.6 3.7 34.1-14.1 34.1H320v168c0 13.3-10.7 24-24 24zm216-8v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h136v8c0 30.9 25.1 56 56 56h80c30.9 0 56-25.1 56-56v-8h136c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z"/></svg>
                        <div>Upload your own files</div>
                    </span>
                </label>
            </div>
            <div class="choose-existing" v-if="patronage.patronage_type == 'existing'">
                <div class="step-title">Select patronage</div>
                <patronages @selected="data => patronageSelected(data, patronage)"/>

                <patronageLogoUploader v-if="patronage.is_selected" :id="patronage.patronage.id" :project_id="project_id" @changed="$event=>changedPatronageTemplate($event, patronage)"/>
            </div>
            <div class="upload-design" v-if="patronage.patronage_type == 'upload'">
                <div class="step-title">Upload your files</div>
                <fileuploader @change="files=>patronage.uploads = files" :project_id="project_id" />
            </div>
            <div>
                <div class="step-title">Input details</div>
                <pieces @change="({details, columns}) => {patronage.details = details; patronage.custom_columns = columns}"/>
            </div>
        </div>
    </div>
    <div class="flex justify-between">
        <button @click="addPatronage" class="inline-block px-6 py-3 mt-6 mb-0 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer shadow-soft-md bg-x-25 bg-150 leading-pro text-xs ease-soft-in tracking-tight-soft bg-gradient-to-tl from-green-600 to-lime-400 hover:scale-102 hover:shadow-soft-xs active:opacity-85">Add <span v-if="project.patronages.length>0">another</span> patronage</button>
        <button @click="createProject" :disabled="creating || project.patronages.length==0" class="inline-block px-6 py-3 mt-6 mb-0 font-bold text-center text-lime-500 border-2 border-lime-500 uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer shadow-soft-md bg-x-25 bg-150 leading-pro text-xs ease-soft-in tracking-tight-soft  hover:scale-102 hover:shadow-soft-xs active:opacity-85 flex items-center justify-center">Create project <div class="loading33" v-if="creating"></div></button>
    </div>
</template>
<script>
    import patronages from './partials/patronages.vue';
    import pieces from './partials/pieces.vue';
    import fileuploader from './partials/fileuploader.vue';
    // import patronageCategories from './partials/patronage-categories.vue';
    import patronageLogoUploader from './partials/patronage-logo-uploader.vue';
    import axios from 'axios';

    export default {
        components: {
            patronages, pieces, fileuploader, patronageLogoUploader
        },
        data(){
            return {
                project: {
                    title: '',
                    patronages: [],
                },
                project_id: '',
                creating: false,
            }
        },
        mounted(){
            axios.get('/json/project-pre-create').then(response=>{
                this.project_id = response.data.id
            })
        },
        methods: {
            changedPatronageTemplate({images}, patronage){
                patronage.category_images[0] = {
                    images: images
                }
            },
            patronageSelected(data, patronage){
                patronage.patronage_id=data.id
                patronage.is_selected = true;
                patronage.patronage = data
                patronage.category_images = {}
            },
            createProject(){
                this.creating = true
                axios.post('/json/project', {...this.project, project_id: this.project_id}).then(response=>{
                    this.creating = false
                    window.location = response.data.redirect
                }).catch(()=>{
                    this.creating = false
                    alert('Error happened. Please try again')
                })
            },
            removePatronage(index){
                this.project.patronages.splice(index, 1)
            },
            toggleFolded(patronage){
                patronage.is_folded = !patronage.is_folded
            },
            addPatronage(){
                this.project.patronages.push({
                    patronage_type: 'existing',
                    patronage_search_kw: '',
                    patronage_id: '',
                    is_selected: false,
                    patronage: {},
                    is_folded: false,
                    uploads: [],
                    details: [],
                    custom_columns: [],
                })
            }
        }
    }
</script>
<style>
    .patronage{
        counter-reset: step;
    }
    .step-title{
        font-size: 16px;
        font-weight: bold;
        margin-top: 20px;
        counter-increment: step;
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        padding-top: 20px;
        border-top: 1px dotted rgb(103, 116, 142);
    }
    .patronage-body > .step-title:first-child{
        margin-top: 0;
        padding-top: 0;
        border-top: 0;
    }
    .step-title:before{
        color: rgb(103, 116, 142);
        display: flex;
        width: 30px;
        height: 30px;
        min-width: 30px;
        max-width: 30px;
        min-height: 30px;
        max-height: 30px;
        border-radius: 30px;
        background-color: rgb(248, 249, 250);
        content: counter(step);
        margin-right: 10px;
        align-items: center;
        justify-content: center;
        border: 1px solid rgb(103, 116, 142);
    }
    .loading33,
    .loading33:after {
    border-radius: 50%;
    width: 20px;
    height: 20px;
    }
    .loading33 {
    margin: 0 10px;
    font-size: 10px;
    position: relative;
    text-indent: -9999em;
    border-top: 5px solid rgba(130, 214, 22, 0.2);
    border-right: 5px solid rgba(130, 214, 22, 0.2);
    border-bottom: 5px solid rgba(130, 214, 22, 0.2);
    border-left: 5px solid rgb(130, 214, 22);
    -webkit-transform: translateZ(0);
    -ms-transform: translateZ(0);
    transform: translateZ(0);
    -webkit-animation: load8 1.1s infinite linear;
    animation: load8 1.1s infinite linear;
    }
    @-webkit-keyframes load8 {
    0% {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100% {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg);
    }
    }
    @keyframes load8 {
    0% {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100% {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg);
    }
    }
</style>